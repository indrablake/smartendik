<div id="modalEditSubTema" class="modal fade modalEditSubTema" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sub Tema Program Semester</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Program/updateSubTemaProgram_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $SUBTHEME_ID ?>" name="subThemeID">
                        <div class="form-group">
                            <label>Tema ID:</label>
                            <select data-placeholder="Pilih Tema ID" class="form-control" name="themeID">
                                <option value="<?php echo $THEME_ID ?>"><?php echo $THEME_THEME; ?></option>
                                <?php $queryGroup = $this->db->query("SELECT * FROM TBL_PROMES_THEME")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['THEME_ID'] ?>"><?php echo $group['THEME_THEME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Tema Program Semester:</label>
                            <input type="text" id="" class="form-control" placeholder="Tema Program Semester" value="<?php echo $SUBTHEME_NAME; ?>" name="subTemaPromes">
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
                        showData();
                        $('#modalEditSubTema').modal('hide')
                        $('#modalEditSubTema').modal({
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