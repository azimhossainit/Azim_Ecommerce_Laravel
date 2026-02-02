@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Add New Product</h5>
        <a href="{{ route('product.index') }}" class="btn btn-primary btn-md d-inline-flex align-items-center gap-1">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Product Info --}}
            <div class="sectionCard mb-5">
                <span class="sectionTitle">Product Info</span>
                <div class="row mt-4">
                    <div class="col-12">
                        <x-input 
                            label="Product Name" 
                            name="name" 
                            placeholder="Product Name" 
                            value="{{ old('name') }}" />
                    </div>

                    <div class="col-12 mt-3">
                        <x-textarea 
                            label="Short Description" 
                            name="short_description" 
                            placeholder="Short Description..." 
                            rows="4"
                        >{{ old('short_description') }}</x-textarea>
                    </div>

                    <div class="col-12 mt-3">
                        <x-select label="Tags" name="tags[]" placeholder="Select Tags" multiple class="selectTags">
                            @foreach ($tags ?? [] as $tag)
                                <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id)) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
            </div>

            {{-- General Information --}}
            <div class="sectionCard mb-5">
                <span class="sectionTitle">General Information</span>
                <div class="row mt-4">
                    <div class="col-md-6 mt-3">
                        <x-select label="Category" name="category" placeholder="Select Category">
                            <option value="">Select Category</option>
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <x-select label="Sub Category" name="sub_category" placeholder="Select Sub Category">
                            <option value="">Select Sub Category</option>
                            @foreach ($subCategories ?? [] as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ old('sub_category') == $subCategory->id ? 'selected' : '' }}>
                                    {{ $subCategory->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Product SKU</label>
                        <div class="d-flex gap-2">
                            <input type="text" name="product_sku" id="product_sku" class="form-control" 
                                placeholder="Product SKU" value="{{ old('product_sku') }}" readonly>
                            <button type="button" class="btn btn-success" onclick="codeGenerate()">Generate</button>
                        </div>
                        @error('product_sku')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <x-select label="Brand" name="brand" placeholder="Select Brand">
                            <option value="">Select Brand</option>
                            @foreach ($brands ?? [] as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <x-input type="number" label="Buying Price" name="buying_price" placeholder="Buying Price" value="{{ old('buying_price') }}" />
                    </div>

                    <div class="col-md-6 mt-3">
                        <x-input type="number" label="Selling Price" name="selling_price" placeholder="Selling Price" value="{{ old('selling_price') }}" />
                    </div>
                </div>
            </div>

            {{-- Product Description --}}
            <div class="sectionCard mb-5">
                <span class="sectionTitle">Product Description</span>
                <div class="row mt-4">
                    <div class="col-12 mt-3">
                        <x-textarea label="Description" name="description" class="summernote">
                            {{ old('description') }}
                        </x-textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <x-textarea label="Additional Information" name="additional_information" class="summernote">
                            {{ old('additional_information') }}
                        </x-textarea>
                    </div>
                </div>
            </div>

            {{-- Product Images --}}
            <div class="sectionCard mb-5">
                <span class="sectionTitle">Product Images</span>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="thumbnail">
                            <img src="{{ asset('thumbnail.webp') }}" id="thumbnail_preview" class="img-thumbnail" width="140" height="140">
                        </label>
                        <input type="file" name="thumbnail" id="thumbnail" class="d-none" onchange="validateImage(this)">
                        <span class="text-danger" id="imageError"></span>
                        @error('thumbnail')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <p>Product Gallery</p>
                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn" for="upload">
                                    <img src="{{ asset('thumbnail.webp') }}" class="img-thumbnail" width="140" height="140">
                                </label>
                            </div>
                            <input type="file" name="images[]" multiple class="upload__inputfile d-none" id="upload">
                            <div class="upload__img-wrap"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-4 d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-secondary btn-lg"><i class="fa fa-undo"></i> Reset</button>
                <button type="submit" class="btn btn-primary btn-lg">Submit <i class="fa fa-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<style>
.sectionCard { position: relative; border: 1px solid #ebebeb; padding: 15px; border-radius:5px; margin-bottom:10px; }
.sectionTitle { position:absolute; top:-15px; left:15px; font-size:18px; background:#ededed; padding:2px 20px; border-radius:5px;}
.upload__box { margin-top:10px; display:flex; gap:20px; flex-wrap:wrap;}
.upload__img-wrap { display:flex; flex-wrap:wrap; gap:15px;}
.img-bg { width:100%; padding-bottom:100%; background-size:cover; background-position:center; position:relative; border-radius:10px; overflow:hidden; border:1px solid #ddd;}
</style>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
$(document).ready(function() { $('.summernote').summernote(); $('.selectTags').select2(); });

// SKU Generate
function codeGenerate() {
    document.getElementById('product_sku').value = Math.floor(Math.random()*1000000);
}

// Thumbnail preview
$('#thumbnail').change(function() {
    let reader = new FileReader();
    reader.onload = e => $('#thumbnail_preview').attr('src', e.target.result);
    reader.readAsDataURL(this.files[0]);
});

// Validate thumbnail size
function validateImage(input) {
    const file = input.files[0];
    const errorMessage = document.getElementById('imageError');
    const preview = document.getElementById('thumbnail_preview');
    errorMessage.textContent = '';
    if (!file) return;
    if (file.size > 2*1024*1024) { // 2MB
        errorMessage.textContent = 'Image must be less than 2MB';
        input.value = '';
        preview.src = "{{ asset('thumbnail.webp') }}";
        document.getElementById('submitBtn').disabled = true;
    } else {
        preview.src = URL.createObjectURL(file);
        document.getElementById('submitBtn').disabled = false;
    }
}

// Gallery upload preview
function ImgUpload() {
    let dt = new DataTransfer();
    $('.upload__inputfile').on('change', function(e){
        let imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
        let files = e.target.files;
        for(let i=0;i<files.length;i++){
            let file = files[i];
            if(file.size>2*1024*1024){ alert(`${file.name} > 2MB`); continue;}
            dt.items.add(file);
            let reader = new FileReader();
            reader.onload = function(event){
                imgWrap.append(`<div class='upload__img-box'><div class='img-bg' style='background-image:url(${event.target.result})' data-file='${file.name}'><div class='upload__img-close'>×</div></div></div>`);
            }
            reader.readAsDataURL(file);
        }
        this.files = dt.files;
    });

    $('body').on('click', '.upload__img-close', function(){
        let fileName = $(this).parent().data('file');
        for(let i=0;i<dt.items.length;i++){ if(dt.items[i].getAsFile().name===fileName){ dt.items.remove(i); break; } }
        document.querySelector('.upload__inputfile').files = dt.files;
        $(this).closest('.upload__img-box').remove();
    });
}
$(document).ready(function(){ ImgUpload(); });
</script>
@endpush