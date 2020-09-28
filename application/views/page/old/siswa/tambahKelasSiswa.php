<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Program</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">KelasSiswa</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listKelasSiswa" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data KelasSiswa
                </a>
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
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Tambah Data</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                    </div>
                    <form action="">
                        <fieldset>
                            <div class="form-group">
                                <label>Tahun:</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select data-placeholder="Pilih Tahun" class="form-control form-control-select2" name="tahunKelasSiswa" data-fouc id="tahunAjaran" onchange="tahun()">
                                            <?php
                                            $tahun = date('Y');
                                            for ($i = 1990; $i <= $tahun; $i++) : ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunKelasSiswa2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kelas:</label>
                                <select data-placeholder="Pilih Kelas" class="form-control form-control-select2" data-fouc name="kelasID" id="kelasID">

                                    <?php $queryGroup = $this->db->query("SELECT sc.*,s.SCH_NAME FROM TBL_SCHOOLCLASS sc INNER JOIN TBL_SCHOOL s ON s.SCH_ID= sc.SCH_ID")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['SCH_NAME'] . " - " . $group['CLASS_LEVEL'] . " - " . $group['CLASS_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </fieldset>
                        <div class="text-right">
                            <button type="button" id="searchBtn" class="btn btn-primary mt-3">Search</button>
                        </div>
                    </form>

                    <div id="hasilData">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalTambahKelas" class="modal fade modalTambahKelas" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Siswa/simpanKelasSiswa_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <input type="text" id=tahun name="tahunAjaran" hidden>
                    <input type="text" id=kelas name="kelasID" hidden>
                    <div class="row mb-2" id="dynamicField">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Siswa:</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="js-example-basic-multiple" id="siswa" name="siswa[]" multiple="multiple">
                                        <?php

                                        $student = $this->db->query("SELECT tc.STD_ID as std_id, ts.* FROM TBL_STUDENT ts LEFT JOIN TBL_CLASSSMEMBER tc ON tc.STD_ID =ts.STD_ID WHERE tc.std_id IS NULL")->result_array();
                                        foreach ($student as $student) : ?>
                                            <option value="<?= $student['STD_ID']; ?>"><?= $student['STD_NISN'] . '-' . $student['STD_FIRSTNAME'] . ' ' . $student['STD_LASTNAME']; ?></option>
                                        <?php endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close <i class="icon-logout ml-2"></i></button>
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>


<script>
    function tambah() {
        console.log("OK");
        $('#modalTambahKelas').modal('show');
    }


    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $("#searchBtn").click(function() {
        var tahun1 = $("#tahunAjaran").val();
        var tahun2 = $("#tahunAjaran2").val();
        var kelas = $("#kelasID").val();
        var tahun = tahun1 + tahun2;
        $("#tahun").val(tahun1 + tahun2);
        $("#kelas").val(kelas);
        console.log(tahun1 + ' ' + tahun2 + ' ' + kelas);
        load_data(tahun, kelas);
    });

    $('.formSimpan').submit(function(e) {
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
                    $("#hasilData").html("<div id='hasilData'></div>");
                    $('#modalTambahKelas').modal('hide');
                    $('#modalTambahKelas').modal({
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


    function load_data(tahun, kelas) {
        $.ajax({
            url: "<?php echo base_url(); ?>Siswa/fetchKelasSiswa",
            method: "POST",
            data: {
                tahun: tahun,
                kelas: kelas
            },
            success: function(data) {
                $("#hasilData").html(data);
                $("#btnTambah").show();
            }
        })
    }


    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
        document.getElementById("tahunAjaran2").html = tahun + 1;
    }


    function hapus(siswaID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data siswa ?",
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
                        url: "<?= base_url('Siswa/hapusKelasSiswa_ajax') ?>",
                        data: {
                            siswaID: siswaID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                $("#hasilData").html("<div id='hasilData'></div>");
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>