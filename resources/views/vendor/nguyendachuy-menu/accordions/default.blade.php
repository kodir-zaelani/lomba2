@php
$id = rand(100000, 999999);
@endphp

<div class="accordion-item">
    <h2 class="accordion-header" id="heading-{{$id}}">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$id}}" aria-expanded="false" aria-controls="collapseOne">
            {{$name}}
        </button>
    </h2>
    <div id="collapseOne{{$id}}" class="accordion-collapse collapse @isset($show) show @endisset" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <form method="get" action="">
                <div class="form-group">
                    @foreach ($urls as $key => $item)
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" id="menu-link-{{$id}}-{{$key}}"
                            name="menu_id"
                            value="{{$item['url']}}"
                            data-icon="{{$item['icon']}}"
                            data-url="{{$item['url']}}"
                            data-label="{{$item['label']}}">
                            <label for="menu-link-{{$id}}-{{$key}}">{{$item['label']}}</label>
                        </div>
                    </div>
                    @endforeach
                    <!-- <select name="pages" class="form-control data-select" required> -->
                        {{-- <select name="pages[]" multiple class="form-control data-select" required>
                            @foreach ($urls as $item)
                            <option
                            value="{{$item['url']}}"
                            data-icon="{{$item['icon']}}"
                            data-url="{{$item['url']}}"
                            >{{$item['label']}}</option>
                            @endforeach
                        </select> --}}
                    </div>
                    @if(!empty($roles))
                    <div class="form-group">
                        <label for="role">Example select</label>
                        <select class="form-control" name="role">
                            <option value="0">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->$role_pk }}">
                                {{ ucfirst($role->$role_title_field) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <button type="button" onclick="addItemMenu(this, 'custom')"
                        class="float-right mb-2 mr-2 btn btn-info btn-sm">
                        Add to Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
