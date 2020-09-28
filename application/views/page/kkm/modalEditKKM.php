<div id="modalEditKKM" class="modal fade modalEditKKM" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit KKM</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('KKM/updateKKM_ajax', ['class' => 'formSimpan']) ?>
                <input type="hidden" name="kkmID" value="<?php echo $kkmID; ?>">
                <fieldset>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Kompetensi Dasar ID:</label>
                        </div>

                        <div class="col-md-12">
                            <select data-placeholder="Pilih Kompetensi Dasar" id="kompetensiDasar" class="form-control " name="kompetensiDasar">
                                <option value="<?php echo $kdID; ?>"><?php echo  '[ Semester : ' . $kdSemester . ' ] - [ Kode : ' . $kdKode . ' ]' ?></option>
                                <?php $queryKompDasar = $this->db->query("SELECT kd_semester,kd_kode FROM komp_dasar ")->result_array();
                                foreach ($queryKompDasar as $group) : ?>
                                    <option value="<?php echo $group['kd_id'] ?>"><?php echo ' [ Semester : ' . $group['kd_semester'] . ' ] - [ Kode :  ' . $group['kd_kode'] . ' ]' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input type="text" value="<?php echo $kkmIndikator; ?>" name="kkmIndikator" class="form-control" placeholder="KKM Indikator">
                        </div>

                        <div class="col-md-12 mt-1">
                            <input name="kkmKompleksitas" value="<?php echo $kkmKompleksitas; ?>" placeholder="KKM Kompleksitas" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kkmDaya" value="<?php echo $kkmDaya; ?>" placeholder="KKM Daya Dukung" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kkmIntake" value="<?php echo $kkmIntake; ?>" placeholder="KKM Intake" class="form-control" required />
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
                        $('#modalEditKKM').modal('hide')
                        $('#modalEditKKM').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('KKM/listKKM'); ?>")
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