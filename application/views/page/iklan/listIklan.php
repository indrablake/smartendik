<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Iklan</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Iklan</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="tambahIklan" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah Data
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
            <div class="card" style="padding:1em">
                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengirim</th>
                            <th>Barang </th>
                            <th>Judul </th>
                            <th>Tanggal </th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $query = $this->db->query("SELECT iklan.iklan_kd,iklan.iklan_pengirim,iklan.iklan_judul,iklan.iklan_deskripsi,iklan.iklan_tgl_kirim,barang.jns_brg_nm,iklan.iklan_status FROM dat_iklan iklan INNER JOIN ref_jenis_barang barang ON barang.jns_brg_kd=iklan.jns_brg_kd ")->result_array();
                        $no = 1;
                        foreach ($query as $q) :
                            $tombolEdit = "<a type=\"button\" class=\"btn  btn-sm btn-outline-success ml-1\" title=\"Edit data\" href=\"" . base_url() . "Iklan/formEditIklan?id=" . $q['iklan_kd'] . "\">
                            Detail
                        </a>";
                            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $q['iklan_kd'] . "')\">
                            Hapus
                        </button>";
                            $tombolPublikasikan = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Publikasi Data\" onclick=\"publikasi('" . $q['iklan_kd'] . "')\">
                        Publikasi
                    </button>";
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $q['iklan_pengirim']; ?></td>
                                <td><?php echo $q['jns_brg_nm']; ?></td>
                                <td><?php echo $q['iklan_judul']; ?></td>
                                <td><?php echo $q['iklan_tgl_kirim']; ?></td>
                                <td><?php if ($q['iklan_status'] == '0') {
                                        echo "Belum Disetujui";
                                    } else if ($q["iklan_status"] == '1') {
                                        echo "Disetujui";
                                    } else {
                                        echo "Expired";
                                    }; ?></td>
                                <td>
                                    <?php if ($q['iklan_status'] == '0') { ?>
                                        <?php echo $tombolEdit . $tombolHapus . $tombolPublikasikan ?>
                                    <?php } else if ($q['iklan_status'] == '1') { ?>
                                        <?php echo $tombolEdit . $tombolHapus; ?>
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



<script>
    $(document).ready(function() {
        $('#example').dataTable();

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

                    swal({
                        icon: 'success',
                        title: 'Tambah Data',
                        text: response.sukses
                    });
                    $('[name="kabupatenNama"]').val("");
                    window.location.href = ("<?= base_url('Iklan/listIklan'); ?>")

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                }
            });
            return false;
        })


    });

    function hapus(iklanID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data iklan ?",
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
                        url: "<?= base_url('Iklan/hapusIklan_ajax') ?>",
                        data: {
                            iklanID: iklanID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('Iklan/listIklan'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }

    function publikasi(iklanID) {

        swal({
                title: "Konfirmasi",
                text: "Data Iklan Di Approved ?",
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
                        url: "<?= base_url('Iklan/updateIklanPublikasi') ?>",
                        data: {
                            iklanID: iklanID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('Iklan/listIklan'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Iklan tidak di approved!");
                }
            });
    }
</script>