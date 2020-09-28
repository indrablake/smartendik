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
                    <h5 class="modal-title">Tambah RPPH Valuation Indicator</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="simpanRPPHValIndicator" method="POST" enctype="multipart/form-data">
                    <input type="text" id=kodeRppm name="RPPHID" hidden>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Deskripsi Valuasi Indikator:</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Deskripsi Valuasi Indikator" name="descValuasi">
                            </div>
                        </div>
                        <label for="">Detail</label>
                        <div class="container" id="dynamicField">
                            <div class="row mb-2">

                                <div class="col-md-10 mt-2">
                                    <input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Detail Kode">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                                </div>

                                <div class="col-md-10 mt-2">
                                    <input type="text" name="detailTeknik[]" id="detailTeknik" placeholder="Detail Teknik" class="form-control">
                                </div>
                                <div class="col-md-10 mt-2">
                                    <input type="text" name="detailIndikator[]" id="detailIndikator" placeholder="Detail Indikator" class="form-control">
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




<!-- Modal Detail -->

<?php
foreach ($query as $i) :
    $rpph_id = $i['RPPH_ID'];
    $rpphvalindikator_index = $i['RPPHVALINDICATOR_INDEX'];
    $rpphvalindikator_desc = $i['RPPHVALINDICATOR_DESC'];

