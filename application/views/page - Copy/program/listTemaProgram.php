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
                <a href="tambahTemaProgramSemester" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah Tema Program
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
                            <th>Kelas</th>
                            <th>Tema</th>
                            <th>Evaluasi Bulanan</th>
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
                                <td><?php echo $q['CLASS_LEVEL'] . '-' . $q['CLASS_NAME']; ?></td>
                                <td><?php echo $q['THEME_THEME']; ?></td>
                                <td><?php echo $q['THEME_MONTHLY_EVALUATION']; ?></td>
                                <td class="text-center">

                                    <a href="deleteSubTemaProgramSemester?id=<?php echo $q['THEME_ID']; ?>" class="btn btn-danger mt-1 btn-sm">Hapus</a>
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
    $theme_id = $i['THEME_ID'];
    $theme_name = $i['THEME_THEME'];


?>
    <div id="modal_edit<?php echo $theme_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Tema Program Semester</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateTemaProgramSemester">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $theme_id ?>" name="subThemeID">
                        <div class="form-group">
                            <label>Promes ID:</label>
                            <select data-placeholder="Pilih Promes ID" class="form-control form-control-select2" data-fouc name="promesID">
                                <option value="<?php echo $promes_id ?>"><?php echo $promes_id ?></option>
                                <?php $queryGroup = $this->db->query("SELECT *FROM TBL_PROMES")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['PROMES_ID'] ?>"><?php echo $group['PROMES_ID'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tema Program Semester:</label>
                            <input type="text" class="form-control" placeholder="Semester" value="<?php echo $theme_name ?>" name="temaProgram">
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