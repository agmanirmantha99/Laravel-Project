@extends('admin.layouts.master') 

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Blog</h1>
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
        Add New Post
      </button>

      <!-- Modal -->
<div class="modal fade" id="slideModal" tabindex="-1" role="dialog" aria-labelledby="slideModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="slideModalLabel">Add Post Details</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
            <form method="POST" action="/savepost" enctype="multipart/form-data">
             @csrf
        <div class="modal-body">
            <!-- title -->
            <div class="mb-3">
                <label for="post_title" class="form-label">Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Post">    
            </div>

            <!-- Slug -->
            <div class="mb-3">
                <label for="post_slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="post_slug" name="post_slug" placeholder="Slug">    
            </div>

            <!-- Body -->
            <div class="mb-3">
                <label for="post_body" class="form-label">Body</label>
                <textarea class="form-control" id="post_body" name="post_body" rows="5"></textarea>    
            </div> 

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="post_image" class="form-label">Image Upload</label>
                <input type="file" class="form-control" id="post_image" name="post_image" >    
            </div> 

          </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">ADD</button>
          </div>
        </form>
      </div>
    </div>
 </div>
<!-- End Modal -->

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Sliders
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Body</th>
                    <th>Date & Time</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
              <tbody>
                @foreach ($posts as $post)
                 <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at}}</td>
                    <td><img width="100" src="{{asset('storage/'. $post->image) }}" alt="" /> </td>
          
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal{{$post->id}}">Edit</button>
                       <a href="/deletePost/{{$post->id}}" class="btn btn-danger">Delete </a>
                    </td>
                  </tr>
  
  
    <!-- Edit Modal -->
    <div class="modal fade" id="slideModal{{$post->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="slideModalLabel">Edit post {{$post->id}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="/postsUpdate" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tm_id" value="{{$post->id}}">
          <div class="modal-body">
            
              <!-- title -->
              <div class="mb-3">
                  <label for="post_title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="post_title" name="post_title" value="{{ $post->id }}" placeholder="Enter Title">    
              </div>
  
              <!-- slug -->
              <div class="mb-3">
                  <label for="post_slug" class="form-label">Slug</label>
                  <input type="text" class="form-control" id="post_slug" name="post_slug" value="{{ $post->slug}}" placeholder="Enter Slug">    
              </div>
  
              <!-- Body -->
              <div class="mb-3">
                  <label for="post_body" class="form-label"> Body</label>
                  <input type="text" class="form-control" id="post_body" name="post_body" value="{{ $post->body }}" placeholder="Enter Body">    
              </div> 
  
              <!-- Image Upload -->
              <div class="mb-3">
                  <label for="post_image" class="form-label">Image Upload</label>
                  <input type="file" class="form-control" id="post_image" name="post_image" >    
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

</div>

@endsection