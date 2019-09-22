@extends('master_user')

@section('content')

    <div class="container">
    
        <h3>Payment</h3>
        @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
        <table class="table">
                <thead>
                    <tr>                       
                        <th>Order Id</th>
                        <th>Invoice</th>                     
                        <th>total</th>
                        <th></th>                        
                    </tr>
                </thead>
            <form action="{{url('/addpay')}}" role="form" method="POST">
                    {!! csrf_field() !!}       
                <tbody> 
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input type="hidden" name="item_price_total" value="{{ $order->total }}">
                        <input type="hidden" name="destination" value=" {{ Auth::guard('user')->user()->address }} ">
                        
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->invoice }}</td>                       
                        <td>Rp.{{ $order->total }}</td>
                        <td class=""></td>                       
                    </tr> 
                </tbody>
            </table>
            <br> 
           <br> 
           <br> 
            <div class="col-md-4">
                <table class="table" border="0">
                    <tbody>
                    
                    <tr>
                        <td>Nama : {{ Auth::guard('user')->user()->name }} </td>
                    </tr>
                    <tr>
                        <td>Alamat : {{ Auth::guard('user')->user()->address }} </td>
                    </tr>  
                    <tr>
                        <td>No.Hp : {{ Auth::guard('user')->user()->phone }} </td>
                    </tr>  
                    <tr>
                        <td>Email : {{ Auth::guard('user')->user()->email }} </td>       
                    </tr>      
                    </tbody>
               
                </table>
                </div>
          
            <div class="col-md-4">
                <div class="form-group">
                    <label>Courier</label>
                        <select id="courier" class="form-control" name="courier">
                            
                            @foreach ($ongkir as $row)
                                <option value="{{ $row->kurir }}">{{ ucfirst($row->kurir) }}</option>
                            @endforeach    
                            </select>
                          </div>
                
                <div class="form-group">
                    <label>Service</label>
                    <select id="shipping_cost" class="form-control" name="shipping_cost">
                      <option selected="selected" value="">Choose Service</option>
                      @foreach ($ongkir as $row)
                            <option value="{{ $row->tarif }}">{{ ucfirst($row->layanan).($row->tarif) }}</option>
                    @endforeach    
                    </select>
                  </div>
  
            
                  
                  

                
            </div>
            <div class="col-md-4">
                <table class="table">
                <tr><td><b>Mandiri : </td></tr>
                <tr><td>138-00-114596</td></tr>
                <tr><td>Zulfikar Firmansyah</td></tr>
                </table>    
                <input type="submit" id="payment" class="btn btn-success btn-sm" value="Payment">
            </form> 
            <a href="{{ route('order.pdf', $order->invoice) }}" 
                target="_blank"
                class="btn btn-primary btn-md">
                <i class="fa fa-print"></i> Print
            </a>    
            
            </div>
           
            
            
            
            
        
    </div> <!-- end container -->
 @endsection

 <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous">
</script>

<script>
    jQuery(document).ready(function(){
       jQuery('#cek').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
             url: '',
             method: 'POST',
             data: {
                origin: jQuery('#origin').val(),
                destination: jQuery('#destination').val(),
                courier: jQuery('#courier').val(),
                weight: jQuery('#weight').val()
             },
             success: function(data){
                window.location.href = "{{ url('/pembayaran') }}";
             }});
          });
       });
 </script>