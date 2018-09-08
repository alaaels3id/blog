@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Panel</div>
                <div class="card-body">
                	<table class="table table-hover text-center table-bordered">
                		<thead>
                			<tr>
                				<th>#</th>
                				<th>Name</th>
                				<th>email</th>
                				<th>Role</th>
                			</tr>
                		</thead>
                		<tbody>
                			@foreach(App\User::take(10)->get() as $user)
                			<tr>
                				<td>{{ $user->id }}</td>
                				<td>{{ $user->name }}</td>
                				<td>{{ $user->email }}</td>
                				<td>
                					<form action="{{ route('admin.roles') }}" method="POST">
                						<select class="form-control" name="role">
                							@foreach(GetRoles() as $role)
                								<option {{ ($role->id == GetUserRole($user)->id) ? 'selected' : '' }} value="{{ $role->id }}">
                									{{ $role->name }}
                								</option>
                							@endforeach
                						</select>
                					</form>
                				</td>
                			</tr>
                			@endforeach
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop