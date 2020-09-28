<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Siswa</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Siswa</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listSiswa" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Siswa
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Tambah Data Siswa</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php echo form_open('Siswa/simpanSiswa_ajax', ['class' => 'formSimpan']) ?>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>NISN Siswa:</label>
                                <input type="text" name="nisn_siswa" class="form-control" placeholder="NISN Siswa">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Depan:</label>
                                <input type="text" name="nama_depan" class="form-control" placeholder="Nama Depan">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Belakang:</label>
                                <input type="text" name="nama_belakang" class="form-control" placeholder="Nama Belakang">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir:</label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir:</label>
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Desa Siswa:</label>
                                <input type="text" name="desa_siswa" class="form-control" placeholder="Desa Siswa">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kota Siswa:</label>
                                <input type="text" name="kota_siswa" class="form-control" placeholder="Kota Siswa">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Provinsi Siswa:</label>
                                <input type="text" name="provinsi_siswa" class="form-control" placeholder="Provinsi Siswa">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat Siswa:</label>
                                <textarea type="text" name="alamat_siswa" class="form-control" placeholder="Alamat Siswa"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No Telp:</label>
                                <input type="number" name="telp_siswa" class="form-control" placeholder="No Telp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>E-mail:</label>
                                <input type="email" name="email_siswa" class="form-control" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin:</label>
                                <select data-placeholder="Pilih Jenis Kelamin" class="form-control form-control-select2" id="jenkel" data-fouc name="jenis_kelamin">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agama:</label>
                                <select data-placeholder="Pilih Agama" class="form-control form-control-select2" id="agama" data-fouc name="agama_siswa">
                                    <?php $queryGroup = $this->db->query("SELECT *from TBL_RELIGION")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['REL_ID'] ?>"><?php echo $group['REL_NAME']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="viewModalEdit" style="display: none;"></div>
<!-- /basic modal -->
<script>
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
                    $('[name="nisn_siswa"]').val("");
                    $('[name="nama_depan"]').val("");
                    $('[name="nama_belakang"]').val("");
                    $('[name="tempat_lahir"]').val("");
                    $('[name="tanggal_lahir"]').val("");
                    $('[name="desa_siswa"]').val("");
                    $('[name="kota_siswa"]').val("");
                    $('[name="alamat_siswa"]').val("Pilih Sekolah");
                    $('[name="provinsi_siswa"]').val("");
                    $('[name="telp_siswa"]').val("");
                    $('[name="email_siswa"]').val("Pilih Sekolah");
                    $('[name="jenis_kelamin"]').val("");
                    $('[name="agama_siswa"]').val("");

                    window.location.href = ("<?= base_url('siswa/listSiswa'); ?>")
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
            url: "<?php echo base_url('Siswa/formEditSiswa') ?>",
            data: {
                siswaID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditSiswa').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditSiswa').modal('show');
            }
        })
    }


    function hapus(siswaID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data  siswa ?",
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
                        url: "<?= base_url('Siswa/hapusSiswa_ajax') ?>",
                        data: {
                            siswaID: siswaID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('siswa/listSiswa'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>