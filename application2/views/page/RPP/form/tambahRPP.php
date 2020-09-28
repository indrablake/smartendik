<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor4/ckeditor.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">RPP</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">RPP</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

    </div>
</div>
<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="pesan"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form id="submit">


                <div class="container" id="dynamicField">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Tahun Ajaran:</label>
                        </div>
                        <div class="col-md-12">
                            <select data-placeholder="Pilih Tahun Ajaran" id="tahunAjaranID" class="form-control form-control-select2" data-fouc name="tahunAjaran[]">
                                <?php $queryGroup = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['thn_ajar_kd'] ?>"><?php echo $group['thn_ajar_periode'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input placeholder="RPP Semester" type="text" class="form-control" name="rppSemester">
                        </div>
                        <div class="col-md-12">
                            <textarea data-sample-short rows="2" name="materiPokok" placeholder="Materi Pokok" id="ckeditor" required></textarea>
                        </div>
                    </div>
                </div>


                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {




        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });

        $(function() {
            CKEDITOR.replace('materiPokok', {
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
        });

        $('#submit').submit(function(e) {
            e.preventDefault();

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            $.ajax({
                url: '<?php echo base_url(); ?>MasterData/simpanIklan_ajax',
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
                        text: "Iklan Berhasil Ditambahkan"
                    });
<<<<<<< HEAD
                    window.location.href = ("<?= base_url('RPP/listRPP'); ?>")
=======
<<<<<<< HEAD
<<<<<<< HEAD
                    window.location.href = ("<?= base_url('RPP/listRPP'); ?>")
=======
                    window.location.href = ("<?= base_url('MasterData/listUser'); ?>")
>>>>>>> STPPA adding stppa sub lingkup
=======
                    window.location.href = ("<?= base_url('MasterData/listUser'); ?>")
>>>>>>> rexydev
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
                }
            });
        });


    });
</script>