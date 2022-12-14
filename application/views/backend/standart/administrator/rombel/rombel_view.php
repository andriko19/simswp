
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
      Rombel      <small><?= cclang('detail', ['Rombel']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/rombel'); ?>">Rombel</a></li>
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
                     <h3 class="widget-user-username">Rombel</h3>
                     <h5 class="widget-user-desc">Detail Rombel</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_rombel" id="form_rombel" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id Rombel </label>

                        <div class="col-sm-8">
                           <?= _ent($rombel->id_rombel); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Sekolah </label>

                        <div class="col-sm-8">
                           <?= _ent($rombel->kode_sekolah); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Jurusan </label>

                        <div class="col-sm-8">
                           <?= _ent($rombel->kode_jurusan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Rombel </label>

                        <div class="col-sm-8">
                           <?= _ent($rombel->nama_rombel); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Wali Kelas </label>

                        <div class="col-sm-8">
                           <?= _ent($rombel->nama_guru); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kelas </label>

                        <div class="col-sm-8">
                           <?= _ent($rombel->nama_kelas); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Periode </label>

                        <div class="col-sm-8">
                           <?= _ent($rombel->periode); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('rombel_update', function() use ($rombel){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit rombel (Ctrl+e)" href="<?= site_url('administrator/rombel/edit/'.$rombel->id_rombel); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Rombel']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/rombel/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Rombel']); ?></a>
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
