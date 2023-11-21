<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartPage()
    {
        $carts = Cart::content();
        $total_price = Cart::subtotal();
        return view('frontend.pages.shopping-cart', compact('carts', 'total_price'));
    }

    public function addTocart(Request $request)
    {
        $product_slug = $request->product_slug;
        $order_qty = $request->order_qty;

        $product = Product::whereSlug($product_slug)->first();

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->product_price,
            'weight' => 0,
            'product_stock' => $product->product_stoke,
            'qty' => $order_qty,
            'options' => [
                'product_image' => $product->product_image,
            ],
        ]);

        Toastr::success('Product Added into Cart');
        return back();
    }

    public function removeFromCart($cart_id)
    {
        Cart::remove($cart_id);
        Toastr::info('Product Remove From Cart!!');
        return back();
    }

    public function couponApply(Request $request)
    {
        // dd($request->all());

        if (!Auth::check()) {
            Toastr::error('You must need to login first!!');
            return redirect()->route('login.page');
        }

        $check = Coupon::where('coupon_name', $request->coupon_name)->first();

        if (Session::get('coupon')) {
            Toastr::error('Already applied coupon!!', 'Info!!');
            return redirect()->back();
        }

        if ($check != null) {

            $check_validity = $check->validity_till > Carbon::now()->format('Y-m-d');

            // Get the subtotal as a formatted string
            $subTotalString = Cart::subtotal();
            // Remove formatting and convert to float
            $subTotalFloat = floatval(str_replace(',', '', $subTotalString));

            if ($check_validity) {

                Session::put('coupon', [
                    'name' => $check->coupon_name,
                    'discount_amount' => round(($subTotalFloat * $check->discount_amount) / 100),
                    'cart_total' => round($subTotalFloat),
                    'balance' => round($subTotalFloat - ($subTotalFloat * $check->discount_amount) / 100),
                ]);

                Toastr::success('coupon Percentage Applied!!', 'Successfully');
                return redirect()->back();
            } else {
                Toastr::error('Coupon Date Expire!!!', 'Info!!!');
                return redirect()->back();

            }
        } else {
            Toastr::error('Invalid Action/Coupon! Check, Empty Cart');
            return redirect()->back();
        }
    }

    public function removeCoupon($coupon_name)
    {
        Session::forget('coupon');
        Toastr::success('Coupon Removed', 'Successfully!!');
        return redirect()->back();
    }
}
