@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in ! {{ __('blog.home') }}
                    <br>
                    <hr>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Posts</a>
                    <a href="{{ route('users') }}" class="btn btn-dark">Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
