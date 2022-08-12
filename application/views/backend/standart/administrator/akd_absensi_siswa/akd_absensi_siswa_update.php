
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
        Akd Absensi Siswa        <small>Edit Akd Absensi Siswa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/akd_absensi_siswa'); ?>">Akd Absensi Siswa</a></li>
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
                            <h3 class="widget-user-username">Akd Absensi Siswa</h3>
                            <h5 class="widget-user-desc">Edit Akd Absensi Siswa</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/akd_absensi_siswa/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_akd_absensi_siswa', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_akd_absensi_siswa', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="id_jadwal_pelajaran" class="col-sm-2 control-label">Id Jadwal Pelajaran 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_jadwal_pelajaran" id="id_jadwal_pelajaran" data-placeholder="Select Id Jadwal Pelajaran" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('akd_jadwal_pelajaran') as $row): ?>
                                    <option <?=  $row->id_jadwal_pelajaran ==  $akd_absensi_siswa->id_jadwal_pelajaran ? 'selected' : ''; ?> value="<?= $row->id_jadwal_pelajaran ?>"><?= $row->kode_jadwal; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Id Jadwal Pelajaran</b> Max Length : 11.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="id_siswa" class="col-sm-2 control-label">Id Siswa 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_siswa" id="id_siswa" data-placeholder="Select Id Siswa" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('siswa') as $row): ?>
                                    <option <?=  $row->id_siswa ==  $akd_absensi_siswa->id_siswa ? 'selected' : ''; ?> value="<?= $row->id_siswa ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Id Siswa</b> Max Length : 11.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="kode_kehadiran" class="col-sm-2 control-label">Kode Kehadiran 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="kode_kehadiran" id="kode_kehadiran" data-placeholder="Select Kode Kehadiran" >
                                    <option value=""></option>
                                    <option <?= $akd_absensi_siswa->kode_kehadiran == "1" ? 'selected' :''; ?> value="1">Hadir</option>
                                    <option <?= $akd_absensi_siswa->kode_kehadiran == "2" ? 'selected' :''; ?> value="2">Ijin</option>
                                    <option <?= $akd_absensi_siswa->kode_kehadiran == "3" ? 'selected' :''; ?> value="3">Sakit</option>
                                    <option <?= $akd_absensi_siswa->kode_kehadiran == "4" ? 'selected' :''; ?> value="4">Alpa</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tanggal" class="col-sm-2 control-label">Tanggal 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal"  placeholder="Tanggal" id="tanggal" value="<?= set_value('akd_absensi_siswa_tanggal_name', $akd_absensi_siswa->tanggal); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
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
              window.location.href = BASE_URL + 'administrator/akd_absensi_siswa';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_akd_absensi_siswa = $('#form_akd_absensi_siswa');
        var data_post = form_akd_absensi_siswa.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_akd_absensi_siswa.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#akd_absensi_siswa_image_galery').find('li').attr('qq-file-id');
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