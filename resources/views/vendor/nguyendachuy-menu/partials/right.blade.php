<div class="mt-2 card">
    @if(request()->get('menu') != 0 && isset($menus) && count($menus) > 0)
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline" action="" method="post">
                    <div class="form-group">
                        <label for="email" class="mr-sm-2">Name: </label>
                        <input name="menu-name" id="menu-name" type="text"
                        class="form-control menu-name regular-text menu-item-textbox"  title="Enter menu name" value="@if(isset($indmenu)){{$indmenu->name}}@endif" readonly>
                    </div>
                </form>
                <hr>
            </div>
            <div class="col-md-12">
                @if(request()->get('menu') != 0 && isset($menus) && count($menus) > 0)
                <div class="p-2 jumbotron jumbotron-fluid">
                    <div class="container">
                        <h3>Menu Structure</h3>
                        <p class="lead">Place each item in the order you prefer. Click <span class="text-danger fw-bold"><i class="bi bi-chevron-down toggle-dropdown "></i></span> to the right of the item to display more configuration options.</p>
                    </div>
                </div>
                @elseif(request()->get('menu') == 0)
                <div class="p-2 jumbotron jumbotron-fluid">
                    <div class="container">
                        <h3>Menu Select</h3>
                        <p class="lead">Please select menu button</p>
                    </div>
                </div>
                @else
                <div class="p-2 jumbotron jumbotron-fluid">
                    <div class="container">
                        <h3>Create Menu Item</h3>
                        <p class="lead"></p>
                    </div>
                </div>
                @endif
                {{-- <div class="card"> --}}
                    @if(isset($menus) && count($menus) > 0)
                    <div class="dd nestable-menu" id="nestable">
                        <ol class="dd-list">
                            @foreach($menus as $key => $m)
                            @include('nguyendachuy-menu::partials.loop-item', ['key' => $key])
                            @endforeach
                        </ol>
                    </div>
                    @endif
                {{-- </div> --}}
            </div>
        </div>
    </div>
    @endif
    @if(request()->get('menu') != 0)
    <div class="card-footer">
        <div class="row">
            <div class="col-6">
                @if(isset($menus) && count($menus) > 0)
                <button type="button" class="btn btn-success btn-sm"
                onclick="updateItem()" href="javascript:void(9)">Update All Item
            </button>
            @endif
        </div>
        {{-- <div class="col-6 text-end">
            <button type="button" class="btn btn-danger btn-sm submitdelete deletion menu-delete"
            onclick="deleteMenu()" href="javascript:void(9)">Delete Menu
        </button> --}}
    </div>
</div>



</div>
@endif
</div>
