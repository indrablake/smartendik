<div id="modalEditKelas" class="modal fade modalEditKelas" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kelas Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Sekolah/updateKelas_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $CLASS_ID ?>" name="idSekolah">
                        <div class="form-group">
                            <label>Nama Sekolah:</label>
                            <select data-placeholder="Pilih Nama Kelas" class="form-control " name="namaSekolah">
                                <option value="<?php echo $SCH_ID ?>"><?php echo $SCH_NAME ?></option>
                                <?php $queryGroup = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['SCH_ID'] ?>"><?php echo $group['SCH_NAME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenjang Kelas:</label>
                            <input type="number" class="form-control" placeholder="Kelas Sekolah" name="levelKelas" value="<?php echo $CLASS_LEVEL; ?>">
                        </div>

                        <div class="form-group">
                            <label>Nama Kelas:</label>
                            <input type="text" class="form-control" placeholder="Nama Kelas" name="kelasSekolah" value="<?php echo $CLASS_NAME; ?>">
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
                        $('[name="namaSekolah"]').val("Pilih Sekolah");
                        $('[name="levelKelas"]').val("");
                        $('[name="kelasSekolah"]').val("");
                        $('#modalEditKelas').modal('hide')
                        $('#modalEditKelas').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('sekolah/listKelas'); ?>")
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