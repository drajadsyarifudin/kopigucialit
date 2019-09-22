@extends('master_user')

@section('content')

    <div class="container">
       
        <h3>Confirm Checkout</h3>
        @if (session('error'))
            @alert(['type' => 'danger'])
                {!! session('error') !!}
                                @endalert
                            @endif
        <table class="table">
                <thead>
                    <tr>
                        <th class="table-image"></th>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th></th>                        
                    </tr>
                </thead>
                <form role="form" action="{{ route('buyorder') }}" method="POST">
                        {!! csrf_field() !!}   
                <tbody> 
                    
                    @foreach (Cart::content() as $item)
                    <tr>                           
                        <input type="hidden" name="product_id" value="{{$item->id}}">
                        <input type="hidden" name="qty" value="{{$item->qty}}">
                        
                        <input type="hidden" name="price" value="{{ $item->subtotal }}" >                           
                        <td class="table-image"><img src="{{ asset('uploads/product/' . $item->model->photo) }}" alt="product" class="img-responsive cart-image"></a></td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td> {{$item->qty}} </td>                        
                        <td>Rp.{{ $item->subtotal }}</td>
                        <td class=""></td>                       
                    </tr>
                    @endforeach
                    
                    <input type="hidden" name="user_id" value="{{ Auth::guard('user')->user()->id}}">
                    <input type="hidden" name="total" value="{{ Cart::instance('default')->subtotal() }}" >
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                        <td>{{ Cart::instance('default')->subtotal() }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    

                    
                    
                </tbody>
            </table>
        
        
            <div class="col-md-4">
            <div class="form-group">
                <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::guard('user')->user()->name }}" required>
            </div>
            <div class="form-group">  
                <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ Auth::guard('user')->user()->email }}">   
            </div>
            <div class="form-group">  
                <label for="address">Alamat</label>
                   
                    <textarea name="address" id="address" class="form-control" value="">{{ Auth::guard('user')->user()->address }}</textarea>         
            </div>

            <div class="form-group">  
                <label for="phone">No.Hp</label>
                    <input type="number" name="phone" value="{{ Auth::guard('user')->user()->phone }}" class="form-control">   
            </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Origin</label>
                    <input type="text" name="" value="Lumajang" class="form-control" readonly>
                    <input type="hidden" name="origin" value="243">
                    <input type="hidden" name="weight" value="1000">
                  </div>
  
                  <div class="form-group">
                    <label>Destination</label>
                    <select id="destination" class="form-control" name="destination">
                      <option selected="selected" value="">Pilih Destination</option>
                      @for($i=0; $i < count($city_result['rajaongkir']['results']); $i++)
                          <option value="{{$city_result['rajaongkir']['results'][$i]['city_id']}}">{{$city_result['rajaongkir']['results'][$i]['city_name']}}</option>";
                      @endfor
                    </select>
                  </div>
                  <div class="from-group">
                      <label>Kurir</label>
                      <select id="courier" name="courier" class="form-control">
                          <option value="jne">JNE</option>
                          <option value="tiki">TIKI</option>
                          <option value="pos">POS INDONESIA</option>
                      </select>
                  </div>
            </div>
      

            
        
            
            
            
            
            <div style="float:right">
            <input type="submit" class="btn btn-success btn-lg" value="Buy">
            </div>
            </form>
        
            </div> <!-- end container -->
 @endsection

<!-- <script>
    $('#order').click(function(){
        var product_id, qty, price
    })
</script> -->
 