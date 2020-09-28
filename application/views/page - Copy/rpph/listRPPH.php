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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPPH</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">RPPH</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="tambahRPPH" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah RPPH
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
                <div class="alert alert-danger" role="alert">
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
                            <th>Tahun</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Bulan</th>
                            <th>Minggu</th>
                            <th>Tema/Sub Tema</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($query as $q) :
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $q['RPPH_STUDYYEAR']; ?></td>
                                <td><?php echo $q['CLASS_NAME']; ?></td>
                                <td><?php echo $q['RPPH_SEMESTER']; ?></td>
                                <td>
                                    <?php
                                    switch ($q['RPPH_MONTH']) {
                                        case 1:
                                            echo "Januari";
                                            break;
                                        case 2:
                                            echo "Februari";
                                            break;
                                        case 3:
                                            echo "Maret";
                                            break;
                                        case 4:
                                            echo "April";
                                            break;
                                        case 5:
                                            echo "Mei";
                                            break;
                                        case 6:
                                            echo "Juni";
                                            break;
                                        case 7:
                                            echo "Juli";
                                            break;
                                        case 8:
                                            echo "Agustus";
                                            break;
                                        case 9:
                                            echo "September";
                                            break;
                                        case 10:
                                            echo "Oktober";
                                            break;
                                        case 11:
                                            echo "November";
                                            break;
                                        case 12:
                                            echo "Desember";
                                            break;
                                    }


                                    ?>
                                </td>
                                <td>
                                    <?php if ($q['RPPH_WEEK'] == 1 || $q['RPPH_WEEK'] == "I") {
                                        echo "I";
                                    } else if ($q['RPPH_WEEK'] == 2 || $q['RPPH_WEEK'] == "II") {
                                        echo "II";
                                    } else if ($q['RPPH_WEEK'] == 3 || $q['RPPH_WEEK'] == "III") {
                                        echo "III";
                                    } else if ($q['RPPH_WEEK'] == 4 || $q['RPPH_WEEK'] == "IV") {
                                        echo "IV";
                                    } ?>
                                </td>

                                <td><?php echo $q['RPPH_THEME'] . '/ ' . $q['RPPH_SUBTHEME']; ?></td>
                                <td class="text-center">
                                    <a href="detailRPPH?id=<?php echo $q['RPPH_ID']; ?>" class="btn btn-primary mt-1 btn-sm">Detail</a>
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
        $('#example').DataTable();
    });
</script>