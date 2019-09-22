<?php $__env->startSection('content'); ?>

    <div class="container">
    
        <h3>Payment</h3>
        <?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
        <table class="table">
                <thead>
                    <tr>                       
                        <th>Order Id</th>
                        <th>Invoice</th>                     
                        <th>total</th>
                        <th></th>                        
                    </tr>
                </thead>
            <form action="<?php echo e(url('/addpay')); ?>" role="form" method="POST">
                    <?php echo csrf_field(); ?>       
                <tbody> 
                        <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                        <input type="hidden" name="item_price_total" value="<?php echo e($order->total); ?>">
                        <input type="hidden" name="destination" value=" <?php echo e(Auth::guard('user')->user()->address); ?> ">
                        
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->invoice); ?></td>                       
                        <td>Rp.<?php echo e($order->total); ?></td>
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
                        <td>Nama : <?php echo e(Auth::guard('user')->user()->name); ?> </td>
                    </tr>
                    <tr>
                        <td>Alamat : <?php echo e(Auth::guard('user')->user()->address); ?> </td>
                    </tr>  
                    <tr>
                        <td>No.Hp : <?php echo e(Auth::guard('user')->user()->phone); ?> </td>
                    </tr>  
                    <tr>
                        <td>Email : <?php echo e(Auth::guard('user')->user()->email); ?> </td>       
                    </tr>      
                    </tbody>
               
                </table>
                </div>
          
            <div class="col-md-4">
                <div class="form-group">
                    <label>Courier</label>
                        <select id="courier" class="form-control" name="courier">
                            
                            <?php $__currentLoopData = $ongkir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->kurir); ?>"><?php echo e(ucfirst($row->kurir)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                            </select>
                          </div>
                
                <div class="form-group">
                    <label>Service</label>
                    <select id="shipping_cost" class="form-control" name="shipping_cost">
                      <option selected="selected" value="">Choose Service</option>
                      <?php $__currentLoopData = $ongkir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($row->tarif); ?>"><?php echo e(ucfirst($row->layanan).($row->tarif)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
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
            <a href="<?php echo e(route('order.pdf', $order->invoice)); ?>" 
                target="_blank"
                class="btn btn-primary btn-md">
                <i class="fa fa-print"></i> Print
            </a>    
            
            </div>
           
            
            
            
            
        
    </div> <!-- end container -->
 <?php $__env->stopSection(); ?>

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
                window.location.href = "<?php echo e(url('/pembayaran')); ?>";
             }});
          });
       });
 </script>
<?php echo $__env->make('master_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>