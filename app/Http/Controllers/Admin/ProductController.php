<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public $breadCrumb;

    public function __construct()
    {
        $breadCrumb = explode(".", Route::currentRouteName());
        $this->breadCrumb = $breadCrumb;
    }

    public function index()
    {
        $products = Product::with(['createdBy', 'updatedBy'])->paginate(10);

        return view('admin.product.list', [
            'products' => $products,
            'breadCrumb' => $this->breadCrumb
        ]);
    }

    public function create()
    {
        return view('admin.product.create', ['breadCrumb' => $this->breadCrumb]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,3})?$/'],
            'quantity_available' => ['required', 'integer', 'min:0']
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity_available' => $request->quantity_available,
            'in_stock' => $request->quantity_available,
            'out_stock' => 0,
            'created_user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id
        ]);

        if ($product) {
            // Redirect to products list with success message
            return redirect()->route('admin.product.list')->with('success', 'Product created successfully.');
        } else {
            // Redirect back with error message if creation failed
            return redirect()->back()->with('error', 'Product creation failed. Please try again.');
        }
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'breadCrumb' => $this->breadCrumb,
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,3})?$/'],
            'quantity_available' => $product->in_stock == 0 ? ['required', 'integer', 'min:0'] : ['nullable', 'integer', 'min:0']
        ]);

        $product->name = $request->name;
        $product->price = $request->price;

        if($product->in_stock == 0 ) {
            $product->quantity_available = $request->quantity_available;
            $product->in_stock = $request->quantity_available;
            $product->out_stock = 0;
        }
        
        $product->updated_user_id = Auth::user()->id;

        $product->save();

        return redirect()->route('admin.product.list')->with('success', 'Product updated successfully');
    }

    public function detail(Product $product)
    {
        return view('admin.product.detail', [
            'breadCrumb' => $this->breadCrumb,
            'product' => $product->load(['createdBy', 'updatedBy'])
        ]);
    }

    public function destroy(Product $product)
    {
        $product->forceDelete();

        return redirect()->route('admin.product.list')->with('success', 'Product deleted permanently');
    }

}
