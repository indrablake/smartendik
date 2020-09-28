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
                    List Kompetensi Program
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
                    <h5 class="card-title">Edit Kompetensi Program</h5>
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
                    <form action="updateKompetensiProgramSemester" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $isiValue->COMPETENCY_ID ?>" name="promesID">
                                <label>Kode Tujuan:</label>
                                <select data-placeholder="Kode Tujuan" class="form-control form-control-select2" data-fouc name="kodeTujuan">
                                    <option value="<?php echo $isiValue->GOAL_ID; ?>"><?php echo $isiValue->GOAL_ID; ?></option>
                                    <?php $queryGroup = $this->db->query("SELECT *FROM TBL_PROMES_GOAL")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['SCH_ID'] ?>"><?php echo $group['SCH_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kode Kompetensi:</label>
                                <input type="text" class="form-control" placeholder="Semester" value="<?php echo $isiValue->COMPETENCY_CODE; ?>" name="kodeKompetensi">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Kompetensi:</label>
                                <input type="text" class="form-control" value="<?php echo $isiValue->COMPETENCY_DESC; ?>" placeholder=" Tema" name="deskripsiKompetensi">
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