<x-admin-master>
   
   @section('content')
   
      <h1>Users</h1>
      
      @if(session('message'))
        <div class="alert alert-danger">{{ Session::get('message')}}</div>
      
      @endif
      
      <div class="card shadow mb-4">
         <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">User Tables</h6>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                     </tr>
                  </thead>
                  <tfoot>
                        <tr>
                           <th>Id</th>
                           <th>Username</th>
                           <th>Avatar</th>
                           <th>Name</th>
                           <th>Created At</th>
                           <th>Updated At</th>
                           <th>Delete</th>
                        </tr>
                  </tfoot>
                  <tbody>
                     
                     @foreach($users as $user)
                     <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href='users/{{ $user->id }}/profile'>{{ $user->username }}</td>
                        <td><img height="80px" src="{{ $user->avatar }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                           <form method="post" action="{{route('user.destroy', $user->id)}}" enctype="multipart/form-data">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Delete</button>
                           </form>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
   @endsection
   
      @section('scripts')
      
         <!-- Page level plugins -->
         <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
         <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

         <!-- Page level custom scripts -->
         <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
      
      @endsection
   
</x-admin-master>