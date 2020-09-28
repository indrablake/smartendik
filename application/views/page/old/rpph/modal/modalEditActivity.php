<div id="modalEditRPPH" class="modal fade modalEditRPPH" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Edit RPPH Activity</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('RPPH/updateRPPHActivity_ajax', ['class' => 'formSimpan']) ?>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $RPPHACTIVITY_ID ?>" name="RPPHActivityID">
                    <div class="form-group">
                        <label>RPPH ID:</label>
                        <select data-placeholder="Pilih RPPH ID" class="form-control " name="RPPHID">
                            <option value="<?php echo $RPPH_ID ?>"><?php echo $RPPH_ID . $CLASS_LEVEL . '-' . $CLASS_NAME ?></option>
                            <?php $queryGroup = $this->db->query("SELECT r.* , s.SCH_NAME,sc.CLASS_LEVEL,sc.CLASS_NAME
                                FROM TBL_RPPH r
                                INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
                                INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['RPPH_ID'] .  $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Aktifitas:</label>
                        <input type="text" class="form-control" placeholder="Hari" value="<?php echo $RPPHACTIVITY_NAME ?>" name="activityName">
                    </div>
                    <div class="form-group">
                        <label>Waktu Aktifitas:</label>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group" id="datetimepicker5">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text add-on"><i data-time-icon="icon-alarm"></i></span>
                                    </span>
                                    <input value="<?php $waktu1 = substr($RPPHACTIVITY_TIME, 0, 4);
                                                    $waktuPecah = substr($waktu1, 0, 2);
                                                    $waktuPecah2 = substr($waktu1, 2, 2);
                                                    $waktuFix1 = $waktuPecah . ':' . $waktuPecah2;
                                                    echo $waktuFix1; ?>" data-format="hh:mm" class="form-control pickatime" placeholder="Masukan Jam Mulai" name="activityTime">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">-</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" id="datetimepicker6">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text add-on"><i data-time-icon="icon-alarm"></i></span>
                                    </span>
                                    <input data-format="hh:mm" value="<?php $waktu2 = substr($RPPHACTIVITY_TIME, 4, 4);
                                                                        $waktuPecah3 = substr($waktu2, 0, 2);
                                                                        $waktuPecah4 = substr($waktu2, 2, 2);
                                                                        $waktuFix2 = $waktuPecah3 . ':' . $waktuPecah4;
                                                                        echo $waktuFix2; ?>" class="form-control pickatime" placeholder="Masukan Jam Mulai" name="activityTime2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Edit Data</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#datetimepicker5').datetimepicker({
            pickDate: false
        });
    });
    $(function() {
        $('#datetimepicker6').datetimepicker({
            pickDate: false
        });
    });
</script>

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
                        $('#modalEditRPPH').modal('hide')
                        $('#modalEditRPPH').modal({
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