<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>

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
                <a href="listProgram" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Program
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
                    <h5 class="card-title">Tambah Data Program</h5>
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

                    </div>
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
</div>
<script>
    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
        document.getElementById("tahunAjaran2").html = tahun + 1;
    }
</script>
<script>
    $(document).ready(function() {
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
                        type: 'success',
                        title: 'Update Mahasiswa',
                        text: 'Anda Berhasil Mengubah Data Mahasiswa'
                    })
                    $('[name="namaKelas"]').val("");
                    $('[name="tahunProgram"]').val("");
                    $('[name="semesterProgram"]').val("");
                    $('[name="strategiPembelajaran"]').val("");

                }
            });
            return false;
        });
    });
</script>