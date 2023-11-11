@extends('backend.layouts.master')

@section('title')
    Testimonial Create
@endsection

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('testimonial.index') }}" class="btn btn-primary"> <i class="fas fa-backward"></i>
                    Back to Testimonial
                </a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="client-name" class="form-lable"> Client Name </label>
                            <input type="text" name="client_name"
                                class="form-control @error('client_name') is-invalid @enderror"
                                placeholder="enter client name" id="">

                            @error('client_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="client-designation" class="form-lable"> Client designation </label>
                            <input type="text" name="client_designation"
                                class="form-control @error('client_designation') is-invalid @enderror"
                                placeholder="enter client designation" id="">

                            @error('client_designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="client-message" class="form-lable"> Client message </label>
                            <textarea name="client_message" class="form-control @error('client_message') is-invalid @enderror" cols="30"
                                rows="5" placeholder="enter client message" id=""> </textarea>

                            @error('client_message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="client-image" class="form-label">Client Image</label>
                            <input type="file" class="form-control dropify" name="client_image" id="">

                            @error('client_image')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('dropify').dropify();
    </script>
@endpush
