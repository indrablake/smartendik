<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>


<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script src="assets/js/app.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_select2.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sekolah</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Sekolah</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahSTPPATK">Tambah Data <i class="icon-play3 ml-2"></i></button>
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
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('failed'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 1em;">

                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Sekolah</th>
                            <th class="text-center">Tahun Pembelajaran</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Kepala</th>
                            <th class="text-center">Kepala Institusi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataSTPPATK as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['SCH_NAME']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_STUDYYEAR']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_APPOINTEDPLACE']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_HEADMASTER']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_INSTITUTIONHEAD']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning" onclick="edit(<?= $q['STPPATK_ID']; ?>)">Edit </button>
                                    <button onclick="hapus(<?= $q['STPPATK_ID']; ?>)" class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="modalTambahSTPPATK" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data STPPATK</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo form_open('Sekolah/simpanSTPPATK_ajax', ['class' => 'formSimpan']) ?>
                <div class="form-group">
                    <label>Sekolah:</label>
                    <select name="sch_id" data-placeholder="Pilih Sekolah" class="form-control select" data-fouc>
                        <option></option>
                        <?php $result = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array(); ?>
                        <?php foreach ($result as $result) : ?>
                            <option value="<?php echo $result['SCH_ID'] ?>"><?php echo $result['SCH_NAME']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tahun</label>
                    <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_year" data-fouc>
                        <?php
                        $tahun = date('Y');
                        for ($i = 1990; $i <= $tahun; $i++) : ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Tahun Pembelajaran</label>
                    <div class="row">
                        <div class="col-md-6">
                            <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_studyyear" data-fouc id="tahunAjaran" onchange="tahun()">
                                <?php
                                $tahun = date('Y');
                                for ($i = 1990; $i <= $tahun; $i++) : ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunRPPH2">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="">Angka</label>
                    <input type="number" placeholder="Angka Pembelajaran" class="form-control" name="stppatk_number">
                </div>

                <div class="form-group">
                    <label for="">Appointed Place</label>
                    <input type="text" placeholder="Lokas Pembelajaran" class="form-control" name="stppatk_appointedplace">
                </div>

                <div class="form-group">
                    <label for="">Appointed Date</label>
                    <input type="date" class="form-control" name="stppatk_appointeddate">
                </div>

                <div class="form-group">
                    <label for="">Head Master</label>
                    <input type="text" placeholder="Kepala" class="form-control" name="stppatk_headmaster">
                </div>
                <div class="form-group">
                    <label for="">Institution Head</label>
                    <input type="text" placeholder="Institution Kepala" class="form-control" name="stppatk_institutionhead">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<div class="viewModalEdit" style="display: none;"></div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
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
                    $('[name="sch_id"]').val("Pilih Sekolah");
                    $('[name="stppatk_year"]').val("");
                    $('[name="stppatk_studyyear"]').val("");
                    $('[name="tahunRPPH2"]').val("");
                    $('[name="stppatk_number"]').val("Pilih Sekolah");
                    $('[name="stppatk_appointedplace"]').val("");
                    $('[name="stppatk_headmaster"]').val("");
                    $('[name="stppatk_institutionhead"]').val("");


                    $('#modalTambahSTPPATK').modal('hide')
                    $('#modalTambahSTPPATK').modal({
                        backdrop: 'false',
                        keyboard: 'true',
                        show: 'false'
                    });
                    window.location.href = ("<?= base_url('sekolah/listSTPPATK'); ?>")
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
            }
        });
        return false;
    })

    function edit(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Sekolah/formEditSTPPATK') ?>",
            data: {
                stppatkID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditSTPPATK').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditSTPPATK').modal('show');
            }
        })
    }


    function hapus(stppatkID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data grade sekolah ?",
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
                        url: "<?= base_url('Sekolah/hapusSTPPATK_ajax') ?>",
                        data: {
                            stppatkID: stppatkID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('sekolah/listSTPPATK'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>
<script>
    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
        document.getElementById("tahunAjaran2").html = tahun + 1;
    }
</script>