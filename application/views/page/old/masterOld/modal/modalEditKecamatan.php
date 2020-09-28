<div id="modalEditKecamatan" class="modal fade modalEditKecamatan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Provinsi Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('MasterData/updateKecamatan_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <input type="hidden" class="form-control" name="kecamatanID" value="<?php echo $kecamatanID; ?>">
                    <div class="form-group">
                        <label>Provinsi :</label>
                        <select name="propinsiID" class="form-control" id="">
                            <option value="<?php echo $propinsi_kd ?>"><?= $propinsi_nm; ?></option>
                            <?php foreach ($dataProvinsi as $provinsi) : ?>
                                <option value=<?= $provinsi['propinsi_kd']; ?>><?= $provinsi['propinsi_nm']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kabupaten :</label>
                        <select name="kabupatenID" class="form-control" id="">
                            <option value="<?php echo $kabupatenID ?>"><?= $kabupatenNama; ?></option>
                            <?php foreach ($dataKabupaten as $kabupaten) : ?>
                                <option value=<?= $kabupaten['dati2_kd']; ?>><?= $kabupaten['dati2_nm']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?= $kecamatanNama; ?>" name="kecamatan">
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
                        $('#modalEditKecamatan').modal('hide')
                        $('#modalEditKecamatan').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('MasterData/listKecamatan'); ?>")
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