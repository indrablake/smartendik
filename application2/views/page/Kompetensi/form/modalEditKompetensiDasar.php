<div id="modalEditKompDasar" class="modal fade modalEditKompDasar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kompetensi Dasar Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <?php echo form_open('Kompetensi/updateKompDasar_ajax', ['class' => 'formSimpan']) ?>
=======
<<<<<<< HEAD
<<<<<<< HEAD
                <?php echo form_open('Kompetensi/updateKompDasar_ajax', ['class' => 'formSimpan']) ?>
=======
                <?php echo form_open('MasterData/updateKompDasar_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> STPPA adding stppa sub lingkup
=======
                <?php echo form_open('MasterData/updateKompDasar_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                <input type="hidden" name="kdID" value="<?php echo $kdID; ?>">
                <fieldset>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Kompetensi Inti ID:</label>
                        </div>

                        <div class="col-md-12">
                            <select data-placeholder="Pilih Kompetensi Inti" id="kompetensiInti" class="form-control " name="kompetensiInti">
                                <option value="<?php echo $kiID; ?>"><?php echo $jenjangNama . '[ Kode : ' . $kiKode . ' ] - [ Tahun : ' . $tahunPeriode . ' ]' ?></option>
                                <?php $queryKompInti = $this->db->query("SELECT js.jenjang_nm,rt.thn_ajar_periode,rt.thn_ajar_kd,ki.ki_id,ki.ki_kode,ki.ki_keterangan FROM komp_inti ki INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=ki.thn_ajar_kd INNER JOIN ref_jenjang_sekolah js ON js.jenjang_kd=ki.jenjang_kd ")->result_array();
                                foreach ($queryKompInti as $group) : ?>
                                    <option value="<?php echo $group['ki_id'] ?>"><?php echo $group['jenjang_nm'] . ' [ Kode : ' . $group['ki_kode'] . ' ] - [ Tahun :  ' . $group['thn_ajar_periode'] . ' ]' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input type="text" value="<?php echo $kdSemester; ?>" name="kdSemester" class="form-control" placeholder="Semester">
                        </div>

                        <div class="col-md-12 mt-1">
                            <input name="kdKode" value="<?php echo $kdKode; ?>" placeholder="Kode Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kdKeterangan" value="<?php echo $kdKeterangan; ?>" placeholder="Keterangan Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kdAlokasiWaktu" value="<?php echo $kdAlokasi; ?>" placeholder="Alokasi Waktu " class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <textarea data-sample-short rows="2" name="kdTema" placeholder="Tema Kompetensi Dasar" class="form-control" required><?php echo $kdTema; ?></textarea>
                        </div>
                        <div class="col-md-12 mt-1">
                            <textarea data-sample-short rows="2" name="kdSubTema" placeholder="Sub Kompetensi Dasar" class="form-control" required><?php echo $kdSubTema; ?></textarea>
                        </div>
                        <div class="col-md-12 mt-1">
                            <textarea data-sample-short rows="2" name="kdCapaian" placeholder="Capaian Perkembangan Kompetensi Dasar" class="form-control" required><?php echo $kdCapaian; ?></textarea>
                        </div>
                    </div>

                </fieldset>
                <div class="text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close <i class="icon-logout ml-2"></i></button>
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
                            title: 'Update Data',
                            text: response.sukses
                        });
                        $('[name="provinsi"]').val("");
                        $('#modalEditKompDasar').modal('hide')
                        $('#modalEditKompDasar').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
<<<<<<< HEAD
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiDasar'); ?>")
=======
<<<<<<< HEAD
<<<<<<< HEAD
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiDasar'); ?>")
=======
                        window.location.href = ("<?= base_url('MasterData/listKompetensiDasar'); ?>")
>>>>>>> STPPA adding stppa sub lingkup
=======
                        window.location.href = ("<?= base_url('MasterData/listKompetensiDasar'); ?>")
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                }
            });
            return false;
        })
    })
</script>