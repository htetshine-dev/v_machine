<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Role;
use App\Models\Product;
use Tests\TestCase;
use App\Models\Order;

class OrderCheckoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_guest_cannot_checkout()
    {
        $response = $this->post('/checkout');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_checkout()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create([
            'name' => 'client',
            'guard_name' => 'web'
        ]);
        $user->assignRole($role->name);
        $product = Product::factory()->create([
            'name' => 'test1',
            'price' => 100,
            'quantity_available' => 20,
            'in_stock' => 20,
            'out_stock' => 0
        ]);


        $this->actingAs($user);
        
        session()->put('cart', [
            "1" => [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ]
        ]);

        $response = $this->post('/checkout');

        $order = Order::first();

        $response->assertRedirect(route('checkout.success', $order));
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total_amount' => 100,
        ]);
    }

    public function test_checkout_fails_if_insufficient_stock()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create([
            'name' => 'client',
            'guard_name' => 'web'
        ]);
        $user->assignRole($role->name);
        $product = Product::factory()->create([
            'name' => 'test1',
            'price' => 100,
            'quantity_available' => 20,
            'in_stock' => 0,
            'out_stock' => 20
        ]);

        $this->actingAs($user);

        session()->put('cart', [
            "1" => [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ]
        ]);

        $response = $this->post('/checkout');

        $response->assertSessionHas('error');
        $response->assertRedirect(route('dashboard'));
    }
}
