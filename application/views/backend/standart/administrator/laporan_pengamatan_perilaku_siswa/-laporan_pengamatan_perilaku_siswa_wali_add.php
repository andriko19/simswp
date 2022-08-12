
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
                            <!-- <?=$fileName; ?> -->
                            <!-- <?=$fileNameHarian; ?> -->
                            <!-- <?=$fileNameExcel; ?> -->
                            <!-- <?=$fileNameHarian; ?> -->
                            </label>
                            <div class="col-sm-5">
                              <select  class="form-control chosen chosen-select-deselect" name="periode" id="periode" data-placeholder="Select Periode" >
                                <option value="mingguan">Mingguan</option> 
                                <option value="harian">Harian</option>
                              </select>
                              <small class="info help-block">
                              <b>Select Periode</b> Max Length : 11.</small>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12">
                            <label for="laporan" class="col-sm-2 control-label">Form Inputan Laporan :
                            </label>
                            <div class="col-sm-8">
                              <fieldset>

                                <input type="hidden" class="form-control pull-right" name="id_siswa" id="id_siswa" value="<?=$nipd?>">

                                <legend id="laporan_harian">Form Laporan Harian</legend>
                                <legend id="laporan_mingguan">Form Laporan Mingguan</legend>

                                <div class="form-group" id="laporan_harian_form">
                                  <label for="tanggal_awal" class="col-sm-2 control-label">Dari tanggal:<i class="required">*</i></label>
                                  <div class="col-sm-2">
                                      <input type="text" class="form-control pull-right datepicker" name="tanggal_awal" id="tanggal_awal" placeholder="Dari Tanggal" value="">
                                      <small class="info help-block">
                                      <b>Input Tanggal</b> Max Length : 11.</small>
                                  </div>

                                  <label for="tanggal_akhir" class="col-sm-1 control-label">Sampai tanggal:<i class="required">*</i></label>
                                  <div class="col-sm-2">
                                      <input type="text" class="form-control pull-right datepicker" name="tanggal_akhir" id="tanggal_akhir" placeholder="Sampai Tanggal">
                                      <small class="info help-block">
                                      <b>Input Tanggal</b> Max Length : 11.</small>
                                  </div>
                                </div>

                                <div class="form-group" id="laporan_mingguan_form">
                                  <label for="minggu" class="col-sm-2 control-label">Minggu ke-:<i class="required">*</i></label>
                                  <div class="col-sm-2">
                                    <select  class="form-control chosen chosen-select-deselect" name="minggu" id="minggu" data-placeholder="Select Minggu" >
                                      <option value=""></option>
                                      <?php foreach (db_get_all_data('minggu_ke') as $row): ?>
                                      <option value="<?= $row->id_minggu_ke ?>"><?= $row->minggu_ke; ?></option>
                                      <?php endforeach; ?>  
                                    </select>
                                    <small class="info help-block">
                                    <b>Input Minggu</b> Max Length : 11.</small>
                                  </div>

                                  <label for="tahun" class="col-sm-1 control-label">Tahun Ajaran:<i class="required">*</i></label>
                                  <div class="col-sm-2">
                                      <select  class="form-control chosen chosen-select-deselect" name="tahun" id="tahun" data-placeholder="Select Tahun Ajaran" >
                                        <option value=""></option>
                                        <?php foreach (db_get_all_data('periode') as $row): ?>
                                        <option value="<?= $row->id_periode ?>"><?= $row->periode; ?></option>
                                        <?php endforeach; ?>  
                                      </select>
                                      <small class="info help-block">
                                      <b>Input Tahun Ajaran</b> (Contoh : 2021/2022).</small>
                                  </div>
                                </div>
                              </fieldset>
                            </div>
                          </div>
                        </div>
                                                
                        <!-- <div class="message"></div> -->
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="Cetak">
                            <i class="fa fa-list" ></i> Tampilkan
                            </button>
                            <a href="<?= site_url('administrator/laporan_pengamatan_perilaku_siswa/add'); ?>" class="btn btn-flat btn-success">Refresh</a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
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
                           <th>Minggu Ke-</th>
                           <th>Sekolah</th>
                           <th>Kelas</th>
                           <th>Nama Siswa</th>
                           <th>Prilaku Yang Diamati</th>
                           <th>Status Amatan</th>
                           <th>Lokasi Amatan</th>
                           <th>Pengamat</th>
                           <th>Nama Pengamat</th>
                        </tr>
                     </thead>
                     <tbody id="target">
                     
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
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_laporan_pengamatan_perilaku_siswa = $('#form_laporan_pengamatan_perilaku_siswa');
        var data_post = form_laporan_pengamatan_perilaku_siswa.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          // url: BASE_URL + '/administrator/laporan_pengamatan_perilaku_siswa/add_save',
          url: BASE_URL + 'administrator/laporan_pengamatan_perilaku_siswa/proses_laporan_wali',
          type: 'POST',
          dataType: 'json',
          data: data_post,

        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');

            if (res.data){

              console.log(res.data);

              var baris='';
              var no=0;
              for(var i=0; i<res.data.length; i++){
                no++;
                baris +=  '<tr>'+
                            '<td>'+no+'</td>' +
                            '<td>'+res.data[i].tanggal+'</td>' +
                            '<td>'+res.data[i].jam+'</td>' +
                            '<td>'+res.data[i].minggu_ke+'</td>' +
                            '<td>'+res.data[i].kode_sekolah+'</td>' +
                            '<td>'+res.data[i].kelas+'</td>' +
                            '<td>'+res.data[i].nama+'</td>' +
                            '<td>'+res.data[i].isi_amatan+'</td>' +
                            '<td>'+res.data[i].nama_status_amatan+'</td>' +
                            '<td>'+res.data[i].nama_lokasi+'</td>' +
                            '<td>'+res.data[i].jenis_pengamat+'</td>' +
                            '<td>'+res.data[i].nama_pengamat+'</td>' +
                          '</tr>';
              }
              $('#target').html(baris);
            
            } else {
              
            }
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          // $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
    }); /*end doc ready*/
</script>

<script>
  $(document).ready(function(){
    $("#laporan_harian").css("display","none"); //Menghilangkan form-input ketika pertama kali dijalankan
    $("#laporan_harian_form").css("display","none"); //Menghilangkan form-input ketika pertama kali dijalankan
    $("#laporan_harian_dwonload").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
    $("#laporan_harian_excel_dwonload").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
    // $("#laporan_mingguan").css("display","none"); //Menghilangkan form-input ketika pertama kali dijalankan

    $('#periode').change(function(){
    // $(".detail").click(function(){ //Memberikan even ketika class detail di klik (class detail ialah class radio button)
      var jenis_periode = $(this).val();
      console.log(jenis_periode);
    if (jenis_periode == "harian") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
      $("#laporan_harian").css("display","block"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_harian_form").css("display","block"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_mingguan").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_mingguan_form").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_mingguan_dwonload").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_mingguan_excel_dwonload").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_harian_dwonload").css("display","inline-block"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_harian_excel_dwonload").css("display","inline-block"); //Efek Slide Down (Menampilkan Form Input)
    } else if (jenis_periode == "mingguan") {
      $("#laporan_harian").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_harian_form").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_mingguan").css("display","block"); 
      $("#laporan_mingguan_form").css("display","block"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_mingguan_dwonload").css("display","inline-block"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_mingguan_excel_dwonload").css("display","inline-block"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_harian_dwonload").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
      $("#laporan_harian_excel_dwonload").css("display","none"); //Efek Slide Down (Menampilkan Form Input)
    }
    });
  });

</script>