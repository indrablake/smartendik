<div id="modalEditRPPMLearning" class="modal fade modalEditRPPMLearning" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Edit RPPM</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('RPPM/updateRPPMLearning_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>

                    <input type="hidden" value="<?php echo $RPPMLEARNING_ID; ?>" name="RPPMLearningID">
                    <div class="form-group">
                        <label>RPPM ID:</label>
                        <select data-placeholder="Pilih RPPM ID" class="form-control " name="RPPMID">
                            <option value="<?php echo $RPPM_ID ?>"><?php echo $RPPM_ID . '-' . $CLASS_LEVEL . '-' . $CLASS_NAME ?></option>
                            <?php $queryGroup = $this->db->query("SELECT rp.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPM rp INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=rp.CLASS_ID")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['RPPM_ID'] ?>"><?php echo $group['RPPM_ID'] . '-' . $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Kode Pembelajaran" value="<?php echo $RPPMLEARNING_CODE ?>" name="kodeLearning">
                    </div>
                    <div class="form-group">
                        <label>Teori Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Teori Pembelajaran" value="<?php echo $RPPMLEARNING_THEORY ?>" name="teoriLearning">
                    </div>
                    <div class="form-group">
                        <label>Tujuan Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Tujuan Pembelajaran" value="<?php echo $RPPMLEARNING_GOAL ?>" name="tujuanLearning">
                    </div>

                </fieldset>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<script>
    function tahun() {
        d = document.getElementById("tahunProgram").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunProgram2").value = tahun + 1;
        document.getElementById("tahunProgram2").html = tahun + 1;
    }

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
                        $('#modalEditRPPMLearning').modal('hide')
                        $('#modalEditRPPMLearning').modal({
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