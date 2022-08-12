
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
                            <!-- <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Guru" href="<?= site_url('administrator/guru/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> Tes PDF</a> -->

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
                                  <label for="minggu" class="col-sm-2 control-label">Minggu ke-:</label>
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

                                  <?php
                                    $querySemester =  $this->db->query('SELECT *
                                                      FROM semester
                                                      JOIN periode ON periode.id_periode = semester.id_periode');
                                    $sql = $querySemester->result();
                                  ?>

                                  <label for="tahun" class="col-sm-1 control-label">Semester:<i class="required">*</i></label>
                                  <div class="col-sm-2">
                                      <select  class="form-control chosen chosen-select-deselect" name="tahun" id="tahun" data-placeholder="Select Tahun Ajaran" >
                                        <option value=""></option>
                                        <?php foreach ($sql as $row): ?>
                                        <option value="<?= $row->id_semester ?>"><?= $row->periode ." ". $row->semester; ?></option>
                                        <?php endforeach; ?>  
                                      </select>
                                      <small class="info help-block">
                                      <b>Input Tahun Ajaran</b>.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="sekolah" class="col-sm-2 control-label">Sekolah:<i class="required">*</i></label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="sekolah" id="sekolah" data-placeholder="Select Sekolah" >
                                      <option value=""></option>
                                      <option value="semua">Semua</option> 
                                      <option value="1">SMP</option>
                                      <option value="2">SMA</option>
                                      <option value="3">SMK</option>
                                    </select>
                                    <small class="info help-block">
                                    <b>Select Sekolah</b> Max Length : 11.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="id_siswa" class="col-sm-2 control-label">Siswa:</label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="id_siswa" id="id_siswa" data-placeholder="Select Siswa" >
                                      <option value=""></option>
                                    </select>
                                    <small class="info help-block">
                                    <b>Select Siswa</b> Max Length : 100.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="id_rombel" class="col-sm-2 control-label">Rombel:<i class="required">*</i></label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="id_rombel" id="id_rombel" data-placeholder="Select Rombel" >
                                      <option value=""></option>
                                      <!-- <?php foreach (db_get_all_data('rombel') as $row): ?>
                                      <option value="<?= $row->id_rombel ?>"><?= $row->nama_rombel; ?></option>
                                      <?php endforeach; ?> -->
                                    </select>
                                    <small class="info help-block">
                                    <b>Select Rombel</b> Max Length : 100.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="id_indikator_pbp" class="col-sm-2 control-label">Indikator Prilaku:</label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="id_indikator_pbp" id="id_indikator_pbp" data-placeholder="Select Indikator Prilaku" >
                                      <option value=""></option>
                                      <?php foreach (db_get_all_data('indikator_amatan_pbp') as $row): ?>
                                      <option value="<?= $row->id_indikator_pbp ?>"><?= $row->kode_indikator; ?>/<?= $row->indikator; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <small class="info help-block">
                                    <b>Select Indikator Prilaku</b> Max Length : 100.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="id_pengamat" class="col-sm-2 control-label">Guru Pengamat:</label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="id_pengamat" id="id_pengamat" data-placeholder="Select Guru" >
                                      <option value=""></option>
                                      <?php foreach (db_get_all_data('guru') as $row): ?>
                                      <option value="<?= $row->id_guru ?>"><?= $row->nama_guru; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <small class="info help-block">
                                    <b>Select Guru</b> Max Length : 100.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="wali_kelas" class="col-sm-2 control-label">Wali Kelas:</label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="wali_kelas" id="wali_kelas" data-placeholder="Select Wali Kelas" >
                                      <option value=""></option>
                                      
                                    </select>
                                    <small class="info help-block">
                                    <b>Select Wali Kelas</b> Max Length : 100.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="ppbp" class="col-sm-2 control-label">PPBP:<i class="required">*</i></label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="ppbp" id="ppbp" data-placeholder="Select PPBP" >
                                      <option value=""></option>
                                      <?php foreach (db_get_all_data('guru') as $row): ?>
                                     <!--  <option value="<?= $row->id_guru ?>"><?= $row->nama_guru; ?></option> -->
                                      <option <?=  $row->id_guru ==  204 ? 'selected' : ''; ?> value="<?= $row->id_guru ?>"><?= $row->nama_guru; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <small class="info help-block">
                                    <b>Select PPBP</b> Max Length : 100.</small>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="jenis_laporan" class="col-sm-2 control-label">Jenis Laporan:<i class="required">*</i></label>
                                  <div class="col-sm-5">
                                    <select  class="form-control chosen chosen-select-deselect" name="jenis_laporan" id="jenis_laporan" data-placeholder="Select Jenis Laporan" >
                                      <option value=""></option>
                                      <option value="pdf">PDF</option> 
                                      <option value="excel">EXCEL</option>
                                    </select>
                                    <small class="info help-block">
                                    <b>Select Jenis Laporan</b> Max Length : 11.</small>
                                  </div>
                                </div>
                              </fieldset>
                            </div>
                          </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="Cetak">
                            <i class="fa fa-file" ></i> Cetak
                            </button>
                            <?php
                              $file = 'perilaku_siswa_mingguan_'.date('d-m-Y');
                              $fileExcel = 'perilaku_siswa_mingguan_excel_'.date('d-m-Y').'.xls';
                              if ( $fileName == $file ) { ?>
                                <a href="<?= base_url('uploads/'.$file.'.pdf'); ?>" class="btn btn-flat btn-success" title="Download PDF Mingguan" target='blank' id="laporan_mingguan_dwonload" >
                                <i class="fa fa-download" ></i> Download PDF
                                </a>
                              <?php  }

                              if ( $fileNameExcel == $fileExcel ) { ?>
                                <a href="<?= base_url('uploads/'.$fileExcel); ?>" class="btn btn-flat btn-success" title="Download Excel Mingguan" id="laporan_mingguan_excel_dwonload" >
                                <i class="fa fa-download" ></i> Download Excel
                                </a>
                              <?php  }

                              // var_dump($fileNameHarian);
                              
                              $fileHarian = 'perilaku_siswa_harian_'.date('d-m-Y');
                              $fileHarianExcel = 'perilaku_siswa_harian_excel_'.date('d-m-Y').'.xls';
                              if ( $fileNameHarian == $fileHarian ) { ?>
                                <a href="<?= base_url('uploads/'.$fileHarian.'.pdf'); ?>" class="btn btn-flat btn-success" title="Download PDF Harian" target='blank' id="laporan_harian_dwonload" >
                                <i class="fa fa-download" ></i> Download PDF
                                </a>
                              <?php  }
                              if ( $fileNameHarianExcel == $fileHarianExcel ) { ?>
                                <a href="<?= base_url('uploads/'.$fileHarianExcel); ?>" class="btn btn-flat btn-success" title="Download Excel Harian" id="laporan_harian_excel_dwonload" >
                                <i class="fa fa-download" ></i> Download Excel
                                </a>
                              <?php  }
                             ?>
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
<!-- Page script -->
<script>
    $(document).ready(function(){

      $('#sekolah').change(function(){
        var val_sekolah = $(this).val();
        // console.log(val_sekolah);

        if (val_sekolah > 0) {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'sekolah',id:val_sekolah},
              url : BASE_URL + "administrator/laporan_pengamatan_perilaku_siswa/data_siswa",
              success: function(respond){
                  // console.log(respond);
                  $('#id_siswa').empty();
                  $('#id_siswa').append(respond);
                  $('#id_siswa').trigger("chosen:updated");
              }
          });
        }
      });

      $('#sekolah').change(function(){
        var val_sekolah = $(this).val();
        // console.log(val_sekolah);

        if (val_sekolah == "semua") {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'semua',id:val_sekolah},
              url : BASE_URL + "administrator/laporan_pengamatan_perilaku_siswa/rombel",
              success: function(respond){
                  // console.log(respond);
                  $('#id_rombel').empty();
                  $('#id_rombel').append(respond);
                  $('#id_rombel').trigger("chosen:updated");
              }
          });
        } else {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'terpilih',id:val_sekolah},
              url : BASE_URL + "administrator/laporan_pengamatan_perilaku_siswa/rombel",
              success: function(respond){
                  // console.log(respond);
                  $('#id_rombel').empty();
                  $('#id_rombel').append(respond);
                  $('#id_rombel').trigger("chosen:updated");
              }
          });
        }
      });

      $('#id_rombel').change(function(){
        var val_rombel = $(this).val();
        // console.log(val_rombel);

        if (val_rombel > 0) {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'rombel',id:val_rombel},
              url : BASE_URL + "administrator/laporan_pengamatan_perilaku_siswa/wali_kelas",
              success: function(respond){
                  // console.log(respond);
                  $('#wali_kelas').empty();
                  $('#wali_kelas').append(respond);
                  $('#wali_kelas').trigger("chosen:updated");
              }
          });
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
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_laporan_pengamatan_perilaku_siswa = $('#form_laporan_pengamatan_perilaku_siswa');
        var data_post = form_laporan_pengamatan_perilaku_siswa.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          // url: BASE_URL + '/administrator/laporan_pengamatan_perilaku_siswa/add_save',
          url: BASE_URL + 'administrator/laporan_pengamatan_perilaku_siswa/proses_laporan',
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
      // console.log(jenis_periode);
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