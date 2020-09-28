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
                <span class="breadcrumb-item">STPPA</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listSTPPA" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data STPPA
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
                    <form action="simpanSTPPA" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label>Jenjang:</label>
                                <select data-placeholder="Pilih Kelas" class="form-control" name="jenjang">
                                    <?php $jejang = $this->db->query("SELECT * from ref_jenjang_sekolah")->result_array();
                                    foreach ($jejang as $jdata) : ?>
                                        <option value="<?php echo $jdata['jenjang_kd'] ?>"><?php echo $jdata['jenjang_nm']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="lingkup-list">
                                <div class="float-left">
                                    <label>Lingkup Perkembangan:</label>
                                </div>
                                <div class="float-right">
                                    <button type="button" name="add" id="add" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                                </div>
<!--                                 <div class="form-group">
                                    <div class="input-group"> 
                                        <input type="text" class="form-control" name="lingkup[0]" maxlength="512" placeholder="" required="">
                                        <div class="input-group-append">
                                           <button class="btn btn-success" type="button" id="add_jml_sub_lingkup" onclick="return sub_listing(this)">Listing Sub Lingkup</button>
                                           <button class="btn btn-info" type="button" id="add_detail_sub_lingkup" onclick="return detail_listing(this)">Detail Sub Lingkup</button>
                                        </div>
                                    </div>
                                </div> -->
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

<div id="modalTambahSubLingkup" class="modal fade modalTambahSubLingkup" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Tambah STPPA</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <form class="formSimpan" onsubmit="return addSubLingkup(this)">               
                <fieldset>
                    <div class="form-group">
                        <label>Lingkup Perkembangan:</label>
                        <input type="text" class="form-control ref-lingkup" maxlength="512" placeholder="" readonly="" disabled="">
                    </div>
                    <div class="sub-lingkup-list">
                        <div class="float-left">
                            <label>Sub Lingkup Perkembangan:</label>
                        </div>
                        <div class="float-right">
                            <button type="button" name="add" id="add_sub_lingkup" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="" required="" id="sub-lingkup-0" name="sublingkup[][]">
                                <!-- <div class="input-group-append">
                                   <button class="btn btn-success" type="button" id="add_sub_lingkup">Tambah</button>
                                </div> -->
                                <div class="input-group-append">
                                    <button type="button" data-sub-remove="`+e+`" onclick="return subremove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>


                </fieldset>
                <div class="text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close <i class="icon-logout ml-2"></i></button>
                    <button type="submit" id="submit-sub-lingkup" class="btn btn-primary" disabled="">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalTambahDetailSubLingkup" class="modal fade modalTambahDetailSubLingkup" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Detail Sub Lingkup</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <form class="formSimpan" onsubmit="return addDetailSubLingkup(this)">               
                <fieldset>
                    <div class="form-group">
                        <label>Lingkup Perkembangan:</label>
                        <input type="text" class="form-control ref-lingkup" maxlength="512" placeholder="" readonly="" disabled="">
                    </div>
                    <div class="form-group">
                        <label>Sub Perkembangan:</label>
                        <select name="ref-sub-lingkup" class="form-control ref-sub-lingkup" id="">
                            
                        </select>
                    </div>
                    <div class="sub-lingkup-list">
                        <div class="float-left">
                            <label>Sub Lingkup Perkembangan:</label>
                        </div>
                        <div class="float-right">
                            <button type="button" name="add" id="add_sub_lingkup" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="" required="" id="sub-lingkup-0" name="sublingkup[0]">
                                <!-- <div class="input-group-append">
                                   <button class="btn btn-success" type="button" id="add_sub_lingkup">Tambah</button>
                                </div> -->
                                <div class="input-group-append">
                                    <button type="button" data-sub-remove="`+e+`" onclick="return subremove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>


                </fieldset>
                <div class="text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close <i class="icon-logout ml-2"></i></button>
                    <button type="submit" id="submit-sub-lingkup" class="btn btn-primary" disabled="">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#add', function(event) {
        event.preventDefault();
        var e = $(".lingkup-list").children('.form-group').length;
        console.log("uye",e);
        /* Act on the event */
        $(".lingkup-list").append(`
            <div class="form-group">
                <div class="input-group"> 
                    <input type="text" class="form-control" name="lingkup[]" id="lingkup-`+e+`" maxlength="512" placeholder="" required="">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" data-listing="`+e+`" onclick="return sub_listing(this)">Listing Sub Lingkup</button>
                        <button class="btn btn-info" type="button" data-detail-listing="`+e+`" onclick="return detail_listing(this)">Listing Detail Sub Lingkup</button>
                        <button type="button" data-remove="`+e+`" onclick="return remove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                    </div>
                </div>
            </div>
        `);
    });

    $(document).on('click', '#add_sub_lingkup', function(event) {
        event.preventDefault();
        var e = $(".sub-lingkup-list").children('.form-group').length;
        console.log("uye",e);
        /* Act on the event */
        $(".sub-lingkup-list").append(`
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control"  name="sublingkup[][]" placeholder="" required="" id="sub-lingkup-`+e+`">
                    <div class="input-group-append">
                        <button type="button" name="sub-remove" data-sub-remove="`+e+`" onclick="return subremove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                    </div>
                </div>
            </div>
        `);
    });

    function sub_listing(par) {
        $('#modalTambahSubLingkup').modal('toggle');

        $(document).on('shown.bs.modal','#modalTambahSubLingkup', function (e) {
            $(".ref-lingkup").val($(par).parent().parent().find('.form-control').val());
        });  
    }
    function detail_listing(par) {
        $('#modalTambahDetailSubLingkup').modal('toggle');

        $(document).on('shown.bs.modal','#modalTambahDetailSubLingkup', function (e) {
            // $(".ref-sub-lingkup").val($(par).parent().parent().find('.form-control').val());
            $(".ref-lingkup").val($(par).parent().parent().find('.form-control').val());
            $("input[name='sublingkup[][]']").each(function(index, el) {
                console.log('sublingkup-ref',$(this).val());
            });           
        });
    }


    function addSubLingkup(par) {
        $(par).children('.sub-lingkup-list').length;
        $('input[name^="pages_title"]').each(function() {
        });
    }
    function addDetailSubLingkup(par) {
        $(par).children('.sub-lingkup-list').length;
        $('input[name^="pages_title"]').each(function() {
        });
    }


    $(document).ready(function() {

    });
    

    function remove(par) {
        var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().remove();
    }

    function subremove(par) {
        var uy = $(par).data('sub-remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().remove();
        var l = $(par).parent().parent().parent().parent().children('.form-group').length;
        var cekAttr  = document.getElementById('submit-sub-lingkup'); 

        if (!l || l<1) {
            if (cekAttr.hasAttribute('disabled')) {

            } else {
                $("#submit-sub-lingkup").attr('disabled', '');   
            }
        } else {
            if (cekAttr.hasAttribute('disabled')) {
                $("#submit-sub-lingkup").removeAttribute('disabled');
            } else {

            }
        }
    }

</script>