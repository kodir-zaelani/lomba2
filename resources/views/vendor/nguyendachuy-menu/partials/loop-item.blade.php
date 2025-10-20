<li data-id="{{$m['id']}}" class="dd-item">
    <div class="pb-2 box-header">
        <span class="dd-handle d-inline"><i class="fa fa-arrows" aria-hidden="true"></i></span>
        <span class="fw-bold @if ($m['status'] == 0) text-danger @endif">
            {{$m['label']}} @if ($m['status'] == 0) (Non Aktif) @endif
        </span>
        <div class="box-controls">
            <span class="item-type" data-bs-toggle="collapse" data-bs-target="#collapse-{{$m['id']}}" style="cursor: pointer;">Detail <i class="fa fa-angle-down narrow-icon" aria-hidden="true"></i></span>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item no-border">
            <div id="collapse-{{$m['id']}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="menu-item-settings" id="menu-item-settings-{{$m['id']}}">
                        <input type="hidden" class="edit-menu-item-id" name="menuid_{{$m['id']}}" value="{{$m['id']}}" />
                        <div class="form-group">
                            <label for="" >Label</label>
                            <input id="label-menu-{{$m['id']}}" class="form-control edit-menu-item-title"
                            name="label-menu-{{$m['id']}}" value="{{$m['label']}}">
                        </div>
                        <div class="form-group">
                            <label for="">Url</label>
                            <input id="url-menu-{{$m['id']}}" class="form-control edit-menu-item-url" name="url-menu-{{$m['id']}}" value="{{$m['link']}}">
                        </div>
                        <div class="form-group">
                            <label for="">Class CSS (optional)</label>
                            <input id="clases-menu-{{$m['id']}}" class="form-control edit-menu-item-classes" name="clases-menu-{{$m['id']}}" value="{{$m['class']}}">
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input id="icon-menu-{{$m['id']}}" class="form-control edit-menu-item-icon" name="icon-menu-{{$m['id']}}" value="{{$m['icon']}}">
                            <small>
                                <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-bootstrap"></i> Select Icon Bootsrap
                                </a>
                            </small>
                        </div>
                        @if(!empty($roles))
                        <div class="form-group">
                            <label for="edit-menu-item-role-{{$m['id']}}">Role</label>
                            <select id="role_menu_{{$m['id']}}" class="form-control edit-menu-item-role" name="role_menu_[{{$m['id']}}]" >
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
                            @php
                            $status = [
                            1 => 'Active',
                            0 => 'In Active',
                            ]
                            @endphp
                            <label for="">Status</label>
                            <select name="status" class="form-control edit-menu-item-status" id="status-menu-{{$m['id']}}">
                                @foreach ($status as $key => $item)
                                <option value="{{$key}}" @if($key == $m['status']) selected @endif>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2 form-group">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" onclick="updateItem({{$m['id']}})" class="btn btn-primary btn-sm"
                                    id="update-{{$m['id']}}" href="javascript:void(0)">Update item</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" onclick="deleteItem({{$m['id']}})" class="ms-auto btn btn-danger btn-sm"
                                    id="delete-{{$m['id']}}" href="javascript:void(0)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (isset($m['child']) && count($m['child']) > 0)
    <ol class="dd-list">
        @foreach($m['child'] as $_m)
        @include('nguyendachuy-menu::partials.loop-item', ['m' => $_m, 'key' => 1])
        @endforeach
    </ol>
    @endif
</li>
