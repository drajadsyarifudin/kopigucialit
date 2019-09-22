@extends('master_user')

@section('content')
<div class="container">
@if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif

                            <table border="0">
            <tr>
            <td>Payment Id : {{$p->id}} </td>
            </tr><tr>
            <td>Order Id : {{$p->order_id}}</td>
            </tr><tr>
            <td>Item Price : {{$p->item_price_total}}</td>
            </tr><tr>
            <td>Shipping : {{$p->shipping_cost}}</td>
            </tr><tr>
            <td>Total Price : {{$p->total_payment}}</td>
            </tr>
            
            
            <tr>
                <td> <a href="{{url('/confirmpayment', $p->id)}}" class="btn btn-warning btn-sm">Konfirmasi</a></td>
            </tr>
        </table>                      
</div>
@endsection  