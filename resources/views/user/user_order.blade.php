<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Order</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">User Order</h3>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
       
           <thead align="center">
            <tr align="center">
                <th>Order Id</th>
                <th>Invoice</th>
                                 
                <th>Total</th>
                <th>Status</th> 
                <th>Resi</th>
                <th>Order Details</th>
            </tr>
           </thead>
           <tbody>
            @forelse ($join as $row)
          
            <tr align="center">
             <td>{{$row->id}}</td>
             <td>{{$row->invoice}}</td>
                  
             <td>{{$row->total_payment}}</td>
             <td>{{$row->status}}</td>
             <td>{{$row->resi}}</td>
             <td><a href="{{url('user/orderdet', $row->id)}}" class="btn btn-info">Details</a></td>
             
            </tr>
       
           
          @empty
                <tr><td>Belum ada Transaksi</td></tr>
          @endforelse  
           </tbody>
       </table>
   </div>
  </div>
 </body>
</html>
