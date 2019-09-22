@extends('master_user')

@section('content')

    <div class="container">
        <p><a href="{{ url('shop') }}">Home</a> / Cart</p>
        <h1>Your Cart</h1>

        <hr>

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        @if (sizeof(Cart::content()) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th class="table-image"></th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th class="column-spacer"></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                <form id="form-checkout" action="{{ url('/checkout') }}" method="POST">
                {{ csrf_field() }}
                    @foreach (Cart::content() as $item)
                    <tr>
                        <input type="hidden" name="product_id" value="{{$item->id}}" >
                        <input type="hidden" name="name" value="{{$item->name}}" >
                        <input type="hidden" name="subtotal" value="{{$item->subtotal}}" >
                        <input type="hidden" name="total" value="{{ Cart::instance('default')->subtotal() }}" >
                        <td class="table-image"><a href="{{ url('shop', [$item->model->id]) }}"><img src="{{ asset('uploads/product/' . $item->model->photo) }}" alt="product" class="img-responsive cart-image"></a></td>
                        <td><a href="{{ url('shop', [$item->model->id]) }}">{{ $item->name }} {{$item->model->stock}}</a></td>
                        <td>
                        <select data-id="{{$item->rowId}}" name="qty[]" class="quantity" >
                            <option value="1" {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                            <option value="5" {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                        </select>
                        </td>
                        <td>Rp.{{ $item->subtotal }} </td>
                        <td class=""></td>
                        <td>
                            <button type="button" class="btn btn-danger delete-btn" data-id="{{$item->rowId}}" >Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                        <td>Rp.{{ Cart::instance('default')->subtotal() }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    

                    <!-- <tr class="border-bottom">
                        <td class="table-image"></td>
                        <td style="padding: 40px;"></td>
                        <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                        <td class="table-bg">Rp.{{ Cart::total() }}</td>
                        <td class="column-spacer"></td>
                        <td></td>
                    </tr> -->
                    </form>
                </tbody>
            </table>

            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
            <a href="{{url('/checkout')}}" id="checkout" class="btn btn-success btn-lg">Proceed to Checkout</a>

            <div style="float:right">
                <form action="{{ url('/emptyCart') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger btn-lg" value="Empty Cart">
                </form>
            </div>

        @else

            <h3>You have no items in your shopping cart</h3>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>

        @endif

        <div class="spacer"></div>

    </div> <!-- end container -->

@endsection

@section('extra-js')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '{{ url("/cart") }}' + '/' + id,
                  data: {
                    'quantity': this.value,
                  },
                  success: function(data) {
                    window.location.href = '{{ url('/cart') }}';
                  }
                });

            });

        })();

        // $('#checkout').click(function(){
        //     console.log('test')
        //     $('#form-checkout').submit()
        // })

        $('.delete-btn').click(function(){
            console.log($(this).attr("data-id"))
            $.ajax({
                url:"/cart/"+$(this).attr("data-id"),
                type:'post',
                data : { '_method': 'DELETE' },
                success: function(result){
                    window.location.href = '{{ url('/cart') }}';
                }
            })
        })

    </script>
@endsection
