<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
<<<<<<< HEAD
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">KKM</span> -
=======
<<<<<<< HEAD
<<<<<<< HEAD
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">KKM</span> -
=======
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPPH</span> -
>>>>>>> STPPA adding stppa sub lingkup
=======
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPPH</span> -
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">KKM</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahKKM">Tambah Data <i class="icon-play3 ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } else if ($this->session->flashdata('failed')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('failed'); ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pesan">

                            </div>
                        </div>
                    </div>
                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>Kompetensi Dasar:</label>
                                        <select data-placeholder="Pilih Kompetensi Dasar" class="form-control " id="kdID" name="kdID">
<<<<<<< HEAD
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where kd_status='1'")->result_array();
=======
<<<<<<< HEAD
<<<<<<< HEAD
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where kd_status='1'")->result_array();
=======
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar ")->result_array();
>>>>>>> STPPA adding stppa sub lingkup
=======
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar ")->result_array();
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                                            if (!empty($queryGroup)) :
                                                foreach ($queryGroup as $group) : ?>
                                                    <option value="<?php echo $group['kd_id'] ?>"><?php echo $group['kd_semester'] . ' [ Kode : ' . $group['kd_kode'] . ' ] - [ Tema :  ' . $group['kd_tema'] . ' ]' ?></option>
                                                <?php endforeach;
                                            else : ?>
                                                <option value="">Kompetensi Dasar Kosong</option>
                                            <?php endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group" style="margin-top:5px">
                                        <button type="button" id="searchBtn" class="btn btn-primary mt-3">Search</button>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                    <div class="row" id="tabledata">
                        <div class="col-md-12">
                            <div class="card" style="padding:1em">
                                <table class="table " id="my_data" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Indikator</th>
                                            <th>Daya Dukung</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data -->
<div id="modalTambahKKM" class="modal fade" tabindex="-1">
<<<<<<< HEAD
    <div class="modal-dialog modal-lg">
=======
<<<<<<< HEAD
<<<<<<< HEAD
    <div class="modal-dialog modal-lg">
=======
    <div class="modal-dialog">
>>>>>>> STPPA adding stppa sub lingkup
=======
    <div class="modal-dialog">
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data KKM</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
<<<<<<< HEAD
            <?php echo form_open('KKM/simpanKKM_ajax', ['class' => 'formSimpan']) ?>
=======
<<<<<<< HEAD
<<<<<<< HEAD
            <?php echo form_open('KKM/simpanKKM_ajax', ['class' => 'formSimpan']) ?>
