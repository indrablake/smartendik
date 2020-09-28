<div id="modalEditRPP" class="modal fade modalEditRPP" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit RPP</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <form id="submitUpdate">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pesan"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama RPP:</label>
                            <input type="hidden" name="rppID" value="<?php echo $rpp_id; ?>">
                            <input type="text" name="rpp" value="<?php echo $rpp_name; ?>" class="form-control" placeholder="RPP">
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumen:</label>
                            <input type="hidden" name="file_rppOLD" value="<?php echo $rpp_upload; ?>">
                            <input type="file" name="file_rpp" class="form-input-styled">
                        </div>

                        <div class="form-group">
                            <label>Tahun Ajaran:</label>
                            <select data-placeholder="Pilih Tahun Ajaran" id="jenjangSekolahID" class="form-control" name="thn_ajar_kd">
                                <option value="<?php echo $thn_ajar_kd; ?>"><?php echo $thn_ajar_periode; ?></option>
                                <?php
                                foreach ($dataTahun as $group) : ?>
                                    <option value="<?php echo $group['thn_ajar_kd'] ?>"><?php echo $group['thn_ajar_periode'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenjang Sekolah:</label>
                            <select data-placeholder="Pilih Jenjang Sekolah" id="jenjangSekolahID" class="form-control" name="jenjang_kd">
                                <option value="<?php echo $jenjang_kd; ?>"><?php echo $jenjang_nm; ?></option>
                                <?php
                                foreach ($dataJenjang as $group) : ?>
                                    <option value="<?php echo $group['jenjang_kd'] ?>"><?php echo $group['jenjang_nm'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas:</label>
                            <select data-placeholder="Pilih Kelas" id="kelasID" class="form-control" name="kelas">
                                <option value="<?php echo $kelas; ?>"><?php echo $kelas; ?></option>
                                <?php
                                $kelasNama = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                for ($i = 0; $i <= 12; $i++) : ?>
                                    <option value="<?php echo $kelasNama[$i] ?>"><?php echo $kelasNama[$i] ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester:</label>
                            <input type="text" name="semester" class="form-control" value="<?php echo $semester ?>" placeholder="Semester">
                        </div>

                    </fieldset>
                    <div class="text-right">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Close <i class="icon-logout ml-2"></i></button>
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#submitUpdate').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>guru/perencanaanPEMB/updateRPP_ajax',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function() {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                        swal.showLoading()
                    }
                })
            },
            success: function(data) {

                swal({
                    icon: 'success',
                    title: "Konfirmasi",
                    text: "RPP Berhasil Di Update"
                });
                window.location.href = ("<?= base_url('guru/perencanaanPEMB/listRPP'); ?>")
            }
        });
    });
</script>