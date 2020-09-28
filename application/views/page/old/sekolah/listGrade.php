<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>assets/js/plugins/notifications/bootbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo_pages/components_modals.js"></script>



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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalGradeSekolah">Tambah Data <i class="icon-play3 ml-2"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">

                <table class="table datatable-basic table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Grade</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $grade = $this->db->query("SELECT *FROM TBL_SCHOOLGRADE")->result_array();
                        $no = 1;
                        foreach ($grade as $q) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $q['GRADE_NAME']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning" onclick="edit(<?php echo $q['GRADE_ID'] ?>)">Edit </button>
                                    <button onclick="hapus(<?php echo $q['GRADE_ID'] ?>)" class=" btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Tambah Data -->
<div id="modalGradeSekolah" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Grade Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('Sekolah/simpanGrade_ajax', ['class' => 'formSimpan']) ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Grade Sekolah:</label>
                    <input type="text" class="form-control" placeholder="Grade Sekolah" name="gradeSekolah">
                </div>
                <div class="text-right">

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-primary">Save changes</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<div class="viewModalEdit" style="display: none;"></div>

<!-- /basic modal -->
<script>
    $(document).ready(function() {
        $('#example').dataTable();

        // Simpan 
        $('.formSimpan').submit(function(e) {
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
                            title: 'Tambah Data',
                            text: response.sukses
                        });
                        $('[name="gradeSekolah"]').val("");

                        $('#modalTambahGrade').modal('hide')
                        $('#modalTambahGrade').modal({
                            backdrop: 'false',
                            keyboard: 'true',
                            show: 'false'
                        });
                        window.location.href = ("<?= base_url('sekolah/listGrade'); ?>")
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                }
            });
            return false;
        })
    });

    function edit(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Sekolah/formEditGrade') ?>",
            data: {
                gradeID: id
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditGrade').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditGrade').modal('show');
                tampilDataGrade();
            }
        })
    }


    function hapus(gradeID) {
        swal({
                title: "Hapus",
                text: "Yakin menghapus data grade sekolah ?",
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
                        url: "<?= base_url('Sekolah/hapusGrade_ajax') ?>",
                        data: {
                            gradeID: gradeID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                window.location.href = ("<?= base_url('sekolah/listGrade'); ?>")
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>