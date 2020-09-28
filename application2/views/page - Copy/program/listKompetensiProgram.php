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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Program</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Program</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="tambahTujuanProgramSemester" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah Tujuan Program
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
                            <th>Kode Tujuan</th>
                            <th>Kode Kompetensi</th>
                            <th>Deskripsi Kompetensi</th>
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
                                <td><?php echo $q['GOAL_ID']; ?></td>
                                <td><?php echo $q['COMPETENCY_CODE']; ?></td>
                                <td><?php echo $q['COMPETENCY_DESC']; ?></td>
                                <td class="text-center">
                                    <a href="hapusProgramSemester?id=<?php echo $q['COMPETENCY_ID']; ?>" class="btn btn-danger mt-1 btn-sm">Hapus</a>
                                </td>
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
    $competency_id = $i['COMPETENCY_ID'];
    $competency_code = $i['COMPETENCY_CODE'];
    $goal_id = $i['GOAL_ID'];
    $competency_desc = $i['COMPETENCY_DESC'];

?>
    <div id="modal_edit<?php echo $competency_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kompetensi Program Semester</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateKompetensiProgramSemester">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $competency_id ?>" name="idKompetensi">
                        <div class="form-group">
                            <label>Kode Tujuan:</label>
                            <select data-placeholder="Kode Tujuan" class="form-control form-control-select2" data-fouc name="kodeTujuan">
                                <option value="<?php echo $goal_id ?>"><?php echo $goal_id ?></option>
                                <?php $queryGroup = $this->db->query("SELECT *FROM TBL_PROMES_GOAL")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['GOAL_ID'] ?>"><?php echo $group['GOAL_ID'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kode Kompetensi:</label>
                            <input type="text" class="form-control" value="<?php echo $competency_code; ?>" placeholder="Kode Kompetensi" name="kodeKompetensi">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Kompetensi:</label>
                            <input type="text" class="form-control" value="<?php echo $competency_code; ?>" placeholder="Deskripsi Kompetensi" name="descKompetensi">
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