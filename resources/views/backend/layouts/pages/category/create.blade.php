@extends('backend.layouts.master')

@section('title')
    Category Create
@endsection

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('category.index') }}" class="btn btn-primary"> <i class="fas fa-backward"></i>
                    Back to Category
                </a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="category-title" class="form-lable"> Category Title </label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="enter category title" id="">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category-image" class="form-label">Category Image</label>
                            <input type="file" class="form-control" name="category_image" id="">

                            @error('category_image')
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
