<script src="<?php echo base_url() ?>assets/js/plugins/forms/selects/select2.min.js"></script>


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
                <span class="breadcrumb-item active"><?php echo $title ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahSubLingkup">Tambah Data <i class="icon-play3 ml-2"></i></button>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding:1em">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pesan">

                            </div>
                        </div>
                    </div>
                    <form action="">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>STPPA :</label>
                                        <select data-placeholder="Pilih STPPA" class="form-control " id="stppa_id" name="stppa_id">
                                            <option value="">Pilih STPPA</option>
                                            <?php $queryGroup = $this->db->query("SELECT s.stppa_id,s.jenjang_kd,rjs.jenjang_nm,rtp.thn_ajar_periode,rtp.thn_ajar_tgl_mulai,rtp.thn_ajar_tgl_akhir FROM stppa s left join ref_jenjang_sekolah rjs on s.jenjang_kd = rjs.jenjang_kd left join ref_tahun_pelajaran rtp on s.thn_ajar_kd = rtp.thn_ajar_kd ")->result_array();
                                            if (!empty($queryGroup)) :
                                                foreach ($queryGroup as $group) : ?>
                                                    <option value="<?php echo $group['stppa_id'] ?>"><?php echo $group['jenjang_nm']. ' [ Mulai : ' . $group['thn_ajar_tgl_mulai'] . ' ] - [ Akhir :  ' . $group['thn_ajar_tgl_akhir'] . ' ]' ?></option>
                                                <?php endforeach;
                                            else : ?>
                                                <option value="">STPPA Kosong</option>
                                            <?php endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>STPPA lingkup :</label>
                                                <select data-placeholder="Pilih Lingkup" class="form-control " id="lingkup_id" name="lingkup_id">
                                                    <option value="">Pilih STPPA Lingkup</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Action :</label>
                                            <div class="form-group">
                                                <div class="sub-list-data">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-primary btn-sm edit-data" disabled="">UBAH DATA</button>
                                                        <button type="button" class="btn btn-danger btn-sm remove-data" disabled="">HAPUS DATA</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>

                        </fieldset>
                    </form>
                    <div class="row" id="tabledata">
                        <div class="col-md-12">
                            <div class="card" style="padding:1em">
                                <table class="table " id="my_data" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>Total Detail Lingkup</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data -->
<div id="modalTambahSubLingkup" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Sub Lingkup STPPA</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('STPPA/simpanSTPPASublingkup_ajax', ['class' => 'formSimpan']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pesan">

                        </div>
                    </div>
                </div>
                <div class="row" id="dynamicField">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label> STPPA :</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select data-placeholder="Pilih STPPA" class="form-control stppa" id="add_stppa" name="add_stppa">
                                        <option value="">Pilih STPPA</option>
                                        <?php $queryGroup = $this->db->query("SELECT s.stppa_id,s.jenjang_kd,rjs.jenjang_nm,rtp.thn_ajar_periode,rtp.thn_ajar_tgl_mulai,rtp.thn_ajar_tgl_akhir FROM stppa s left join ref_jenjang_sekolah rjs on s.jenjang_kd = rjs.jenjang_kd left join ref_tahun_pelajaran rtp on s.thn_ajar_kd = rtp.thn_ajar_kd ")->result_array();
                                        if (!empty($queryGroup)) :
                                            foreach ($queryGroup as $group) : ?>
                                                <option value="<?php echo $group['stppa_id'] ?>"><?php echo $group['jenjang_nm'] . ' [ Mulai : ' . $group['thn_ajar_tgl_mulai'] . ' ] - [ Akhir :  ' . $group['thn_ajar_tgl_akhir'] . ' ]' ?></option>
                                            <?php endforeach;
                                        else : ?>
                                            <option value="">STPPA Kosong</option>
                                        <?php endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>STPPA lingkup :</label>
                                        <select data-placeholder="Pilih Lingkup" class="form-control stppa_lingkup" id="add_stppa_lingkup" name="add_stppa_lingkup">
                                            <option value="">Pilih STPPA Lingkup</option>
                                        </select>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="sublingkup-list" dsa>
                                    <div class="float-left">
                                        <label>Sub Lingkup Perkembangan:</label>
                                    </div>
                                    <div class="float-right">
                                        <button type="button" name="add" id="add_sublingkup" class="btn btn-primary btn-sm mb-1"><span class="icon-add"></span></button>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"> 
                                            <input type="text" class="form-control" name="add_sublingkup[]" maxlength="512" placeholder="" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
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


<script>
    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>STPPA/ambilDataSTPPASubLingkup",
            method: "POST",
            data: {
               id: $("#lingkup_id option:selected").val()
            },
            success: function(data) {
                $("#tabledata").show();
                showData();
            }
        })
    }
