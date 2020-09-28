<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/notifications/bootbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/app.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Siswa</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Siswa</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="<?php echo base_url('Siswa/tambahKelasSiswa') ?>" class="btn btn-default">Tambah Data <i class="icon-play3 ml-2"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">
                <h2 class="mb-3">Detail Kelas <?php echo $kelas->CLASS_NAME . '-' . $kelas->CLASS_LEVEL; ?></h2>
                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tahun Masuk</th>
                            <th class="text-center">NISN</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Tempat Lahir</th>
                            <th class="text-center">Tanggal Lahir</th>
                            <th class="text-center">Agama</th>
                            <th class="text-center">Telp</th>
                            <th class="text-center">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($siswaKelas as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['CLSMEM_STUDYYEAR']; ?></td>
                                <td class="text-center"><?php echo $q['STD_NISN']; ?></td>
                                <td class="text-center"><?php echo $q['STD_FIRSTNAME'] . ' ' . $q['STD_LASTNAME']; ?></td>
                                <td class="text-center"><?php echo $q['STD_BIRTHPLACE']; ?></td>
                                <td class="text-center"><?php echo $q['STD_BIRTHDATE']; ?></td>
                                <td class="text-center"><?php echo $q['REL_NAME']; ?></td>
                                <td class="text-center"><?php echo $q['STD_PHONE']; ?></td>
                                <td class="text-center"><?php echo $q['STD_EMAIL']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /basic modal -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    function edit(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Siswa/formEditSiswa') ?>",
            data: {
                classid: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
            }
        })
    }


    function hapus(classid) {
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
                        url: "<?= base_url('Siswa/hapusSiswa_ajax') ?>",
                        data: {
                            classid: classid
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('Siswa/listSiswa'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>