<div id="modalEditPengembanganDiri" class="modal fade modalEditPengembanganDiri" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengembangan Diri</h5>
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
                            <label>Nama Pengembangan Diri:</label>
                            <input type="hidden" name="pengembanganDiriID" value="<?php echo $pengembanganDiri_id; ?>">
                            <input type="text" name="pengembanganDiri" value="<?php echo $pengembanganDiri_name; ?>" class="form-control" placeholder="PengembanganDiri">
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumen:</label>
                            <input type="hidden" name="file_pengembanganDiriOLD" value="<?php echo $pengembanganDiri_upload; ?>">
                            <input type="file" name="file_pengembanganDiri" class="form-input-styled">
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
            url: '<?php echo base_url(); ?>guru/PKB/updatePengembanganDiri_ajax',
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
                    text: "Pengembangan Diri Berhasil Di Update"
                });
                window.location.href = ("<?= base_url('guru/PKB/listPengembanganDiri'); ?>")
            }
        });
    });
</script>