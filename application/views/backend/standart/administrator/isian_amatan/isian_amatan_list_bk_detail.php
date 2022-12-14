
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Isian_amatan/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Detail Isian Amatan<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Detail Isian Amatan</li>
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
                     <div class="row pull-right">
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Isian Amatan']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/isian_amatan/' ); ?>"><i class="fa fa-arrow-circle-left" ></i> Kemabli Ke List</a>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Detail Isian Amatan</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Isian Amatan']); ?>  <i class="label bg-yellow"> <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_isian_amatan" id="form_isian_amatan" action="<?= base_url('administrator/isian_amatan/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>NO</th>
                           <th>Tanggal</th>
                           <th>Jam</th>
                           <th>Minggu Ke-</th>
                           <th>Sekolah</th>
                           <th>Kelas</th>
                           <th>Nama Siswa</th>
                           <th>Prilaku Yang Diamati</th>
                           <th>Kode Indikator Amatan</th>
                           <th>Status Amatan</th>
                           <th>Lokasi Amatan</th>
                           <th>Pengamat</th>
                           <th>Nama Pengamat</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_isian_amatan">
                      <?php $no=1; foreach($isian_amatan_bk_details as $isian_amatan_bk_detail): ?>
                        <tr>
                           <td><?= _ent($no++); ?></td>
                           
                           <td><?= date("d-m-Y", strtotime(_ent($isian_amatan_bk_detail->tanggal))); ?></td> 
                           <td><?= date("H:i:s", strtotime(_ent($isian_amatan_bk_detail->jam))) ; ?></td> 
                           <td><?= _ent($isian_amatan_bk_detail->minggu_ke); ?></td>
                             
                           <td><?= _ent($isian_amatan_bk_detail->kode_sekolah); ?></td>
                           <td><?= _ent($isian_amatan_bk_detail->kelas); ?></td>
                             
                           <td><?= _ent($isian_amatan_bk_detail->nama); ?></td>
                           <td><?= _ent($isian_amatan_bk_detail->isi_amatan); ?></td>
                             
                           <td><?= _ent($isian_amatan_bk_detail->kode_indikator); ?></td>
                             
                           <td><?= _ent($isian_amatan_bk_detail->nama_status_amatan); ?></td>
                           <td><?= _ent($isian_amatan_bk_detail->nama_lokasi); ?></td>
                             
                           <td><?= _ent($isian_amatan_bk_detail->jenis_pengamat); ?></td>
                             
                           <td><?= _ent($isian_amatan_bk_detail->nama_pengamat); ?></td> 
                        </tr>
                      <?php endforeach; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <!-- <hr> -->
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     
                  </div>
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
                     <div class="row pull-right">
                        
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Tindakan BK</h3>
                     <h5 class="widget-user-desc">List Tindakan BK</h5>
                     <hr>
                  </div>

                  <!-- table -->
                <div class="table-responsive">
                  <table class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr class="">
                        <th width="5%">No.</th>
                        <th width="15%">Tanggal</th>
                        <!-- <th>Nama Siswa</th> -->
                        <th>Isi Tindakan</th>
                        <th width="15%">Nama BK</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_rombel">
                      <?php $no = 1; ?>
                      <?php foreach ($tindakan_bks as $tindakan) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= _ent($tindakan->tanggal); ?></td>
                          <!-- <td><?= _ent($tindakan->id_siswa); ?></td> -->
                          <td><?= _ent($tindakan->isi_tindakan); ?></td>
                          <td><?= _ent($tindakan->nama_bk); ?></td>
                          
                          <td width="200">
                            <?php ?>
                            <a href="javascript:void(0);" data-href="<?= site_url('administrator/tindakan_bk/delete/' . $tindakan->id_tindakan_bk); ?>" class="label-default remove-data"><i class="fa fa-close"></i> Delete</a>
                            <?php  ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($tindakan_bk_counts == 0) : ?>
                        <tr>
                          <td colspan="100">
                            Tindakan BK data is not available (Kosong)
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <!-- tutup table -->
                <hr>
                  <?= form_open('', [
                    'name'    => 'form_isian_amatan_detail_bk',
                    'class'   => 'form-horizontal',
                    'id'      => 'form_isian_amatan_detail_bk',
                    'enctype' => 'multipart/form-data',
                    'method'  => 'POST'
                  ]); ?>

                  <input type="hidden" class="form-control" name="id_siswa" id="id_siswa" value="<?= $id_siswa; ?>">
                  <!-- <input type="hidden" class="form-control" name="sekolah" id="sekolah" value=" "> -->

                  <div class="form-group">
                    <label for="tanggal" class="col-sm-2 control-label">Tanggal<i class="required">*</i></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control pull-right datepicker" name="tanggal" id="tanggal" value="" placeholder="Pilih Tanggal">
                        <small class="info help-block">
                        <b>Input Tanggal</b> Max Length : 11.</small>
                    </div>
                  </div>

                  <div class="form-group ">
                      <label for="isi_tindakan" class="col-sm-2 control-label">Isi Tindakan
                      <i class="required">*</i>
                      </label>
                      <div class="col-sm-8">
                          <textarea type="text" class="form-control" rows="5" name="isi_tindakan" id="isi_tindakan" placeholder="Tindakan yang dilakukan oleh BK terhadap siswa tersebut"></textarea>
                          <small class="info help-block">
                          <b>Isi Tindakan</b> Max Length : 250.</small>
                      </div>
                  </div>


                  <div class="message"></div>
                  <div class="row-fluid col-md-7">
                    <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                      <i class="fa fa-save"></i> <?= cclang('save_button'); ?>
                    </button>
                    <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/isian_amatan'); ?>"><i class="fa fa-undo"></i> Kemabli Ke List </a>
                    <span class="loading loading-hide">
                      <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
                      <i><?= cclang('loading_saving_data'); ?></i>
                    </span>
                  </div>
                  <?= form_close(); ?>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  
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

     $('.btn_save').click(function() {
      $('.message').fadeOut();

      var form_isian_amatan_detail_bk = $('#form_isian_amatan_detail_bk');
      var data_post = form_isian_amatan_detail_bk.serializeArray();
      var save_type = $(this).attr('data-stype');

      data_post.push({
        name: 'save_type',
        value: save_type
      });

      $('.loading').show();

      $.ajax({
          url: BASE_URL + '/administrator/tindakan_bk/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if (res.success) {


            window.location.reload();
            return;


            $('.message').printMessage({
              message: res.message
            });
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');

          } else {
            $('.message').printMessage({
              message: res.message,
              type: 'warning'
            });
          }

        })
        .fail(function() {
          $('.message').printMessage({
            message: 'Error save data',
            type: 'warning'
          });
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({
            scrollTop: $(document).height()
          }, 2000);
        });

      return false;
    }); /*end btn save*/
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_isian_amatan').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/isian_amatan/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>