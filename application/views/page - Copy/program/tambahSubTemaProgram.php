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
                                        <label>Tema:</label>
                                        <select data-placeholder="Pilih Tema" class="form-control form-control-select2" id="temaID" data-fouc name="PROMESID">
                                            <?php
                                            foreach ($queryTheme as $group) : ?>
                                                <option value="<?php echo $group['THEME_ID'] ?>"><?php echo $group['THEME_THEME']; ?></option>
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
                    <h5 class="modal-title">Tambah Sub Tema Program Semester</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="simpanSubTemaProgramSemester" method="POST" enctype="multipart/form-data">
                    <input type="text" id=kodeRppm name="themeID" hidden>
                    <div class="modal-body">
                        <div class="row mb-2" id="dynamicField">
                            <div class="col-md-12">
                                <label>SubTema Program Semester:</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="subTemaPromes[]" id="name" class="form-control" placeholder="SubTema Program Semester">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
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

    $subTheme_id = $i['SUBTHEME_ID'];
    $themeName = $i['THEME_THEME'];
    $subThemeName = $i['SUBTHEME_NAME'];

?>
    <div id="modal_edit<?php echo $subTheme_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tema Program Semester</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateSubTemaProgramSemester">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $subTheme_id ?>" name="subThemeID">
                        <div class="form-group">
                            <label>Sub Tema Program Semester:</label>
                            <input type="text" id="" class="form-control" placeholder="Tema Program Semester" value="<?php echo $subThemeName; ?>" name="subTemaPromes">
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
        var search = $("#temaID").val();
        $("#kodeRppm").val(search);
        console.log(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>Program/fetchSubTemaPromes",
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
        var search = $("#temaID").val();
        alert(search);

    })


    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="subTemaPromes[]" id="name" class="form-control" placeholder="Masukan SubTema Program Semester"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

    });
</script>