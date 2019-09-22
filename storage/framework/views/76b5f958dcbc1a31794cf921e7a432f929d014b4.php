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
     <h3 align="center">Order</h3>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
   
   
           <thead align="center">
            <tr align="center">
                <th>Id</th>
                <th>Order Id</th>
                <th>Product Id</th>               
                <th>Qty</th>
                <th>Price</th>
                <th>Date</th>
                
            </tr>
           </thead>
           <tbody>
           <?php $__currentLoopData = $det; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr align="center">
             <td><?php echo e($row->id); ?></td>
             <td><?php echo e($row->order_id); ?></td>
             <td><?php echo e($row->product_id); ?></td>       
             <td><?php echo e($row->qty); ?></td>
             <td><?php echo e($row->price); ?></td>
             <td><?php echo e($row->created_at); ?></td>
             
             
            </tr>
            
           </tbody>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </table>
       
   </div>
  </div>
 </body>
</html>
