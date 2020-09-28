<div id="modalEditRPPHLearning" class="modal fade modalEditRPPHLearning" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Edit RPPH</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('RPPH/updateRPPHLearning_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>

                    <input type="hidden" value="<?php echo $RPPHLEARNING_ID ?>" name="RPPHLearningID">
                    <div class="form-group">
                        <label>RPPH ID:</label>
                        <select data-placeholder="Pilih RPPH ID" class="form-control" name="RPPHID">
                            <option value="<?php echo $RPPH_ID ?>"><?php echo $RPPH_ID . '-' . $CLASS_LEVEL . '-' . $CLASS_NAME ?></option>
                            <?php $queryGroup = $this->db->query("SELECT r.* , s.SCH_NAME,sc.CLASS_LEVEL,sc.CLASS_NAME
                                FROM TBL_RPPH r
                                INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
                                INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['RPPH_ID'] . '-'  . $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Kode Pembelajaran" value="<?php echo $RPPHLEARNING_CODE ?>" name="kodeLearning">
                    </div>
                    <div class="form-group">
                        <label>Materi Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Materi Pembelajaran" value="<?php echo $RPPHLEARNING_THEORY ?>" name="teoriLearning">
                    </div>
                    <div class="form-group">
                        <label>Tujuan Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Tujuan Pembelajaran" value="<?php echo $RPPHLEARNING_GOAL ?>" name="tujuanLearning">
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
                        $('#modalEditRPPHLearning').modal('hide')
                        $('#modalEditRPPHLearning').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        var search = $("#rpphid").val();
                        console.log(search);
                        $("#kodeRppm").val(search);
                        load_data(search);
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