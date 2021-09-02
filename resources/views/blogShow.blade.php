@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
            <h1 class="display-one"> {{ ucfirst($post->title) }} </h1>
            
            <div class="col-4">
                <div class="col-8">
                    <img src="{{asset('/storage/images/'.$post->name)}}" alt="..." class="img-thumbnail"> 
                </div>
            </div>
            <hr>
            <p>{!! $post->body !!}</p> 
           
           
        </div>
    </div>
</div>

@endsection