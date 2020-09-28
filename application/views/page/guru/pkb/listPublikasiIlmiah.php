<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">PublikasiIlmiah</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">PKB</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahPublikasiIlmiah">Tambah Data <i class="icon-play3 ml-2"></i></button>
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
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($listPublikasiIlmiah as $publikasiIlmiah) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $publikasiIlmiah['publikasiIlmiah_name'] ?></td>
                                <td style="text-align: center;">
                                    <?php if ($this->session->userdata('jenisUser') == 'Guru') { ?>

                                    <?php } else { ?>
                                        <a href="<?php echo base_url() ?>guru/PKB/downloadPublikasiIlmiah/<?php echo $publikasiIlmiah['publikasiIlmiah_id'] ?>" class="btn btn-success btn-sm">Download</a>
                                        <button class="btn btn-sm btn-warning" onclick="edit(<?php echo $publikasiIlmiah['publikasiIlmiah_id'] ?>)">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="hapus(<?php echo $publikasiIlmiah['publikasiIlmiah_id'] ?>)">Hapus</button>
                                        <button class="btn btn-sm btn-primary" onclick="publikasi(<?php echo $publikasiIlmiah['publikasiIlmiah_id'] ?>)">Publikasi</button>
                                    <?php } ?>
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
<div id="modalTambahPublikasiIlmiah" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Publikasi Ilmiah</h5>
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
                        <label>Nama Publikasi Ilmiah:</label>
                        <input type="text" name="publikasiIlmiah" class="form-control" placeholder="PublikasiIlmiah">
                    </div>
                    <div class="form-group">
                        <label>Upload Dokumen:</label>
                        <input type="file" name="file_publikasiIlmiah" class="form-input-styled" data-fouc="">
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
            url: '<?php echo base_url(); ?>guru/PKB/simpanPublikasiIlmiah_ajax',
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
                        text: "Publikasi Ilmiah Berhasil Ditambahkan"
                    });
                    window.location.href = ("<?= base_url('guru/PKB/listPublikasiIlmiah'); ?>");
                }


            }
        });
    });


    function edit(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('guru/PKB/formEditPublikasiIlmiah') ?>",
            data: {
                PublikasiIlmiahID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditPublikasiIlmiah').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditPublikasiIlmiah').modal('show');
            }
        })
    }


    function hapus(PublikasiIlmiahID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data Publikasi Ilmiah ?",
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
                        url: "<?= base_url('guru/PKB/hapusPublikasiIlmiah_ajax') ?>",
                        data: {
                            PublikasiIlmiahID: PublikasiIlmiahID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('guru/PKB/listPublikasiIlmiah'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }

    // Hapus Permanen

    function hapusPublikasiIlmiahAjax(PublikasiIlmiahID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data PublikasiIlmiah ?",
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
                        url: "<?= base_url('guru/PKB/hapusPublikasiIlmiahPermanen_ajax') ?>",
                        data: {
                            PublikasiIlmiahID: PublikasiIlmiahID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('guru/PKB/listPublikasiIlmiah'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>