<?php $__env->startSection('content'); ?>
<div class="container">
<?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>

                            <table border="0">
            <tr>
            <td>Payment Id : <?php echo e($p->id); ?> </td>
            </tr><tr>
            <td>Order Id : <?php echo e($p->order_id); ?></td>
            </tr><tr>
            <td>Item Price : <?php echo e($p->item_price_total); ?></td>
            </tr><tr>
            <td>Shipping : <?php echo e($p->shipping_cost); ?></td>
            </tr><tr>
            <td>Total Price : <?php echo e($p->total_payment); ?></td>
            </tr>
            
            
            <tr>
                <td> <a href="<?php echo e(url('/confirmpayment', $p->id)); ?>" class="btn btn-warning btn-sm">Konfirmasi</a></td>
            </tr>
        </table>                      
</div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('master_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>