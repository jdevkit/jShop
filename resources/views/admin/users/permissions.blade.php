@extends('adminlte::page')

@section('contentheader_title')
    Roles & Permissions
@endsection

@section('menu_links')
    <li><a href="{!! route('admin.users') !!}"><i class="fa fa-address-card-o"></i> Users </a></li>
    <li class="active"><i class="fa fa-user"></i> Edit Roles</li>
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3>Roles & Permissions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            @permission('edit-permissions')
                            <div class="col-sm-6">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Edit roles</h3>
                                    </div>
                                    {!! Form::open([
                                    'url' => route('admin.role.update'),
                                    'method' => 'post'
                                    ]) !!}
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="role">
                                                Select role to update
                                            </label>
                                            <select name="role" id="role">
                                                <option value="" selected disabled>Select a role</option>
                                                @foreach($roles as $role)
                                                    @if($role->name === 'owner')
                                                        @continue
                                                    @endif
                                                    <option value="{!! $role->id !!}">{!! $role->display_name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('permissions', "Permissions") !!}
                                            @foreach($permissions as $permission)
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::checkbox('permissions['. $permission->id .']', $permission->id )!!}
                                                        {!! $permission->display_name !!}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        {!! Form::submit('Update roles', ['class' => 'btn btn-warning']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script defer src="../js/roles.js"></script>
@endsection

