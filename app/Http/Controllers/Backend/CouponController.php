<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest('id')->paginate(10);
        return view('backend.layouts.pages.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.pages.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStoreRequest $request)
    {
        Coupon::create([
            'coupon_name' => $request->coupon_name,
            'discount_amount' => $request->discount_amount,
            'minimum_purchase_amount' => $request->minimum_purchase_amount,
            'validity_till' => $request->validity_till,
        ]);

        Toastr::success('Data Store Successfully');
        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('backend.layouts.pages.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponUpdateRequest $request, string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->update([
            'coupon_name' => $request->coupon_name,
            'discount_amount' => $request->discount_amount,
            'minimum_purchase_amount' => $request->minimum_purchase_amount,
            'validity_till' => $request->validity_till,
            'is_active' => $request->filled('is_active'),
        ]);

        Toastr::success('Data Update Successfully');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id)->delete();
        Toastr::success('Data Deleted Successfully!');
        return redirect()->route('coupon.index');
    }
}
