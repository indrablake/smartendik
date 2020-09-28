<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">SNP Poin</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">SNP Poin</span>
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
            <form id="submit">
                <div class="container" id="dynamicField">
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <label>Pemantauan SNP:</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                        </div>
                        <div class="col-md-10">
                            <select data-placeholder="Pilih snp" id="snpID" class="form-control form-control-select2" data-fouc name="snpID">
                                <?php $queryGroup = $this->db->query("SELECT *from ref_snp where snp_status='1'")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['snp_id'] ?>"><?php echo $group['snp_nm'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-10">
                            <textarea data-sample-short rows="2" name="snpp_ket[]" placeholder="Keterangan SNP Poin" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>


                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="row mb-2" id="row' + i + '"><div class="col-md-10"> <textarea data-sample-short rows="2" name="snpp_ket[]" placeholder="Keterangan SNP Poin" class="form-control" required></textarea></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div></div></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

        $('#submit').submit(function(e) {
            e.preventDefault();


            $.ajax({
                url: '<?php echo base_url(); ?>SNP/simpanSNPPoin_ajax',
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
                        text: "Data SNP Poin Berhasil Ditambahkan"
                    });
                    window.location.href = ("<?= base_url('SNP/listSNPPoin'); ?>")
                }
            });
        });


    });
</script>