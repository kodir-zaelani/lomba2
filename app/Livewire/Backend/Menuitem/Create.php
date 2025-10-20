<?php

namespace App\Livewire\Backend\Menuitem;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Album;
use App\Models\Video;
use Livewire\Component;
use App\Models\Menuitem;
use App\Models\Postcategory;

class Create extends Component
{
    public $label;
    public $status;
    public $link;
    public $menu;
    public $type;
    public $target;

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
        $this->cleanVars();
        $this->resetErrorBag();
        $this->resetValidation();

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

    public function render()
    {
        return view('livewire.backend.menuitem.create',[
            'menus' => Menu::orderBy('name', 'asc')->get(),
            'pages' => Page::orderBy('title', 'asc')->where('status', 1)->get(),
            'albums' => Album::orderBy('title', 'asc')->where('status', 1)->get(),
            'videos' => Video::orderBy('title', 'asc')->where('status', 1)->get(),
            'postcategory' => Postcategory::orderBy('title', 'asc')->get(),
        ]);
    }
}