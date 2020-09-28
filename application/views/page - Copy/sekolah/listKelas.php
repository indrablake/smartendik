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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sekolah</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Sekolah</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_default">Tambah Data <i class="icon-play3 ml-2"></i></button>
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

                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Sekolah</th>
                            <th class="text-center">Jenjang Kelas</th>
                            <th class="text-center">Nama Kelas</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataKelas as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['SCH_NAME']; ?></td>
                                <td class="text-center"><?php echo $q['CLASS_LEVEL']; ?></td>
                                <td class="text-center"><?php echo $q['CLASS_NAME']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $q['CLASS_ID'] ?>">Edit </button>
                                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Tambah Data -->
<div id="modal_default" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kelas Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="simpanKelas">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Sekolah:</label>
                        <select data-placeholder="Pilih Sekolah" class="form-control form-control-select2" data-fouc name="namaSekolah">

                            <?php $queryGroup = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['SCH_ID'] ?>"><?php echo $group['SCH_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenjang Kelas:</label>
                        <input type="text" class="form-control" placeholder="Kelas Sekolah" name="levelKelas">
                    </div>

                    <div class="form-group">
                        <label>Nama Kelas:</label>
                        <input type="text" class="form-control" placeholder="Nama Kelas" name="namaKelas">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Data -->
<?php

foreach ($dataKelas as $i) :
    $class_id = $i['CLASS_ID'];
    $class_name = $i['CLASS_NAME'];
    $class_level = $i['CLASS_LEVEL'];
    $sch_name = $i['SCH_NAME'];
    $sch_id = $i['SCH_ID'];

?>
    <div id="modal_edit<?php echo $class_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kelas Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="editKelas">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $class_id ?>" name="idSekolah">
                        <div class="form-group">
                            <label>Nama Sekolah:</label>
                            <select data-placeholder="Pilih Nama Kelas" class="form-control form-control-select2" data-fouc name="namaSekolah">
                                <option value="<?php echo $sch_id ?>"><?php echo $sch_name ?></option>
                                <?php $queryGroup = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['SCH_ID'] ?>"><?php echo $group['SCH_NAME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenjang Kelas:</label>
                            <input type="number" class="form-control" placeholder="Kelas Sekolah" name="levelKelas" value="<?php echo $class_level; ?>">
                        </div>

                        <div class="form-group">
                            <label>Nama Kelas:</label>
                            <input type="text" class="form-control" placeholder="Nama Kelas" name="kelasSekolah" value="<?php echo $class_name; ?>">
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
<!-- /basic modal -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>