<?php

namespace App\Livewire\Backend\Socialmedia;

use Livewire\Component;
use App\Models\Socialmedia;
use Illuminate\Support\Str;
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
    public $sortColumn    = 'name';
    public $statusUpdate  = false;
    public $headersTable;
    public $action;
    public $selectedItem;

    public $url;
    public $icon;
    public $scriptembed;
    public $editingSocialmediaIcon;
    public $editingSocialmediaUrl;
    public $editingSocialmediascriptembed;

    #[Rule('required|min:2|unique:socialmedias,name')]
    public $name;

    public $editingSocialmediaID;

    #[Rule('required|min:2|unique:socialmedias,name')]
    public $editingSocialmediaName;

    public function store()
    {
        $validateData = [
            'name' => 'required|min:2|unique:socialmedias,name',
        ];

        $this->validate($validateData);
        // Default data
        $data = [
            'name'       => $this->name,
            'slug'        => Str::slug($this->name),
            'icon'        => $this->icon,
            'url'         => $this->url,
            'scriptembed' => $this->scriptembed,

        ];

        $socialmedia = Socialmedia::create($data);

        // even listener -> dispatch
        $this->reset('name');
        $this->reset('icon');
        $this->reset('url');
        $this->reset('scriptembed');
        $this->statusUpdate = false;
        $this->dispatch('socialmediaStored', $socialmedia);
        // This is to reset our public variables
    }

    #[On('socialmediaStored')]
    public function updateList($socialmedia)
    {
        session()->flash('success', 'Add Socialmedia Successfully');
        // dd($socialmedia);
    }

    #[On('socialmediaUpdated')]
    public function socialmediaUpdated()
    {
        // dd('Update');
        session()->flash('success', 'Update Socialmedia  Successfully');
    }

    public function edit($socialmediaID)
    {
        $this->statusUpdate = true;
        $this->editingSocialmediaID = $socialmediaID;

        $model = Socialmedia::find($this->editingSocialmediaID);

        $this->editingSocialmediaName = $model->name;
        $this->editingSocialmediaIcon = $model->icon;
        $this->editingSocialmediaUrl = $model->url;
        $this->editingSocialmediascriptembed = $model->scriptembed;
    }

    public function cancelEdit()
    {
        $this->statusUpdate = false;
        $this->search = '';
        $this->resetPage();

    }

    public function update()
    {
        $this->validateOnly('editingSocialmediaName');
        $socialmedia = Socialmedia::find($this->editingSocialmediaID);
        $data = [
            'name' => $this->editingSocialmediaName,
            'slug'  => Str::slug($this->editingSocialmediaName),
            'icon' => $this->editingSocialmediaIcon,
            'url' => $this->editingSocialmediaUrl,
            'scriptembed' => $this->editingSocialmediascriptembed,

        ];
        $socialmedia->update($data);

        $this->reset('editingSocialmediaName', 'name');
        $this->reset('editingSocialmediaIcon', 'icon');
        $this->reset('editingSocialmediaUrl', 'url');
        $this->reset('editingSocialmediascriptembed', 'scriptembed');
        $this->statusUpdate = false;
        $this->dispatch('socialmediaUpdated');
    }

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'name' => 'Name',
            'icon' => 'Icon',
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

    public function getSocialmediaQueryProperty()
    {

        return Socialmedia::orderBy($this->sortColumn, $this->sortDirection)
            ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getSocialmediaProperty()
    {
        return $this->socialmediaQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->socialmedia->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->socialmediaQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function socialmediaStored($socialmedia)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'name' => 'Success!',
            'timer' => 5000,
            'icon' => 'success',
            'text' => 'Socialmedia ' . $socialmedia['name'] . ' was Stored',
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
        Socialmedia::whereKey($this->checked)->delete();

        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        // Sweet alert
        $this->dispatch('swal:modal', [
            'name' => 'Deleted Success!',
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
        $mastersocialmedia = Socialmedia::where('masterstatus', 1)->first();

        $postsubcategory = Socialmedia::find($this->selectedItem);

        if ($postsubcategory->masterstatus == config('cms.default_mastersocialmedia')) {
            $this->dispatch('swal:modaldelete', [
                'name' => 'Importan!',
                'timer' => 4000,
                'type'  => 'warning',
                'text'  => 'Socialmedia cannot deleted',
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

                // Postsocialmedias::where('postsubcategory_id', $postsubcategory->id)->update(['postsubcategory_id' => $mastersocialmedia->id]);

            }

            Socialmedia::destroy($this->selectedItem);

            // Sweet alert
            $this->dispatch('swal:modal', [
                'name' => 'Deleted Success!',
                'timer' => 4000,
                'icon'  => 'success',
                'text'  => 'Socialmedia was deleted',
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

    #[Title('Socialmedia List')]
    public function render()
    {
        return view('livewire.backend.socialmedia.index', [
            'datasocialmedia' => $this->socialmedia,
            'name' => 'Socialmedia List'
        ]);
    }

}
