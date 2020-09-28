<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>


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
                <span class="breadcrumb-item">RPPM</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>RPPM ID:</label>
                                        <select data-placeholder="Pilih RPPM ID" class="form-control form-control-select2" data-fouc name="RPPMID" id="rppmid">
                                            <?php $queryGroup = $this->db->query("SELECT rp.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPM rp INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=rp.CLASS_ID")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['RPPM_ID'] ?>"><?php echo $group['RPPM_ID'] . '-' . $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group" style="margin-top:5px">

                                        <button type="button" id="searchBtn" class="btn btn-primary mt-3">Search</button>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>


                    <div id="hasilData">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalTambahRPPM" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah RPPM Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <?php echo form_open('RPPM/simpanRPPMLearning_ajax', ['class' => 'formSimpan']) ?>
                <div class="modal-body">
                    <fieldset>
                        <input type="text" id=kodeRppm name="RPPMID" hidden>

                        <div class="row mb-2" id="dynamicField">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Kode Pembelajaran:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" id="" class="form-control" placeholder="Kode Pembelajaran" name="kodeLearning[]">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Teori Pembelajaran:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Teori Pembelajaran" name="teoriLearning[]">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Tujuan Pembelajaran:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Tujuan Pembelajaran" name="tujuanLearning[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Simpan Data</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<div class="viewModalEdit" style="display: none;"></div>

<script>
    $("#searchBtn").click(function() {
        var search = $("#rppmid").val();
        console.log(search);
        load_data(search);
        $("#kodeRppm").val(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPPM/fetchLearning",
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#hasilData").html(data);
                $("#btnTambah").show();
            }
        })
    }

    $("#btnTambah").click(function() {
        var search = $("#rppmid").val();
        $("#kodeRppm").val(search);
    })

    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="col-md-12 mt-1" id="row' + i + '"><div class="row"><div class="col-md-12"><label>Kode Pembelajaran:</label></div><div class="col-md-10 "><input type="text" name="kodeLearning[]" id="name" class="form-control" placeholder="Kode Tujuan"></div><div id="row2' + i + '" class="col-md-1 "><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div> <div class="col-md-12"><label>Teori Pembelajaran:</label></div><div class="col-md-10"><input type="text" id="" class="form-control" placeholder="Teori Pembelajaran" name="teoriLearning[]"></div><div class="col-md-12"><label>Tujuan Pembelajaran:</label></div><div class="col-md-10"><input type="text" id="" class="form-control" placeholder="Tujuan Pembelajaran" name="tujuanLearning[]"></div></div></div>')


            // $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="deskripsiTujuan[]" id="name" class="form-control" placeholder="Masukan Capaian Perkembangan"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

    });


    $(document).ready(function() {
        $('.formSimpan').submit(function(e) {
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
                        swal({
                            icon: 'success',
                            title: 'Tambah Data',
                            text: response.sukses
                        });
                        $('#modalTambahRPPM').modal('hide');
                        $('#modalTambahRPPM').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        var search = $("#rppmid").val();
                        console.log(search);
                        load_data(search);
                        $("#kodeRppm").val(search);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                }
            });
            return false;
        })
    });

    function edit(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('RPPM/formEditRPPMLearning') ?>",
            data: {
                rppmID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditRPPMLearning').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditRPPMLearning').modal('show');
            }
        })
    }

    $('.formHapus').submit(function(e) {
        e.preventDefault();
        let jumlahData = $('.centangPromes:checked');

        if (jumlahData.length == 0) {
            swal({
                icon: 'warning',
                title: 'Perhatikan',
                text: 'Maaf tidak ada data yang dipilih,Silahkan pilih data'
            });
        } else {
            swal({
                    title: "Hapus",
                    text: ` ${jumlahData.length}   Program RPPM,Yakin menghapus data  ?`,
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
                            url: $(this).attr("action"),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.sukses) {
                                    console.log("OK");
                                    swal({
                                        icon: 'success',
                                        title: "Konfirmasi",
                                        text: response.sukses
                                    });
                                    var search = $("#rppmid").val();
                                    console.log(search);
                                    load_data(search);
                                    $("#kodeRppm").val(search);
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                            }
                        })
                    } else {
                        swal("Data tidak dihapus!");
                    }
                });
        }
        return false;
    })


    function hapus(rppmLearnID) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data RPPM ?",
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
                        url: "<?= base_url('RPPM/hapusRPPMLearning_ajax') ?>",
                        data: {
                            rppmLearnID: rppmLearnID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                var search = $("#rppmid").val();
                                console.log(search);
                                load_data(search);
                                $("#kodeRppm").val(search);

                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>