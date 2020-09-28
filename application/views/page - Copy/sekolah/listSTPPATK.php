<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>


<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script src="assets/js/app.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/form_select2.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sekolah</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item">Sekolah</span>
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">Tambah Data <i class="icon-play3 ml-2"></i></button>
            </div>
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
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('failed'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Sekolah</th>
                            <th class="text-center">Tahun Pembelajaran</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Kepala</th>
                            <th class="text-center">Kepala Institusi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataSTPPATK as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['SCH_NAME']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_STUDYYEAR']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_APPOINTEDPLACE']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_HEADMASTER']; ?></td>
                                <td class="text-center"><?php echo $q['STPPATK_INSTITUTIONHEAD']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $q['STPPATK_ID'] ?>">Edit </button>
                                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="modal_tambah" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data STPPATK</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="simpanSTPPATK">
                    <div class="form-group">
                        <label>Sekolah:</label>
                        <select name="sch_id" data-placeholder="Pilih Sekolah" class="form-control select" data-fouc>
                            <option></option>
                            <?php $result = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array(); ?>
                            <?php foreach ($result as $result) : ?>
                                <option value="<?php echo $result['SCH_ID'] ?>"><?php echo $result['SCH_NAME']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_year" data-fouc>
                            <?php
                            $tahun = date('Y');
                            for ($i = 1990; $i <= $tahun; $i++) : ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tahun Pembelajaran</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_studyyear" data-fouc id="tahunAjaran" onchange="tahun()">
                                    <?php
                                    $tahun = date('Y');
                                    for ($i = 1990; $i <= $tahun; $i++) : ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled id="tahunAjaran2" class="form-control" name="tahunRPPH2">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">Angka</label>
                        <input type="number" placeholder="Angka Pembelajaran" class="form-control" name="stppatk_number">
                    </div>

                    <div class="form-group">
                        <label for="">Appointed Place</label>
                        <input type="text" placeholder="Lokas Pembelajaran" class="form-control" name="stppatk_appointedplace">
                    </div>

                    <div class="form-group">
                        <label for="">Appointed Date</label>
                        <input type="date" class="form-control" name="stppatk_appointeddate">
                    </div>

                    <div class="form-group">
                        <label for="">Head Master</label>
                        <input type="text" placeholder="Kepala" class="form-control" name="stppatk_headmaster">
                    </div>
                    <div class="form-group">
                        <label for="">Institution Head</label>
                        <input type="text" placeholder="Institution Kepala" class="form-control" name="stppatk_institutionhead">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
$dataSTPPATK = $this->db->query("SELECT s.SCH_NAME,s.SCH_NPSN , st.* FROM TBL_STPPATK st INNER JOIN TBL_SCHOOL s ON s.SCH_ID = st.SCH_ID")->result_array();

foreach ($dataSTPPATK as $i) :
    $stppatk_id = $i['STPPATK_ID'];
    $sch_id = $i['SCH_ID'];
    $sch_name = $i['SCH_NAME'];
    $stppatk_year = $i['STPPATK_YEAR'];
    $stppatk_id = $i['STPPATK_ID'];
    $stppatk_studyyear = $i['STPPATK_STUDYYEAR'];
    $stppatk_number = $i['STPPATK_NUMBER'];
    $stppatk_appointedplace = $i['STPPATK_APPOINTEDPLACE'];
    $stppatk_appointeddate = $i['STPPATK_APPOINTEDDATE'];
    $stppatk_headmaster = $i['STPPATK_HEADMASTER'];
    $stppatk_institutionhead = $i['STPPATK_INSTITUTIONHEAD'];

?>
    <div id="modal_edit<?php echo $stppatk_id; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data STPPATK</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="editSTPPATK">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $stppatk_id ?>" name="stppatk_id">
                        <div class="form-group">
                            <label>Sekolah:</label>
                            <select name="sch_id" data-placeholder="Pilih Sekolah" class="form-control select" data-fouc>
                                <option value="<?php echo $sch_id ?>"><?php echo $sch_name; ?></option>
                                <?php $result = $this->db->query("SELECT *FROM TBL_SCHOOL")->result_array(); ?>
                                <?php foreach ($result as $result) : ?>
                                    <option value="<?php echo $result['SCH_ID'] ?>"><?php echo $result['SCH_NAME']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_year" data-fouc>
                                <option value="<?php echo $stppatk_year ?>"><?php echo $stppatk_year; ?></option>
                                <?php
                                $tahun = date('Y');
                                for ($i = 1990; $i <= $tahun; $i++) : ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Tahun Pembelajaran</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select data-placeholder="Pilih Tahun" class="form-control select" name="stppatk_studyyear" data-fouc id="tahunAjaran" onchange="tahun()">
                                        <option value="<?php echo $stppatk_studyyear ?>"><?php echo $stppatk_studyyear; ?></option>
                                        <?php
                                        $tahun = date('Y');
                                        for ($i = 1990; $i <= $tahun; $i++) : ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" value="<?php echo intval($stppatk_studyyear) + 1; ?>" disabled id="tahunAjaran2" class="form-control" name="tahunRPPH2">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Angka</label>
                            <input type="number" value="<?php echo $stppatk_number; ?>" placeholder="Angka Pembelajaran" class="form-control" name="stppatk_number">
                        </div>

                        <div class="form-group">
                            <label for="">Appointed Place</label>
                            <input type="text" placeholder="Lokas Pembelajaran" value="<?php echo $stppatk_appointedplace; ?>" class="form-control" name="stppatk_appointedplace">
                        </div>

                        <div class="form-group">
                            <label for="">Appointed Date</label>
                            <input type="date" class="form-control" name="stppatk_appointeddate" value="<?php echo $stppatk_appointeddate; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Head Master</label>
                            <input type="text" value="<?php echo $stppatk_headmaster; ?>" placeholder="Kepala" class="form-control" name="stppatk_headmaster">
                        </div>
                        <div class="form-group">
                            <label for="">Institution Head</label>
                            <input type="text" placeholder="Institution Kepala" class="form-control" name="stppatk_institutionhead" value="<?php echo $stppatk_institutionhead; ?>">
                        </div>

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
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
        document.getElementById("tahunAjaran2").html = tahun + 1;
    }
</script>