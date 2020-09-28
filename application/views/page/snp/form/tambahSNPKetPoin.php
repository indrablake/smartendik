<style>
    .table tr td {
        padding: 3px
    }
</style>

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
            <form action="<?php echo base_url() ?>SNP/simpanSNPKetPoin_ajax" class="formSimpanBanyak">
                <div style="text-align: end;">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Simpan Data
                    </button>
                    <a href="<?php echo base_url() ?>SNP/listSNPKetPoin" class="btn btn-sm btn-danger">
                        Kembali
                    </a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 26%">SNP Poin</th>
                            <th style="width: 8%">Abjad</th>
                            <th style="width: 8%">Nilai Min</th>
                            <th style="width: 8%">Nilai Max</th>
                            <th style="width: 50%">Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="formtambah">
                        <tr>
                            <td style="width: 17%;">
                                <select name="snppID[]" id="" class="form-control">
                                    <?php foreach ($dataSNP as $snpp) : ?>
                                        <option value="<?php echo $snpp['snpp_id'] ?>"><?php echo $snpp['snpp_ket']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td style="width: 5%; "><input type="text" name="spkn_abjad[]" class="form-control" placeholder="A"></td>
                            <td style="width: 5%; "><input type="number" name="spkn_min[]" class="form-control" placeholder="0"></td>
                            <td style="width: 5%; "><input type="number" name="spkn_max[]" class="form-control" placeholder="0"></td>
                            <td style="width: 50%;"><textarea name="spkn_ket[]" class="form-control" id="" cols="4" rows="4" placeholder="Keterangan SNP Poin"></textarea></td>
                            <td>
                                <button type="button" class="btn btn-primary btnaddform">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $("body").addClass("sidebar-xs");

        // Simpan Data
        $('.formSimpanBanyak').submit(function(e) {
            e.preventDefault();


            $.ajax({
                url: $(this).attr('action'),
                type: "post",
                dataType: "json",
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
                        $('.pesan').html(data.error).show()
                    } else {
                        swal({
                            icon: 'success',
                            title: "Konfirmasi",
                            text: "Data SNP Poin Berhasil Ditambahkan"
                        });
                        window.location.href = ("<?= base_url('SNP/listSNPKetPoin'); ?>")
                    }

                }
            });
        });
        // End Simpan


        // Add Click
        $('.btnaddform').click(function(e) {
            e.preventDefault();

            $('.formtambah').append(`
            <tr>
                        <td style="width: 17%;">
                            <select name="snppID[]" id="" class="form-control">
                                <?php foreach ($dataSNP as $snpp) : ?>
                                    <option value="<?php echo $snpp['snpp_id'] ?>"><?php echo $snpp['snpp_ket']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 5%; "><input type="text" name="spkn_abjad[]" class="form-control" placeholder="A"></td>
                        <td style="width: 5%; "><input type="number" name="spkn_min[]" class="form-control" placeholder="0"></td>
                        <td style="width: 5%; "><input type="number" name="spkn_max[]" class="form-control" placeholder="0"></td>
                        <td style="width: 50%;"><textarea name="spkn_ket[]" class="form-control" id="" cols="4" rows="4" placeholder="Keterangan SNP Poin"></textarea></td>
                        <td>
                            <button type="button" class="btn btn-danger btnhapusform">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
            `)
        })
        // End Click

        // Add Hapus Click
        $(document).on('click', '.btnhapusform', function(e) {
            e.preventDefault();
            $(this).parents('tr').remove();
        })
        // End Hapus Click



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