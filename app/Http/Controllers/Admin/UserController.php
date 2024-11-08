<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public $breadCrumb;

    public function __construct()
    {
        $breadCrumb = explode(".", Route::currentRouteName());
        $this->breadCrumb = $breadCrumb;
    }

    public function index()
    {
        $users = User::paginate(10);

        return view('admin.user.list', [
            'users' => $users,
            'breadCrumb' => $this->breadCrumb
        ]);
    }

    public function create()
    {
        return view('admin.user.create', ['breadCrumb' => $this->breadCrumb]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', 'max:6'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        DB::transaction(function() use($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $role = Role::findByName($request->role);
            $user->assignRole($role);

            event(new Registered($user));
        });

        return redirect()->route('admin.user.list');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'breadCrumb' => $this->breadCrumb,
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id,],
            'role' => ['required', 'string', 'max:6'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $role = Role::findByName($request->role);
        $user->assignRole($role);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'User updated successfully');
    }

    public function detail(User $user)
    {
        return view('admin.user.detail', [
            'breadCrumb' => $this->breadCrumb,
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->forceDelete();

        return redirect()->route('admin.user.list')->with('success', 'User deleted permanently');
    }
}
