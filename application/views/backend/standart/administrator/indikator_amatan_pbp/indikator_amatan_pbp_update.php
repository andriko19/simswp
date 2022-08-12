
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
        Indikator Amatan Pbp        <small>Edit Indikator Amatan Pbp</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/indikator_amatan_pbp'); ?>">Indikator Amatan Pbp</a></li>
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
                            <h3 class="widget-user-username">Indikator Amatan Pbp</h3>
                            <h5 class="widget-user-desc">Edit Indikator Amatan Pbp</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/indikator_amatan_pbp/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_indikator_amatan_pbp', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_indikator_amatan_pbp', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="form-group ">
                            <label for="kode_indikator" class="col-sm-2 control-label">Kode Indikator 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_indikator" id="kode_indikator" placeholder="Kode Indikator" value="<?= set_value('kode_indikator', $indikator_amatan_pbp->kode_indikator); ?>">
                                <small class="info help-block">
                                <b>Input Kode Indikator</b> Max Length : 30.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_dimensi_pbp" class="col-sm-2 control-label">Id Dimensi Pbp 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_dimensi_pbp" id="id_dimensi_pbp" data-placeholder="Select Id Dimensi Pbp" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('dimensi_pbp') as $row): ?>
                                    <option <?=  $row->id_dimensi_pbp ==  $indikator_amatan_pbp->id_dimensi_pbp ? 'selected' : ''; ?> value="<?= $row->id_dimensi_pbp ?>"><?= $row->dimensi_pbp; ?></option>
                                    <?php endforeach; ?>   
                                </select>
                                <small class="info help-block">
                                <b>Input Id Dimensi Pbp</b> Max Length : 11.</small>
                            </div>
                        </div>
                         
                        <div class="form-group ">
                            <label for="indikator" class="col-sm-2 control-label">Indikator 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="indikator" id="indikator" placeholder="Indikator" value="<?= set_value('indikator', $indikator_amatan_pbp->indikator); ?>">
                                <small class="info help-block">
                                <b>Input Indikator</b> Max Length : 100.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_pilar_pbp" class="col-sm-2 control-label">Id Kode Sekolah
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_kodesekolah" id="id_kodesekolah" data-placeholder="Select Id Pilar Pbp" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_sekolah') as $row): ?>
                                    <option <?=  $row->id_kodesekolah ==  $indikator_amatan_pbp->id_kodesekolah ? 'selected' : ''; ?> value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Id Kode Sekolah</b> Max Length : 11.</small>
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
              window.location.href = BASE_URL + 'administrator/indikator_amatan_pbp';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_indikator_amatan_pbp = $('#form_indikator_amatan_pbp');
        var data_post = form_indikator_amatan_pbp.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_indikator_amatan_pbp.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#indikator_amatan_pbp_image_galery').find('li').attr('qq-file-id');
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