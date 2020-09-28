<div id="modalDetailSTPPA" class="modal fade viewModalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Detail STPPA</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <fieldset>
               	<input type="hidden" value="<?php echo $STPPA_ID ?>" name="stppa_id"/>
                  <div class="form-group">
                      <label>Jenjang:</label>
                      <input type="text" class="form-control" value="<?php echo $JENJANG_NM ?>" readonly="" disabled="true" />
                  </div>
                  <div class="form-group">
                      <label>Periode : </label>
                      <input type="text" class="form-control" value="<?php echo $PERIODE ?>" readonly="" disabled="true"/>
                  </div>
                  <div class="detail-lingkup-list">
                      <label>Lingkup Perkembangan:</label>
                      <?php if (isset($STPPA_LINGKUP)): ?>
                        <?php foreach ($STPPA_LINGKUP as $key => $value): ?>
                          <div class="form-group">
                              <div class="input-group"> 
                                <input type="text" class="form-control" value="<?php echo $value['sl_keterangan'] ?>" readonly disabled="true" >
                              </div>
                          </div>
                        <?php endforeach ?>
                      <?php else: ?>
                        <div class="form-group">
                            <div class="input-group"> 
                                <input type="text" class="form-control" value="" maxlength="512" readonly disabled="true" >
                            </div>
                        </div>
                      <?php endif ?>
                  </div>
                 
               </fieldset>
           </div>
        </div>
    </div>
</div>