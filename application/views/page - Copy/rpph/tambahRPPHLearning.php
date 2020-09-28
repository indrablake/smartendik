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
                <a href="listRPPHLearning" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data RPPH Pembelajaran
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
                                <div class="col-md-11">
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
                                <div class="col-md-1">
                                    <div class="form-group" style="margin-top:5px">

                                        <button type="button" id="searchBtn" class="btn btn-primary mt-3">Search</button>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>

                    <div id="hasilData">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_tambah" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah RPPH Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="simpanRPPHLearning" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" id=kodeRppm name="RPPHID" hidden>
                        <div class="container" id="dynamicField">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Kode Pembelajaran:</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="" class="form-control" placeholder="Kode Pembelajaran" name="kodeLearning[]">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                                </div>
                                <div class="col-md-12">
                                    <label>Materi Pembelajaran:</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Materi Pembelajaran" name="teoriLearning[]">
                                </div>

                                <div class="col-md-12">
                                    <label>Tujuan Pembelajaran:</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Tujuan Pembelajaran" name="tujuanLearning[]">
                                </div>
                            </div>
                        </div>
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


<?php

foreach ($query as $i) :
    $rpph_id = $i['RPPH_ID'];
    $rpph_sch_name = $i['SCH_NAME'];
    $rpph_class_level = $i['CLASS_LEVEL'];
    $rpph_class_name = $i['CLASS_NAME'];
    $rpphlearning_id = $i['RPPHLEARNING_ID'];
    $rpphlearning_code = $i['RPPHLEARNING_CODE'];
    $rpphlearning_theory = $i['RPPHLEARNING_THEORY'];
    $rpphlearning_goal = $i['RPPHLEARNING_GOAL'];

?>
    <div id="modal_edit<?php echo $rpphlearning_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data RPPH Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPHLearning">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rpphlearning_id ?>" name="RPPHLearningID">
                        <div class="form-group">
                            <label>RPPH ID:</label>
                            <select data-placeholder="Pilih RPPH ID" class="form-control form-control-select2" data-fouc name="RPPHID">
                                <option value="<?php echo $rpph_id ?>"><?php echo $rpph_id . '-' . $rpph_sch_name . '-' . $rpph_class_level . '-' . $rpph_class_name ?></option>
                                <?php $queryGroup = $this->db->query("SELECT r.* , s.SCH_NAME,sc.CLASS_LEVEL,sc.CLASS_NAME
                                FROM TBL_RPPH r
                                INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
                                INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['RPPH_ID'] . '-' . $group['SCH_NAME'] . '-' . $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Pembelajaran:</label>
                            <input type="text" class="form-control" placeholder="Kode Pembelajaran" value="<?php echo $rpphlearning_code ?>" name="kodeLearning">
                        </div>
                        <div class="form-group">
                            <label>Materi Pembelajaran:</label>
                            <input type="text" class="form-control" placeholder="Materi Pembelajaran" value="<?php echo $rpphlearning_theory ?>" name="teoriLearning">
                        </div>
                        <div class="form-group">
                            <label>Tujuan Pembelajaran:</label>
                            <input type="text" class="form-control" placeholder="Tujuan Pembelajaran" value="<?php echo $rpphlearning_goal ?>" name="tujuanLearning">
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
    $("#searchBtn").click(function() {
        var search = $("#rpphid").val();
        console.log(search);
        $("#kodeRppm").val(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPPH/fetchLearning",
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#hasilData").html(data);
                $("#btnTambah").show();
            }
        })
    }

    $("#btnTambah").click(function() {
        var search = $("#rpphid").val();
        $("#kodeRppm").val(search);
    })

    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="row mb-2" id="row' + j + '"><div class="col-md-10 mt-2"><input type="text" name="kodeLearning[]" id="name" class="form-control" placeholder="Masukan Kode Pembelajaran"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div><div class="col-md-10 mt-2"><input type="text" name="teoriLearning[]" id="name" class="form-control" placeholder="Masukan Pembelajaran"></div><div class="col-md-10 mt-2"><input type="text" name="tujuanLearning[]" id="name" class="form-control" placeholder="Masukan Tujuan Pembelajaran"></div></div></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

    });
</script>