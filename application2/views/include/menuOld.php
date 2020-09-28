<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="<?php echo base_url() ?>assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">Administrator</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> &nbsp;Indonesia
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i><span>Kompetensi</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Kompetensi">
                        <!-- Kompetensi -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listKompetensiInti'); ?>" class="nav-link <?php if ($sub_menu == 'listKomp') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Kompetensi Inti</a></li>
                        <li class="nav-item "><a href="<?= base_url('MasterData/listKompetensiDasar'); ?>" class="nav-link <?php if ($sub_menu == 'listKompDasar') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Kompetensi Dasar</a></li>
                        <li class="nav-item "><a href="<?= base_url('MasterData/listKompetensiDasarAlokasi'); ?>" class="nav-link <?php if ($sub_menu == 'listKompDasarAlokasi') {
                                                                                                                                        echo "active";
                                                                                                                                    } ?>">Daftar Kompetensi Dasar Alokasi</a></li>
                        <!-- End Kompetensi -->
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i><span>RPP</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="RPP">
                        <!-- RPP -->
                        <!-- Iklan -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listRPP') {
                                                                                                            echo "active";
                                                                                                        } ?>">Daftar RPP</a></li>
                        <!-- End RPP -->

                        <!-- Tujuan RPP -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listTujuanRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listRPP') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar Tujuan RPP</a></li>
                        <!-- End Tujuan RPP -->
                        <!-- Media RPP -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listMediaRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listRPP') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar Media RPP</a></li>
                        <!-- End Media -->
                        <!-- Langkah RPP -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listLangkahRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listLangkahRPP') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar Langkah Pembelajaran RPP</a></li>
                        <!-- End Langkah -->
                        <!-- Penilaian RPP -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listPenilaianRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listPenilaianRPP') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Penilaian Pembelajaran RPP</a></li>
                        <!-- End Penilaian -->
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i><span>KKM</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Kompetensi">
                        <!-- KKM -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listKKM'); ?>" class="nav-link <?php if ($sub_menu == 'listKKM') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar KKM </a></li>
                        <!-- End KKM -->
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'master') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'program') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i> <span>Master Data</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item "><a href="<?php echo base_url('MasterData/listProvinsi'); ?>" class="nav-link <?php if ($sub_menu == 'listProvinsi') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Provinsi</a></li>

                        <li class="nav-item "><a href="<?= base_url('MasterData/listKabupaten'); ?>" class="nav-link <?php if ($sub_menu == 'listKabupaten') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Kabupaten</a></li>
                        <li class="nav-item "><a href="<?= base_url('MasterData/listKecamatan'); ?>" class="nav-link <?php if ($sub_menu == 'listKecamatan') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Kecamatan</a></li>
                        <li class="nav-item "><a href="<?= base_url('MasterData/listJenisUser'); ?>" class="nav-link <?php if ($sub_menu == 'listJenisUser') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Jenis User</a></li>

                        <li class="nav-item "><a href="<?= base_url('MasterData/listAgama'); ?>" class="nav-link <?php if ($sub_menu == 'listAgama') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Agama</a></li>

                        <li class="nav-item "><a href="<?= base_url('MasterData/listUser'); ?>" class="nav-link <?php if ($sub_menu == 'listUser') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar User</a></li>
                        <li class="nav-item "><a href="<?= base_url('MasterData/listJenjangSekolah'); ?>" class="nav-link <?php if ($sub_menu == 'listJenjangSekolah') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Jenjang Sekolah</a></li>

                        <li class="nav-item "><a href="<?= base_url('MasterData/listJenisPegawai'); ?>" class="nav-link <?php if ($sub_menu == 'listJenisPegawai') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Jenis Pegawai</a></li>

                        <li class="nav-item "><a href="<?= base_url('MasterData/listJenisBarang'); ?>" class="nav-link <?php if ($sub_menu == 'listJenisBarang') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Jenis Barang</a></li>


                        <li class="nav-item "><a href="<?= base_url('MasterData/listTahunPelajaran'); ?>" class="nav-link <?php if ($sub_menu == 'listTahunPelajaran') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Tahun Pelajaran</a></li>
                        <!-- Tahun Pelajaran -->

                        <!-- Kelas -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listKelas'); ?>" class="nav-link <?php if ($sub_menu == 'listKelas') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Kelas</a></li>

                        <!-- Kelas -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listTingkatKelas'); ?>" class="nav-link <?php if ($sub_menu == 'listTingkatKelas') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Tingkat Kelas</a></li>
                        <!-- End Tingkat Kelas -->
                        <!-- Pegawai -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listPegawai'); ?>" class="nav-link <?php if ($sub_menu == 'listPegawai') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Pegawai</a></li>

                        <!-- Iklan -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listIklan'); ?>" class="nav-link <?php if ($sub_menu == 'listIklan') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Iklan</a></li>
                        <!-- End Iklan -->

                        <!-- Siswa -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listSiswa'); ?>" class="nav-link <?php if ($sub_menu == 'listSiswa') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Siswa</a></li>
                        <!-- End Siswa -->

                        <!-- Sekolah -->
                        <li class="nav-item "><a href="<?= base_url('MasterData/listSekolah'); ?>" class="nav-link <?php if ($sub_menu == 'listSekolah') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Sekolah</a></li>
                    </ul>
                </li>



                <!-- Tahun Pelajaran -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'program') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'program') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i> <span>Kurikulum</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item "><a href="listProgramSemester" class="nav-link <?php if ($sub_menu == 'listProgram') {
                                                                                                echo "active";
                                                                                            } ?>">List Program Semester</a></li>
                        <li class="nav-item "><a href="tambahProgramSemester" class="nav-link <?php if ($sub_menu == 'tambahProgram') {
                                                                                                    echo "active";
                                                                                                } ?>">Tambah Program Semester</a></li>
                        <!-- <li class="nav-item "><a href="listTemaProgramSemester" class="nav-link <?php if ($sub_menu == 'listTemaProgramSemester') {
                                                                                                            echo "active";
                                                                                                        } ?>">List Tema Program Semester </a></li> -->
                        <li class="nav-item "><a href="tambahTemaProgramSemester" class="nav-link <?php if ($sub_menu == 'tambahTemaProgramSemester') {
                                                                                                        echo "active";
                                                                                                    } ?>">Tambah Tema Program Semester </a></li>

                        <!-- <li class="nav-item "><a href="listSubTemaProgramSemester" class="nav-link <?php if ($sub_menu == 'listSubTemaProgramSemester') {
                                                                                                            echo "active";
                                                                                                        } ?>">List Sub Tema Program Semester </a></li> -->
                        <li class="nav-item "><a href="tambahSubTemaProgramSemester" class="nav-link <?php if ($sub_menu == 'tambahSubTemaProgramSemester') {
                                                                                                            echo "active";
                                                                                                        } ?>">Tambah Sub Tema Program Semester </a></li>

                        <!-- <li class="nav-item "><a href="listTujuanProgramSemester" class="nav-link <?php if ($sub_menu == 'listTujuanProgramSemester') {
                                                                                                            echo "active";
                                                                                                        } ?>">List Tujuan Program Semester </a></li> -->
                        <li class="nav-item "><a href="tambahTujuanProgramSemester" class="nav-link <?php if ($sub_menu == 'tambahTujuanProgramSemester') {
                                                                                                        echo "active";
                                                                                                    } ?>">Tambah Tujuan Program Semester </a></li>
                        <!-- 
                        <li class="nav-item "><a href="listKompetensiProgramSemester" class="nav-link <?php if ($sub_menu == 'listTujuanProgramSemester') {
                                                                                                            echo "active";
                                                                                                        } ?>">List Kompetensi Program Semester </a></li> -->
                        <li class="nav-item "><a href="tambahKompetensiProgramSemester" class="nav-link <?php if ($sub_menu == 'tambahKompetensiProgramSemester') {
                                                                                                            echo "active";
                                                                                                        } ?>">Tambah Kompetensi Program Semester </a></li>
                    </ul>
                </li>


                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'rppm') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'rppm') {
                                                    echo "active";
                                                } ?>"><i class="icon-copy"></i> <span>RPPM</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPM/listRPPM" class="nav-link <?php if ($sub_menu == 'listRPPM') {
                                                                                                                    echo "active";
                                                                                                                } ?>">List RPPM</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPM/tambahRPPM" class="nav-link <?php if ($sub_menu == 'tambahRPPM') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Tambah RPPM</a></li>


                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPM/tambahRPPMActivity" class="nav-link <?php if ($sub_menu == 'tambahRPPMActivity') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah RPPM Kegiatan</a></li>

                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPM/tambahRPPMLearning" class="nav-link <?php if ($sub_menu == 'tambahRPPMLearning') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah RPPM Pembelajaran</a></li>
                    </ul>
                </li>


                <!-- RPPH -->

                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'rppm') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'rppm') {
                                                    echo "active";
                                                } ?>"><i class="icon-copy"></i> <span>RPPH</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/listRPPH" class="nav-link <?php if ($sub_menu == 'listRPPH') {
                                                                                                                    echo "active";
                                                                                                                } ?>">List RPPH</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPH" class="nav-link <?php if ($sub_menu == 'tambahRPPH') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Tambah RPPH</a></li>

                        <!-- <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/listRPPHActivity" class="nav-link <?php if ($sub_menu == 'listRPPHActivity') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">List RPPH Kegiatan</a></li> -->
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPHActivity" class="nav-link <?php if ($sub_menu == 'tambahRPPHActivity') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah RPPH Kegiatan</a></li>

                        <!-- <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/listRPPHLearning" class="nav-link <?php if ($sub_menu == 'listRPPHLearning') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">List RPPH Pembelajaran</a></li> -->
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPHLearning" class="nav-link <?php if ($sub_menu == 'tambahRPPHLearning') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah RPPH Pembelajaran</a></li>

                        <!-- 
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/listRPPHMaterial" class="nav-link <?php if ($sub_menu == 'listRPPHMaterial') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">List RPPH Alat & Bahan</a></li> -->
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPHMaterial" class="nav-link <?php if ($sub_menu == 'tambahRPPHMaterial') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah RPPH Alat & Bahan</a></li>


                        <!-- <li class="nav-item"><a href="listRPPHValIndicator" class="nav-link <?php if ($sub_menu == 'listRPPHValIndicator') {
                                                                                                        echo "active";
                                                                                                    } ?>">List RPPH Indikator Penilaian </a></li> -->
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPHValIndicator" class="nav-link <?php if ($sub_menu == 'tambahRPPHValIndicator') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Tambah RPPH Indikator Penilaian </a></li>


                        <!-- <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/listRPPHValTechnique" class="nav-link <?php if ($sub_menu == 'listRPPHValTechnique') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">List RPPH Penilaian Teknik</a></li> -->
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPHValTechnique" class="nav-link <?php if ($sub_menu == 'tambahRPPHValTechnique') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Tambah RPPH Penilaian Teknik</a></li>


                        <!-- <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/listRPPHActivityDetail" class="nav-link <?php if ($sub_menu == 'listRPPHValActivityDetail') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">List RPPH Activity Detail</a></li> -->
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPHActivityDetail" class="nav-link <?php if ($sub_menu == 'tambahRPPHActivityDetail') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Tambah RPPH Activity Detail</a></li>

                        <!-- <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/listRPPHValIndicatorDetail" class="nav-link <?php if ($sub_menu == 'listRPPHValIndicatorDetail') {
                                                                                                                                        echo "active";
                                                                                                                                    } ?>">List RPPH Valuasi Indicator Detail</a></li> -->
                        <li class="nav-item"><a href="<?php echo base_url() ?>RPPH/tambahRPPHValIndicatorDetail" class="nav-link <?php if ($sub_menu == 'tambahRPPHValIndicatorDetail') {
                                                                                                                                        echo "active";
                                                                                                                                    } ?>">Tambah RPPH Valuasi Indicator Detail</a></li>
                    </ul>
                </li>
                <!-- Berita -->



                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'berita') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'berita') {
                                                    echo "active";
                                                } ?>"><i class="icon-copy"></i> <span>Berita</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo base_url() ?>Berita/listBerita" class="nav-link <?php if ($sub_menu == 'listBerita') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List Berita</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Berita/tambahBerita" class="nav-link <?php if ($sub_menu == 'tambahBerita') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Tambah Berita</a></li>
                    </ul>
                </li>


                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'siswa') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'siswa') {
                                                    echo "active";
                                                } ?>"><i class="icon-sort"></i> <span>Siswa</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Vertical navigation">
                        <li class="nav-item"><a href="<?php echo base_url() ?>Siswa/listSiswa" class="nav-link <?php if ($sub_menu == 'listSiswa') {
                                                                                                                    echo "active";
                                                                                                                } ?>">List Siswa</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Siswa/listReligion" class="nav-link <?php if ($sub_menu == 'listReligion') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List Religion</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Siswa/listKelasSiswa" class="nav-link <?php if ($sub_menu == 'listKelasSiswa') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List Kelas Siswa</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Siswa/tambahSiswa" class="nav-link <?php if ($sub_menu == 'tambahSiswa') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Tambah Siswa</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Siswa/tambahReligion" class="nav-link <?php if ($sub_menu == 'tambahReligion') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Tambah Religion</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Siswa/tambahKelasSiswa" class="nav-link <?php if ($sub_menu == 'tambahKelasSiswa') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah Kelas Siswa</a></li>
                    </ul>
                </li>



                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'user') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'user') {
                                                    echo "active";
                                                } ?>"><i class="icon-sort"></i> <span>User</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Vertical navigation">
                        <li class="nav-item"><a href="<?php echo base_url() ?>User/listUser" class="nav-link <?php if ($sub_menu == 'listUser') {
                                                                                                                    echo "active";
                                                                                                                } ?>">List User</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>User/tambahUser" class="nav-link <?php if ($sub_menu == 'tambahUser') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Tambah User</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>User/listUserGroup" class="nav-link <?php if ($sub_menu == 'listUserGroup') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List User Group</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>User/tambahUserGroup" class="nav-link <?php if ($sub_menu == 'tambahUserGroup') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Tambah User Group</a></li>

                    </ul>
                </li>
                <li class="nav-item nav-item-submenu <?php if ($sub_menu == 'listSekolah' || $sub_menu == 'tambahSekolah' || $sub_menu == 'tambahGrade' || $sub_menu == 'listGrade' || $sub_menu == 'tambahKelas' || $sub_menu == 'listKelas') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($sub_menu == 'listSekolah' || $sub_menu == 'tambahSekolah' || $sub_menu == 'tambahGrade' || $sub_menu == 'listGrade' || $sub_menu == 'tambahKelas' || $sub_menu == 'listKelas') {
                                                    echo "active";
                                                } ?>"><i class="icon-transmission"></i> <span>Sekolah</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Horizontal navigation">
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/listSekolah" class="nav-link <?php if ($sub_menu == 'listSekolah') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List Sekolah</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/listGrade" class="nav-link <?php if ($sub_menu == 'listGrade') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List Grade Sekolah</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/listKelas" class="nav-link <?php if ($sub_menu == 'listKelas') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List Kelas Sekolah</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/listSTPPATK" class="nav-link <?php if ($sub_menu == 'listSTPPATK') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">List STPPATK </a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/tambahSTPPATK" class="nav-link <?php if ($sub_menu == 'tambahSTPPATK') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah STPPATK</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/tambahSekolah" class="nav-link <?php if ($sub_menu == 'tambahSekolah') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Tambah Sekolah</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/tambahGrade" class="nav-link <?php if ($sub_menu == 'tambahGrade' || $sub_menu == 'listGrade' || $sub_menu == 'tambahGrade') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Tambah Grade</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>Sekolah/tambahKelas" class="nav-link <?php if ($sub_menu == 'tambahSekolah') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Tambah Kelas Sekolah</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>User/logout" class="nav-link"><i class="icon-transmission"></i><span>Logout</span></a>

                </li>
                <!-- /layout -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>