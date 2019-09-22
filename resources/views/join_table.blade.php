<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 - Join Multiple Table</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Laravel 5.8 - Join Multiple Table</h3>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
           <thead>
            <tr>
                <th>Cust Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>User ID</th>
                <th>Email</th>
            </tr>
           </thead>
           <tbody>
          
            <tr>
             <td>{{ $r->id}}</td>
             <td>{{ $r->name }}</td>
             <td>{{ $r->address }}</td>
             <td>{{ $r->phone }}</td>
             <td>{{ $r->user_id }}</td>
             <td>{{ $r->email }}</td>
            </tr>
           
           </tbody>
       </table>
   </div>
  </div>
 </body>
</html>
