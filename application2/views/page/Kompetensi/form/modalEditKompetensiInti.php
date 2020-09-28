<div id="modalEditKompInti" class="modal fade modalEditKompInti" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kompetensi Inti Sekolah</h5>
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
                <?php echo form_open('Kompetensi/updateKompInti_ajax', ['class' => 'formSimpan']) ?>
=======
<<<<<<< HEAD
<<<<<<< HEAD
                <?php echo form_open('Kompetensi/updateKompInti_ajax', ['class' => 'formSimpan']) ?>
=======
                <?php echo form_open('MasterData/updateKompInti_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> STPPA adding stppa sub lingkup
=======
                <?php echo form_open('MasterData/updateKompInti_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                <input type="hidden" name="kiKD" value="<?php echo $kiKD; ?>">
                <fieldset>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Jenjang Sekolah:</label>
                        </div>
                        <div class="col-md-12">
                            <select data-placeholder="Pilih Jenjang Sekolah" id="jenjangSekolah" class="form-control   " name="jenjangSekolah">
                                <option value="<?php echo $jenjangKD ?>"><?php echo $jenjangNama ?></option>
                                <?php $queryJenjang = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
                                foreach ($queryJenjang as $group) : ?>
                                    <option value="<?php echo $group['jenjang_kd'] ?>"><?php echo $group['jenjang_nm'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <select data-placeholder="Pilih Tahun Ajaran" id="tahunAjaranID" class="form-control mt-1" name="tahunAjaran">
                                <option value="<?php echo $tahunKD; ?>"><?php echo $tahunPeriode; ?></option>
                                <?php $queryTahun = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
                                foreach ($queryTahun as $group) : ?>
                                    <option value="<?php echo $group['thn_ajar_kd'] ?>"><?php echo $group['thn_ajar_periode'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12 mt-1">
                            <input name="kiKode" value="<?php echo $kodeKI; ?>" placeholder="Kode Kompetensi Inti" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <textarea data-sample-short rows="2" name="kiKeterangan" placeholder="Keterangan Kompetensi Inti" class="form-control" required><?php echo $keteranganKI; ?></textarea>
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
                        $('#modalEditKompInti').modal('hide')
                        $('#modalEditKompInti').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
<<<<<<< HEAD
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiInti'); ?>")
=======
<<<<<<< HEAD
<<<<<<< HEAD
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiInti'); ?>")
=======
                        window.location.href = ("<?= base_url('MasterData/listKompetensiInti'); ?>")
>>>>>>> STPPA adding stppa sub lingkup
=======
                        window.location.href = ("<?= base_url('MasterData/listKompetensiInti'); ?>")
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