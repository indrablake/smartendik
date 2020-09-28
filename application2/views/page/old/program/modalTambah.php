<div id="modalTambah" class="modal fade modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Program Semester</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('Program/simpanPromes_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <div class="form-group">
                        <label>Kelas:</label>
                        <select data-placeholder="Pilih Kelas" class="form-control" name="namaKelas" id="namaKelas">
                            <option value="">Pilih Kelas</option>
                            <?php
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester:</label>
                        <input id="semesterProgram" type="text" class="form-control" placeholder="Semester" name="semesterProgram">
                    </div>

                    <div class="form-group">
                        <label>Tahun:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" name="tahunProgram" id="tahunProgram" onchange="tahun()">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                    $tahun = date('Y');
                                    for ($i = 1990; $i <= $tahun; $i++) : ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled id="tahunProgram2" class="form-control" name="tahunProgram2">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Strategi Pembelajaran:</label>
                        <textarea id="strategiPembelajaran" type="text" class="form-control" placeholder="Strategi Pembelajaran" name="strategiPembelajaran"></textarea>
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
                            title: 'Tambah Data',
                            text: response.sukses
                        });
                        showData();
                        $('#modalTambah').modal('hide')
                        $('#modalTambah').modal({
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