<div id="modalEditKelas" class="modal fade modalEditKelas" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kelas Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('MasterData/updateKelas_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <div class="form-group">
                        <select name="sekolahKD" id="" class="form-control">
                            <option value="<?= $sekolahKD; ?>"><?= $sekolahNPSN . '-' . $sekolahNama; ?></option>
                            <?php $result = $this->db->query("SELECT *FROM dat_sekolah")->result_array();
                            foreach ($result as $sekolah) : ?>
                                <option value="<?= $sekolah['sekolah_kd']; ?>"><?= $sekolah['sekolah_npsn'] . '-' . $sekolah['sekolah_nm']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas :</label>
                        <select name="namaKelas" id="" class="form-control">
                            <option value="<?= $kelasLevel; ?>"><?= $kelasKode; ?></option>
                            <?php $resultKelas = $this->db->query("SELECT *FROM ref_tingkat_kelas")->result_array();
                            foreach ($resultKelas as $kelas) : ?>
                                <option value="<?= $kelas['tk_kls_level']; ?>"><?= $kelas['tk_kls_kode']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Kelas :</label>
                        <input type="text" class="form-control" placeholder="Kelas Sekolah" name="jenisKelas" value="<?php echo $kelasNama; ?>">
                        <input type="hidden" class="form-control" placeholder="Kelas Sekolah" name="kelasKD" value="<?php echo $kelasKD; ?>">
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
                        $('#modalEditKelas').modal('hide')
                        $('#modalEditKelas').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('MasterData/listKelas'); ?>")
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