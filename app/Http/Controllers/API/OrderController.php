<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirm;

class OrderController extends Controller
{

    /**
     *  Makes an order become delivered, also Confirms If an order is Delivered
     */

    public function delivered($orderId){
        $order = Customer::where('orderId', '=' ,$orderId)->first();
        if ($order) {
            if ($order->delivered === 1) {
                return response()->json([
                    'message' => 'Order is already delivered',
                    'order' => $order
                ], 200);
            } else {
                $order->delivered = 1;
                $order->save();

                return response()->json([
                    'message' => 'Order Delivered',
                    'order' => $order
                ], 200);
            }
        } 
        if ($order === null) {
            return response()->json([
                'error' => [            
                'message' => 'Order not found now'
            ]], 400);
        }

    }

    /**Confirms an order so it can be delivered */
    public function confirmed ($orderId){
        $customer = Customer::where('orderId', '=' ,$orderId)->first();

        if ($customer) {
            if ($customer->confirmed === 1) {
                $order = Customer::where('orderId', '=', $orderId)->with('orders')->get();
                return response()->json([
                    'message' => 'Order is already confirmed',
                    'order' => $order
                ], 200);
            } else {
                $customer->confirmed = 1;
                $customer->save();
                $order = Customer::where('orderId', '=', $orderId)->with('orders')->get();
                return response()->json([
                    'message' => 'Order Confirmed',
                    'order' => $order
                ], 200);
            }
        }
        if ($order === null) {
            return response()->json([
                'message' => 'Order not found'
            ], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        return response()->json([
            'message' => "Fetch Completed",
            'orders' => $orders
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $orders = $request['cart'];
        $customer = new Customer;
        $upperLetter = chr(rand(65,90));
        $lowerLetter = chr(rand(97,122));
        $generatedOrderId = $lowerLetter.time().$upperLetter;
        $customer->orderId = $generatedOrderId;
        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->phone = $request['phone'];
        $customer->city = $request['city'];
        $customer->houseNumber = $request['house'];
        $customer->streetName = $request['street'];
        $customer->orderPriceEur = $request['orderPriceEur'];
        $customer->orderPriceUsd = $request['orderPriceUsd'];
        $customer->save();

        foreach ($orders as $order) {
            $item = new Order;
            $item->orderId = $generatedOrderId;
            $item->productName = $order['name'];
            $item->productPrice  = $order['price'];
            $item->quantity = $order['units'];
            $item->save();
        }
        // Mail::to($request['email'])->send(new OrderConfirm($generatedOrderId));

        $all = Customer::where('orderId', '=', $generatedOrderId)->with('orders')->get();
        if($all) {
            return response()->json([
                'message' => 'Order Created',
                'order' => $all
            ], 200);
        } else {
            return response()->json([
            'message' => 'Error Making Order',
        ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    //public function show(Order $order)
    public function show($order)
    {
        //
        $all = Customer::where('orderId', '=', $order)->with('orders')->get();
        return response()->json([
            'message' => "Order Fetched",
            'order' => $all
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
