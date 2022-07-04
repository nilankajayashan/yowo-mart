<!doctype html>
<html lang="en">
<head>
    @include('template/header')
</head>
<body>
    @if(isset($order))
        <div class="container mt-5 ">
            <div class="row justify-content-evenly">
                <div class="col-lg-6">
                    <div class="card col-lg-12">
                        <h6 class="card-header"> Order-#{{ $order->id }}</h6>
                        <div class="card-body">
                            @if(isset($order->cart) && $order->cart != null && $order->cart != '')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach(json_decode($order->cart) as $roew => $product)
                                            <tr>
                                            <td>
                                                {{json_decode(json_encode($product))->name}}
                                            </td>
                                            <td>
                                                {{json_decode(json_encode($product))->unit_price}}
                                            </td>
                                            <td>
                                                {{json_decode(json_encode($product))->quantity}}
                                            </td>
                                            <td>
                                               Rs.{{json_decode(json_encode($product))->unit_price * json_decode(json_encode($product))->quantity}}/=

                                            </td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-secondary text-white">
                                            <td colspan="3" class="text-end">Total to Product: </td>
                                            <td>Rs.{{ $order->total - $order->shipping_price }}/=</td>
                                        </tr>
                                        <tr class="bg-secondary text-white">
                                            <td colspan="3" class="text-end">to Shipping: </td>
                                            <td>Rs.{{ $order->shipping_price  }}/=</td>
                                        </tr>
                                        <tr class="bg-secondary text-white">
                                            <td colspan="3" class="text-end">Order Total: </td>
                                            <td>Rs.{{ $order->total  }}/=</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-primary d-flex align-items-center" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div>
                                        Can not find cart details.
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-lg-12 card">
                        <h6 class="card-header">Order Details</h6>
                        <div class="card-body">
                            <h6  class="d-inline-flex">Order Status:</h6>
                                        @if($order->order_status == 'failed')
                                            <h6 class="d-inline-flex"><span class="badge bg-danger">{{ $order->order_status }}</span></h6>
                                        @elseif($order->order_status == 'pending')
                                            <h6 class="d-inline-flex"><span class="badge bg-secondary">{{ $order->order_status }}</span></h6>
                                        @elseif($order->order_status == 'processing')
                                            <h6 class="d-inline-flex"><span class="badge bg-primary">{{ $order->order_status }}</span></h6>
                                        @elseif($order->order_status == 'processed')
                                            <h6 class="d-inline-flex"><span class="badge bg-info">{{ $order->order_status }}</span></h6>
                                        @elseif($order->order_status == 'shipped')
                                            <h6 class="d-inline-flex"><span class="badge bg-warning">{{ $order->order_status }}</span></h6>
                                        @elseif($order->order_status == 'completed')
                                            <h6 class="d-inline-flex"><span class="badge bg-success">{{ $order->order_status }}</span></h6>
                                        @else
                                            <h6 class="d-inline-flex"><span class="badge bg-dark">{{ $order->order_status }}</span></h6>
                                        @endif
                            <br>
                            <h6  class="d-inline-flex">Ordered Date:</h6>
                            <span class="d-inline-flex">{{ $order->created_at }}</span>
                            <br>
                            <h6  class="d-inline-flex">Updated @:</h6>
                            <span class="d-inline-flex">{{ $order->updated_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-evenly mt-lg-3 ">
                <div class="col-lg-5">
                    <div class="card col-12">
                        <h6 class="card-header">Payment Details</h6>
                        <div class="card-body justify-content-start">
                            <h6 class="d-inline-flex" >Payment Method: </h6>
                            <span  class="d-inline-flex">
                                    @switch($order->payment_method)
                                    @case('cod')
                                    Cash On Delivery
                                    @break
                                    @case('payhere')
                                    PAYHERE | Online
                                    @break
                                    @default
                                    Not Found!
                                    @break
                                @endswitch
                                </span>
                            <br>
                            <h6 class="d-inline-flex">Payment Status: </h6>
                            <h6 class="d-inline-flex"><span class="badge
                                 @switch($order->payment_status )
                                        @case('pending')
                                            bg-secondary
                                            @break
                                        @case('failed')
                                            bg-danger
                                            @break
                                        @case('success')
                                            bg-success
                                            @break
                                        @default
                                            bg-primary
                                            @break
                                @endswitch
                            ">{{ $order->payment_status }}</span></h6>
                            <br>
                            <h6 class="d-inline-flex">Total Bill: </h6>
                            <h6 class="d-inline-flex">Rs.{{ $order->total }}/=</h6>

                            <hr>
                            <h6 class="d-inline-flex">Payed By: </h6>
                            <span class="d-inline-flex">
                                {{ ucwords($order->payment_name) }} {{ '@' }}{{ ucwords($order->payment_city) }},{{ ucwords($order->payment_country) }}.
                            </span>
                            <br>
                            <h6 class="d-inline-flex">Payer Email: </h6>
                            <span class="d-inline-flex">
                                {{ ucwords($order->payment_email) }}
                            </span>
                            <br>
                            <h6 class="d-inline-flex">Payer Mobile: </h6>
                            <span class="d-inline-flex">
                                {{ ucwords($order->payment_mobile) }}
                            </span>
                            <br>
                            <h6 class="d-inline-flex">Payer Address: </h6>
                            <span class="d-inline-flex">
                                {{ ucwords($order->payment_address).','.ucwords($order->payment_city).','.ucwords($order->payment_country) }}

                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="col-12 card">
                        <h6 class="card-header">Shipping Details</h6>
                        <div class="card-body justify-content-start">
                            <h6 class="d-inline-flex" >Shipping Method: </h6>
                            <span  class="d-inline-flex">
                                    @switch($order->shipping_method)
                                        @case('free_shipping')
                                            Free Shipping
                                            @break
                                        @case('24_7_shipping')
                                            One Day (24/7) Shipping
                                            @break
                                        @default
                                            Not Found!
                                        @break
                                    @endswitch
                                </span>
                            <br>
                            <h6 class="d-inline-flex">Shipping Fee: </h6>
                            <span class="d-inline-flex">Rs.{{ $order->shipping_price }}/=</span>
                            <hr>

                            <h6 class="d-inline-flex">Reciver: </h6>
                            <span class="d-inline-flex">{{ ucwords($order->shipping_name)}}</span>
                            <br>
                            <h6 class="d-inline-flex">Reciver Email: </h6>
                            <span class="d-inline-flex">{{ ucwords($order->shipping_email)}}</span>
                            <br>
                            <h6 class="d-inline-flex">Reciver Mobile: </h6>
                            <span class="d-inline-flex">{{ ucwords($order->shipping_mobile)}}</span>
                            <br>
                            <h6 class="d-inline-flex">Shipped to: </h6>
                            <span class="d-inline-flex">{{ ucwords($order->shipping_address1).','.ucwords($order->shipping_city).'('.ucwords($order->shipping_postal_code).') ,'.ucwords($order->shipping_district).','.ucwords($order->shipping_country).'.' }}</span>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
           Can not find this order details.
        </div>
    </div>
    @endif
</body>
</html>