?>
    <div id="modal_detail<?php echo $rpphvalindikator_index; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data RPPH Valuasi Indicator</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPHValDetail">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rpphvalindikator_index ?>" name="RPPHValIndikatorID">
                        <div class="form-group">
                            <label>Deskripsi Valuasi:</label>
                            <input type="text" disabled class="form-control" placeholder="Nama Aktifitas" value="<?php echo $rpphvalindikator_desc; ?>" name="descValuasi">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <?php $result2 = $this->db->query("SELECT *FROM TBL_RPPHVALINDICATORDETAIL WHERE RPPHVALINDICATOR_INDEX = '$rpphvalindikator_index'")->result_array();
                                foreach ($result2 as $query) :
                                ?>

                                    <input type="hidden" name="RPPHVALINDEX[]" id="indexActivity<?php echo $query['RPPHVALINDICATOR_INDEX']; ?>" value="<?php echo $query['RPPHVALINDICATOR_INDEX']; ?>">
                                    <div class="col-md-3 mt-1">
                                        Code
                                    </div>
                                    <div class="col-md-7 mt-1" id="input<?php echo $query['RPPHVALINDDET_CODE']; ?>">
                                        <div style="text-align: right;">
                                            <input readonly type="text" name="detailCode[]" id="name" class="form-control" value="<?php echo $query['RPPHVALINDDET_CODE']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-1" id="button<?php echo $query['RPPHVALINDDET_CODE'];  ?>">
                                        <button class="btn btn-sm btn-danger btn_delete " id="<?php echo $query['RPPHVALINDDET_CODE'] ?>">Hapus</button>
                                    </div>
                                    <div class="col-md-3  mt-2">
                                        Indikator
                                    </div>
                                    <div class="col-md-7 mt-2" id="input<?php echo $query['RPPHVALINDDET_CODE']; ?>">
                                        <div style="text-align: right;">
                                            <input type="text" name="detailIndikator[]" id="name" class="form-control" value="<?php echo $query['RPPHVALINDDET_INDICATOR']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3  mt-2">
                                        Teknik
                                    </div>
                                    <div class="col-md-7 mt-2" id="input<?php echo $query['RPPHVALINDDET_CODE']; ?>">
                                        <div style="text-align: right;">
                                            <input type="text" name="detailTeknik[]" id="name" class="form-control" value="<?php echo $query['RPPHVALINDDET_TECHNIQUE']; ?>">
                                        </div>
                                    </div>


                                <?php endforeach; ?>
                                <div class="col-md-12 mt-2">
                                    <button class="btn btn-primary btn-sm" style="width:100%">
                                        Update Data
                                    </button>
                                </div>

                            </div>
                        </div>
                </form>
                <form method="POST" action="simpanRPPHValDetail">
                    <div class="row mb-2 mt-2" id="dynamicFieldEdit">
                        <input type="hidden" value="<?php echo $rpph_id ?>" name="RPPHID">
                        <input type="hidden" value="<?php echo $rpphvalindikator_index ?>" name="RPPHVALINDEX">

                        <div class="col-md-10 ">
                            <input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Detail Valuasi Code">
                        </div>
                        <div class="col-md-2" style="text-align:right">
                            <button class="btn btn-sm btn-primary tambahEditAct" type="button">Tambah</button>
                        </div>
                        <div class="col-md-10 mt-2">
                            <input type="text" name="detailTeknik[]" id="name" placeholder="Detail Valuasi Teknik" class="form-control">
                        </div>

                        <div class="col-md-10 mt-2">
                            <input type="text" name="detailIndikator[]" placeholder="Detail Valuasi Indikator" id="name" class="form-control">
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
$query2 = $this->db->query("SELECT rvi.*,s.SCH_NAME,r.RPPH_ID, sc.CLASS_LEVEL,sc.CLASS_NAME,r.RPPH_STUDYYEAR,r.RPPH_THEME FROM TBL_RPPHVALUATIONINDICATOR rvi INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvi.RPPH_ID        
 INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=r.CLASS_ID
         INNER JOIN tbl_school s ON s.SCH_ID=sc.SCH_ID
 ")->result_array();
foreach ($query2 as $i) :
    $rpph_id = $i['RPPH_ID'];
    $rpphvalindicator_index = $i['RPPHVALINDICATOR_INDEX'];
    $rpphvalinddet_desc = $i['RPPHVALINDICATOR_DESC'];
    $class_level = $i['CLASS_LEVEL'];
    $class_name = $i['CLASS_NAME'];
    $sch_name = $i['SCH_NAME'];

?>
    <div id="modal_edit<?php echo $rpphvalindicator_index; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data RPPH Valuasi Indikator</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPHValIndicator">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rpphvalindicator_index ?>" name="RPPHValIndikatorID">
                        <div class="form-group">
                            <label>RPPH ID:</label>
                            <select data-placeholder="Pilih RPPH ID" class="form-control form-control-select2" data-fouc name="RPPHID">
                                <option value="<?php echo $rpph_id ?>"><?php echo $sch_name . '-' . $class_level . '-' . $class_level; ?></option>
                                <?php $queryGroup = $this->db->query("SELECT *from tbl_rpph INNER JOIN tbl_schoolclass ON tbl_schoolclass.CLASS_ID=tbl_rpph.CLASS_ID
INNER JOIN tbl_school ON tbl_school.SCH_ID=tbl_schoolclass.SCH_ID")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['SCH_NAME'] . '-' . $group['CLASS_NAME'] . '-' . $group['CLASS_LEVEL'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valuasi Indikator Deskripsi:</label>
                            <input type="text" class="form-control" placeholder="Valuasi Indikator Deskripsi" value="<?php echo $rpphvalinddet_desc ?>" name="valIndicatorDesc">
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
        console.log("OK");
        var search = $("#rpphid").val();
        console.log(search);
        load_data(search);
        $("#kodeRppm").val(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPPH/fetchValIndicator",
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

    })


    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            // $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Masukan Aktfitas"><input type="hidden" name="idAktifitas[]" id="idAktifitas" value' + i + ' class="form-control" placeholder="Masukan Aktfitas"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')

            $('#dynamicField').append('<div class="row mb-2" id="row' + j + '"><div class="col-md-10 mt-2"><input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Masukan Kode Detail"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div><div class="col-md-10 mt-2"><input type="text" name="detailTeknik[]" id="name" class="form-control" placeholder="Masukan Detail Teknik"></div><div class="col-md-10 mt-2"><input type="text" name="detailIndikator[]" id="name" class="form-control" placeholder="Masukan Detail Indikator"></div></div></div>')



        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

        $('.tambahEditAct').click(function() {
            console.log("OK");
            i++;
            $('#dynamicFieldEdit').append('<div class="row mb-2" id="row' + j + '"><div class="col-md-10 mt-2"><input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Detail Valuasi Kode"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div><div class="col-md-10 mt-2"><input type="text" name="detailTeknik[]" id="name" class="form-control" placeholder="Detail Valuasi Teknik"></div><div class="col-md-10 mt-2"><input type="text" name="detailIndikator[]" id="name" class="form-control" placeholder=" Detail Valuasi Indikator"></div></div></div>')
        });
        $(document).on('click', '.btn_remove2', function() {
            var button_id = $(this).attr("id");
            $("#rowEdit" + button_id + "").remove();
            $("#rowEdit" + button_id + "").remove();
        })



    });
</script>