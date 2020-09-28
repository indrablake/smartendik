<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Kompetensi Inti</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Kompetensi</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="<?php echo base_url() ?>Kompetensi/formTambahKompetensiInti" class="btn btn-default">Tambah Data <i class="icon-play3 ml-2"></i></a>
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
            <div class="card" style="padding:1em">
                <table class="table " id="my_data" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenjang</th>
                            <th>Tahun</th>
                            <th>Kode</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="viewModalEdit" style="display: none;"></div>

<div class="viewModalEdit" style="display: none;"></div>
<div class="viewModalDetail" style="display: none;"></div>

<script>
    function showData() {
        table = $('#my_data').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                <<
                << << < HEAD "url": "<?= site_url('Kompetensi/ambilDataKompInti') ?>",
                ===
                === = <<
                << << < HEAD <<
                << << < HEAD "url": "<?= site_url('Kompetensi/ambilDataKompInti') ?>",
                ===
                === =
                "url": "<?= site_url('MasterData/ambilDataKompInti') ?>",
                >>>
                >>> > STPPA adding stppa sub lingkup ===
                === =
                "url": "<?= site_url('MasterData/ambilDataKompInti') ?>",
                >>>
                >>> > rexydev >>>
                >>> > 1425 fa7f19ec4b3b216007223877c59eace7f5b7 "type": "POST"
            },


            "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "width": 5
            }],

        });
    }
    $(document).ready(function() {
        showData();

        $("#centangSemua").click(function(e) {
            if ($(this).is(":checked")) {
                $('.centangPromes').prop('checked', true);
            } else {
                $('.centangPromes').prop('checked', false);
            }
        })

    });


    $(function() {
        CKEDITOR.replace('materiPokok', {
            toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            }, {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            }],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
            filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
            height: '200px'
        });
    });



    function edit(id) {
        $.ajax({
            type: 'POST',
            <<
            << << < HEAD
            url: "<?php echo base_url('Kompetensi/formEditKompInti') ?>",
            ===
            === = <<
            << << < HEAD <<
            << << < HEAD
            url: "<?php echo base_url('Kompetensi/formEditKompInti') ?>",
            ===
            === =
            url: "<?php echo base_url('MasterData/formEditKompInti') ?>",
            >>>
            >>> > STPPA adding stppa sub lingkup ===
            === =
            url: "<?php echo base_url('MasterData/formEditKompInti') ?>",
            >>>
            >>> > rexydev >>>
            >>> > 1425 fa7f19ec4b3b216007223877c59eace7f5b7
            data: {
                kompIntiID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditKompInti').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditKompInti').modal('show');
            }
        })
    }

    function detail(id) {
        $.ajax({
                    type: 'POST',
                    <<
                    << << < HEAD
                    url: "<?php echo base_url('Kompetensi/formDetailKompInti') ?>",
                    data: {
                        kompIntiID: id ===
                            === = <<
                            << << < HEAD <<
                            << << < HEAD
                        url: "<?php echo base_url('Kompetensi/formDetailKompInti') ?>",
                        data: {
                            kompIntiID: id ===
                                === =
                                url: "<?php echo base_url('MasterData/formDetailKompInti') ?>",
                            data: {
                                kompDasarID: id >>>
                                    >>> > STPPA adding stppa sub lingkup ===
                                    === =
                                    url: "<?php echo base_url('MasterData/formDetailKompInti') ?>",
                                data: {
                                    kompDasarID: id >>>
                                        >>> > rexydev >>>
                                        >>> > 1425 fa7f19ec4b3b216007223877c59eace7f5b7
                                },
                                dataType: 'json',
                                success: function(response) {
                                    $('.viewModalDetail').html(response.sukses).show(); <<
                                    << << < HEAD
                                        ===
                                        === = <<
                                        << << < HEAD <<
                                        << << < HEAD >>>
                                        >>> > 1425 fa7f19ec4b3b216007223877c59eace7f5b7
                                    $('#modalDetailKompInti').on('shown.bs.modal', function(e) {
                                        $('#namaKelas').focus();
                                    });
                                    $('#modalDetailKompInti').modal('show'); <<
                                    << << < HEAD
                                        ===
                                        === = ===
                                        === = ===
                                        === = >>>
                                        >>> > rexydev
                                    $('#modalDetailKompDasar').on('shown.bs.modal', function(e) {
                                        $('#namaKelas').focus();
                                    });
                                    $('#modalDetailKompDasar').modal('show'); <<
                                    << << < HEAD
                                        >>>
                                        >>> > STPPA adding stppa sub lingkup ===
                                        === = >>>
                                        >>> > rexydev >>>
                                        >>> > 1425 fa7f19ec4b3b216007223877c59eace7f5b7
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
                                    text: ` ${jumlahData.length}   Program Kompetensi Inti,Yakin menghapus data  ?`,
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




                    function hapus(kompIntiID) {

                        swal({
                                title: "Hapus",
                                text: "Yakin menghapus data Kompetensi Inti ?",
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
                                        <<
                                        << << < HEAD
                                        url: "<?= base_url('Kompetensi/hapusKompInti_ajax') ?>",
                                        ===
                                        === = <<
                                        << << < HEAD <<
                                        << << < HEAD
                                        url: "<?= base_url('Kompetensi/hapusKompInti_ajax') ?>",
                                        ===
                                        === =
                                        url: "<?= base_url('MasterData/hapusKompInti_ajax') ?>",
                                        >>>
                                        >>> > STPPA adding stppa sub lingkup ===
                                        === =
                                        url: "<?= base_url('MasterData/hapusKompInti_ajax') ?>",
                                        >>>
                                        >>> > rexydev >>>
                                        >>> > 1425 fa7f19ec4b3b216007223877c59eace7f5b7
                                        data: {
                                            kompIntiID: kompIntiID
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            if (response.sukses) {
                                                swal({
                                                    icon: 'success',
                                                    title: "Konfirmasi",
                                                    text: response.sukses
                                                });
                                                showData();
                                            }
                                        }
                                    })
                                } else {
                                    swal("Data tidak dihapus!");
                                }
                            });
                    }


                    function publikasi(kompIntiID) {

                        swal({
                                title: "Konfirmasi",
                                text: "Data Kompetensi Inti Publikasikan ?",
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
                                        <<
                                        << << < HEAD
                                        url: "<?= base_url('Kompetensi/updateKompIntiPublikasi') ?>",
                                        ===
                                        === = <<
                                        << << < HEAD <<
                                        << << < HEAD
                                        url: "<?= base_url('Kompetensi/updateKompIntiPublikasi') ?>",
                                        ===
                                        === =
                                        url: "<?= base_url('MasterData/updateKompIntiPublikasi') ?>",
                                        >>>
                                        >>> > STPPA adding stppa sub lingkup ===
                                        === =
                                        url: "<?= base_url('MasterData/updateKompIntiPublikasi') ?>",
                                        >>>
                                        >>> > rexydev >>>
                                        >>> > 1425 fa7f19ec4b3b216007223877c59eace7f5b7
                                        data: {
                                            kompIntiID: kompIntiID
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            if (response.sukses) {
                                                swal({
                                                    icon: 'success',
                                                    title: "Konfirmasi",
                                                    text: response.sukses
                                                });
                                                showData();
                                            }
                                        }
                                    })
                                } else {
                                    swal("Data tidak dipublikasikan!");
                                }
                            });
                    }
</script>