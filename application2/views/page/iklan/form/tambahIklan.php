<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Iklan</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Iklan</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="pesan"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form id="submit">
                <input type="hidden" name="idProfile" value="<?= $this->input->get("id"); ?>">
                <fieldset>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Jenis Barang:</label>
                            <select data-placeholder="Pilih Sekolah" class="form-control form-control-select2" data-fouc name="jenisBarang">
                                <?php $queryGroup = $this->db->query("SELECT *FROM ref_jenis_barang")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['jns_brg_kd'] ?>"><?php echo $group['jns_brg_nm'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Judul Iklan:</label>
                            <input type="text" name="iklanJudul" class="form-control" placeholder="Judul Iklan">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deskripsi Iklan:</label>
                            <textarea name="iklanDeskripsi" id="ckeditor" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tanggal Expired:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <input placeholder="Tanggal Expired" type="text" class="form-control datepicker" name="iklanExpired">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Image/Video:</label>
                            <input type="file" name="file_fotoIklan[]" class="form-control" multiple>
                        </div>
                    </div>

                </fieldset>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });


        $(function() {
            CKEDITOR.replace('ckeditor', {
                filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
                height: '400px'
            });
        });

        $('#submit').submit(function(e) {
            e.preventDefault();

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            $.ajax({
                url: '<?php echo base_url(); ?>Iklan/simpanIklan_ajax',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function() {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function(data) {
<<<<<<< HEAD:application/views/page/iklan/form/tambahIklan.php

                    if (data.error) {
                        $('.pesan').html(data.error).show()
                    }

                    swal({
                        icon: 'success',
                        title: "Konfirmasi",
                        text: "Iklan Berhasil Ditambahkan"
                    });
                    window.location.href = ("<?= base_url('Iklan/listIklan'); ?>");

=======
                    var response = JSON.parse(data);
                    if (response.error) {
                        $('.pesan').html(response.error).show()
                    }
                    if (response.sukses) {
                        swal({
                            icon: 'success',
                            title: "Konfirmasi",
                            text: "Iklan Berhasil Ditambahkan"
                        });
                        window.location.href = ("<?= base_url('MasterData/listUser'); ?>");
                    }
<<<<<<< HEAD
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7:application/views/page/old/masterOld/form/tambahIklan.php
=======
>>>>>>> STPPA adding stppa sub lingkup:application/views/page/master/form/tambahIklan.php
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                }
            });
        });


    });
</script>