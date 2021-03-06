<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/editor_ckeditor_default.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Berita</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Berita</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listBerita" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Berita
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
                    <h5 class="card-title">Tambah Data Berita</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="editBeritaAksi" method="POST" enctype="multipart/form-data">
                        <fieldset>


                            <div class="form-group">
                                <input type="hidden" value="  <?php echo $resultQuery->NP_ID; ?>" name="id_berita">
                                <label>Judul Berita:</label>
                                <input type="text" name="judul_berita" class="form-control" value="<?php echo $resultQuery->NP_TITLE; ?>" val>
                            </div>
                            <div class="form-group">
                                <label>Tanggal :</label>
                                <input type="date" readonly name="tanggal_berita" class="form-control" value="<?php echo date("Y-m-d") ?>">
                            </div>
                            <img src="<?php echo base_url() ?>uploads/Berita/thumbnail/<?php echo $resultQuery->NP_IMAGELINK; ?>" alt="">
                            <div class=" form-group">
                                <label>Upload Thumbnail:</label>
                                <input type="hidden" name="file_berita_old" value="<?php echo $resultQuery->NP_IMAGELINK ?>">
                                <input type="file" name="file_berita" class="form-input-styled" data-fouc="">
                            </div>
                            <div class="form-group">
                                <label>Isi Berita:</label>
                                <textarea name="isi_berita" id="editor-full" rows="4" cols="4">
                                <?php echo $resultQuery->NP_CONTENT; ?>
                                </textarea>
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