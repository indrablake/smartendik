<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Program</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">RPPM</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } else if ($this->session->flashdata('failed')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('failed'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Tambah Data</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>RPPM ID:</label>
                                        <select data-placeholder="Pilih RPPM ID" class="form-control form-control-select2" id="rppmid" data-fouc name="RPPMID">
                                            <?php $queryGroup = $this->db->query("SELECT rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM tbl_rppm rpm INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
                                    INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID
                                    ")->result_array();
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['RPPM_ID'] ?>"><?php echo $group['RPPM_ID'] . ' - ' . $group['SCH_NAME'] . ' - ' . $group['CLASS_LEVEL'] . ' - ' . $group['CLASS_LEVEL']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group" style="margin-top:5px">

                                        <button type="button" id="searchBtn" class="btn btn-primary mt-3">Search</button>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>


                    <div id="hasilData">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="modal_tambah" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah RPPM Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="simpanRPPMActivity" method="POST" enctype="multipart/form-data">
                    <input type="text" id=kodeRppm name="RPPMID" hidden>
                    <div class="modal-body">
                        <fieldset>
                            <div class="form-group">
                                <label>Hari:</label>
                                <input type="number" class="form-control" placeholder="Hari" name="indexHari">
                            </div>

                            <div class="form-group">
                                <label>Kegiatan Pembelajaran:</label>
                                <textarea name="deskripsiActivity" id="editor-full" rows="2" cols="2"></textarea>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-primary">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
foreach ($query as $i) :
    $rppm_id = $i['RPPM_ID'];
    $rppmactivity_id = $i['RPPMACTIVITY_ID'];
    $rppmactivity_dayindex = $i['RPPMACTIVITY_DAYINDEX'];
    $rppmactivity_desc = $i['RPPMACTIVITY_DESC'];
    $rppmClass = $i['CLASS_LEVEL'];
    $rppmClassName = $i['CLASS_NAME'];

?>
    <div id="modal_edit<?php echo $rppmactivity_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data RPPM Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="updateRPPMActivity">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $rppmactivity_id ?>" name="RPPMActivityID">
                        <div class="form-group">
                            <label>RPPM ID:</label>
                            <select data-placeholder="Pilih RPPM ID" class="form-control form-control-select2" data-fouc name="RPPMID">
                                <option value="<?php echo $rppm_id ?>"><?php echo $rppm_id . '-' . $rppmClass . '-' . $rppmClassName ?></option>
                                <?php $queryGroup = $this->db->query("SELECT rp.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPM rp INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=rp.CLASS_ID")->result_array();
                                foreach ($queryGroup as $group) : ?>
                                    <option value="<?php echo $group['RPPM_ID'] ?>"><?php echo $group['RPPM_ID'] . '-' . $group['CLASS_LEVEL'] . '-' . $group['CLASS_NAME']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hari:</label>
                            <input type="text" class="form-control" placeholder="Hari" value="<?php echo $rppmactivity_dayindex ?>" name="indexHari">
                        </div>
                        <div class="form-group">
                            <label>Kegiatan Pembelajaran:</label>
                            <textarea name="deskripsiActivity" id="editor-full<?php echo $rppmactivity_id ?>" rows="2" cols="2"><?php echo $rppmactivity_desc ?></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('editor-full<?php echo $rppmactivity_id; ?>');
                        </script>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    CKEDITOR.replace('editor-full');
    CKEDITOR.replace('editor-full2');
</script>
<script>
    $("#searchBtn").click(function() {
        var search = $("#rppmid").val();
        console.log(search);
        $("#kodeRppm").val(search);
        load_data(search);
    });

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>RPPM/fetchActivity",
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#hasilData").html(data);
                $("#btnTambah").show();
            }
        })
    }

    $("#btnTambah").click(function() {
        var search = $("#rppmid").val();

    })

    function hapus(rppmActID) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data RPPM Kegiatan?",
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
                        url: "<?= base_url('RPPM/hapusRPPMActivity_ajax') ?>",
                        data: {
                            rppmActID: rppmActID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('rppm/tambahRPPMActivity'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>