<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Order;
use App\Customer;
use Faker\Factory;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testApiRouteMakeOrder()
    {
        $data = [
            "name" => $this->faker->word,
            "email" => $this->faker->email,
            "phone" => $this->faker->phoneNumber,
            "orderId" => $this->faker->bothify('??##??#'),
            "house" => $this->faker->randomDigit,
            "street" => $this->faker->streetName,
            "city" => $this->faker->city,
            "orderPriceEur" => $this->faker->numberBetween($min = 99, $max = 500),
            "orderPriceUsd" => $this->faker->numberBetween($min = 150, $max = 800),
            "cart" => [ 
                ['name' => "sku_xt70ah4", 'price' => 47, 'id' => 1, 'units' => 4], 
                ['name' => "sku_wj65jz4", 'price' => 65, 'id' => 2, 'units' => 5] 
                ]
        ];
        $this->post(route('orders.store', $data))
            ->assertStatus(200)
            ->assertJson(['message' => 'Order Created']);
    }

    /**
     * @test
     */
    public function testApiRouteViewOneOrder()
    {
        $order = factory(Customer::class)->create();
        $this->get(route('orders.show', $order->orderId))
            ->assertStatus(200)
            ->assertJson(['message' => "Order Fetched"]);
    }

    public function testApiRouteConfirmAnOrder()
    {
        $order = factory(Customer::class)->create();
        $this->post(route('orders.confirmed', $order->orderId))
            ->assertStatus(200)
            ->assertJson(['message' => "Order Confirmed"]);
    }

    public function testApiRouteDeliverAnOrder()
    {
        $order = factory(Customer::class)->create();
        $this->post(route('orders.delivered', $order->orderId))
            ->assertStatus(200)
            ->assertJson(['message' => "Order Delivered"]);
    }



}
