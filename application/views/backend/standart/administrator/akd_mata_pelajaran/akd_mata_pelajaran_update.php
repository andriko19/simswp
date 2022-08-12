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
        Akd Mata Pelajaran <small>Edit Akd Mata Pelajaran</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/akd_mata_pelajaran'); ?>">Akd Mata Pelajaran</a></li>
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
                            <h3 class="widget-user-username">Akd Mata Pelajaran</h3>
                            <h5 class="widget-user-desc">Edit Akd Mata Pelajaran</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/akd_mata_pelajaran/edit_save/' . $this->uri->segment(4)), [
                            'name'    => 'form_akd_mata_pelajaran',
                            'class'   => 'form-horizontal',
                            'id'      => 'form_akd_mata_pelajaran',
                            'method'  => 'POST'
                        ]); ?>

                        <div class="form-group ">
                            <label for="id_kelompok_mata_pelajaran" class="col-sm-2 control-label">Kelompok Mata Pelajaran
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_kelompok_mata_pelajaran" id="id_kelompok_mata_pelajaran" data-placeholder="Select Id Kelompok Mata Pelajaran">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('akd_kelompok_mata_pelajaran') as $row) : ?>
                                        <option <?= $row->id_kelompok_mata_pelajaran ==  $akd_mata_pelajaran->id_kelompok_mata_pelajaran ? 'selected' : ''; ?> value="<?= $row->id_kelompok_mata_pelajaran ?>"><?= $row->nama_kelompok_mata_pelajaran; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="kode_jurusan" class="col-sm-2 control-label">Jurusan
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="kode_jurusan" id="kode_jurusan" data-placeholder="Select Kode Jurusan">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_jurusan') as $row) : ?>
                                        <option <?= $row->id_kodejurusan ==  $akd_mata_pelajaran->kode_jurusan ? 'selected' : ''; ?> value="<?= $row->id_kodejurusan ?>"><?= $row->kode_jurusan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="nama_mata_pelajaran" class="col-sm-2 control-label">Nama Mata Pelajaran
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_mata_pelajaran" id="nama_mata_pelajaran" placeholder="Nama Mata Pelajaran" value="<?= set_value('nama_mata_pelajaran', $akd_mata_pelajaran->nama_mata_pelajaran); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <!-- <div class="form-group ">
                            <label for="tingkat" class="col-sm-2 control-label">Tingkat/Kelas
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="tingkat" id="tingkat" data-placeholder="Select Tingkat">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kelas') as $row) : ?>
                                        <option <?= $row->kode_kelas ==  $akd_mata_pelajaran->tingkat ? 'selected' : ''; ?> value="<?= $row->kode_kelas ?>"><?= $row->nama_kelas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div> -->


                        <div class="form-group ">
                            <label for="kompetensi_umum" class="col-sm-2 control-label">Kompetensi Umum
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kompetensi_umum" id="kompetensi_umum" placeholder="Kompetensi Umum" value="<?= set_value('kompetensi_umum', $akd_mata_pelajaran->kompetensi_umum); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kompetensi_khusus" class="col-sm-2 control-label">Kompetensi Khusus
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kompetensi_khusus" id="kompetensi_khusus" placeholder="Kompetensi Khusus" value="<?= set_value('kompetensi_khusus', $akd_mata_pelajaran->kompetensi_khusus); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="jumlah_jam" class="col-sm-2 control-label">Jumlah Jam
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jumlah_jam" id="jumlah_jam" placeholder="Jumlah Jam" value="<?= set_value('jumlah_jam', $akd_mata_pelajaran->jumlah_jam); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kode_sekolah" class="col-sm-2 control-label">Kode Sekolah
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="kode_sekolah" id="kode_sekolah" data-placeholder="Select Kode Sekolah">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('kode_sekolah') as $row) : ?>
                                        <option <?= $row->id_kodesekolah ==  $akd_mata_pelajaran->kode_sekolah ? 'selected' : ''; ?> value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <!-- 
                        <div class="form-group ">
                            <label for="urutan" class="col-sm-2 control-label">Urutan
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="urutan" id="urutan" placeholder="Urutan" value="<?= set_value('urutan', $akd_mata_pelajaran->urutan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div> -->

                        <div class="form-group ">
                            <label for="aktif" class="col-sm-2 control-label">Aktif
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="aktif" id="aktif" data-placeholder="Select Aktif">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('status_keaktifan') as $row) : ?>
                                        <option <?= $row->id_statuskeaktifan ==  $akd_mata_pelajaran->aktif ? 'selected' : ''; ?> value="<?= $row->id_statuskeaktifan ?>"><?= $row->status_keaktifan; ?></option>
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
                        window.location.href = BASE_URL + 'administrator/akd_mata_pelajaran';
                    }
                });

            return false;
        }); /*end btn cancel*/

        $('.btn_save').click(function() {
            $('.message').fadeOut();

            var form_akd_mata_pelajaran = $('#form_akd_mata_pelajaran');
            var data_post = form_akd_mata_pelajaran.serializeArray();
            var save_type = $(this).attr('data-stype');
            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                    url: form_akd_mata_pelajaran.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                })
                .done(function(res) {
                    if (res.success) {
                        var id = $('#akd_mata_pelajaran_image_galery').find('li').attr('qq-file-id');
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





    }); /*end doc ready*/
</script>