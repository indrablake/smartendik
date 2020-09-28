<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets2/sumoselect/jquery.sumoselect.min.js"></script>
<link href="<?php echo base_url() ?>assets2/sumoselect/sumoselect.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js">
</script>
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
                <input type="hidden" name="idProfile" value="<?= $this->input->get("id"); ?>">
                <input type="hidden" name="jenis" value="">

                <fieldset>
                    <div class="form-group">
                        <label>Jenis User:</label>
                        <select id="jenisUser" data-placeholder="Pilih Jenis User" class="form-control form-control-select2" data-fouc name="userGroup">
                            <option value="" required>Pilih Jenis User</option>
                            <?php $queryGroup = $this->db->query("SELECT *FROM ref_jenis_user WHERE jns_user_nm NOT LIKE '%Siswa'")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php
                                                $resultNama = preg_replace("/[^a-zA-Z]/", "", $group['jns_user_nm']);
                                                echo $group['jns_user_kd'] . ' ' . strtolower($resultNama) ?>"><?php echo $group['jns_user_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>NIP:</label>
                        <input type="text" name="nik" class="form-control" placeholder="NIP">
                    </div>
                    <div>

                        <div class="row">
                            <div class="col-md-12 mb-2" id="rowSekolah">
                                <div class="form-group">
                                    <div class="row school">
                                        <div class="col-10">
                                            <label>Sekolah : </label>
                                        </div>

                                    </div>
                                </div>
                                <div id="list_sekolah">
                                    <div class="row">
                                        <div class="col-12">
                                            <select data-placeholder="Pilih Sekolah" class="form-control-select2" data-fouc name="sekolahID">
                                                <option value="">Pilih</option>
                                                <?php $queryGroup = $this->db->query("SELECT *FROM dat_sekolah ")->result_array();
                                                foreach ($queryGroup as $group) : ?>
                                                    <option value="<?= $group['sekolah_kd'] ?>"><?= $group['sekolah_npsn'] . '-' . $group['sekolah_nm']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2 mb-2" id="rowKelas">
                                <div class="form-group">
                                    <div class="row class">
                                        <div class="col-10">
                                            <label>Kelas : </label>
                                            <!--                                         <div class="col-2 sub-class">
                                            <div class="text-right">
                                                <button class="btn btn-success btn-sm add-class"><span class="fa fa-plus"></span></button>
                                            </div>
                                        </div> -->
                                        </div>
                                    </div>
                                    <div id="list_kelas">
                                        <div class="row">
                                            <div class="col-12">
                                                <select multiple="multiple" placeholder="Hello  im from placeholder" onchange="console.log($(this).children(':selected').length)" class="testSelAll" name="kelasID[]">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="nuptk" style="display:hidden">
                                <div class="form-group">
                                    <label>NUPTK:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input placeholder="NUPTK" type="text" class="form-control" name="nuptk">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="nrg" style="display:hidden">
                                <div class="form-group">
                                    <label>NRG:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input placeholder="NRG" type="text" class="form-control" name="nrg">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="rowTanggalMulai">
                                <div class="form-group">
                                    <label>Tanggal Mulai:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input placeholder="Tanggal Mulai" type="text" class="form-control datepicker" name="tanggalMulai">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="rowTanggalAkhir">
                                <div class="form-group">
                                    <label>Tanggal Akhir:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input placeholder="Tanggal Akhir" type="text" class="form-control datepicker" name="tanggalAkhir">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Pegawai -->
                        <div class="row">
                            <div class="col-md-12" id="nuptk">
                                <div class="form-group">
                                    <label>Pendidikan:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <select data-placeholder="Pilih Pendidikan Terakhir" class="form-control-select2" data-fouc name="pendidikanTerakhir">
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
                            </div>
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
                            <label>Keterangan Jabatan:</label>
                            <input type="text" class="form-control" placeholder="Keterangan Jabatan" name="keterangan_jabatan">
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
    var mainurl = "<?php echo base_url(); ?>";
    $(document).ready(function() {
        $('.testSelAll').SumoSelect();

        $("#provinsi").change(function() {

            var value = $(this).val();
            if (value > 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('User/ambil_data') ?>",
                    cache: false,
                    data: {
                        modul: 'kabupaten',
                        id: value
                    },
                    success: function(respond) {
                        $("#kabupaten-kota").html(respond);
                    }
                })
            }

        });


        $("#kabupaten-kota").change(function() {
            var value = $(this).val();
            if (value > 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('User/ambil_data') ?>",
                    cache: false,
                    data: {
                        modul: 'kecamatan',
                        id: value
                    },
                    success: function(respond) {
                        $("#kecamatan").html(respond);
                    }
                })
            }
        })

        $("#kecamatan").change(function() {
            var value = $(this).val();
            if (value > 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('User/ambil_data') ?>",
                    cache: false,
                    data: {
                        modul: 'kelurahan',
                        id: value
                    },
                    success: function(respond) {
                        $("#kelurahan-desa").html(respond);
                    }
                })
            }
        })
    });
    // $("select[name^='sekolahID']").change(function() {


    // });
    $('#jenisUser').on('change', function() {
        var opt = ``;
        $.ajax({
                url: mainurl + "Api/sekolah",
                dataType: 'json',
                success: function(data) {
                    console.log('le', data.length);
                    // $("select[name^='sekolahID']").empty();
                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            console.log('item ', item);
                            opt += `
<option value="` + item['sekolah_kd'] + `">` + item['sekolah_npsn'] + ` - ` + item['sekolah_nm'] + `</option>
`;
                        });
                    }
                }
            })
            .always(function() {
                console.log("complete");
                $("select[name^='sekolahID']").html(opt);
            });
        var jenis = $(this).val();
        // console.log(jenis.replace(/[^0-9]+/g, ''));
        // console.log(jenis.replace(/[^a-zA-Z]+/g, ''));
        $("input[name='jenis']").val(jenis);
        // console.log(`sjjs`,$("input[name='jenis']").val());
        if (jenis.match(/guru/)) {
            $("#rowSekolah").show();
            $("#rowKelas").show();
            $("#rowTanggalMulai").hide();
            $("#rowTanggalAkhir").hide();
            $("#nuptk").show();
            $("#nrg").show();
            $("#list_sekolah").children('select[name^="sekolahID"]').prop('name', 'sekolahID');
            $('.remove-sekolah').parents('.mt-1').remove();
            $('.remove-kelas').parents('.mt-1').remove();
            $('.sub-school').remove();
            $("#list_kelas").children('select[name="kelasID"]').prop('name', 'kelasID[]');
            // console.log('n ',$("#list_sekolah").find('row').children().children().children().not('select[name="sekolahID[0]"]'));
            $('.class').append(`
        <div class="col-2 sub-class">
            <div class="text-right">
                <button type="button" class="btn btn-success btn-sm add-class"><span class="fa fa-plus"></span></button>
            </div>
        </div>
    `);
        } else if (jenis.match(/kepalasekolah/)) {
            $("#rowSekolah").show();
            $("#rowTanggalMulai").show();
            $("#rowTanggalAkhir").show();
            $("#rowKelas").hide();
            $("#list_sekolah").children('select[name^="sekolahID"]').prop('name', 'sekolahID');
            $('.remove-sekolah').parents('.mt-1').remove();
            $('.sub-school').remove();
        } else if (jenis.match(/pengawas/)) {
            $("#rowSekolah").show();
            $("#rowTanggalMulai").show();
            $("#rowTanggalAkhir").show();
            $("#rowKelas").hide();
            // $("#list_sekolah").find('select[name^="sekolahID"]').each(function(index, el) {
            //     console.log('aaa ',$(el).val());
            // });
            $('.remove-sekolah').parents('.mt-1').remove();
            $("#list_sekolah").children('select[name="sekolahID"]').prop('name', 'sekolahID[0]');
            // console.log('n ',$("#list_sekolah").find('row').children().children().children().not('select[name="sekolahID[0]"]'));
            $('.school').append(`
    <div class="col-2 sub-school">
        <div class="text-right">
            <button class="btn btn-success btn-sm add-school"><span class="fa fa-plus"></span></button>
        </div>
    </div>
`);
        } else {
            $("#rowSekolah").hide();
            $("#rowTanggalMulai").show();
            $("#rowTanggalAkhir").show();
            $("#rowKelas").hide();
            $("#list_sekolah").children('select[name="sekolahID"]').prop('name', 'sekolahID[0]');
            $('.remove-sekolah').parents('.mt-1').remove();

        }
        // if (jenis.match(/admin/)) {
        //     $("#sekolahan").show();
        //     $("#rowPengawas").hide();;
        // } else if (jenis.match(/pengawas/)) {
        //     $("#rowAdmin").hide();
        //     $("#rowPengawas").show();
        //     $("#rowPegawai").hide();
        // } else if (jenis.match(/pegawai/)) {
        //     $("#rowPegawai").show();
        //     $("#rowPengawas").hide();
        //     $("#rowAdmin").hide();
        // }
    });

    $(document).on('click', '.add-class', function(event) {
        event.preventDefault();
        var len = $('select[name^="kelasID"]').length;
        var comp = $("#list_kelas").append(`
<div class="row mt-1">
    <div class="col-11">
    <select multiple="multiple" placeholder="Hello  im from placeholder" onchange="console.log($(this).children(':selected').length)" class="testSelAll" name="kelasID[]">
                                                </select>
    </div>
    <div class="col-1">
        <button type="button" kelas-id="` + len + `" class="btn btn-danger remove-kelas"><span class="fa fa-minus"></span></button>
    </div>
</div>
`);
        var opt = ``;

        $("select[name='kelasID[" + (len) + "]']").select2();

        var opt = ``;
        console.log("sid ", $("select[name='sekolahID']").val());
        $.ajax({
                url: mainurl + "Api/kelas",
                dataType: 'json',
                data: {
                    id: $("select[name='sekolahID']").val()
                },
                success: function(data) {
                    // $("select[name^='sekolahID']").empty();
                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            console.log('item ', item);
                            opt += `
<option value="` + item['kelas_kd'] + `">` + item['tk_kls_level'] + ` - ` + item['kelas_nm'] + `</option>
`;
                        });
                    }
                }
            })
            .always(function() {
                console.log("complete");
                $("select[name='kelasID[" + len + "]']").html(opt);
            });
    });


    $(document).on('click', '.add-school', function(event) {
        event.preventDefault();
        var len = $('select[name^="sekolahID"]').length;
        var comp = $("#list_sekolah").append(`
<div class="row mt-1">
    <div class="col-11">
    <select data-placeholder="Pilih Sekolah" class=" form-control-select2" data-fouc name="sekolahID[` + (len) + `]">
    </select>
    </div>
    <div class="col-1">
        <button type="button" school-id="` + len + `" class="btn btn-danger remove-sekolah"><span class="fa fa-minus"></span></button>
    </div>
</div>
`);
        var opt = ``;

        $("select[name='sekolahID[" + (len) + "]']").select2();

        var opt = ``;
        $.ajax({
                url: mainurl + "Api/sekolah",
                dataType: 'json',
                success: function(data) {
                    // $("select[name^='sekolahID']").empty();
                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            console.log('item ', item);
                            opt += `
<option value="` + item['sekolah_kd'] + `">` + item['sekolah_npsn'] + ` - ` + item['sekolah_nm'] + `</option>
`;
                        });
                    }
                }
            })
            .always(function() {
                console.log("complete");
                $("select[name='sekolahID[" + len + "]']").html(opt);
            });
    });




    $(document).on('change', 'select[name^="sekolahID"]', function(event) {
        event.preventDefault();
        $('select[name^="kelasID"]').empty();
        $.ajax({
            url: '<?php echo site_url() . "Kelas/getKelasBySekolah" ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                sekolah: $('select[name="sekolahID"] option:selected').val()
            },
            success: function(data) {
                if (data.length > 0) {
                    data.forEach((item, index) => {

                        $(".testSelAll").append('<option value="option6">option6</option>');
                    });
                } else {
                    $('select[name^="kelasID"]').empty();

                }
            },
            error: function() {}
        });

        /* Act on the event */
    });
    $(document).ready(function() {
        $("#rowSekolah").hide();
        $("#rowTanggalMulai").hide();
        $("#rowTanggalAkhir").hide();
        $("#rowKelas").hide();
        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
        // Onchange
        // End OnChange
        $('#submit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>User/simpanDetailProfile_ajax',
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
                            text: "Profile Berhasil Ditambahkan"
                        });
                        //window.location.href = ("<?= base_url('User/listUser'); ?>")
                    }
                }
            });
        });
    });
</script>