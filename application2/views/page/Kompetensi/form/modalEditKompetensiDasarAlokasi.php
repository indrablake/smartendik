<div id="modalEditKompDasarAlokasi" class="modal fade modalEditKompDasarAlokasi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kompetensi Dasar Alokasi</h5>
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
                <?php echo form_open('Kompetensi/updateKompDasarAlokasi_ajax', ['class' => 'formSimpan']) ?>
=======
<<<<<<< HEAD
<<<<<<< HEAD
                <?php echo form_open('Kompetensi/updateKompDasarAlokasi_ajax', ['class' => 'formSimpan']) ?>
=======
                <?php echo form_open('MasterData/updateKompDasarAlokasi_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> STPPA adding stppa sub lingkup
=======
                <?php echo form_open('MasterData/updateKompDasarAlokasi_ajax', ['class' => 'formSimpan']) ?>
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                <input type="hidden" name="kadKode" value="<?php echo $kadKode; ?>">
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
                            <input type="text" value="<?php echo $kadBulan; ?>" name="kadBulan" class="form-control" placeholder="Kompetensi Alokasi Bulan">
                        </div>

                        <div class="col-md-12 mt-1">
                            <input name="kadMinggu" value="<?php echo $kadMinggu; ?>" placeholder="Kompetensi Alokasi Minggu" class="form-control" required />
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="kadJumlah" value="<?php echo $kadJumlah; ?>" placeholder="Kompetensi Alokasi Jumlah" class="form-control" required />
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
                        $('#modalEditKompDasarAlokasi').modal('hide')
                        $('#modalEditKompDasarAlokasi').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
<<<<<<< HEAD
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiDasarAlokasi'); ?>")
=======
<<<<<<< HEAD
<<<<<<< HEAD
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiDasarAlokasi'); ?>")
=======
                        window.location.href = ("<?= base_url('MasterData/listKompetensiDasarAlokasi'); ?>")
>>>>>>> STPPA adding stppa sub lingkup
=======
                        window.location.href = ("<?= base_url('MasterData/listKompetensiDasarAlokasi'); ?>")
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