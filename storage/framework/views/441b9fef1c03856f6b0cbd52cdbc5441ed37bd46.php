<?php $__env->startSection('content'); ?>
  <div class="container">    
        <?php if(session('error')): ?>
            <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                <?php echo session('error'); ?>

            <?php echo $__env->renderComponent(); ?>
        <?php endif; ?>
     
     
   <div class="col-md-12">
   <h3>User</h3>
   <div class="table-responsive">
    <table class="table">
           <tbody>
           <input type="hidden" name="_method" value="PUT">
             <tr><td>User Id</td><td>:<?php echo e(Auth::guard('user')->user()->id); ?></td></tr> 
             <tr><td>Email</td><td>: <?php echo e(Auth::guard('user')->user()->email); ?></td></tr>  
             
             <tr><td>Name</td><td>: <?php echo e(Auth::guard('user')->user()->name); ?></td></tr>
             <tr><td>Address</td><td>: <?php echo e(Auth::guard('user')->user()->address); ?></td></tr>
             <tr><td>Phone</td><td>: <?php echo e(Auth::guard('user')->user()->phone); ?></td></tr>            
            
             <tr><td></td><td>
                <a href="<?php echo e(url('user/edit', Auth::guard('user')->user()->id )); ?>" class="btn btn-info btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
             </td></tr>         
           </tbody>
    </table>
   </div>
   </div>
  </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('master_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>