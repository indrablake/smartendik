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
                <span class="breadcrumb-item">Program</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listProgram" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Program
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Edit Data Program</h5>
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
                    <form action="updateProgramSemester" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $isiValue->PROMES_ID ?>" name="promesID">
                                <label>Nama Sekolah:</label>
                                <select data-placeholder="Pilih Program Group" class="form-control form-control-select2" data-fouc name="namaSekolah">

                                    <?php $queryGroup = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['SCH_ID'] ?>"><?php echo $group['SCH_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelas:</label>
                                <select data-placeholder="Pilih Program Group" class="form-control form-control-select2" data-fouc name="namaKelas">
                                    <option value="<?php echo $isiValue->CLASS_ID; ?>"><?php echo $isiValue->CLASS_LEVEL . '-' . $isiValue->CLASS_NAME; ?></option>
                                    <?php
                                    foreach ($queryKelas as $group) : ?>
                                        <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Semester:</label>
                                <input type="text" value="<?php echo $isiValue->PROMES_SEMESTER; ?>" class="form-control" placeholder="Semester" name="semesterProgram">
                            </div>

                            <div class="form-group">
                                <label>Tahun:</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php $tahun1 = substr($isiValue->PROMES_YEAR, 0, 4); ?>
                                        <select data-placeholder="Pilih Tahun" class="form-control form-control-select2" name="tahunProgram" data-fouc id="tahunAjaran" onchange="tahun()">
                                            <option value="<?php echo $tahun1 ?>"><?php echo $tahun1; ?></option>
                                            <?php
                                            $tahun = date('Y');
                                            for ($i = 1990; $i <= $tahun; $i++) : ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunProgram2" value="<?php echo intval($tahun1) + 1 ?>">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Strategi Pembelajaran:</label>
                                <textarea type="text" class="form-control" placeholder="Strategi Pembelajaran" name="strategiPembelajaran"><?php echo $isiValue->PROMES_STRATEGY; ?></textarea>
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