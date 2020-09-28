<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">User</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">User</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="<?php echo base_url() ?>MasterData/tambahSiswa" class="btn btn-default">Tambah Data <i class="icon-play3 ml-2"></i></a>
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
                            <th class="text-center">NIS</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($dataSiswa as $q) :

                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['profile_nomor_id']; ?></td>
                                <td class="text-center"><?php echo $q['profile_nm_1'] . ' ' . $q['profile_nm_2'] . ' ' . $q['profile_nm_3']; ?></td>
                                <td class="text-center"><?php echo $q['profile_jns_kelamin']; ?></td>
                                <td class="text-center">
                                    <button onclick="detail(<?php echo $q['profile_kd'] ?>)" class="btn btn-sm btn-success">Detail</button>
                                    <button onclick="hapus(<?php echo $q['profile_kd'] ?>)" class="btn btn-sm btn-sm btn-danger">Hapus</button>
                                    <a href="<?php echo base_url() ?>MasterData/siswaProfileEdit?profileID=<?php echo $q['profile_kd']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                        <?php
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="viewModalDetail" style="display: none;"></div>

<!-- /basic modal -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Simpan 
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


                    $('[name="username"]').val("");


                    $('#modalTambahUser').modal('hide')
                    $('#modalTambahUser').modal({
                        backdrop: 'false',
                        keyboard: 'true',
                        show: 'false'
                    });
                    window.location.href = ("<?= base_url('MasterData/listUser'); ?>")
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
            }
        });
        return false;
    })

    function detail(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('MasterData/formDetailSiswa') ?>",
            data: {
                siswaID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalDetail').html(response.sukses).show();
                $('#modalDetailSiswa').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalDetailSiswa').modal('show');
            }
        })
    }


    function hapus(userID) {
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
                        url: "<?= base_url('MasterData/hapusUser_ajax') ?>",
                        data: {
                            userID: userID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('MasterData/listSiswa'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }

    // Hapus Permanen

    function hapusUserAjax(userID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data user ?",
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
                        url: "<?= base_url('MasterData/hapusUserPermanen_ajax') ?>",
                        data: {
                            userID: userID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('MasterData/listSiswa'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>