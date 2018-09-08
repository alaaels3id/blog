@extends('layouts.app')
@section('title', 'Posts')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Posts</span>
                    <span style="cursor: pointer;padding: 7px 11px;" class="badge badge-secondary badge-pill pull-right" onclick="window.location.href='{{ route('home') }}'">
                        <i class="fa fa-2x fa-arrow-right"></i>
                    </span>
                </div>
                @php $trans = CheckIfIsset($post)->translations->toArray(); @endphp
                <div class="card-body">
                    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PATCH']) !!}
                    {!! BuildFields('title', $trans, 'text') !!}
                    {!! BuildFields('body', $trans, 'textarea') !!}
                    {!! Form::submit('Update', ['class' => 'btn btn-success btn-block', 'name' => 'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop