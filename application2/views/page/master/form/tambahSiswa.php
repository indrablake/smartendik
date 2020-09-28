<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">User</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">User</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="pesan"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form id="submit">
                <fieldset>

                    <div class="form-group">
                        <label>NIS:</label>
                        <input type="text" name="nik" class="form-control" placeholder="NIS">
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Depan:</label>
                                <input type="text" class="form-control" placeholder="Nama Depan" name="nama_depan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Tengah:</label>
                                <input type="text" class="form-control" placeholder="Nama Tengah" name="nama_tengah">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Belakang:</label>
                                <input type="text" class="form-control" placeholder="Nama Belakang" name="nama_belakang">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Agama:</label>
                        <select data-placeholder="Pilih Agama" class="form-control" name="agama">
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_agama")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['agama_kd'] ?>"><?php echo $group['agama_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir:</label>
                        <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input placeholder="Tanggal Lahir" type="text" class="form-control datepicker" name="tanggal_lahir">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <select data-placeholder="Pilih Jenis Kelamin" class="form-control" name="jenisKelamin">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Provinsi:</label>
                        <select data-placeholder="Pilih Provinsi" class="form-control" name="provinsi">
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_propinsi")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['propinsi_kd'] ?>"><?php echo $group['propinsi_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota/Kabupaten:</label>
                        <select data-placeholder="Pilih Kabupaten" class="form-control" name="kabupaten">
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_dati2")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['dati2_kd'] ?>"><?php echo $group['dati2_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kecamatan:</label>
                        <select data-placeholder="Pilih Kabupaten" class="form-control" name="kecamatan">
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_kecamatan")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['kecamatan_kd'] ?>"><?php echo $group['kecamatan_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat:</label>
                        <textarea name="alamat" id="" cols="4" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Kelurahan:</label>
                        <input type="text" class="form-control" placeholder="Kelurahan" name="kelurahan">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos:</label>
                        <input type="text" class="form-control" placeholder="Kode Pos" name="kodePos">
                    </div>
                    <div class="form-group">
                        <label>No Telp:</label>
                        <input type="number" class="form-control" placeholder="No Telp" name="telp">
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="email" class="form-control" placeholder="E-mail" name="email">
                    </div>
                    <div class="form-group">
                        <label>Profile User:</label>
                        <input type="file" name="file_fotoUser" class="form-input-styled" data-fouc="">
                    </div>
                </fieldset>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
        // Onchange
        $("#rowAdmin").hide();
        $("#rowPengawas").hide();
        $("#rowPegawai").hide();
        $("#rowKelas").hide();
        // End OnChange

        $('#submit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>MasterData/simpanSiswaProfile_ajax',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function() {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.error) {
                        $('.pesan').html(response.error).show()
                    }
                    if (response.sukses) {
                        swal({
                            icon: 'success',
                            title: "Konfirmasi",
                            text: "Siswa Berhasil Ditambahkan"
                        });
                        window.location.href = ("<?= base_url('MasterData/listSiswa'); ?>")
                    }

                }
            });
        });


    });
</script>