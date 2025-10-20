<?php

namespace App\Livewire\Backend\Pagecategory;

use Livewire\Component;
use App\Models\Pagecategory;
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
    public $headersTable;
    public $action;
    public $selectedItem;

    public $uploadPath= 'uploads/images/pagecategory';

    public $title;
    public $slug;

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'image' => 'Image',
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

    public function getPagecategoryQueryProperty()
    {

        return Pagecategory::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getPagecategoryProperty()
    {
        return $this->pagecategoryQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->pagecategory->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->pagecategoryQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
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
        Pagecategory::whereKey($this->checked)->delete();

        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer'=>4000,
            'type'=>'success',
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
        $masterpagecategory = Pagecategory::where('masterstatus', 1)->first();

        $pagecategory = Pagecategory::find($this->selectedItem);
        if ($pagecategory->masterstatus == config('cms.default_masterpagecategory')) {
            $this->dispatch('swal:modaldelete', [
                'title' => 'Importan!',
                'timer' => 4000,
                'type'  => 'warning',
                'text'  => 'Page Category cannot deleted',
                // 'toast'=>true, // Jika mau menggunakan toas
                // 'position'=>'top-right', // Jika mau menggunakan toas
                'showConfirmButton' => true,
                'showCancelButton'  => false,
            ]);

            $this->dispatch('refreshParent');
            $this->dispatch('closeDeleteModal');

        } else {

            if ($pagecategory->pages->count() <> 0) {
                // Update pages yang pagecategory_id dihapus ke pagecategory_id master
                Page::where('pagecategory_id', $pagecategory->id)->update(['pagecategory_id' => $masterpagecategory->id]);
            }

            Pagecategory::destroy($this->selectedItem);

            if ($pagecategory->image) {
                $this->removeImage($pagecategory->image);
            }

            // Sweet alert
            $this->dispatch('swal:modal', [
                'title' => 'Deleted Success!',
                'timer' => 4000,
                'type'  => 'success',
                'text'  => 'Page Category was deleted',
                // 'toast'=>true, // Jika mau menggunakan toas
                // 'position'=>'top-right', // Jika mau menggunakan toas
                'showConfirmButton' => true,
                'showCancelButton'  => false,
            ]);

            // This will hide the modal in the frontend
            $this->dispatch('closeDeleteModal');

            return redirect()->route('backend.pagecategories.index')->with(['warning' => 'Delete Page Category ' . $pagecategory['title'] . ' was successfully!']);
        }
    }


    // function remove image
    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath     = $this->uploadPath . '/' . $image;

            $ext           = substr(strrchr($image, '.'), 1);

            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;


            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    public function render()
    {
        return view('livewire.backend.pagecategory.index',[
            'datapagecategory' => $this->pagecategory,
            'titlepage' => 'Page Category'
        ]);
    }
}
