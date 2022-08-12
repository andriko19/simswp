
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
        Rapot Pbp        <small><?= cclang('new', ['Rapot Pbp']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/rapot_pbp'); ?>">Rapot Pbp</a></li>
        <li class="active"><?= cclang('new'); ?></li>
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
                            <h5 class="widget-user-desc"><?= cclang('new', ['Rapot Pbp']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_rapot_pbp', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_rapot_pbp', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                        <!-- <?php var_dump($id_wali); ?> -->

                        <?php
                          if ($id_wali == 0) {
                            $querySiswa =  $this->db->query("SELECT *
                                              FROM siswa
                                              JOIN detail_rombel ON detail_rombel.id_siswa = siswa.id_siswa
                                              JOIN rombel ON rombel.id_rombel = detail_rombel.id_rombel
                                              ");
                            $sql = $querySiswa->result();
                          } else {
                            $querySiswa =  $this->db->query("SELECT *
                                              FROM siswa
                                              JOIN detail_rombel ON detail_rombel.id_siswa = siswa.id_siswa
                                              JOIN rombel ON rombel.id_rombel = detail_rombel.id_rombel
                                              WHERE rombel.wali_kelas = $id_wali");
                            $sql = $querySiswa->result();
                          }
                        ?>

                        <div class="form-group ">
                            <label for="id_siswa" class="col-sm-2 control-label">Kelas/NIPD/Nama Siswa 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_siswa" id="id_siswa" data-placeholder="Select Id Siswa" >
                                    <option value=""></option>
                                    <?php foreach ($sql as $row): ?>
                                        <option value="<?= $row->id_siswa ?>"><?= $row->nama_rombel ." / ". $row->nipd ." / ". $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Id Siswa</b> Max Length : 11.</small>
                            </div>
                        </div>

                        <?php
                          $querySemester =  $this->db->query('SELECT *
                                            FROM semester
                                            JOIN periode ON periode.id_periode = semester.id_periode');
                          $sqlSemseter = $querySemester->result();
                        ?>
                        <div class="form-group ">
                            <label for="id_semester" class="col-sm-2 control-label">Semester 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="id_semester" id="id_semester" data-placeholder="Select Id Semester" >
                                    <option value=""></option>
                                    <?php foreach ($sqlSemseter as $row): ?>
                                      <option value="<?= $row->id_semester ?>"><?= $row->periode ." ". $row->semester; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Id Semester</b> Max Length : 11.</small>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group ">
                            <label for="id_pilar_pbp_1" class="col-sm-2 control-label">Pilar 1 
                            <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_1" id="id_pilar_pbp_1" placeholder="Pilar 1" value="1">
                                <div class="table-responsive"> 
                                  <table class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr class="">
                                          <th colspan="7" bgcolor="#ddd7d8" style="text-align: center;">DAPAT DIPERCAYA</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr class="">
                                          <th style="text-align: center;">No. </th>
                                          <th style="text-align: center;">Dimensi</th>
                                          <th style="text-align: center;">Perilaku Yang Diamati</th>
                                          <th style="text-align: center;">Kode</th>
                                          <th style="text-align: center;">Jumlah Amatan</th>
                                          <th style="text-align: center;">Positif</th>
                                          <th style="text-align: center;">Negatif</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_rapot_pbp_1">
                                      
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="catatan_pbp_1" class="col-sm-2 control-label">Catatan Pilar 1 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_1" name="catatan_pbp_1" rows="5" class="textarea"><?= set_value('catatan_pbp_1'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <hr>
                                                 
                        <div class="form-group ">
                            <label for="id_pilar_pbp_2" class="col-sm-2 control-label">Pilar  2 
                            <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_2" id="id_pilar_pbp_2" placeholder="Pilar  2" value="2">
                                <div class="table-responsive"> 
                                  <table class="table table-bordered table-striped dataTable">
                                     <thead>
                                        <tr class="">
                                           <th colspan="7" bgcolor="#ddd7d8" style="text-align: center;">TANGGUNGJAWAB</th>
                                        </tr>
                                     </thead>
                                     <thead>
                                        <tr class="">
                                           <th style="text-align: center;">No. </th>
                                           <th style="text-align: center;">Dimensi</th>
                                           <th style="text-align: center;">Perilaku Yang Diamati</th>
                                           <th style="text-align: center;">Kode</th>
                                           <th style="text-align: center;">Jumlah Amatan</th>
                                           <th style="text-align: center;">Positif</th>
                                           <th style="text-align: center;">Negatif</th>
                                        </tr>
                                     </thead>
                                     <tbody id="tbody_rapot_pbp_2">
                                      
                                     </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="catatan_pbp_2" class="col-sm-2 control-label">Catatan Pilar 2 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_2" name="catatan_pbp_2" rows="5" class="textarea"><?= set_value('catatan_pbp_2'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <hr>
                                                 
                        <div class="form-group ">
                            <label for="id_pilar_pbp_3" class="col-sm-2 control-label">Pilar  3 
                            <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_3" id="id_pilar_pbp_3" placeholder="Pilar  3" value="3">
                                <div class="table-responsive"> 
                                  <table class="table table-bordered table-striped dataTable">
                                     <thead>
                                        <tr class="">
                                           <th colspan="7" bgcolor="#ddd7d8" style="text-align: center;">MENGHORMATI</th>
                                        </tr>
                                     </thead>
                                     <thead>
                                        <tr class="">
                                           <th style="text-align: center;">No. </th>
                                           <th style="text-align: center;">Dimensi</th>
                                           <th style="text-align: center;">Perilaku Yang Diamati</th>
                                           <th style="text-align: center;">Kode</th>
                                           <th style="text-align: center;">Jumlah Amatan</th>
                                           <th style="text-align: center;">Positif</th>
                                           <th style="text-align: center;">Negatif</th>
                                        </tr>
                                     </thead>
                                     <tbody id="tbody_rapot_pbp_3">
                                      
                                     </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="catatan_pbp_3" class="col-sm-2 control-label">Catatan Pilar 3 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_3" name="catatan_pbp_3" rows="5" class="textarea"><?= set_value('catatan_pbp_3'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <hr>
                                                 
                        <div class="form-group ">
                            <label for="id_pilar_pbp_4" class="col-sm-2 control-label">Pilar  4 
                            <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_4" id="id_pilar_pbp_4" placeholder="Pilar  4" value="4">
                                <div class="table-responsive"> 
                                  <table class="table table-bordered table-striped dataTable">
                                     <thead>
                                        <tr class="">
                                           <th colspan="7" bgcolor="#ddd7d8" style="text-align: center;">PEDULI</th>
                                        </tr>
                                     </thead>
                                     <thead>
                                        <tr class="">
                                           <th style="text-align: center;">No. </th>
                                           <th style="text-align: center;">Dimensi</th>
                                           <th style="text-align: center;">Perilaku Yang Diamati</th>
                                           <th style="text-align: center;">Kode</th>
                                           <th style="text-align: center;">Jumlah Amatan</th>
                                           <th style="text-align: center;">Positif</th>
                                           <th style="text-align: center;">Negatif</th>
                                        </tr>
                                     </thead>
                                     <tbody id="tbody_rapot_pbp_4">
                                      
                                     </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="catatan_pbp_4" class="col-sm-2 control-label">Catatan Pilar 4 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_4" name="catatan_pbp_4" rows="5" class="textarea"><?= set_value('catatan_pbp_4'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <hr>
                                                 
                        <div class="form-group ">
                            <label for="id_pilar_pbp_5" class="col-sm-2 control-label">Pilar  5 
                            <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_5" id="id_pilar_pbp_5" placeholder="Pilar  5" value="5">
                                <div class="table-responsive"> 
                                  <table class="table table-bordered table-striped dataTable">
                                     <thead>
                                        <tr class="">
                                           <th colspan="7" bgcolor="#ddd7d8" style="text-align: center;">SPORTIF</th>
                                        </tr>
                                     </thead>
                                     <thead>
                                        <tr class="">
                                           <th style="text-align: center;">No. </th>
                                           <th style="text-align: center;">Dimensi</th>
                                           <th style="text-align: center;">Perilaku Yang Diamati</th>
                                           <th style="text-align: center;">Kode</th>
                                           <th style="text-align: center;">Jumlah Amatan</th>
                                           <th style="text-align: center;">Positif</th>
                                           <th style="text-align: center;">Negatif</th>
                                        </tr>
                                     </thead>
                                     <tbody id="tbody_rapot_pbp_5">
                                      
                                     </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="catatan_pbp_5" class="col-sm-2 control-label">Catatan Pilar 5 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_5" name="catatan_pbp_5" rows="5" class="textarea"><?= set_value('catatan_pbp_5'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <hr>
                                                 
                        <div class="form-group ">
                            <label for="id_pilar_pbp_6" class="col-sm-2 control-label">Pilar  6 
                            <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id_pilar_pbp_6" id="id_pilar_pbp_6" placeholder="Pilar  6" value="6">
                                <div class="table-responsive"> 
                                  <table class="table table-bordered table-striped dataTable">
                                     <thead>
                                        <tr class="">
                                           <th colspan="7" bgcolor="#ddd7d8" style="text-align: center;">WARGA NEGARA YANG BAIK</th>
                                        </tr>
                                     </thead>
                                     <thead>
                                        <tr class="">
                                           <th style="text-align: center;">No. </th>
                                           <th style="text-align: center;">Dimensi</th>
                                           <th style="text-align: center;">Perilaku Yang Diamati</th>
                                           <th style="text-align: center;">Kode</th>
                                           <th style="text-align: center;">Jumlah Amatan</th>
                                           <th style="text-align: center;">Positif</th>
                                           <th style="text-align: center;">Negatif</th>
                                        </tr>
                                     </thead>
                                     <tbody id="tbody_rapot_pbp_6">
                                      
                                     </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="catatan_pbp_6" class="col-sm-2 control-label">Catatan Pilar 6 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="catatan_pbp_6" name="catatan_pbp_6" rows="5" class="textarea"><?= set_value('catatan_pbp_6'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group ">
                            <label for="tanggal" class="col-sm-2 control-label">Tanggal 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal"  placeholder="Tanggal" id="tanggal">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                            
                        <div class="form-group ">
                          <input type="hidden" class="form-control" name="id_guru" id="id_guru" placeholder="Wali Kelas" value="<?= $id_wali; ?>" readonly>      
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">

                            <!-- <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                              <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button> -->

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
      $('#id_siswa').change(function() {
        var id_siswa = $(this).val();
        // console.log(id_siswa);

        $.ajax({
          type: "POST",
          data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id_siswa:id_siswa},
          url : BASE_URL + "administrator/rapot_pbp/get_semester",
          success: function(respond){
            console.log(respond);
            $('#id_semester').empty();
            $('#id_semester').append(respond);
            $('#id_semester').trigger("chosen:updated");
          }
        })
      });

      $('#id_semester').change(function(){
        var id_semester = $(this).val();
        var id_siswa = $('#id_siswa').val();
        var id_pilar_pbp_1 = $('#id_pilar_pbp_1').val();
        var id_pilar_pbp_2 = $('#id_pilar_pbp_2').val();
        var id_pilar_pbp_3 = $('#id_pilar_pbp_3').val();
        var id_pilar_pbp_4 = $('#id_pilar_pbp_4').val();
        var id_pilar_pbp_5 = $('#id_pilar_pbp_5').val();
        var id_pilar_pbp_6 = $('#id_pilar_pbp_6').val();

        $.ajax({
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id_semester:id_semester, id_siswa:id_siswa, id_pilar_pbp_1:id_pilar_pbp_1},
            url : BASE_URL + "administrator/rapot_pbp/rapot_1",
            dataType: 'json',
            success: function(data1){
              console.log(data1);
              var kosong = "Tidak ada amatan.";
              var baris1='';
              var no=0;

              if (data1.length == no) {
                baris1 +=  '<tr>'+
                            '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                          '</tr>';
              } else {
                for(var i=0; i<data1.length; i++){
                  no++;
                  baris1 +=  '<tr>'+
                              '<td> <div style="width:8px;">'+no+'</div> </td>' +
                              '<td> <div style="width:200px;">'+data1[i].nama_dimensi+' </div> </td>' +
                              '<td> <div style="width:200px;">'+data1[i].isi_amatan+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data1[i].kode_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data1[i].total_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data1[i].total_positif+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data1[i].total_negatif+' </div> </td>' +
                            '</tr>';
                  
                }
              }
              
              $('#tbody_rapot_pbp_1').html(baris1);
            }
        });

        $.ajax({
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id_semester:id_semester, id_siswa:id_siswa, id_pilar_pbp_2:id_pilar_pbp_2},
            url : BASE_URL + "administrator/rapot_pbp/rapot_2",
            dataType: 'json',
            success: function(data2){
              // console.log(data2);
              var kosong = "Tidak ada amatan.";
              var baris2='';
              var no=0;

              if (data2.length == no) {
                baris2 +=  '<tr>'+
                            '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                          '</tr>';
              } else {
                for(var i=0; i<data2.length; i++){
                  no++;
                  baris2 +=  '<tr>'+
                              '<td> <div style="width:8px;">'+no+'</div> </td>' +
                              '<td> <div style="width:200px;">'+data2[i].nama_dimensi+' </div> </td>' +
                              '<td> <div style="width:200px;">'+data2[i].isi_amatan+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data2[i].kode_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data2[i].total_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data2[i].total_positif+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data2[i].total_negatif+' </div> </td>' +
                            '</tr>';
                  
                }
              }
              
              $('#tbody_rapot_pbp_2').html(baris2);
            }
        });

        $.ajax({
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id_semester:id_semester, id_siswa:id_siswa, id_pilar_pbp_3:id_pilar_pbp_3},
            url : BASE_URL + "administrator/rapot_pbp/rapot_3",
            dataType: 'json',
            success: function(data3){
              // console.log(data3);
              var kosong = "Tidak ada amatan.";
              var baris3='';
              var no=0;

              if (data3.length == no) {
                baris3 +=  '<tr>'+
                            '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                          '</tr>';
              } else {
                for(var i=0; i<data3.length; i++){
                  no++;
                  baris3 +=  '<tr>'+
                              '<td> <div style="width:8px;">'+no+'</div> </td>' +
                              '<td> <div style="width:200px;">'+data3[i].nama_dimensi+' </div> </td>' +
                              '<td> <div style="width:200px;">'+data3[i].isi_amatan+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data3[i].kode_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data3[i].total_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data3[i].total_positif+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data3[i].total_negatif+' </div> </td>' +
                            '</tr>';
                  
                }
              }
              
              $('#tbody_rapot_pbp_3').html(baris3);
            }
        });

        $.ajax({
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id_semester:id_semester, id_siswa:id_siswa, id_pilar_pbp_4:id_pilar_pbp_4},
            url : BASE_URL + "administrator/rapot_pbp/rapot_4",
            dataType: 'json',
            success: function(data4){
              // console.log(data4);
              var kosong = "Tidak ada amatan.";
              var baris4='';
              var no=0;

              if (data4.length == no) {
                baris4 +=  '<tr>'+
                            '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                          '</tr>';
              } else {
                for(var i=0; i<data4.length; i++){
                  no++;
                  baris4 +=  '<tr>'+
                              '<td> <div style="width:8px;">'+no+'</div> </td>' +
                              '<td> <div style="width:200px;">'+data4[i].nama_dimensi+' </div> </td>' +
                              '<td> <div style="width:200px;">'+data4[i].isi_amatan+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data4[i].kode_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data4[i].total_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data4[i].total_positif+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data4[i].total_negatif+' </div> </td>' +
                            '</tr>';
                  
                }
              }
              
              $('#tbody_rapot_pbp_4').html(baris4);
            }
        });

        $.ajax({
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id_semester:id_semester, id_siswa:id_siswa, id_pilar_pbp_5:id_pilar_pbp_5},
            url : BASE_URL + "administrator/rapot_pbp/rapot_5",
            dataType: 'json',
            success: function(data5){
              // console.log(data5);
              var kosong = "Tidak ada amatan.";
              var baris5='';
              var no=0;

              if (data5.length == no) {
                baris5 +=  '<tr>'+
                            '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                          '</tr>';
              } else {
                for(var i=0; i<data5.length; i++){
                  no++;
                  baris5 +=  '<tr>'+
                              '<td> <div style="width:8px;">'+no+'</div> </td>' +
                              '<td> <div style="width:200px;">'+data5[i].nama_dimensi+' </div> </td>' +
                              '<td> <div style="width:200px;">'+data5[i].isi_amatan+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data5[i].kode_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data5[i].total_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data5[i].total_positif+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data5[i].total_negatif+' </div> </td>' +
                            '</tr>';
                  
                }
              }
              
              $('#tbody_rapot_pbp_5').html(baris5);
            }
        });

        $.ajax({
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id_semester:id_semester, id_siswa:id_siswa, id_pilar_pbp_6:id_pilar_pbp_6},
            url : BASE_URL + "administrator/rapot_pbp/rapot_6",
            dataType: 'json',
            success: function(data6){
              // console.log(data6);
              var kosong = "Tidak ada amatan.";
              var baris6='';
              var no=0;

              if (data6.length == no) {
                baris6 +=  '<tr>'+
                            '<td colspan="100"> <strong>'+kosong+'</strong></td>' +
                          '</tr>';
              } else {
                for(var i=0; i<data6.length; i++){
                  no++;
                  baris6 +=  '<tr>'+
                              '<td> <div style="width:8px;">'+no+'</div> </td>' +
                              '<td> <div style="width:200px;">'+data6[i].nama_dimensi+' </div> </td>' +
                              '<td> <div style="width:200px;">'+data6[i].isi_amatan+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data6[i].kode_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data6[i].total_indikator+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data6[i].total_positif+' </div> </td>' +
                              '<td> <div style="width:10px;">'+data6[i].total_negatif+' </div> </td>' +
                            '</tr>';
                  
                }
              }
              
              $('#tbody_rapot_pbp_6').html(baris6);
            }
        });

      });
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
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
          url: BASE_URL + '/administrator/rapot_pbp/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
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