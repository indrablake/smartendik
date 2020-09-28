<div id="modalEdit" class="modal fade modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tema Program Semester</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Program/updateTemaProgram_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <input type="hidden" value="<?php echo $THEME_ID ?>" name="themeID">
                    <div class="form-group">
                        <label>Promes ID:</label>
                        <select data-placeholder="Pilih Promes ID" class="form-control" name="promesID">
                            <option value="<?php echo $promesID ?>"><?php echo $CLASS_LEVEL . '/' . $CLASS_NAME . '/' . $PROMES_SEMESTER ?></option>
                            <?php $queryGroup = $this->db->query("SELECT * FROM tbl_promes INNER JOIN tbl_schoolclass ON  tbl_promes.CLASS_ID = tbl_schoolclass.CLASS_ID")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['PROMES_ID'] ?>"><?php echo $group['CLASS_LEVEL'] . '/' . $group['CLASS_NAME'] . '-' . $group['PROMES_SEMESTER'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tema Program Semester:</label>
                        <input type="text" class="form-control" placeholder="Semester" value="<?php echo $THEME_THEME ?>" name="temaProgram">
                    </div>
                    <div class="form-group">
                        <label>Evaluasi Bulanan:</label>
                        <input type="text" value="<?= $THEME_MONTHLY_EVALUATION; ?>" class="form-control" placeholder="Evaluasi Bulanan" name="evaluasiBulanan">
                    </div>
                    <div class="form-group">
                        <label>Alokasi Waktu:</label>
                        <input type="text" class="form-control" value="<?= $THEME_TIME_ALLOCATION; ?>" placeholder="Alokasi Waktu" name="alokasiWaktu">
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
                        showData();
                        $('#modalEdit').modal('hide')
                        $('#modalEdit').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
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