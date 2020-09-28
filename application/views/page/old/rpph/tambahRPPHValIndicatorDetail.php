<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
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
                <span class="breadcrumb-item">RPPH</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listRPPHValIndicatorDetail" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data Penilaian Detail Indicator
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
                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>RPPH ID:</label>
                                        <select data-placeholder="Pilih RPPH ID" class="form-control form-control-select2" id="rpphid" data-fouc name="RPPHID">
                                            <?php $queryGroup = $this->db->query("SELECT rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM tbl_rpph rpm INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
                                    INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID
                                    ")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['RPPH_ID'] . ' - ' . $group['SCH_NAME'] . ' - ' . $group['CLASS_LEVEL'] . ' - ' . $group['CLASS_LEVEL']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>RPPH Indicator Index:</label>
                                        <select data-placeholder="Pilih RPPH Indicator Index" class="form-control form-control-select2" id="rpphindex" data-fouc name="RPPHINDEX">
                                            <?php $queryGroup = $this->db->query("SELECT rvi.RPPHVALINDICATOR_INDEX,rvi.RPPHVALINDICATOR_DESC FROM TBL_RPPHVALUATIONINDICATOR as rvi")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['RPPHVALINDICATOR_INDEX'] ?>"><?php echo $group['RPPHVALINDICATOR_INDEX'] . ' - ' . $group['RPPHVALINDICATOR_DESC']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group" style="margin-top:5px">

                                        <button type="button" id="searchBtn" class="btn btn-primary mt-3">Search</button>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>

                    <button style="text-align:right;display: none;" class="btn btn-primary btn-lg mb-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button>
                    <div id="hasilData">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_tambah" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah RPPH Valuasi Indikator Detail</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="simpanRPPHValIndicatorDetail" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>
                            <input type="text" id="kodeRppm" name="RPPHID" hidden>
                            <input type="text" id="kodeIndex" name="valIndicatorIndex" hidden>
                            <div class="form-group">
                                <label>Valuasi Index Indikator:</label>
                                <input type="text" class="form-control" placeholder="Valuasi Index Indikator" name="valIndDetCode">
                            </div>
                            <div class="form-group">
                                <label>Valuasi Deskripsi Indikator:</label>
                                <input type="text" class="form-control" placeholder="Valuasi Deskripsi Indikator" name="valIndDetIndicator">
                            </div>

                            <div class="form-group">
                                <label>Valuasi Deskripsi Technique:</label>
                                <input type="text" class="form-control" placeholder="Valuasi Deskripsi Indikator" name="valIndDetTech">
                            </div>
                        </fieldset>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#searchBtn").click(function() {
        var search = $("#rpphid").val();
        var search2 = $("#rpphindex").val();
        $("#kodeRppm").val(search);
        $("#kodeIndex").val(search2);
        console.log(search);
        load_data(search, search2);
    });

    function load_data(query, query2) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPPH/fetchValIndicatorDetail",
            method: "POST",
            data: {
                query: query,
                query2: query2
            },
            success: function(data) {
                $("#hasilData").html(data);
                $("#btnTambah").show();
            }
        })
    }

    $("#btnTambah").click(function() {
        var search = $("#rpphid").val();
        var search2 = $("#rpphindex").val();

    })
</script>