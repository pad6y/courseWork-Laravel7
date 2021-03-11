<x-admin-master>
   
   @section('content')
   
      <h1>All Posts</h1>
      
      @if(session('message'))
        <div class="alert alert-danger">{{ Session::get('message')}}</div>
        
        @elseif(session('post-create-message'))
        <div class="alert alert-success">{{ Session::get('post-create-message')}}</div>
        
        @elseif(session('post-updated-message'))
        <div class="alert alert-success">{{ session('post-updated-message')}}</div>
        
      @endif
      
      <div class="card shadow mb-4">
         <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Posts Table</h6>
         </div>
         <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                 <tr>
                   <th>Id</th>
                   <th>Owner</th>
                   <th>Title</th>
                   <th>Image</th>
                   <th>Created At</th>
                   <th>Updated At</th>
                   <th>Edit</th>
                   <th>Delete</th>
                 </tr>
               </thead>
               <tfoot>
                 <tr>
                  <th>Id</th>
                  <th>Owner</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Edit</th>
                  <th>Delete</th>
                 </tr>
               </tfoot>
               <tbody>
               
               @foreach($posts as $post)
               
                  <tr>
                     <td>{{$post->id}}</td>
                     <td>{{$post->user->name}}</td>
                  <td><a href="{{route('post', $post->id)}}">{{$post->title}}</a></td>
                     <td>
                        <div><img height="40px" src="{{$post->post_image}}" alt=""></div>
                     </td>
                     <td>{{$post->created_at->diffForHumans()}}</td>
                     <td>{{$post->updated_at->diffForHumans()}}</td>
                     
                      
                      @can('view', $post)
                      <td><button type="text" class="btn btn-warning"><a href="{{route('post.edit', $post->id)}}">Edit</a></button></td>
                      <td><form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                     </form>
                     </td>
                     
                     @endcan
                     
                  </tr>
               
               @endforeach
                  
               </tbody>
             </table>
           </div>
         </div>
       </div>
      
      <div class="d-flex">
        <div class="mx-auto">
          {{$posts->links()}}

        </div>
      </div>
       
   @endsection
   
   @section('scripts')
   
       <!-- Page level plugins -->
         <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
         <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

         <!-- Page level custom scripts -->
         {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
         
   @endsection
   
</x-admin-master>