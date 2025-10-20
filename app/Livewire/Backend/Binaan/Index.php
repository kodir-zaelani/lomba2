<?php

namespace App\Livewire\Backend\Binaan;

use Livewire\Component;
use App\Models\Spbinaan;
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
            'sekolah_id'      => 'Satuan Pendidikan',
            'jenjangpendidikan_id'      => 'Jenjang Pendidikan',
            'dukungan_id'      => 'Prioritas Dukungan',
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

    public function getSpbinaanallQueryProperty()
    {

        return Spbinaan::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getSpbinaanallProperty()
    {
        return $this->spbinaanallQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->spbinaanall->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->spbinaanallQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function spbinaanStored($spbinaan)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Page Category ' . $spbinaan['title'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function spbinaanUpdated($spbinaan)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Page Category ' . $spbinaan['title'] . ' was Updated',
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
        $spbinaan = Spbinaan::find($this->selectedItem);

        $spbinaan->update($data);
        session()->flash('success', 'Page Change to Draft was successfully');
        return redirect()->to('backend/spbinaans');
    }
    public function changeActive()
    {
        $data = [];
        $data = array_merge($data, ['status' => 1]);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        $spbinaan = Spbinaan::find($this->selectedItem);

        $spbinaan->update($data);
        session()->flash('success', 'Page Change to Publish was successfully');
        return redirect()->to('backend/spbinaans');
    }

    public function changeImageinactive()
    {
        $data = [];
        $data = array_merge($data, ['masterstatus' => 1]);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        $page = Spbinaan::find($this->selectedItem);

        $page->update($data);
        session()->flash('success', 'Image Spbinaan Change to unPublish was successfully');
        return redirect()->to('backend/spbinaans');
    }
    public function changeImageActive()
    {
        $data = [];
        $data = array_merge($data, ['masterstatus' => 0]);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        $page = Spbinaan::find($this->selectedItem);

        $page->update($data);
        session()->flash('success', 'Image Spbinaan Change to Publish was successfully');
        return redirect()->to('backend/spbinaans');
    }

    public function deleteRecords()
    {
        Spbinaan::whereKey($this->checked)->delete();

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
        $spbinaan = Spbinaan::find($this->selectedItem);

        $spbinaan->update($data);

        if ($spbinaan->image) {
            $this->removeImage($spbinaan->image);
        }

        $this->dispatch('closemodalFormRemoveImage');
        session()->flash('success', 'Remove Image was successfully');
        return redirect()->to('backend/spbinaans');
    }

    public function delete()
    {
        $spbinaan = Spbinaan::find($this->selectedItem);

        if ($spbinaan->image) {
            $this->removeImage($spbinaan->image);
        }

        Spbinaan::destroy($this->selectedItem);

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
        return redirect()->to('backend/spbinaans')->with('danger', 'Spbinaan send to trash was successfully');

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
        return view('livewire.backend.binaan.index',[
            'dataspbinaanall' => $this->spbinaanall,
            'title_page' => 'Pendampingan',
        ]);
    }

}