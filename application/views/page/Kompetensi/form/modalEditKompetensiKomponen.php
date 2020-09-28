<div id="modalEditKompKomponen" class="modal fade modalEditKompKomponen" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kompetensi Komponen</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Kompetensi/updateKompKomponen_ajax', ['class' => 'formSimpan']) ?>
                <input type="hidden" name="rkkID" value="<?php echo $rkkID; ?>">
                <fieldset>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Nama Komponen Kompetensi:</label>
                        </div>

                        <div class="col-md-12">
                            <input type="text" value="<?php echo $komponenKompetensi; ?>" name="komponenKompetensi" class="form-control" placeholder="Semester">
                        </div>
                        <div class="col-md-12">
                            <label>Komponen Komposisi:</label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" value="<?php echo $komposisiKompetensi; ?>" name="komposisiKompetensi" class="form-control" placeholder="Semester">
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
                        $('#modalEditKompKomponen').modal('hide')
                        $('#modalEditKompKomponen').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('Kompetensi/listKompetensiKomponen'); ?>")
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