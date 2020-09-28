<div id="modalEditBankSoal" class="modal fade modalEditBankSoal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bank Soal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <form id="submitUpdate">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pesan"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Bank Soal:</label>
                            <input type="hidden" name="bankSoalID" value="<?php echo $bankSoal_id; ?>">
                            <input type="text" name="bankSoal" value="<?php echo $bankSoal_name; ?>" class="form-control" placeholder="BankSoal">
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumen:</label>
                            <input type="hidden" name="file_bankSoalOLD" value="<?php echo $bankSoal_upload; ?>">
                            <input type="file" name="file_bankSoal" class="form-input-styled">
                        </div>

                    </fieldset>
                    <div class="text-right">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Close <i class="icon-logout ml-2"></i></button>
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#submitUpdate').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>guru/Pembelajaran/updateBankSoal_ajax',
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
                    text: "Bank Soal Berhasil Di Update"
                });
                window.location.href = ("<?= base_url('guru/Pembelajaran/listBankSoal'); ?>")
            }
        });
    });
</script>