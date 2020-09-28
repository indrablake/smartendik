<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/notifications/bootbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/switch.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_checkboxes_radios.js"></script>
<script src="<?php echo base_url() ?>assets/js/app.js"></script>
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
                <span class="breadcrumb-item">Program Semester</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listRPPHLearning" class="btn btn-primary">
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


                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>Kode Tujuan:</label>
                                        <select data-placeholder="Pilih Program Semester" class="form-control form-control-select2" id="goalid" data-fouc name="PROMESID">
                                            <?php
                                            foreach ($queryGoal as $group) : ?>
                                                <option value="<?php echo $group['GOAL_ID'] ?>"><?php echo $group['GOAL_DESC'] . ' - ' . $group['SUBTHEME_NAME']; ?></option>
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
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kompetensi Dasar</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="simpanKompetensiProgramSemester" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" id=kodeRppm name="goalID" hidden>
                        <div class="row mb-2" id="dynamicField">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Kode Kompetensi:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="kodeKompetensi[]" id="name" class="form-control" placeholder="Kode Kompetensi">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Kompetensi Dasar:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" id="" class="form-control" placeholder="Kompetensi Dasar" name="descKompetensi[]">
                                    </div>
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
    $competency_id = $i['COMPETENCY_ID'];
    $competency_code = $i['COMPETENCY_CODE'];
    $competency_desc = $i['COMPETENCY_DESC'];

?>
    <div id="modal_edit<?php echo $competency_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kompetensi Dasar</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateKompetensiProgramSemester">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $competency_id ?>" name="kompetensiID">
                        <div class="form-group">
                            <label>Kompetensi Dasar:</label>
                            <input type="text" id="" class="form-control" placeholder="Kompetensi Dasar" value="<?php echo $competency_code; ?>" name="kodeKompetensi">
                        </div>

                        <div class="form-group">
                            <label>Evaluasi Bulanan:</label>
                            <input type="text" class="form-control" placeholder="Dekripsi Kompetensi" value="<?php echo $competency_desc; ?>" name="descKompetensi">
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
        var search = $("#goalid").val();
        $("#kodeRppm").val(search);
        console.log(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>Program/fetchKompetensiDasar",
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
        var search = $("#goalid").val();

    })


    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="col-md-12 mt-1" id="row' + i + '"><div class="row"><div class="col-md-12"><label>Kode Kompetensi:</label></div><div class="col-md-10 "><input type="text" name="kodeKompetensi[]" id="name" class="form-control" placeholder="Kode Kompetensi"></div><div id="row2' + i + '" class="col-md-1 "><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div> <div class="col-md-12"><label>Kompetensi Dasar:</label></div><div class="col-md-10"><input type="text" id="" class="form-control" placeholder="Kompetensi Dasar" name="descKompetensi[]"></div></div></div>')


            // $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="deskripsiTujuan[]" id="name" class="form-control" placeholder="Masukan Capaian Perkembangan"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

    });
</script>