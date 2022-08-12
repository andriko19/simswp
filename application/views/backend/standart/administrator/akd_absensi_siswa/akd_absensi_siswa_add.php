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
        Absensi Siswa <small><?= cclang('new', ['Akd Absensi Siswa']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/akd_absensi_siswa'); ?>">Akd Absensi Siswa</a></li>
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
                            <h3 class="widget-user-username">Absensi Siswa</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Akd Absensi Siswa']); ?></h5>
                            <hr>
                        </div>
                        <div class="form-horizontal" name="form_akd_absensi_siswa" id="form_akd_absensi_siswa">
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Mata Pelajaran </label>

                                <div class="col-sm-8">
                                    <?= _ent($akd_jadwal_rombel->nama_mata_pelajaran); ?>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Guru Pengajar </label>

                                <div class="col-sm-8">
                                    <?= _ent($akd_jadwal_rombel->nama_guru); ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Kelas </label>

                                <div class="col-sm-8">
                                    <?= _ent($akd_jadwal_rombel->nama_rombel); ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Tanggal </label>
                                <div class="col-sm-8">
                                    <?=
                                    _ent($akd_jadwal_rombel->hari . ", " . date('d-M-Y')); ?>
                                </div>
                            </div>
                            <!-- <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Waktu Input </label>

                                <div class="col-sm-8">
                                    <?= _ent($akd_absensi_siswa->waktu_input); ?>
                                </div>
                            </div> -->

                            <br>
                            <br>

                            <!-- <div class="view-nav">
                                <?php is_allowed('akd_absensi_siswa_update', function () use ($akd_absensi_siswa) { ?>
                                    <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit akd_absensi_siswa (Ctrl+e)" href="<?= site_url('administrator/akd_absensi_siswa/edit/' . $akd_absensi_siswa->id_absensi_siswa); ?>"><i class="fa fa-edit"></i> <?= cclang('update', ['Akd Absensi Siswa']); ?> </a>
                                <?php }) ?>
                                <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/akd_absensi_siswa/'); ?>"><i class="fa fa-undo"></i> <?= cclang('go_list_button', ['Akd Absensi Siswa']); ?></a>
                            </div> -->

                        </div>
                        <?= form_open('', [
                            'name'    => 'form_add_absensi_siswa',
                            'class'   => 'form-horizontal',
                            'id'      => 'form_add_absensi_siswa',
                            'enctype' => 'multipart/form-data',
                            'method'  => 'POST'
                        ]); ?>
                        <div class="container">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr class="">
                                                <th width="5%">No.</th>
                                                <th>NIPD</th>
                                                <th>NISN</th>
                                                <th>Nama Siswa</th>
                                                <th>JK</th>
                                                <th>Kehadiran</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbody_rombel">
                                            <?php $no = 1; ?>
                                            <?php foreach ($akd_absensi_siswa as $siswa) : ?>
                                                <!-- input hidden -->

                                                <input type="hidden" name="id_akd_jadwal_pelajaran" id="id_akd_jadwal_pelajaran" value="<?= $siswa->id_jadwal_pelajaran ?>">
                                                <input type="hidden" name="id_siswa" id="id_siswa" value="<?= $siswa->id_siswa ?>">
                                                <input type="hidden" name="tanggal" id="tanggal" value="<?= date('d-M-Y'); ?>">
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= _ent($siswa->nipd); ?></td>
                                                    <td><?= _ent($siswa->nisn); ?></td>
                                                    <td><?= _ent($siswa->nama); ?></td>
                                                    <td><?php if ($siswa->id_jenis_kelamin == 1) {
                                                            echo "L";
                                                        } else {
                                                            echo "P";
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <select class="form-control" name="kehadiran" id="kehadiran">
                                                            <option value="hadir" selected>Hadir</option>
                                                            <option value="sakit">Sakit</option>
                                                            <option value="ijin">Ijin</option>
                                                            <option value="alpa">Alpa</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan">
                                                        <input type="hidden" name="waktu_input" id="waktu_input" value="<?= date('Y-m-d H:i:s') ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <!-- <?php if ($siswa_rombel == 0) : ?>
                                        <tr>
                                            <td colspan="100">
                                                Rombel data is not available
                                            </td>
                                        </tr>
                                    <?php endif; ?> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="form-group ">
                            <label for="id_jadwal_pelajaran" class="col-sm-2 control-label">Id Jadwal Pelajaran
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_jadwal_pelajaran" id="id_jadwal_pelajaran" data-placeholder="Select Id Jadwal Pelajaran">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('akd_jadwal_pelajaran') as $row) : ?>
                                        <option value="<?= $row->id_jadwal_pelajaran ?>"><?= $row->kode_jadwal; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                    <b>Input Id Jadwal Pelajaran</b> Max Length : 11.</small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="id_siswa" class="col-sm-2 control-label">Id Siswa
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_siswa" id="id_siswa" data-placeholder="Select Id Siswa">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('siswa') as $row) : ?>
                                        <option value="<?= $row->id_siswa ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                    <b>Input Id Siswa</b> Max Length : 11.</small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="kode_kehadiran" class="col-sm-2 control-label">Kode Kehadiran
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select" name="kode_kehadiran" id="kode_kehadiran" data-placeholder="Select Kode Kehadiran">
                                    <option value=""></option>
                                    <option value="1">Hadir</option>
                                    <option value="2">Ijin</option>
                                    <option value="3">Sakit</option>
                                    <option value="4">Alpa</option>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="tanggal" class="col-sm-2 control-label">Tanggal
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="tanggal" placeholder="Tanggal" id="tanggal">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div> -->


                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <!-- <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                                <i class="fa fa-save"></i> <?= cclang('save_button'); ?>
                            </button> -->
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
                        window.location.href = BASE_URL + 'administrator/akd_absensi_siswa';
                    }
                });

            return false;
        }); /*end btn cancel*/

        $('.btn_save').click(function() {
            $('.message').fadeOut();

            var form_akd_absensi_siswa = $('#form_add_absensi_siswa');
            var data_post = form_akd_absensi_siswa.serializeArray();
            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                    url: BASE_URL + '/administrator/akd_absensi_siswa/add_save_akd_absensi_siswa',
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