</script>


<script>
    function remove(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().remove();
    }
    function remove_edit(par) {
        //var uy = $(par).data('remove');
        //console.log('ss',uy);
        $(par).parent().parent().parent().remove();
    }
    function showData() {
        table = $('#my_data').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= site_url('STPPA/ambilDataSTPPASubLingkup') ?>",
                "type": "POST",
                "data": {
                    "id": $("#lingkup_id option:selected").val()
                }
            },


            "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "width": 5
            }],

        });
        
    }

    $(document).on('click', '#add_sublingkup', function(event) {
        event.preventDefault();
        var e = $(".sublingkup-list").children('.form-group').length;
        //console.log("uye",e);
        /* Act on the event */
        $(".sublingkup-list").append(`
            <div class="form-group">
                <div class="input-group"> 
                    <input type="text" class="form-control" name="add_sublingkup[]" id="lingkup-`+e+`" maxlength="512" placeholder="" required="">
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

    $(document).on('change', '.stppa', function(event) {
        event.preventDefault();
         var opt =` <option value="">Pilih STPPA Lingkup</option>`;
             
        $.ajax({
            url: '<?php echo site_url('STPPA/getLingkupSTPPA') ?>',
            type: 'POST',
            dataType: 'json',
            data: {id: $('.stppa option:selected').val()},
            success:function(data){
                //var data_json = JSON.parse(data);
                console.log('data',data);
                var opt = data.length < 1 ?  ` <option value="">STPPA Lingkup kosong</option>` :  ` <option value="">Pilih STPPA Lingkup</option>`;
                
                  data.forEach((item,index)=>{
                    opt+=`
                        <option value="`+item['sl_id']+`">`+item['sl_keterangan']+`</option>
                    `
                    // console.log('sss'+item['sl_keterangan']);
                });
                $(".stppa_lingkup").html(opt);
             //   $(".sub-list-data").empty();
                //$(".sl").prop("disabled").toggle();
                // for (var i = data.length - 1; i >= 0; i--) {

                // }
            },error:function(){
               // $(".sl").prop("disabled").toggle();
              // $(".sub-list-data").empty();
            }
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
           $(".stppa_lingkup").html(opt);
          $(".sub-list-data").empty();
        })
        .always(function() {
            console.log("complete");
        });
    });

    $(document).on('click', '.edit-data', function(event) {
        event.preventDefault();
        edit_data();
        /* Act on the event */
    });

    $(document).ready(function() {
        showData();

        $("#stppa_id").change(function(event) {
            showData();
            console.log('$("#stppa_id").val()',$("#stppa_id option:selected").val());
             var opt =` <option value="">Pilih STPPA Lingkup</option>`;
                 
            $.ajax({
                url: '<?php echo site_url('STPPA/getLingkupSTPPA') ?>',
                type: 'POST',
                dataType: 'json',
                data: {id: $('#stppa_id option:selected').val()},
                success:function(data){
                    //var data_json = JSON.parse(data);
                    console.log('data',data);
                    var opt = data.length < 1 ?  ` <option value="">STPPA Lingkup kosong</option>` :  ` <option value="">Pilih STPPA Lingkup</option>`;
                    
                      data.forEach((item,index)=>{
                        opt+=`
                            <option value="`+item['sl_id']+`">`+item['sl_keterangan']+`</option>
                        `
                        // console.log('sss'+item['sl_keterangan']);
                    });
                    $("#lingkup_id").html(opt);
                    // for (var i = data.length - 1; i >= 0; i--) {
                   $('.edit-data').prop('disabled', data.length < 1 | $("#lingkup_id option:selected").val()=="");
                   $('.remove-data').prop('disabled', data.length < 1 | $("#lingkup_id option:selected").val()=="");
                    // }
                }
            })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
               $("#lingkup_id").html(opt);
            })
            .always(function() {
                console.log("complete");
            });
            
        });

        $("#lingkup_id").change(function(event) {
            showData();
            var sel = $("#lingkup_id option:selected").val();
            console.log('sel',sel!="");
            $('.edit-data').prop('disabled', sel=="");
            $('.remove-data').prop('disabled', sel=="");

        });

        $("#centangSemua").click(function(e) {
            if ($(this).is(":checked")) {
                $('.centangPromes').prop('checked', true);
            } else {
                $('.centangPromes').prop('checked', false);
            }
        })

    });

    $(document).ready(function() {
        $('.formSimpan').submit(function(e) {
            e.preventDefault();
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
                        showData();
                        $('#modalTambahSubLingkup').modal('hide');
                        $('#modalTambahSubLingkup').modal({
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
    });

    function edit_data() {
        $.ajax({
            url: "<?php echo base_url('STPPA/formEditSTPPASubLingkup') ?>",
            data: {
                stppa_id: $("#stppa_id option:selected").val(),
                lingkup_id: $("#lingkup_id option:selected").val()
            },
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                console.log('response',response);
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditSTPPASubLingkup').on('shown.bs.modal', function(e) {
                 
                });
                $('#modalEditSTPPASubLingkup').modal('show');
            }
        })
    }

    function edit_sub(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('STPPA/formEditSTPPASub') ?>",
            data: {
                lingkup_id: id
            },
            dataType: 'json',
            success: function(response) {
                $('.viewModalEdit').html(response.sukses).show();
                $('#modalEditSTPPASubLingkup').on('shown.bs.modal', function(e) {
                 
                });
                $('#modalEditSTPPASubLingkup').modal('show');
            }
        })
    }



    $('.formHapus').submit(function(e) {
        e.preventDefault();
        let jumlahData = $('.centangPromes:checked');

        if (jumlahData.length == 0) {
            swal({
                icon: 'warning',
                title: 'Perhatikan',
                text: 'Maaf tidak ada data yang dipilih,Silahkan pilih data'
            });
        } else {
            swal({
                    title: "Hapus",
                    text: ` ${jumlahData.length}   Program RPPH,Yakin menghapus data  ?`,
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


    function hapus_sub(sub_id) {

        swal({
                title: "Hapus",
                text: "Yakin menghapus data Sub lingkup STPPA ?",
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
                        url: "<?= base_url('STPPA/hapusSTPPASubLingkup_ajax') ?>",
                        data: {
                            sub_id: sub_id
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


    $(document).on('click', '.remove-data', function(event) {
        event.preventDefault();

        swal({
                title: "Hapus",
                text: "Yakin menghapus data Sub lingkup STPPA pada STPPA lingkup ini ?",
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
                        url: "<?= base_url('STPPA/hapusSTPPASubLingkupData_ajax') ?>",
                        data: {
                            id: $("#lingkup_id option:selected").val()
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
                            }else{
                                swal({
                                    icon: 'warning',
                                    title: "Peringatan",
                                    text: response.error
                                });
                              }
                        }
                    })
                } else {
                    swal("Data tidak dihapus!");
                }
            });
        /* Act on the event */
    });

</script>