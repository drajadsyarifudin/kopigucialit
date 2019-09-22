<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title', 'Shop'); ?></title>
    <meta name="description" content="Laravel Shopping Cart Example">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Store CSRF token for AJAX calls -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <?php echo $__env->yieldContent('extra-css'); ?>

    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.png')); ?>">

    <style>

        .spacer {
            margin-bottom: 100px;
        }

        .cart-image {
            width: 100px;
        }

        footer {
            background-color: #f5f5f5;
            padding: 20px 0;
        }

        .table>tbody>tr>td {
            vertical-align: middle;
        }

        .side-by-side {
            display: inline-block;
        }
    </style>
</head>
<body>

    <header>

        <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Kopi Gucialit</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="<?php echo e(set_active('shop')); ?>"><a href="<?php echo e(url('/shop')); ?>">Shop</a></li>
                

              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo e(set_active('cart')); ?>"><a href="<?php echo e(url('/cart')); ?>">Cart (<?php echo e(Cart::instance('default')->count(false)); ?>)</a></li>
                <li><a href="<?php echo e(url('user/order')); ?>">Transaction</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

    </header>

    <?php echo $__env->yieldContent('content'); ?>

    <footer>
      <div class="container">
        <p class="text-muted">By <a href="http://andremadarang.com">Kopi Gucialit</a></p>
      </div>
    </footer>

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<?php echo $__env->yieldContent('extra-js'); ?>

</body>
</html>
