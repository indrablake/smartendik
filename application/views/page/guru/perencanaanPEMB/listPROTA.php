<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">PROTA</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Perencanaan PEMB</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahProta">Tambah Data <i class="icon-play3 ml-2"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 1em;">

                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jenjang Sekolah</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Semester</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($listPROTA as $prota) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $prota['prota_name'] ?></td>
                                <td><?php echo $prota['jenjang_nm'] ?></td>
                                <td><?php echo $prota['kelas'] ?></td>
                                <td><?php echo $prota['semester'] ?></td>
                                <td style="text-align: center;">
                                    <?php if ($this->session->userdata('jenisUser') == 'Guru') { ?>

                                        <?php } else {
                                        if ($prota['prota_status'] == '0') {
                                        ?>
                                            <a href="<?php echo base_url() ?>guru/PerencanaanPEMB/downloadPROTA/<?php echo $prota['prota_id'] ?>" class="btn btn-success btn-sm">Download</a>
                                            <button class="btn btn-sm btn-warning" onclick="edit(<?php echo $prota['prota_id'] ?>)">Edit</button>
                                            <button class="btn btn-sm btn-danger" onclick="hapus(<?php echo $prota['prota_id'] ?>)">Hapus</button>
                                            <button class="btn btn-sm btn-primary" onclick="publikasi(<?php echo $prota['prota_id'] ?>)">Publikasi</button>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url() ?>guru/PerencanaanPEMB/downloadPROTA/<?php echo $prota['prota_id'] ?>" class="btn btn-success btn-sm">Download</a>
                                            <button class="btn btn-sm btn-danger" onclick="hapus(<?php echo $prota['prota_id'] ?>)">Hapus</button>
                                    <?php }
                                    } ?>
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
<div id="modalTambahProta" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data PROTA</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="submit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pesan"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama PROTA:</label>
                        <input type="text" name="prota" class="form-control" placeholder="PROTA">
                    </div>
                    <div class="form-group">
                        <label>Tahun Ajaran:</label>
                        <select data-placeholder="Pilih Tahun Ajaran" id="jenjangSekolahID" class="form-control form-control-select2" data-fouc name="thn_ajar_kd">
                            <?php
                            foreach ($dataTahun as $group) : ?>
                                <option value="<?php echo $group['thn_ajar_kd'] ?>"><?php echo $group['thn_ajar_periode'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenjang Sekolah:</label>
                        <select data-placeholder="Pilih Jenjang Sekolah" id="jenjangSekolahID" class="form-control form-control-select2" data-fouc name="jenjang_kd">
                            <?php
                            foreach ($dataJenjang as $group) : ?>
                                <option value="<?php echo $group['jenjang_kd'] ?>"><?php echo $group['jenjang_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas:</label>
                        <select data-placeholder="Pilih Kelas" id="kelasID" class="form-control form-control-select2" data-fouc name="kelas">
                            <?php
                            $kelasNama = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                            for ($i = 0; $i <= 12; $i++) : ?>
                                <option value="<?php echo $kelasNama[$i] ?>"><?php echo $kelasNama[$i] ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester:</label>
                        <input type="text" name="semester" class="form-control" placeholder="Semester">
                    </div>
                    <div class="form-group">
                        <label>Upload Dokumen:</label>
                        <input type="file" name="file_prota" class="form-input-styled" data-fouc="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Save changes</button>
                </div>
        </div>
        </form>
    </div>
</div>


<div class="viewModalEdit" style="display: none;"></div>

<!-- /basic modal -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $('#submit').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>guru/PerencanaanPEMB/simpanPROTA_ajax',
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
                if (data.error) {
                    $('.pesan').html(response.error).show()
                } else {
                    swal({
                        icon: 'success',
                        title: "Konfirmasi",
                        text: "PROTA Berhasil Ditambahkan"
                    });
                    window.location.href = ("<?= base_url('guru/PerencanaanPEMB/listPROTA'); ?>");
                }


            }
        });
    });


    function edit(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('guru/PerencanaanPEMB/formEditPROTA') ?>",
            data: {
                PROTAID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditPROTA').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditPROTA').modal('show');
            }
        })
    }


    function hapus(PROTAID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data PROTA ?",
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
                        url: "<?= base_url('guru/PerencanaanPEMB/hapusPROTA_ajax') ?>",
                        data: {
                            PROTAID: PROTAID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('guru/PerencanaanPEMB/listPROTA'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }

    // Hapus Permanen

    function hapusPROTAAjax(PROTAID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data PROTA ?",
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
                        url: "<?= base_url('guru/PerencanaanPEMB/hapusPROTAPermanen_ajax') ?>",
                        data: {
                            PROTAID: PROTAID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('guru/PerencanaanPEMB/listPROTA'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }


    function publikasi(protaID) {

        swal({
                title: "Konfirmasi",
                text: "Data PROTA Publikasikan ?",
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
                        url: "<?= base_url('guru/perencanaanPEMB/updatePROTAPublikasi') ?>",
                        data: {
                            protaID: protaID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('guru/PerencanaanPEMB/listPROTA'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dipublikasikan!");
                }
            });
    }
</script>