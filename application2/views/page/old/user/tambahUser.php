<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>

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

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listUser" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Daftar User
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
                    <h5 class="card-title">Tambah Data User</h5>
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
                    <form action="simpanUser" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label>User Group:</label>
                                <select data-placeholder="Pilih User Group" class="form-control form-control-select2" data-fouc name="userGroup">

                                    <?php $queryGroup = $this->db->query("SELECT *FROM TBL_USERGROUP")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['UG_ID'] ?>"><?php echo $group['UG_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" class="form-control" placeholder="Username" name="username">
                                <?php echo form_error("username", '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        <?php echo form_error("password", '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password:</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password2">

                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <fieldset>

                            <div class="form-group">
                                <label>Sekolah:</label>
                                <select data-placeholder="Pilih Sekolah" class="form-control form-control-select2" data-fouc name="sekolahID" <?php if (!empty($queryResult->SCH_ID)) echo "disabled" ?>>
                                    <?php $queryGroup = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array();
                                    foreach ($queryGroup as $group) : ?>
                                        <option value="<?php echo $group['SCH_ID'] ?>"><?php echo $group['SCH_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>NIK:</label>
                                <input type="text" name="nik" class="form-control" placeholder="NIK">
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap:</label>
                                <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir:</label>
                                <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir:</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="bulan_lahir" data-placeholder="Bulan" class="form-control form-control-select2" data-fouc>
                                                <option></option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="tanggal_lahir" data-placeholder="Tanggal" class="form-control form-control-select2" data-fouc>
                                                <option></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="...">...</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="tahun_lahir" data-placeholder="Tahun" class="form-control form-control-select2" data-fouc>
                                                <option></option>
                                                <?php
                                                for ($tahun = 1950; $tahun < 2020; $tahun++) :
                                                ?>
                                                    <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label>Jenis Kelamin:</label>
                                <select data-placeholder="Select your country" class="form-control form-control-select2" data-fouc name="jenis_kelamin">
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Agama:</label>
                                <select data-placeholder="Select your country" class="form-control form-control-select2" data-fouc name="agama">
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="buddha">Buddha</option>
                                    <option value="hindu">Hindu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <input type="text" name="provinsi" placeholder="Provinsi">
                            </div>
                            <div class="form-group">
                                <label>Kota/Kabupaten:</label>
                                <input type="text" class="form-control" placeholder="Kota/Kabupaten" name="city">
                            </div>
                            <div class="form-group">
                                <label>Alamat:</label>
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                            </div>

                            <div class="form-group">
                                <label>No Telp:</label>
                                <input type="number" class="form-control" placeholder="No Telp" name="phone">
                            </div>

                            <div class="form-group">
                                <label>E-mail:</label>
                                <input type="email" class="form-control" placeholder="E-mail" name="email">
                            </div>
                            <div class="form-group">
                                <label>Profile User:</label>
                                <input type="hidden" name="file_old">
                                <input type="file" class="form-input-styled" data-fouc="" name="file_profile">

                            </div>
                        </fieldset>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>