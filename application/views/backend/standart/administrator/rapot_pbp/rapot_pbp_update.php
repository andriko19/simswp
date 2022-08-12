
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
        Rapot Pbp        <small>Edit Rapot Pbp</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/rapot_pbp'); ?>">Rapot Pbp</a></li>
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
                            <h3 class="widget-user-username">Rapot Pbp</h3>
                            <h5 class="widget-user-desc">Edit Rapot Pbp</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/rapot_pbp/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_rapot_pbp', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_rapot_pbp', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="form-group ">
                            <label for="id_siswa" class="col-sm-2 control-label">Nama Siswa 
                            </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama', $rapot_pbp->nama); ?>" readonly>
                            </div>

                            <label for="id_siswa" class="col-sm-2 control-label">Kelas 
                            </label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" name="nipd" id="nipd" value="<?= set_value('nipd', $rapot_pbp->rombel); ?>" readonly>
                                
                            </div>
                        </div>
                      
                                                 
                        <div class="form-group ">
                            <label for="id_semester" class="col-sm-2 control-label">No. Induk 
                            </label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" name="nipd" id="nipd" value="<?= set_value('nipd', $rapot_pbp->nipd); ?>" readonly>

                              <input type="hidden" class="form-control" name="id_siswa" id="id_siswa" value="<?= set_value('id_siswa', $rapot_pbp->id_siswa); ?>" readonly>
                              <input type="hidden" class="form-control" name="id_semester" id="id_semester" value="<?= set_value('id_semester', $rapot_pbp->id_semester); ?>" readonly>
                            </div>

                            <?php
                              $querySemester =  $this->db->query("SELECT *
                                                FROM semester
                                                JOIN periode ON periode.id_periode = semester.id_periode
                                                WHERE semester.id_semester =  $rapot_pbp->id_semester");
                              $sqlSemseter = $querySemester->row();
                            ?>

                            <label for="id_semester" class="col-sm-2 control-label">Semester  
                            </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nipd" id="nipd" value="<?= set_value('nipd', $sqlSemseter->periode ." ". $sqlSemseter->semester); ?>" readonly>
                            </div>
                        </div>
                      
                        <hr>                                                 
                                                <div class="form-group ">
                            <label for="id_pilar_pbp_1" class="col-sm-2 control-label">Pilar 1 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_1" id="id_pilar_pbp_1" placeholder="Pilar 1" value="<?= set_value('id_pilar_pbp_1', $rapot_pbp->id_pilar_pbp_1); ?>" readonly>
                                <input type="text" class="form-control" name="pilar_pbp1" id="pilar_pbp1" placeholder="Pilar 1" value="<?= set_value('pilar_pbp1', $rapot_pbp->pilar_1); ?>" readonly>
                                <small class="info help-block">
                                <b>Input Id Pilar Pbp 1</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="catatan_pbp_1" class="col-sm-2 control-label">Catatan Pilar 1 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_1" name="catatan_pbp_1" rows="5" class="textarea"><?= set_value('catatan_pbp_1', $rapot_pbp->catatan_pbp_1); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="id_pilar_pbp_2" class="col-sm-2 control-label">Pilar 2 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_2" id="id_pilar_pbp_2" placeholder="Pilar 2" value="<?= set_value('id_pilar_pbp_2', $rapot_pbp->id_pilar_pbp_2); ?>" readonly>
                                <input type="text" class="form-control" name="pilar_pbp2" id="pilar_pbp2" placeholder="Pilar 2" value="<?= set_value('pilar_pbp2', $rapot_pbp->pilar_2); ?>" readonly>
                                <small class="info help-block">
                                <b>Input Id Pilar Pbp 2</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="catatan_pbp_2" class="col-sm-2 control-label">Catatan Pilar 2 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_2" name="catatan_pbp_2" rows="5" class="textarea"><?= set_value('catatan_pbp_2', $rapot_pbp->catatan_pbp_2); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="id_pilar_pbp_3" class="col-sm-2 control-label">Pilar 3 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_3" id="id_pilar_pbp_3" placeholder="Pilar 3" value="<?= set_value('id_pilar_pbp_3', $rapot_pbp->id_pilar_pbp_3); ?>" readonly>
                                <input type="text" class="form-control" name="pilar_pbp3" id="pilar_pbp3" placeholder="Pilar 3" value="<?= set_value('pilar_pbp3', $rapot_pbp->pilar_3); ?>" readonly>
                                <small class="info help-block">
                                <b>Input Id Pilar Pbp 3</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="catatan_pbp_3" class="col-sm-2 control-label">Catatan Pilar 3 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_3" name="catatan_pbp_3" rows="5" class="textarea"><?= set_value('catatan_pbp_3', $rapot_pbp->catatan_pbp_3); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="id_pilar_pbp_4" class="col-sm-2 control-label">Pilar 4 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_4" id="id_pilar_pbp_4" placeholder="Pilar 4" value="<?= set_value('id_pilar_pbp_4', $rapot_pbp->id_pilar_pbp_4); ?>" readonly>
                                <input type="text" class="form-control" name="pilar_pbp4" id="pilar_pbp4" placeholder="Pilar 4" value="<?= set_value('pilar_pbp4', $rapot_pbp->pilar_4); ?>" readonly>
                                <small class="info help-block">
                                <b>Input Id Pilar Pbp 4</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="catatan_pbp_4" class="col-sm-2 control-label">Catatan Pilar 4 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_4" name="catatan_pbp_4" rows="5" class="textarea"><?= set_value('catatan_pbp_4', $rapot_pbp->catatan_pbp_4); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="id_pilar_pbp_5" class="col-sm-2 control-label">Pilar 5 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_5" id="id_pilar_pbp_5" placeholder="Pilar 5" value="<?= set_value('id_pilar_pbp_5', $rapot_pbp->id_pilar_pbp_5); ?>" readonly>
                                <input type="text" class="form-control" name="pilar_pbp5" id="pilar_pbp5" placeholder="Pilar 5" value="<?= set_value('pilar_pbp5', $rapot_pbp->pilar_5); ?>" readonly>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="catatan_pbp_5" class="col-sm-2 control-label">Catatan Pilar 5 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_5" name="catatan_pbp_5" rows="5" class="textarea"><?= set_value('catatan_pbp_5', $rapot_pbp->catatan_pbp_5); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="id_pilar_pbp_6" class="col-sm-2 control-label">Pilar 6 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_6" id="id_pilar_pbp_6" placeholder="Pilar 6" value="<?= set_value('id_pilar_pbp_6', $rapot_pbp->id_pilar_pbp_6); ?>" readonly>
                                <input type="text" class="form-control" name="pilar_pbp6" id="pilar_pbp6" placeholder="Pilar 6" value="<?= set_value('pilar_pbp6', $rapot_pbp->pilar_6); ?>" readonly>
                                <small class="info help-block">
                                <b>Input Id Pilar Pbp 6</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="catatan_pbp_6" class="col-sm-2 control-label">Catatan Pilar 6 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_6" name="catatan_pbp_6" rows="5" class="textarea"><?= set_value('catatan_pbp_6', $rapot_pbp->catatan_pbp_6); ?></textarea>
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
                              <input type="text" class="form-control pull-right datepicker" name="tanggal"  placeholder="Tanggal" id="tanggal" value="<?= set_value('rapot_pbp_tanggal_name', $rapot_pbp->tanggal); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                        <input type="hidden" class="form-control" name="id_guru" id="id_guru" placeholder="Wali Kelas" value="<?= set_value('id_guru', $rapot_pbp->id_guru); ?>">
                                                
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
              window.location.href = BASE_URL + 'administrator/rapot_pbp';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_rapot_pbp = $('#form_rapot_pbp');
        var data_post = form_rapot_pbp.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_rapot_pbp.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#rapot_pbp_image_galery').find('li').attr('qq-file-id');
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