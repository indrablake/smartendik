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
                <a href="tambahRPPHMaterial" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah RPPH Bahan Pembelajaran
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
                            <th>RPPH ID</th>
                            <th>Kegiatan </th>
                            <th>Alat, Bahan & Materi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($query as $q) :
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $q['RPPH_ID'] . '-' . $q['SCH_NAME'] . '-' . $q['CLASS_LEVEL'] . '-' . $q['CLASS_NAME']; ?></td>
                                <td><?php echo $q['RPPHMATERIAL_ACTIVITY']; ?></td>
                                <td><?php echo $q['RPPHMATERIAL_TOOLS']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- 
<?php

foreach ($query as $i) :
    $rpph_id = $i['RPPH_ID'];

    $rpphmaterial_id = $i['RPPHMATERIAL_ID'];
    $rpphmaterial_activity = $i['RPPHMATERIAL_ACTIVITY'];
    $rpphmaterial_tools = $i['RPPHMATERIAL_TOOLS'];

?>
    <div id="modal_edit<?php echo $rpphmaterial_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data RPPH Material</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPHMaterial">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rpphmaterial_id ?>" name="RPPHMaterialID">
                        <div class="form-group">
                            <label>RPPH ID:</label>
                            <select data-placeholder="Pilih RPPH ID" class="form-control form-control-select2" data-fouc name="RPPHID">
                                <option value="<?php echo $rpph_id ?>"><?php echo $rpph_id ?></option>
                                <?php $queryGroup = $this->db->query("SELECT *FROM TBL_RPPH")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['RPPH_ID'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Aktifitas Material:</label>
                            <input type="text" class="form-control" placeholder="Teori Material" value="<?php echo $rpphmaterial_activity ?>" name="aktifitasMaterial">
                        </div>
                        <div class="form-group">
                            <label>Peralatan Material:</label>
                            <input type="text" class="form-control" placeholder="Tujuan Material" value="<?php echo $rpphmaterial_tools ?>" name="peralatanMaterial">
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
<?php endforeach; ?> -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>