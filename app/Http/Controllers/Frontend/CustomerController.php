<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $customer = Auth::user();
        return view('frontend.pages.customer-dashboard', compact('customer'));
    }
}