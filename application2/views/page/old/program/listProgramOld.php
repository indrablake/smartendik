<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/notifications/bootbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/switch.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_checkboxes_radios.js"></script>
<script src="<?php echo base_url() ?>assets/js/app.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

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
                <span class="breadcrumb-item">Program</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_tambah">
                    <i class="icon-comment-discussion mr-2"></i>
                    Tambah Program
                </button>
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
            <div class="card">
                <table class="table datatable-basic" id="my_data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Tahun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<!-- <?php $query = $this->db->query("SELECT sc.CLASS_NAME,sc.CLASS_LEVEL, pm.* FROM TBL_PROMES pm  INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=pm.CLASS_ID")->result_array();
        $no = 1;
        foreach ($query as $q) :
        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $q['CLASS_LEVEL'] . '-' . $q['CLASS_NAME']; ?></td>
                                <td><?php echo $q['PROMES_SEMESTER']; ?></td>
                                <td><?php echo $q['PROMES_YEAR']; ?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url() ?>Laporan" class="btn btn-primary mt-1 btn-sm">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?> -->
<div id="modal_tambah" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sub Tema Program Semester</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>

                        <div class="form-group">
                            <label>Kelas:</label>
                            <select data-placeholder="Pilih Kelas" class="form-control form-control-select2" data-fouc name="namaKelas" id="namaKelas">
                                <option value=""></option>
                                <?php
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester:</label>
                            <input id="semesterProgram" type="text" class="form-control" placeholder="Semester" name="semesterProgram">
                        </div>

                        <div class="form-group">
                            <label>Tahun:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select data-placeholder="Pilih Tahun" class="form-control form-control-select2" name="tahunProgram" data-fouc id="tahunAjaran" onchange="tahun()">
                                        <option value=""></option>
                                        <?php
                                        $tahun = date('Y');
                                        for ($i = 1990; $i <= $tahun; $i++) : ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunProgram2">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Strategi Pembelajaran:</label>
                            <textarea id="strategiPembelajaran" type="text" class="form-control" placeholder="Strategi Pembelajaran" name="strategiPembelajaran"></textarea>
                        </div>



                    </fieldset>
                    <div class="text-right">
                        <button type="button" id="btn_save" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editprogram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Program Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="formdataprogram">

                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            // show_product();
            $('#my_data').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= base_url('Program/get_ajax') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [],
                    "className": 'text-right'
                }]
            });
            //Save product
            $('#btn_save').on('click', function() {
                console.log("OK");
                var namaKelas = $('#namaKelas').val();
                var tahunProgram = $('#tahunAjaran').val();
                var semesterProgram = $('#semesterProgram').val();
                var strategiPembelajaran = $('#strategiPembelajaran').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('simpanProgramSemester') ?>",
                    dataType: "JSON",
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    data: {
                        namaKelas: namaKelas,
                        tahunProgram: tahunProgram,
                        semesterProgram: semesterProgram,
                        strategiPembelajaran: strategiPembelajaran
                    },
                    success: function(data) {
                        swal.close();
                        swal({
                            icon: 'success',
                            title: 'Tambah Data',
                            text: 'Anda Berhasil Menambah Data Program Semester'
                        })
                        $('[name="namaKelas"]').val("");
                        $('[name="tahunProgram"]').val("");
                        $('[name="semesterProgram"]').val("");
                        $('[name="strategiPembelajaran"]').val("");
                        $('#modal_tambah').modal('hide')
                        $('#modal_tambah').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                    }
                });
                return false;
            });

            $('#my_data').on('click', '.ubah-program', function() {
                // ambil element id pada saat klik ubah
                var id = $(this).data('id');

                $.ajax({
                    type: "post",
                    url: "<?= base_url('Program/updateProgram_ajax') ?>",
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    data: {
                        id: id
                    },
                    success: function(data) {
                        swal.close();
                        $('#editprogram').modal('show');
                        $('#formdataprogram').html(data);

                        // proses untuk mengubah data
                        $('#formubahdataprogram').on('click', '.submitProgram', function() {
                            var namaKelas = $('#namaKelas').val(); // diambil dari id nama yang ada diform modal
                            var semesterProgram = $('#semester').val();
                            var promesID = $('#promesID').val();
                            var strategiPembelajaran = $('#strategiPembelajaran').html();
                            var tahunProgram = $('#tahunProgram').val();
                            console.log(namaKelas);
                            console.log(semesterProgram);
                            console.log(strategiPembelajaran);
                            console.log(tahunProgram);
                            return false;
                        });
                    }
                });
            });

            // End Function
        });


        //function show all product
        function show_product() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('Program/getDataPromes') ?>',
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>1</td>' +
                            '<td>' + data[i].CLASS_LEVEL + '-' + data[i].CLASS_NAME + '</td>' +
                            '<td>' + data[i].CLASS_LEVEL + '-' + data[i].CLASS_NAME + '</td>' +
                            '<td>' + data[i].CLASS_LEVEL + '-' + data[i].CLASS_NAME + '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }
    </script>