@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="">Edit Category</h4>
                    <a href="{{ route('category.index') }}" class="btn btn-primary btn-md d-flex align-items-center">
                        <div class="mr-1">
                            <i class="fa fa-arrow-left"></i>
                        </div>
                        <span class="ms-1">Back</span>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $category->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                value="{{ $category->slug }}">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="categoryImage" class="form-label">Category Image</label> <br>
                            <img src="{{ $category?->thumbnail }}" width="120" class="mb-2" alt=""
                                id="categoryImagePrv">
                            <input type="file" name="image" id="categoryImage" class="form-control"
                                onchange="validateImage(this)">
                            <span class="text-danger" id="imageError"></span>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary" id="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
function validateImage(input) {
    const file = input.files[0];
    console.log(file.size)
    const preview = document.getElementById('categoryImagePrv');
    const error = document.getElementById('imageError');

    // Reset error
    error.textContent = "";
    if (file) {
        let imgSize = file.size / (1024 * 1024); // MB
        // FIXED: 2MB বা তার বেশি হলে error
        if (imgSize >= 2) {
            error.textContent = "Image size must be less than 2MB";
            preview.src = "{{ asset('default.webp') }}"; // Optional fallback
            submit.disabled = true;
            return;
        }
        // Allow below 2MB
        submit.disabled = false;

        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush

