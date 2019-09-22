<?php $__env->startSection('title'); ?>
    <title> Manajemen Produkk </title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>                        
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php $__env->startComponent('components.card'); ?> 
                            <?php $__env->slot('title'); ?>
                            <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>Tambah
                            </a>
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
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th>Stok</th>
                                            <th>Berat</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Last Update</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td> <img src="<?php echo e(asset('uploads/product/'. $row->photo)); ?>"
                                                    alt="<?php echo e($row->name); ?>" width="50px" height="50px">
                                            </td>
                                            <td>
                                                <sup class="label label-success">(<?php echo e($row->code); ?>)</sup>
                                                <strong><?php echo e(ucfirst($row->name)); ?></strong>
                                            </td>
                                            <td> <?php echo e($row->stock); ?> </td>
                                            <td> <?php echo e($row->weight); ?> g </td>
                                            <td>Rp. <?php echo e(number_format($row->price)); ?></td>
                                            <td><?php echo e($row->category->name); ?></td>
                                            <td><?php echo e($row->updated_at); ?></td>
                                            <td>
                                                <form action="<?php echo e(route('produk.destroy', $row->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="<?php echo e(route('produk.edit', $row->id)); ?>" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                    </button>
                                                </form>            
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                                <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>                            
                                </table>
                                <div class="float-right">
                                    <?php echo $products->links(); ?>

                                </div>
                            <?php $__env->slot('footer'); ?>

                            <?php $__env->endSlot(); ?>
                        <?php echo $__env->renderComponent(); ?>    

                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>