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
                <div class="form-group">
                    <label>Origin</label>
                    <select id="origin" class="form-control" name="origin">
                      <option selected="selected" value="">Pilih Origin</option>
                      <?php for($i=0; $i < count($city_result['rajaongkir']['results']); $i++): ?>
                          <option value="<?php echo e($city_result['rajaongkir']['results'][$i]['city_id']); ?>"><?php echo e($city_result['rajaongkir']['results'][$i]['city_name']); ?></option>";
                      <?php endfor; ?>
                    </select>
                  </div>
  
                  <div class="form-group">
                    <label>Destination</label>
                    <select id="destination" class="form-control" name="destination">
                      <option selected="selected" value="">Pilih Destination</option>
                      <?php for($i=0; $i < count($city_result['rajaongkir']['results']); $i++): ?>
                          <option value="<?php echo e($city_result['rajaongkir']['results'][$i]['city_id']); ?>"><?php echo e($city_result['rajaongkir']['results'][$i]['city_name']); ?></option>";
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="from-group">
                      <label>Kurir</label>
                      <select id="courier" name="courier" class="form-control">
                          <option value="jne">JNE</option>
                          <option value="tiki">TIKI</option>
                          <option value="pos">POS INDONESIA</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Weight</label>
                    <input id="weight" type="number" name="weight" class="form-control" placeholder="Enter ...">
                  </div>
  
                  <div class="box-footer">
                    <input id="cek" type="submit" class="btn btn-primary" value="cek">
                  </div>
            </div>
        
            <div class="col-md-4">
               
            <?php if(!empty($array_result)): ?>    
                <?php for($k=0; $k < count($array_result['rajaongkir']['results']); $k++): ?>{
                    <table> 
                            <tr>
                                <th>No.</th>
                                <th>Layanan.</th>
                                <th>ETD.</th>
                                <th>Tarif.</th>
                            </tr>
                  
                    <?php for($l=0; $l < count($array_result['rajaongkir']['results'][$k]['costs']); $l++): ?> {
                        <tr>
                            <td> <?php echo e($l+1); ?> </td>
                            <td> <?php echo e($array_result['rajaongkir']['results'][$k]['costs'][$l]['service']); ?></td>
                            <td> <?php echo e($array_result['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['etd']); ?> days</td>
                            <td> <?php echo e($array_result['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']); ?> days</td>
                        </tr>
                    <?php endfor; ?> 
                 <?php endfor; ?>    
             <?php else: ?>
                        <tr><td>Kosong</td></tr>
             <?php endif; ?>           
            </div>
            
            
            
            <div style="float:right">
            <input type="submit" class="btn btn-success btn-lg" value="Buy">
            </div>
            </form>
        
            </div> <!-- end container -->
 <?php $__env->stopSection(); ?>

 <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous">
</script>

<script>
    jQuery(document).ready(function(){
       jQuery('#cek').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
             url: '/prosesshipping',
             method: 'POST',
             data: {
                origin: jQuery('#origin').val(),
                destination: jQuery('#destination').val(),
                courier: jQuery('#courier').val(),
                weight: jQuery('#weight').val()
             },
             success: function(data){
                window.location.href = "<?php echo e(url('/pembayaran')); ?>";
             }});
          });
       });
 </script>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>