<div id="modalEditRPPHValIndicator" class="modal fade modalEditRPPHValIndicator" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Edit RPPH Valuasi Indikator</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('RPPH/updateRPPHValIndicator_ajax', ['class' => 'formSimpan']) ?>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $RPPHVALINDICATOR_INDEX ?>" name="RPPHValIndikatorID">
                    <div class="form-group">
                        <label>RPPH ID:</label>
                        <select data-placeholder="Pilih RPPH ID" class="form-control " name="RPPHID">
                            <option value="<?php echo $RPPH_ID ?>"><?php echo  $CLASS_LEVEL . '-' . $CLASS_NAME; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT *from tbl_rpph INNER JOIN tbl_schoolclass ON tbl_schoolclass.CLASS_ID=tbl_rpph.CLASS_ID
INNER JOIN tbl_school ON tbl_school.SCH_ID=tbl_schoolclass.SCH_ID")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['RPPH_ID'] ?>"><?php echo $group['SCH_NAME'] . '-' . $group['CLASS_NAME'] . '-' . $group['CLASS_LEVEL'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Valuasi Indikator Deskripsi:</label>
                        <input type="text" class="form-control" placeholder="Valuasi Indikator Deskripsi" value="<?php echo $RPPHVALINDICATOR_DESC ?>" name="valIndicatorDesc">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-primary">Edit Data</button>
            </div>
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
                        $('#modalEditRPPHValIndicator').modal('hide')
                        $('#modalEditRPPHValIndicator').modal({
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