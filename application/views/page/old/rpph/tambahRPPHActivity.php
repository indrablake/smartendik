<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/datepicker/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/datepicker/css/bootstrap-datetimepicker.min.css">

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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pesan">

                            </div>
                        </div>
                    </div>
                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>RPPH ID:</label>
                                        <select data-placeholder="Pilih RPPH ID" class="form-control " id="rpphid" name="RPPHID">
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


    <div id="modalTambahRPPHAct" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah RPPH Activity</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <?php echo form_open('RPPH/simpanRPPHActivity_ajax', ['class' => 'formSimpan']) ?>
                <input type="text" id=kodeRppm name="RPPHID" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pesan">

                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <div class="form-group">
                            <label>Nama Aktifitas:</label>
                            <input type="text" class="form-control" placeholder="Nama Aktifitas" name="activityName">
                        </div>

                        <div class="form-group">
                            <label>Waktu Aktifitas:</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="input-group" id="datetimepicker3">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text add-on"><i data-time-icon="icon-alarm"></i></span>
                                        </span>
                                        <input data-format="hh:mm" class="form-control pickatime" placeholder="Masukan Jam Mulai" name="activityTime">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">-</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group" id="datetimepicker4">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text add-on"><i data-time-icon="icon-alarm"></i></span>
                                        </span>
                                        <input data-format="hh:mm" class="form-control pickatime" placeholder="Masukan Jam Mulai" name="activityTime2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2" id="dynamicField">
                            <div class="col-md-12">
                                <label>Aktifitas:</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="aktifitas[]" id="name" class="form-control">
                                <input type="hidden" name="idAktifitas[]" id="idAktifitas">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                            </div>
                        </div>
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Simpan Data</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<div class="viewModalEdit" style="display: none;"></div>

<script type="text/javascript">
    $(function() {
        $('#datetimepicker3').datetimepicker({
            pickDate: false
        });
    });
    $(function() {
        $('#datetimepicker4').datetimepicker({
            pickDate: false
        });
    });
</script>
<script>
    $("#searchBtn").click(function() {
        var search = $("#rpphid").val();
        console.log(search);
        $("#kodeRppm").val(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPPH/fetchActivity",
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
        $("#kodeRppm").val(search);
    })

    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="aktifitas[]" id="name" class="form-control" placeholder="Masukan Aktfitas"><input type="hidden" name="idAktifitas[]" id="idAktifitas" value' + i + ' class="form-control" placeholder="Masukan Aktfitas"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });


        $('.tambahEditAct').click(function() {
            console.log("OK");
            j++
            $('#dynamicFieldEdit').append('<div class="col-md-10 mt-2" id="row' + j + '"><input type="text" name="aktifitasDetail[]" id="name" class="form-control" placeholder="Masukan Aktfitas"><input type="hidden" name="idAktifitas[]" id="idAktifitas" value' + j + ' class="form-control" placeholder="Masukan Aktfitas"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove2', function() {
            var button_id = $(this).attr("id");
            $("#rowEdit" + button_id + "").remove();
            $("#rowEdit" + button_id + "").remove();
        })


        $(document).on('click', '.btn_delete', function() {
            var id = $(this).attr('id');
            console.log(id);
            var activityIndex = $('#indexActivity' + id).val();
            $("#input" + id + "").remove();
            $("#button" + id + "").remove();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('rpph/delete_detail_activity') ?>",
                dataType: "JSON",
                data: {
                    activityIndex: id
                },
                success: function(data) {

                }
            });
            return false;

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
                        $('#modalTambahRPPHAct').modal('hide');
                        $('#modalTambahRPPHAct').modal({
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
            url: "<?php echo base_url('RPPH/formEditRPPHActivity') ?>",
            data: {
                rpphActID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditRPPH').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditRPPH').modal('show');
            }
        })
    }

    function detail(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('RPPH/formDetailRPPHActivity') ?>",
            data: {
                rpphActID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalDetailActivity').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalDetailActivity').modal('show');
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
                    text: ` ${jumlahData.length}   Kegiatan RPPH,Yakin menghapus data  ?`,
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
                text: "Yakin menghapus data Kegiatan RPPH ?",
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
                        url: "<?= base_url('RPPH/hapusRPPHActivity_ajax') ?>",
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
</script>