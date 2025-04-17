@extends('admin.layouts.master') 

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Permissions</h1>
</div>    

<div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
    </div>     
    @endif
  
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }}</li>   
            @endforeach
        </ul>    
      </div>
    @endif 

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal">
        Add New Permission
      </button>  

          <!-- Modal -->
<div class="modal fade" id="slideModal" tabindex="-1" role="dialog" aria-labelledby="slideModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="slideModalLabel">Add New Permissions</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
            <form method="POST" action="/savePermission" enctype="multipart/form-data">
             @csrf
        <div class="modal-body">
            <!-- title -->
            <div class="mb-3">
                <label for="permission_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="permission_name" name="permission_name" placeholder="Permission">    
            </div>

          </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
 </div>  
<!-- End Modal -->

</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Permissions
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
              <tbody>
                @foreach ($permissions as $permission)
                 <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
          
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal{{$permission->id}}">Edit</button>
                       <a href="/deletePermission/{{$permission->id}}" class="btn btn-danger">Delete </a>
                    </td>
                  </tr>
  
  
    <!-- Edit Modal -->
    <div class="modal fade" id="slideModal{{$permission->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="slideModalLabel">Edit Slide {{$permission->name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="/permissionUpdate" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="permission_id" value="{{$permission->id}}">
          <div class="modal-body">
            
              <!-- name -->
              <div class="mb-3">
                  <label for="post_title" class="form-label">Name</label>
                  <input type="text" class="form-control" id="permission_name" name="permission_name" value="{{ $permission->name }}" placeholder="Enter Name">    
              </div>
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">save Changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    @endforeach
     <!-- End Modal -->  
              </tbody>
        </table>
    </div>
  </div>


@endsection