<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function list()
    {
        $orders = Order::where('user_id', Auth::user()->id)->paginate(10);
        return view('client.order-history', ['orders' => $orders]);
    }
}
