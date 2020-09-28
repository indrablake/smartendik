<div id="modalEditSNPKetPoin" class="modal fade modalEditSNPKetPoin" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pemantauan SNP Keterangan Poin</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('SNP/updateSNPKetPoin_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                    <input type="hidden" name="spknID" value="<?= $spknID; ?>">
                    <div class="form-group">
                        <label for="">Pemantauan SNP Poin</label>
                        <select name="snppID" class="form-control" id="">
                            <option value="<?php echo $snppID; ?>"><?php echo $snppNama; ?></option>
                            <?php $querySNP = $this->db->query("SELECT *FROM snp_poin")->result_array();
                            foreach ($querySNP as $snp) : ?>
                                <option value="<?php echo $snp['snpp_id'] ?>"><?php echo $snp['snpp_ket'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Abjad SNP Keterangan Poin:</label>
                        <input type="text" name="spkn_abjad" value="<?php echo $spknAbjad; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nilai Min:</label>
                        <input type="text" name="spkn_min" value="<?php echo $spknMin; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nilai Max:</label>
                        <input type="text" name="spkn_max" value="<?php echo $spknMax; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Keterangan Nilai:</label>
                        <textarea name="spkn_ket" class="form-control" id="" cols="4" rows="4" placeholder="Keterangan SNP Poin"><?php echo $spknKet ?></textarea>
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

    CKEDITOR.replace('ckeditor2', {
        toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
        }, {
            "name": "paragraph",
            "groups": ["list", "blocks"]
        }],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
        filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
        height: '200px'
    });


    $(document).ready(function() {
        $('.formSimpan').submit(function(e) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
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
                        $('#modalEditSNPKetPoin').modal('hide')
                        $('#modalEditSNPKetPoin').modal({
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