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
            <?php $__empty_1 = true; $__currentLoopData = $join; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          
            <tr align="center">
             <td><?php echo e($row->id); ?></td>
             <td><?php echo e($row->invoice); ?></td>
                  
             <td><?php echo e($row->total_payment); ?></td>
             <td><?php echo e($row->status); ?></td>
             <td><?php echo e($row->resi); ?></td>
             <td><a href="<?php echo e(url('user/orderdet', $row->id)); ?>" class="btn btn-info">Details</a></td>
             
            </tr>
       
           
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td>Belum ada Transaksi</td></tr>
          <?php endif; ?>  
           </tbody>
       </table>
   </div>
  </div>
 </body>
</html>
