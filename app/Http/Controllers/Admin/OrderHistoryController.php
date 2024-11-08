<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

class OrderHistoryController extends Controller
{
    public $breadCrumb;

    public function __construct() {
        $breadCrumb = explode(".", Route::currentRouteName());
        $this->breadCrumb = $breadCrumb;
    }

    public function index()
    {
        $orders = Order::with(['items', 'user'])->paginate(10);

        return view('admin.order.list', [
            'breadCrumb' => $this->breadCrumb,
            'orders' => $orders
        ]);
    }

    public function detail(Order $order)
    {
        return view('admin.order.detail', [
            'breadCrumb' => $this->breadCrumb,
            'order' => $order->load(['items', 'user'])
        ]);
    }
}
