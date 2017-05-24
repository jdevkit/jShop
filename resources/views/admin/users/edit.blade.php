@extends('adminlte::layouts.app')

@section('contentheader_title')
	Users
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3>Edit User</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="panel panel-default">
                                        <div class="panel-body">
                                            {!! \Form::model($redactUser, ['url' => route('admin.users.update', [$id = $redactUser->id]), 'method' => 'put']) !!}
                                            <div class="form-group">
                                                {!! Form::label('name', 'User\'s name' ) !!}
                                                {!! Form::text('name', $redactUser->name,['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('email', 'User\'s email' ) !!}
                                                {!! Form::text('email', $redactUser->email,['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('password', 'User\'s password' ) !!}
                                                {!! Form::password('password',['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                        </div>
                                    {!! \Form::close() !!}
                                </div>
                            </div>
                            @permission('edit-roles')
                            <div class="col-sm-6">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">User roles</h3>
                                    </div>
                                    {!! Form::open(['url' => route('admin.users.roles', [$id = $redactUser->id]), 'method' => 'post']) !!}
                                    <div class="panel-body">
                                        <div class="form-group">
                                            {!! Form::label('roles', "Roles") !!}
                                        @foreach($roles as $role)
                                            <div class="checkbox">
                                                <label>
                                                    {!! Form::checkbox('role[]', $role->id , $redactUser->hasRole($role->name) ? true : false) !!}
                                                    {!! $role->display_name !!}
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

