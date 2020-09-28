<div id="modalEditSTPPA" class="modal fade modalEditSTPPA" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Edit STPPA</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-md-12">
                       <div class="pesan">

                       </div>
                   </div>
               </div>
               <?php echo form_open('STPPA/updateSTPPA_ajax', ['class' => 'formEdit']) ?>
               <fieldset>
<<<<<<< HEAD
               	<input type="hidden" value="<?php echo $STPPA_ID ?>" name="edit_stppa_id"/>
=======
<<<<<<< HEAD
               	<input type="hidden" value="<?php echo $STPPA_ID ?>" name="stppa_id" id="edit_stppa_id"/>
>>>>>>> Fixed # row order datatables STPPA list
                <div class="form-group">
                    <label> STPPA :</label>
                    <select data-placeholder="Pilih STPPA" class="form-control stppa" id="add_stppa" name="add_stppa">
                        <option value="">Pilih STPPA</option>
                        <?php $queryGroup = $this->db->query("SELECT s.stppa_id,s.jenjang_kd,rjs.jenjang_nm,rtp.thn_ajar_periode,rtp.thn_ajar_tgl_mulai,rtp.thn_ajar_tgl_akhir FROM stppa s left join ref_jenjang_sekolah rjs on s.jenjang_kd = rjs.jenjang_kd left join ref_tahun_pelajaran rtp on s.thn_ajar_kd = rtp.thn_ajar_kd ")->result_array();
                        if (!empty($queryGroup)) :
                            foreach ($queryGroup as $group) : ?>
                                <option value="<?php echo $group['stppa_id'] ?>"><?php echo $group['thn_ajar_periode'] . ' [ Mulai : ' . $group['thn_ajar_tgl_mulai'] . ' ] - [ Akhir :  ' . $group['thn_ajar_tgl_akhir'] . ' ]' ?></option>
                            <?php endforeach;
                        else : ?>
                            <option value="">STPPA Kosong</option>
                        <?php endif;
                        ?>
=======
                <input type="hidden" value="<?php echo $STPPA_ID ?>" name="edit_stppa_id"/>
                <div class="form-group">
                    <label> Jenjang :</label>
                    <select data-placeholder="Pilih Jenjang" class="form-control stppa" id="jenjang" name="edit_jenjang">
                        <option value="">Pilih Jenjang</option>
                        <?php $jejang = $this->db->query("SELECT * from ref_jenjang_sekolah")->result_array();
                        foreach ($jejang as $jdata) : $selected = ($JENJANG_KD==$jdata['jenjang_kd'] ? "selected='selected'" : "") ?>
                            <option value="<?php echo $jdata['jenjang_kd'] ?>" <?php echo $selected ?>><?php echo $jdata['jenjang_nm']?></option>
                        <?php endforeach; ?>
>>>>>>> rexydev
                    </select>
                </div>
                  <div class="form-group">
                      <label>Periode : </label>
<<<<<<< HEAD
                      <select data-placeholder="Pilih Periode" class="form-control" name="periode" id="periode">
=======
<<<<<<< HEAD
                      <input type="hidden" value="<?php echo $PERIODE ?>" name="edit_periode_id"/>
                      <select data-placeholder="Pilih Periode" class="form-control" name="edit_periode" id="periode">
>>>>>>> Fixed # row order datatables STPPA list
                          <?php $ref_periode = $this->db->query("SELECT * from ref_tahun_pelajaran")->result_array();
                          foreach ($ref_periode as $rdata) : $selected_periode = ($PERIODE == $rdata['thn_ajar_kd'] ? ' selected="selected"' : ""); ?>
                            	<option value="<?php echo ($rdata['thn_ajar_kd']) ?>" <?php echo $selected_periode ?> ><?php echo date('j F Y',strtotime($rdata['thn_ajar_tgl_mulai'])).' - '.date('j F Y',strtotime($rdata['thn_ajar_tgl_akhir']));?></option>
=======
                      <select data-placeholder="Pilih Periode" class="form-control" name="edit_periode" id="periode">
                          <?php $ref_periode = $this->db->query("SELECT * from ref_tahun_pelajaran")->result_array();
                          foreach ($ref_periode as $rdata) : $selected_periode = ($PERIODE == $rdata['thn_ajar_kd'] ? ' selected="selected"' : ""); ?>
                              <option value="<?php echo ($rdata['thn_ajar_kd']) ?>" <?php echo $selected_periode ?> ><?php echo date('j F Y',strtotime($rdata['thn_ajar_tgl_mulai'])).' - '.date('j F Y',strtotime($rdata['thn_ajar_tgl_akhir']));?></option>
>>>>>>> rexydev
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="edit-lingkup-list">
                      <label>Lingkup Perkembangan:</label>

                      <div class="float-right">
                          <button type="button" name="add" id="add-edit-lingkup-list" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                      </div>
                      <?php if (isset($STPPA_LINGKUP)): ?>
                        <?php foreach ($STPPA_LINGKUP as $key => $value): ?>
                          <div class="form-group">
                              <div class="input-group"> 
                                <input type="hidden" name="idlingkup_edit[]" value="<?php echo $value['sl_id'] ?>">
                                <input type="text" class="form-control" name="lingkup_edit[]" value="<?php echo $value['sl_keterangan'] ?>" maxlength="512" placeholder="" required="">
                                <?php if ($key!=0): ?>
                                  <div class="input-group-append">
                                    <button type="button" data-remove="<?php echo $value['sl_id'] ?>" onclick="return onedit_remove_lingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                                  </div>
                                <?php endif ?>
                              </div>
                          </div>
                        <?php endforeach ?>
                      <?php else: ?>
                        <div class="form-group">
                            <div class="input-group"> 
                                <input type="text" class="form-control" name="lingkup_edit[]" value="" maxlength="512" placeholder="" required="">
                            </div>
                        </div>
                      <?php endif ?>
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

    function removeLingkup(par) {
      var jumlahData = $('input[name^="lingkupEdit"]');
      if (jumlahData.length == 0) {
          swal({
              icon: 'warning',
              title: 'Perhatikan',
              text: 'Maaf tidak ada data yang dipilih'
          });
      } else {
          swal({
                  title: "Hapus",
                  text: `Yakin menghapus lingkup yang dipilih  ?`,
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                  showCancelButton: true,
                  confirmButtonText: 'Ya, Hapus',
                  cancelButtonText: 'Tidak'
              })
              .then((willDelete) => {
                  if (willDelete) {
                      console.log("OK");
                      console.log('S',$(par).attr('data-remove'));
                      $.ajax({
                          type: "POST",
                          url: "<?php echo site_url('STPPA/hapusSTPPALingkup_ajax') ?>",
                          data: {sl_id:$(par).attr('data-remove')},
                          dataType: "json",
                          success: function(response) {
                              if (response.sukses) {
                                  console.log("OK");
                                  swal({
                                      icon: 'success',
                                      title: "Konfirmasi",
                                      text: response.sukses
                                  });
                                  $(par).parent().parent().parent().remove();
                              }
                          },
                          error: function(xhr, ajaxOptions, thrownError) {
                              alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                              console.log('error',xhr,xhr.responseText,thrownError);
                          }
                      })
                  } else {
                      swal("Data tidak ada yang dihapus!");
                  }
              });
      }
      return false;
    }

    $(document).ready(function() {
        $('.formEdit').submit(function(e) {
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
                        $('#modalEditSTPPA').modal('hide')
                        $('#modalEditSTPPA').modal({
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