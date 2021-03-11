<x-admin-master>
   @section('content')
   
   Edit: {{$permission->name}}
   
   <div class="row">
      
      @if(Session()->has('permission-updated'))
            
      <div class="alert alert-success">
         {{Session('permission-updated')}}
      </div>
   
      @elseif(Session()->has('permission-unchanged'))
         
      <div class="alert alert-warning">
      {{Session('permission-unchanged')}}
      </div>
      
      @endif
   </div>
   
      
   <div class="row">
      <div class="col-sm-8">
         <h1>Edit Permission: {{$permission->name}}</h1>
         
         <form method="post" action="{{ route('permissions.update', $permission->id) }}">
            @csrf
            @method('PUT')
         
            <div class="form-group">
               <label for="name">Name</label>
               <input type="text" name="name" class="form-control" id="name" value="{{$permission->name}}">
            </div>
         
            <button type="submit" class="btn btn-primary">Update</button>
         
         </form>
      </div>  
   </div>
   
   @endsection
</x-admin-master>