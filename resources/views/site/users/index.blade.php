@extends('layouts.app')
@section('title', 'Posts')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Users</span> ({{ $users->total() }})
                    <span style="cursor: pointer;padding: 7px 11px;" class="badge badge-secondary badge-pill pull-right" onclick="window.location.href='{{ route('home') }}'">
                        <i class="fa fa-2x fa-arrow-right"></i>
                    </span>
                </div>

                <div class="card-body">
                    <table class="table table-hover text-center table-bordered">
                    	<thead>
                    		<tr><th>#</th><th>Name</th><th>Email</th><th>Join in</th></tr>
                    	</thead>
                    	<tbody>
                    		@forelse($users as $user)
                    		<tr>
                                <td>{{ $user->id }}</td>
                    			<td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                    			<td>{{ $user->created_at->diffForHumans() }}</td>
                    		</tr>
                    		@empty
                    		<tr><td colspan="3"><div class="alert alert-info" role="alert">No Users</div></td></tr>
                			@endforelse
                    	</tbody>
                    </table>
                    <div style="margin-left: 100px;" class="text-center">
                        {{ $users->appends(Request::except('page'))->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop