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
                    List Data
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
                    <h5 class="card-title">Edit Tujuan Program</h5>
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
                    <form action="updateTujuanProgramSemester" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $isiValue->SUBTHEME_ID ?>" name="subThemeID">
                                <label>Promes ID:</label>
                                <select data-placeholder="Pilih Promes" class="form-control form-control-select2" data-fouc name="promesNumber">

                                    <?php $queryGroup = $this->db->query("SELECT *FROM TBL_PROMES_SUBTHEME")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['SUBTHEME_ID'] ?>"><?php echo $group['SUBTHEME_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Sub Tema:</label>
                                <input type="text" class="form-control" placeholder="Semester" value="<?php echo $isiValue->SUBTHEME_NAME; ?>" name="namaSubTema">
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