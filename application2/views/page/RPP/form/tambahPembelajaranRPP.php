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
                <span class="breadcrumb-item">RPP</span>
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
                            <label>RPP:</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button" name="add" id="add">Tambah</button>
                        </div>
                        <div class="col-md-10">
                            <select data-placeholder="Pilih RPP" id="rppID" class="form-control form-control-select2" data-fouc name="rppID[]">
<<<<<<< HEAD
                                <?php $queryGroup = $this->db->query("SELECT rt.thn_ajar_periode,rt.thn_ajar_kd,rpp.rpp_id,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=rpp.thn_ajar_kd where rpp.rpp_status='1'")->result_array();
=======
<<<<<<< HEAD
<<<<<<< HEAD
                                <?php $queryGroup = $this->db->query("SELECT rt.thn_ajar_periode,rt.thn_ajar_kd,rpp.rpp_id,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=rpp.thn_ajar_kd where rpp.rpp_status='1'")->result_array();
=======
                                <?php $queryGroup = $this->db->query("SELECT rt.thn_ajar_periode,rt.thn_ajar_kd,rpp.rpp_id,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=rpp.thn_ajar_kd")->result_array();
>>>>>>> STPPA adding stppa sub lingkup
=======
                                <?php $queryGroup = $this->db->query("SELECT rt.thn_ajar_periode,rt.thn_ajar_kd,rpp.rpp_id,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=rpp.thn_ajar_kd")->result_array();
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['thn_ajar_kd'] ?>"><?php echo $group['thn_ajar_periode'] . '- [ Semester ' . $group['rpp_semester'] . ' ]' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-10 mt-1">
                            <textarea data-sample-short rows="2" name="rppKeterangan[]" placeholder="Keterangan RPP" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-10 mt-1">
                            <textarea data-sample-short rows="2" name="rppGroup[]" placeholder="Group RPP" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-10 mt-1">
                            <textarea data-sample-short rows="2" name="rppCatatan[]" placeholder="Catatan RPP" class="form-control" required></textarea>
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
            $('#dynamicField').append('<div class="row mb-2" id="row' + i + '"><div class="col-md-10 mt-1"><select data-placeholder="Pilih RPP" id="rppID" class="form-control"  name="rppID[]"> <?php foreach ($queryGroup as $group) { ?> <option value="<?php echo $group["thn_ajar_kd"] ?> "> <?php echo $group["thn_ajar_periode"]; ?> - [ Semester  <?php echo $group["rpp_semester"] ?> ]</option><?php  } ?></select></div><div id="row2' + i + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + i + '">X</button></div><div class="col-md-10">  <textarea data-sample-short rows="2" name="rppKeterangan[]" placeholder="Keterangan RPP" class="form-control mt-1" required></textarea></div><div class="col-md-10 mt-1"><textarea data-sample-short rows="2" name="rppGroup[]" placeholder="Group RPP" class="form-control" required></textarea></div><div class="col-md-10 mt-1"><textarea data-sample-short rows="2" name="rppCatatan[]" placeholder="Catatan RPP" class="form-control" required></textarea></div></div></div>')
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
            $("#row2" + button_id + "").remove();
        });

        $('#submit').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo base_url(); ?>RPP/simpanRPPPembelajaran_ajax',
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
                        text: "Tujuan Pembelajaran Berhasil Ditambahkan"
                    });
<<<<<<< HEAD
                    window.location.href = ("<?= base_url('RPP/listLangkahRPP'); ?>")
=======
<<<<<<< HEAD
<<<<<<< HEAD
                    window.location.href = ("<?= base_url('RPP/listLangkahRPP'); ?>")
=======
                    window.location.href = ("<?= base_url('MasterData/listUser'); ?>")
>>>>>>> STPPA adding stppa sub lingkup
=======
                    window.location.href = ("<?= base_url('MasterData/listUser'); ?>")
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                }
            });
        });


    });
</script>