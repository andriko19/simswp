
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
        Akd Jurnal Guru        <small>Edit Akd Jurnal Guru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/akd_jurnal_guru'); ?>">Akd Jurnal Guru</a></li>
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
                            <h3 class="widget-user-username">Akd Jurnal Guru</h3>
                            <h5 class="widget-user-desc">Edit Akd Jurnal Guru</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/akd_jurnal_guru/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_akd_jurnal_guru', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_akd_jurnal_guru', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="kode_jadwal" class="col-sm-2 control-label">Kode Jadwal 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kode_jadwal" id="kode_jadwal" data-placeholder="Select Kode Jadwal" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('akd_jadwal_pelajaran') as $row): ?>
                                    <option <?=  $row->id_jadwal_pelajaran ==  $akd_jurnal_guru->kode_jadwal ? 'selected' : ''; ?> value="<?= $row->id_jadwal_pelajaran ?>"><?= $row->kode_jadwal; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Kode Jadwal</b> Max Length : 15.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="hari" class="col-sm-2 control-label">Hari 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="hari" id="hari" placeholder="Hari" value="<?= set_value('hari', $akd_jurnal_guru->hari); ?>">
                                <small class="info help-block">
                                <b>Input Hari</b> Max Length : 12.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tanggal" class="col-sm-2 control-label">Tanggal 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal"  placeholder="Tanggal" id="tanggal" value="<?= set_value('akd_jurnal_guru_tanggal_name', $akd_jurnal_guru->tanggal); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="jam_ke" class="col-sm-2 control-label">Jam Ke 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jam_ke" id="jam_ke" placeholder="Jam Ke" value="<?= set_value('jam_ke', $akd_jurnal_guru->jam_ke); ?>">
                                <small class="info help-block">
                                <b>Input Jam Ke</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="materi" class="col-sm-2 control-label">Materi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="materi" name="materi" rows="10" cols="80"> <?= set_value('materi', $akd_jurnal_guru->materi); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kompetensi_dasar" class="col-sm-2 control-label">Kompetensi Dasar 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kompetensi_dasar" id="kompetensi_dasar" placeholder="Kompetensi Dasar" value="<?= set_value('kompetensi_dasar', $akd_jurnal_guru->kompetensi_dasar); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="kegiatan" class="col-sm-2 control-label">Kegiatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('literasi_media', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="literasi_media"> Literasi Media                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('teori', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="teori"> Teori                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('praktik/kinerja', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="praktik/kinerja"> Praktik/Kinerja                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('penugasan', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="penugasan"> Penugasan                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('uh', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="uh"> Ulangan Harian                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('portofolio', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="portofolio"> Portofolio                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('projek', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="projek"> Projek                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('pts', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="pts"> PTS                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('pas', explode(',', $akd_jurnal_guru->kegiatan)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="kegiatan[]" value="pas"> PAS                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    <b>Input Kegiatan</b> Max Length : 255.</small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="media_pembelajaran" class="col-sm-2 control-label">Media Pembelajaran 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('classroom', explode(',', $akd_jurnal_guru->media_pembelajaran)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="media_pembelajaran[]" value="classroom"> Classroom                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('wa', explode(',', $akd_jurnal_guru->media_pembelajaran)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="media_pembelajaran[]" value="wa"> Whatsapp                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('google_meet', explode(',', $akd_jurnal_guru->media_pembelajaran)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="media_pembelajaran[]" value="google_meet"> Google Meet                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('moodle', explode(',', $akd_jurnal_guru->media_pembelajaran)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="media_pembelajaran[]" value="moodle"> Moodle                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('email', explode(',', $akd_jurnal_guru->media_pembelajaran)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="media_pembelajaran[]" value="email"> Email                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('telegram', explode(',', $akd_jurnal_guru->media_pembelajaran)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="media_pembelajaran[]" value="telegram"> Telegram                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('rumah_belajar', explode(',', $akd_jurnal_guru->media_pembelajaran)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="media_pembelajaran[]" value="rumah_belajar"> Rumah Belajar                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    <b>Input Media Pembelajaran</b> Max Length : 255.</small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="sumber_belajar" class="col-sm-2 control-label">Sumber Belajar 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('buku/ebook', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="buku/ebook"> Buku/Ebook                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('modul', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="modul"> Modul                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('youtube', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="youtube"> Youtube                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('google_drive', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="google_drive"> Google Drive                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('blogspot/wordpress', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="blogspot/wordpress"> Blogspot/Wordpress                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('powerpoint', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="powerpoint"> Power Point                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('video_interaktif', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="video_interaktif"> Video Interaktif                                    </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input <?= in_array('materi_rumah_belajar', explode(',', $akd_jurnal_guru->sumber_belajar)) ? 'checked' : ''; ?>  type="checkbox" class="flat-red" name="sumber_belajar[]" value="materi_rumah_belajar"> Materi Rumah Belajar                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    <b>Input Sumber Belajar</b> Max Length : 255.</small>
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="keterangan" name="keterangan" rows="10" cols="80"> <?= set_value('keterangan', $akd_jurnal_guru->keterangan); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_sekolah" class="col-sm-2 control-label">Sekolah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_sekolah" id="kode_sekolah" placeholder="Sekolah" value="<?= set_value('kode_sekolah', $akd_jurnal_guru->kode_sekolah); ?>">
                                <small class="info help-block">
                                <b>Input Kode Sekolah</b> Max Length : 11.</small>
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
      
      CKEDITOR.replace('materi'); 
      var materi = CKEDITOR.instances.materi;
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
              window.location.href = BASE_URL + 'administrator/akd_jurnal_guru';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#materi').val(materi.getData());
                $('#keterangan').val(keterangan.getData());
                    
        var form_akd_jurnal_guru = $('#form_akd_jurnal_guru');
        var data_post = form_akd_jurnal_guru.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_akd_jurnal_guru.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#akd_jurnal_guru_image_galery').find('li').attr('qq-file-id');
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