
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
        Akd Jadwal Pelajaran        <small>Edit Akd Jadwal Pelajaran</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/akd_jadwal_pelajaran'); ?>">Akd Jadwal Pelajaran</a></li>
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
                            <h3 class="widget-user-username">Akd Jadwal Pelajaran</h3>
                            <h5 class="widget-user-desc">Edit Akd Jadwal Pelajaran</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/akd_jadwal_pelajaran/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_akd_jadwal_pelajaran', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_akd_jadwal_pelajaran', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="tahun_ajaran" class="col-sm-2 control-label">Tahun Ajaran/Semester 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="tahun_ajaran" id="tahun_ajaran" data-placeholder="Select Tahun Ajaran" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('semester') as $row): ?>
                                    <option <?=  $row->id_semester ==  $akd_jadwal_pelajaran->tahun_ajaran ? 'selected' : ''; ?> value="<?= $row->id_semester ?>"><?= $row->semester; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="kode_jadwal" class="col-sm-2 control-label">Kode Guru Pengajar 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_jadwal" id="kode_jadwal" placeholder="Kode Guru Pengajar" value="<?= set_value('kode_jadwal', $akd_jadwal_pelajaran->kode_jadwal); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="rombel" class="col-sm-2 control-label">Rombongan Belajar 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="rombel" id="rombel" data-placeholder="Select Rombel" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('rombel') as $row): ?>
                                    <option <?=  $row->id_rombel ==  $akd_jadwal_pelajaran->rombel ? 'selected' : ''; ?> value="<?= $row->id_rombel ?>"><?= $row->nama_rombel; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="id_pelajaran" class="col-sm-2 control-label">Mata Pelajaran 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_pelajaran" id="id_pelajaran" data-placeholder="Select Id Pelajaran" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('akd_mata_pelajaran') as $row): ?>
                                    <option <?=  $row->id_pelajaran ==  $akd_jadwal_pelajaran->id_pelajaran ? 'selected' : ''; ?> value="<?= $row->id_pelajaran ?>"><?= $row->nama_mata_pelajaran; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="ruangan" class="col-sm-2 control-label">Ruangan 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="ruangan" id="ruangan" data-placeholder="Select Ruangan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('ruangan') as $row): ?>
                                    <option <?=  $row->kode_ruangan ==  $akd_jadwal_pelajaran->ruangan ? 'selected' : ''; ?> value="<?= $row->kode_ruangan ?>"><?= $row->nama_ruangan; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="guru_pengajar" class="col-sm-2 control-label">Guru Pengajar 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="guru_pengajar" id="guru_pengajar" data-placeholder="Select Guru Pengajar" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('guru') as $row): ?>
                                    <option <?=  $row->id_guru ==  $akd_jadwal_pelajaran->guru_pengajar ? 'selected' : ''; ?> value="<?= $row->id_guru ?>"><?= $row->nama_guru; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="paralel" class="col-sm-2 control-label">Paralel 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="paralel" id="paralel" placeholder="Paralel" value="<?= set_value('paralel', $akd_jadwal_pelajaran->paralel); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jadwal_serial" class="col-sm-2 control-label">Jadwal Serial 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jadwal_serial" id="jadwal_serial" placeholder="Jadwal Serial" value="<?= set_value('jadwal_serial', $akd_jadwal_pelajaran->jadwal_serial); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="rentang_jam_pelajaran" class="col-sm-2 control-label">Rentang Jam Pelajaran 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="rentang_jam_pelajaran[]" id="rentang_jam_pelajaran" data-placeholder="Select Rentang Jam Pelajaran" multiple >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('akd_jadwal_jam_ke') as $row): ?>
                                    <option <?=  in_array($row->id_jam_ke, explode(',', $akd_jadwal_pelajaran->rentang_jam_pelajaran)) ? 'selected' : ''; ?> value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="hari" class="col-sm-2 control-label">Hari 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="hari" id="hari" data-placeholder="Select Hari" >
                                    <option value=""></option>
                                    <option <?= $akd_jadwal_pelajaran->hari == "1" ? 'selected' :''; ?> value="1">Senin</option>
                                    <option <?= $akd_jadwal_pelajaran->hari == "2" ? 'selected' :''; ?> value="2">Selasa</option>
                                    <option <?= $akd_jadwal_pelajaran->hari == "3" ? 'selected' :''; ?> value="3">Rabu</option>
                                    <option <?= $akd_jadwal_pelajaran->hari == "4" ? 'selected' :''; ?> value="4">Kamis</option>
                                    <option <?= $akd_jadwal_pelajaran->hari == "5" ? 'selected' :''; ?> value="5">Jumat</option>
                                    <option <?= $akd_jadwal_pelajaran->hari == "6" ? 'selected' :''; ?> value="6">Sabtu</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_sekolah" class="col-sm-2 control-label">Kode Sekolah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kode_sekolah" id="kode_sekolah" data-placeholder="Select Kode Sekolah" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_sekolah') as $row): ?>
                                    <option <?=  $row->id_kodesekolah ==  $akd_jadwal_pelajaran->kode_sekolah ? 'selected' : ''; ?> value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="aktif" class="col-sm-2 control-label">Aktif 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="aktif" id="aktif" data-placeholder="Select Aktif" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('status_keaktifan') as $row): ?>
                                    <option <?=  $row->id_statuskeaktifan ==  $akd_jadwal_pelajaran->aktif ? 'selected' : ''; ?> value="<?= $row->id_statuskeaktifan ?>"><?= $row->status_keaktifan; ?></option>
                                    <?php endforeach; ?>  
                                </select>
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
              window.location.href = BASE_URL + 'administrator/akd_jadwal_pelajaran';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_akd_jadwal_pelajaran = $('#form_akd_jadwal_pelajaran');
        var data_post = form_akd_jadwal_pelajaran.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_akd_jadwal_pelajaran.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#akd_jadwal_pelajaran_image_galery').find('li').attr('qq-file-id');
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