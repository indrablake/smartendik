<!-- Core JS files -->
<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="<?php echo base_url() ?>assets/js/demo_pages/form_layouts.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">STPPA</span> -
                <?php echo $title ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="/" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <a href="<?php echo site_url().'STPPA' ?>"  class="breadcrumb-item">  <span>STPPA</span></a>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahSTPPA">Tambah Data <i class="icon-play3 ml-2"></i></button>
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
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('failed'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div style="text-align:right" class="mr-3">
    <?php echo form_open('STPPA/deleteMultiple_ajax', ['class' => 'formHapus']); ?>
        <button class="btn btn-danger  mb-3 ml-3 mt-3" type="submit">Hapus Data</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">
                <table class="table " id="my_data">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="centang"></th>
                            <th>No</th>
                            <th>Jejang</th>
                            <!-- <th>Lingkup Perkembangan</th> -->
                            <th>Periode</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>

<div id="modalTambahSTPPA" class="modal fade modalTambahSTPPA" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title">Tambah STPPA</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <?php echo form_open('STPPA/simpanSTPPA_ajax', ['class' => 'formSimpan']) ?>
                <fieldset>
                   <div class="form-group">
                       <label>Jenjang:</label>
                       <select data-placeholder="Pilih Jenjang" class="form-control" name="jenjang">
                           <?php $jejang = $this->db->query("SELECT * from ref_jenjang_sekolah")->result_array();
                           foreach ($jejang as $jdata) : ?>
                               <option value="<?php echo $jdata['jenjang_kd'] ?>"><?php echo $jdata['jenjang_nm']?></option>
                           <?php endforeach; ?>
                       </select>
                   </div>
                   <div class="form-group">
                       <label>Periode : </label>
                       <select data-placeholder="Pilih Periode" class="form-control" name="periode" id="periode">
                           <option value="">Pilih</option>
                           <?php $ref_periode = $this->db->query("SELECT * from ref_tahun_pelajaran")->result_array();
                           foreach ($ref_periode as $rdata) : ?>
                               <option value="<?php echo $rdata['thn_ajar_kd'] ?>"><?php echo date('j F Y',strtotime($rdata['thn_ajar_tgl_mulai'])).' - '.date('j F Y',strtotime($rdata['thn_ajar_tgl_akhir']));?></option>
                           <?php endforeach; ?>
                       </select>
                   </div>
                   <div class="lingkup-list">
                       <label>Lingkup Perkembangan:</label>

                       <div class="float-right">
                           <button type="button" name="add" id="add" class="btn btn-primary mb-1"><span class="icon-add"></span></button>
                       </div>

                       <div class="form-group">
                           <div class="input-group"> 
                               <input type="text" class="form-control" name="lingkup[]" id="lingkup-`+e+`" maxlength="512" placeholder="" required="">
                           </div>
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

<div class="viewModalEdit" style="display: none;"></div>

<div class="viewModalDetail" style="display: none;"></div>

<script>

    function set_status(id){    
        console.log("$(id).attr('id')",$(id).attr('data-id'));
        $.ajax({
            url: '<?php echo site_url()."STPPA/getSTPPA" ?>',
            type: 'POST',
            dataType: 'json',
            data: {id: $(id).attr('data-id')},
            success:function(data){
                var sts_ = ($(id).attr('data-status'));
                swal({
                        title: "Status STPPA",
                        text: ` Yakin ingin `+(sts_=="0"?`menayangkan`:`untuk tidak menayangkan `)+` ?`,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tayangkan',
                        cancelButtonText: 'Tidak'
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var sts = ($(id).attr('data-status')=="0"?"1":"0");
                            $.ajax({
                                url: '<?php echo site_url()."STPPA/updateStatus" ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: {id: $(id).attr('data-id'),status:sts},
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
                                        $('.pesan').html(response.error).show();
                                    }
                                    if (response.sukses) {
                                        swal({
                                            icon: 'success',
                                            title: 'Ubah Status',
                                            text: response.sukses
                                        });
                                    }
                                },error:function(){
                                    swal({
                                        icon: 'warning',
                                        title: 'Ubah Status',
                                        text: 'Tidak dapat merespon'
                                    });
                                }
                            });
                            showData();
                        }else{
                            showData();
                        }
                    });
            },error:function(){

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
    }

    $(document).on('click', '#add', function(event) {
        event.preventDefault();
        var e = $(".lingkup-list").children('.form-group').length;
        //console.log("uye",e);
        /* Act on the event */
        $(".lingkup-list").append(`
            <div class="form-group">
                <div class="input-group"> 
                    <input type="text" class="form-control" name="lingkup[]" id="lingkup-`+e+`" maxlength="512" placeholder="" required="">
                    `
                    +(e>=1 ? 
                        `
                        <div class="input-group-append">
                            <button type="button" data-remove="`+e+`" onclick="return remove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                        </div>
                        `:`` 
                    )+

                    `
                </div>
            </div>
        `).on('keyup', '#lingkup-'+e+'', function(event) {
            event.preventDefault();
              
        });
    });


    $(document).on('click', '#add-edit-lingkup-list', function(event) {
        event.preventDefault();
        var e = $(".edit-lingkup-list").children('.form-group').length;
        //console.log("uye",e);
        /* Act on the event */
        $(".edit-lingkup-list").append(`
            <div class="form-group">
                <div class="input-group"> 
                    <input type="hidden" name="idlingkup_edit[]" value="">
                    <input type="text" class="form-control" name="lingkup_edit[]" id="lingkup-`+e+`" maxlength="512" placeholder="" required="">
                    `
                    +(e>=1 ? 
                        `
                        <div class="input-group-append">
                            <button type="button" data-remove="`+e+`" onclick="return remove(this)" class="btn btn-danger"><span class="icon-subtract"></span></button>
                        </div>
                        `:`` )+

                    `
                </div>
            </div>
        `).on('keyup', '#lingkup-'+e+'', function(event) {
            event.preventDefault();
              
        });
    });

    function validasi(argument) {
        
    }

    $(document).ready(function() {
        
    });
    
    function detail(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('STPPA/formDetailSTPPA') ?>",
            data: {
                stppa_id: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalDetail').html(response.sukses).show();
                $('#modalDetailSTPPA').on('shown.bs.modal', function(e) {

                });
                $('#modalDetailSTPPA').modal('show');
            }
        })
    }


    function remove(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().remove();
    }

    function onedit_remove_lingkup(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $.ajax({
            url: '<?php echo site_url()?>/STPPA/hapusSTPPALingkup_ajax',
            type: 'POST',
            dataType: "json",
            data: {sl_id: $(par).data('remove')},
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
                    $('.pesan').html(response.error).show();
                }
                if (response.sukses) {
                    swal({
                        icon: 'success',
                        title: 'Ubah Data',
                        text: response.sukses
                    });
                    showData();
                    // $('#modalEditSTPPA').modal('hide');
                    // $("#modalEditSTPPA").removeData("modal");
                    // $( '.modal' ).modal( 'hide' ).data( 'bs.modal', null );
                    $(par).parent().parent().parent().remove();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
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
        
        
    }

    function showData() {
        table = $('#my_data').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= site_url('STPPA/ambilDataSTPPA') ?>",
                "type": "POST"
            },


            "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "width": 5
            }],

        });
    }
    $(document).ready(function() {
        showData();

        $("#centang").click(function(e) {
            if ($(this).is(":checked")) {
                $('.centang').prop('checked', true);
            } else {
                $('.centang').prop('checked', false);
            }
        })

    });



