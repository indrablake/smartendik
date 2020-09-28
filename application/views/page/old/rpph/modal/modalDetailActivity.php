<div id="modalDetailActivity" class="modal fade modalDetailActivity" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Detail RPPH Activity</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <?php echo form_open('RPPH/updateRPPHActivityDetail_ajax', ['class' => 'formUpdate']) ?>
                    <input type="hidden" value="<?php echo $RPPHACTIVITY_ID ?>" name="RPPHActivityID">
                    <div class="form-group">
                        <label>Nama Aktifitas:</label>
                        <input type="text" disabled class="form-control" placeholder="Nama Aktifitas" value="<?php echo $RPPHACTIVITY_NAME; ?>" name="activityName">
                    </div>

                    <div class="form-group">
                        <label for="">Aktifitas</label>
                        <?php $result2 = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID = '$RPPHACTIVITY_ID'")->result_array();
                        if (!empty($result2)) : ?>
                            <div class="row">
                                <?php foreach ($result2 as $query) :
                                ?>

                                    <input type="hidden" name="RPPHACTINDEX[]" id="indexActivity<?php echo $query['RPPHACTDETAIL_INDEX']; ?>" value="<?php echo $query['RPPHACTDETAIL_INDEX']; ?>">
                                    <div class="col-md-10" id="input<?php echo $query['RPPHACTDETAIL_INDEX']; ?>">
                                        <div style="text-align: right;">
                                            <input type="text" name="aktifitas[]" id="name" class="form-control" value="<?php echo $query['RPPHACTDETAIL_DESC']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1" id="button<?php echo $query['RPPHACTDETAIL_INDEX'];  ?>">
                                        <button class="btn btn-sm btn-danger btn_delete " id="indexActivity<?php echo $query['RPPHACTDETAIL_INDEX'] ?>">Hapus</button>
                                    </div>

                                <?php endforeach;  ?>

                            </div>
                        <?php else : ?>
                            <p class="text-danger" style="text-align: center;">Aktifitas Tidak Ada</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm" style="width:100%">
                            Update Data
                        </button>
                    </div>
                    <?php echo form_close() ?>
                    <?php echo form_open('RPPH/simpanDetailRPPHActivity_ajax', ['class' => 'formSimpan']) ?>
                    <div class="row mb-2 mt-2" id="dynamicFieldEdit">
                        <input type="hidden" value="<?php echo $RPPHACTIVITY_ID ?>" name="RPPHActivityID">
                        <div class="col-md-12">
                            <label>Aktifitas:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="aktifitasDetail[]" id="name" class="form-control">
                            <input type="hidden" name="idAktifitas[]" id="idAktifitas">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm text-right tambahEditAct" type="button">Tambah</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-success" style="width:100%">Simpan Data</button>
                        </div>
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
                            $('#modalDetailActivity').modal('hide')
                            $('#modalDetailActivity').modal({
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
            // Form Update
            $('.formUpdate').submit(function(e) {
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
                            $('#modalDetailActivity').modal('hide')
                            $('#modalDetailActivity').modal({
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

        $(document).ready(function() {
            var i = 1;
            var j = 1;
            $('.tambahEditAct').click(function() {
                console.log("OK");
                j++
                $('#dynamicFieldEdit').append('<div class="col-md-10 mt-2" id="row' + j + '"><input type="text" name="aktifitasDetail[]" id="name" class="form-control" placeholder="Masukan Aktfitas"><input type="hidden" name="idAktifitas[]" id="idAktifitas" value' + j + ' class="form-control" placeholder="Masukan Aktfitas"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div>')
            });
            $(document).on('click', '.btn_remove2', function() {
                var button_id = $(this).attr("id");
                $("#rowEdit" + button_id + "").remove();
                $("#rowEdit" + button_id + "").remove();
            })
        });
    </script>