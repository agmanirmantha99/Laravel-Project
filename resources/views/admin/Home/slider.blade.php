@extends('admin.layouts.master') 

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Slider Manager</h1>
</div>    

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Slide
  </button>

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

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="/saveSlider" enctype="multipart/form-data">
          @csrf
        <div class="modal-body">
          
            <!-- Top Sub Heading -->
            <div class="mb-3">
                <label for="topSubHeading" class="form-label">Top Sub Heading</label>
                <input type="text" class="form-control" id="topSubHeading" name="top_sub_heading" placeholder="Enter top sub heading">    
            </div>

            <!-- Heading -->
            <div class="mb-3">
                <label for="Heading" class="form-label">Heading</label>
                <input type="text" class="form-control" id="Heading" name="heading" placeholder="Enter heading">    
            </div>

            <!-- Bottom Sub Heading -->
            <div class="mb-3">
                <label for="bottomSubHeading" class="form-label">Bottom Sub Heading</label>
                <input type="text" class="form-control" id="bottomSubHeading" name="bottom_sub_heading" placeholder="Enter bottom sub heading">    
            </div> 

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="imageUpload" class="form-label">Image Upload</label>
                <input type="file" class="form-control" id="image" name="image" >    
            </div>

             <!-- More Info Link -->
             <div class="mb-3">
                <label for="moreInfoLink" class="form-label">More Info Link</label>
                <input type="text" class="form-control" id="moreInfoLink" name="more_info_link" placeholder="Enter link for more informations">    
            </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Slider</button>
        </div>
        </form>
      </div>
    </div>
  </div>
   <!-- End Modal -->



@endsection