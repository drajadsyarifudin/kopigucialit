​
<?php $__env->startSection('title'); ?>
    <title>Manajemen Transaksi</title>
<?php $__env->stopSection(); ?>
​
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    
                        
                            
                            <?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
​
                            
                   
                    <div class="col-md-12">
                        <?php $__env->startComponent('components.card'); ?>
                            <?php $__env->slot('title'); ?>
                            List Pengiriman
                            <?php $__env->endSlot(); ?>
                            
                            <?php if(session('success')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'success']); ?>
                                    <?php echo session('success'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>ID Shipping</td>
                                            <td>ID Payment</td>
                                            <td>Total Payment</td>
                                            <td>Origin</td>
                                            <td>Destination</td>
                                            <td>Courier</td>
                                            <td>Status</td>
                                            <td>Resi</td>
                                            <td>Option</td>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($no++); ?></td>
                                            <td><?php echo e($row->id); ?></td>
                                            <td><?php echo e($row->payment_id); ?></td>
                                            <td><?php echo e($row->total_payment); ?></td>
                                            <td><?php echo e($row->origin); ?></td>
                                            <td><?php echo e($row->destination); ?></td>
                                            <td><?php echo e($row->courier); ?></td>
                                            <td><?php echo e($row->status); ?></td>
                                            <td><?php echo e($row->resi); ?></td>
                                        
                                            <td>
                                                <form action="<?php echo e(route('transaksi.destroy', $row->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="<?php echo e(route('transaksi.edit', $row->id)); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php $__env->slot('footer'); ?>
​
                            <?php $__env->endSlot(); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>