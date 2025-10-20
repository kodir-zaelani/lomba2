<?php

namespace App\Livewire\Backend\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $currentPage   = 1;
    public $paginate      = 10;
    public $search        = '';
    public $checked       = [];
    public $selectPage    = false;
    public $selectAll     = false;
    public $sortDirection = 'asc';
    public $sortColumn    = 'title';
    public $statusUpdate  = false;
    public $headersTable;
    public $action;
    public $selectedItem;

    public $posttagtitle;

    #[Rule('required|min:2|unique:tags,title')]
    public $title;

    public $editingTagID;
    #[Rule('required|min:2|unique:tags,title')]
    public $editingTagTitle;

    public function store()
    {
        $validateData = [
            'title' => 'required|min:2|unique:tags,title',
        ];

        $this->validate($validateData);
        // Default data
        $data = [
            'title' => $this->title,
            'slug'      => Str::slug($this->title),

        ];

        $tag = Tag::create($data);

        // even listener -> dispatch
        $this->reset('title');
        $this->statusUpdate = false;
        $this->dispatch('tagStored', $tag);
        // This is to reset our public variables
    }

    #[On('tagStored')]
    public function updateList($tag)
    {
        session()->flash('success', 'Add Tag Successfully');
        // dd($tag);
    }

    #[On('tagUpdated')]
    public function tagUpdated()
    {
        // dd('Update');
        session()->flash('success', 'Update Tag  Successfully');
    }

    public function edit($tagID)
    {
        $this->statusUpdate = true;
        $this->editingTagID = $tagID;

        $model = Tag::find($this->editingTagID);

        $this->editingTagTitle = $model->title;
    }

    public function cancelEdit()
    {
        $this->statusUpdate = false;
        $this->search = '';
        $this->resetPage();

    }

    public function updatetag()
    {
        $this->validateOnly('editingTagTitle');
        $tag = Tag::find($this->editingTagID);
        $data = [
            'title' => $this->editingTagTitle,
            'slug'  => Str::slug($this->editingTagTitle),

        ];
        $tag->update($data);

        $this->reset('editingTagTitle', 'title');
        $this->statusUpdate = false;
        $this->dispatch('tagUpdated');
    }

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'title' => 'Title',
        ];
    }

    public function sortBy($column)
    {
        $this->sortColumn = $column;

        $this->sortDirection = $this->reverseSort();
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

    public function mount()
    {
        $this->fill(request()->only('search', 'currentPage'));
        $this->resetSearch();
        $this->headersTable = $this->headerConfig();
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function getTagQueryProperty()
    {

        return Tag::orderBy($this->sortColumn, $this->sortDirection)
            ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getTagProperty()
    {
        return $this->tagQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->tag->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->checked = $this->tagQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function tagStored($tag)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer' => 5000,
            'icon' => 'success',
            'text' => 'Tag ' . $tag['title'] . ' was Stored',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton' => false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function selectItem($itemId, $action)
    {
        $this->statusUpdate = false;

        $this->selectedItem = $itemId;
        if ($action == 'delete') {
            // This will show the modal in the frontend
            $this->dispatch('openDeleteModal');
        } elseif ($action == 'show') {
            $this->dispatch('getModelId', $this->selectedItem);
            // This will show the openShowModal in the frontend
            $this->dispatch('openShowModal');
        } elseif ($action == 'edit') {
            $this->statusUpdate = true;
            $this->dispatch('getModelId', $this->selectedItem);
        } else {
            $this->dispatch('getModelId', $this->selectedItem);
            // This will show the openUpdateModal in the frontend
            $this->dispatch('openEditModal');
        }
    }

    public function deleteRecords()
    {
        Tag::whereKey($this->checked)->delete();

        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon' => 'success',
            'text' => 'Selected Records were deleted Successfully',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton' => false,
        ]);
        $this->dispatch('refreshParent');
        $this->dispatch('closeDeleteModalAll');
    }

    // Delete Single Record
    public function delete()
    {
        $mastertag = Tag::where('masterstatus', 1)->first();

        $postsubcategory = Tag::find($this->selectedItem);

        if ($postsubcategory->masterstatus == config('cms.default_mastertag')) {
            $this->dispatch('swal:modaldelete', [
                'title' => 'Importan!',
                'timer' => 4000,
                'type'  => 'warning',
                'text'  => 'Tag cannot deleted',
                // 'toast'=>true, // Jika mau menggunakan toas
                // 'position'=>'top-right', // Jika mau menggunakan toas
                'showConfirmButton' => true,
                'showCancelButton'  => false,
            ]);
            $this->dispatch('refreshParent');
            $this->dispatch('closeDeleteModal');
        } else {

            if ($postsubcategory->posts->count() <> 0) {
                // Update posts yang postsubcategory_id dihapus ke postsubcategory_id master

                // Posttags::where('postsubcategory_id', $postsubcategory->id)->update(['postsubcategory_id' => $mastertag->id]);

            }

            Tag::destroy($this->selectedItem);

            // Sweet alert
            $this->dispatch('swal:modal', [
                'title' => 'Deleted Success!',
                'timer' => 4000,
                'icon'  => 'success',
                'text'  => 'Tag was deleted',
                // 'toast'=>true, // Jika mau menggunakan toas
                // 'position'=>'top-right', // Jika mau menggunakan toas
                'showConfirmButton' => true,
                'showCancelButton'  => false,
            ]);

            $this->dispatch('refreshParent');
            // This will hide the modal in the frontend
            $this->dispatch('closeDeleteModal');
        }
    }

    #[Title('Tag List')]
    public function render()
    {
        return view('livewire.backend.tag.index', [
            'datatag' => $this->tag,
            'title' => 'Tag List'
        ]);
    }
}