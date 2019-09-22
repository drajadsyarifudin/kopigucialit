<?php $__env->startSection('title'); ?>
    <title> Edit Data Produk</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('produk.index')); ?>">Produk</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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

                            <?php $__env->endSlot(); ?>

                            <?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    {<?php echo session('error'); ?>}
                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
                            
                            <form action="<?php echo e(route('produk.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="text" name="code" required maxlength="10" readonly 
                                        value="<?php echo e($product-> code); ?>" 
                                        class="form control <?php echo e($errors->has('code') ? 'is-invalid':''); ?>">
                                    <p class="text-danger"><?php echo e($errors->first('code')); ?></p>    
                                </div>

                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" required
                                        value="<?php echo e($product->name); ?>"
                                        class="form-control <?php echo e($errors->has('name') ? 'is-invalid':''); ?>">
                                    <p class="text-danger"><?php echo e($errors->first('name')); ?></p>    
                                </div>

                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="description" cols="5" rows="5"
                                        class="form-control <?php echo e($errors->has('description') ? 'is-invalid':''); ?>"><?php echo e($product->description); ?></textarea> 
                                    <p class="text-danger"><?php echo e($errors->first('description')); ?></p> 
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stock" required 
                                        value="<?php echo e($product->stock); ?>"
                                        class="form-control <?php echo e($errors->has('stock') ? 'is-invalid':''); ?>">
                                    <p class="text-danger"><?php echo e($errors->first('stock')); ?></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Berat</label>
                                    <input type="number" name="weight" required
                                        value="<?php echo e($product->weight); ?>"
                                        class="form-control <?php echo e($errors->has('weight') ? 'is-invalid':''); ?>">
                                    <p class="text-danger"><?php echo e($errors->first('weight')); ?></p>     
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="number" name="price" required 
                                        value="<?php echo e($product->price); ?>"
                                        class="form-control <?php echo e($errors->has('price') ? 'is-invalid':''); ?>">
                                    <p class="text-danger"><?php echo e($errors->first('price')); ?></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="category_id" id="category_id" required
                                        class="form-control <?php echo e($errors->has('price') ? 'is-invalid':''); ?>">
                                        <option value="">--Pilih--</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->id); ?>" <?php echo e($row->id == $product->category_id ? 'selected':''); ?>>
                                                <?php echo e(ucfirst($row->name)); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                    </select>
                                    <p class="text-danger"> <?php echo e($errors->first('category_id')); ?></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <p class="text-danger"><?php echo e($errors->first('photo')); ?></p>
                                    <?php if(!empty($product->photo)): ?>
                                    <hr>
                                    <img src="<?php echo e(asset('uploads/product/' . $product->photo)); ?>"
                                        alt="<?php echo e($product->name); ?>" width="150px" height="150px">
                                    <?php endif; ?>    
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                </div>
                            </form>
                            <?php $__env->slot('footer'); ?>

                            <?php $__env->endSlot(); ?>
                        <?php echo $__env->renderComponent(); ?>
                </div>
            </div>
        </section>
    </div>  
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>