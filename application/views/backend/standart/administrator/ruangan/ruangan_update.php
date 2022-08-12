
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
        Ruangan        <small>Edit Ruangan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/ruangan'); ?>">Ruangan</a></li>
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
                            <h3 class="widget-user-username">Ruangan</h3>
                            <h5 class="widget-user-desc">Edit Ruangan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/ruangan/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_ruangan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_ruangan', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="kode_gedung" class="col-sm-2 control-label">Kode Gedung 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kode_gedung" id="kode_gedung" data-placeholder="Select Kode Gedung" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('gedung') as $row): ?>
                                    <option <?=  $row->kode_gedung ==  $ruangan->kode_gedung ? 'selected' : ''; ?> value="<?= $row->kode_gedung ?>"><?= $row->nama_gedung; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="nama_ruangan" class="col-sm-2 control-label">Nama Ruangan/Kelas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" placeholder="Nama Ruangan/Kelas" value="<?= set_value('nama_ruangan', $ruangan->nama_ruangan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kapasitas_belajar" class="col-sm-2 control-label">Kapasitas Belajar 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kapasitas_belajar" id="kapasitas_belajar" placeholder="Kapasitas Belajar" value="<?= set_value('kapasitas_belajar', $ruangan->kapasitas_belajar); ?>">
                                <small class="info help-block">
                                <b>Format Kapasitas Belajar must</b> Valid Number.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kapasitas_ujian" class="col-sm-2 control-label">Kapasitas Ujian 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kapasitas_ujian" id="kapasitas_ujian" placeholder="Kapasitas Ujian" value="<?= set_value('kapasitas_ujian', $ruangan->kapasitas_ujian); ?>">
                                <small class="info help-block">
                                <b>Format Kapasitas Ujian must</b> Valid Number.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="keterangan" name="keterangan" rows="10" cols="80"> <?= set_value('keterangan', $ruangan->keterangan); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_sekolah" class="col-sm-2 control-label">Sekolah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kode_sekolah" id="kode_sekolah" data-placeholder="Select Kode Sekolah" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_sekolah') as $row): ?>
                                    <option <?=  $row->id_kodesekolah ==  $ruangan->kode_sekolah ? 'selected' : ''; ?> value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
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
                                    <option <?=  $row->id_statuskeaktifan ==  $ruangan->aktif ? 'selected' : ''; ?> value="<?= $row->id_statuskeaktifan ?>"><?= $row->status_keaktifan; ?></option>
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
      
      CKEDITOR.replace('keterangan'); 
      var keterangan = CKEDITOR.instances.keterangan;
                   
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
              window.location.href = BASE_URL + 'administrator/ruangan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#keterangan').val(keterangan.getData());
                    
        var form_ruangan = $('#form_ruangan');
        var data_post = form_ruangan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_ruangan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#ruangan_image_galery').find('li').attr('qq-file-id');
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