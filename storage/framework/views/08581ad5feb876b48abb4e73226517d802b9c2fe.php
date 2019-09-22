<?php $__env->startSection('content'); ?>
<div class="container">
<?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
<form action="<?php echo e(url('/updatepay', $payment->id)); ?>" role="form" method="POST">
     <?php echo csrf_field(); ?>                   
        <table border="0">
                
                <tr>
                <tr>
                <td>Rekening Adm: </td><td><input type="number" name="rek_adm" value="13800111"readonly></td>
                </tr><tr>
                <td>Rekening Customer : </td><td><input type="number" name="rek_cust"></td>
                </tr><tr>
                <td>Bukti Transfer : </td><td><input type="file" name="photo"></td>
                </tr><tr>
                <td>Keterangan : </td><td><input type="text" name="ket"></td>
                </tr>
                <tr>
                    <td> <input type="submit" class="btn btn-success btn-lg" value="Konfirmasi"></td>
                </tr>
            </table>
            </form>
            </div>
            <?php $__env->stopSection(); ?>  
<?php echo $__env->make('master_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>