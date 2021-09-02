@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1>{{ ucfirst($users->name) }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pt-2">
                {{-- {{ $blogs}} --}}
                {{-- @foreach ($blogs as $item)
                       Title : {{$item->title}} 
                @endforeach --}}
                {{-- <a href="/blogs" class="btn btn-outline-primary btn-sm">Go back</a> --}}
                @if(!($blogs==null))
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <h1 class="display-one">Our Blog!</h1>
                                <p>Enjoy reading our posts. Click on a post to read!</p>
                            </div>
                             @auth
                                 <div class="col-4">
                                     <p>Create new Post</p>
                                     <a href="/blog/create/post" class="btn btn-primary btn-sm">Add Post</a>
                                 </div>    
                             @endauth
                             
                             @guest
                                 <div class="col-4">
                                     <p>Create new Post</p>
                                     <a href="{{ route('login')}}" class="btn btn-primary btn-sm">Add Post</a>
                                 </div>
                             @endguest        
                            
                        </div>     
                        <h1>List of Your Blogs <br/> </h1>
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    {{-- <th>Id</th> --}}
                                    <th width="100px">Image</th>
                                    <th>Title</th>
                                    <th width="100px">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    {{-- @foreach ( $blogs as $item )
                        <h1 class="display-one">{{ ucfirst($item->title) }}</h1>    
                        <p>{!! $item->body !!}</p> 
                        <hr>
                        <a href="{{ route('edit')}}" class="btn btn-outline-primary">Edit Blog</a>
                        <br><br>
                    @endforeach
                    <form id="delete-frm" class="" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete Post</button>
                    </form> --}}
                @else
                    <a name="" id="" class="btn btn-primary" href="/blog/create/post" role="button">Create new block</a>
                @endif  
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () { 
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard') }}",
          columns: [
            //   {data: 'id', name: 'id'},
                {data: 'image', name: 'image', orderable:false},
                {data: 'title', name: 'title'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
        });
        
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection