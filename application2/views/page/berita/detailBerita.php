<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/node_modules/ckeditor4/ckeditor.js"></script>

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
                    <h5 class="card-title">Detail Data Berita</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="submit">
                        <fieldset>


                            <div class="form-group">
                                <input type="hidden" value="<?php echo $resultQuery->berita_kd; ?>" name="id_berita">
                                <label>Judul Berita:</label>
                                <input readonly type="text" name="judul_berita" class="form-control" value="<?php echo $resultQuery->berita_judul; ?>" val>
                            </div>
                            <div class="form-group">
                                <label>Tanggal :</label>
                                <input readonly type="date" readonly name="tanggal_berita" class="form-control" value="<?php echo $resultQuery->berita_tgl_kirim ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Expired:</label>
                                <input readonly type="date" readonly name="tanggal_expire" class="form-control" value="<?php echo $resultQuery->berita_tgl_expired ?>">
                            </div>
                            <img src="<?php echo base_url() ?>uploads/Berita/thumbnail/<?php echo $resultQuery->berita_gambar; ?>" alt="">

                            <div class=" form-group">
                                <label>Upload Image/Video:</label>
                                <?php if ($resultQuery->berita_video == '') { ?>
                                    <input readonly type="hidden" name="file_beritaOld" value="<?php echo $resultQuery->berita_video ?>">
                                <?php } else { ?>
                                    <input readonly type="hidden" name="file_beritaOld" value="<?php echo $resultQuery->berita_gambar ?>">
                                <?php } ?>
                                <input readonly type="file" name="file_berita" class="form-input-styled" data-fouc="">

                            </div>
                            <div class="form-group">
                                <label>Isi Berita:</label>
                                <textarea disabled name="isi_berita" id="isi_berita" rows="4" cols="4">
                                <?php echo $resultQuery->berita_isi; ?>
                                </textarea>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        CKEDITOR.replace('isi_berita', {
            filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
            height: '400px'
        });
    });

    $('#submit').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>Berita/updateBerita_ajax',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function() {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                        swal.showLoading()
                    }
                })
            },
            success: function(data) {

                swal({
                    icon: 'success',
                    title: "Konfirmasi",
                    text: "Sekolah Berhasil Ditambahkan"
                });
                window.location.href = ("<?= base_url('Berita/listBerita'); ?>")
            }
        });
    });
</script>