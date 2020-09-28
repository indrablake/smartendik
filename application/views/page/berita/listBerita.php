<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Berita</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Berita</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="tambahBerita" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah Berita
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
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('failed'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table class="table datatable-basic" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sender </th>
                            <th>Title </th>
                            <th>Post Date </th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php $query = $this->db->query("SELECT *FROM dat_berita")->result_array();
                        $no = 1;
                        foreach ($query as $q) :
                            $tombolEdit = "<a type=\"button\" class=\"btn  btn-sm btn-outline-success ml-1\" title=\"Edit data\" href=\"editBerita?id=" . $q['berita_kd'] . "\">
                            Edit
                        </a>";
                            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $q['berita_kd'] . "')\">
                            Hapus
                        </button>";
                            $tombolDetail = "<a  class=\"btn  btn-sm btn-outline-primary ml-1\" title=\"Edit data\"  href=\"detailBerita?id=" . $q['berita_kd'] . "\">
                        Detail
                    </a>";
                            $tombolPublikasikan = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Publikasi Data\" onclick=\"publikasi('" . $q['berita_kd'] . "')\">
                        Publikasi
                    </button>";
                            $id = base_url('RPP/detailExport?id=' . $q['berita_kd']);
                            $tombolExport = "<a class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Export Data\" href=\"" . $id . "\" >
                        Export
                    </a>";
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $q['user_kd']; ?></td>
                                <td><?php echo $q['berita_judul']; ?></td>
                                <td><?php echo $q['berita_tgl_kirim']; ?></td>
                                <td>

                                    <?php if ($q['berita_status'] == '0') {
                                        echo 'Draf';
                                    } else if ($q['berita_status'] == '1') {
                                        echo 'Publikasi';
                                    } else if ($q['berita_status'] == '4') {
                                        echo 'Tidak Di Publikasi';
                                    }
                                    ?>
                                </td>
                                <td><img src="<?php echo base_url() ?>uploads/Berita/thumbnail/<?php echo $q['berita_gambar']; ?>" width="60px" alt=""></td>

                                <td class="text-center">
                                    <?php if ($q['berita_status'] == '0') {
                                        echo $tombolEdit . $tombolHapus . $tombolDetail . $tombolPublikasikan;
                                    } else if ($q['berita_status'] == '1') {
                                        echo  $tombolHapus . $tombolDetail;
                                    } else if ($q['berita_status'] == '4') {
                                        echo '';
                                    }  ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#example').dataTable();
    });

    function hapus(beritaID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data berita ?",
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
                        url: "<?= base_url('Berita/hapusBerita_ajax') ?>",
                        data: {
                            beritaID: beritaID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('berita/listBerita'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }




    function publikasi(beritaID) {

        swal({
                title: "Konfirmasi",
                text: "Data Berita Publikasikan ?",
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
                        url: "<?= base_url('Berita/updateBeritaPublikasi') ?>",
                        data: {
                            beritaID: beritaID
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