<?php $__env->startSection('content'); ?>

    <div class="container">
       
        <h3>Confirm Checkout</h3>
        <?php if(session('error')): ?>
            <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
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
                <form role="form" action="<?php echo e(route('buyorder')); ?>" method="POST">
                        <?php echo csrf_field(); ?>   
                <tbody> 
                    
                    <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>                           
                        <input type="hidden" name="product_id" value="<?php echo e($item->id); ?>">
                        <input type="hidden" name="qty" value="<?php echo e($item->qty); ?>">
                        
                        <input type="hidden" name="price" value="<?php echo e($item->subtotal); ?>" >                           
                        <td class="table-image"><img src="<?php echo e(asset('uploads/product/' . $item->model->photo)); ?>" alt="product" class="img-responsive cart-image"></a></td>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->name); ?></td>
                        <td> <?php echo e($item->qty); ?> </td>                        
                        <td>Rp.<?php echo e($item->subtotal); ?></td>
                        <td class=""></td>                       
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <input type="hidden" name="user_id" value="<?php echo e(Auth::guard('user')->user()->id); ?>">
                    <input type="hidden" name="total" value="<?php echo e(Cart::instance('default')->subtotal()); ?>" >
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                        <td><?php echo e(Cart::instance('default')->subtotal()); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    

                    
                    
                </tbody>
            </table>
        
        
            <div class="col-md-4">
            <div class="form-group">
                <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" value="<?php echo e(Auth::guard('user')->user()->name); ?>" required>
            </div>
            <div class="form-group">  
                <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo e(Auth::guard('user')->user()->email); ?>">   
            </div>
            <div class="form-group">  
                <label for="address">Alamat</label>
                   
                    <textarea name="address" id="address" class="form-control" value=""><?php echo e(Auth::guard('user')->user()->address); ?></textarea>         
            </div>

            <div class="form-group">  
                <label for="phone">No.Hp</label>
                    <input type="number" name="phone" value="<?php echo e(Auth::guard('user')->user()->phone); ?>" class="form-control">   
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
                      <?php for($i=0; $i < count($city_result['rajaongkir']['results']); $i++): ?>
                          <option value="<?php echo e($city_result['rajaongkir']['results'][$i]['city_id']); ?>"><?php echo e($city_result['rajaongkir']['results'][$i]['city_name']); ?></option>";
                      <?php endfor; ?>
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
 <?php $__env->stopSection(); ?>

<!-- <script>
    $('#order').click(function(){
        var product_id, qty, price
    })
</script> -->
 
<?php echo $__env->make('master_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>