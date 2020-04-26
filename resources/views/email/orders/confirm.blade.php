@component('mail::message')

# Dear {{$customer->name}}


# Your Order

@component('mail::table')
| #  | Name       | Price        | Quantity  |
| -- | ---------- | ------------:| ---------:|
@foreach ($orders as $key=>$order)
| {{$key+1}} | {{$order->productName}} | {{$order->productPrice}} | {{$order->quantity}} |
@endforeach
@endcomponent


@php
    $link = 'http://localhost:3000/confirm/'.$customer->orderId
@endphp

# Click the Confirm button below to confirm your order

@component('mail::button', ['url' => $link , 'color' => 'green'])
Confirm
@endcomponent

# Alternatively you can copy and paste the link below in your browser

{{$link}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
