<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPP</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Kompetensi Inti</span>
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
                <div class="container" id="dynamicField">
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <label>Kompetensi Inti ID:</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                        </div>
                        <div class="col-md-10">
                            <select data-placeholder="Pilih Kompetensi Inti" id="kompetensiInti" class="form-control form-control-select2" data-fouc name="kompetensiInti[]">
                                <?php $queryKompInti = $this->db->query("SELECT js.jenjang_nm,rt.thn_ajar_periode,rt.thn_ajar_kd,ki.ki_id,ki.ki_kode,ki.ki_keterangan FROM komp_inti ki INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=ki.thn_ajar_kd INNER JOIN ref_jenjang_sekolah js ON js.jenjang_kd=ki.jenjang_kd where ki.ki_status='1' ")->result_array();
                                foreach ($queryKompInti as $group) : ?>
                                    <option value="<?php echo $group['ki_id'] ?>"><?php echo $group['jenjang_nm'] . ' [ Kode : ' . $group['ki_kode'] . ' ] - [ Tahun :  ' . $group['thn_ajar_periode'] . ' ]' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="kdSemester[]" class="form-control" placeholder="Semester">
                        </div>

                        <div class="col-md-10 mt-1">
                            <input name="kdKode[]" placeholder="Kode Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-10 mt-1">
                            <input name="kdGroup[]" placeholder="Group Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-10 mt-1">
                            <input name="kdKeterangan[]" placeholder="Keterangan Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-10 mt-1">
                            <input name="kdAlokasiWaktu[]" placeholder="Alokasi Waktu " class="form-control" required />
                        </div>
                        <div class="col-md-10 mt-1">
                            <textarea data-sample-short rows="2" name="kdTema[]" placeholder="Tema Kompetensi Dasar" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-10 mt-1">
                            <textarea data-sample-short rows="2" name="kdSubTema[]" placeholder="Sub Kompetensi Dasar" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-10 mt-1">
                            <textarea data-sample-short rows="2" name="kdCapaian[]" placeholder="Capaian Perkembangan Kompetensi Dasar" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>


                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        var i = 1;
        var j = 1;
        $('#add').click(function() {
            i++;
            $('#dynamicField').append('<div class="row mb-2" id="row' + i + '"><div class="col-md-10 mt-1"><select data-placeholder="Pilih Kompetensi Inti" id="kompetensiInti" class="form-control"  name="kompetensiInti[]"> <?php foreach ($queryKompInti as $group) { ?> <option value="<?php echo $group["ki_id"] ?> "> <?php echo $group["jenjang_nm"] . " [ Kode :" . $group["ki_kode"] . " ]" . " [ Tahun :" . $group["thn_ajar_periode"] . " ]"; ?></option><?php  } ?></select></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div><div class="col-md-10 mt-1"><input  name="kdSemester[]" placeholder="Semester" class="form-control mt-1" required/></div><div class="col-md-10">  <input name="kdKode[]" placeholder="Kode Kompetensi Dasar" class="form-control mt-1" required/></div><div class="col-md-10">  <input name="kdGroup[]" placeholder="Group Kompetensi Dasar" class="form-control mt-1" required/></div><div class="col-md-10">  <input name="kdKeterangan[]" placeholder="Keterangan Kompetensi Dasar" class="form-control mt-1" required/></div><div class="col-md-10">  <input name="kdAlokasiWaktu[]" placeholder="Alokasi Waktu Kompetensi Dasar" class="form-control mt-1" required/></div><div class="col-md-10 mt-1"><textarea data-sample-short rows="2" name="kdTema[]" placeholder="Tema Kompetensi Dasar" class="form-control" required></textarea></div><div class="col-md-10 mt-1"><textarea data-sample-short rows="2" name="kdSubTema[]" placeholder="Sub Tema Kompetensi Dasar" class="form-control" required></textarea></div><div class="col-md-10 mt-1"><textarea data-sample-short rows="2" name="kdCapaian[]" placeholder="Capaian Perkembangan Kompetensi Dasar" class="form-control" required></textarea></div></div></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

        $('#submit').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo base_url(); ?>Kompetensi/simpanKompetensiDasar_ajax',
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
                        text: "Kompetensi Dasar Berhasil Ditambahkan"
                    });
                    window.location.href = ("<?= base_url('Kompetensi/listKompetensiDasar'); ?>")
                }
            });
        });


    });
</script>