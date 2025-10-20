<?php

namespace App\Livewire\Backend\Permission;

use Livewire\Component;
use App\Models\Permission;
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
    public $headersTable;
    public $action;
    public $selectedItem;

    public $name;
    public $description;
    public $modelId;



    protected $queryString = [
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'name'        => 'Name',
            'description' => 'Description',
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

    public function getPermissionQueryProperty()
    {
        return Permission::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getPermissionProperty()
    {
        return $this->permissionQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->permission->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->permissionQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function permissionStored($permission)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Pemission ' . $permission['name'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function permissionUpdated($permission)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Permission ' . $permission['name'] . ' was Updated',
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
        }
    }

    public function deleteRecords()
    {
        Permission::whereKey($this->checked)->delete();

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
        Permission::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Permission was deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);

        $this->resetSearch();

        $this->dispatch('refresh-the-component');
        // This will hide the modal in the frontend
        $this->dispatch('closeDeleteModal');
        session()->flash('danger', 'Delete Permission Successfully');

    }

    #[On('refresh-the-component')]
    public function refreshTheComponent()
    {
        // need to do Refresh this component after listen
    }
    public function store()
    {
        $validateData = [
            'name' => 'required|min:2|unique:permissions,name',
        ];

        // Default data
        $data = [
            'name'        => $this->name,
            'description' => $this->description,
        ];

        $this->validate($validateData);

        $pemission = Permission::create($data);

        session()->flash('success', 'Create Permission Successfully');

        // This is to reset our public variables
        $this->cleanVars();
        $this->dispatch('refresh-the-component');
    }
    public function edit($permissionID)
    {
        $this->statusUpdate = true;
        $this->modelId = $permissionID;

        $model = Permission::find($this->modelId);

        $this->name = $model->name;
        $this->description = $model->description;
    }

    public function cancelEdit()
    {
        $this->statusUpdate = false;
    }

    public function update()
    {
        $validateData = [
            'name' => 'required|min:2',
            'description' => 'required|min:2',
        ];

        // Default data
        $data = [
            'name'        => $this->name,
            'description' => $this->description,
        ];

        $this->validate($validateData);
        $pemission = Permission::find($this->modelId);

        $pemission->update($data);

        session()->flash('warning', 'Update Permission Successfully');
        // This is to reset our public variables
        $this->cleanVars();
        $this->statusUpdate = false;
        $this->dispatch('refresh-the-component');
    }

    private function cleanVars()
    {
        // Kosongkan field input
        $this->name        = null;
        $this->description = null;
    }

    public function render()
    {
        return view('livewire.backend.permission.index', [
            'datapermission' => $this->permission,
        ]);
    }
}