@extends('layouts.default')

@section('content')
<form class="forms-sample" action="{{url('property/'.$property->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Property</h4>
                
                <div class="form-group">
                    <label for="title">Title<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Property Title" value="{{$property->title}}" required>
                    @error('title')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-primary text-white">AED.</span>
                        </div>
                        <input type="text" name="price" class="form-control form-control-sm decimal" value="{{$property->price}}" aria-label="Amount (to the nearest dollar)">
                        
                      </div>
                      @error('price')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="location">Location<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="location" id="location" value="{{$property->location}}" placeholder="Enter Location" required>
                    @error('location')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description Here">{{$property->description}}</textarea>
                    @error('description')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                </div>
                <div class="form-group">
                    
                </div>
                <button type="submit" class="btn btn-primary me-2">Update</button>
                {{-- <button class="btn btn-light">Cancel</button> --}}
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="upload-container">
                    <div class="alert alert-success d-none  img-delete-alert">Image Deleted</div>
                    <div class="image-gallery">
                        
                        @foreach ($images as $img)
                        <div class="image-box">
                            <img src="{{asset($img->img_path)}}" alt="Property Image">
                            <button class="delete-icon" data-id="{{$img->id}}"><i class="mdi mdi-delete"></i></button>
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <h3 class="text-center">Upload New Images</h3>
                    <div class="image-preview" id="imagePreview"></div>
                    <div class="upload-btn btn-primary">
                        <input type="file" id="imageUpload" name="images[]" multiple accept="image/*">
                        <label for="imageUpload">Select Images</label>
                    </div>
                    @error('images')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('footer-scripts')
    <script>
        
        $(document).ready(function () {
            // Image Upload and Preview
            $('#imageUpload').on('change', function () {
                let files = this.files;
                previewImages(files);
            });

            // Function to Preview Images
            function previewImages(files) {
                $('#imagePreview').empty();  // Clear previous images
                Array.from(files).forEach((file, index) => {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        let imgElement = `
                            <div class="image-box">
                                <img src="${e.target.result}" alt="Preview">
                                <button class="remove-image" data-index="${index}"><i class="mdi mdi-delete"></i></button>
                            </div>
                        `;
                        $('#imagePreview').append(imgElement);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Remove Image on Click
            $(document).on('click', '.remove-image', function () {
                $(this).parent('.image-box').remove();
            });

            $("input.decimal").bind("change keyup input", function() {
            var position = this.selectionStart - 1;
            //remove all but number and .
            var fixed = this.value.replace(/[^0-9\.]/g, "");
            if (fixed.charAt(0) === ".")
            //can't start with .
            fixed = fixed.slice(1);

            var pos = fixed.indexOf(".") + 1;
            if (pos >= 0)
            //avoid more than one .
            fixed = fixed.substr(0, pos) + fixed.slice(pos).replace(".", "");

            if (this.value !== fixed) {
            this.value = fixed;
            this.selectionStart = position;
            this.selectionEnd = position;
            }
        });

            // Delete Images from DB
            $('.delete-icon').on('click', function () {
                $(this).closest('.image-box').remove(); 
                var img_id=$(this).data('id');
                $.ajax({
                    url: '/property-image/'+img_id+'/delete',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('.img-delete-alert').removeClass('d-none');
                        setTimeout(() => {
                            $('.img-delete-alert').addClass('d-none');
                        }, 3000);
                        
                    },
                    error: function() {
                        alert('Image Deletion Failed');
                    }
                });
            });
        });
    </script>
@endsection
