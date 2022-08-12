<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo() {

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
        Siswa <small>Edit Siswa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/siswa'); ?>">Siswa</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
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
                            <h3 class="widget-user-username">Siswa</h3>
                            <h5 class="widget-user-desc">Edit Siswa</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/siswa/edit_save/' . $this->uri->segment(4)), [
                            'name'    => 'form_siswa',
                            'class'   => 'form-horizontal',
                            'id'      => 'form_siswa',
                            'method'  => 'POST'
                        ]); ?>

                        <div class="form-group ">
                            <label for="nipd" class="col-sm-2 control-label">NIPD
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nipd" id="nipd" placeholder="NIPD" value="<?= set_value('nipd', $siswa->nipd); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <!-- <div class="form-group ">
                            <label for="password" class="col-sm-2 control-label">Password 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                              <div class="input-group col-md-8 input-password">
                              <input type="password" class="form-control password" name="password" id="password" placeholder="Password" value="">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                                </span>
                              </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div> -->

                        <div class="form-group ">
                            <label for="nama" class="col-sm-2 control-label">Nama Siswa
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Siswa" value="<?= set_value('nama', $siswa->nama); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_jenis_kelamin" id="id_jenis_kelamin" data-placeholder="Select Id Jenis Kelamin">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('jenis_kelamin') as $row) : ?>
                                        <option <?= $row->id_jeniskelamin ==  $siswa->id_jenis_kelamin ? 'selected' : ''; ?> value="<?= $row->id_jeniskelamin ?>"><?= $row->jenis_kelamin; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                    <b>Input Id Jenis Kelamin</b> Max Length : 5.</small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="nisn" class="col-sm-2 control-label">NISN
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nisn" id="nisn" placeholder="NISN" value="<?= set_value('nisn', $siswa->nisn); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir', $siswa->tempat_lahir); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tanggal_lahir" class="col-sm-2 control-label">Tanggal Lahir
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="tanggal_lahir" placeholder="Tanggal Lahir" id="tanggal_lahir" value="<?= set_value('siswa_tanggal_lahir_name', $siswa->tanggal_lahir); ?>">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">NIK
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= set_value('nik', $siswa->nik); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_agama" class="col-sm-2 control-label">Agama
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_agama" id="id_agama" data-placeholder="Select Id Agama">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('agama') as $row) : ?>
                                        <option <?= $row->id_agama ==  $siswa->id_agama ? 'selected' : ''; ?> value="<?= $row->id_agama ?>"><?= $row->agama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="kebutuhan_khusus" class="col-sm-2 control-label">Kebutuhan Khusus
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="kebutuhan_khusus" id="kebutuhan_khusus" value="yes" <?= $siswa->kebutuhan_khusus == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="kebutuhan_khusus" id="kebutuhan_khusus" value="no" <?= $siswa->kebutuhan_khusus == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="alamat" class="col-sm-2 control-label">Alamat
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="alamat" name="alamat" rows="10" cols="80"> <?= set_value('alamat', $siswa->alamat); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="rt" class="col-sm-2 control-label">RT
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="rt" id="rt" placeholder="RT" value="<?= set_value('rt', $siswa->rt); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="rw" class="col-sm-2 control-label">RW
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="rw" id="rw" placeholder="RW" value="<?= set_value('rw', $siswa->rw); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="dusun" class="col-sm-2 control-label">Dusun
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="dusun" id="dusun" placeholder="Dusun" value="<?= set_value('dusun', $siswa->dusun); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kelurahan" class="col-sm-2 control-label">Desa/Kelurahan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="Desa/Kelurahan" value="<?= set_value('kelurahan', $siswa->kelurahan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kecamatan" class="col-sm-2 control-label">Kecamatan
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= set_value('kecamatan', $siswa->kecamatan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kode_pos" class="col-sm-2 control-label">Kode Pos
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_pos" id="kode_pos" placeholder="Kode Pos" value="<?= set_value('kode_pos', $siswa->kode_pos); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="jenis_tinggal" class="col-sm-2 control-label">Jenis Tinggal
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_tinggal" id="jenis_tinggal" placeholder="Jenis Tinggal" value="<?= set_value('jenis_tinggal', $siswa->jenis_tinggal); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="alat_transportasi" class="col-sm-2 control-label">Alat Transportasi
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alat_transportasi" id="alat_transportasi" placeholder="Alat Transportasi" value="<?= set_value('alat_transportasi', $siswa->alat_transportasi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="telepon" class="col-sm-2 control-label">Telepon
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?= set_value('telepon', $siswa->telepon); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="hp" class="col-sm-2 control-label">HP
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="hp" id="hp" placeholder="HP" value="<?= set_value('hp', $siswa->hp); ?>">
                                <small class="info help-block">
                                    <b>Format Hp must</b> Valid Number.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="email" class="col-sm-2 control-label">Email Aktif
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Aktif" value="<?= set_value('email', $siswa->email); ?>">
                                <small class="info help-block">
                                    <b>Format Email must</b> Valid Email.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="skhun" class="col-sm-2 control-label">SKHUN
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="skhun" id="skhun" placeholder="SKHUN" value="<?= set_value('skhun', $siswa->skhun); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="penerima_kps" class="col-sm-2 control-label">Penerima KPS
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="penerima_kps" id="penerima_kps" placeholder="Penerima KPS" value="<?= set_value('penerima_kps', $siswa->penerima_kps); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="no_kps" class="col-sm-2 control-label">No. KPS
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_kps" id="no_kps" placeholder="No. KPS" value="<?= set_value('no_kps', $siswa->no_kps); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="foto" class="col-sm-2 control-label">Foto
                            </label>
                            <div class="col-sm-8">
                                <div id="siswa_foto_galery"></div>
                                <input class="data_file data_file_uuid" name="siswa_foto_uuid" id="siswa_foto_uuid" type="hidden" value="<?= set_value('siswa_foto_uuid'); ?>">
                                <input class="data_file" name="siswa_foto_name" id="siswa_foto_name" type="hidden" value="<?= set_value('siswa_foto_name', $siswa->foto); ?>">
                                <small class="info help-block">
                                    <b>Extension file must</b> JPG, <b>Max size file</b> 1024 kb.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nama_ayah" class="col-sm-2 control-label">Nama Ayah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah" value="<?= set_value('nama_ayah', $siswa->nama_ayah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tahun_lahir_ayah" class="col-sm-2 control-label">Tahun Lahir Ayah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="tahun_lahir_ayah" id="tahun_lahir_ayah" placeholder="Tahun Lahir Ayah" value="<?= set_value('tahun_lahir_ayah', $siswa->tahun_lahir_ayah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pendidikan_ayah" class="col-sm-2 control-label">Pendidikan Ayah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pendidikan_ayah" id="pendidikan_ayah" placeholder="Pendidikan Ayah" value="<?= set_value('pendidikan_ayah', $siswa->pendidikan_ayah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pekerjaan_ayah" class="col-sm-2 control-label">Pekerjaan Ayah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="<?= set_value('pekerjaan_ayah', $siswa->pekerjaan_ayah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="penghasilan_ayah" class="col-sm-2 control-label">Penghasilan Ayah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="penghasilan_ayah" id="penghasilan_ayah" placeholder="Penghasilan Ayah" value="<?= set_value('penghasilan_ayah', $siswa->penghasilan_ayah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kebutuhan_khusus_ayah" class="col-sm-2 control-label">Kebutuhan Khusus Ayah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="kebutuhan_khusus_ayah" id="kebutuhan_khusus_ayah" value="yes" <?= $siswa->kebutuhan_khusus_ayah == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="kebutuhan_khusus_ayah" id="kebutuhan_khusus_ayah" value="no" <?= $siswa->kebutuhan_khusus_ayah == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="no_telpon_ayah" class="col-sm-2 control-label">No. Telepon Ayah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_telpon_ayah" id="no_telpon_ayah" placeholder="No. Telepon Ayah" value="<?= set_value('no_telpon_ayah', $siswa->no_telpon_ayah); ?>">
                                <small class="info help-block">
                                    <b>Format No Telpon Ayah must</b> Valid Number.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nama_ibu" class="col-sm-2 control-label">Nama Ibu
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu" value="<?= set_value('nama_ibu', $siswa->nama_ibu); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tahun_lahir_ibu" class="col-sm-2 control-label">Tahun Lahir Ibu
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="tahun_lahir_ibu" id="tahun_lahir_ibu" placeholder="Tahun Lahir Ibu" value="<?= set_value('tahun_lahir_ibu', $siswa->tahun_lahir_ibu); ?>">
                                <small class="info help-block">
                                    <b>Input Tahun Lahir Ibu</b> Max Length : 4.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pendidikan_ibu" class="col-sm-2 control-label">Pendidikan Ibu
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pendidikan_ibu" id="pendidikan_ibu" placeholder="Pendidikan Ibu" value="<?= set_value('pendidikan_ibu', $siswa->pendidikan_ibu); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pekerjaan_ibu" class="col-sm-2 control-label">Pekerjaan Ibu
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="<?= set_value('pekerjaan_ibu', $siswa->pekerjaan_ibu); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="penghasilan_ibu" class="col-sm-2 control-label">Penghasilan Ibu
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="penghasilan_ibu" id="penghasilan_ibu" placeholder="Penghasilan Ibu" value="<?= set_value('penghasilan_ibu', $siswa->penghasilan_ibu); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kebutuhan_khusus_ibu" class="col-sm-2 control-label">Kebutuhan Khusus Ibu
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="kebutuhan_khusus_ibu" id="kebutuhan_khusus_ibu" value="yes" <?= $siswa->kebutuhan_khusus_ibu == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="kebutuhan_khusus_ibu" id="kebutuhan_khusus_ibu" value="no" <?= $siswa->kebutuhan_khusus_ibu == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="no_telpon_ibu" class="col-sm-2 control-label">No. Telepon Ibu
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_telpon_ibu" id="no_telpon_ibu" placeholder="No. Telepon Ibu" value="<?= set_value('no_telpon_ibu', $siswa->no_telpon_ibu); ?>">
                                <small class="info help-block">
                                    <b>Format No Telpon Ibu must</b> Valid Number.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nama_wali" class="col-sm-2 control-label">Nama Wali
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_wali" id="nama_wali" placeholder="Nama Wali" value="<?= set_value('nama_wali', $siswa->nama_wali); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tahun_lahir_wali" class="col-sm-2 control-label">Tahun Lahir Wali
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="tahun_lahir_wali" id="tahun_lahir_wali" placeholder="Tahun Lahir Wali" value="<?= set_value('tahun_lahir_wali', $siswa->tahun_lahir_wali); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pendidikan_wali" class="col-sm-2 control-label">Pendidikan Wali
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pendidikan_wali" id="pendidikan_wali" placeholder="Pendidikan Wali" value="<?= set_value('pendidikan_wali', $siswa->pendidikan_wali); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pekerjaan_wali" class="col-sm-2 control-label">Pekerjaan Wali
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan_wali" placeholder="Pekerjaan Wali" value="<?= set_value('pekerjaan_wali', $siswa->pekerjaan_wali); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="penghasilan_wali" class="col-sm-2 control-label">Penghasilan Wali
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="penghasilan_wali" id="penghasilan_wali" placeholder="Penghasilan Wali" value="<?= set_value('penghasilan_wali', $siswa->penghasilan_wali); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="angkatan" class="col-sm-2 control-label">Angkatan/Tahun Masuk
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="angkatan" id="angkatan" placeholder="Angkatan/Tahun Masuk" value="<?= set_value('angkatan', $siswa->angkatan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="status_awal" class="col-sm-2 control-label">Status Awal
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="status_awal" id="status_awal" placeholder="Status Awal" value="<?= set_value('status_awal', $siswa->status_awal); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="status_siswa" class="col-sm-2 control-label">Status Keaktifan
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="status_siswa" id="status_siswa" data-placeholder="Select Status Siswa">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('status_keaktifan') as $row) : ?>
                                        <option <?= $row->id_statuskeaktifan ==  $siswa->status_siswa ? 'selected' : ''; ?> value="<?= $row->id_statuskeaktifan ?>"><?= $row->status_keaktifan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="tingkat" class="col-sm-2 control-label">Tingkat
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select" name="tingkat" id="tingkat" data-placeholder="Select Tingkat">
                                    <option value=""></option>
                                    <option <?= $siswa->tingkat == "7" ? 'selected' : ''; ?> value="7">VII</option>
                                    <option <?= $siswa->tingkat == "8" ? 'selected' : ''; ?> value="8">VIII</option>
                                    <option <?= $siswa->tingkat == "9" ? 'selected' : ''; ?> value="9">IX</option>
                                    <option <?= $siswa->tingkat == "10" ? 'selected' : ''; ?> value="10">X SMA</option>
                                    <option <?= $siswa->tingkat == "11" ? 'selected' : ''; ?> value="11">XI SMA</option>
                                    <option <?= $siswa->tingkat == "12" ? 'selected' : ''; ?> value="12">XII SMA</option>
                                    <option <?= $siswa->tingkat == "10K" ? 'selected' : ''; ?> value="10K">X SMK</option>
                                    <option <?= $siswa->tingkat == "11K" ? 'selected' : ''; ?> value="11K">XI SMK</option>
                                    <option <?= $siswa->tingkat == "12K" ? 'selected' : ''; ?> value="12K">XII SMK</option>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <!-- <div class="form-group ">
                            <label for="kode_kelas" class="col-sm-2 control-label">Kelas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kode_kelas" id="kode_kelas" data-placeholder="Select Kode Kelas" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kelas') as $row) : ?>
                                    <option <?= $row->kode_kelas ==  $siswa->kode_kelas ? 'selected' : ''; ?> value="<?= $row->kode_kelas ?>"><?= $row->nama_kelas; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div> -->


                        <div class="form-group ">
                            <label for="kode_jurusan" class="col-sm-2 control-label">Jurusan
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="kode_jurusan" id="kode_jurusan" data-placeholder="Select Kode Jurusan">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_jurusan') as $row) : ?>
                                        <option <?= $row->id_kodejurusan ==  $siswa->kode_jurusan ? 'selected' : ''; ?> value="<?= $row->id_kodejurusan ?>"><?= $row->kode_jurusan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="id_sesi" class="col-sm-2 control-label">Sesi
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="id_sesi" id="id_sesi" placeholder="Sesi" value="<?= set_value('id_sesi', $siswa->id_sesi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kode_sekolah" class="col-sm-2 control-label">Home Base Sekolah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="kode_sekolah" id="kode_sekolah" data-placeholder="Select Kode Sekolah">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_sekolah') as $row) : ?>
                                        <option <?= $row->id_kodesekolah ==  $siswa->id_sekolah ? 'selected' : ''; ?> value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                                <i class="fa fa-save"></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                                <i class="ion ion-ios-list-outline"></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                                <i class="fa fa-undo"></i> <?= cclang('cancel_button'); ?>
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
    $(document).ready(function() {

        CKEDITOR.replace('alamat');
        var alamat = CKEDITOR.instances.alamat;

        $('#btn_cancel').click(function() {
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
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = BASE_URL + 'administrator/siswa';
                    }
                });

            return false;
        }); /*end btn cancel*/

        $('.btn_save').click(function() {
            $('.message').fadeOut();
            $('#alamat').val(alamat.getData());

            var form_siswa = $('#form_siswa');
            var data_post = form_siswa.serializeArray();
            var save_type = $(this).attr('data-stype');
            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                    url: form_siswa.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                })
                .done(function(res) {
                    if (res.success) {
                        var id = $('#siswa_image_galery').find('li').attr('qq-file-id');
                        if (save_type == 'back') {
                            window.location.href = res.redirect;
                            return;
                        }

                        $('.message').printMessage({
                            message: res.message
                        });
                        $('.message').fadeIn();
                        $('.data_file_uuid').val('');

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

        var params = {};
        params[csrf] = token;

        $('#siswa_foto_galery').fineUploader({
            template: 'qq-template-gallery',
            request: {
                endpoint: BASE_URL + '/administrator/siswa/upload_foto_file',
                params: params
            },
            deleteFile: {
                enabled: true, // defaults to false
                endpoint: BASE_URL + '/administrator/siswa/delete_foto_file'
            },
            thumbnails: {
                placeholders: {
                    waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                    notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
                }
            },
            session: {
                endpoint: BASE_URL + 'administrator/siswa/get_foto_file/<?= $siswa->id_siswa; ?>',
                refreshOnRequest: true
            },
            multiple: false,
            validation: {
                allowedExtensions: ["jpg"],
                sizeLimit: 1048576,
            },
            showMessage: function(msg) {
                toastr['error'](msg);
            },
            callbacks: {
                onComplete: function(id, name, xhr) {
                    if (xhr.success) {
                        var uuid = $('#siswa_foto_galery').fineUploader('getUuid', id);
                        $('#siswa_foto_uuid').val(uuid);
                        $('#siswa_foto_name').val(xhr.uploadName);
                    } else {
                        toastr['error'](xhr.error);
                    }
                },
                onSubmit: function(id, name) {
                    var uuid = $('#siswa_foto_uuid').val();
                    $.get(BASE_URL + '/administrator/siswa/delete_foto_file/' + uuid);
                },
                onDeleteComplete: function(id, xhr, isError) {
                    if (isError == false) {
                        $('#siswa_foto_uuid').val('');
                        $('#siswa_foto_name').val('');
                    }
                }
            }
        }); /*end foto galey*/




    }); /*end doc ready*/
</script>