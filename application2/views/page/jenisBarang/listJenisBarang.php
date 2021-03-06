<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>



<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Jenis Barang</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Jenis Barang</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahJenisBarang">Tambah Data <i class="icon-play3 ml-2"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">

                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jenis Barang</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataJenisBarang as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['jns_brg_nm']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="edit(<?php echo $q['jns_brg_kd'] ?>)">Edit </button>
                                    <button onclick="hapus(<?php echo $q['jns_brg_kd'] ?>)" class=" btn btn-sm btn-outline-danger">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Tambah Data -->
<div id="modalTambahJenisBarang" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Jenis Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('JenisBarang/simpanJenisBarang_ajax', ['class' => 'formSimpan']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <div class="row" id="dynamicField">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label> Jenis Barang:</label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Jenis Barang" name="jenisBarang[]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-primary">Save changes</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<div class="viewModalEdit" style="display: none;"></div>

<!-- /basic modal -->
<script>
    $(document).ready(function() {
        $('#example').dataTable();

        // var i = 1;
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="col-md-12 " id="row' + i + '"><div class="row"><div class="col-md-10"><input type="text" name="jenisBarang[]" id="name" class="form-control" placeholder="Jenis Barang"></div><div id="row2' + i + '" class="col-md-1 "><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div></div></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

        // Simpan 
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
                        $('[name="jenisBarang"]').val("");

                        $('#modalTambahJenisBarang').modal('hide')
                        $('#modalTambahJenisBarang').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('JenisBarang/listJenisBarang'); ?>")
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
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('JenisBarang/formEditJenisBarang') ?>",
            data: {
                jenisBarangID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditJenisBarang').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditJenisBarang').modal('show');
            }
        })
    }


    function hapus(jenisBarangID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data Jenis Barang  ?",
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
                        url: "<?= base_url('JenisBarang/hapusJenisBarang_ajax') ?>",
                        data: {
                            jenisBarangID: jenisBarangID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('JenisBarang/listJenisBarang'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>