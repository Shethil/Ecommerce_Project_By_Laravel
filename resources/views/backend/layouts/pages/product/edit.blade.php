@extends('backend.layouts.master')

@section('title')
    Product Edit
@endsection

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('product.index') }}" class="btn btn-primary"> <i class="fas fa-backward"></i>
                    Back to Product
                </a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product.update', $product->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-3">
                            <label for="category-name" class="form-label"> Select Category </label>
                            <select name="category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="product-name" class="form-label"> Product Name </label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="enter product name" value="{{ $product->name }}" id="">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="product-price" class="form-label">Product Price</label>
                                <input type="number"
                                    class="form-control @error('product_price') is-invalid
                                @enderror"
                                    name="product_price" min="0" id="product_price"
                                    value="{{ $product->product_price }}">

                                @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="product-code" class="form-label">Product Code</label>
                                <input type="text" name="product_code"
                                    class="form-control @error('product_code') is-invalid @enderror"
                                    placeholder="enter product code" id="" value="{{ $product->product_code }}">

                                @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="product-stock" class="form-label">Initial stock</label>
                                <input type="number"
                                    class="form-control @error('product_stock') is-invalid
                                @enderror"
                                    name="product_stock" min="1" id="product_stock"
                                    value="{{ $product->product_stock }}">

                                @error('product_stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="alert-quantity" class="form-label">Alert Quantity</label>
                                <input type="number"
                                    class="form-control @error('alert_quantity') is-invalid
                                @enderror"
                                    name="alert_quantity" min="1" id="alert_quantity"
                                    value="{{ $product->alert_quantity }}">

                                @error('alert_quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="short_description" class="form-label"> Short Description </label>
                                <textarea name="short_description"
                                    class="form-control @error('short_description') is_invalid
                                @enderror"
                                    id="short_description" id="" cols="120" rows="5"> {{ $product->short_description }}</textarea>

                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="long_description" class="form-label"> Long Description </label>
                                <textarea name="long_description"
                                    class="form-control @error('long_description') is_invalid
                                @enderror"
                                    id="long_description" cols="30" rows="5">{{ $product->long_description }}</textarea>

                                @error('long_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="additional_info" class="form-label"> Additional Info </label>
                                <textarea name="additional_info"
                                    class="form-control @error('additional_info') is_invalid
                                @enderror"
                                    id="additional_info" cols="30" rows="5">{{ $product->additional_description }}</textarea>

                                @error('additional_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="product-image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="product_image" id="">

                            @error('product_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3 form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" role="switch"
                                id="activeStatus" checked>
                            <label for="activeStatus" class="form-check-lable">Active or Inactive </label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-success">Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('admin_script')
@endpush
