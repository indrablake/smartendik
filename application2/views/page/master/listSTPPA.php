<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">List Sekolah</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="<?= base_url(); ?>MasterData/tambahSekolah" class="btn btn-default">Tambah Data <i class="icon-play3 ml-2"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">

                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NPSN</th>
                            <th class="text-center">Nama Sekolah</th>
                            <th class="text-center">Jenjang</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_stppa as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['sekolah_npsn']; ?></td>
                                <td class="text-center"><?php echo $q['sekolah_nm']; ?></td>
                                <td class="text-center"><?php echo $q['jenjang_nm']; ?></td>
                                <td class="text-center"><?php if ($q['sekolah_status'] == '1') {
                                                            echo "Swasta";
                                                        } else {
                                                            echo "Negeri";
                                                        }; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning" href="<?= base_url(); ?>MasterData/formEditSekolah?id=<?php echo $q['sekolah_kd'] ?>">Edit </a>
                                    <button onclick="hapus(<?php echo $q['sekolah_kd'] ?>)" class=" btn btn-sm btn-danger">Hapus</button>
                                </td>
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
        $('#example').dataTable();

        // var i = 1;

    });


    function hapus(sekolahID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data  Sekolah  ?",
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
                        url: "<?= base_url('MasterData/hapusSekolah_ajax') ?>",
                        data: {
                            sekolahID: sekolahID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('MasterData/listSekolah'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>