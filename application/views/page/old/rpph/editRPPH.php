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
                <span class="breadcrumb-item">RPPM</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listProgram" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data
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
                    <form action="updateRPPM" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <input type="hidden" name="RPPMID" value="<?php echo $isi_value->RPPM_ID; ?>">
                            <div class="form-group">
                                <label>Kelas:</label>
                                <select data-placeholder="Pilih Kelas" class="form-control form-control-select2" data-fouc name="kelasID">
                                    <option value="<?php echo  $isi_value->CLASS_ID ?>"><?php echo  $isi_value->CLASS_NAME ?></option>
                                    <?php $queryGroup = $this->db->query("SELECT *FROM TBL_SCHOOLCLASS")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['CLASS_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tahun:</label>
                                <input type="text" class="form-control" value="<?php echo $isi_value->RPPM_STUDYYEAR; ?>" placeholder="Tahun" name="tahunRPPM">
                            </div>
                            <div class="form-group">
                                <label>Semester:</label>
                                <input type="text" class="form-control" placeholder="RPPM Semester" name="semesterRPPM" value="<?php echo $isi_value->RPPM_SEMESTER; ?>">
                            </div>
                            <div class="form-group">
                                <label>Bulan:</label>
                                <select data-placeholder="Pilih Bulan" class="form-control form-control-select2" data-fouc name="bulanRPPM">

                                    <?php $month = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'); ?>
                                    <option value="<?php echo  $isi_value->RPPM_MONTH; ?>"><?php echo $month[$isi_value->RPPM_MONTH]; ?></option>
                                    <?php for ($i = 1; $i <= 12; $i++) :
                                    ?>
                                        <option value="<?php echo $month[$i]; ?>"><?php echo $month[$i]; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Minggu:</label>
                                <select data-placeholder="Pilih Minggu" class="form-control form-control-select2" data-fouc name="mingguRPPM">
                                    <option value="<?php echo  $isi_value->RPPM_WEEK; ?>"><?php echo  $isi_value->RPPM_WEEK; ?></option>
                                    <?php $month = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                    for ($i = 1; $i <= 4; $i++) :
                                    ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tema:</label>
                                <input value="<?php echo $isi_value->RPPM_THEME; ?>" type="text" class="form-control" placeholder="Tema RPPM" name="temaRPPM">
                            </div>

                            <div class="form-group">
                                <label>Sub Tema:</label>
                                <input value="<?php echo $isi_value->RPPM_SUBTHEME; ?>" type="text" class="form-control" placeholder="Sub Tema RPPM" name="subTemaRPPM">
                            </div>

                            <div class="form-group">
                                <label>Model Pembelajaran:</label>
                                <input value="<?php echo $isi_value->RPPM_STUDYMODEL; ?>" type="text" class="form-control" placeholder="Model Pembelajaran" name="modelPembelajaran">
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