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
                    <form action="simpanSTPPASubLingkup" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label>Jenjang:</label>
                                <input type="text" class="form-control ref-jenjang" maxlength="512" placeholder="" readonly="" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Lingkup:</label>
                                <input type="text" class="form-control ref-lingkup" maxlength="512" placeholder="" readonly="" disabled="">
                            </div>
                            <div class="sub-lingkup-list">
                                <div class="float-left">
                                    <label>Sub Lingkup Perkembangan:</label>
                                </div>
                                <div class="float-right">
                                    <button type="button" name="add" id="add" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                                </div>
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


<script>
    $(document).on('click', '#add', function(event) {
        event.preventDefault();
        var e = $(".sub-lingkup-list").children('.form-group').length;
        //console.log("uye",e);
        /* Act on the event */
        $(".lingkup-list").append(`
            <div class="form-group">
                <div class="input-group"> 
                    <input type="text" class="form-control" name="sublingkup[]" id="sublingkup-`+e+`" maxlength="512" placeholder="" required="">
                    <div class="input-group-append">
                        <button type="button" data-remove="`+e+`" onclick="return remove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                    </div>
                </div>
            </div>
        `).on('keyup', '#sublingkup-'+e+'', function(event) {
            event.preventDefault();
              
        });
    });


    $(document).ready(function() {

    });
    

    function remove(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().remove();
    }

</script>