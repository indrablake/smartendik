<div id="modalEditSTPPATK" class="modal fade modalEditSTPPATK" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Grade Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Sekolah/updateSTPPATK_ajax', ['class' => 'formSimpan']) ?>
                <input type="hidden" value="<?php echo $STPPATK_ID ?>" name="stppatk_id">
                <div class="form-group">
                    <label>Sekolah:</label>
                    <select name="sch_id" data-placeholder="Pilih Sekolah" class="form-control select">
                        <option value="<?php echo $SCH_ID ?>"><?php echo $SCH_NAME; ?></option>
                        <?php $result = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array(); ?>
                        <?php foreach ($result as $result) : ?>
                            <option value="<?php echo $result['SCH_ID'] ?>"><?php echo $result['SCH_NAME']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tahun</label>
                    <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_year">
                        <option value="<?php echo $STPPATK_YEAR ?>"><?php echo $STPPATK_YEAR; ?></option>
                        <?php
                        $tahun = date('Y');
                        for ($i = 1990; $i <= $tahun; $i++) : ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Tahun Pembelajaran</label>
                    <div class="row">
                        <div class="col-md-6">
                            <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_studyyear" id="tahunAjaran" onchange="tahun()">
                                <option value="<?php echo $STPPATK_YEAR ?>"><?php echo $STPPATK_YEAR; ?></option>
                                <?php
                                $tahun = date('Y');
                                for ($i = 1990; $i <= $tahun; $i++) : ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" value="<?php echo intval(substr($STPPATK_STUDYYEAR, 0, 4)) + 1; ?>" disabled id="tahunAjaran2" class="form-control" name="tahunRPPH2">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="">Angka</label>
                    <input type="number" value="<?php echo $STPPATK_NUMBER; ?>" placeholder="Angka Pembelajaran" class="form-control" name="stppatk_number">
                </div>

                <div class="form-group">
                    <label for="">Appointed Place</label>
                    <input type="text" placeholder="Lokas Pembelajaran" value="<?php echo $STPPATK_APPOINTEDPLACE; ?>" class="form-control" name="stppatk_appointedplace">
                </div>

                <div class="form-group">
                    <label for="">Appointed Date</label>
                    <input type="date" class="form-control" name="stppatk_appointeddate" value="<?php echo $STPPATK_APPOINTEDDATE; ?>">
                </div>

                <div class="form-group">
                    <label for="">Head Master</label>
                    <input type="text" value="<?php echo $STPPATK_HEADMASTER; ?>" placeholder="Kepala" class="form-control" name="stppatk_headmaster">
                </div>
                <div class="form-group">
                    <label for="">Institution Head</label>
                    <input type="text" placeholder="Institution Kepala" class="form-control" name="stppatk_institutionhead" value="<?php echo $STPPATK_INSTITUTIONHEAD; ?>">
                </div>
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
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
        document.getElementById("tahunAjaran2").html = tahun + 1;
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
                        $('[name="sch_id"]').val("Pilih Sekolah");
                        $('[name="stppatk_year"]').val("");
                        $('[name="stppatk_studyyear"]').val("");
                        $('[name="tahunRPPH2"]').val("");
                        $('[name="stppatk_number"]').val("Pilih Sekolah");
                        $('[name="stppatk_appointedplace"]').val("");
                        $('[name="stppatk_headmaster"]').val("");
                        $('[name="stppatk_institutionhead"]').val("");

                        $('#modalEditSTPPATK').modal('hide')
                        $('#modalEditSTPPATK').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('sekolah/listSTPPATK'); ?>")
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