<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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
                <span class="breadcrumb-item">Program Semester</span>
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
                                        <label>Tema:</label>
                                        <select data-placeholder="Pilih Tema" class="form-control form-control-select2" id="temaID" data-fouc name="PROMESID">
                                            <?php
                                            foreach ($queryTheme as $group) : ?>
                                                <option value="<?php echo $group['THEME_ID'] ?>"><?php echo $group['THEME_THEME']; ?></option>
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
    <div class="viewModalEdit" style="display: none;"></div>
    <div id="modalTambahSubTema" class="modal fade modalTambahSubTema" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sub Tema Program Semester</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <?php echo form_open('Program/simpanSubTemaPromes_ajax', ['class' => 'formSimpan']) ?>
                <input type="text" id=kodeRppm name="themeID" hidden>
                <div class="modal-body">
                    <div class="row mb-2" id="dynamicField">
                        <div class="col-md-12">
                            <label>SubTema Program Semester:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="subTemaPromes[]" id="name" class="form-control" placeholder="SubTema Program Semester">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
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

<script>
    $(document).ready(function() {
        $('#example').DataTable();
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
                        showData();
                        $('#modalTambahSubTema').modal('hide')
                        $('#modalTambahSubTema').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                }
            });
            return false;
        })
    });

    $("#searchBtn").click(function() {
        var search = $("#temaID").val();
        $("#kodeRppm").val(search);
        console.log(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>Program/fetchSubTemaPromes",
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


    $('#btnTambah').click(function(e) {
        $.ajax({
            type: "post",
            url: "<?= base_url('Program/formTambahTema') ?>",
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalTambahSubTema').modal('show');
                }
            }
        });
    })


    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="col-md-10 mt-2" id="row' + i + '"><input type="text" name="subTemaPromes[]" id="name" class="form-control" placeholder="Masukan SubTema Program Semester"></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

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
                        var search = $("#temaID").val();
                        $("#kodeRppm").val(search);
                        load_data(search);
                        $('#modalTambahSubTema').modal('hide');
                        $('#modalTambahSubTema').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        $("#btnTambah").empty();
                        $("#example").empty();
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
            url: "<?php echo base_url('Program/formEditSubTemaProgram') ?>",
            data: {
                subTheme: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditSubTema').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditSubTema').modal('show');
                $("#btnTambah").empty();
                $("#example").empty();
            }
        })
    }

    // Function Hapus
    function hapus(subTheme) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data sub tema program semester ?",
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
                        url: "<?= base_url('Program/hapusSubTemaData_ajax') ?>",
                        data: {
                            subTheme: subTheme
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                var search = $("#temaID").val();
                                $("#kodeRppm").val(search);
                                console.log(search);
                                load_data(search);
                                $("#btnTambah").empty();
                                $("#example").empty();
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }

    $("#centangSemua").click(function(e) {
        if ($(this).is(":checked")) {
            $('.centangPromes').prop('checked', true);
        } else {
            $('.centangPromes').prop('checked', false);
        }
    })

    $('.formHapus').submit(function(e) {
        console.log("OK")
    })
    $("#hapusSemua").click(function() {
        console.log("OK");
    })
    $("#btnTambah").click(function() {
        var search = $("#temaID").val();
        alert(search);

    })
</script>