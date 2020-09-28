<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Tingkat Kelas</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Tahun Pelajaran</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahTahunPelajaran">Tambah Data <i class="icon-play3 ml-2"></i></button>
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
                            <th class="text-center">Tahun Periode</th>
                            <th class="text-center">Tanggal Mulai</th>
                            <th class="text-center">Tanggal Berakhir</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataTahunPelajaran as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['thn_ajar_periode']; ?></td>
                                <td class="text-center"><?php echo $q['thn_ajar_tgl_mulai']; ?></td>
                                <td class="text-center"><?php echo $q['thn_ajar_tgl_akhir']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" onclick="edit(<?php echo $q['thn_ajar_kd'] ?>)">Edit </button>
                                    <button onclick="hapus(<?php echo $q['thn_ajar_kd'] ?>)" class=" btn btn-sm btn-danger">Hapus</button>
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
<div id="modalTambahTahunPelajaran" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Tahun Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('MasterData/simpanTahunPelajaran_ajax', ['class' => 'formSimpan']) ?>
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
                                <label>Tahun Ajaran:</label>
                            </div>
                            <div class="col-md-6">
                                <select data-placeholder="Pilih Tahun" class="form-control" name="tahunAjaran" id="tahunAjaran" onchange="tahun()">
                                    <option value="<?php echo intval(date('Y')) - 1 ?>"><?php echo intval(date('Y')) - 1 ?></option>
                                    <?php
                                    $tahun = date('Y');
                                    for ($i = $tahun; $i >= 1990; $i--) : ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunAjaran2" placeholder="<?php echo date('Y'); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tanggal Mulai</label>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tanggal Berakhir</label>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input placeholder="Tanggal Mulai" type="text" class="form-control datepicker" name="tanggalMulai">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input placeholder="Tanggal Berakhir" type="text" class="form-control datepicker" name="tanggalBerakhir">
                                </div>
                            </div>
                        </div>
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
</div>
<div class="viewModalEdit" style="display: none;"></div>

<!-- /basic modal -->
<script>
    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
        document.getElementById("tahunAjaran2").html = tahun + 1;
    }
    $(document).ready(function() {
        $('#example').dataTable();

        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
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
                        $('[name="jenisTahunPelajaran"]').val("");

                        $('#modalTambahTahunPelajaran').modal('hide')
                        $('#modalTambahTahunPelajaran').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('MasterData/listTahunPelajaran'); ?>")
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
            url: "<?php echo base_url('MasterData/formEditTahunPelajaran') ?>",
            data: {
                jenisTahunPelajaran: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditTahunPelajaran').on('shown.bs.modal', function(e) {
                    $('#namaTahunPelajaran').focus();
                });
                $('#modalEditTahunPelajaran').modal('show');
            }
        })
    }


    function hapus(jenisTahunPelajaran) {
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
                        url: "<?= base_url('MasterData/hapusTahunPelajaran_ajax') ?>",
                        data: {
                            jenisTahunPelajaran: jenisTahunPelajaran
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('MasterData/listTahunPelajaran'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>