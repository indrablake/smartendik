<link href="<?php echo base_url() ?>assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets2/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets2/css/layout.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets2/css/components.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets2/css/colors.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/forms/wizards/steps.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/inputs/inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/validation/validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/extensions/cookie.js"></script>

<script src="<?php echo base_url() ?>assets/js/app.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_wizard.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sekolah</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Sekolah</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listSekolah" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Sekolah
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
                    <h5 class="card-title">Tambah Data Sekolah</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form class="wizard-form steps-basic" data-fouc method="POST" action="simpanSekolah" enctype="multipart/form-data">
                        <h6>Data Sekolah</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Grade Sekolah:</label>
                                        <select name="grade_sekolah" data-placeholder="Pilih Grade" class="form-control form-control-select2" data-fouc>
                                            <option></option>
                                            <?php $result = $this->db->query("SELECT *FROM TBL_SCHOOLGRADE")->result_array(); ?>
                                            <?php foreach ($result as $result) : ?>
                                                <option value="<?php echo $result['GRADE_ID'] ?>"><?php echo $result['GRADE_NAME']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Npsn Sekolah:</label>
                                        <input type="text" name="npsn_sekolah" class="form-control" placeholder="Npsn Sekolah">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Sekolah:</label>
                                        <input type="text" name="nama_sekolah" class="form-control" placeholder="Nama Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Sekolah:</label>
                                        <select data-placeholder="Pilih Sekolah" class="form-control form-control-select2" data-fouc name="status_sekolah">
                                            <option value="1>">Swasta</option>
                                            <option value="0>">Negeri</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Institusi Sekolah:</label>
                                        <input type="text" name="institusi_sekolah" class="form-control" placeholder="Institusi Sekolah">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h6>Lokasi Sekolah</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Sekolah:</label>
                                        <input type="text" name="alamat_sekolah" class="form-control" placeholder="Alamat Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Desa Sekolah:</label>
                                        <input type="text" name="desa_sekolah" class="form-control" placeholder="Desa Sekolah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota Sekolah:</label>
                                        <input type="text" name="kota_sekolah" class="form-control" placeholder="Kota Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi Sekolah:</label>
                                        <input type="text" name="provinsi_sekolah" class="form-control" placeholder="Provinsi Sekolah">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h6>Data Informasi</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Telp:</label>
                                        <input type="number" name="telp_sekolah" class="form-control" placeholder="No Telp">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fax:</label>
                                        <input type="text" name="fax_sekolah" class="form-control" placeholder="Fax">
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <input type="email" name="email_sekolah" class="form-control" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Twitter:</label>
                                        <input type="text" name="twitter_sekolah" class="form-control" placeholder="Twitter">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Facebook:</label>
                                        <input type="text" name="facebook_sekolah" class="form-control" placeholder="Facebook">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Instagram:</label>
                                        <input type="text" name="instagram_sekolah" class="form-control" placeholder="Instagram">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h6>Additional info</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo Sekolah:</label>

                                        <input type="file" name="file_profile" class="form-input-styled" data-fouc="">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Header Sekolah:</label>

                                        <input type="text" name="header1" class="form-control" placeholder="Header Sekolah">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Header 2 Sekolah:</label>

                                        <input type="text" name="header2" class="form-control" placeholder="Header 2 Sekolah">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Header 3 Sekolah:</label>

                                        <input type="text" name="header3" class="form-control" placeholder="Header 3 Sekolah">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>