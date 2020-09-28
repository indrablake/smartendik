<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>

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
                <span class="breadcrumb-item">KelasSiswa</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listKelasSiswa" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data KelasSiswa
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
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Tambah Data</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                    </div>
                    <form action="simpanKelasSiswa" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label>Tahun:</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select data-placeholder="Pilih Tahun" class="form-control form-control-select2" name="tahunKelasSiswa" data-fouc id="tahunAjaran" onchange="tahun()">
                                            <?php
                                            $tahun = date('Y');
                                            for ($i = 1990; $i <= $tahun; $i++) : ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunKelasSiswa2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kelas:</label>
                                <select data-placeholder="Pilih Kelas" class="form-control form-control-select2" data-fouc name="kelasID">

                                    <?php $queryGroup = $this->db->query("SELECT sc.*,s.SCH_NAME FROM TBL_SCHOOLCLASS sc INNER JOIN TBL_SCHOOL s ON s.SCH_ID= sc.SCH_ID")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['SCH_NAME'] . " - " . $group['CLASS_LEVEL'] . " - " . $group['CLASS_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Siswa:</label>
                                <select data-placeholder="Pilih Siswa" class="form-control form-control-select2" data-fouc name="siswaID">

                                    <?php $queryGroup = $this->db->query("SELECT *FROM tbl_student")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['STD_ID'] ?>"><?php echo $group['STD_NISN'] . '-' . $group['STD_FIRSTNAME'] . $group['STD_LASTNAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                        </fieldset>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
        document.getElementById("tahunAjaran2").html = tahun + 1;
    }
</script>