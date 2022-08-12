
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Siswa/add';
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
      Siswa<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Siswa</li>
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
                        <?php is_allowed('siswa_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Siswa']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/siswa/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Siswa']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('siswa_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Siswa" href="<?= site_url('administrator/siswa/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('siswa_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Siswa" href="<?= site_url('administrator/siswa/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Siswa</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Siswa']); ?>  <i class="label bg-yellow"><?= $siswa_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_siswa" id="form_siswa" action="<?= base_url('administrator/siswa/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>NIPD</th>
                           <th>Password</th>
                           <th>Nama Siswa</th>
                           <th>Jenis Kelamin</th>
                           <th>NISN</th>
                           <th>Tempat Lahir</th>
                           <th>Tanggal Lahir</th>
                           <th>NIK</th>
                           <th>Agama</th>
                           <th>Kebutuhan Khusus</th>
                           <th>Alamat</th>
                           <th>RT</th>
                           <th>RW</th>
                           <th>Dusun</th>
                           <th>Desa/Kelurahan</th>
                           <th>Kecamatan</th>
                           <th>Kode Pos</th>
                           <th>Jenis Tinggal</th>
                           <th>Alat Transportasi</th>
                           <th>Telepon</th>
                           <th>HP</th>
                           <th>Email Aktif</th>
                           <th>SKHUN</th>
                           <th>Penerima KPS</th>
                           <th>No. KPS</th>
                           <th>Foto</th>
                           <th>Nama Ayah</th>
                           <th>Tahun Lahir Ayah</th>
                           <th>Pendidikan Ayah</th>
                           <th>Pekerjaan Ayah</th>
                           <th>Penghasilan Ayah</th>
                           <th>Kebutuhan Khusus Ayah</th>
                           <th>No. Telepon Ayah</th>
                           <th>Nama Ibu</th>
                           <th>Tahun Lahir Ibu</th>
                           <th>Pendidikan Ibu</th>
                           <th>Pekerjaan Ibu</th>
                           <th>Penghasilan Ibu</th>
                           <th>Kebutuhan Khusus Ibu</th>
                           <th>No. Telepon Ibu</th>
                           <th>Nama Wali</th>
                           <th>Tahun Lahir Wali</th>
                           <th>Pendidikan Wali</th>
                           <th>Pekerjaan Wali</th>
                           <th>Penghasilan Wali</th>
                           <th>Angkatan/Tahun Masuk</th>
                           <th>Status Awal</th>
                           <th>Status Keaktifan</th>
                           <th>Tingkat</th>
                           <th>Kelas</th>
                           <th>Jurusan</th>
                           <th>Sesi</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_siswa">
                     <?php foreach($siswas as $siswa): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $siswa->id_siswa; ?>">
                           </td>
                           
                           <td><?= _ent($siswa->nipd); ?></td> 
                           <td><?= _ent($siswa->password); ?></td> 
                           <td><?= _ent($siswa->nama); ?></td> 
                           <td><?= _ent($siswa->jenis_kelamin); ?></td>
                             
                           <td><?= _ent($siswa->nisn); ?></td> 
                           <td><?= _ent($siswa->tempat_lahir); ?></td> 
                           <td><?= _ent($siswa->tanggal_lahir); ?></td> 
                           <td><?= _ent($siswa->nik); ?></td> 
                           <td><?= _ent($siswa->agama); ?></td>
                             
                           <td><?= _ent($siswa->kebutuhan_khusus); ?></td> 
                           <td><?= _ent($siswa->alamat); ?></td> 
                           <td><?= _ent($siswa->rt); ?></td> 
                           <td><?= _ent($siswa->rw); ?></td> 
                           <td><?= _ent($siswa->dusun); ?></td> 
                           <td><?= _ent($siswa->kelurahan); ?></td> 
                           <td><?= _ent($siswa->kecamatan); ?></td> 
                           <td><?= _ent($siswa->kode_pos); ?></td> 
                           <td><?= _ent($siswa->jenis_tinggal); ?></td> 
                           <td><?= _ent($siswa->alat_transportasi); ?></td> 
                           <td><?= _ent($siswa->telepon); ?></td> 
                           <td><?= _ent($siswa->hp); ?></td> 
                           <td><?= _ent($siswa->email); ?></td> 
                           <td><?= _ent($siswa->skhun); ?></td> 
                           <td><?= _ent($siswa->penerima_kps); ?></td> 
                           <td><?= _ent($siswa->no_kps); ?></td> 
                           <td>
                              <?php if (!empty($siswa->foto)): ?>
                                <?php if (is_image($siswa->foto)): ?>
                                <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/siswa/' . $siswa->foto; ?>">
                                  <img src="<?= BASE_URL . 'uploads/siswa/' . $siswa->foto; ?>" class="image-responsive" alt="image siswa" title="foto siswa" width="40px">
                                </a>
                                <?php else: ?>
                                  <a href="<?= BASE_URL . 'administrator/file/download/siswa/' . $siswa->foto; ?>">
                                   <img src="<?= get_icon_file($siswa->foto); ?>" class="image-responsive image-icon" alt="image siswa" title="foto <?= $siswa->foto; ?>" width="40px"> 
                                 </a>
                                <?php endif; ?>
                              <?php endif; ?>
                           </td>
                            
                           <td><?= _ent($siswa->nama_ayah); ?></td> 
                           <td><?= _ent($siswa->tahun_lahir_ayah); ?></td> 
                           <td><?= _ent($siswa->pendidikan_ayah); ?></td> 
                           <td><?= _ent($siswa->pekerjaan_ayah); ?></td> 
                           <td><?= _ent($siswa->penghasilan_ayah); ?></td> 
                           <td><?= _ent($siswa->kebutuhan_khusus_ayah); ?></td> 
                           <td><?= _ent($siswa->no_telpon_ayah); ?></td> 
                           <td><?= _ent($siswa->nama_ibu); ?></td> 
                           <td><?= _ent($siswa->tahun_lahir_ibu); ?></td> 
                           <td><?= _ent($siswa->pendidikan_ibu); ?></td> 
                           <td><?= _ent($siswa->pekerjaan_ibu); ?></td> 
                           <td><?= _ent($siswa->penghasilan_ibu); ?></td> 
                           <td><?= _ent($siswa->kebutuhan_khusus_ibu); ?></td> 
                           <td><?= _ent($siswa->no_telpon_ibu); ?></td> 
                           <td><?= _ent($siswa->nama_wali); ?></td> 
                           <td><?= _ent($siswa->tahun_lahir_wali); ?></td> 
                           <td><?= _ent($siswa->pendidikan_wali); ?></td> 
                           <td><?= _ent($siswa->pekerjaan_wali); ?></td> 
                           <td><?= _ent($siswa->penghasilan_wali); ?></td> 
                           <td><?= _ent($siswa->angkatan); ?></td> 
                           <td><?= _ent($siswa->status_awal); ?></td> 
                           <td><?= _ent($siswa->status_keaktifan); ?></td>
                             
                           <td><?= _ent($siswa->tingkat); ?></td> 
                           <td><?= _ent($siswa->nama_kelas); ?></td>
                             
                           <td><?= _ent($siswa->kode_jurusan); ?></td>
                             
                           <td><?= _ent($siswa->id_sesi); ?></td> 
                           <td width="200">
                              <?php is_allowed('siswa_view', function() use ($siswa){?>
                              <a href="<?= site_url('administrator/siswa/view/' . $siswa->id_siswa); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> <?= cclang('view_button'); ?>
                              <?php }) ?>
                              <?php is_allowed('siswa_update', function() use ($siswa){?>
                              <a href="<?= site_url('administrator/siswa/edit/' . $siswa->id_siswa); ?>" class="label-default"><i class="fa fa-edit "></i> <?= cclang('update_button'); ?></a>
                              <?php }) ?>
                              <?php is_allowed('siswa_delete', function() use ($siswa){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/siswa/delete/' . $siswa->id_siswa); ?>" class="label-default remove-data"><i class="fa fa-close"></i> <?= cclang('remove_button'); ?></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($siswa_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Siswa data is not available
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                            <option <?= $this->input->get('f') == 'nipd' ? 'selected' :''; ?> value="nipd">Nipd</option>
                           <option <?= $this->input->get('f') == 'password' ? 'selected' :''; ?> value="password">Password</option>
                           <option <?= $this->input->get('f') == 'nama' ? 'selected' :''; ?> value="nama">Nama</option>
                           <option <?= $this->input->get('f') == 'id_jenis_kelamin' ? 'selected' :''; ?> value="id_jenis_kelamin">Id Jenis Kelamin</option>
                           <option <?= $this->input->get('f') == 'nisn' ? 'selected' :''; ?> value="nisn">Nisn</option>
                           <option <?= $this->input->get('f') == 'tempat_lahir' ? 'selected' :''; ?> value="tempat_lahir">Tempat Lahir</option>
                           <option <?= $this->input->get('f') == 'tanggal_lahir' ? 'selected' :''; ?> value="tanggal_lahir">Tanggal Lahir</option>
                           <option <?= $this->input->get('f') == 'nik' ? 'selected' :''; ?> value="nik">Nik</option>
                           <option <?= $this->input->get('f') == 'id_agama' ? 'selected' :''; ?> value="id_agama">Id Agama</option>
                           <option <?= $this->input->get('f') == 'kebutuhan_khusus' ? 'selected' :''; ?> value="kebutuhan_khusus">Kebutuhan Khusus</option>
                           <option <?= $this->input->get('f') == 'alamat' ? 'selected' :''; ?> value="alamat">Alamat</option>
                           <option <?= $this->input->get('f') == 'rt' ? 'selected' :''; ?> value="rt">Rt</option>
                           <option <?= $this->input->get('f') == 'rw' ? 'selected' :''; ?> value="rw">Rw</option>
                           <option <?= $this->input->get('f') == 'dusun' ? 'selected' :''; ?> value="dusun">Dusun</option>
                           <option <?= $this->input->get('f') == 'kelurahan' ? 'selected' :''; ?> value="kelurahan">Kelurahan</option>
                           <option <?= $this->input->get('f') == 'kecamatan' ? 'selected' :''; ?> value="kecamatan">Kecamatan</option>
                           <option <?= $this->input->get('f') == 'kode_pos' ? 'selected' :''; ?> value="kode_pos">Kode Pos</option>
                           <option <?= $this->input->get('f') == 'jenis_tinggal' ? 'selected' :''; ?> value="jenis_tinggal">Jenis Tinggal</option>
                           <option <?= $this->input->get('f') == 'alat_transportasi' ? 'selected' :''; ?> value="alat_transportasi">Alat Transportasi</option>
                           <option <?= $this->input->get('f') == 'telepon' ? 'selected' :''; ?> value="telepon">Telepon</option>
                           <option <?= $this->input->get('f') == 'hp' ? 'selected' :''; ?> value="hp">Hp</option>
                           <option <?= $this->input->get('f') == 'email' ? 'selected' :''; ?> value="email">Email</option>
                           <option <?= $this->input->get('f') == 'skhun' ? 'selected' :''; ?> value="skhun">Skhun</option>
                           <option <?= $this->input->get('f') == 'penerima_kps' ? 'selected' :''; ?> value="penerima_kps">Penerima Kps</option>
                           <option <?= $this->input->get('f') == 'no_kps' ? 'selected' :''; ?> value="no_kps">No Kps</option>
                           <option <?= $this->input->get('f') == 'foto' ? 'selected' :''; ?> value="foto">Foto</option>
                           <option <?= $this->input->get('f') == 'nama_ayah' ? 'selected' :''; ?> value="nama_ayah">Nama Ayah</option>
                           <option <?= $this->input->get('f') == 'tahun_lahir_ayah' ? 'selected' :''; ?> value="tahun_lahir_ayah">Tahun Lahir Ayah</option>
                           <option <?= $this->input->get('f') == 'pendidikan_ayah' ? 'selected' :''; ?> value="pendidikan_ayah">Pendidikan Ayah</option>
                           <option <?= $this->input->get('f') == 'pekerjaan_ayah' ? 'selected' :''; ?> value="pekerjaan_ayah">Pekerjaan Ayah</option>
                           <option <?= $this->input->get('f') == 'penghasilan_ayah' ? 'selected' :''; ?> value="penghasilan_ayah">Penghasilan Ayah</option>
                           <option <?= $this->input->get('f') == 'kebutuhan_khusus_ayah' ? 'selected' :''; ?> value="kebutuhan_khusus_ayah">Kebutuhan Khusus Ayah</option>
                           <option <?= $this->input->get('f') == 'no_telpon_ayah' ? 'selected' :''; ?> value="no_telpon_ayah">No Telpon Ayah</option>
                           <option <?= $this->input->get('f') == 'nama_ibu' ? 'selected' :''; ?> value="nama_ibu">Nama Ibu</option>
                           <option <?= $this->input->get('f') == 'tahun_lahir_ibu' ? 'selected' :''; ?> value="tahun_lahir_ibu">Tahun Lahir Ibu</option>
                           <option <?= $this->input->get('f') == 'pendidikan_ibu' ? 'selected' :''; ?> value="pendidikan_ibu">Pendidikan Ibu</option>
                           <option <?= $this->input->get('f') == 'pekerjaan_ibu' ? 'selected' :''; ?> value="pekerjaan_ibu">Pekerjaan Ibu</option>
                           <option <?= $this->input->get('f') == 'penghasilan_ibu' ? 'selected' :''; ?> value="penghasilan_ibu">Penghasilan Ibu</option>
                           <option <?= $this->input->get('f') == 'kebutuhan_khusus_ibu' ? 'selected' :''; ?> value="kebutuhan_khusus_ibu">Kebutuhan Khusus Ibu</option>
                           <option <?= $this->input->get('f') == 'no_telpon_ibu' ? 'selected' :''; ?> value="no_telpon_ibu">No Telpon Ibu</option>
                           <option <?= $this->input->get('f') == 'nama_wali' ? 'selected' :''; ?> value="nama_wali">Nama Wali</option>
                           <option <?= $this->input->get('f') == 'tahun_lahir_wali' ? 'selected' :''; ?> value="tahun_lahir_wali">Tahun Lahir Wali</option>
                           <option <?= $this->input->get('f') == 'pendidikan_wali' ? 'selected' :''; ?> value="pendidikan_wali">Pendidikan Wali</option>
                           <option <?= $this->input->get('f') == 'pekerjaan_wali' ? 'selected' :''; ?> value="pekerjaan_wali">Pekerjaan Wali</option>
                           <option <?= $this->input->get('f') == 'penghasilan_wali' ? 'selected' :''; ?> value="penghasilan_wali">Penghasilan Wali</option>
                           <option <?= $this->input->get('f') == 'angkatan' ? 'selected' :''; ?> value="angkatan">Angkatan</option>
                           <option <?= $this->input->get('f') == 'status_awal' ? 'selected' :''; ?> value="status_awal">Status Awal</option>
                           <option <?= $this->input->get('f') == 'status_siswa' ? 'selected' :''; ?> value="status_siswa">Status Siswa</option>
                           <option <?= $this->input->get('f') == 'tingkat' ? 'selected' :''; ?> value="tingkat">Tingkat</option>
                           <option <?= $this->input->get('f') == 'kode_kelas' ? 'selected' :''; ?> value="kode_kelas">Kode Kelas</option>
                           <option <?= $this->input->get('f') == 'kode_jurusan' ? 'selected' :''; ?> value="kode_jurusan">Kode Jurusan</option>
                           <option <?= $this->input->get('f') == 'id_sesi' ? 'selected' :''; ?> value="id_sesi">Id Sesi</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/siswa');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                  </form>                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
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
      var serialize_bulk = $('#form_siswa').serialize();

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
               document.location.href = BASE_URL + '/administrator/siswa/delete?' + serialize_bulk;      
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