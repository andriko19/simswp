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
        Akd Jadwal Pelajaran <small><?= cclang('new', ['Akd Jadwal Pelajaran']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/akd_jadwal_pelajaran'); ?>">Akd Jadwal Pelajaran</a></li>
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
                            <h3 class="widget-user-username">Jadwal Pelajaran</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Akd Jadwal Pelajaran']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_akd_jadwal_pelajaran',
                            'class'   => 'form-horizontal',
                            'id'      => 'form_akd_jadwal_pelajaran',
                            'enctype' => 'multipart/form-data',
                            'method'  => 'POST'
                        ]); ?>

                        <div class="form-group ">
                            <label for="tahun_ajaran" class="col-sm-2 control-label">Tahun Ajaran/Semester
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="tahun_ajaran" id="tahun_ajaran" data-placeholder="Select Tahun Ajaran">

                                    <?php $querySemester =  $this->db->query('SELECT *
                                                      FROM semester
                                                      JOIN periode ON periode.id_periode = semester.id_periode');
                                    $sql = $querySemester->result(); ?>
                                    <option value=""></option>
                                    <?php foreach ($sql as $row) : ?>
                                        <option value="<?= $row->id_semester ?>"><?= $row->periode . ' ' . $row->semester; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <?php $a = $this->session->groups; ?>

                        <div class="form-group ">
                            <label for="kode_jadwal" class="col-sm-2 control-label">Kode Guru Pengajar
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_jadwal" id="kode_jadwal" placeholder="Kode Guru Pengajar" value="<?= set_value('kode_jadwal'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="rombel" class="col-sm-2 control-label">Rombongan Belajar
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="rombel" id="rombel" data-placeholder="Select Rombel">
                                    <option value=""></option>

                                    <?php if ($a == 1) { ?>
                                        <?php foreach (db_get_all_data('rombel') as $row) : ?>
                                            <option value="<?= $row->id_rombel ?>"><?= $row->nama_rombel; ?></option>
                                        <?php endforeach;  ?>
                                    <?php } else if ($a == 16) { ?>
                                        <?php $query = $this->db->query("select * from rombel where kode_sekolah=3");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_rombel ?>"><?= $row->nama_rombel; ?></option>
                                        <?php endforeach;
                                        ?>
                                    <?php } else if ($a == 15) { ?>
                                        <?php $query = $this->db->query("select * from rombel where kode_sekolah=2");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_rombel ?>"><?= $row->nama_rombel; ?></option>
                                        <?php endforeach;
                                        ?>
                                    <?php } else if ($a == 14) { ?>
                                        <?php $query = $this->db->query("select * from rombel where kode_sekolah=1");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_rombel ?>"><?= $row->nama_rombel; ?></option>
                                    <?php endforeach;
                                    } ?>

                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="id_pelajaran" class="col-sm-2 control-label">Mata Pelajaran
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="id_pelajaran" id="id_pelajaran" data-placeholder="Select Id Pelajaran">
                                    <option value=""></option>
                                    <?php
                                    if ($a == 1) { ?>
                                        <?php foreach (db_get_all_data('akd_mata_pelajaran') as $row) : ?>
                                            <option value="<?= $row->id_pelajaran ?>"><?= $row->nama_mata_pelajaran; ?></option>
                                        <?php endforeach; ?>
                                        <?php } else if ($a == 16) {
                                        $query = $this->db->query("select * from akd_mata_pelajaran where kode_sekolah=3");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_pelajaran ?>"><?= $row->nama_mata_pelajaran ?></option>
                                        <?php endforeach; ?>
                                        <?php } else if ($a == 15) {
                                        $query = $this->db->query("select * from akd_mata_pelajaran where kode_sekolah=2");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_pelajaran ?>"><?= $row->nama_mata_pelajaran ?></option>
                                        <?php endforeach; ?>
                                        <?php } else if ($a == 14) {
                                        $query = $this->db->query("select * from akd_mata_pelajaran where kode_sekolah=1");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_pelajaran ?>"><?= $row->nama_mata_pelajaran ?></option>
                                    <?php endforeach;
                                    } ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="ruangan" class="col-sm-2 control-label">Ruangan
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="ruangan" id="ruangan" data-placeholder="Select Ruangan">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('ruangan') as $row) : ?>
                                        <option value="<?= $row->kode_ruangan ?>"><?= $row->nama_ruangan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="guru_pengajar" class="col-sm-2 control-label">Guru Pengajar
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="guru_pengajar" id="guru_pengajar" data-placeholder="Select Guru Pengajar">
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('guru') as $row) : ?>
                                        <option value="<?= $row->id_guru ?>"><?= $row->nama_guru; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <!-- <div class="form-group ">
                            <label for="paralel" class="col-sm-2 control-label">Paralel
                            </label>
                            <div class="col-sm-8"> -->
                        <input type="hidden" class="form-control" name="paralel" id="paralel" placeholder="Paralel" value="<?= set_value('paralel'); ?>">
                        <!-- <small class="info help-block">
                                </small>
                            </div>
                        </div> -->

                        <!-- <div class="form-group ">
                            <label for="jadwal_serial" class="col-sm-2 control-label">Jadwal Serial
                            </label>
                            <div class="col-sm-8"> -->
                        <input type="hidden" class="form-control" name="jadwal_serial" id="jadwal_serial" placeholder="Jadwal Serial" value="<?= set_value('jadwal_serial'); ?>">
                        <!-- <small class="info help-block">
                                </small>
                            </div>
                        </div> -->

                        <div class="form-group ">
                            <label for="rentang_jam_pelajaran" class="col-sm-2 control-label">Mulai Jam Ke
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="start" id="start" data-placeholder="Start">
                                    <option value=""></option>
                                    <?php if ($a == 1) { ?>
                                        <?php foreach (db_get_all_data('akd_jadwal_jam_ke') as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                    <?php if ($a == 16) { ?>
                                        <?php $query = $this->db->query("select * from akd_jadwal_jam_ke where kode_sekolah=3");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                    <?php if ($a == 15) { ?>
                                        <?php $query = $this->db->query("select * from akd_jadwal_jam_ke where kode_sekolah=2");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                    <?php if ($a == 14) { ?>
                                        <?php $query = $this->db->query("select * from akd_jadwal_jam_ke where kode_sekolah=1");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="rentang_jam_pelajaran" class="col-sm-2 control-label">Berakhir Jam Ke
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="end" id="end" data-placeholder="End">
                                    <option value=""></option>
                                    <?php if ($a == 1) { ?>
                                        <?php foreach (db_get_all_data('akd_jadwal_jam_ke') as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                    <?php if ($a == 16) { ?>
                                        <?php $query = $this->db->query("select * from akd_jadwal_jam_ke where kode_sekolah=3");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                    <?php if ($a == 15) { ?>
                                        <?php $query = $this->db->query("select * from akd_jadwal_jam_ke where kode_sekolah=2");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                    <?php if ($a == 14) { ?>
                                        <?php $query = $this->db->query("select * from akd_jadwal_jam_ke where kode_sekolah=1");
                                        $sql = $query->result();
                                        foreach ($sql as $row) : ?>
                                            <option value="<?= $row->id_jam_ke ?>"><?= $row->jam_ke; ?></option>
                                    <?php endforeach;
                                    } ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="hari" class="col-sm-2 control-label">Hari
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select" name="hari" id="hari" data-placeholder="Select Hari">
                                    <option value=""></option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
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
                                    <?php if ($a == 1) { ?>
                                        <?php foreach (db_get_all_data('kode_sekolah') as $row) : ?>
                                            <option value="<?= $row->id_kodesekolah ?>"><?= $row->kode_sekolah; ?></option>
                                        <?php endforeach; ?>
                                    <?php } else if ($a == 16) { ?>
                                        <option selected value="3">SMK</option>
                                    <?php } else if ($a == 15) { ?>
                                        <option selected value="2">SMA</option>
                                    <?php } else if ($a == 14) { ?>
                                        <option selected value="1">SMP</option>
                                    <?php } ?>
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
                        window.location.href = BASE_URL + 'administrator/akd_jadwal_pelajaran';
                    }
                });

            return false;
        }); /*end btn cancel*/

        $('.btn_save').click(function() {
            $('.message').fadeOut();

            var form_akd_jadwal_pelajaran = $('#form_akd_jadwal_pelajaran');
            var data_post = form_akd_jadwal_pelajaran.serializeArray();
            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                    url: BASE_URL + '/administrator/akd_jadwal_pelajaran/add_save',
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