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
                    <form action="<?php echo site_url().'STPPA/add' ?>" onsubmit="return validasi(this)" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label>Jenjang:</label>
                                <select data-placeholder="Pilih Jenjang" class="form-control" name="jenjang">
                                    <?php $jejang = $this->db->query("SELECT * from ref_jenjang_sekolah")->result_array();
                                    foreach ($jejang as $jdata) : ?>
                                        <option value="<?php echo $jdata['jenjang_kd'] ?>"><?php echo $jdata['jenjang_nm']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Periode : </label>
                                <select data-placeholder="Pilih Periode" class="form-control" name="periode" id="periode">
                                    <option value="">Pilih</option>
                                    <?php $ref_periode = $this->db->query("SELECT * from ref_tahun_pelajaran")->result_array();
                                    foreach ($ref_periode as $rdata) : ?>
                                        <!-- <option value="<?php echo $rdata['thn_ajar_kd'] ?>"><?php echo $rdata['thn_ajar_periode'];?></option> -->
                                        <option value="<?php echo $rdata['thn_ajar_kd'] ?>"><?php echo date('j F Y',strtotime($rdata['thn_ajar_tgl_mulai'])).' - '.date('j F Y',strtotime($rdata['thn_ajar_tgl_akhir']));?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div><!-- 
                            <div class="form-group">
                                <label>Tahun Ajar : </label>
                                <select data-placeholder="Pilih Tanggal" class="form-control" name="tahun_ajar">
                                    
                                </select>
                            </div> -->
                            <div class="lingkup-list">
                                <div class="float-left">
                                    <label>Lingkup Perkembangan:</label>
                                </div>
                                <div class="float-right">
                                    <button type="button" name="add" id="add" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                                </div>

<!--                             <div class="detail-lingkup-list">
                                <div class="form-group">
                                    <label>Detail Lingkup Perkembangan:</label>
                                    <select data-placeholder="Pilih Periode" class="form-control" name="list_lingkup" id="periode">

                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" name="add_detail" id="add" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                                    </div>
                                </div>
                               
                            </div> -->
                           
                        </fieldset>
                        <div class="text-right">
                            <button type="submit" id="sumbit-btn" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '#add', function(event) {
        event.preventDefault();
        var e = $(".lingkup-list").children('.form-group').length;
        var s = $(".sublingkup-list").children('.form-group').length;
        //console.log("uye",e);
        /* Act on the event */
        var label=``;
        if (e>0) {
            label = `<label for="">Lingkup Perkembangan:</label>`;
        }
        $(".lingkup-list").append(`
            <div class="form-group">
            `+label+`
               <div class="input-group mb-1"> 
                    <input type="text" class="form-control" name="stppa[lingkup][]" id="lingkup-`+e+`" maxlength="512" placeholder="" required="">
                    <div class="input-group-append">
                        <button type="button" data-remove="`+e+`" onclick="return remove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label>Sub Lingkup Perkembangan:</label>
                        <div class="sublingkup-list">
                            <div class="input-group mb-1"> 
                                <input type="text" class="form-control" name="stppa[lingkup][sublingkup][]" id="sub-lingkup-`+e+`" maxlength="512" placeholder="" required="">
                                <div class="input-group-prepend">
                                    <button type="button" name="add_sub" class="btn btn-primary add_sub"><span class="icon-add"></span></button>
                                    <button type="button" data-remove="`+s+`" onclick="return remove_sub(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-2">
                        <div class="form-group">
                            <label>Detail Lingkup : </label>
                            <div class="detail-sublingkup-list">
                                <div class="input-group mb-1"> 
                                    <input type="text" class="form-control" name="stppa[lingkup][sublingkup][detail][]" id="detail-sub-lingkup-`+e+`" maxlength="512" placeholder="" required="">
                                    <div class="input-group-prepend">
                                        <button type="button" name="add_sub" class="btn btn-primary add_detail_sub"><span class="icon-add"></span></button>
                                        <button type="button" data-remove="`+s+`" onclick="return remove_detail_sub(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>             
            </div>

        `).on('keyup', '#lingkup-'+e+'', function(event) {
            event.preventDefault();
              
        });
    });
    $(document).on('click', '.add_sub', function(event) {
        event.preventDefault();
        var e = $(".lingkup-list").children('.form-group').length;
        var s = $(".sublingkup-list").children('.form-group').length;
        //console.log("uye",e);
        /* Act on the event */

        $(".lingkup-list").append(`
            <div class="">
                <div class="form-group">
                    <label>Sub Lingkup Perkembangan:</label>
                    <div class="sublingkup-list">
                        <div class="input-group mb-1"> 
                            <button type="button" name="add_sub" class="btn btn-primary add_sub"><span class="icon-add"></span></button>
                            <input type="text" class="form-control" name="stppa[lingkup][sublingkup][]" id="sub-lingkup-`+e+`" maxlength="512" placeholder="" required="">
                        </div>
                    </div>
                </div>
                <div class="ml-2">
                    <div class="form-group">
                        <label>Detail Lingkup : </label>
                        <div class="detail-sublingkup-list">
                            <div class="input-group mb-1"> 
                                <input type="text" class="form-control" name="stppa[lingkup][sublingkup][detail][]" id="detail-sub-lingkup-`+e+`" maxlength="512" placeholder="" required="">
                                <div class="input-group-prepend">
                                    <button type="button" name="add_sub" class="btn btn-primary add_sub"><span class="icon-add"></span></button>
                                    <button type="button" data-remove="`+s+`" onclick="return remove_sub(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   

        `).on('keyup', '#lingkup-'+e+'', function(event) {
            event.preventDefault();
              
        });
    });
    $(document).on('click', '.add_detail_sub', function(event) {
        event.preventDefault();
        var e = $(".lingkup-list").children('.form-group').length;
        var s = $(".sublingkup-list").children('.form-group').length;
        //console.log("uye",e);
        /* Act on the event */

        $(".detail-sublingkup-list").append(`
            <div class="input-group mb-1"> 
                <input type="text" class="form-control" name="stppa[lingkup][sublingkup][detail][]" id="deail-sub-lingkup-`+e+`" maxlength="512" placeholder="" required="">
                <div class="input-group-prepend">
                    <button type="button" name="add_sub" class="btn btn-primary add_detail_sub"><span class="icon-add"></span></button>
                    <button type="button" data-remove="`+s+`" onclick="return remlove_detail_sub(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                </div>
            </div>

        `).on('keyup', '#lingkup-'+e+'', function(event) {
            event.preventDefault();
              
        });
    });

    function validasi(argument) {
        
    }

    $(document).ready(function() {
        
    });
    

    function remove(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().remove();
    }

    function remove_sub(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().parent().remove();
    }
    function remove_detail_sub(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().parent().parent().remove();
    }

</script>