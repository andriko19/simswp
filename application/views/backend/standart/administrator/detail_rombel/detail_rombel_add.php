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
        Detail Rombel <small><?= cclang('new', ['Detail Rombel']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/detail_rombel'); ?>">Detail Rombel</a></li>
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
                            <h3 class="widget-user-username">Detail Rombel</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Detail Rombel']); ?></h5>
                            <hr>
                            <div class="form-horizontal">

                                <div class="form-group ">
                                    <label for="content" class="col-sm-2 control-label">Periode </label>
                                    <div class="col-sm-8">
                                        <?php if ($detail_rombel == NULL) {
                                            echo $rombel->periode;
                                        } else {
                                            echo $detail_rombel->periode;
                                        } ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="content" class="col-sm-2 control-label">Nama Rombel </label>

                                    <div class="col-sm-8">
                                        <?php if ($detail_rombel == NULL) {
                                            echo $rombel->nama_rombel;
                                        } else {
                                            echo $detail_rombel->nama_rombel;
                                        } ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="content" class="col-sm-2 control-label">Wali Kelas</label>
                                    <div class="col-sm-8">
                                        <?php if ($detail_rombel == NULL) {
                                            echo $rombel->wali_kelas;
                                        } else {
                                            echo $detail_rombel->nama_guru;
                                        } ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="content" class="col-sm-2 control-label">Jumlah Siswa </label>
                                    <div class="col-sm-8">
                                        <?= _ent($count_siswa_rombel); ?>
                                    </div>
                                </div>
                                <!-- table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr class="">
                                                <th width="5%">No.</th>
                                                <th>NIPD</th>
                                                <th>NISN</th>
                                                <th>Nama Siswa</th>
                                                <th>JK</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_rombel">
                                            <?php $no = 1; ?>
                                            <?php foreach ($siswa_rombel as $siswa) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= _ent($siswa->nipd); ?></td>
                                                    <td><?= _ent($siswa->nisn); ?></td>
                                                    <td><?= _ent($siswa->nama_siswa); ?></td>
                                                    <td><?php if ($siswa->id_jenis_kelamin == 1) {
                                                            echo "L";
                                                        } else {
                                                            echo "P";
                                                        }
                                                        ?></td>
                                                    <td width="200">
                                                        <?php ?>
                                                        <a href="<?= site_url('administrator/detail_rombel/delete/' . $siswa->id_detail_rombel); ?>" data-href="" class="label-default remove-data"><i class="fa fa-close"></i> Delete</a>
                                                        <?php  ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if ($siswa_rombel == 0) : ?>
                                                <tr>
                                                    <td colspan="100">
                                                        Rombel data is not available
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- tutup table -->
                            <div class="view-nav">
                            </div>
                        </div>
                    </div>

                    <?= form_open('', [
                        'name'    => 'form_detail_rombel',
                        'class'   => 'form-horizontal',
                        'id'      => 'form_detail_rombel',
                        'enctype' => 'multipart/form-data',
                        'method'  => 'POST'
                    ]); ?>

                    <!-- <div class="form-group "> -->
                    <!-- <label for="a" class="col-sm-2 control-label">A
                <i class="required">*</i>
              </label> -->
                    <!-- <div class="col-sm-8"> -->
                    <input type="hidden" class="form-control" name="a" id="a" placeholder="A" value="<?= set_value('a'); ?>">
                    <!-- <small class="info help-block"> -->
                    <!-- <b>Input A</b> Max Length : 11.</small> -->
                    <!-- </div> -->
                    <!-- </div> -->

                    <!-- <div class="form-group ">
              <label for="id_rombel" class="col-sm-2 control-label">Nama Rombel
                <i class="required">*</i>
              </label>
              <div class="col-sm-8"> -->
                    <input type="hidden" class="form-control" name="id_rombel" id="id_rombel" value="<?= $rombel->id_rombel ?>">
                    <input type="hidden" class="form-control" name="sekolah" id="sekolah" value="<?= $rombel->kode_sekolah ?>">
                    <!-- <small class="info help-block">
                </small>
              </div>
            </div> -->

                    <div class="form-group ">
                        <label for="id_siswa" class="col-sm-2 control-label">Tambah Siswa
                            <i class="required">*</i>
                        </label>
                        <div class="col-sm-8">
                            <select class="form-control chosen chosen-select-deselect" name="id_siswa" id="id_siswa" data-placeholder="Pilih Siswa">
                                <option value=""></option>
                                <?php foreach (db_get_all_data('siswa') as $row) : ?>
                                    <option value="<?= $row->id_siswa ?>"><?= $row->nipd . ' / ' . $row->nama; ?></option>
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
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/rombel'); ?>"><i class="fa fa-undo"></i> Kembali</a>
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
        $('#sekolah').change(function() {
            var val_sekolah = $(this).val();
            console.log(val_sekolah);

            if (val_sekolah > 0) {
                $.ajax({
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        modul: 'sekolah',
                        id: val_sekolah
                    },
                    url: BASE_URL + "administrator/detail_rombel/data_siswa",
                    success: function(respond) {
                        console.log(respond);
                        $('#id_siswa').empty();
                        $('#id_siswa').append(respond);
                        $('#id_siswa').trigger("chosen:updated");
                    }
                });
            }
        });

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
                        window.location.href = BASE_URL + 'administrator/detail_rombel';
                    }
                });

            return false;
        }); /*end btn cancel*/

        $('.btn_save').click(function() {
            $('.message').fadeOut();

            var form_detail_rombel = $('#form_detail_rombel');
            var data_post = form_detail_rombel.serializeArray();
            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                    url: BASE_URL + '/administrator/detail_rombel/add_save',
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                })
                .done(function(res) {
                    if (res.success) {


                        window.location.reload();
                        return;


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