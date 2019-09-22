​
<?php $__env->startSection('title'); ?>
    <title>Edit Shipping</title>
<?php $__env->stopSection(); ?>
​
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="">Transaksi</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <?php $__env->startComponent('components.card'); ?>
                            <?php $__env->slot('title'); ?>
                            Edit
                            <?php $__env->endSlot(); ?>
                            
                            <?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
​
                            <form role="form" action="<?php echo e(route('transaksi.update', $ship->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="name">Status</label>
                                    <input type="text" 
                                        name="status"
                                        value="<?php echo e($ship->status); ?>"
                                        class="form-control <?php echo e($errors->has('status') ? 'is-invalid':''); ?>" id="status" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Nomor Resi</label>
                                    <input type="text" 
                                        name="resi"
                                        value="<?php echo e($ship->resi); ?>"
                                        class="form-control <?php echo e($errors->has('resi') ? 'is-invalid':''); ?>" id="resi" required>
                                </div>
                            <?php $__env->slot('footer'); ?>
                                <div class="card-footer">
                                    <button class="btn btn-info">Update</button>
                                </div>
                            </form>
                            <?php $__env->endSlot(); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>