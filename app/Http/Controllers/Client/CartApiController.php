<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;

class CartApiController extends Controller
{
    public function checkout(Request $request)
    {
        // Define validation rules
        $rules = [
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,3})?$/',
            'items.*.price' => 'required|numeric|min:0.01',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        foreach ($request->items as $productId => $details) {
            $product = Product::find($productId);
            
            if (!$product) {
                return response()->json(['error', 'One of the products in your cart does not exist.'], 422);
            }

            if ($product->in_stock < $details['quantity']) {
                return response()->json(['error', "The product '{$product->name}' is out of stock or does not have enough stock."], 422);
            }
        }

        // Calculate total
        $total = 0;
        foreach ($request->items as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        DB::beginTransaction();

        try {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
            ]);

            // Create each order item and update the product stock
            foreach ($request->items as $productId => $details) {
                $product = Product::find($productId);

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'user_id' => Auth::id(),
                ]);

                // Reduce the product's in_stock
                $product->in_stock -= $details['quantity'];
                $product->out_stock += $details['quantity'];
                $product->save();
            }

            DB::commit();

            return response()->json(['success', 'Order placed successfully!']);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json(['error', 'Failed to place order. Please try again.']);
        }

    }
}
