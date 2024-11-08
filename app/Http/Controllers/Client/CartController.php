<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add Product to Cart
    public function addToCart(Request $request, $productId)
    {
        // Find the product by its ID
        $product = Product::findOrFail($productId);

        // Check if the cart session already exists, if not, create it
        $cart = session()->get('cart', []);

        // If the product is already in the cart, increase the quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            // Add the product to the cart
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        // Update the session with the cart
        session()->put('cart', $cart);

        // Redirect to the cart page or back to the product list
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return view('cart.index', compact('total'));
    }

    // Remove Product from Cart
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('dashboard')->with('error', 'Your cart is empty.');
        }

        // Validate stock availability for each product
        foreach ($cart as $productId => $details) {
            $product = Product::find($productId);
            
            if (!$product) {
                return redirect()->route('product.index')->with('error', 'One of the products in your cart does not exist.');
            }

            if ($product->in_stock < $details['quantity']) {
                return redirect()->route('product.index')->with('error', "The product '{$product->name}' is out of stock or does not have enough stock.");
            }
        }

        // Calculate total
        $total = 0;
        foreach ($cart as $details) {
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
            foreach ($cart as $productId => $details) {
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
                $product->save();
            }

            DB::commit();

            // Clear the cart after a successful transaction
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function success(Order $order)
    {
        return view('cart.success', ['order' => $order]);
    }
}
