<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/editor_ckeditor_default.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/ui/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/anytime.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/picker_date.js"></script>

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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pesan">

                            </div>
                        </div>
                    </div>
                    <form action="<?php echo base_url('Berita/simpanBerita_ajax') ?>" class="formSimpan" enctype="multipart/form-data">
                        <fieldset>


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
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                    </span>
                                    <input type="text" class="form-control daterange-single" name="tanggal_expire" value="03/18/2013">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Upload Thumbnail:</label>
                                <input type="file" name="file_berita" class="form-input-styled" id="fileUpload">
                                <input type="hidden" name="beritaUpload" id="inputUpload">
                            </div>
                            <div class="form-group">
                                <label>Isi Berita:</label>
                                <textarea name="isi_berita" id="editor-full" rows="4" cols="4">
                                </textarea>
                            </div>

                        </fieldset>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                        <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        // show_product();
        // Centang
        $("#centangSemua").click(function(e) {
            if ($(this).is(":checked")) {
                $('.centangPromes').prop('checked', true);
            } else {
                $('.centangPromes').prop('checked', false);
            }
        })

        // End Function
    });


    function hapus(id) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data program semester ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            })
            .then((willDelete) => {
                if (willDelete) {
                    console.log("OK");
                    $.ajax({
                        type: "POST",
                        contentType: false,
                        url: "<?= base_url('Program/hapusBerita_ajax') ?>",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                showData();
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }

    $(document).ready(function() {
        $('.formSimpan').submit(function(e) {
            e.preventDefault();
            var valInput = $('#fileUpload').val();
            $('#inputUpload').val(valInput);
            console.log("OK");
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function(response) {
                    if (response.error) {
                        $('.pesan').html(response.error).show()
                    }
                    if (response.sukses) {
                        console.log("OK");
                        swal({
                            icon: 'success',
                            title: 'Tambah Data',
                            text: response.sukses
                        });
                        window.location.href = ("<?= base_url('berita/listBerita'); ?>")
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                }
            });
            return false;
        })
    })
</script>