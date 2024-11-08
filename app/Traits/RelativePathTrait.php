<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

trait RelativePathTrait
{
    protected $relativeIntended;

    protected $relativeRoute;

    protected $relativeView;
    
    protected $relativeRole;

    public function setRelativePaths()
    {
        if (request()->is('admin/*')) {
            $this->relativeIntended = RouteServiceProvider::ADMINHOME;
            $this->relativeRoute = "admin.login";
            $this->relativeView = 'auth.adminLogin';
            $this->relativeRole = 'admin';
        } else {
            $this->relativeIntended = RouteServiceProvider::HOME;
            $this->relativeRoute = "login";
            $this->relativeView = 'auth.clientLogin';
            $this->relativeRole = 'client';
        }
    }
}