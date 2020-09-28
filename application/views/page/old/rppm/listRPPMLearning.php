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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPPM</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">RPPM</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="tambahRPPMLearning" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah RPPM Pembelajaran
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
                            <th>RPPM ID</th>
                            <th>Kode</th>
                            <th>Materi</th>
                            <th>Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($query as $q) :
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $q['RPPM_ID']; ?></td>
                                <td><?php echo $q['RPPMLEARNING_CODE']; ?></td>
                                <td><?php echo $q['RPPMLEARNING_THEORY']; ?></td>
                                <td><?php echo $q['RPPMLEARNING_GOAL']; ?></td>
                                <!-- <td class="text-center">

                                    <button class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal_edit<?php echo $q['RPPMLEARNING_ID'] ?>">Edit</button>
                                    <a href="deleteRPPM?id=<?php echo $q['RPPMLEARNING_ID']; ?>" class="btn btn-danger mt-1 btn-sm">Hapus</a>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

foreach ($query as $i) :
    $rppm_id = $i['RPPM_ID'];

    $rppmlearning_id = $i['RPPMLEARNING_ID'];
    $rppmClass = $i['CLASS_LEVEL'];
    $rppmClassName = $i['CLASS_NAME'];
    $rppmlearning_code = $i['RPPMLEARNING_CODE'];
    $rppmlearning_theory = $i['RPPMLEARNING_THEORY'];
    $rppmlearning_goal = $i['RPPMLEARNING_GOAL'];

?>
    <div id="modal_edit<?php echo $rppmlearning_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data RPPM Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPMLearning">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rppmlearning_id ?>" name="RPPMLearningID">
                        <div class="form-group">
                            <label>RPPM ID:</label>
                            <select data-placeholder="Pilih RPPM ID" class="form-control form-control-select2" data-fouc name="RPPMID">
                                <option value="<?php echo $rppm_id ?>"><?php echo $rppm_id . '-' . $rppmClass . '-' . $rppmClassName ?></option>
                                <?php $queryGroup = $this->db->query("SELECT rp.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPM rp INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=rp.CLASS_ID")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['RPPM_ID'] ?>"><?php echo $group['RPPM_ID'] . '-' . $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Learning:</label>
                            <input type="text" class="form-control" placeholder="Kode Learning" value="<?php echo $rppmlearning_code ?>" name="kodeLearning">
                        </div>
                        <div class="form-group">
                            <label>Teori Learning:</label>
                            <input type="text" class="form-control" placeholder="Teori Learning" value="<?php echo $rppmlearning_theory ?>" name="teoriLearning">
                        </div>
                        <div class="form-group">
                            <label>Tujuan Learning:</label>
                            <input type="text" class="form-control" placeholder="Tujuan Learning" value="<?php echo $rppmlearning_goal ?>" name="tujuanLearning">
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>