<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public $breadCrumb;

    public function __construct() {
        $breadCrumb = explode(".", Route::currentRouteName());
        $this->breadCrumb = $breadCrumb;
    }

    public function index() {
        return view('admin.dashboard', ["breadCrumb" => $this->breadCrumb]);
    }
}
