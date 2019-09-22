​
<?php $__env->startSection('title'); ?>
    <title>Transaksi</title>
<?php $__env->stopSection(); ?>
​
<?php $__env->startSection('css'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
​
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <?php $__env->startComponent('components.card'); ?>
                            <?php $__env->slot('title'); ?>
                            
                            <?php $__env->endSlot(); ?>
​
                            <div class="row">
                                <div class="col-md-4">
                                    
                                    <!-- SUBMIT DIJALANKAN KETIKA TOMBOL DITEKAN -->
                                    <form action="#" @submit.prevent="addToCart" method="post">
                                        <div class="form-group">
                                            <label for="">Produk</label>
                                            <select name="product_id" id="product_id"
                                                v-model="cart.product_id"
                                                class="form-control" required width="100%">
                                                <option value="">Pilih</option>
                                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product->id); ?>"><?php echo e($product->code); ?> - <?php echo e($product->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Qty</label>
                                            <input type="number" name="qty"
                                                v-model="cart.qty" 
                                                id="qty" value="1" 
                                                min="1" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm"
                                                :disabled="submitCart"
                                                >
                                                <i class="fa fa-shopping-cart"></i> {{ submitCart ? 'Loading...':'Ke Keranjang' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- MENAMPILKAN DETAIL PRODUCT -->
                                <div class="col-md-5">
                                    <h4>Detail Produk</h4>
                                    <div v-if="product.name">
                                        <table class="table table-stripped">
                                            <tr>
                                                <th>Kode</th>
                                                <td>:</td>
                                                <td>{{ product.code }}</td>
                                            </tr>
                                            <tr>
                                                <th width="3%">Produk</th>
                                                <td width="2%">:</td>
                                                <td>{{ product.name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Harga</th>
                                                <td>:</td>
                                                <td>{{ product.price | currency }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- MENAMPILKAN IMAGE DARI PRODUCT -->
                                <div class="col-md-3" v-if="product.photo">
                                    <img :src="'/uploads/product/' + product.photo" 
                                        height="150px" 
                                        width="150px" 
                                        :alt="product.name">
                                </div>
                            </div>
                            <?php $__env->slot('footer'); ?>
​
                            <?php $__env->endSlot(); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    
                    <!-- MENAMPILKAN LIST PRODUCT YANG ADA DI KERANJANG -->
                    <div class="col-md-4">
                        <?php $__env->startComponent('components.card'); ?>
                            <?php $__env->slot('title'); ?>
                            Keranjang
                            <?php $__env->endSlot(); ?>
​
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- MENGGUNAKAN LOOPING VUEJS -->
                                    <tr v-for="(row, index) in shoppingCart">
                                        <td>{{ row.name }} ({{ row.code }})</td>
                                        <td>{{ row.price | currency }}</td>
                                        <td>{{ row.qty }}</td>
                                        <td>
                                            <!-- EVENT ONCLICK UNTUK MENGHAPUS CART -->
                                            <button 
                                                @click.prevent="removeCart(index)"    
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php $__env->slot('footer'); ?>
                            <div class="card-footer text-muted">
                                <a href="<?php echo e(route('order.checkout')); ?>" 
                                    class="btn btn-info btn-sm float-right">
                                    Checkout
                                </a>
                            </div>
                            <?php $__env->endSlot(); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
​
<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="<?php echo e(asset('js/transaksi.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>