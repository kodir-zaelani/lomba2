<?php

namespace App\Livewire\Backend\Menuitem;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Album;
use App\Models\Video;
use Livewire\Component;
use App\Models\Menuitem;
use Livewire\Attributes\On;
use App\Models\Postcategory;
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
    public $sortColumn    = 'id';
    public $statusUpdate  = 0;
    public $statusCreate  = 0;
    public $headersTable;
    public $action;
    public $selectedItem;

    public $label;
    public $status;
    public $link;
    public $menu;
    public $type;
    public $linkid;
    public $target;
    public $urlnow;
    public $prevlink;
    public $editMenuitemId;

    public function store()
    {
        $validateData = [
            'label'  => 'required|min:2',
            'menu'   => 'required',
            'type'   => 'required',
            'target' => 'required',
            'link'   => 'required',
        ];

        $this->urlnow = config('app.url');


        // if ($this->link == '/') {
        //     $basicurl = $this->urlnow;
        // } else {
        //     $basicurl = $this->urlnow.'/'.$this->link;
        // }

        // if ($this->type == "custom_ex") {
        //     $blink   = $this->link;
        // } else {
        //     $blink   = $basicurl;
        // }

        // Default data
        $data = [
            'label'  => $this->label,
            'menu'   => $this->menu,
            'type'   => $this->type,
            'target' => $this->target,
            'link'   => $this->link ,
            'status' => 1,
        ];
        $this->validate($validateData);

        $menuitem = Menuitem::create($data);
        return redirect()->to('backend/menuitem')->with('success', 'Menu item  ' . $menuitem['name'] . '  Create was successfully');

        // This is to reset our public variables
         $this->statusUpdate = false;
        $this->statusCreate = false;
        $this->cleanVars();
        $this->resetErrorBag();
        $this->resetValidation();

    }

    #[On('menuitem-created')]
    private function menuitemAdded()
    {
        session()->flash('success', 'Menu item  Create was successfully');
    }

    #[On('menuitem-updated')]
    private function menuitemUpdate()
    {
        return redirect()->route('backend.menuitem.index')->with('success', 'Menu item  Updated was successfully');
    }
    private function cleanVars()
    {
        // Kosongkan field input
        $this->label  = null;
        $this->link   = null;
        $this->menu   = null;
        $this->type   = null;
        $this->linkid = null;
        $this->target = null;
    }
    public function selectCancel($action)
    {
        $this->statusCreate = false;
        $this->statusUpdate = false;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function edit($menuitemID)
    {
        $this->statusUpdate   = true;
        $this->statusCreate   = false;
        $this->editMenuitemId = $menuitemID;

        $model = Menuitem::find($this->editMenuitemId);

        $this->label    = $model->label;
        $this->link     = $model->link;
        $this->menu     = $model->menu;
        $this->type     = $model->type;
        $this->prevlink = $model->link;
        $this->target   = $model->target;
    }

    public function update()
    {
        $validateData = [
            'label'  => 'required|min:2',
            'type'   => 'required',
            'menu'   => 'required',
            'link'   => 'required',
            'target' => 'required',
        ];

        // Default data
        $data = [
            'label'  => $this->label,
            'type'   => $this->type,
            'menu'   => $this->menu,
            'target' => $this->target,
            'link'   => $this->link,
        ];
        // $this->urlnow = config('app.url');

        // if ($this->link == '/') {
        //     $basicurl = $this->urlnow;
        // } else {
        //     $basicurl = $this->urlnow.'/'.$this->link;
        // }

        // if ($this->type == 9) {
        //     $blink   = $this->link;
        //     $data = array_merge($data, [
        //         'link'   => $blink,
        //     ]);
        // } elseif ($this->type == 1) {
        //     if ($this->prevlink == $this->link) {
        //         $data = array_merge($data, [
        //             'link'   => $this->prevlink,
        //         ]);
        //     } else {
        //         $blink   = $basicurl;
        //         $data = array_merge($data, [
        //             'link'   => $blink,
        //         ]);
        //     }
        // }

        // Just add validation if there are any changes in the fields
        $this->validate($validateData);

        $menuitem = Menuitem::find($this->editMenuitemId);

        $menuitem->update($data);
        session()->flash('warning', 'Menuitem Change Updated was successfully');
        return redirect()->to('backend/menuitem');

    }

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'label' => 'Title',
            // 'parent' => 'Parent',
            'menu'  => 'Position',
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
         $this->statusUpdate = false;
        $this->statusCreate = false;
        $this->cleanVars();
        $this->resetErrorBag();
        $this->resetValidation();

    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getMenuitemQueryProperty()
    {

        return Menuitem::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getMenuitemProperty()
    {
        return $this->menuitemQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->menuitem->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->menuitemQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function menuitemStored($menuitem)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Menu Item ' . $menuitem['label'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->statusUpdate = 0;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function menuitemUpdated($menuitem)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Menu Item ' . $menuitem['label'] . ' was Updated',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
        ]);
        $this->statusUpdate = 0;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function selectItem($itemId, $action)
    {
        $this->statusUpdate = 0;

        $this->selectedItem = $itemId;
        if ($action == 'delete') {
            // This will show the modal in the frontend
            $this->dispatch('openDeleteModal');
        } elseif ($action == 'edit') {
            $this->statusUpdate = 1;
            $this->dispatch('getModelId', $this->selectedItem);
        } elseif ($action == 'add') {
            $this->statusUpdate = 0;
            $this->statusCreate = 1;
        }  elseif ($action == 'inactive'){
            $this->changeInactive();
        } elseif ($action == 'active') {
            $this->changeActive();
        }
    }
    public function changeInactive()
    {
        $data = [];
        $data = array_merge($data, ['status' => 0]);
        $post = Menuitem::find($this->selectedItem);

        $post->update($data);
        session()->flash('warning', 'Menuitem Change to InAcctive was successfully');
        return redirect()->to('backend/menuitem');
    }
    public function changeActive()
    {
        $data = [];
        $data = array_merge($data, ['status' => 1]);
        $post = Menuitem::find($this->selectedItem);

        $post->update($data);
        session()->flash('success', 'Menuitem Change to Active was successfully');
        return redirect()->to('backend/menuitem');
    }

    public function delete()
    {
        Menuitem::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Menu Items was deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);

        $this->dispatch('refreshParent');
        // This will hide the modal in the frontend
        $this->dispatch('closeDeleteModal');
    }

    public function render()
    {
        return view('livewire.backend.menuitem.index',[
            'datamenuitem' => $this->menuitem,
            'menus' => Menu::orderBy('name', 'asc')->get(),
            'pages' => Page::orderBy('title', 'asc')->where('status', 1)->get(),
            'albums' => Album::orderBy('title', 'asc')->where('status', 1)->get(),
            'videos' => Video::orderBy('title', 'asc')->where('status', 1)->get(),
            'postcategory' => Postcategory::orderBy('title', 'asc')->get(),
        ]);
    }

}
