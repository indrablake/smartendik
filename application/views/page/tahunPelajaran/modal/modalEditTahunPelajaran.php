<div id="modalEditTahunPelajaran" class="modal fade modalEditTahunPelajaran" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('TahunPelajaran/updateTahunPelajaran_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <input type="hidden" name="tahunAjaranKD" value="<?php echo $tahunAjaranKD; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Tahun Ajaran:</label>
                        </div>
                        <div class="col-md-6">
                            <select data-placeholder="Pilih Tahun" class="form-control" name="tahunAjaranEdit" id="tahunAjaranEdit" onchange="tahunEdit()">
                                <option value="<?php $tahun = substr($tahunPeriode, 0, 4);
                                                echo $tahun; ?>"><?php echo $tahun; ?></option>
                                <option value="<?php echo intval(date('Y')) - 1 ?>"><?php echo intval(date('Y')) - 1 ?></option>
                                <?php
                                $tahun = date('Y');
                                for ($i = $tahun; $i >= $tahun; $i--) : ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" disabled id="tahunAjaranEdit2" class="form-control" value="<?php echo substr($tahunPeriode, 4, 4); ?>" name="tahunAjaranEdit2" placeholder="<?php echo date('Y'); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Tanggal Mulai</label>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tanggal Berakhir</label>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <input placeholder="Tanggal Mulai" type="text" class="form-control datepicker" name="tanggalMulai" value="<?php $result = date_create($tanggalMulai);
                                                                                                                                            $result = date_format($result, 'yy-m-d');
                                                                                                                                            echo $result; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <input placeholder="Tanggal Berakhir" type="text" class="form-control datepicker" name="tanggalBerakhir" value="<?php $result = date_create($tanggalAkhir);
                                                                                                                                                $result = date_format($result, 'yy-m-d');
                                                                                                                                                echo $result; ?>">
                            </div>
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
    function tahunEdit() {
        d = document.getElementById("tahunAjaranEdit").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaranEdit2").value = tahun + 1;
        document.getElementById("tahunAjaranEdit2").html = tahun + 1;
    }

    $(document).ready(function() {
        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });

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
                        $('[name="provinsi"]').val("");
                        $('#modalEditTahunPelajaran').modal('hide')
                        $('#modalEditTahunPelajaran').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('TahunPelajaran/listTahunPelajaran'); ?>")
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