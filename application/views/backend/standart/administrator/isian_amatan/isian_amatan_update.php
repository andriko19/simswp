
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
        Isian Amatan        <small>Edit Isian Amatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/isian_amatan'); ?>">Isian Amatan</a></li>
        <li class="active">Edit</li>
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
                            <h3 class="widget-user-username">Isian Amatan</h3>
                            <h5 class="widget-user-desc">Edit Isian Amatan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/isian_amatan/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_isian_amatan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_isian_amatan', 
                            'method'  => 'POST'
                            ]); ?>

                        <div class="form-group">
                            <label for="tanggal" class="col-sm-2 control-label">Tanggal<i class="required">*</i></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control pull-right datepicker" name="tanggal" id="tanggal" value="<?= set_value('isian_amatan_jam_name', $isian_amatan->tanggal); ?>">
                                <small class="info help-block">
                                <b>Input Tanggal</b> Max Length : 11.</small>
                            </div>

                            <label for="jam" class="col-sm-1 control-label">Jam<i class="required">*</i></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control pull-right timepicker" name="jam" id="jam" placeholder="Pilih Jam" value="<?= set_value('isian_amatan_jam_name', $isian_amatan->jam); ?>">
                                <small class="info help-block">
                                <b>Input Jam</b> Max Length : 11.</small>
                            </div>

                            <label for="minggu" class="col-sm-1 control-label">Minggu<i class="required">*</i></label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="minggu" id="minggu" data-placeholder="Select Minggu" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('minggu_ke') as $row): ?>
                                    <option <?=  $row->id_minggu_ke ==  $isian_amatan->minggu ? 'selected' : ''; ?> value="<?= $row->id_minggu_ke ?>"><?= $row->minggu_ke; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Minggu</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="id_kodesekolah" class="col-sm-2 control-label">Sekolah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_kodesekolah" id="id_kodesekolah" data-placeholder="Select Sekolah" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_sekolah') as $row): ?>
                                    <option <?=  $row->id_kodesekolah ==  $isian_amatan->id_kodesekolah ? 'selected' : ''; ?> value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Id Kodesekolah</b> Max Length : 11.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_siswa" class="col-sm-2 control-label">No. Induk<i class="required">*</i></label>
                            <div class="col-sm-3">
                                <select  class="form-control chosen chosen-select-deselect" name="id_siswa" id="id_siswa" data-placeholder="Select No Induk" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('siswa') as $row): ?>
                                    <option <?=  $row->id_siswa ==  $isian_amatan->id_siswa ? 'selected' : ''; ?> value="<?= $row->id_siswa ?>"><?= $row->nisn.' / '.$row->nama; ?></option>
                                    <?php endforeach; ?>   
                                </select>
                                <small class="info help-block">
                                <b>Input No. Induk</b> Max Length : 11.</small>
                            </div>

                            <label for="" class="col-sm-1 control-label">Nama :</label>
                            <div class="col-sm-2">
                               <label name="nama_siswa" id="nama_siswa" class="col-sm-0 control-label"></label>
                            </div>

                            <label for="" class="col-sm-1 control-label">Kelas :</label>
                            <div class="col-sm-1">
                                <label name="kelas" id="kelas" class="col-sm-0 control-label"></label>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="isi_amatan" class="col-sm-2 control-label">Perilaku yang diamati
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="isi_amatan" id="isi_amatan"> <?= set_value('isian_amatan_jam_name', $isian_amatan->isi_amatan); ?></textarea>
                                <small class="info help-block">
                                <b>Input Perilaku yang diamati</b> Max Length : 250.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_indikator_pbp" class="col-sm-2 control-label">Kode Indikator<i class="required">*</i></label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_indikator_pbp" id="id_indikator_pbp" data-placeholder="Select Kode Indikator" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('indikator_amatan_pbp') as $row): ?>
                                    <option <?=  $row->id_indikator_pbp ==  $isian_amatan->id_indikator_pbp ? 'selected' : ''; ?> value="<?= $row->id_indikator_pbp ?>"><?= $row->kode_indikator.' / '.$row->indikator; ?></option>
                                    <?php endforeach; ?> 
                                </select>
                                <small class="info help-block">
                                <b>Input Kode Indikator</b> Max Length : 11.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status_amatan" class="col-sm-2 control-label">Status Amatan<i class="required">*</i></label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="status_amatan" id="status_amatan" data-placeholder="Select Status Amatan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('status_amatan') as $row): ?>
                                    <option <?=  $row->id_status_amatan ==  $isian_amatan->id_status_amatan ? 'selected' : ''; ?> value="<?= $row->id_status_amatan ?>"><?= $row->status_amatan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                <b>Input status_amatan</b> Max Length : 11.</small>
                            </div>
                        </div>
 
                        <div class="form-group ">
                            <label for="id_lokasi_amatan" class="col-sm-2 control-label">Lokasi Amatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_lokasi_amatan" id="id_lokasi_amatan" data-placeholder="Select Lokasi Amatan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('lokasi_amatan') as $row): ?>
                                    <option <?=  $row->id_lokasi_amatan ==  $isian_amatan->id_lokasi_amatan ? 'selected' : ''; ?> value="<?= $row->id_lokasi_amatan ?>"><?= $row->nama_lokasi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                <b>Input Lokasi Amatan</b> Max Length : 11.</small>
                            </div>
                        </div>
                         
                        <div class="form-group ">
                            <label for="id_jenis_pengamat" class="col-sm-2 control-label">Pengamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_jenis_pengamat" id="id_jenis_pengamat" data-placeholder="Select Jenis Pengamat" >
                                    <option value=""></option>
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('jenis_pengamat') as $row): ?>
                                    <option <?=  $row->id_jenis_pengamat ==  $isian_amatan->id_jenis_pengamat ? 'selected' : ''; ?> value="<?= $row->id_jenis_pengamat ?>"><?= $row->jenis_pengamat; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Jenis Pengamat</b> Max Length : 11.</small>
                            </div>
                        </div>
                         
                        <div class="form-group ">
                            <label for="id_pengamat" class="col-sm-2 control-label">Nama Pengamat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_pengamat" id="id_pengamat" data-placeholder="Select No Induk" >
                                    <option value=""></option> 
                                    <?php foreach (db_get_all_data('guru') as $row): ?>
                                    <option <?=  $row->id_guru ==  $isian_amatan->id_pengamat ? 'selected' : ''; ?> value="<?= $row->id_guru ?>"><?= $row->nama_guru; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                <b>Input Nama Pengamat</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
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

      $('#id_kodesekolah').change(function(){
        var val_sekolah = $(this).val();
        console.log(val_sekolah);

        if (val_sekolah > 0) {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'sekolah',id:val_sekolah},
              url : BASE_URL + "administrator/isian_amatan/data_sekolah",
              success: function(respond){
                  console.log(respond);
                  $('#id_siswa').empty();
                  $('#id_siswa').append(respond);
                  $('#id_siswa').trigger("chosen:updated");
              }
          });
        }
      });

      $('#id_siswa').change(function(){
        var val_siswa = $(this).val();
        // console.log(val_siswa);

        if (val_siswa > 0) {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'nama_siswa',id:val_siswa},
              url : BASE_URL + "administrator/isian_amatan/data_siswa",
              success: function(respond){
                  // console.log(respond);
                  document.getElementById('nama_siswa').innerHTML = respond;
              }
          });
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'kelas',id:val_siswa},
              url : BASE_URL + "administrator/isian_amatan/data_siswa",
              success: function(respond){
                  // console.log(respond);
                  document.getElementById('kelas').innerHTML = respond;
              }
          });
        }
      });

      $('#id_jenis_pengamat').change(function(){
        var val_jenis_pengamat = $(this).val();
        console.log(val_jenis_pengamat);

        if (val_jenis_pengamat > 0) {
          $.ajax({
              type: "POST",
              data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',modul:'nama_pengamat',id:val_jenis_pengamat},
              url : BASE_URL + "administrator/isian_amatan/jenis_pengamat",
              success: function(respond){
                  console.log(respond);
                  $('#id_pengamat').empty();
                  $('#id_pengamat').append(respond);
                  $('#id_pengamat').trigger("chosen:updated");
              }
          });
        }
      });
      
             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
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
              window.location.href = BASE_URL + 'administrator/isian_amatan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_isian_amatan = $('#form_isian_amatan');
        var data_post = form_isian_amatan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_isian_amatan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#isian_amatan_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
       
       
           
    
    }); /*end doc ready*/
</script>