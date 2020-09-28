<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/node_modules/ckeditor4/ckeditor.js"></script>

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
                <input type="hidden" name="profileID" value="<?= $this->input->get("profileID"); ?>">
                <fieldset>
                    <div class="form-group">
                        <label>Jenis User:</label>
                        <select data-placeholder="Pilih Sekolah" class="form-control form-control-select2" data-fouc name="userGroup">
                            <option value="<?= $dataProfileUser->jns_user_kd; ?>"><?= $dataProfileUser->jns_user_nm; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_jenis_user")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['jns_user_kd'] ?>"><?php echo $group['jns_user_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>NIK:</label>
                        <input type="text" name="nik" class="form-control" value="<?= $dataProfileUser->profile_nomor_id; ?>" placeholder="NIK">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Depan:</label>
                                <input type="text" value="<?= $dataProfileUser->profile_nm_1; ?>" class="form-control" placeholder="Nama Depan" name="nama_depan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Tengah:</label>
                                <input value="<?= $dataProfileUser->profile_nm_2; ?>" type="text" class="form-control" placeholder="Nama Tengah" name="nama_tengah">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Belakang:</label>
                                <input value="<?= $dataProfileUser->profile_nm_3; ?>" type="text" class="form-control" placeholder="Nama Belakang" name="nama_belakang">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Agama:</label>
                        <select data-placeholder="Pilih Agama" class="form-control" name="agama">
                            <option value="<?= $dataProfileUser->agama_kd; ?>"><?= $dataProfileUser->agama_nm; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_agama")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['agama_kd'] ?>"><?php echo $group['agama_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir:</label>
                        <input type="text" value="<?= $dataProfileUser->profile_tempat_lahir; ?>" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input placeholder="Tanggal Mulai" value="<?= $dataProfileUser->profile_tgl_lahir; ?>" type="text" class="form-control datepicker" name="tanggal_lahir">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <select data-placeholder="Pilih Jenis Kelamin" class="form-control" name="jenisKelamin">
                            <option value="L" <?php if ($dataProfileUser->profile_jns_kelamin == 'L') echo "checked" ?>>Laki-Laki</option>
                            <option value="P" <?php if ($dataProfileUser->profile_jns_kelamin == 'P') echo "checked" ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Provinsi:</label>
                        <select data-placeholder="Pilih Provinsi" class="form-control" name="provinsi">
                            <option value="<?= $dataProfileUser->propinsi_kd; ?>"><?= $dataProfileUser->propinsi_nm; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_propinsi")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['propinsi_kd'] ?>"><?php echo $group['propinsi_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota/Kabupaten:</label>
                        <select data-placeholder="Pilih Kabupaten" class="form-control" name="kabupaten">
                            <option value="<?= $dataProfileUser->dati2_kd; ?>"><?= $dataProfileUser->dati2_nm; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_dati2")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['dati2_kd'] ?>"><?php echo $group['dati2_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kecamatan:</label>
                        <select data-placeholder="Pilih Kabupaten" class="form-control" name="kecamatan">
                            <option value="<?= $dataProfileUser->kecamatan_kd; ?>"><?= $dataProfileUser->kecamatan_nm; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_kecamatan")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['kecamatan_kd'] ?>"><?php echo $group['kecamatan_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat:</label>
                        <textarea name="alamat" id="" cols="4" rows="4" class="form-control"><?= $dataProfileUser->profile_alamat; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Kelurahan:</label>
                        <input type="text" class="form-control" placeholder="Kelurahan" value="<?= $dataProfileUser->profile_kelurahan; ?>" name="kelurahan">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos:</label>
                        <input type="text" value="<?= $dataProfileUser->profile_kd_pos; ?>" class="form-control" placeholder="Kode Pos" name="kodePos">
                    </div>
                    <div class="form-group">
                        <label>No Telp:</label>
                        <input value="<?= $dataProfileUser->profile_telp; ?>" type="number" class="form-control" placeholder="No Telp" name="telp">
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="email" value="<?= $dataProfileUser->profile_email; ?>" class="form-control" placeholder="E-mail" name="email">
                    </div>
                    <div class="form-group">
                        <label>Keterangan Jabatan:</label>
                        <input value="<?= $dataProfileUser->profile_ket_jabatan; ?>" type="text" class="form-control" placeholder="Keterangan Jabatan" name="keterangan_jabatan">
                    </div>

                    <div class="form-group">
                        <label>Profile User:</label>
                        <input type="hidden" value="<?= $dataProfileUser->profile_foto; ?>" name="file_fotoUserOld">
                        <input type="file" name="file_fotoUser" class="form-input-styled" data-fouc="">
                    </div>
                    <div class="form-group">
                        <img src="<?= base_url() ?>uploads/imageUser/thumbnail/<?= $dataProfileUser->profile_foto; ?>" alt="">
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

        $('#submit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>User/updateDetailProfile_ajax',
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

                    swal({
                        icon: 'success',
                        title: "Konfirmasi",
                        text: "Profile Berhasil Diedit"
                    });
                    window.location.href = ("<?= base_url('User/listUser'); ?>")
                }
            });
        });


    });
</script>