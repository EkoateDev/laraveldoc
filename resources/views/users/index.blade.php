@extends('layouts.app')

@section('content')

<div class="container-md">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div>
                <h2>Users Management</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-outline-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-outline-success" href="{{ route('users-index') }}" title="Export File">
                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th width="130px">Roles</th>
            <th width="320px">Actions</th>
        </tr>

        @foreach ($data as $key => $user)

        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if (!empty($user->getRoleNames()))
                @foreach ($user->getRoleNames() as $v)
                <label class="badge bg-success text-light ">{{ $v }}</label>
                @endforeach
                @endif
            </td>
            <td>
                <a class="btn btn-outline-secondary" href="{{ route('resend-email', ['userId'=>$user->id]) }}"
                    title="Resend Setup Password Email">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </a>
                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                <a class="btn btn-outline-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' =>
                'display:inline'])
                !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>
</div>

{!! $data->render() !!}

@endsection