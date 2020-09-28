<div id="modalEditPenilaianRPP" class="modal fade modalEditPenilaianRPP" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Edit Penilaian Pembelajaran RPP</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">
                        </div>
                    </div>
                </div>

                <?php echo form_open('RPP/updatePenilaianRPP_ajax', ['class' => 'formSimpan']) ?>

                <fieldset>
                    <input type="hidden" name="rpppID" value="<?= $rpppID; ?>">
                    <div class="col-md-12">
                        <label>RPP:</label>
                    </div>
                    <div class="col-md-12 mb-2">
                        <select data-placeholder="Pilih RPP" id="rppID" class="form-control" name="rppID">
                            <option value="<?php echo $rppID ?>"><?php echo $tahunPeriode . ' [ Semester : ' . $semester . ']'; ?></option>
                            <?php $queryGroup = $this->db->query("SELECT rt.thn_ajar_periode,rt.thn_ajar_kd,rpp.rpp_id,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=rpp.thn_ajar_kd")->result_array();
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['rpp_id'] ?>"><?php echo $group['thn_ajar_periode'] . '- [ Semester ' . $group['rpp_semester'] . ' ]' ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <textarea data-sample-short rows="2" name="rppKeterangan" id="keteranganEdit" placeholder="Keterangan" class="form-control" required><?php echo $keterangan; ?></textarea>
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

    CKEDITOR.replace('keteranganEdit', {
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
                        $('#modalEditPenilaianRPP').modal('hide')
                        $('#modalEditPenilaianRPP').modal({
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