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
        Akd Mata Pelajaran <small><?= cclang('new', ['Akd Mata Pelajaran']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/akd_mata_pelajaran'); ?>">Akd Mata Pelajaran</a></li>
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
                            <h3 class="widget-user-username">Akd Mata Pelajaran</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Akd Mata Pelajaran']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_akd_mata_pelajaran',
                            'class'   => 'form-horizontal',
                            'id'      => 'form_akd_mata_pelajaran',
                            'enctype' => 'multipart/form-data',
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
                                        <option value="<?= $row->id_kelompok_mata_pelajaran ?>"><?= $row->nama_kelompok_mata_pelajaran; ?></option>
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
                                        <option value="<?= $row->id_kodejurusan ?>"><?= $row->kode_jurusan; ?></option>
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
                                <input type="text" class="form-control" name="nama_mata_pelajaran" id="nama_mata_pelajaran" placeholder="Nama Mata Pelajaran" value="<?= set_value('nama_mata_pelajaran'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>




                        <div class="form-group ">
                            <label for="kompetensi_umum" class="col-sm-2 control-label">Kompetensi Umum
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kompetensi_umum" id="kompetensi_umum" placeholder="Kompetensi Umum" value="<?= set_value('kompetensi_umum'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="kompetensi_khusus" class="col-sm-2 control-label">Kompetensi Khusus
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kompetensi_khusus" id="kompetensi_khusus" placeholder="Kompetensi Khusus" value="<?= set_value('kompetensi_khusus'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="jumlah_jam" class="col-sm-2 control-label">Jumlah Jam
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jumlah_jam" id="jumlah_jam" placeholder="Jumlah Jam" value="<?= set_value('jumlah_jam'); ?>">
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
                                        <option value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="aktif" class="col-sm-2 control-label">Aktif
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="aktif" id="aktif" data-placeholder="Select Aktif">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('status_keaktifan') as $row) : ?>
                                        <option value="<?= $row->id_statuskeaktifan ?>"><?= $row->status_keaktifan; ?></option>
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
                    url: BASE_URL + '/administrator/akd_mata_pelajaran/add_save',
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                })
                .done(function(res) {
                    if (res.success) {

                        if (save_type == 'back') {
                            window.location.href = res.redirect;
                            return;
                        }

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






    }); /*end doc ready*/
</script>