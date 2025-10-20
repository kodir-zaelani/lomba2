<li data-id="{{$m['id']}}" class="mb-2 dd-item">
    <div class="accordion-item">
        <span class="ms-1 dd-handle"><i class="pt-3 fa fa-arrows" aria-hidden="true"></i></span>
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$m['id']}}" aria-expanded="false" aria-controls="flush-collapse{{$m['id']}}">
                {{$m['label']}}
            </button>
        </h2>
        <div id="flush-collapse{{$m['id']}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushMenu">
            <div class="accordion-body">
                <div class="menu-item-settings" id="menu-item-settings-{{$m['id']}}">
                <input type="hidden" class="edit-menu-item-id" name="menuid_{{$m['id']}}" value="{{$m['id']}}" />
                <div class="form-group">
                    <label for="">Label</label>
                    <input id="label-menu-{{$m['id']}}" class="form-control edit-menu-item-title"
                    name="label-menu-{{$m['id']}}" value="{{$m['label']}}">
                </div>
                <div class="form-group">
                    <label for="">Url</label>
                    <input id="url-menu-{{$m['id']}}" class="form-control edit-menu-item-url"
                    name="url-menu-{{$m['id']}}" value="{{$m['link']}}">
                </div>
                <div class="form-group">
                    <label for="">Class CSS (optional)</label>
                    <input id="clases-menu-{{$m['id']}}" class="form-control edit-menu-item-classes"
                    name="clases-menu-{{$m['id']}}" value="{{$m['class']}}">
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <input id="icon-menu-{{$m['id']}}" class="form-control edit-menu-item-icon"
                    name="icon-menu-{{$m['id']}}" value="{{$m['icon']}}">
                </div>
                @if(!empty($roles))
                <div class="form-group">
                    <label for="edit-menu-item-role-{{$m['id']}}">Role</label>
                    <select id="role_menu_{{$m['id']}}" class="form-control edit-menu-item-role"
                    name="role_menu_[{{$m['id']}}]" >
                    <option value="0">Select Role</option>
                    @foreach($roles as $role)
                    <option @if($role->id == $m['role_id']) selected @endif value="{{ $role->$role_pk }}">
                        {{ ucwords($role->$role_title_field) }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif
            </div>
            <div class="form-group">
                @php
                $target = [
                '_self' => 'Open link directly',
                '_blank' => 'Open link in new tab',
                ]
                @endphp
                <label for="">Target</label>
                <select name="target" class="form-control edit-menu-item-target" id="target-menu-{{$m['id']}}">
                    @foreach ($target as $key => $item)
                    <option value="{{$key}}" @if($key == $m['target']) selected @endif>{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2 form-group">
                <button type="button" onclick="deleteItem({{$m['id']}})" class="btn btn-danger btn-sm"
                id="delete-{{$m['id']}}" href="javascript:void(0)">Delete</button>
                <button type="button" onclick="updateItem({{$m['id']}})" class="btn btn-primary btn-sm"
                id="update-{{$m['id']}}" href="javascript:void(0)">Update item</button>
            </div>
        </div>
    </div>
    {{-- <div class="card-header">
        <span class="dd-handle"><i class="fa fa-arrows" aria-hidden="true"></i></span>
        <span class="item-title">
            <span class="menu-item-title font-weight-bold">
                {{$m['label']}}
            </span>
            /
            <span class="menu-item-link font-weight-light">
                {{ \Illuminate\Support\Str::limit($m['link'], $limit = 30, $end = '...') }}
            </span>
            <span style="color: transparent;">|{{$m['id']}}|</span>
        </span>
        <div class="float-right card-link" data-toggle="collapse" href="#collapse{{$m['id']}}">
            <span class="item-controls">
                <span class="item-type">Link <i class="fa fa-angle-down narrow-icon" aria-hidden="true"></i></span>
            </span>
        </div>
    </div> --}}
    {{-- @if($key == 0) show @endif --}}
    {{-- <div id="collapse{{$m['id']}}" class="collapse " data-parent="#accordion">
        <div class="card-body">
            <div class="menu-item-settings" id="menu-item-settings-{{$m['id']}}">
                <input type="hidden" class="edit-menu-item-id" name="menuid_{{$m['id']}}" value="{{$m['id']}}" />
                <div class="form-group">
                    <label for="">Label</label>
                    <input id="label-menu-{{$m['id']}}" class="form-control edit-menu-item-title"
                    name="label-menu-{{$m['id']}}" value="{{$m['label']}}">
                </div>
                <div class="form-group">
                    <label for="">Url</label>
                    <input id="url-menu-{{$m['id']}}" class="form-control edit-menu-item-url"
                    name="url-menu-{{$m['id']}}" value="{{$m['link']}}">
                </div>
                <div class="form-group">
                    <label for="">Class CSS (optional)</label>
                    <input id="clases-menu-{{$m['id']}}" class="form-control edit-menu-item-classes"
                    name="clases-menu-{{$m['id']}}" value="{{$m['class']}}">
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <input id="icon-menu-{{$m['id']}}" class="form-control edit-menu-item-icon"
                    name="icon-menu-{{$m['id']}}" value="{{$m['icon']}}">
                </div>
                @if(!empty($roles))
                <div class="form-group">
                    <label for="edit-menu-item-role-{{$m['id']}}">Role</label>
                    <select id="role_menu_{{$m['id']}}" class="form-control edit-menu-item-role"
                    name="role_menu_[{{$m['id']}}]" >
                    <option value="0">Select Role</option>
                    @foreach($roles as $role)
                    <option @if($role->id == $m['role_id']) selected @endif value="{{ $role->$role_pk }}">
                        {{ ucwords($role->$role_title_field) }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                @php
                $target = [
                '_self' => 'Open link directly',
                '_blank' => 'Open link in new tab',
                ]
                @endphp
                <label for="">Target</label>
                <select name="target" class="form-control edit-menu-item-target" id="target-menu-{{$m['id']}}">
                    @foreach ($target as $key => $item)
                    <option value="{{$key}}" @if($key == $m['target']) selected @endif>{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="button" onclick="deleteItem({{$m['id']}})" class="btn btn-danger btn-sm"
                id="delete-{{$m['id']}}" href="javascript:void(0)">Delete</button>
                <button type="button" onclick="updateItem({{$m['id']}})" class="btn btn-primary btn-sm"
                id="update-{{$m['id']}}" href="javascript:void(0)">Update item</button>
            </div>
        </div>
    </div>
</div>--}}
@if (isset($m['child']) && count($m['child']) > 0)
<ol class="dd-list">
    @foreach($m['child'] as $_m)
    @include('nguyendachuy-menu::partials.loop-item', ['m' => $_m, 'key' => 1])
    @endforeach
</ol>
@endif
</li>
