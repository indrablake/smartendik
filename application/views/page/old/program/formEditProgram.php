<form id="formubahdataprogram" method="post">

    <fieldset>
        <input type="hidden" name="promesID" id="promesID" value="<?php echo $dataProgram['PROMES_ID'] ?>">
        <div class="form-group">
            <label>Kelas:</label>
            <input type="text" name="namaKelas" id="namaKelas" value="<?php echo $dataProgram['CLASS_ID'] ?>">
            <!-- <select data-placeholder="Pilih Kelas" class="form-control form-control-select2" data-fouc name="namaKelas" id="namaKelas">
                <option value="<?php echo $dataProgram['CLASS_ID'] ?>"><?php echo $dataProgram['CLASS_LEVEL'] ?>-<?php echo $dataProgram['CLASS_NAME'] ?></option>
                <?php
                foreach ($queryKelas as $group) : ?>
                    <option value="<?php echo $group['CLASS_ID'] ?>"><?php echo $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME'] ?></option>
                <?php endforeach; ?>
            </select> -->
        </div>
        <div class="form-group">
            <label>Semester:</label>
            <input type="text" class="form-control" placeholder="Semester" value="<?php echo $dataProgram['PROMES_SEMESTER'] ?>" name="semesterProgram" id="semester">
        </div>

        <div class="form-group">
            <label>Tahun:</label>
            <div class="row">
                <div class="col-md-6">
                    <select data-placeholder="Pilih Tahun" class="form-control form-control-select2" name="tahunProgram" data-fouc id="tahunProgram" onchange="tahun()">

                        <option value="<?php echo $dataProgram['PROMES_YEAR']; ?>"><?php echo $tahun1; ?></option>
                        <?php
                        $tahun = date('Y');
                        for ($i = 1990; $i <= $tahun; $i++) : ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" isabled id="tahunAjaran2" class="form-control" name="tahunProgram2">
                </div>
            </div>

        </div>

        <div class="form-group">
            <label>Strategi Pembelajaran:</label>
            <textarea type="text" class="form-control" placeholder="Strategi Pembelajaran" id="strategiPembelajaran" name="strategiPembelajaran"><?php echo $dataProgram['PROMES_STRATEGY']; ?></textarea>
        </div>



    </fieldset>
    <div class="text-right">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary submitProgram">Ubah Data Program </button>
        </div>
    </div>
</form>