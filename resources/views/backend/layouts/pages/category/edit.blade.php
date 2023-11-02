@extends('backend.layouts.master')

@section('title')
    Category Edit
@endsection

@push('admin_style')
@endpush

@section('admin_content')
    <h1>Category Edit Form</h1>
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
                    <form action="{{ route('category.update', $category->slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="category-title" class="form-lable"> Category Title </label>
                            <input type="text" name="title" value="{{ $category->title }}"
                                class="form-control @error('title') is-invalid @enderror" placeholder="enter category title"
                                id="">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check form-switch">
                            <input type="checkbox" name="is_active" class="form-check-input" role="switch"
                                id="activeStatus" @if ($category->is_active) checked @endif <label for="activeStatus"
                                class="form-check-lable">Active or Inactive </label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('admin_script')
@endpush
