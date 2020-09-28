<div id="modalDetailKompDasar" class="modal fade modalDetailKompDasar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kompetensi Dasar Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Kompetensi/updateKompDasar_ajax', ['class' => 'formSimpan']) ?>
                <input type="hidden" name="kdID" value="<?php echo $kdID; ?>">
                <fieldset>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Kompetensi Inti ID:</label>
                        </div>

                        <div class="col-md-12">
                            <select disabled data-placeholder="Pilih Kompetensi Inti" id="kompetensiInti" class="form-control " name="kompetensiInti">
                                <option value="<?php echo $kiID; ?>"><?php echo $jenjangNama . '[ Kode : ' . $kiKode . ' ] - [ Tahun : ' . $tahunPeriode . ' ]' ?></option>
                                <?php $queryKompInti = $this->db->query("SELECT js.jenjang_nm,rt.thn_ajar_periode,rt.thn_ajar_kd,ki.ki_id,ki.ki_kode,ki.ki_keterangan FROM komp_inti ki INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=ki.thn_ajar_kd INNER JOIN ref_jenjang_sekolah js ON js.jenjang_kd=ki.jenjang_kd ")->result_array();
                                foreach ($queryKompInti as $group) : ?>
                                    <option value="<?php echo $group['ki_id'] ?>"><?php echo $group['jenjang_nm'] . ' [ Kode : ' . $group['ki_kode'] . ' ] - [ Tahun :  ' . $group['thn_ajar_periode'] . ' ]' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input type="text" readonly value="<?php echo $kdSemester; ?>" name="kdSemester" class="form-control" placeholder="Semester">
                        </div>

                        <div class="col-md-12 mt-1">
                            <input name="kdKode" readonly value="<?php echo $kdKode; ?>" placeholder="Kode Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kdGroup" readonly value="<?php echo $kdGroup; ?>" placeholder="Group Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kdKeterangan" readonly value="<?php echo $kdKeterangan; ?>" placeholder="Keterangan Kompetensi Dasar" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kdAlokasiWaktu" readonly value="<?php echo $kdAlokasi; ?>" placeholder="Alokasi Waktu " class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <textarea data-sample-short rows="2" readonly name="kdTema" placeholder="Tema Kompetensi Dasar" class="form-control" required><?php echo $kdTema; ?></textarea>
                        </div>
                        <div class="col-md-12 mt-1">
                            <textarea data-sample-short rows="2" name="kdSubTema" placeholder="Sub Kompetensi Dasar" class="form-control" required><?php echo $kdSubTema; ?></textarea>
                        </div>
                        <div class="col-md-12 mt-1">
                            <textarea data-sample-short rows="2" name="kdCapaian" placeholder="Capaian Perkembangan Kompetensi Dasar" class="form-control" required><?php echo $kdCapaian; ?></textarea>
                        </div>
                    </div>

                </fieldset>
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
                        $('#modalDetailKompDasar').modal('hide')
                        $('#modalDetailKompDasar').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiDasar'); ?>")
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