<script src="<?php echo base_url() ?>assets/frontEnd/vendor/jquery/jquery.min.js"></script>
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="featured-box featured-box-primary text-left mt-5">
                <div class="box-content">
                    <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Register An Account</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pesan"></div>
                        </div>
                    </div>
                    <form id="submit">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Jenis User</label>
                                <select data-placeholder="Pilih Jenis User" class="form-control" name="jenisUser">
                                    <?php $jenisUser = $this->db->query("SELECT *FROM ref_jenis_user where jns_user_nm LIKE '%Pengawas%' OR jns_user_nm LIKE '%Guru'")->result_array() ?>
                                    <option value="">Pilih Jenis User</option>
                                    <?php foreach ($jenisUser as $user) : ?>
                                        <option value="<?php echo $user['jns_user_kd']; ?>"><?php echo $user['jns_user_nm']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label class="font-weight-bold text-dark text-2">Nama Depan</label>
                                <input name="nama1" class="form-control " required placeholder="Nama Depan">
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="font-weight-bold text-dark text-2">Nama Tengah</label>
                                <input name="nama2" class="form-control " required placeholder="Nama Tengah">
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="font-weight-bold text-dark text-2">Nama Belakang</label>
                                <input name="nama3" class="form-control " required placeholder="Nama Belakang">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Jenis Kelamin</label>
                                <select name="jenisKelamin" id="" class=" form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Agama</label>
                                <select name="agama" id="" class=" form-control">
                                    <option value="">Pilih Agama</option>
                                    <?php $agama = $this->db->query("SELECT *FROM ref_agama")->result_array() ?>
                                    <option value="<?php echo $agama['agama_kd']; ?>"><?php echo $agama['agama_nm']; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Tempat Lahir:</label>
                                <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir">
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group col">
                                <label>Tanggal Lahir:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input type="text" class="form-control datepicker" placeholder="Tempat Lahir" name="tanggalLahir">
                                </div>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">NIK:</label>
                                <input type="number" class="form-control" placeholder="NIK" name="nik">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">NIP</label>
                                <input type="number" value="" placeholder="NIP" name="nip" class="form-control " required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">NUPTK</label>
                                <input type="number" value="" placeholder="NUPTK" name="nuptk" class="form-control " required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">NRG</label>
                                <input type="number" value="" placeholder="NRG" name="nrg" class="form-control " required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold text-dark text-2">No Telp:</label>
                                <input type="number" class="form-control" placeholder="No Telp" name="telp">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold text-dark text-2">E-mail:</label>
                                <input type="email" class="form-control" placeholder="E-mail" name="email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Pendidikan Terakhir</label>
                                <select data-placeholder="Pilih Pendidikan Terakhir" class="form-control" name="pendidikanTerakhir">
                                    <option value="">Pilih</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="D1">D1</option>
                                    <option value="D2">D2</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Provinsi</label>
                                <select data-placeholder="Pilih Provinsi" id="provinsi" class="form-control" name="provinsi">
                                    <?php $jenisProvinsi = $this->db->query("SELECT *FROM ref_propinsi")->result_array() ?>
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($jenisProvinsi as $provinsi) : ?>
                                        <option value="<?php echo $provinsi['propinsi_kd']; ?>"><?php echo $provinsi['propinsi_nm']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Kabupaten</label>
                                <select name="kabupaten" id="kabupaten" class="kabupaten form-control">
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="kecamatan form-control">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Kelurahan:</label>
                                <input type="text" class="form-control" placeholder="Kelurahan" name="kelurahan">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Kode Pos:</label>
                                <input type="text" class="form-control" placeholder="Kode Pos" name="kodePos">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Alamat</label>
                                <textarea placeholder="Alamat " type="text" value="" name="alamat" class="form-control " required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold text-dark text-2">Username</label>
                                <textarea placeholder="Username " type="text" value="" name="username" class="form-control " required></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-dark text-2">Password</label>
                                <input type="password" name="password" value="" class="form-control " required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-dark text-2">Re-enter Password</label>
                                <input type="password" value="" name="password2" class="form-control " required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-9">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="validasi_cek" class="custom-control-input" id="terms">
                                    <label class="custom-control-label text-2" for="terms">I have read and agree to the <a href="#">terms of service</a></label>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <input type="submit" value="Register" class="btn btn-primary btn-modern float-right" data-loading-text="Loading...">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#provinsi').change(function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                url: "<?php echo base_url(); ?>Welcome/get_kabupaten",
                method: "POST",
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    html = '<option value="0">Pilih Kabupaten</option>'
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].dati2_kd + '">' + data[i].dati2_nm + '</option>';
                    }
                    console.log(data);
                    $('.kabupaten').html(html);
                }
            });
        });


        $('#kabupaten').change(function() {
            var id_kabupaten = $(this).val();
            var id_provinsi = $('#provinsi').val();
            console.log(id_provinsi);
            console.log(id_kabupaten);
            $.ajax({
                url: "<?php echo base_url(); ?>Welcome/get_kecamatan",
                method: "POST",
                data: {
                    id_provinsi: id_provinsi,
                    id_kabupaten: id_kabupaten
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    html = '<option value="0">Pilih Kecamatan</option>'
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].kecamatan_kd + '">' + data[i].kecamatan_nm + '</option>';
                    }
                    console.log(data);
                    $('.kecamatan').html(html);
                }
            });
        });
    });

    $('#submit').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>Welcome/registrasiUser',
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
                        text: "Data User Berhasil Ditambahkan, Menunggu Proses Approve"
                    });
                    window.location.href = ("<?= base_url('Welcome/register'); ?>")
                }
            }
        });
    });
</script>