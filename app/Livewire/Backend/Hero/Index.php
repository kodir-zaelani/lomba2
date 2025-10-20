<?php

namespace App\Livewire\Backend\Hero;

use App\Models\Hero;
use Livewire\Component;
use Livewire\WithPagination;

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
    public $uploadPath    = 'uploads/images/heros';
    public $headersTable;
    public $action;
    public $selectedItem;

    public $title;
    public $description;


    protected $listeners = [
        'heroStored',
        'heroUpdated',
    ];

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'imagehero'        => 'Image',
            'title'        => 'Title',
            // 'email' => 'Email Address',
            'status' => 'Status',
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

    public function getHeroQueryProperty()
    {

        return Hero::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getHeroProperty()
    {
        return $this->heroQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->hero->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->heroQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function heroStored($hero)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Hero ' . $hero['name'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function heroUpdated($hero)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Hero ' . $hero['name'] . ' was Updated',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->statusUpdate = false;
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
        } elseif ($action == 'inactive'){
            $this->changeInactive();
        } elseif ($action == 'active') {
            $this->changeActive();
        }
    }
    public function changeInactive()
    {
       $data = [];
       $data = array_merge($data, ['status' => 0]);
       $post = Hero::find($this->selectedItem);

       $post->update($data);
       session()->flash('warning', 'Hero Change to InAcctive was successfully');

       return redirect()->to('backend/heros/index');
    }
    public function changeActive()
    {
       $data = [];
       $data = array_merge($data, ['status' => 1]);
       $post = Hero::find($this->selectedItem);

       $post->update($data);
       session()->flash('success', 'Hero Change to Active was successfully');
       return redirect()->to('backend/heros/index');
    }
    public function deleteRecords()
    {
        Hero::whereKey($this->checked)->delete();

        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer'=>4000,
            'icon'=>'success',
            'text'=>'Selected Records were deleted Successfully',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->dispatch('refreshParent');
        $this->dispatch('closeDeleteModalAll');
    }

    // Delete Single Record
    public function delete()
    {
        $masterhero = Hero::where('masterstatus', 1)->first();

        $hero = Hero::find($this->selectedItem);

        if ($hero->masterstatus == config('cms.default_masterhero')) {
            $this->dispatch('swal:modaldelete', [
                'title' => 'Importan!',
                'timer' => 4000,
                'type'  => 'warning',
                'text'  => 'Hero cannot deleted',
                // 'toast'=>true, // Jika mau menggunakan toas
                // 'position'=>'top-right', // Jika mau menggunakan toas
                'showConfirmButton' => true,
                'showCancelButton'  => false,
            ]);
            $this->dispatch('refreshParent');
            $this->dispatch('closeDeleteModal');

        } else {

            // Update posts yang hero_id dihapus ke hero_id master
            Post::where('author_id', $hero->id)->update(['author_id' => $masterhero->id]);

            Hero::destroy($this->selectedItem);

            if ($hero->image) {
                $this->removeImage($hero->image);
            }

            // Sweet alert
            $this->dispatch('swal:modaldelete', [
                'title' => 'Deleted Success!',
                'timer' => 4000,
                'type'  => 'success',
                'text'  => 'Post Category was deleted',
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
    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath     = $this->uploadPath . '/' . $image;
            $thumbnailPath = $this->uploadPath . '/images_thumb/' . $image;

            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
    }

    public function render()
    {
        return view('livewire.backend.hero.index',[
            'datahero' => $this->hero,
            'title' => 'Hero List',
        ]);
    }

}