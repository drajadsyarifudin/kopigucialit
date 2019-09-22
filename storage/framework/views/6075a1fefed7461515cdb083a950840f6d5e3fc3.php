<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice #<?php echo e($order->invoice); ?></title>
    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .page{
            max-width: 80em;
            margin: 0 auto;
        }
        table th,
        table td{
            text-align: left;
        }
        table.layout{
            width: 100%;
            border-collapse: collapse;
        }
        table.display{
            margin: 1em 0;
        }
        table.display th,
        table.display td{
            border: 1px solid #B3BFAA;
            padding: .5em 1em;
        }
​
        table.display th{ background: #D5E0CC; }
        table.display td{ background: #fff; }
​
        table.responsive-table{
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }
​
        .listcust {
            margin: 0;
            padding: 0;
            list-style: none;
            display:table;
            border-spacing: 10px;
            border-collapse: separate;
            list-style-type: none;
        }
​
        .customer {
            padding-left: 600px;
        }
       
    </style>
</head>
<body>
    <div class="header">
        <h3>Kopi Gucialit</h3>
        <h4 style="line-height: 0px;">Invoice: #<?php echo e($order->invoice); ?></h4>
        <p><small style="opacity: 0.5;"><?php echo e($order->created_at->format('d-m-Y H:i:s')); ?></small></p>
    </div>
    <div class="customer">
        <table>
            <tr>
                <th>Nama Pelanggan</th>
                <td>:</td>
                <td><?php echo e($order->customer->name); ?></td>
            </tr>
            <tr>
                <th>No Telp</th>
                <td>:</td>
                <td><?php echo e($order->customer->phone); ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td><?php echo e($order->customer->address); ?></td>
            </tr>
        </table>
    </div>
    <div class="page">
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    $totalPrice = 0;
                    $totalQty = 0;
                    $total = 0;
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $order->order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($no++); ?></td>
                    <td><?php echo e($row->product->name); ?></td>
                    <td>Rp <?php echo e(number_format($row->price)); ?></td>
                    <td><?php echo e($row->qty); ?> Item</td>
                    <td>Rp <?php echo e(number_format($row->price * $row->qty)); ?></td>
                </tr>
​
                <?php
                    $totalPrice += $row->price;
                    $totalQty += $row->qty;
                    $total += ($row->price * $row->qty);
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <td>Rp <?php echo e(number_format($totalPrice)); ?></td>
                    <td><?php echo e(number_format($totalQty)); ?> Item</td>
                    <td>Rp <?php echo e(number_format($total)); ?></td>
                </tr>
            </tfoot>
           
        </table>
       <table border="0">
            <tr><td>Mandiri : </td></tr>
            <tr><td>138-00-114596</td></tr>
            <tr><td>Zulfikar Firmansyah</td></tr>
       </table>
              
        
    </div>
</body>
</html>