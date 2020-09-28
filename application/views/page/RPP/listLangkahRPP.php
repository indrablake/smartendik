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
                <span class="breadcrumb-item">RPP</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="<?php echo base_url() ?>RPP/formTambahPembelajaranRPP" class="btn btn-default btn-sm">Tambah Data</a>
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
                                            <?php $queryGroup = $this->db->query("SELECT rt.thn_ajar_periode,rt.thn_ajar_kd,rpp.rpp_id,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=rpp.thn_ajar_kd where rpp.rpp_status='1'")->result_array();
                                            if (!empty($queryGroup)) :
                                                foreach ($queryGroup as $group) : ?>
                                                    <option value="<?php echo $group['rpp_id'] ?>"><?php echo $group['thn_ajar_periode'] . '- [ Semester ' . $group['rpp_semester'] . ' ]' ?></option>
                                                <?php endforeach;
                                            else : ?>
                                                <option value="">RPP Kosong</option>
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
                                            <th>RPP</th>
                                            <th>Media</th>
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
</div>

<div class="viewModalEdit" style="display: none;"></div>
<div class="viewModalDetail" style="display: none;"></div>


<script>
    $("#searchBtn").click(function() {
        var search = $("#rpphid").val();
        console.log(search);
        $("#kodeRppm").val(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPP/fetchLangkah",
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
                "url": "<?= site_url('rpp/ambilDataLangkahRPP') ?>",
                "type": "POST",
                "data": {
                    "rpplpID": $("#rpphid").val()
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
            url: "<?php echo base_url('RPP/formEditLangkahRPP') ?>",
            data: {
                rpplpID: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditLangkahRPP').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditLangkahRPP').modal('show');
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


    function hapus(rpplpID) {

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
                            rpplpID: rpplpID
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