
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
      Lokasi Amatan      <small><?= cclang('detail', ['Lokasi Amatan']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/lokasi_amatan'); ?>">Lokasi Amatan</a></li>
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
                     <h3 class="widget-user-username">Lokasi Amatan</h3>
                     <h5 class="widget-user-desc">Detail Lokasi Amatan</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_lokasi_amatan" id="form_lokasi_amatan" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id Lokasi Amatan </label>

                        <div class="col-sm-8">
                           <?= _ent($lokasi_amatan->id_lokasi_amatan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Lokasi </label>

                        <div class="col-sm-8">
                           <?= _ent($lokasi_amatan->nama_lokasi); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('lokasi_amatan_update', function() use ($lokasi_amatan){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit lokasi_amatan (Ctrl+e)" href="<?= site_url('administrator/lokasi_amatan/edit/'.$lokasi_amatan->id_lokasi_amatan); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Lokasi Amatan']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/lokasi_amatan/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Lokasi Amatan']); ?></a>
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
