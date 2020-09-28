<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">User</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Iklan</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="pesan"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <fieldset>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <input type="text" class="form-control" disabled value="<?php echo $iklanResult->jns_brg_nm; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Judul Iklan:</label>
                        <input type="text" disabled value="<?php echo $iklanResult->iklan_judul; ?>" name="iklanJudul" class="form-control" placeholder="Judul Iklan">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Deskripsi Iklan:</label>
                        <textarea name="iklanDeskripsi" disabled id="ckeditor" required><?php echo $iklanResult->iklan_deskripsi; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tanggal Expired:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input placeholder="Tanggal Expired" disabled <?php echo $iklanResult->jns_brg_nm; ?> type="text" class="form-control datepicker" name="iklanExpired">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Image/Video:</label>
                        <div class="row">
                            <?php foreach ($resultImage as $image) : ?>
                                <div class="col-md-4" style="background-image:url('<?php echo base_url('uploads/imageIklan/') ?><?php echo trim($image['iklan_gambar_link']); ?>');">
                                    <img src="" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </fieldset>
            <form id="submit">
                <input type="text" hidden name="kodeIklan" value="<?php echo $iklanResult->iklan_kd; ?>">
                <label for="">Status</label>
                <div class="text-right">

                    <select name="statusIklan" id="" class="form-control mb-2">
                        <option value="1">Publikasi </option>
                        <option value="2">Tidak Publikasi </option>
                    </select>
                    <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
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
                url: '<?php echo base_url(); ?>Iklan/approved_ajax',
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
                    var response = JSON.parse(data);
                    if (response.error) {
                        $('.pesan').html(response.error).show()
                    }
                    if (response.sukses) {
                        swal({
                            icon: 'success',
                            title: "Konfirmasi",
                            text: "Iklan Berhasil DiUpdate"
                        });

                        window.location.href = ("<?= base_url('Iklan/listIklan'); ?>");
                    }
                }
            });
        });


    });
</script>