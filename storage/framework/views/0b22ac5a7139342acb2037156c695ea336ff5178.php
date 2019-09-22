
<html>
    <head>
            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    </head>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       ongkir
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">

          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-body">
              <form method="post" action="<?php echo e(route('proses')); ?>" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                <!-- text input -->
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
                    <select id="courier" name="courier">
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
                  <input id="cek" type="submit" class="btn btn-primary" value="submit">
                </div>
                <div id="ongkir"></div>
              <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 <!-- JavaScript -->
 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script> 
    $(document).ready(function(){
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $("#cek").click(function(){
			//Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax 
			var origin = $('#origin').val();
			var destination = $('#destination').val();
			var kurir = $('#courier').val();
			var weight = $('#weight').val();

      		$.ajax({
            	type : 'POST',
           		url : "<?php echo e(url('/prosesshipping')); ?>",
            	data :  {'origin' : origin, 'destination' : destination, 'courier' : courier, 'weight' : weight},
					success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
					$("#ongkir").html(data);
          console.log("ok");
				}
          	});
		});
	});
</script>