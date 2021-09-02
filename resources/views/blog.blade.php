@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
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
               
                @forelse($posts as $post)
                    <div class="card">
                        <div class="col-2">
                            <img src="{{asset('/storage/images/'.$post->name)}}" alt="..." class="img-thumbnail">
                            
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><a href="./blog/{{ $post->slug }}" >{{ ucfirst($post->title) }}</a></h4>
                            <p class="card-text">{{$post->body}}</p>
                        </div>
                    </div>
               @empty
                   <p class="text-warning">No blog Posts available</p>
               @endforelse
               
           </div>
           {{ $posts->links('pagination::bootstrap-4')}}
        </div>
        
    </div>
  
@endsection




{{-- @section('script')
<script type="text/javascript">
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('blog.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'title', name: 'title'},
            //   {data: 'body', name: 'body'},
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
@endsection --}}