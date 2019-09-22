<?php $__env->startSection('content'); ?>

    <div class="container">
        <p><a href="<?php echo e(url('/shop')); ?>">Shop</a> / <?php echo e($product->name); ?></p>
        <h1><?php echo e($product->name); ?></h1>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo e(asset('uploads/product/' . $product->photo)); ?>" alt="product" class="img-responsive">
            </div>

            <div class="col-md-8">
                <h3>Rp.<?php echo e($product->price); ?></h3>
                <h5><i>Stok tersisa:<?php echo e($product->stock); ?></i></h5>
                <form action="<?php echo e(url('/cart')); ?>" method="POST" class="side-by-side">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                    <input type="hidden" name="name" value="<?php echo e($product->name); ?>">
                    <input type="hidden" name="price" value="<?php echo e($product->price); ?>">
                    <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
                </form>

                

                <br><br>

                <?php echo e($product->description); ?>

            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->

        <div class="spacer"></div>

        
        <div class="spacer"></div>


    </div> <!-- end container -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>