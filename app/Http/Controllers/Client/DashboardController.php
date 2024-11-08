<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $breadCrumb;

    public function __construct() {
        $breadCrumb = explode(".", Route::currentRouteName());
        $this->breadCrumb = $breadCrumb;
    }

    public function index(Request $request) {
        $products = Product::paginate(6);
        $selectedProducts = $request->old('products', []);

        return view('client.dashboard', [
            "breadCrumb" => $this->breadCrumb,
            "products" => $products,
            "selectedProducts" => $selectedProducts
        ]);
    }

    public function perchase(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'required',
        ]);

        dd(1);
    }
}
