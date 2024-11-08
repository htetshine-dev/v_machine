<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class OrderHistoryController extends Controller
{
    public $breadCrumb;

    public function __construct() {
        $breadCrumb = explode(".", Route::currentRouteName());
        $this->breadCrumb = $breadCrumb;
    }

    public function list()
    {
        $orders = Order::where('user_id', Auth::user()->id)->paginate(10);

        if(Arr::first($this->breadCrumb) == 'api') {
            return $orders;
        }
        return view('client.order-history', ['orders' => $orders]);
    }
}
