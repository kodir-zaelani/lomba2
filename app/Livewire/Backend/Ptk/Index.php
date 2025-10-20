<?php

namespace App\Livewire\Backend\Ptk;

use App\Models\Pegawai;
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
    public $sortColumn    = 'name';
    public $statusUpdate  = false;
    public $uploadPath    = 'uploads/images/ptk';
    public $headersTable;
    public $action;
    public $selectedItem;

    public $name;
    public $description;


    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'image'        => 'Foto',
            'name'        => 'Full Name',
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

    public function getPegawaiQueryProperty()
    {

        return Pegawai::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getPegawaiProperty()
    {
        return $this->pegawaiQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->pegawai->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->pegawaiQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function pegawaiStored($pegawai)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Pegawai ' . $pegawai['name'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function pegawaiUpdated($pegawai)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Pegawai ' . $pegawai['name'] . ' was Updated',
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
       $post = Pegawai::find($this->selectedItem);

       $post->update($data);
       session()->flash('warning', 'Pegawai Change to InAcctive was successfully');

       return redirect()->to('backend/pegawais/index');
    }
    public function changeActive()
    {
       $data = [];
       $data = array_merge($data, ['status' => 1]);
       $post = Pegawai::find($this->selectedItem);

       $post->update($data);
       session()->flash('success', 'Pegawai Change to Active was successfully');
       return redirect()->to('backend/pegawais/index');
    }
    public function deleteRecords()
    {
        Pegawai::whereKey($this->checked)->delete();

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
        $masterpegawai = Pegawai::where('masterstatus', 1)->first();

        $pegawai = Pegawai::find($this->selectedItem);

        if ($pegawai->masterstatus == config('cms.default_masterpegawai')) {
            $this->dispatch('swal:modaldelete', [
                'title' => 'Importan!',
                'timer' => 4000,
                'type'  => 'warning',
                'text'  => 'Pegawai cannot deleted',
                // 'toast'=>true, // Jika mau menggunakan toas
                // 'position'=>'top-right', // Jika mau menggunakan toas
                'showConfirmButton' => true,
                'showCancelButton'  => false,
            ]);
            $this->dispatch('refreshParent');
            $this->dispatch('closeDeleteModal');

        } else {

            // Update posts yang pegawai_id dihapus ke pegawai_id master
            Post::where('author_id', $pegawai->id)->update(['author_id' => $masterpegawai->id]);

            Pegawai::destroy($this->selectedItem);

            if ($pegawai->image) {
                $this->removeImage($pegawai->image);
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
        return view('livewire.backend.ptk.index',[
            'dataptk' => $this->pegawai,
            'title' => 'Pegawai List',
        ]);
    }

}
