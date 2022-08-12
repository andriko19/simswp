
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Laporan Pengamatan Perilaku Siswa      <small><?= cclang('detail', ['Laporan Pengamatan Perilaku Siswa']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/laporan_pengamatan_perilaku_siswa'); ?>">Laporan Pengamatan Perilaku Siswa</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Laporan Pengamatan Perilaku Siswa</h3>
                     <h5 class="widget-user-desc">Detail Laporan Pengamatan Perilaku Siswa</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_laporan_pengamatan_perilaku_siswa" id="form_laporan_pengamatan_perilaku_siswa" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id Laporan Pengamatan Perilaku Siswa </label>

                        <div class="col-sm-8">
                           <?= _ent($laporan_pengamatan_perilaku_siswa->id_laporan_pengamatan_perilaku_siswa); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jenis Laporan </label>

                        <div class="col-sm-8">
                           <?= _ent($laporan_pengamatan_perilaku_siswa->jenis_laporan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Laporan Pengamatan Perilaku Siswa </label>

                        <div class="col-sm-8">
                           <?= _ent($laporan_pengamatan_perilaku_siswa->laporan_pengamatan_perilaku_siswa); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('laporan_pengamatan_perilaku_siswa_update', function() use ($laporan_pengamatan_perilaku_siswa){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit laporan_pengamatan_perilaku_siswa (Ctrl+e)" href="<?= site_url('administrator/laporan_pengamatan_perilaku_siswa/edit/'.$laporan_pengamatan_perilaku_siswa->id_laporan_pengamatan_perilaku_siswa); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Laporan Pengamatan Perilaku Siswa']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/laporan_pengamatan_perilaku_siswa/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Laporan Pengamatan Perilaku Siswa']); ?></a>
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
