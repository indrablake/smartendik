<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sekolah</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Sekolah</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="listSekolah" class="btn btn-primary">
                    <i class="icon-comment-discussion mr-2"></i>
                    List Sekolah
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
                    <h5 class="card-title">Tambah Data Sekolah</h5>
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
                        <div class="col-md-12">
                            <div class="pesan">

                            </div>
                        </div>
                    </div>
                    <form id="submit">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenjang Sekolah:</label>
                                        <select name="jenjang_Sekolah" data-placeholder="Pilih Jenjang" class="form-control form-control-select2" data-fouc>
                                            <option></option>
                                            <?php $result = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array(); ?>
                                            <?php foreach ($result as $result) : ?>
                                                <option value="<?php echo $result['jenjang_kd'] ?>"><?php echo $result['jenjang_nm']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Npsn Sekolah:</label>
                                        <input type="text" name="npsn_sekolah" class="form-control" placeholder="Npsn Sekolah">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Sekolah:</label>
                                        <input type="text" name="nama_sekolah" class="form-control" placeholder="Nama Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status Sekolah:</label>
                                        <select data-placeholder="Pilih Sekolah" class="form-control form-control-select2" data-fouc name="status_sekolah">
                                            <option value="1">Swasta</option>
                                            <option value="0">Negeri</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Provinsi Sekolah:</label>
                                        <select data-placeholder="Pilih Provinsi" class="form-control" name="provinsi">
                                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_propinsi")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['propinsi_kd'] ?>"><?php echo $group['propinsi_nm'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kabupaten Sekolah:</label>
                                        <select data-placeholder="Pilih Kabupaten" class="form-control" name="kabupaten">
                                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_dati2")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['dati2_kd'] ?>"><?php echo $group['dati2_nm'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kecamatan Sekolah:</label>
                                        <select data-placeholder="Pilih Kecamatan" class="form-control" name="kecamatan">
                                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_kecamatan")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['kecamatan_kd'] ?>"><?php echo $group['kecamatan_nm'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat Sekolah:</label>
                                        <input type="text" name="alamat_sekolah" class="form-control" placeholder="Alamat Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kelurahan :</label>
                                        <input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan ">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Yayasan Sekolah:</label>
                                        <input type="text" name="yayasan_sekolah" class="form-control" placeholder="Yayasan Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kode Pos:</label>
                                        <input type="number" name="kode_pos" class="form-control" placeholder="Kode Pos">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>No Telp:</label>
                                        <input type="number" name="telp_sekolah" class="form-control" placeholder="No Telp">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fax:</label>
                                        <input type="text" name="fax_sekolah" class="form-control" placeholder="Fax">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <input type="email" name="email_sekolah" class="form-control" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Website Sekolah:</label>
                                        <input type="text" name="website_sekolah" class="form-control" placeholder="Website Sekolah">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Twitter Sekolah:</label>
                                        <input type="text" name="twitter_sekolah" class="form-control" placeholder="Website Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Facebook:</label>
                                        <input type="text" name="facebook_sekolah" class="form-control" placeholder="Facebook">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Instagram:</label>
                                        <input type="text" name="instagram_sekolah" class="form-control" placeholder="Instagram">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Logo Sekolah:</label>
                                        <input type="file" name="file_logo_sekolah" class="form-input-styled" data-fouc="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Header 1 Sekolah:</label>
                                        <input type="text" name="header1" class="form-control" placeholder="Header Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Header 2 Sekolah:</label>
                                        <input type="text" name="header2" class="form-control" placeholder="Header 2 Sekolah">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Header 3 Sekolah:</label>
                                        <input type="text" name="header3" class="form-control" placeholder="Header 3 Sekolah">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#submit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>MasterData/simpanSekolah_ajax',
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
                    if (data.error) {
                        $('.pesan').html(data.error).show()
                    } else if (data.sukses) {
                        swal({
                            icon: 'success',
                            title: "Konfirmasi",
                            text: "Sekolah Berhasil Ditambahkan"
                        });
                        window.location.href = ("<?= base_url('MasterData/listUser'); ?>")
                    }

                }
            });
        });


    });
</script>