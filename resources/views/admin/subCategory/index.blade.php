@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><h5>All Sub Categories</h5></div>
            <div class="card-footer">
                <table class="table table-hover display" id="subCategoryTable">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subCategories as $key => $subCategory)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $subCategory->category?->name }}</td>
                            <td>{{ $subCategory->name }}</td>
                            <td>{{ $subCategory->slug }}</td>
                            <td class="text-center"><img src="{{ $subCategory->media }}" alt="" width="50"></td>
                            <td class="text-center">
                                <a href="{{ route('subCategory.edit', $subCategory->id) }}" class="btn btn-danger btn-icon btn-md">
                                    <i data-lucide="edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-danger">No Category Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><h5>Add New Sub Category</h5></div>
            <div class="card-footer">
                <form action="{{ route('subCategory.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Sub-Category Name">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="Sub-Category Slug">
                        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-control form-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Thumbnail</label><br>
                        <img src="{{ asset('default.webp') }}" width="120" id="subCategoryImagePrv" class="mb-2" alt="">
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="validateImage(this)">
                        <span class="text-danger" id="imageError"></span>
                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
$(document).ready(function() {
    $('#subCategoryTable').DataTable({ pageLength: 10 });
});

function validateImage(input) {
    const file = input.files[0];
    const preview = document.getElementById('subCategoryImagePrv');
    const error = document.getElementById('imageError');
    const submit = document.getElementById('submit');
    error.textContent = "";
    if(file){
        let sizeMB = file.size / (1024*1024);
        if(sizeMB >= 2){
            error.textContent = "Image size must be less than 2MB";
            preview.src = "{{ asset('default.webp') }}";
            submit.disabled = true;
        } else {
            submit.disabled = false;
            preview.src = URL.createObjectURL(file);
        }
    }
}
</script>
@endpush
@endsection

function validateImage(input) {
  text only  
}