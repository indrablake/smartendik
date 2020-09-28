<div id="modalDetailValIndicator" class="modal fade modalDetailValIndicator" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Detail RPPH Activity</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <?php echo form_open('RPPH/updateRPPHValIndicatorDetail_ajax', ['class' => 'formUpdate']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $RPPHVALINDICATOR_INDEX ?>" name="RPPHValIndikatorID">
                <div class="form-group">
                    <label>Deskripsi Valuasi:</label>
                    <input type="text" disabled class="form-control" placeholder="Nama Aktifitas" value="<?php echo $RPPHVALINDICATOR_DESC; ?>" name="descValuasi">
                </div>

                <div class="form-group">
                    <div class="row">
                        <?php $result2 = $this->db->query("SELECT *FROM TBL_RPPHVALINDICATORDETAIL WHERE RPPHVALINDICATOR_INDEX = '$RPPHVALINDICATOR_INDEX'")->result_array();

                        $no = 1;
                        foreach ($result2 as $query) :
                        ?>
                            <input type="hidden" name="rpphindex" id="indexActivity<?php echo $query['RPPHVALINDICATOR_INDEX']; ?>" value="<?php echo $query['RPPHVALINDICATOR_INDEX']; ?>">
                            <input type="hidden" name="RPPHVALINDEX[]" id="indexActivity<?php echo $query['RPPHVALINDICATOR_INDEX']; ?>" value="<?php echo $query['RPPHVALINDICATOR_INDEX']; ?>">
                            <div class="col-md-3 mt-1 input<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>">
                                Code
                            </div>
                            <div class="col-md-7 mt-1 input<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>" id="">
                                <div style="text-align: right;">
                                    <input disabled type="text" name="detailCode[]" id="name" class="form-control" value="<?php echo $query['RPPHVALINDDET_CODE']; ?>">
                                </div>
                            </div>
                            <div class="col-md-1 mt-1 button<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>" id="dsa">
                                <button class="btn btn-sm btn-danger btn_delete button<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>" data-no="<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>" id="<?php echo $query['RPPHVALINDDET_CODE'] ?>">Hapus</button>
                            </div>
                            <div class="col-md-3  mt-2 input<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>">
                                Indikator
                            </div>
                            <div class="col-md-7 mt-2 input<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>" id="input<?php echo $query['RPPHVALINDDET_CODE']; ?>">
                                <div style="text-align: right;">
                                    <input type="text" name="detailIndikator[]" id="name" class="form-control" value="<?php echo $query['RPPHVALINDDET_INDICATOR']; ?>">
                                </div>
                            </div>
                            <div class="col-md-3  mt-2 input<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>">
                                Teknik
                            </div>
                            <div class="col-md-7 mt-2 input<?= str_replace('.', '', $query['RPPHVALINDDET_CODE']); ?>" id="input<?php echo $query['RPPHVALINDDET_CODE']; ?>">
                                <div style="text-align: right;">
                                    <input type="text" name="detailTeknik[]" id="name" class="form-control" value="<?php echo $query['RPPHVALINDDET_TECHNIQUE']; ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-md-12 mt-2">
                            <button class="btn btn-primary btn-sm" style="width:100%">
                                Update Data
                            </button>
                        </div>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
            <div class="modal-body">
                <?php echo form_open('RPPH/simpanDetailRPPHValIndicator_ajax', ['class' => 'formSimpan']) ?>
                <div class="row mb-2 mt-2" id="dynamicFieldEdit">
                    <input type="hidden" value="<?php echo $RPPH_ID ?>" name="RPPHID">
                    <input type="hidden" value="<?php echo $RPPHVALINDICATOR_INDEX ?>" name="RPPHVALINDEX">

                    <div class="col-md-10 ">
                        <input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Detail Valuasi Code">
                    </div>
                    <div class="col-md-2" style="text-align:right">
                        <button class="btn btn-sm btn-primary tambahEditAct" type="button">Tambah</button>
                    </div>
                    <div class="col-md-10 mt-2">
                        <input type="text" name="detailTeknik[]" id="name" placeholder="Detail Valuasi Teknik" class="form-control">
                    </div>

                    <div class="col-md-10 mt-2">
                        <input type="text" name="detailIndikator[]" placeholder="Detail Valuasi Indikator" id="name" class="form-control">
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
                            $('#modalDetailValIndicator').modal('hide')
                            $('#modalDetailValIndicator').modal({
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
                        if (response.sukses) {
                            swal({
                                icon: 'success',
                                title: 'Update Data',
                                text: response.sukses
                            });
                            $('#modalDetailValIndicator').modal('hide')
                            $('#modalDetailValIndicator').modal({
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
                i++;
                $('#dynamicFieldEdit').append('<div class="row mb-2" id="row' + j + '"><div class="col-md-10 mt-2"><input type="text" name="detailCode[]" id="name" class="form-control" placeholder="Detail Valuasi Kode"></div><div id="row2' + j + '" class="col-md-1 mt-2"><button class="btn btn-danger btn-sm btn_remove" name="remove" id="' + j + '">X</button></div><div class="col-md-10 mt-2"><input type="text" name="detailTeknik[]" id="name" class="form-control" placeholder="Detail Valuasi Teknik"></div><div class="col-md-10 mt-2"><input type="text" name="detailIndikator[]" id="name" class="form-control" placeholder=" Detail Valuasi Indikator"></div></div></div>')
            });
            $(document).on('click', '.btn_remove2', function() {
                var button_id = $(this).attr("id");
                $("#rowEdit" + button_id + "").remove();
                $("#rowEdit" + button_id + "").remove();
            })
        });
    </script>