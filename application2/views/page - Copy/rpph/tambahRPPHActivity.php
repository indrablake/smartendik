<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/picker_date.js"></script>

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
                <a href="listProgram" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data RPPH Kegiatan
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
                                                <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['RPPH_ID'] . ' - ' . $group['SCH_NAME'] . ' - ' . $group['CLASS_LEVEL'] . ' - ' . $group['CLASS_NAME']; ?></option>
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
                    <h5 class="modal-title">Tambah RPPH Activity</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="simpanRPPHActivity" method="POST" enctype="multipart/form-data">
                    <input type="text" id=kodeRppm name="RPPHID" hidden>
                    <div class="modal-body">
                        <fieldset>
                            <div class="form-group">
                                <label>Nama Aktifitas:</label>
                                <input type="text" class="form-control" placeholder="Nama Aktifitas" name="activityName">
                            </div>

                            <div class="form-group">
                                <label>Waktu Aktifitas:</label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-alarm"></i></span>
                                            </span>
                                            <input type="text" class="form-control pickatime" placeholder="Try me&hellip;" name="activityTime">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">-</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-alarm"></i></span>
                                            </span>
                                            <input type="text" class="form-control pickatime" placeholder="Try me&hellip;" name="activityTime2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2" id="dynamicField">
                                <div class="col-md-12">
                                    <label>Aktifitas:</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="aktifitas[]" id="name" class="form-control">
                                    <input type="hidden" name="idAktifitas[]" id="idAktifitas">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                                </div>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-primary">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- <?php

        $rpph_id = $queryDetail->RPPH_ID;
        $rpphactivity_id = $queryDetail->RPPHACTIVITY_ID;
        $rpphactivity_name = $queryDetail->RPPHACTIVITY_NAME;

        ?>
<div id="modal_detail<?php echo $rpphactivity_id; ?>" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data RPPH Activity</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="simpanRPPHActivity" method="POST" enctype="multipart/form-data">
                <input type="text" id=kodeRppm name="RPPHID" hidden>
                <div class="modal-body">
                    <fieldset>

                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->



<?php
foreach ($query as $i) :
    $rpph_id = $i['RPPH_ID'];
    $rpphactivity_id = $i['RPPHACTIVITY_ID'];
    $rpphactivity_name = $i['RPPHACTIVITY_NAME'];

?>
    <div id="modal_detail<?php echo $rpphactivity_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data RPPH Activity</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPHActivityDetail">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rpphactivity_id ?>" name="RPPHActivityID">
                        <div class="form-group">
                            <label>Nama Aktifitas:</label>
                            <input type="text" disabled class="form-control" placeholder="Nama Aktifitas" value="<?php echo $rpphactivity_name; ?>" name="activityName">
                        </div>

                        <div class="form-group">
                            <label for="">Aktifitas</label>
                            <div class="row">

                                <?php $result2 = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID = '$rpphactivity_id'")->result_array();
                                foreach ($result2 as $query) :
                                ?>

                                    <input type="hidden" name="RPPHACTINDEX[]" id="indexActivity<?php echo $query['RPPHACTDETAIL_INDEX']; ?>" value="<?php echo $query['RPPHACTDETAIL_INDEX']; ?>">
                                    <div class="col-md-10" id="input<?php echo $query['RPPHACTDETAIL_INDEX']; ?>">
                                        <div style="text-align: right;">
                                            <input type="text" name="aktifitas[]" id="name" class="form-control" value="<?php echo $query['RPPHACTDETAIL_DESC']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1" id="button<?php echo $query['RPPHACTDETAIL_INDEX'];  ?>">
                                        <button class="btn btn-sm btn-danger btn_delete " id="<?php echo $query['RPPHACTDETAIL_INDEX'] ?>">Hapus</button>
                                    </div>

                                <?php endforeach; ?>


                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary btn-sm" style="width:100%">
                                Update Data
                            </button>
                        </div>
                </form>
                <form method="POST" action="simpanDetailRPPHActivity">
                    <div class="row mb-2 mt-2" id="dynamicFieldEdit">
                        <input type="hidden" value="<?php echo $rpphactivity_id ?>" name="RPPHActivityID">
                        <div class="col-md-12">
                            <label>Aktifitas:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="aktifitasDetail[]" id="name" class="form-control">
                            <input type="hidden" name="idAktifitas[]" id="idAktifitas">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm text-right tambahEditAct" type="button">Tambah</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-success" style="width:100%">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>


<?php
foreach ($query2 as $i) :
    $rpph_id = $i['RPPH_ID'];
    $rpphactivity_id = $i['RPPHACTIVITY_ID'];
    $rpphactivity_name = $i['RPPHACTIVITY_NAME'];
    $rpph_sch_name = $i['SCH_NAME'];
    $rpph_class_level = $i['CLASS_LEVEL'];
    $rpph_class_name = $i['CLASS_NAME'];
    $rpphactivity_time = $i['RPPHACTIVITY_TIME'];

?>
    <div id="modal_edit<?php echo $rpphactivity_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data RPPH Activity</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPHActivity">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rpphactivity_id ?>" name="RPPHActivityID">
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
                        </div>
                        <div class="form-group">
                            <label>Nama Aktifitas:</label>
                            <input type="text" class="form-control" placeholder="Hari" value="<?php echo $rpphactivity_name ?>" name="activityName">
                        </div>
                        <div class="form-group">
                            <label>Waktu:</label>
                            <input type="text" class="form-control" placeholder="Semester" value="<?php echo $rpphactivity_time ?>" name="activityTime">
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
            url: "<?php echo base_url(); ?>RPPH/fetchActivity",
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
            $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="aktifitas[]" id="name" class="form-control" placeholder="Masukan Aktfitas"><input type="hidden" name="idAktifitas[]" id="idAktifitas" value' + i + ' class="form-control" placeholder="Masukan Aktfitas"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });


        $('.tambahEditAct').click(function() {
            console.log("OK");
            j++
            $('#dynamicFieldEdit').append('<div class="col-md-10 mt-2" id="row' + j + '"><input type="text" name="aktifitasDetail[]" id="name" class="form-control" placeholder="Masukan Aktfitas"><input type="hidden" name="idAktifitas[]" id="idAktifitas" value' + j + ' class="form-control" placeholder="Masukan Aktfitas"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove2', function() {
            var button_id = $(this).attr("id");
            $("#rowEdit" + button_id + "").remove();
            $("#rowEdit" + button_id + "").remove();
        })


        $(document).on('click', '.btn_delete', function() {
            var id = $(this).attr('id');
            console.log(id);
            var activityIndex = $('#indexActivity' + id).val();
            $("#input" + id + "").remove();
            $("#button" + id + "").remove();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('deleteRowDetail') ?>",
                dataType: "JSON",
                data: {
                    activityIndex: activityIndex
                },
                success: function(data) {

                }
            });
            return false;

        });


    });
</script>