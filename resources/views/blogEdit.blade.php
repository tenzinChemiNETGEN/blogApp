@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Edit Post</h1>
                    <p>Edit and submit this form to update a post</p>

                    <hr>
                    <form action="{{ route('update',$post->slug)}}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        @if ($post != null)
                            <div class="row">
                                <div class="control-group col-12">
                                    <label for="title">Post Title</label>
                                    <input type="text" id="title" class="form-control" name="title"
                                        placeholder="Enter Post Title" value="{{ $post->title }}" required>
                                </div>
                                <div class="row">
                       
                                <div class="col-md-12">
                                    <div class="col-8">
                                        <img src="{{asset('/storage/images/'.$post->name)}}" alt="..." class="img-thumbnail"> 
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="image" placeholder="Edit Image" id="image">
                                    @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                       
                              
                                </div> 
                                <div class="control-group col-12 mt-2">
                                    <label for="body">Post Body</label>
                                    <textarea id="body" class="form-control" name="body" placeholder="Enter Post Body"
                                            rows="5" required>{{ $post->body }}</textarea>
                                </div>
                            </div> 
                        @endif
                        
                            
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Update Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

