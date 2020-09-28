<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPPH</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">RPPH</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button class="btn btn-default" data-toggle="modal" data-target="#modalTambahRPPH">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah RPPH
                </button>
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
    <?php echo form_open('RPPH/deleteMultiple_ajax', ['class' => 'formHapus']); ?>
    <div style="text-align:right" class="mr-3">
        <button class="btn btn-danger  mb-3 ml-3 mt-3" type="submit">Hapus Data</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">
                <table class="table " id="my_data">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Bulan</th>
                            <th>Minggu</th>
                            <th>Tema/Sub Tema</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>

<div id="modalTambahRPPH" class="modal fade modalTambahRPPH" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Tambah RPPH</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('RPPH/simpanRPPH_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>

                    <div class="form-group">
                        <label>Kelas:</label>
                        <select data-placeholder="Pilih Kelas" class="form-control" name="kelasID">

                            <?php $queryGroup = $this->db->query("SELECT sc.*,s.SCH_NAME FROM TBL_SCHOOLCLASS sc INNER JOIN TBL_SCHOOL s ON s.SCH_ID= sc.SCH_ID")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['SCH_NAME'] . " - " . $group['CLASS_LEVEL'] . " - " . $group['CLASS_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select data-placeholder="Pilih Tahun" class="form-control " name="tahunRPPH" id="tahunAjaran" onchange="tahun()">
                                    <option value="<?php echo intval(date('Y')) - 1 ?>"><?php echo intval(date('Y')) - 1 ?></option>
                                    <?php
                                    $tahun = date('Y');
                                    for ($i = 1990; $i <= $tahun; $i++) : ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunRPPH2" placeholder="<?php echo date('Y'); ?>">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Semester:</label>
                        <input type="number" class="form-control" placeholder="RPPH Semester" name="semesterRPPH">
                    </div>
                    <div class="form-group">
                        <label>Bulan:</label>
                        <select data-placeholder="Pilih Bulan" class="form-control" name="bulanRPPH">
                            <?php $month = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                            for ($i = 1; $i <= 12; $i++) :
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $month[$i]; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Minggu:</label>
                        <select data-placeholder="Pilih Minggu" class="form-control" name="mingguRPPH">
                            <?php $month = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                            for ($i = 1; $i <= 4; $i++) :
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tema:</label>
                        <input type="text" class="form-control" placeholder="Tema RPPH" name="temaRPPH">
                    </div>

                    <div class="form-group">
                        <label>Sub Tema:</label>
                        <input type="text" class="form-control" placeholder="Sub Tema RPPH" name="subTemaRPPH">
                    </div>

                    <div class="form-group">
                        <label>Strategi Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Strategi Pembelajaran" name="strategiRPPH">
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


<div class="viewModalEdit" style="display: none;"></div>

<script>
    function showData() {
        table = $('#my_data').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= site_url('rpph/ambilDataRPPH') ?>",
                "type": "POST"
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



    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
    }

    $(document).ready(function() {
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
                        showData();
                        $('#modalTambahRPPH').modal('hide');
                        $('#modalTambahRPPH').modal({
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
            url: "<?php echo base_url('RPPH/formEditRPPH') ?>",
            data: {
                rpphID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditRPPH').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditRPPH').modal('show');
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
                    text: ` ${jumlahData.length}   Program RPPH,Yakin menghapus data  ?`,
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


    function hapus(rpphID) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data RPPH ?",
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
                        url: "<?= base_url('RPPH/hapusRPPH_ajax') ?>",
                        data: {
                            rpphID: rpphID
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