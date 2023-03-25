@extends('_template.master-main')

@section('page_title', 'Master Menu')

@section('content')

@php
    $formType = ($data['menu']->id == null) ? 'Tambah' : 'Ubah';
    $iconType = ($data['menu']->id == null) ? 'fa-plus' : 'fa-edit';
    $menuType = ($data['menuType'] == null) ? null : $data['menuType'];
    $level    = (strlen($data['menu']->level) > 2) ? substr($data['menu']->level, 2, 2):$data['menu']->level;

    function get_menu_tree($list, $count = 2, $id = null) {
        $menu = '';
        foreach ($list as $row) {
            $isActive = (isset($_GET['id']) && $_GET['id'] == $row->id) ? 'active':'';
            $isDisabled = (!$row->active) ? 'disabled':'';
            $sub_level = substr($row->level, 0, 2);
            $level = ($count > 2) ? substr($row->level, 2, 2):$row->level;
            if (strlen($row->level) == $count && ($sub_level == $id || ($sub_level != $id && $count == 2))) {
                $menu .= sprintf(
                            '<li><samp class="level-badge">%s</samp><a href="?roles=%s&id=%s" class="%s %s"><i class="%s %s"></i> %s</a>',
                            $level,
                            $row->roles_id,
                            $row->id,
                            $isActive,
                            $isDisabled,
                            $row->icon_type,
                            $row->icon,
                            $row->menu
                        );
                $menu .= '<ul>'.get_menu_tree($list, $count+2, $sub_level).'</ul>';
                $menu .= '</li>';
            }
        }
        return $menu;
    }
@endphp

    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <i class="fas fa-sitemap"></i> Hierarki Menu
                    </div>
                    <div class="card-body">
                        <ul id="menu_tree">
                            <li><p class="m-0"><i class="fas fa-folder-open"></i> {{ $data['roles'] }}</p>
                                <ul>
                                    @php echo get_menu_tree($data['list']); @endphp
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <i class="fas fa-user"></i> User Menu
                    </div>
                    <div class="card-body">
                        <form method="get" class="exclude-token">
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label>User Role</label>
                                    <select name="roles" class="custom-select select2 w-100">
                                        @foreach ($data['all_roles'] as $roles)
                                            <option value="{{ $roles->id }}" {{ $_GET['roles'] == $roles->id ? 'selected':'' }}>{{ ucfirst($roles->role) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 d-flex flex-column justify-content-end">
                                    <button type="submit" class="btn btn-block btn-primary" style="margin-bottom: 2px"> <i class="fas fa-search"></i> Tampilkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <i class="fas {{ $iconType }}"></i> {{ $formType }} Menu
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.menu.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="roles" value="{{ old('roles', $_GET['roles']) }}">
                            @if ($formType == 'Ubah')
                                <input type="hidden" name="id" value="{{ old('id', $data['menu']->id) }}">
                            @endif
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Menu Role</label>
                                    <select name="menuType" class="custom-select select2">
                                        @foreach (collect(['Parent', 'Child']) as $type)
                                            <option value="{{ $type }}" {{ old('menuType', $data['menuType']) == $type ? 'selected':'' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Nama Menu</label>
                                    <input type="text" class="form-control" placeholder="Nama Menu" name="menu" value="{{ old('menu', $data['menu']->menu) }}" required>
                                </div>
                            </div>
                            <div id="parent-route" class="row">
                                <div class="form-group col-md-4">
                                    <label>Parent Menu</label>
                                    <select name="parent" class="custom-select select2" data-placeholder="Parent Menu">
                                        <option value=""></option>
                                        @foreach ($data['list'] as $list)
                                            @if (strlen($list->level) == 2 && $list->level != $data['menu']->level)
                                                <option value="{{ $list->level }}" {{ old('parent', substr($data['menu']->level, 0, 2)) == $list->level ? 'selected':'' }}>{{ $list->menu }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Route</label>
                                    <input type="text" class="form-control" placeholder="Route" name="route" value="{{ old('route', $data['menu']->route) }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>Icon</label>
                                    <div class="input-group">
                                        <select name="icon_type" class="custom-select col-3 select2">
                                            @foreach (collect(['fas', 'far']) as $icon)
                                                <option value="{{ $icon }}" {{ old('icon_type', $data['menu']->icon_type) == $icon ? 'selected':'' }}>{{ $icon }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control col-7" name="icon" value="{{ old('icon', $data['menu']->icon) }}">
                                        <div class="input-group-append col-2 px-0">
                                            <div class="input-group-text w-100">
                                                <span class="mx-auto">
                                                    <i id="iconPreview" class="{{ old('icon_type', $data['menu']->icon_type) }} {{ old('icon', $data['menu']->icon) }}"></i>
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <label>Level</label>
                                    <input type="number" min="0" max="99" class="form-control" placeholder="Level" name="level" value="{{ old('level', $level) }}" required onchange="this.value=validateLevel(this)">
                                </div>
                                <div class="col-auto">
                                    <label>Aktif</label>
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="active" id="active" {{ old('active', $data['menu']->active) == true ? 'checked':'' }}>
                                        <label for="active"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> {{ $formType }}</button>
                                    @if ($formType == 'Ubah')
                                        <a href="?roles={{$_GET['roles']}}" class="btn btn-secondary"> <i class="fas fa-times"></i> Batal</a>
                                        <a href="" data-url="{{ route('master.menu.delete', ['roles' => $_GET['roles'], 'id' => $data['menu']->id]) }}" data-text="Menu" class="btn btn-danger float-right menu-delete" onclick="deleteConfirm(event, this)"><i class="fas fa-trash"></i> Hapus</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $.fn.extend({
            treed: function (o) {
                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator'></i>");
                    branch.addClass('branch');
                });
            }
        });

        //Initialization of treeviews
        $('#menu_tree').treed();

        // Input
        $('select[name=menuType]').on('change', function () {
            if (this.value == 'Parent') {
                // $('#parent-route').hide('fast');
                $('select[name=parent]').prop('disabled', true);
            } else {
                // $('#parent-route').show('fast');
                $('select[name=parent]').prop('disabled', false);
            }
        });

        //Icon
        $('input[name=icon]').on('change keydown paste input', function () {
            var icon_type = $('select[name=icon_type]').find(":selected").text();
            $('#iconPreview').removeClass().addClass(icon_type + ' ' + this.value);
        });
        $('select[name=icon_type]').on('change', function () {
            var icon = $('input[name=icon]').val();
            $('#iconPreview').removeClass().addClass(this.value + ' ' + icon);
        });

        // Level
        function validateLevel(e) {
            level = parseInt(e.value, 10);
            if (level < 10)
                level = '0' + level;
            return level;
        }

        $(function () {
            menuType = '{{ $menuType ?? old("menuType") }}';
            formType = '{{ $formType }}';
            
            if (formType == 'Tambah') {
                if (menuType == 'Child') {
                    $('select[name=menuType]').val('Child').change();
                } else {
                    $('select[name=menuType]').val('Parent').change();
                }
            } else {
                if (menuType == 'Child') {
                    $('select[name=menuType]').val('Child').change();
                } else {
                    $('select[name=menuType]').val('Parent').change();
                }
            }

            
        });
    </script>
@endpush
