<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/picker_date.js"></script>

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
                <span class="breadcrumb-item">RPPH</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listProgram" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Data RPPH Kegiatan
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
                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>RPPH ID:</label>
                                        <select data-placeholder="Pilih RPPH ID" class="form-control form-control-select2" id="rpphid" data-fouc name="RPPHID">
                                            <?php $queryGroup = $this->db->query("SELECT rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM tbl_rpph rpm INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
                                    INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID
                                    ")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['RPPH_ID'] . ' - ' . $group['SCH_NAME'] . ' - ' . $group['CLASS_LEVEL'] . ' - ' . $group['CLASS_NAME']; ?></option>
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


    <div id="modalTambahRPPHValIndicator" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah RPPH Valuation Indicator</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <?php echo form_open('RPPH/simpanRPPHValIndicator_ajax', ['class' => 'formSimpan']) ?>
                <input type="text" id=kodeRppm name="RPPHID" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Deskripsi Valuasi Indikator:</label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Deskripsi Valuasi Indikator" name="descValuasi">
                        </div>
                    </div>
                    <label for="">Detail</label>
                    <div class="container" id="dynamicField">
                        <div class="row mb-2">

                            <div class="col-md-10 mt-2">
                                <input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Detail Kode">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                            </div>

                            <div class="col-md-10 mt-2">
                                <input type="text" name="detailTeknik[]" id="detailTeknik" placeholder="Detail Teknik" class="form-control">
                            </div>
                            <div class="col-md-10 mt-2">
                                <input type="text" name="detailIndikator[]" id="detailIndikator" placeholder="Detail Indikator" class="form-control">
                            </div>
                        </div>
                    </div>
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
        console.log("OK");
        var search = $("#rpphid").val();
        console.log(search);
        load_data(search);
        $("#kodeRppm").val(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPPH/fetchValIndicator",
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
        var search = $("#rpphid").val();

    })


    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            // $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Masukan Aktfitas"><input type="hidden" name="idAktifitas[]" id="idAktifitas" value' + i + ' class="form-control" placeholder="Masukan Aktfitas"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')

            $('#dynamicField').append('<div class="row mb-2" id="row' + j + '"><div class="col-md-10 mt-2"><input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Masukan Kode Detail"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div><div class="col-md-10 mt-2"><input type="text" name="detailTeknik[]" id="name" class="form-control" placeholder="Masukan Detail Teknik"></div><div class="col-md-10 mt-2"><input type="text" name="detailIndikator[]" id="name" class="form-control" placeholder="Masukan Detail Indikator"></div></div></div>')



        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

        $('.tambahEditAct').click(function() {
            console.log("OK");
            i++;
            $('#dynamicFieldEdit').append('<div class="row mb-2" id="row' + j + '"><div class="col-md-10 mt-2"><input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Detail Valuasi Kode"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div><div class="col-md-10 mt-2"><input type="text" name="detailTeknik[]" id="name" class="form-control" placeholder="Detail Valuasi Teknik"></div><div class="col-md-10 mt-2"><input type="text" name="detailIndikator[]" id="name" class="form-control" placeholder=" Detail Valuasi Indikator"></div></div></div>')
        });
        $(document).on('click', '.btn_remove2', function() {
            var button_id = $(this).attr("id");
            $("#rowEdit" + button_id + "").remove();
            $("#rowEdit" + button_id + "").remove();
        })




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
                        $('#modalTambahRPPHValIndicator').modal('hide');
                        $('#modalTambahRPPHValIndicator').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        var search = $("#rpphid").val();
                        console.log(search);
                        $("#kodeRppm").val(search);
                        load_data(search);
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
            url: "<?php echo base_url('RPPH/formEditRPPHValIndicator') ?>",
            data: {
                rpphValIndicatorID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditRPPHValIndicator').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditRPPHValIndicator').modal('show');
            }
        })
    }

    function detail(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('RPPH/formDetailRPPHValIndicator') ?>",
            data: {
                rpphValIndex: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalDetailValIndicator').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalDetailValIndicator').modal('show');
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
                    text: ` ${jumlahData.length}   Kegiatan Valuasi Indikator RPPH,Yakin menghapus data  ?`,
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
                                    showData();
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


    function hapus(rpphActID) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data valuasi indikator RPPH ?",
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
                        url: "<?= base_url('RPPH/hapusRPPHValIndicator_ajax') ?>",
                        data: {
                            rpphActID: rpphActID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                var search = $("#rpphid").val();
                                console.log(search);
                                $("#kodeRppm").val(search);
                                load_data(search);
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }

    $(document).on('click', '.btn_delete', function() {
        var id = $(this).attr('id');

        var no = $(this).attr('data-no');
        $(".button" + no + "").remove();
        $(".input" + no + "").remove();
        console.log(no);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('rpph/delete_detail_val') ?>",
            dataType: "JSON",
            data: {
                valIndex: id
            },
            success: function(data) {
                if (data.sukses) {
                    $('.pesan').html(data).show()
                }
            }
        });
        return false;

    });
</script>