
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Rekapitulasi Isian Amatan <small> Rekapitulasi Amatan </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/isian_amatan'); ?>">Rekapitulasi Isian Amatan</a></li>
        <li class="active">Rekapitulasi Amatan</li>
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
                              <?php is_allowed('isi_amatan_add', function(){?>
                              <!-- <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Download Rekap Amatan" href="<?=  site_url('administrator/cetak_rekap'); ?>"><i class="fa fa-file-pdf-o" ></i> Download Rekap Amatan</a> -->
                              <?php }) ?>
                            </div>

                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Rekapitulasi Isian Amatan</h3>
                            <h5 class="widget-user-desc">Rekapitulasi Amatan</h5>
                            <hr>
                        </div>

                        <?php
                          $querySemester =  $this->db->query('SELECT *
                                            FROM semester
                                            JOIN periode ON periode.id_periode = semester.id_periode');
                          $sqlSemseter = $querySemester->result();
                        ?>
                        
                        
                        <div style="margin-top: -20px !important">
                            <div class="col-sm-2" style="padding-left: 0px !important">
                                <select class="form-control chosen chosen-select-deselect" name="id_semester" id="id_semester" data-placeholder="Pilih Semester" >
                                    <option value=""></option>
                                    <?php foreach ($sqlSemseter as $row): ?>
                                      <option value="<?= $row->id_semester ?>"><?= $row->periode ." ". $row->semester; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>

                        <a class="btn btn-flat btn-success btn_add_new" id="excel_rekap_amatan_indikator" title="Download Excel Rekap Amatan per Indikator"><i class="fa fa-file-excel-o" ></i> Download Excel per Indikator</a> ||
                        <a class="btn btn-flat btn-success btn_add_new" id="excel_rekap_amatan_pengamat" title="Download Excel Rekap Amatan per Pengamat"><i class="fa fa-file-excel-o" ></i> Download Excel per Pengamat</a> || 
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Download PDF Rekap Amatan per Indikator" href="<?=  site_url('administrator/cetak_rekap'); ?>"><i class="fa fa-file-pdf-o" ></i> Download PDF per Indikator</a> || <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Download PDF Rekap Amatan per Pengamat" href="<?=  site_url('administrator/cetak_rekap'); ?>"><i class="fa fa-file-pdf-o" ></i> Download PDF per Pengamat</a>


                        <br>
                        <!-- <div style="margin-top: 40px !important">
                            <h3><b>SEKOLAH WIJAYA PUTRA</b></h3>
                            <h4><b>Rekapitulasi per Pengamat</b></h4> 
                            <h4>Semester <b> Ganjil</b> Tahun Pelajaran <b> 2021 – 2022</b></h4>     
                        </div> -->

                        <!-- <div class="table-responsive"> 
                          <table>
                            <thead>
                                <tr class="">
                                  <th rowspan="3" style="text-align: center !important; vertical-align: middle !important">No </th>
                                  <th rowspan="3" style="text-align: center !important; vertical-align: middle !important">Nama Pengamat</th>
                                  <th colspan="6" style="text-align: center !important; vertical-align: middle !important">Siswa Yang Diamati</th>
                                  <th rowspan="3" style="text-align: center !important; vertical-align: middle !important">Jumlah</th>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center !important; vertical-align: middle !important">SMP</th>
                                    <th colspan="2" style="text-align: center !important; vertical-align: middle !important">SMA</th>
                                    <th colspan="2" style="text-align: center !important; vertical-align: middle !important">SMK</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center !important; vertical-align: middle !important">Positif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Negatif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Positif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Negatif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Positif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Negatif</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                          </table>
                        </div> -->

                        <hr>

                        <!-- <div>
                          <h3><b>SEKOLAH WIJAYA PUTRA</b></h3>
                          <h4><b>Rekapitulasi per Indikator Amatan</b></h4> 
                          <h4>Semester <b> Ganjil</b> Tahun Pelajaran <b> 2021 – 2022</b></h4>     
                        </div> -->

                        <!-- <div class="table-responsive"> 
                          <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr class="">
                                  <th rowspan="3" style="text-align: center !important; vertical-align: middle !important">No </th>
                                  <th rowspan="3" style="text-align: center !important; vertical-align: middle !important">Kode Indikator </th>
                                  <th rowspan="3" style="text-align: center !important; vertical-align: middle !important">Nama Indikator</th>
                                  <th colspan="6" style="text-align: center !important; vertical-align: middle !important">Siswa Yang Diamati</th>
                                  <th rowspan="3" style="text-align: center !important; vertical-align: middle !important">Jumlah</th>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center !important; vertical-align: middle !important">SMP</th>
                                    <th colspan="2" style="text-align: center !important; vertical-align: middle !important">SMA</th>
                                    <th colspan="2" style="text-align: center !important; vertical-align: middle !important">SMK</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center !important; vertical-align: middle !important">Positif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Negatif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Positif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Negatif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Positif</th>
                                    <th style="text-align: center !important; vertical-align: middle !important">Negatif</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $jumlah_positif_smp = 0;
                            $jumlah_negatif_smp = 0;
                            $jumlah_positif_sma = 0;
                            $jumlah_negatif_sma = 0;
                            $jumlah_positif_smk = 0;
                            $jumlah_negatif_smk = 0;
                            $total_jumlah       = 0;
                            $no = 1;
                            foreach($rekap_amatan_indikators as $rekap_amatan_indikator): ?>
                                <tr>
                                  <td><?= _ent(++$start); ?></td>
                                  <td><?= _ent($rekap_amatan_indikator->kode_indikator); ?></td>
                                  <td><?= _ent($rekap_amatan_indikator->indikator); ?></td>
                                  <td><?= number_format(_ent($rekap_amatan_indikator->positif_smp)); ?></td>  
                                  <td><?= number_format(_ent($rekap_amatan_indikator->negatif_smp)); ?></td>
                                  <td><?= number_format(_ent($rekap_amatan_indikator->positif_sma)); ?></td>
                                  <td><?= number_format(_ent($rekap_amatan_indikator->negatif_sma)); ?></td> 
                                  <td><?= number_format(_ent($rekap_amatan_indikator->positif_smk)); ?></td> 
                                  <td><?= number_format(_ent($rekap_amatan_indikator->negatif_smk)); ?></td>
                                  <td><?= number_format(_ent($rekap_amatan_indikator->positif_smp + $rekap_amatan_indikator->negatif_smp + $rekap_amatan_indikator->positif_sma + $rekap_amatan_indikator->negatif_sma + $rekap_amatan_indikator->positif_smk + $rekap_amatan_indikator->negatif_smk)); ?></td>

                                  <?php
                                    $jumlah_positif_smp += _ent($rekap_amatan_indikator->positif_smp);
                                    $jumlah_negatif_smp += _ent($rekap_amatan_indikator->negatif_smp);
                                    $jumlah_positif_sma += _ent($rekap_amatan_indikator->positif_sma);
                                    $jumlah_negatif_sma += _ent($rekap_amatan_indikator->negatif_sma);
                                    $jumlah_positif_smk += _ent($rekap_amatan_indikator->positif_smk);
                                    $jumlah_negatif_smk += _ent($rekap_amatan_indikator->negatif_smk);
                                    $total_jumlah       += $rekap_amatan_indikator->positif_smp + $rekap_amatan_indikator->negatif_smp + $rekap_amatan_indikator->positif_sma + $rekap_amatan_indikator->negatif_sma + $rekap_amatan_indikator->positif_smk + $rekap_amatan_indikator->negatif_smk;
                                  ?>
                                </tr>
                            <?php endforeach; ?>

                            <?php
                            $jumlah_positif_smp = 0;
                            $jumlah_negatif_smp = 0;
                            $jumlah_positif_sma = 0;
                            $jumlah_negatif_sma = 0;
                            $jumlah_positif_smk = 0;
                            $jumlah_negatif_smk = 0;
                            $total_jumlah       = 0;
                            $no = 1;
                            foreach($get_jumlah_rekap_amatan_indikators as $get_jumlah_rekap_amatan_indikator): ?>
                                <tr>
                                  <?php
                                    $jumlah_positif_smp += _ent($get_jumlah_rekap_amatan_indikator->positif_smp);
                                    $jumlah_negatif_smp += _ent($get_jumlah_rekap_amatan_indikator->negatif_smp);
                                    $jumlah_positif_sma += _ent($get_jumlah_rekap_amatan_indikator->positif_sma);
                                    $jumlah_negatif_sma += _ent($get_jumlah_rekap_amatan_indikator->negatif_sma);
                                    $jumlah_positif_smk += _ent($get_jumlah_rekap_amatan_indikator->positif_smk);
                                    $jumlah_negatif_smk += _ent($get_jumlah_rekap_amatan_indikator->negatif_smk);
                                    $total_jumlah       += $get_jumlah_rekap_amatan_indikator->positif_smp + $get_jumlah_rekap_amatan_indikator->negatif_smp + $get_jumlah_rekap_amatan_indikator->positif_sma + $get_jumlah_rekap_amatan_indikator->negatif_sma + $get_jumlah_rekap_amatan_indikator->positif_smk + $get_jumlah_rekap_amatan_indikator->negatif_smk;
                                  ?>
                                </tr>
                            <?php endforeach; ?>
                            
                                <tr><td colspan="10"></td></tr>
                                <tr>
                                  <td colspan=3 style="text-align: center !important; vertical-align: middle !important">Total Amatan</td>
                                  <td><?= number_format($jumlah_positif_smp)?></td>
                                  <td><?= number_format($jumlah_negatif_smp)?></td>
                                  <td><?= number_format($jumlah_positif_sma)?></td>
                                  <td><?= number_format($jumlah_negatif_sma)?></td>
                                  <td><?= number_format($jumlah_positif_smk)?></td>
                                  <td><?= number_format($jumlah_negatif_smk)?></td>
                                  <td><?= number_format($total_jumlah)?></td>
                                </tr>
                             
                             <?php if ($rekap_amatan_indikators_counts == 0) :?>
                                <tr>
                                  <td colspan="100">
                                  Isian Amatan data is not available
                                  </td>
                                </tr>
                              <?php endif; ?>
                            </tbody>
                          </table>
                          <hr>
                          
                          <div class="row">
                              <div class="col-md-8">
                                <div class="col-sm-2 padd-left-0 "></div>
                                <div class="col-sm-2 padd-left-0 "></div>
                                <div class="col-sm-3 padd-left-0 "></div>
                                <div class="col-sm-3 padd-left-0 "></div>
                                <div class="col-sm-1 padd-left-0 "></div>
                                <div class="col-sm-1 padd-left-0 "></div>
                              </div>                 
                              <div class="col-md-4">
                                <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                                    <?=$this->pagination->create_links()?>
                                </div>
                              </div>
                          </div>
                        </div> -->
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
      $('#id_semester').change(function() {
        var idSemester = $(this).val();
        console.log(idSemester);

        document.getElementById("excel_rekap_amatan_indikator").setAttribute("href", "http://43.252.156.167/simswp/administrator/isian_amatan/excel_rekap_amatan_indikator/"+idSemester);

        document.getElementById("excel_rekap_amatan_pengamat").setAttribute("href", "http://43.252.156.167/simswp/administrator/isian_amatan/excel_rekap_amatan_pengamat/"+idSemester);
      });
      // $('#example').DataTable();   
              
    }); /*end doc ready*/
</script>