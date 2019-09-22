<?php $__env->startSection('content'); ?>
  <div class="container">    
        <?php if(session('error')): ?>
            <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                <?php echo session('error'); ?>

            <?php echo $__env->renderComponent(); ?>
        <?php endif; ?>
        <div class="col-md-12">
            <h3>Users</h3>
            <form role="form" action="<?php echo e(url('user/update', $cust->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="">Customer ID</label>
                    <input type="text" name="cust_id" required maxlength="20" readonly 
                        value="<?php echo e($cust->id); ?>" 
                        class="form control <?php echo e($errors->has('cust_id') ? 'is-invalid':''); ?>">
                    <p class="text-danger"><?php echo e($errors->first('cust_id')); ?></p>    
                </div>       
               
                <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" required maxlength="50" 
                            value="<?php echo e($cust->name); ?>" 
                            class="form control <?php echo e($errors->has('name') ? 'is-invalid':''); ?>">
                        <p class="text-danger"><?php echo e($errors->first('name')); ?></p>    
                </div> 
                
                <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" required maxlength="50" 
                            value="<?php echo e($cust->address); ?>" 
                            class="form control <?php echo e($errors->has('address') ? 'is-invalid':''); ?>">
                        <p class="text-danger"><?php echo e($errors->first('address')); ?></p>    
                </div>     

                <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" required maxlength="50" 
                            value="<?php echo e($cust->phone); ?>" 
                            class="form control <?php echo e($errors->has('phone') ? 'is-invalid':''); ?>">
                        <p class="text-danger"><?php echo e($errors->first('phone')); ?></p>    
                </div>     
                
                <div class="form-group">
                        <button class="btn btn-info btn-sm">
                            <i class="fa fa-refresh"></i> Update
                        </button>
                    </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('master_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>