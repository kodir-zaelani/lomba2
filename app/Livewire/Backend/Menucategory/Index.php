<?php

namespace App\Livewire\Backend\Menucategory;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithPagination;
use NguyenHuy\Menu\Models\Menus;

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

    public function render()
    {
        $datamenu = Menus::all();

        dd($datamenu);

        return view('livewire.backend.menu.index',[
            'datamenu' => $datamenu,
        ]);
    }

}
