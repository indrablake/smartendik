<div id="modalEditRPPMRPPM" class="modal fade modalEditRPPM" tabindex="-1">
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
                <?php echo form_open('RPPM/updateRPPM_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>

                    <div class="form-group">
                        <label>Kelas:</label>
                        <select data-placeholder="Pilih Kelas" class="form-control" name="kelasID">
                            <option value="<?php echo $CLASS_ID ?>"><?php echo $CLASS_LEVEL . '-' . $CLASS_NAME; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT sc.*,s.* FROM TBL_SCHOOLCLASS sc INNER JOIN TBL_SCHOOL s ON s.SCH_ID= sc.SCH_ID")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['SCH_NAME'] . " - " . $group['CLASS_LEVEL'] . " - " . $group['CLASS_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select data-placeholder="Pilih Tahun" class="form-control" name="tahunRPPM" name="kelasID" id="tahunAjaran" onchange="tahun()">
                                    <option value="<?php echo substr($RPPM_STUDYYEAR, 0, 4); ?>"><?php echo substr($RPPM_STUDYYEAR, 0, 4); ?></option>
                                    <?php
                                    $tahun = date('Y');
                                    for ($i = 1990; $i <= $tahun; $i++) : ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunRPPM2" value="<?php echo intval(substr($RPPM_STUDYYEAR, 0, 4)) + 1; ?>">

                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Semester:</label>
                        <input type="text" class="form-control" placeholder="RPPM Semester" name="semesterRPPM" value=<?= $RPPM_SEMESTER; ?>>
                    </div>
                    <div class="form-group">
                        <label>Bulan:</label>
                        <select data-placeholder="Pilih Bulan" class="form-control" name="bulanRPPM">
                            <?php
                            $bulan = '';
                            switch ($RPPM_MONTH) {
                                case 1:
                                    $bulan = "Januari";
                                    break;
                                case 2:
                                    $bulan = "Februari";
                                    break;
                                case 3:
                                    $bulan = "Maret";
                                    break;
                                case 4:
                                    $bulan = "April";
                                    break;
                                case 5:
                                    $bulan = "Mei";
                                    break;
                                case 6:
                                    $bulan = "Juni";
                                    break;
                                case 7:
                                    $bulan = "Juli";
                                    break;
                                case 8:
                                    $bulan = "Agustus";
                                    break;
                                case 9:
                                    $bulan = "September";
                                    break;
                                case 10:
                                    $bulan = "Oktober";
                                    break;
                                case 11:
                                    $bulan = "November";
                                    break;
                                case 12:
                                    $bulan = "Desember";
                                    break;
                            };
                            ?>
                            <option value="<?= $RPPM_MONTH; ?>"><?= $bulan; ?></option>
                            <?php $month = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                            for ($i = 1; $i <= 12; $i++) :
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $month[$i]; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Minggu:</label>
                        <select data-placeholder="Pilih Minggu" class="form-control" name="mingguRPPM">
                            <option value="<?= $RPPM_WEEK; ?>"><?= $RPPM_WEEK; ?></option>
                            <?php $month = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                            for ($i = 1; $i <= 4; $i++) :
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tema:</label>
                        <input type="text" class="form-control" placeholder="Tema RPPM" name="temaRPPM" value="<?= $RPPM_THEME; ?>">
                    </div>

                    <div class="form-group">
                        <label>Sub Tema:</label>
                        <input type="text" class="form-control" placeholder="Sub Tema RPPM" name="subTemaRPPM" value="<?= $RPPM_SUBTHEME; ?>">
                    </div>

                    <div class="form-group">
                        <label>Model Pembelajaran:</label>
                        <input type="text" class="form-control" placeholder="Model Pembelajaran" name="modelPembelajaran" value="<?= $RPPM_STUDYMODEL; ?>">
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
                        $('#modalEditRPPM').modal('hide')
                        $('#modalEditRPPM').modal({
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