<?php

namespace App\Livewire\Backend\Dukungan;

use Livewire\Component;
use App\Models\Dukungan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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
    public $sortDirection = 'desc';
    public $sortColumn    = 'created_at';
    public $statusUpdate  = false;
    public $headersTable;
    public $action;
    public $selectedItem;
    public $uploadPath= 'uploads/images/dukungans';

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
            'title'      => 'Title',
            // 'created_at' => 'Created',
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

    public function getDukunganallQueryProperty()
    {

        return Dukungan::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getDukunganallProperty()
    {
        return $this->dukunganallQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->dukunganall->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->dukunganallQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function dukunganStored($dukungan)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Page Category ' . $dukungan['title'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function dukunganUpdated($dukungan)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Page Category ' . $dukungan['title'] . ' was Updated',
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
        } elseif ($action == 'imageinactive') {
            $this->changeImageinactive();
        } elseif ($action == 'imageactive') {
            $this->changeImageActive();
        } elseif ($action == 'imageremove') {
            // This will show the modal in the frontend
            $this->dispatch('openmodalFormRemoveImage');
        }
    }
    public function changeInactive()
    {
        $data = [];
        $data = array_merge($data, ['status' => 0]);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        $dukungan = Dukungan::find($this->selectedItem);

        $dukungan->update($data);
        session()->flash('success', 'Page Change to Draft was successfully');
        return redirect()->to('backend/dukungans');
    }
    public function changeActive()
    {
        $data = [];
        $data = array_merge($data, ['status' => 1]);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        $dukungan = Dukungan::find($this->selectedItem);

        $dukungan->update($data);
        session()->flash('success', 'Page Change to Publish was successfully');
        return redirect()->to('backend/dukungans');
    }

    public function changeImageinactive()
    {
        $data = [];
        $data = array_merge($data, ['masterstatus' => 1]);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        $page = Dukungan::find($this->selectedItem);

        $page->update($data);
        session()->flash('success', 'Image Dukungan Change to unPublish was successfully');
        return redirect()->to('backend/dukungans');
    }
    public function changeImageActive()
    {
        $data = [];
        $data = array_merge($data, ['masterstatus' => 0]);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        $page = Dukungan::find($this->selectedItem);

        $page->update($data);
        session()->flash('success', 'Image Dukungan Change to Publish was successfully');
        return redirect()->to('backend/dukungans');
    }

    public function deleteRecords()
    {
        Dukungan::whereKey($this->checked)->delete();

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
    public function remove_image()
    {
        $data = [];
        $data = array_merge($data, ['image' => NULL]);
        $dukungan = Dukungan::find($this->selectedItem);

        $dukungan->update($data);

        if ($dukungan->image) {
            $this->removeImage($dukungan->image);
        }

        $this->dispatch('closemodalFormRemoveImage');
        session()->flash('success', 'Remove Image was successfully');
        return redirect()->to('backend/dukungans');
    }

    public function delete()
    {
        $dukungan = Dukungan::find($this->selectedItem);

        if ($dukungan->image) {
            $this->removeImage($dukungan->image);
        }

        Dukungan::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Page Category was deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);

        $this->dispatch('refreshParent');
        // This will hide the modal in the frontend
        $this->dispatch('closeDeleteModal');
        return redirect()->to('backend/dukungans')->with('danger', 'Dukungan send to trash was successfully');

    }

    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath     = $this->uploadPath . '/' . $image;
            $ext           = substr(strrchr($image, '.'), 1);

            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            $watermark     = str_replace(".{$ext}", "_watermark.{$ext}", $image);
            $watermarkPath = $this->uploadPath . '/' . $watermark;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
            if (file_exists($watermarkPath)) unlink($watermarkPath);
        }
    }

    public function render()
    {
        return view('livewire.backend.dukungan.index',[
            'datadukunganall' => $this->dukunganall,
            'title_page' => 'Dukungan',
        ]);
    }

}