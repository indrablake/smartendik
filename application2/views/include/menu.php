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
                        <div class="media-title font-weight-semibold"><?php echo (!empty($user) ? ($user->profile_nm_1 ? $user->profile_nm_1 : 'Akun') : 'Akun') ?></div>
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

        <?php
        $uri[0] = $this->uri->segment(1);
        $uri[1] = $this->uri->segment(2);
        $uri[2] = $this->uri->segment(3);
        ?>
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('dashboard') ?>" class="nav-link <?php echo (strtolower($uri[0]) == 'dashboard' ? 'active' : '') ?>">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'kompetensi') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'kompetensi') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Kompetensi</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Kompetensi">
                        <!-- Kompetensi -->
                        <li class="nav-item "><a href="<?= base_url('Kompetensi/listKompetensiInti'); ?>" class="nav-link <?php if ($sub_menu == 'listKompInti') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Kompetensi Inti</a></li>
                        <li class="nav-item "><a href="<?= base_url('Kompetensi/listKompetensiDasar'); ?>" class="nav-link <?php if ($sub_menu == 'listKompDasar') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Kompetensi Dasar</a></li>
                        <li class="nav-item "><a href="<?= base_url('Kompetensi/listKompetensiDasarAlokasi'); ?>" class="nav-link <?php if ($sub_menu == 'listKompDasarAlokasi') {
                                                                                                                                        echo "active";
                                                                                                                                    } ?>">Daftar Kompetensi Dasar Alokasi</a></li>
                        <!-- End Kompetensi -->
                    </ul>
                </li>
                <!-- End Kompetensi -->
                <!-- RPP -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'rpp') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'rpp') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>RPP</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="RPP">
                        <!-- RPP -->
                        <!-- Iklan -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listRPP') {
                                                                                                            echo "active";
                                                                                                        } ?>">Daftar RPP</a></li>
                        <!-- End RPP -->

                        <!-- Tujuan RPP -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listTujuanRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listTujuanRPP') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar Tujuan RPP</a></li>
                        <!-- End Tujuan RPP -->
                        <!-- Media RPP -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listMediaRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listMediaRPP') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar Media RPP</a></li>
                        <!-- End Media -->
                        <!-- Langkah RPP -->
                        <li class="nav-item "><a href="<?= base_url('RPP/listLangkahRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listPembelajaranRPP') {
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
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'kkm') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'kkm') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>KKM</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="KKM">
                        <!-- KKM -->
                        <li class="nav-item "><a href="<?= base_url('KKM/listKKM'); ?>" class="nav-link <?php if ($sub_menu == 'listKKM') {
                                                                                                            echo "active";
                                                                                                        } ?>">Daftar KKM </a></li>
                        <!-- End KKM -->
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'iklan') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'iklan') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Iklan</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Iklan">
                        <!-- Iklan -->
                        <li class="nav-item"><a href="<?= base_url('Iklan/listIklan'); ?>" class="nav-link <?php if ($sub_menu == 'listIklan') {
                                                                                                                echo "active";
                                                                                                            } ?>">Daftar Iklan</a></li>
                        <!-- End Iklan -->

                        <li class="nav-item "><a href="<?= base_url('JenisBarang/listJenisBarang'); ?>" class="nav-link <?php if ($sub_menu == 'listJenisBarang') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Jenis Barang</a></li>
                    </ul>
                </li>



                <!-- STTPA -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'sttpa') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'sttpa') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>STTPA</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Iklan">
                        <!-- Iklan -->
                        <li class="nav-item"><a href="<?= base_url('STTPA'); ?>" class="nav-link <?php if ($sub_menu == 'listSTTPA') {
                                                                                                        echo "active";
                                                                                                    } ?>">Daftar STTPA</li>

                        <li class="nav-item"><a href="<?= base_url('STTPA/listSTPPASubLingkup'); ?>" class="nav-link <?php if ($sub_menu == 'listSTTPA') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar STTPA Sub Lingkup</li>

                        <li class="nav-item"><a href="<?= base_url('STTPA/listSTPPADetail'); ?>" class="nav-link <?php if ($sub_menu == 'listSTTPA') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar STTPA Detail</li>
                        <!-- End Iklan -->

                        <li class="nav-item "><a href="<?= base_url('STTPA/listJenisBarang'); ?>" class="nav-link <?php if ($sub_menu == 'listJenisBarang') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Jenis Barang</a></li>
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
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'master') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'program') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i> <span>Master Data</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item "><a href="<?php echo base_url('Provinsi/listProvinsi'); ?>" class="nav-link <?php if ($sub_menu == 'listProvinsi') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Provinsi</a></li>

                        <li class="nav-item "><a href="<?= base_url('Kabupaten/listKabupaten'); ?>" class="nav-link <?php if ($sub_menu == 'listKabupaten') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Kabupaten</a></li>
                        <li class="nav-item "><a href="<?= base_url('Kecamatan/listKecamatan'); ?>" class="nav-link <?php if ($sub_menu == 'listKecamatan') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Kecamatan</a></li>
                        <li class="nav-item "><a href="<?= base_url('JenisUser/listJenisUser'); ?>" class="nav-link <?php if ($sub_menu == 'listJenisUser') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Daftar Jenis User</a></li>

                        <li class="nav-item "><a href="<?= base_url('Agama/listAgama'); ?>" class="nav-link <?php if ($sub_menu == 'listAgama') {
                                                                                                                echo "active";
                                                                                                            } ?>">Daftar Agama</a></li>

                        <li class="nav-item "><a href="<?= base_url('User/listUser'); ?>" class="nav-link <?php if ($sub_menu == 'listUser') {
                                                                                                                echo "active";
                                                                                                            } ?>">Daftar User</a></li>
                        <li class="nav-item "><a href="<?= base_url('JenjangSekolah/listJenjangSekolah'); ?>" class="nav-link <?php if ($sub_menu == 'listJenjangSekolah') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Daftar Jenjang Sekolah</a></li>

                        <li class="nav-item "><a href="<?= base_url('JenisPegawai/listJenisPegawai'); ?>" class="nav-link <?php if ($sub_menu == 'listJenisPegawai') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Jenis Pegawai</a></li>



                        <li class="nav-item "><a href="<?= base_url('TahunPelajaran/listTahunPelajaran'); ?>" class="nav-link <?php if ($sub_menu == 'listTahunPelajaran') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Daftar Tahun Pelajaran</a></li>
                        <!-- Tahun Pelajaran -->

                        <!-- Kelas -->
                        <li class="nav-item "><a href="<?= base_url('Kelas/listKelas'); ?>" class="nav-link <?php if ($sub_menu == 'listKelas') {
                                                                                                                echo "active";
                                                                                                            } ?>">Daftar Kelas</a></li>

                        <!-- Kelas -->
                        <li class="nav-item "><a href="<?= base_url('TingkatKelas/listTingkatKelas'); ?>" class="nav-link <?php if ($sub_menu == 'listTingkatKelas') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Daftar Tingkat Kelas</a></li>
                        <!-- End Tingkat Kelas -->
                        <!-- Pegawai -->
                        <li class="nav-item "><a href="<?= base_url('Pegawai/listPegawai'); ?>" class="nav-link <?php if ($sub_menu == 'listPegawai') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar Pegawai</a></li>


                        <!-- Siswa -->
                        <li class="nav-item "><a href="<?= base_url('Siswa/listSiswa'); ?>" class="nav-link <?php if ($sub_menu == 'listSiswa') {
                                                                                                                echo "active";
                                                                                                            } ?>">Daftar Siswa</a></li>
                        <!-- End Siswa -->

                        <!-- Sekolah -->
                        <li class="nav-item "><a href="<?= base_url('Sekolah/listSekolah'); ?>" class="nav-link <?php if ($sub_menu == 'listSekolah') {
                                                                                                                    echo "active";
                                                                                                                } ?>">Daftar Sekolah</a></li>
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