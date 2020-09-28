<script src="<?php echo base_url() ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/datatables_basic.js"></script>


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
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sender </th>
                            <th>Title </th>
                            <th>Post Date </th>
                            <th>Thumbnail</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $query = $this->db->query("SELECT *FROM TBL_NEWSPOST")->result_array();
                        $no = 1;
                        foreach ($query as $q) :
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $q['NP_SENDER']; ?></td>
                                <td><?php echo $q['NP_TITLE']; ?></td>
                                <td><?php echo $q['NP_POSTDATE']; ?></td>
                                <td><img src="<?php echo base_url() ?>uploads/Berita/thumbnail/<?php echo $q['NP_IMAGELINK']; ?>" width="60px" alt=""></td>
                                <td><a href="editBerita?id=<?php echo $q['NP_ID'] ?>" class="btn btn-warning btn-sm"><i class="icon-pencil" style="font-size: 12px;"></i></a><button onclick="hapus(<?php echo $q['NP_ID'] ?>)" class="btn btn-danger btn-sm mt-1"><i class="icon-trash" style="font-size: 12px;"></i></button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
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
</script>