=======
            <?php echo form_open('MasterData/simpanKKM_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> STPPA adding stppa sub lingkup
=======
            <?php echo form_open('MasterData/simpanKKM_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <div class="row" id="dynamicField">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label> Kompetensi Dasar:</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select data-placeholder="Pilih Kompetensi Dasar" class="form-control " id="kdID" name="kdID[]">
<<<<<<< HEAD
                                        <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where kd_status='1' ")->result_array();
=======
<<<<<<< HEAD
<<<<<<< HEAD
                                        <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where kd_status='1' ")->result_array();
=======
                                        <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar ")->result_array();
>>>>>>> STPPA adding stppa sub lingkup
=======
                                        <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar ")->result_array();
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                                        if (!empty($queryGroup)) :
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['kd_id'] ?>"><?php echo $group['kd_semester'] . ' [ Kode : ' . $group['kd_kode'] . ' ] - [ Tema :  ' . $group['kd_tema'] . ' ]' ?></option>
                                            <?php endforeach;
                                        else : ?>
                                            <option value="">Kompetensi Dasar Kosong</option>
                                        <?php endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label> KKM Indikator:</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="inputIndikator" placeholder="KKM Indikator">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label> KKM Kompleksitas:</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="inputKompleksitas" placeholder="KKM Kompleksitas">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label> KKM Daya Dukung:</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="inputDayaDukung" placeholder="KKM Daya Dukung">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label> KKM Intake:</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="inputIntake" placeholder="KKM Intake">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-primary">Save changes</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>


<div class="viewModalEdit" style="display: none;"></div>
<div class="viewModalDetail" style="display: none;"></div>


<script>
    $("#searchBtn").click(function() {
        var search = $("#rpphid").val();
        console.log(search);
        $("#kodeRppm").val(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
<<<<<<< HEAD
            url: "<?php echo base_url(); ?>KKM/fetchKKM",
=======
<<<<<<< HEAD
<<<<<<< HEAD
            url: "<?php echo base_url(); ?>KKM/fetchKKM",
=======
            url: "<?php echo base_url(); ?>MasterData/fetchKKM",
>>>>>>> STPPA adding stppa sub lingkup
=======
            url: "<?php echo base_url(); ?>MasterData/fetchKKM",
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#tabledata").show();
                showData();
            }
        })
    }
</script>


<script>
    function showData() {
        table = $('#my_data').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
<<<<<<< HEAD
                "url": "<?= site_url('KKM/ambilDataKKM') ?>",
=======
<<<<<<< HEAD
<<<<<<< HEAD
                "url": "<?= site_url('KKM/ambilDataKKM') ?>",
=======
                "url": "<?= site_url('MasterData/ambilDataKKM') ?>",
>>>>>>> STPPA adding stppa sub lingkup
=======
                "url": "<?= site_url('MasterData/ambilDataKKM') ?>",
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                "type": "POST",
                "data": {
                    "kdID": $("#kdID").val()
                }
            },


            "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "width": 5
            }],

        });
    }
    $(document).ready(function() {
        showData();

        $("#centangSemua").click(function(e) {
            if ($(this).is(":checked")) {
                $('.centangPromes').prop('checked', true);
            } else {
                $('.centangPromes').prop('checked', false);
            }
        })

    });

    CKEDITOR.replace('ckeditor', {
        toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
        }, {
            "name": "paragraph",
            "groups": ["list", "blocks"]
        }],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
        filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
        height: '200px'
    });

    CKEDITOR.replace('formTujuan', {
        toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
        }, {
            "name": "paragraph",
            "groups": ["list", "blocks"]
        }],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
        filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
        height: '200px'
    });

    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
    }

    $(document).ready(function() {
        $('.formSimpan').submit(function(e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            console.log("OK");
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function(response) {
                    if (response.error) {
                        $('.pesan').html(response.error).show()
                    }
                    if (response.sukses) {
                        swal({
                            icon: 'success',
                            title: 'Tambah Data',
                            text: response.sukses
                        });
                        showData();
<<<<<<< HEAD
                        $('#modalTambahKKM').modal('hide');
                        $('#modalTambahKKM').modal({
=======
<<<<<<< HEAD
<<<<<<< HEAD
                        $('#modalTambahKKM').modal('hide');
                        $('#modalTambahKKM').modal({
=======
                        $('#modalTambahRPP').modal('hide');
                        $('#modalTambahRPP').modal({
>>>>>>> STPPA adding stppa sub lingkup
=======
                        $('#modalTambahRPP').modal('hide');
                        $('#modalTambahRPP').modal({
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                }
            });
            return false;
        })
    });

    function edit(id) {
        $.ajax({
            type: 'POST',
<<<<<<< HEAD
            url: "<?php echo base_url('KKM/formEditKKM') ?>",
=======
<<<<<<< HEAD
<<<<<<< HEAD
            url: "<?php echo base_url('KKM/formEditKKM') ?>",
=======
            url: "<?php echo base_url('MasterData/formEditKKM') ?>",
>>>>>>> STPPA adding stppa sub lingkup
=======
            url: "<?php echo base_url('MasterData/formEditKKM') ?>",
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
            data: {
                kkmID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditKKM').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditKKM').modal('show');
            }
        })
    }



    $('.formHapus').submit(function(e) {
        e.preventDefault();
        let jumlahData = $('.centangPromes:checked');

        if (jumlahData.length == 0) {
            swal({
                icon: 'warning',
                title: 'Perhatikan',
                text: 'Maaf tidak ada data yang dipilih,Silahkan pilih data'
            });
        } else {
            swal({
                    title: "Hapus",
<<<<<<< HEAD
                    text: ` ${jumlahData.length}   Program KKMH,Yakin menghapus data  ?`,
=======
<<<<<<< HEAD
<<<<<<< HEAD
                    text: ` ${jumlahData.length}   Program KKMH,Yakin menghapus data  ?`,
=======
                    text: ` ${jumlahData.length}   Program RPPH,Yakin menghapus data  ?`,
>>>>>>> STPPA adding stppa sub lingkup
=======
                    text: ` ${jumlahData.length}   Program RPPH,Yakin menghapus data  ?`,
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Tidak'
                })
                .then((willDelete) => {
                    if (willDelete) {
                        console.log("OK");
                        $.ajax({
                            type: "POST",
                            url: $(this).attr("action"),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.sukses) {
                                    console.log("OK");
                                    swal({
                                        icon: 'success',
                                        title: "Konfirmasi",
                                        text: response.sukses
                                    });
                                    showData();
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                            }
                        })
                    } else {
                        swal("Data tidak dihapus!");
                    }
                });
        }
        return false;
    })


    function hapus(kdID) {

        swal({
                title: "Hapus",
<<<<<<< HEAD
                text: "Yakin menghapus data KKM ?",
=======
<<<<<<< HEAD
<<<<<<< HEAD
                text: "Yakin menghapus data KKM ?",
=======
                text: "Yakin menghapus data Langkah Pembelajaran RPP ?",
>>>>>>> STPPA adding stppa sub lingkup
=======
                text: "Yakin menghapus data Langkah Pembelajaran RPP ?",
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            })
            .then((willDelete) => {
                if (willDelete) {
                    console.log("OK");
                    $.ajax({
                        type: "POST",
<<<<<<< HEAD
                        url: "<?= base_url('KKM/hapusKKM_ajax') ?>",
                        data: {
                            kkmID: kdID
=======
<<<<<<< HEAD
<<<<<<< HEAD
                        url: "<?= base_url('KKM/hapusKKM_ajax') ?>",
                        data: {
                            kkmID: kdID
=======
                        url: "<?= base_url('RPP/hapusPembelajaranRPP_ajax') ?>",
                        data: {
                            kdID: kdID
>>>>>>> STPPA adding stppa sub lingkup
=======
                        url: "<?= base_url('RPP/hapusPembelajaranRPP_ajax') ?>",
                        data: {
                            kdID: kdID
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                showData();
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>