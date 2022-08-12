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
        Guru <small><?= cclang('new', ['Guru']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/guru'); ?>">Guru</a></li>
        <li class="active"><?= cclang('new'); ?></li>
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
                            <h3 class="widget-user-username">Guru</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Guru']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_guru',
                            'class'   => 'form-horizontal',
                            'id'      => 'form_guru',
                            'enctype' => 'multipart/form-data',
                            'method'  => 'POST'
                        ]); ?>

                        <div class="form-group ">
                            <label for="nip" class="col-sm-2 control-label">NIP
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?= set_value('nip'); ?>">
                                <small class="info help-block">
                                    <b>Input Nip</b> Max Length : 100.</small>
                            </div>
                        </div>

                        <!-- <div class="form-group ">
                            <label for="password" class="col-sm-2 control-label">Password
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group col-md-8 input-password"> -->
                        <!-- <input type="hidden" class="form-control password" name="password" id="password" placeholder="Password" value=""> -->
                        <!-- <span class="input-group-btn">
                                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                                    </span>
                                </div>
                                <small class="info help-block">
                                    <b>Input Password</b> Max Length : 255.</small>
                            </div>
                        </div> -->

                        <div class="form-group ">
                            <label for="nama_guru" class="col-sm-2 control-label">Nama Guru
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Nama Guru" value="<?= set_value('nama_guru'); ?>">
                                <small class="info help-block">
                                    <b>Input Nama Guru</b> Max Length : 150.</small>
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
                                        <option value="<?= $row->id_jeniskelamin ?>"><?= $row->jenis_kelamin; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir'); ?>">
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
                                    <input type="text" class="form-control pull-right datepicker" name="tanggal_lahir" placeholder="Tanggal Lahir" id="tanggal_lahir">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nik" class="col-sm-2 control-label">NIK
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= set_value('nik'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="niy_nigk" class="col-sm-2 control-label">NIY NIGK
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="niy_nigk" id="niy_nigk" placeholder="NIY NIGK" value="<?= set_value('niy_nigk'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nuptk" class="col-sm-2 control-label">NUPTK
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nuptk" id="nuptk" placeholder="NUPTK" value="<?= set_value('nuptk'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_status_kepegawaian" class="col-sm-2 control-label">Status Kepegawaian
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_status_kepegawaian" id="id_status_kepegawaian" data-placeholder="Select Id Status Kepegawaian">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('status_kepegawaian') as $row) : ?>
                                        <option value="<?= $row->id_statuskepegawaian ?>"><?= $row->status_kepegawaian; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="id_jenis_ptk" class="col-sm-2 control-label">Jenis PTK
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_jenis_ptk" id="id_jenis_ptk" data-placeholder="Select Id Jenis Ptk">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('jenis_ptk') as $row) : ?>
                                        <option value="<?= $row->id_jenisptk ?>"><?= $row->jenis_ptk; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="pengawas_bidang_studi" class="col-sm-2 control-label">Pengawas Bidang Studi
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pengawas_bidang_studi" id="pengawas_bidang_studi" placeholder="Pengawas Bidang Studi" value="<?= set_value('pengawas_bidang_studi'); ?>">
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
                                        <option value="<?= $row->id_agama ?>"><?= $row->agama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="alamat_jalan" class="col-sm-2 control-label">Alamat
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="alamat_jalan" id="alamat_jalan" placeholder="Alamat" value="<?= set_value('alamat_jalan'); ?>">
                                <small class="info help-block">
                                    <b>Input Alamat Jalan</b> Max Length : 255.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="rt" class="col-sm-2 control-label">RT
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="rt" id="rt" placeholder="RT" value="<?= set_value('rt'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="rw" class="col-sm-2 control-label">RW
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="rw" id="rw" placeholder="RW" value="<?= set_value('rw'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nama_dusun" class="col-sm-2 control-label">Dusun
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_dusun" id="nama_dusun" placeholder="Dusun" value="<?= set_value('nama_dusun'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="desa_kelurahan" class="col-sm-2 control-label">Desa/Kelurahan
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="desa_kelurahan" id="desa_kelurahan" placeholder="Desa/Kelurahan" value="<?= set_value('desa_kelurahan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kecamatan" class="col-sm-2 control-label">Kecamatan
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= set_value('kecamatan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kode_pos" class="col-sm-2 control-label">Kode POS
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_pos" id="kode_pos" placeholder="Kode POS" value="<?= set_value('kode_pos'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="telepon" class="col-sm-2 control-label">Telepon
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?= set_value('telepon'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="hp" class="col-sm-2 control-label">HP
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="hp" id="hp" placeholder="HP" value="<?= set_value('hp'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="email" class="col-sm-2 control-label">Email
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                <small class="info help-block">
                                    <b>Format Email must</b> Valid Email.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tugas_tambahan" class="col-sm-2 control-label">Tugas Tambahan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tugas_tambahan" id="tugas_tambahan" placeholder="Tugas Tambahan" value="<?= set_value('tugas_tambahan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_status_keaktifan" class="col-sm-2 control-label">Status Keaktifan
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_status_keaktifan" id="id_status_keaktifan" data-placeholder="Select Id Status Keaktifan">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('status_keaktifan') as $row) : ?>
                                        <option value="<?= $row->id_statuskeaktifan ?>"><?= $row->status_keaktifan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                    <b>Input Id Status Keaktifan</b> Max Length : 5.</small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="sk_cpns" class="col-sm-2 control-label">SK CPNS
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="sk_cpns" id="sk_cpns" placeholder="SK CPNS" value="<?= set_value('sk_cpns'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tanggal_cpns" class="col-sm-2 control-label">Tanggal CPNS
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="tanggal_cpns" placeholder="Tanggal CPNS" id="tanggal_cpns">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="sk_pengangkatan" class="col-sm-2 control-label">SK Pengangkatan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="sk_pengangkatan" id="sk_pengangkatan" placeholder="SK Pengangkatan" value="<?= set_value('sk_pengangkatan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tmt_pengangkatan" class="col-sm-2 control-label">TMT Pengangkatan
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="tmt_pengangkatan" placeholder="TMT Pengangkatan" id="tmt_pengangkatan">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="lembaga_pengangkatan" class="col-sm-2 control-label">Lembaga Pengangkatan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lembaga_pengangkatan" id="lembaga_pengangkatan" placeholder="Lembaga Pengangkatan" value="<?= set_value('lembaga_pengangkatan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_golongan" class="col-sm-2 control-label">Golongan
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_golongan" id="id_golongan" data-placeholder="Select Id Golongan">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('golongan') as $row) : ?>
                                        <option value="<?= $row->id_golongan ?>"><?= $row->golongan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                    <b>Input Id Golongan</b> Max Length : 5.</small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="keahlian_laboratorium" class="col-sm-2 control-label">Keahlian Laboratorium
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="keahlian_laboratorium" id="keahlian_laboratorium" value="yes">
                                        <?= cclang('yes'); ?>
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="keahlian_laboratorium" id="keahlian_laboratorium" value="no">
                                        <?= cclang('no'); ?>
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="sumber_gaji" class="col-sm-2 control-label">Sumber Gaji
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="sumber_gaji" id="sumber_gaji" placeholder="Sumber Gaji" value="<?= set_value('sumber_gaji'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nama_ibu_kandung" class="col-sm-2 control-label">Nama Ibu Kandung
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ibu_kandung" id="nama_ibu_kandung" placeholder="Nama Ibu Kandung" value="<?= set_value('nama_ibu_kandung'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_status_pernikahan" class="col-sm-2 control-label">Status Pernikahan
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select" name="id_status_pernikahan" id="id_status_pernikahan" data-placeholder="Select Id Status Pernikahan">
                                    <option value=""></option>
                                    <option value="Lajang">Lajang</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Cerai">Cerai</option>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nama_suami_istri" class="col-sm-2 control-label">Nama Suami/Istri
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_suami_istri" id="nama_suami_istri" placeholder="Nama Suami/Istri" value="<?= set_value('nama_suami_istri'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nip_suami_istri" class="col-sm-2 control-label">NIP Suami/Istri
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nip_suami_istri" id="nip_suami_istri" placeholder="NIP Suami/Istri" value="<?= set_value('nip_suami_istri'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pekerjaan_suami_istri" class="col-sm-2 control-label">Pekerjaan Suami/Istri
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pekerjaan_suami_istri" id="pekerjaan_suami_istri" placeholder="Pekerjaan Suami/Istri" value="<?= set_value('pekerjaan_suami_istri'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tmt_pns" class="col-sm-2 control-label">TMT PNS
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="tmt_pns" placeholder="TMT PNS" id="tmt_pns">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="lisensi_kepsek" class="col-sm-2 control-label">Lisensi Kepsek
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lisensi_kepsek" id="lisensi_kepsek" placeholder="Lisensi Kepsek" value="<?= set_value('lisensi_kepsek'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="jumlah_sekolah_binaan" class="col-sm-2 control-label">Jumlah Sekolah Binaan
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jumlah_sekolah_binaan" id="jumlah_sekolah_binaan" placeholder="Jumlah Sekolah Binaan" value="<?= set_value('jumlah_sekolah_binaan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="diklat_kepengawasan" class="col-sm-2 control-label">Diklat Kepengawasan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="diklat_kepengawasan" id="diklat_kepengawasan" placeholder="Diklat Kepengawasan" value="<?= set_value('diklat_kepengawasan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="mampu_handle_kk" class="col-sm-2 control-label">Mampu Handle KK
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mampu_handle_kk" id="mampu_handle_kk" placeholder="Mampu Handle KK" value="<?= set_value('mampu_handle_kk'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="keahlian_breile" class="col-sm-2 control-label">Keahlian Braille
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="keahlian_breile" id="keahlian_breile" value="yes">
                                        <?= cclang('yes'); ?>
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="keahlian_breile" id="keahlian_breile" value="no">
                                        <?= cclang('no'); ?>
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="keahlian_bahasa_isyarat" class="col-sm-2 control-label">Keahlian Bahasa Isyarat
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="keahlian_bahasa_isyarat" id="keahlian_bahasa_isyarat" value="yes">
                                        <?= cclang('yes'); ?>
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="keahlian_bahasa_isyarat" id="keahlian_bahasa_isyarat" value="no">
                                        <?= cclang('no'); ?>
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="npwp" class="col-sm-2 control-label">NPWP
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="npwp" id="npwp" placeholder="NPWP" value="<?= set_value('npwp'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kewarganegaraan" class="col-sm-2 control-label">Kewarganegaraan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kewarganegaraan" id="kewarganegaraan" placeholder="Kewarganegaraan" value="<?= set_value('kewarganegaraan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="foto" class="col-sm-2 control-label">Foto
                            </label>
                            <div class="col-sm-8">
                                <div id="guru_foto_galery"></div>
                                <input class="data_file" name="guru_foto_uuid" id="guru_foto_uuid" type="hidden" value="<?= set_value('guru_foto_uuid'); ?>">
                                <input class="data_file" name="guru_foto_name" id="guru_foto_name" type="hidden" value="<?= set_value('guru_foto_name'); ?>">
                                <small class="info help-block">
                                    <b>Extension file must</b> JPG, <b>Max size file</b> 1024 kb.</small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="id_sekolah" class="col-sm-2 control-label">Home Base Sekolah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_sekolah" id="id_sekolah" data-placeholder="Select Kode Sekolah">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_sekolah') as $row) : ?>
                                        <option value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
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
<!-- Page script -->
<script>
    $(document).ready(function() {

        $('#btn_cancel').click(function() {
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
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = BASE_URL + 'administrator/guru';
                    }
                });

            return false;
        }); /*end btn cancel*/

        $('.btn_save').click(function() {
            $('.message').fadeOut();

            var form_guru = $('#form_guru');
            var data_post = form_guru.serializeArray();
            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                    url: BASE_URL + '/administrator/guru/add_save',
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                })
                .done(function(res) {
                    if (res.success) {
                        var id_foto = $('#guru_foto_galery').find('li').attr('qq-file-id');

                        if (save_type == 'back') {
                            window.location.href = res.redirect;
                            return;
                        }

                        $('.message').printMessage({
                            message: res.message
                        });
                        $('.message').fadeIn();
                        resetForm();
                        if (typeof id_foto !== 'undefined') {
                            $('#guru_foto_galery').fineUploader('deleteFile', id_foto);
                        }
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

        var params = {};
        params[csrf] = token;

        $('#guru_foto_galery').fineUploader({
            template: 'qq-template-gallery',
            request: {
                endpoint: BASE_URL + '/administrator/guru/upload_foto_file',
                params: params
            },
            deleteFile: {
                enabled: true,
                endpoint: BASE_URL + '/administrator/guru/delete_foto_file',
            },
            thumbnails: {
                placeholders: {
                    waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                    notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
                }
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
                        var uuid = $('#guru_foto_galery').fineUploader('getUuid', id);
                        $('#guru_foto_uuid').val(uuid);
                        $('#guru_foto_name').val(xhr.uploadName);
                    } else {
                        toastr['error'](xhr.error);
                    }
                },
                onSubmit: function(id, name) {
                    var uuid = $('#guru_foto_uuid').val();
                    $.get(BASE_URL + '/administrator/guru/delete_foto_file/' + uuid);
                },
                onDeleteComplete: function(id, xhr, isError) {
                    if (isError == false) {
                        $('#guru_foto_uuid').val('');
                        $('#guru_foto_name').val('');
                    }
                }
            }
        }); /*end foto galery*/





    }); /*end doc ready*/
</script>