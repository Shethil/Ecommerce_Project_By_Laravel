<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Billing;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Upazila;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        $carts = Cart::content();
        $total_price = Cart::subtotal();
        $districts = District::select('id', 'name', 'bn_name')->get();
        return view('frontend.pages.checkout', compact('carts', 'total_price', 'districts'));
    }

    public function loadUpazillaAjax($district_id)
    {
        $upazilas = Upazila::where('district_id', $district_id)->select('id', 'name')->get();
        return response()->json($upazilas, 200);

    }

    public function placeOrder(OrderStoreRequest $request)
    {

        // Insert data into Billing table
        $billing = Billing::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'order_notes' => $request->order_notes,
        ]);

        // Insert data into Order table
        $order = Order::create([
            'user_id' => Auth::id(),
            'billing_id' => $billing->id,
            'sub_total' => Session::get('coupon')['cart_total'] ?? Cart::subtotal(),
            'discount_amount' => Session::get('coupon')['discount_amount'] ?? 0,
            'coupon_name' => Session::get('coupon')['name'] ?? '',
            'total' => Session::get('coupon')['balance'] ?? Cart::subtotal(),
        ]);

        // Insert data into Order Details table

        foreach (Cart::content() as $cart_item) {
            OrderDetails::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'product_id' => $cart_item->id,
                'product_qty' => $cart_item->qty,
                'product_price' => $cart_item->price,
            ]);

            // update product table with decrement quantity

            Product::findOrFail($cart_item->id)->decrement('product_stock', $cart_item->qty);

        }
        // forceDelete from cart table
        Cart::destroy();
        Session::forget('coupon');

        Toastr::success('Your Order placed successfully!!!', 'Success');

        return redirect()->route('cart.page');
    }

}