/*    function tahun() {
        d = document.getElementById("tahunAjaran").value;
        var tahun = parseInt(d);
        console.log(tahun + 1);
        document.getElementById("tahunAjaran2").value = tahun + 1;
    }*/

    $(document).ready(function() {
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
                        $('.pesan').html(response.error).show();
                    }
                    if (response.sukses) {
                        swal({
                            icon: 'success',
                            title: 'Tambah Data',
                            text: response.sukses
                        });
                        showData();
                        $('#modalTambahSTPPA').modal('hide');
                        $("#modalTambahSTPPA").removeData("modal");
                        $( '.modal' ).modal( 'hide' ).data( 'bs.modal', null );
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
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('STPPA/formEditSTPPA') ?>",
            data: {
                stppa_id: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditSTPPA').on('shown.bs.modal', function(e) {
                    $('#namaKelas').focus();
                });
                $('#modalEditSTPPA').modal('show');
            }
        })
    }

    $('.formHapus').submit(function(e) {
        e.preventDefault();
        let jumlahData = $('.centang:checked');

        if (jumlahData.length == 0) {
            swal({
                icon: 'warning',
                title: 'Perhatikan',
                text: 'Maaf tidak ada data yang dipilih,Silahkan pilih data'
            });
        } else {
            swal({
                    title: "Hapus",
                    text: ` ${jumlahData.length}   Program STPPA,Yakin menghapus data  ?`,
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
                            url: $(this).attr("action"),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.sukses) {
                                    console.log("OK");
                                    swal({
                                        icon: 'success',
                                        title: "Konfirmasi",
                                        text: response.sukses
                                    });
                                    showData();
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + "\n" + xhr.response + "\n" + thrownError);
                            }
                        })
                    } else {
                        swal("Data tidak dihapus!");
                    }
                });
        }
        return false;
    })


    function hapus(STPPAID) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data STPPA ?",
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
                        url: "<?= base_url('STPPA/hapusSTPPA_ajax') ?>",
                        data: {
                            stppaID: STPPAID
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                swal({
                                    icon: 'success',
                                    title: "Konfirmasi",
                                    text: response.sukses
                                });
                                showData();
                            }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
    }
</script>