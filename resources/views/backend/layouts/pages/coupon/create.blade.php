@extends('backend.layouts.master')

@section('title')
    Coupon Create
@endsection

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('coupon.index') }}" class="btn btn-primary"> <i class="fas fa-backward"></i>
                    Back to Coupon
                </a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card col-6">
                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="coupon-name" class="form-lable"> Coupon Name </label>
                            <input type="text" name="coupon_name"
                                class="form-control @error('coupon_name') is-invalid @enderror"
                                placeholder="Enter Coupon Name" id="">

                            @error('coupon_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="discount_amount" class="form-lable"> Discount Percentage </label>
                            <input type="number" min="0" name="discount_amount"
                                class="form-control @error('discount_amount') is-invalid @enderror"
                                placeholder="Enter Discount Percentage" id="">

                            @error('discount_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="minimum_purchase_amount" class="form-lable"> Minimum Purchase Amount </label>
                            <input type="number" min="0" name="minimum_purchase_amount"
                                class="form-control @error('minimum_purchase_amount') is-invalid @enderror"
                                placeholder="Enter Minimum Purchase Amount" id="">

                            @error('minimum_purchase_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="validity_till" class="form-lable"> Expiry Date </label>
                            <input type="date" name="validity_till"
                                class="form-control @error('validity_till') is-invalid @enderror">

                            @error('validity_till')
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
