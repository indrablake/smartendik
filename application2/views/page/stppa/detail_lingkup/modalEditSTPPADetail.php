<div id="modalEditSTPPASubLingkup" class="modal fade modalEditSTPPASubLingkup" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo (empty($STPPA_SUB_LINGKUP) ? "Tambah" : "Edit"); ?> Sub Lingkup STPPA</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-md-12">
                       <div class="pesan">

                       </div>
                   </div>
               </div>
               <?php echo form_open('STPPA/updateSTPPASubLingkup_ajax', ['class' => 'formEdit']) ?>
               <fieldset>
                <input type="hidden" value="<?php echo $STPPA_LINGKUP['stppa_id'] ?>" name="last_edit_stppa"/>
                  <div class="form-group">
                      <label>STPPA :</label>
                      <select data-placeholder="Pilih STPPA" class="form-control" name="edit_stppa" id="edit_stppa">
                          <?php $stppa = $this->db->query("SELECT * from stppa  inner join ref_jenjang_sekolah on stppa.jenjang_kd = ref_jenjang_sekolah.jenjang_kd inner join ref_tahun_pelajaran on stppa.thn_ajar_kd = ref_tahun_pelajaran.thn_ajar_kd")->result_array(); ?>
                            <?php if (empty($stppa)): ?>
                              <option value="">STPPA Kosong</option>
                            <?php else: ?>
                              <option value="">Pilih STPPA</option>
                            <?php foreach ($stppa as $jdata) : $selected = ($STPPA_LINGKUP['stppa_id'] == $jdata['stppa_id'] ? ' selected="selected"' : ""); ?>
                              <option value="<?php echo ($jdata['stppa_id']) ?>" <?php echo $selected ?> > <?php echo $jdata['thn_ajar_periode'] . ' [ Mulai : ' . $jdata['thn_ajar_tgl_mulai'] . ' ] - [ Akhir :  ' . $jdata['thn_ajar_tgl_akhir'] . ' ]' ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>STPPA Lingkup : </label>
                      <input type="hidden" value="<?php echo $STPPA_LINGKUP['sl_id'] ?>" name="last_edit_stppa_lingkup"/>
                      <select data-placeholder="Pilih Lingkup" class="form-control" name="edit_stppa_lingkup" id="edit_stppa_lingkup">
                          
                          <?php $stppa_lingkup = $this->db->query("SELECT * from stppa_lingkup where stppa_id = '".$STPPA_LINGKUP['stppa_id']."'")->result_array(); ?>
                          <?php if (empty($stppa_lingkup)): ?>
                            <option value="">Lingkup STPPA Kosong</option>
                          <?php else: ?>
                            <option value="">Pilih Lingkup STPPA</option>
                            <?php foreach ($stppa_lingkup as $rdata) : $selected_lingkup = ($STPPA_LINGKUP['sl_id'] == $rdata['sl_id'] ? ' selected="selected"' : ""); ?>
                                <option value="<?php echo ($rdata['sl_id']) ?>" <?php echo $selected_lingkup ?> > <?php echo $rdata['sl_keterangan'] ?></option>
                            <?php endforeach; ?>
                          <?php endif ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>STPPA Lingkup Perkembangan : </label>
                      <input type="hidden" value="<?php echo $STPPA_SUB_LINGKUP['sl_id'] ?>" name="last_edit_stppa_lingkup"/>
                      <select data-placeholder="Pilih Lingkup" class="form-control" name="edit_stppa_lingkup" id="edit_stppa_lingkup">
                          
                          <?php $stppa_lingkup = $this->db->query("SELECT * from stppa_sub_lingkup where sl_id = '".$STPPA_LINGKUP['sl_id']."'")->result_array(); ?>
                          <?php if (empty($stppa_lingkup)): ?>
                            <option value="">Lingkup Perkembangan STPPA Kosong</option>
                          <?php else: ?>
                            <option value="">Pilih Lingkup STPPA</option>
                            <?php foreach ($stppa_lingkup as $rdata) : $selected_lingkup = ($STPPA_LINGKUP['sl_id'] == $rdata['sl_id'] ? ' selected="selected"' : ""); ?>
                                <option value="<?php echo ($rdata['sl_id']) ?>" <?php echo $selected_lingkup ?> > <?php echo $rdata['sl_keterangan'] ?></option>
                            <?php endforeach; ?>
                          <?php endif ?>
                      </select>
                  </div>
                  <div class="edit-lingkup-list">
                    <label>Detail Perkembangan:</label>
                    <div class="float-right">
                        <button type="button" name="add" id="add-sub-lingkup-list-edit" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                    </div>
                    <div class="edit-sublingkup-list">
                      <?php if (isset($STPPA_SUB_LINGKUP) && $STPPA_SUB_LINGKUP!=null): ?>
                        <?php foreach ($STPPA_SUB_LINGKUP as $key => $value): ?>
                          <div class="form-group">
                              <div class="input-group"> 
                                <input type="hidden" name="id_sublingkup[]" value="<?php echo $value['ssl_id'] ?>">
                                <input type="text" class="form-control" name="edit_sublingkup[]" value="<?php echo $value['ssl_keterangan'] ?>" maxlength="512" placeholder="">

                                  <div class="input-group-append">
                                    <button type="button" data-remove="<?php echo $value['ssl_id'] ?>" onclick="return removeSubLingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                                  </div>
                              </div>
                          </div>
                        <?php endforeach ?>
                      <?php else: ?>
                        <div class="form-group">
                            <div class="input-group"> 
                                <input type="hidden" name="id_sublingkup[]" value="">
                                <input type="text" class="form-control" name="edit_sublingkup[]" value="" maxlength="512" placeholder="" required="">

                                <div class="input-group-append">
                                  <button type="button" data-remove="0" onclick="return removeSubLingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                                </div>
                            </div>
                        </div>
                      <?php endif ?>
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


  $(document).on('click', '#add-sub-lingkup-list-edit', function(event) {
      event.preventDefault();
      var e = $("#edit-sublingkup-list").children('.form-group').length;
      //console.log("uye",e);
      /* Act on the event */
      $(".edit-sublingkup-list").append(`
          <div class="form-group">
              <div class="input-group"> 
                <input type="hidden" name="id_sublingkup[]" value="">
                <input type="text" class="form-control" name="edit_sublingkup[]" value="" maxlength="512" placeholder="">
                  <div class="input-group-append">
                    <button type="button" data-remove="0" onclick="return removeSubLingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                  </div>
              </div>
          </div>
      `).on('keyup', '#lingkup-'+e+'', function(event) {
          event.preventDefault();
            
      });
  });

   $(document).on('change', '#edit_stppa', function(event) {
   event.preventDefault();
       $.ajax({
         url: '<?php echo site_url()."STPPA/getLingkupSTPPA" ?>',
         type: 'POST',
         dataType: 'json',
         data: {
          id:  $("#edit_stppa option:selected").val()
        },
         success:function(data){
           var opt = `
            <option value="">Pilih Lingkup STPPA</option>
           `;
           if (data.length>0) {
             data.forEach((item, index)=> {
                 opt+=`
                   <option value="`+item['sl_id']+`">`+item['sl_keterangan']+`</option>
                 `;
             });

             $(".modal-title").text("Ubah Sub Lingkup STPPA");
           } else {
            $(".modal-title").text("Tambah Sub Lingkup STPPA");
             opt+=`
               <option value="">STPPA Lingkup Kosong</option>
             `;
             $(".edit-sublingkup-list").html(`
               <div class="form-group">
                   <div class="input-group"> 
                     <input type="hidden" name="id_sublingkup[]" value="">
                     <input type="text" class="form-control" name="edit_sublingkup[]" value="" maxlength="512" placeholder="">
                       <div class="input-group-append">
                         <button type="button" data-remove="0" onclick="return removeSubLingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                       </div>
                   </div>
               </div>
             `);

           }
           $("#edit_stppa_lingkup").html(opt); 
         },error:function(){
          $(".modal-title").text("Tambah Sub Lingkup STPPA");
           $("#edit_stppa_lingkup").html(`<option value="">STPPA Lingkup Kosong</option>`);
           /* Act on the event */
         }
       });
    /* Act on the event */
  });

  $(document).on('change', "#edit_stppa_lingkup", function(event) {
    event.preventDefault();
    $.ajax({
      url: '<?php echo site_url()."STPPA/getSubLingkupSTPPA" ?>',
      type: 'post',
      dataType: 'json',
      data: {id: $(".edit-sublingkup-list option:selected").val(),id_lingkup:$("#edit_stppa_lingkup option:selected").val(),stppa_id:$("#edit_stppa option:selected").val()},
      success:function(data){
        console.log('dada',data.length,data);
        var opt = ``;
        if (data.length>0) {
          $("#edit-stppa").val(data[0].stppa_id);
          $("#edit-stppa").val(data[0].stppa_id);
          data.forEach((item,index)=>{
            opt += `
            <div class="form-group">
                <div class="input-group"> 
                  <input type="hidden" name="id_sublingkup[]" value="`+item['ssl_id']+`">
                  <input type="text" class="form-control" name="edit_sublingkup[]" value="`+item['ssl_keterangan']+`" maxlength="512" placeholder="">
                    <div class="input-group-append">
                      <button type="button" data-remove="`+item['ssl_id']+`" onclick="return removeSubLingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                    </div>
                </div>
            </div>
            `;
          });
          $(".edit-sublingkup-list").html(opt);
        } else {
          $(".edit-sublingkup-list").html(`
            <div class="form-group">
                <div class="input-group"> 
                  <input type="hidden" name="id_sublingkup[]" value="">
                  <input type="text" class="form-control" name="edit_sublingkup[]" value="" maxlength="512" placeholder="">
                    <div class="input-group-append">
                      <button type="button" data-remove="0" onclick="return removeSubLingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                    </div>
                </div>
            </div>
          `);
        }
      },error:function(){

          $(".edit-sublingkup-list").html(`
            <div class="form-group">
                <div class="input-group"> 
                  <input type="hidden" name="id_sublingkup[]" value="">
                  <input type="text" class="form-control" name="edit_sublingkup[]" value="" maxlength="512" placeholder="">
                    <div class="input-group-append">
                      <button type="button" data-remove="0" onclick="return removeSubLingkup(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                    </div>
                </div>
            </div>
          `);
      }
    })
    .done(function() {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
    /* Act on the event */
  });


    function removeSubLingkup(par) {
      var jumlahData = $('input[name^="edit_sublingkup"]');
      if (jumlahData.length == 0) {
          swal({
              icon: 'warning',
              title: 'Perhatikan',
              text: 'Maaf tidak ada data yang dipilih'
          });
      } else {
          if ($(par).data('remove')=="0") {
            $(par).parent().parent().parent().remove();
          }else{
            swal({
                    title: "Hapus",
                    text: `Yakin menghapus sub lingkup yang dipilih  ?`,
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
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('STPPA/hapusSTPPASubLingkup_ajax') ?>",
                            data: {sub_id:$(par).attr('data-remove')},
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
                                    // if ( $(par).parent().parent().parent().children('.form-group').length< 1) {
                                    //   $('#modalEditSTPPASubLingkup').modal('hide')
                                    //   $('#modalEditSTPPASubLingkup').modal({
                                    //       backdrop: 'false',
                                    //       keyboard: 'true',
                                    //       show: 'false'
                                    //   });
                                    // } else {

                                    // }
                                }else{
                                  swal({
                                      icon: 'warning',
                                      title: "Konfirmasi",
                                      text: response.error
                                  });
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
                    showData();
                });
          }

      }
      return false;
    }

    $(document).ready(function() {
        $('.formEdit').submit(function(e) {
            console.log("OK",$(this).serialize());
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
                        $('#modalEditSTPPASubLingkup').modal('hide')
                        $('#modalEditSTPPASubLingkup').modal({
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
        });
        $('.formSubEdit').submit(function(e) {
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
                        $('#modalEditSTPPASubLingkup').modal('hide')
                        $('#modalEditSTPPASubLingkup').modal({
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