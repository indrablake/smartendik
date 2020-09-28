<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPPH</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Kompetensi Dasar</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
<<<<<<< HEAD
                <a href="<?php echo base_url() ?>Kompetensi/formTambahKompetensiDasarAlokasi" class="btn btn-default btn-sm">Tambah Data</a>
=======
<<<<<<< HEAD
<<<<<<< HEAD
                <a href="<?php echo base_url() ?>Kompetensi/formTambahKompetensiDasarAlokasi" class="btn btn-default btn-sm">Tambah Data</a>
=======
                <a href="<?php echo base_url() ?>MasterData/formTambahKompetensiDasarAlokasi" class="btn btn-default btn-sm">Tambah Data</a>
>>>>>>> STPPA adding stppa sub lingkup
=======
                <a href="<?php echo base_url() ?>MasterData/formTambahKompetensiDasarAlokasi" class="btn btn-default btn-sm">Tambah Data</a>
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
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
                <di v class="card-body">
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
                                        <label>Kompetensi Dasar:</label>
                                        <select data-placeholder="Pilih Kompetensi Dasar" class="form-control " id="kdID" name="kdID">
<<<<<<< HEAD
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where kd_status='1'")->result_array();
=======
<<<<<<< HEAD
<<<<<<< HEAD
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where kd_status='1'")->result_array();
=======
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where komp_dasar.kd_status='1'")->result_array();
>>>>>>> STPPA adding stppa sub lingkup
=======
                                            <?php $queryGroup = $this->db->query("SELECT kd_id,kd_semester,kd_kode,kd_tema from komp_dasar where komp_dasar.kd_status='1'")->result_array();
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                                            if (!empty($queryGroup)) :
                                                foreach ($queryGroup as $group) : ?>
                                                    <option value="<?php echo $group['kd_id'] ?>"><?php echo $group['kd_semester'] . ' [ Kode : ' . $group['kd_kode'] . ' ] - [ Tema :  ' . $group['kd_tema'] . ' ]' ?></option>
                                                <?php endforeach;
                                            else : ?>
                                                <option value="">Kompetensi Dasar Kosong</option>
                                            <?php endif;
                                            ?>
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
                    <div class="row" id="tabledata">
                        <div class="col-md-12">
                            <div class="card" style="padding:1em">
                                <table class="table " id="my_data" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan</th>
                                            <th>Minggu</th>
                                            <th>Jam</th>
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
        </div>
    </div>
</div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
</div>
>>>>>>> STPPA adding stppa sub lingkup
=======
</div>
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7

<div class="viewModalEdit" style="display: none;"></div>
<div class="viewModalDetail" style="display: none;"></div>


<script>
    $("#searchBtn").click(function() {
        var search = $("#kdID").val();
        console.log(search);
        $("#kodeRppm").val(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
<<<<<<< HEAD
            url: "<?php echo base_url(); ?>Kompetensi/fetchKompDasarAlokasi",
=======
<<<<<<< HEAD
<<<<<<< HEAD
            url: "<?php echo base_url(); ?>Kompetensi/fetchKompDasarAlokasi",
=======
            url: "<?php echo base_url(); ?>MasterData/fetchKompDasarAlokasi",
>>>>>>> STPPA adding stppa sub lingkup
=======
            url: "<?php echo base_url(); ?>MasterData/fetchKompDasarAlokasi",
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#tabledata").show();
                showData();
            }
        })
    }
</script>


<script>
    function showData() {
        table = $('#my_data').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
<<<<<<< HEAD
                "url": "<?= site_url('Kompetensi/ambilDataKompDasarAlokasi') ?>",
=======
<<<<<<< HEAD
<<<<<<< HEAD
                "url": "<?= site_url('Kompetensi/ambilDataKompDasarAlokasi') ?>",
=======
                "url": "<?= site_url('MasterData/ambilDataKompDasarAlokasi') ?>",
>>>>>>> STPPA adding stppa sub lingkup
=======
                "url": "<?= site_url('MasterData/ambilDataKompDasarAlokasi') ?>",
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                "type": "POST",
                "data": {
                    "kdID": $("#kdID").val()
                }
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

    CKEDITOR.replace('ckeditor', {
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

    CKEDITOR.replace('formTujuan', {
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

    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
    }

    $(document).ready(function() {
        $('.formSimpan').submit(function(e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
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
                        $('#modalTambahRPP').modal('hide');
                        $('#modalTambahRPP').modal({
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

    function edit(id) {
        $.ajax({
            type: 'POST',
<<<<<<< HEAD
            url: "<?php echo base_url('Kompetensi/formEditKompDasarAlokasi') ?>",
=======
<<<<<<< HEAD
<<<<<<< HEAD
            url: "<?php echo base_url('Kompetensi/formEditKompDasarAlokasi') ?>",
=======
            url: "<?php echo base_url('MasterData/formEditKompDasarAlokasi') ?>",
>>>>>>> STPPA adding stppa sub lingkup
=======
            url: "<?php echo base_url('MasterData/formEditKompDasarAlokasi') ?>",
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
            data: {
                kompDasarAlokasiID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditKompDasarAlokasi').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditKompDasarAlokasi').modal('show');
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
                    text: ` ${jumlahData.length}   Program RPPH,Yakin menghapus data  ?`,
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


    function hapus(kiID) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data Langkah Pembelajaran RPP ?",
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
                        url: "<?= base_url('RPP/hapusPembelajaranRPP_ajax') ?>",
                        data: {
                            kiID: kiID
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
</script>