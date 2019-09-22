<?php $__env->startSection('content'); ?>

    <div class="container">
    
        <h3>Pembayaran</h3>
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
                <form role="form" action="" method="POST">
                        <?php echo csrf_field(); ?>   
                <tbody> 
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->invoice); ?></td>                       
                        <td>Rp.<?php echo e($order->total); ?></td>
                        <td class=""></td>                       
                    </tr> 
                </tbody>
            </table>

            <div class="col-md-4">
                    <table class="table" border="0">
                        <tbody>
                        <tr>                     
                            <td>Customer Id : <?php echo e($cus->id); ?> </td>    
                        </tr>
                        <tr>
                            <td>Nama : <?php echo e($cus->name); ?> </td>
                        </tr>
                        <tr>
                            <td>Alamat : <?php echo e($cus->address); ?> </td>
                        </tr>  
                        <tr>
                            <td>No.Hp : <?php echo e($cus->phone); ?> </td>
                        </tr>  
                        <tr>
                            <td>Email : <?php echo e($cus->email); ?> </td>       
                        </tr>      
                        </tbody>
                    </table>
                    </div>        


    <div class="col-md-4">
            <form method="POST" action="<?php echo e(route('storecost')); ?>" role="form">
                    <?php echo csrf_field(); ?>   
        <?php if(!empty($array_result)): ?>    
            <?php for($k=0; $k < count($array_result['rajaongkir']['results']); $k++): ?>
                <table class="table"> 
                    <tr>
                        <th>No.</th>
                        <th>Layanan.</th>
                        
                        <th>Tarif.</th>
                    </tr>
                  
                <?php for($l=0; $l < count($array_result['rajaongkir']['results'][$k]['costs']); $l++): ?> 
                    <tr> 
                        <td> <?php echo e($l+1); ?> </td>
                        <td> <?php echo e($array_result['rajaongkir']['results'][$k]['costs'][$l]['service']); ?></td>    
                        <td> 
                            <input type="radio" name="radio" value="<?php echo e($array_result['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']); ?>"> 
                            <?php echo e($array_result['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']); ?>

                        </td>
                    </tr>
                <?php endfor; ?> 
                <tr><td><input type="submit"  class="btn btn-primary" value="cek"></td></tr>  
            <?php endfor; ?>
              
        <?php else: ?>
            <tr><td>Shipping</td></tr>
        <?php endif; ?>
                </table>     
       
                </form>
    </div>
    
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>