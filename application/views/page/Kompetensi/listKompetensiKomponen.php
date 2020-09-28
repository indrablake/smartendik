<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Kompetensi Komponen</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Kompetensi</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahKompKomponen">Tambah Data <i class="icon-play3 ml-2"></i></button>
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
                <table class="table " id="my_data" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Komponen</th>
                            <th>Komposisi</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $queryResult = $this->db->query("SELECT *from ref_komponen_kd group by rkk_id")->result_array();
                        foreach ($queryResult as $result) :
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $result['rkk_nama']; ?></td>
                                <td><?php echo $result['rkk_komposisi'] . '%'; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-danger" onclick="hapus(<?php echo $result['kd_id']; ?>, <?php echo $result['rkk_id']; ?>)">Hapus</button>
                                    <button class="btn btn-sm btn-primary" onclick="edit(<?php echo $result['kd_id'] ?>, <?php echo $result['rkk_id']; ?>)">Edit</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data -->
<div id="modalTambahKompKomponen" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kompetensi Komponen</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body modal-lg">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <div class="row" id="dynamicField">
                    <div class="col-md-12">
                        <form action="<?php echo base_url() ?>Kompetensi/simpanKompKomponen_ajax" class="formSimpanBanyak">
                            <div style="text-align: end;">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Simpan Data
                                </button>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 80%">Nama</th>
                                        <th style="width: 20%">Komposisi %</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="formtambah">
                                    <tr>
                                        <td style="width: 70%; "><input type="text" name="namaKomponen[]" class="form-control" placeholder="Nama Komponen"></td>
                                        <td style="width: 30%; "><input type="number" name="komposisi[]" class="form-control" placeholder="0%"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btnaddform">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="text-right">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>


<div class="viewModalEdit" style="display: none;"></div>

<div class="viewModalEdit" style="display: none;"></div>
<div class="viewModalDetail" style="display: none;"></div>

<script>
    function edit(kdID, kompKomponenID) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Kompetensi/formEditKompKomponen') ?>",
            data: {
                kdID: kdID,
                kompKomponenID: kompKomponenID
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditKompKomponen').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditKompKomponen').modal('show');
            }
        })
    }


    $('.formSimpanBanyak').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "post",
            dataType: "json",
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

                if (data.error) {
                    $('.pesan').html(data.error).show()
                } else {
                    swal({
                        icon: 'success',
                        title: "Konfirmasi",
                        text: "Data Kompetensi Komponen Berhasil Ditambahkan"
                    });
                    window.location.href = ("<?= base_url('Kompetensi/listKompetensiKomponen'); ?>")
                }

            }
        });
    });

    $('.btnaddform').click(function(e) {
        e.preventDefault();

        $('.formtambah').append(`
            <tr>
            <td style="width: 80%; "><input type="text" name="namaKomponen[]" class="form-control" placeholder="Nama Komponen"></td>
                                        <td style="width: 20%; "><input type="number" name="komposisi[]" class="form-control" placeholder="10-100%"></td>
                                      
                        <td>
                            <button type="button" class="btn btn-danger btnhapusform">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
            `)
    })
    // End Click

    // Add Hapus Click
    $(document).on('click', '.btnhapusform', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();
    })
    // End Hapus Click



    $(document).ready(function() {

        $("#centangSemua").click(function(e) {
            if ($(this).is(":checked")) {
                $('.centangPromes').prop('checked', true);
            } else {
                $('.centangPromes').prop('checked', false);
            }
        })

    });


    function detail(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Kompetensi/formDetailKompKomponen') ?>",
            data: {
                kompKomponenID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalDetail').html(response.sukses).show();
                $('#modalDetailKompKomponen').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalDetailKompKomponen').modal('show');
            }
        })
    }


    function hapus(kdID, kompKomponenID) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data Kompetensi Komponen ?",
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
                        url: "<?= base_url('Kompetensi/hapusKompKomponen_ajax') ?>",
                        data: {
                            kdID: kdID,
                            kompKomponenID: kompKomponenID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('Kompetensi/listKompetensiKomponen'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }


    function publikasi(kompKomponenID) {

        swal({
                title: "Konfirmasi",
                text: "Data Kompetensi Komponen Publikasikan ?",
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
                        url: "<?= base_url('Kompetensi/updateKompKomponenPublikasi') ?>",
                        data: {
                            kompKomponenID: kompKomponenID
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
                    swal("Data tidak dipublikasikan!");
                }
            });
    }
</script>