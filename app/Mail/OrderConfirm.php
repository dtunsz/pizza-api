<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Customer;
use App\Order;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;

    protected $orderId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        //
        $this->orderId = $orderId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$order = Order::where('orderId', '=' ,$this->orderId)->get();
        $customer = Customer::where('orderId', '=', $this->orderId)->first();
        $orders = Order::where('orderId', '=', $this->orderId)->get();
        return $this->markdown('email.orders.confirm', compact('orders', 'customer'));
        // return $this->markdown('email.orders.confirm', compact('order'));

    }
}
