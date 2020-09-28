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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahUser">Tambah Data <i class="icon-play3 ml-2"></i></button>
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
                            <th class="text-center">Username</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataUser as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['user_nm']; ?></td>

                                <td class="text-center">

                                    <?php $idProfile = $q["profile_kd"];
                                    $result = $this->db->query("SELECT *FROM dat_profile WHERE profile_kd='$idProfile'")->row();
                                    if (empty($result->profile_kd)) { ?>
                                        <a class="btn btn-sm btn-outline-success " href="<?php echo base_url() ?>User/DetailProfile?id=<?= $q['user_kd']; ?>">Profile </a>
                                        <button onclick="hapusUserAjax(<?php echo $q['user_kd'] ?>)" class="btn btn-sm btn-sm btn-outline-danger">Hapus</button>
                                    <?php } else {
                                    ?>
                                        <a class="btn btn-sm btn-outline-success " href="<?php echo base_url() ?>User/DetailProfileEdit?profileID=<?= $q['profile_kd'] ?>">Edit Profile </a>
                                        <button onclick="hapus(<?php echo $q['profile_kd'] ?>)" class="btn btn-sm btn-sm btn-outline-danger">Hapus</button>
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
<div id="modalTambahUser" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('User/simpanUser_ajax', ['class' => 'formSimpan']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <?php echo form_error("password", '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label>Confirm Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password2">

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
                    window.location.href = ("<?= base_url('User/listUser'); ?>")
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
            }
        });
        return false;
    })

    function edit(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('User/formEditUser') ?>",
            data: {
                userID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditUser').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditUser').modal('show');
            }
        })
    }


    function hapus(userID) {
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
                        url: "<?= base_url('User/hapusUser_ajax') ?>",
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
                                window.location.href = ("<?= base_url('User/listUser'); ?>")
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
                        url: "<?= base_url('User/hapusUserPermanen_ajax') ?>",
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
                                window.location.href = ("<?= base_url('User/listUser'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>