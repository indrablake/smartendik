<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js">
</script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>




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
                    <form id="submit">
                        <fieldset>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pesan">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Judul Berita:</label>
                                <input type="text" name="judul_berita" class="form-control" placeholder="Judul Berita">
                            </div>
                            <div class="form-group">
                                <label>Tanggal :</label>
                                <input type="date" readonly name="tanggal_berita" class="form-control" placeholder="<?php echo date("Y-m-d") ?>" value="<?php echo date("Y-m-d"); ?>">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Expire:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input placeholder="Tanggal Expired" type="text" class="form-control datepicker" name="tanggal_expire">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Upload Thumbnail:</label>
                                <input type="file" name="file_beritaThumbnail" class="form-input-styled" data-fouc="">
                            </div>
                            <div class="form-group">
                                <label>Upload Image/Video:</label>
                                <input type="file" name="file_berita" class="form-input-styled" data-fouc="">
                            </div>
                            <div class="form-group">
                                <label>Isi Berita:</label>
                                <textarea name="isi_berita" id="ckeditor" required></textarea>
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
    $(document).ready(function() {

        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });

        $(function() {
            CKEDITOR.replace('ckeditor', {
                filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
                height: '400px'
            });
        });

        $('#submit').submit(function(e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '<?php echo base_url(); ?>Berita/simpanBerita_ajax',
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
                    if (data.error) {
                        $('.pesan').html(response.error).show()
                    } else {
                        swal({
                            icon: 'success',
                            title: "Konfirmasi",
                            text: "Berita Berhasil Ditambahkan"
                        });
                    }


                }
            });
        });


    });
</script>