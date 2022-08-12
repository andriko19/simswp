
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Laporan Pengamatan Perilaku Siswa        <small><?= cclang('new', ['Laporan Pengamatan Perilaku Siswa']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/laporan_pengamatan_perilaku_siswa'); ?>">Laporan Pengamatan Perilaku Siswa</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Laporan Pengamatan Perilaku Siswa</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Laporan Pengamatan Perilaku Siswa']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_laporan_pengamatan_perilaku_siswa', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_laporan_pengamatan_perilaku_siswa', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="form-group ">
                            <label for="periode" class="col-sm-2 control-label"> Periode : 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                            <input type="hidden" class="form-control pull-right" name="id_siswa" id="id_siswa" value="<?=$id_siswa?>">
                              <select  class="form-control chosen chosen-select-deselect" name="periode" id="periode" data-placeholder="Select Periode" >
                                <option value="">--Pilih Periode--</option>
                                <option value="hari">Hari Ini</option>
                                <option value="bulan">Bulan Ini</option> 
                                <option value="semester">Semester Ini</option>
                              </select>
                              <small class="info help-block">
                              <b>Select Periode</b> Max Length : 11.</small>
                              <!-- <?php var_dump(date(m));?> -->
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->

                  <form name="form_isian_amatan" id="form_isian_amatan" action="<?= base_url('administrator/isian_amatan/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>No.</th>
                           <th>Tanggal</th>
                           <th>Jam</th>
                           <th>Nama Siswa</th>
                           <th>Prilaku Yang Diamati</th>
                           <th>Status Amatan</th>
                           <th>Lokasi Amatan</th>
                           <th>Nama Pengamat</th>
                        </tr>
                     </thead>
                     <tbody id="target">
                     <?php $no=1; foreach($getDataHariIni as $HariIni): ?>
                        <tr>
                           
                           <td><?= $no++; ?></td> 
                           <td><?= _ent($HariIni->tanggal); ?></td>
                           <td><?= _ent($HariIni->jam); ?></td> 
                           <td><?= _ent($HariIni->nama); ?></td> 
                           <td><?= _ent($HariIni->isi_amatan); ?></td> 
                           <td><?= _ent($HariIni->nama_status_amatan); ?></td>  
                           <td><?= _ent($HariIni->nama_lokasi); ?></td> 
                           <td><?= _ent($HariIni->nama_pengamat); ?></td> 
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($getJumlahDataHariIni == 0) :?>
                         <tr>
                           <td colspan="100">
                           <strong> Alhamdulillah hari ini tidak ada amatan untuk putra/putri anda. </strong>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  
                  </form>                  
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        
                     </div>
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->
      </div>
   </div>
</section>
<!-- /.content -->

<!-- Page script -->
<script>
    $(document).ready(function(){

      $('#periode').change(function(){
        var val_periode = $(this).val();
        var id_siswa = $('#id_siswa').val();
        // console.log(id_siswa);

        if (val_periode == 'hari') {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id:id_siswa},
              url : BASE_URL + "administrator/laporan_pengamatan_perilaku_siswa/amatan_hari",
              dataType: 'json',
              success: function(data){
                console.log(data);
                var kosong = "Alhamdulillah hari ini tidak ada amatan untuk putra/putri anda.";
                var baris='';
                var no=0;

                if (data.length == no) {
                  baris +=  '<tr>'+
                              '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                            '</tr>';
                } else {
                  for(var i=0; i<data.length; i++){
                    no++;
                    baris +=  '<tr>'+
                                '<td>'+no+'</td>' +
                                '<td>'+data[i].tanggal+'</td>' +
                                '<td>'+data[i].jam+'</td>' +
                                '<td>'+data[i].nama+'</td>' +
                                '<td>'+data[i].isi_amatan+'</td>' +
                                '<td>'+data[i].nama_status_amatan+'</td>' +
                                '<td>'+data[i].nama_lokasi+'</td>' +
                                '<td>'+data[i].nama_pengamat+'</td>' +
                              '</tr>';
                    
                  }
                }
                $('#target').html(baris);
              }
          });
          // console.log('Ini harian');
        } else if (val_periode == 'bulan') {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id:id_siswa},
              url : BASE_URL + "administrator/laporan_pengamatan_perilaku_siswa/amatan_bulan",
              dataType: 'json',
              success: function(data){
                console.log(data);
                var kosong = "Alhamdulillah bulan ini tidak ada amatan untuk putra/putri anda.";
                var baris='';
                var no=0;

                if (data.length == no) {
                  baris +=  '<tr>'+
                              '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                            '</tr>';
                } else {
                  for(var i=0; i<data.length; i++){
                    no++;
                    baris +=  '<tr>'+
                                '<td>'+no+'</td>' +
                                '<td>'+data[i].tanggal+'</td>' +
                                '<td>'+data[i].jam+'</td>' +
                                '<td>'+data[i].nama+'</td>' +
                                '<td>'+data[i].isi_amatan+'</td>' +
                                '<td>'+data[i].nama_status_amatan+'</td>' +
                                '<td>'+data[i].nama_lokasi+'</td>' +
                                '<td>'+data[i].nama_pengamat+'</td>' +
                              '</tr>';
                  }
                }
                $('#target').html(baris);
              }
          });
          // console.log('Ini bulanan');

        } else if (val_periode == 'semester') {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id:id_siswa},
              url : BASE_URL + "administrator/laporan_pengamatan_perilaku_siswa/amatan_semester",
              dataType: 'json',
              success: function(data){
                console.log(data);
                var kosong = "Alhamdulillah semester ini tidak ada amatan untuk putra/putri anda.";
                var baris='';
                var no=0;

                if (data.length == no) {
                  baris +=  '<tr>'+
                              '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                            '</tr>';
                } else {
                  for(var i=0; i<data.length; i++){
                    no++;
                    baris +=  '<tr>'+
                                '<td>'+no+'</td>' +
                                '<td>'+data[i].tanggal+'</td>' +
                                '<td>'+data[i].jam+'</td>' +
                                '<td>'+data[i].nama+'</td>' +
                                '<td>'+data[i].isi_amatan+'</td>' +
                                '<td>'+data[i].nama_status_amatan+'</td>' +
                                '<td>'+data[i].nama_lokasi+'</td>' +
                                '<td>'+data[i].nama_pengamat+'</td>' +
                              '</tr>';
                  }
                }
                $('#target').html(baris);
              }
          });
          // console.log('Ini semesteran');
        }
      });
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/laporan_pengamatan_perilaku_siswa';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    }); /*end doc ready*/
</script>