<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>



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
                <a href="listSTTPATK" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List STTPATK
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
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Tambah Data STTPATK</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="simpanSTPPATK">
                        <div class="form-group">
                            <label>Sekolah:</label>
                            <select name="sch_id" data-placeholder="Pilih Sekolah" class="form-control form-control-select2" data-fouc>
                                <option></option>
                                <?php $result = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array(); ?>
                                <?php foreach ($result as $result) : ?>
                                    <option value="<?php echo $result['SCH_ID'] ?>"><?php echo $result['SCH_NAME']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select data-placeholder="Pilih Tahun" class="form-control form-control-select2" name="stppatk_year" data-fouc>
                                <?php
                                $tahun = date('Y');
                                for ($i = 1990; $i <= $tahun; $i++) : ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Tahun Pembelajaran</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select data-placeholder="Pilih Tahun" class="form-control form-control-select2" name="stppatk_studyyear" data-fouc id="tahunAjaran" onchange="tahun()">
                                        <?php
                                        $tahun = date('Y');
                                        for ($i = 1990; $i <= $tahun; $i++) : ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunRPPH2">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Angka</label>
                            <input type="number" placeholder="Angka Pembelajaran" class="form-control" name="stppatk_number">
                        </div>

                        <div class="form-group">
                            <label for="">Appointed Place</label>
                            <input type="text" placeholder="Lokas Pembelajaran" class="form-control" name="stppatk_appointedplace">
                        </div>

                        <div class="form-group">
                            <label for="">Appointed Date</label>
                            <input type="date" class="form-control" name="stppatk_appointeddate">
                        </div>

                        <div class="form-group">
                            <label for="">Head Master</label>
                            <input type="text" placeholder="Kepala" class="form-control" name="stppatk_headmaster">
                        </div>
                        <div class="form-group">
                            <label for="">Institution Head</label>
                            <input type="text" placeholder="Institution Kepala" class="form-control" name="stppatk_institutionhead">
                        </div>

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