<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Kopi Gucialit</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('fa/font-awesome/4.7.0/css/font-awesome.min.css')); ?>">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('css/apps.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* Dropdown Button */
        .dropbtn {
            font-size: 16px;
            border: none;
            height: 22px;
            width: 53px;
            color: white;
            background-color:unset;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdowns {
            position: relative;
            display: inline-block;
            background-color:unset;
            color: white;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdowns-content {
            display: none;
            position: absolute;
           
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdowns-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdowns-content a:hover {
            background-color: black;
        }

        /* Show the dropdown menu on hover */
        .dropdowns:hover .dropdowns-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        /* .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        } */
    </style>

</head>

<body>
    <div id="app">
        <header class="with-background">
            <div class="top-nav container">
                <div class="top-nav-left">
                    <div class="logo">Kopi Gucialit</div>
                    <ul>

                        <li><a href="#blogsec">About</a></li>
                    </ul>
                </div>
                <div class="top-nav-right">
                    <ul>
                        <li>
                            <a href="<?php echo e(route('login')); ?>">Login</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('cart')); ?>">Cart</a>
                        </li>
                        <li>
                            <div class="dropdowns">
                                    
                                <button class="dropbtn" >
                                    User
                                </button>
                                <div class="dropdowns-content">
                                    <?php if(auth()->guard()->guest()): ?>
                                    <a href="<?php echo e(url('user/profil')); ?>">Profile</a>
                                    <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>
                                   
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                        style="display: none;">
                                        <?php echo csrf_field(); ?>

                                    </form>
                                    <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>">Login</a>
                                   <?php endif; ?> 
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end top-nav -->
            <div class="hero container">
                <div class="hero-copy">
                        <h1>Kopi Gucialit</h1>
                    <p>Single origin Gucialit, dalam kemasan bubuk maupun bijian dengan harga terjangkau</p>
                    <div class="hero-buttons">
                        <a href="<?php echo e(url('shop')); ?>" class="button button-white">Shop</a>
                        <a href="https://instagram.com/kopigucialitproduk" class="button button-white">Official Ig</a>
                    </div>
                </div> <!-- end hero-copy -->

                <div class="hero-image">
                    <img src="<?php echo e(asset('bg-icon.jpg')); ?>" width="440px" alt="hero image">
                </div> <!-- end hero-image -->
            </div> <!-- end hero -->
        </header>

        <div id="blogsec"></div>
        <div class="blog-section">
            <div class="container">
                <h1 class="text-center">Informasi</h1>
                <p class="section-description text-center ">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Tempore fuga unde ducimus, libero voluptates autem distinctio iusto ad beatae eos, suscipit sed
                    dolorum culpa quisquam voluptate repellendus, blanditiis obcaecati nulla?</p>


                <div class="blog-posts text-center">
                    <div class="blog-post">
                        <img src="<?php echo e(asset('bg-icon.jpg')); ?>" width="350px" alt="title-image">
                        <h2 class="blog-title">judul 1</h2>
                        <div class="blog-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat
                            veniam eaque, aliquid incidunt ducimus fuga, blanditiis cum magni ratione quo, repellendus
                            asperiores ipsa iure! Commodi, suscipit. Nostrum veniam eligendi aperiam.</div>
                    </div>
                    <div class="blog-post">
                        <img src="<?php echo e(asset('icon-coffee.jpg')); ?>" width="350px" alt="title-image">
                        <h2 class="blog-title">judul 2</h2>
                        <div class="blog-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque
                            illum quae, ad dolorum aliquid accusantium repellat iusto voluptatem magni delectus soluta
                            aspernatur cum architecto a, nisi recusandae. Consequuntur, aperiam voluptates!</div>
                    </div>
                    <div class="blog-post">
                        <img src="<?php echo e(asset('icon-coffee.jpg')); ?>" width="350px" alt="title-image">
                        <h2 class="blog-title">judul 3</h2>
                        <div class="blog-description">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi
                            nisi pariatur qui sunt. Culpa, qui, quam, doloremque repellendus odit officia similique
                            voluptates reprehenderit sequi tenetur alias vel. Temporibus, suscipit nostrum?</div>
                    </div>
                </div>
            </div>
        </div>

        <footer>

            <div class="footer-content container">
                <div class="made-with">Made with <i class="fa fa-heart heart"></i> by Ajad & Firman</div>
                <ul>
                    <li>Contact:</li>
                    <li><a href="#"><i class="fa Contact"></i></a></li>
                    <li><a href="http://kopigucialit.com/"><i class="fa fa-globe"></i></a></li>
                    <li><a href="http://gitlab.com/firmansyah_zf"><i class="fa fa-gitlab"></i></a></li>
                    <li><a href=""><i class="fa fa-whatsapp"> 085704996375</i></a></li>

                </ul>

            </div>
        </footer><!-- end footer-content -->

    </div> <!-- end #app -->
    <script src="js/app.js"></script>
</body>

</html>