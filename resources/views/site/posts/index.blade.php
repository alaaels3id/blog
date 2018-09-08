@extends('layouts.app')
@section('title', 'Posts')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Posts</span> ({{ $posts->count() }})
                    <span style="cursor: pointer;padding: 7px 11px;" class="badge badge-secondary badge-pill pull-right" onclick="window.location.href='{{ route('home') }}'">
                        <i class="fa fa-2x fa-arrow-right"></i>
                    </span>
                </div>

                <div class="card-body">
                    <table class="table table-hover text-center table-bordered">
                    	<thead><tr><th>#</th><th>title</th><th>body</th>@can('control-all')<th>owner</th><th>Action</th>@endcan</tr></thead>
                    	<tbody>
                    		@forelse($posts as $post)
                    		<tr>
                                <td>{{ $post->id }}</td>
                    			<td>{{ str_limit($post->title, 27, '...') }}</td>
                                <td>{{ str_limit($post->body, 27, '...') }}</td>
                                @can('control-all')
                                <td><span class="badge badge-primary badge-pill">{{ $post->user_id }}</span></td>
                                <td>
                                    <a class="btn btn-outline-success" href="{{ route('posts.edit', $post->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-outline-danger" href="{{ route('posts.destroy', $post->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                @endcan
                    		</tr>
                    		@empty
                    		<tr><td colspan="5"><div class="alert alert-info" role="alert">No Posts</div></td></tr>
                			@endforelse
                    	</tbody>
                    </table>
                    @can('create-post')
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create new post !</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@stop