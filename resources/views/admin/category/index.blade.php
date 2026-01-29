@extends('admin.layouts.app')
@section('content')
<div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                 <h5 class="">All Categories</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display" id="categoryTable">
                        <thead>
                            <tr>
                                <th class="">Sl</th>
                                <th class="">Category Name</th>
                                <th class="">Category Slug</th>
                                <th class="text-center">Category Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                           </thead>
                        <tbody>
                       @forelse ($categories ?? [] as $key => $category)
                      <tr>
                                    <td>{{ $key + 1  }}</td>
                                    <td>{{ $category?->name }}</td>
                                    <td>{{ $category?->slug }}</td>
                                    <td class="text-center">
                                        <img src="{{ $category?->thumbnail }}" alt="">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('category.edit', $category?->id) }}"
                                            class="btn btn-danger btn-icon btn-md">
                                            <i data-lucide="edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No Category Found</td>
                                </tr>
                            @endforelse
                    </tbody>                
                                    
                    </table>
                    <div class="d-flex justify-content-end mt-4">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="">Add New Category</h5>
                </div>
                <div class="card-footer">
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" name="name" id="categoryName" class="form-control"
                                placeholder="Category Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Category Slug</label>
                            <input type="text" name="slug" id="categorySlug" class="form-control"
                                placeholder="Category Slug">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Category Image --}}
                    <div class="mb-4">
                        <label for="categoryImage" class="form-label">Category Image</label> <br>
                        <img src="{{ asset('default.webp') }}" width="120" class="mb-2" 
                             alt="Category Preview" id="categoryImagePrv">
                        <input type="file" name="image" id="categoryImage" class="form-control" 
                               accept="image/*" onchange="validateImage(this)">
                        <span class="text-danger" id="imageError"></span>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
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
    $('#categoryTable').DataTable();
});
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
@endsection

