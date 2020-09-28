<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Provinsi</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Kelas</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahKelas">Tambah Data <i class="icon-play3 ml-2"></i></button>
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
                            <th class="text-center">Sekolah</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataKelas as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['sekolah_nm']; ?></td>
                                <td class="text-center"><?php echo $q['kelas_nm']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" onclick="edit(<?php echo $q['kelas_kd'] ?>)">Edit </button>
                                    <button onclick="hapus(<?php echo $q['kelas_kd'] ?>)" class=" btn btn-sm btn-danger">Hapus</button>
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
<div id="modalTambahKelas" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('MasterData/simpanKelas_ajax', ['class' => 'formSimpan']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <select name="sekolahKD" class="form-control" id="">
                            <?php $result = $this->db->query("SELECT *FROM dat_sekolah")->result_array();
                            foreach ($result as $sekolah) : ?>
                                <option value="<?= $sekolah['sekolah_kd']; ?>"><?= $sekolah['sekolah_npsn'] . '-' . $sekolah['sekolah_nm']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row" id="dynamicField">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label> Kelas:</label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <select name="jenisKelas[]" class="form-control" id="">
                                        <?php $resultKelas = $this->db->query("SELECT *FROM ref_tingkat_kelas")->result_array();
                                        foreach ($resultKelas as $kelas) : ?>
                                            <option value="<?= $kelas['tk_kls_level']; ?>"><?= $kelas['tk_kls_kode']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                            </div>
                            <div class="col-md-12">
                                <label> Nama Kelas:</label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Kelas" name="namaKelas[]">
                                </div>
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
            $('#dynamicField').append('<div class="col-md-12 " id="row' + i + '"><div class="row"><div class="col-md-10 mt-2"><select data-placeholder="Pilih Kelas" id="rppID" class="form-control"  name="jenisKelas[]"><?php foreach ($resultKelas as $group) {
                                                                                                                                                                                                                                $kode = $group["tk_kls_level"]; ?><option value="<?php echo $kode; ?>"><?php echo $group["tk_kls_kode"]; ?></option><?php } ?></select></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div><div class="col-md-10"><input type="text" class="form-control" placeholder="Kelas" name="namaKelas[]"></div><div class="col-md-10 mt-2"></div></div></div>')
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
                        $('[name="jenisKelas"]').val("");

                        $('#modalTambahKelas').modal('hide')
                        $('#modalTambahKelas').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('MasterData/listKelas'); ?>")
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
            url: "<?php echo base_url('MasterData/formEditKelas') ?>",
            data: {
                jenisKelas: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditKelas').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditKelas').modal('show');
            }
        })
    }


    function hapus(jenisKelas) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data Kelas sekolah ?",
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
                        url: "<?= base_url('MasterData/hapusKelas_ajax') ?>",
                        data: {
                            jenisKelas: jenisKelas
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('MasterData/listKelas'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>