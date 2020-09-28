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
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'kompetensi') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'kompetensi') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Kompetensi</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Kompetensi">
                        <!-- Kompetensi -->
                        <li class="nav-item "><a href="<?= base_url('Kompetensi/listKompetensiKomponen'); ?>" class="nav-link <?php if ($sub_menu == 'listKompKomponen') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Daftar Kompetensi Komponen</a></li>

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

                <!-- SNP -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'snp') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'snp') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>SNP</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="SNP">
                        <!-- SNP -->
                        <li class="nav-item "><a href="<?= base_url('SNP/listSNP'); ?>" class="nav-link <?php if ($sub_menu == 'listSNP') {
                                                                                                            echo "active";
                                                                                                        } ?>">Daftar SNP </a></li>

                        <!-- SNP Poin -->
                        <li class="nav-item "><a href="<?= base_url('SNP/listSNPPoin'); ?>" class="nav-link <?php if ($sub_menu == 'listSNPPoin') {
                                                                                                                echo "active";
                                                                                                            } ?>">Daftar SNP Poin</a></li>
                        <li class="nav-item "><a href="<?= base_url('SNP/listSNPKet'); ?>" class="nav-link <?php if ($sub_menu == 'listSNPKet') {
                                                                                                                echo "active";
                                                                                                            } ?>">Daftar SNP Keterangan Nilai</a></li>
                        <!-- End KKM -->
                    </ul>
                </li>
                <!-- End SNP -->


                <!-- STTPA -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'sttpa') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'sttpa') {
                                                    echo "active";
                                                } ?>"><i class="icon-copy"></i> <span>STTP</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo base_url() ?>STTPA" class="nav-link <?php if ($sub_menu == 'listSTTPA') {
                                                                                                            echo "active";
                                                                                                        } ?>">List STTPA</a></li>
                        <li class="nav-item"><a href="<?php echo base_url() ?>STTPA/listSTTPASubLingkup" class="nav-link <?php if ($sub_menu == 'listSTTPASubLingkup') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">List STTPA Sub Lingkup</a></li>

                        <li class="nav-item"><a href="<?php echo base_url() ?>STTPA/listSTPPADetail" class="nav-link <?php if ($sub_menu == 'listSTPPADetail') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">List STTPA Detail</a></li>
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

                <?php
                $jenisUser = strtolower($this->session->userdata('user')->jns_user_kd);
                if ($jenisUser  == 'guru' || $this->session->userdata('user')->jns_user_kd  == 'guru') {  ?>

                    <!-- Guru -->
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Guru</div> <i class="icon-menu" title="Guru"></i>
                    </li>
                    <!-- SKMT -->
                    <li class="nav-item ">
                        <a href="<?php echo base_url() ?>guru/SKMT" class="nav-link <?php if ($sub_menu == 'listSKMT') {
                                                                                        echo "active";
                                                                                    } ?>"><i class="icon-copy"></i><span>SKMT</span></a>
                    </li>
                    <!-- ENd SKMT -->
                    <!-- Dupak -->
                    <li class="nav-item">
                        <a href="<?php echo base_url() ?>guru/Dupak" class="nav-link <?php if ($sub_menu == 'listDupak') {
                                                                                            echo "active";
                                                                                        } ?>"><i class="icon-copy"></i><span>Dupak</span></a>
                    </li>
                    <!-- ENd Dupak -->
                    <!-- Menu Guru -->
                    <!-- PEMB -->
                    <li class="nav-item nav-item-submenu <?php if ($main_menu == 'perencanaan_pemb') {
                                                                echo "nav-item-open  nav-item-expanded";
                                                            } ?>">
                        <a href="#" class="nav-link <?php if ($main_menu == 'perencanaan_pemb') {
                                                        echo "active ";
                                                    } ?>"><i class="icon-copy"></i><span>Perencanaan PEMB</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Perencanaan PEMB">
                            <!-- Perencanaan PEMB -->
                            <li class="nav-item "><a href="<?= base_url('guru/PerencanaanPEMB/listPROTA'); ?>" class="nav-link <?php if ($sub_menu == 'listPROTA') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">PROTA </a></li>

                            <li class="nav-item "><a href="<?= base_url('guru/PerencanaanPEMB/listPROSEM'); ?>" class="nav-link <?php if ($sub_menu == 'listPROSEM') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">PROSEM </a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/PerencanaanPEMB/listSKL'); ?>" class="nav-link <?php if ($sub_menu == 'listSKL') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">SKL </a></li>

                            <li class="nav-item "><a href="<?= base_url('guru/PerencanaanPEMB/listKI'); ?>" class="nav-link <?php if ($sub_menu == 'listKI') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">KI/KD </a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/PerencanaanPEMB/listAnalisisKD'); ?>" class="nav-link <?php if ($sub_menu == 'listAnalisisKD') {
                                                                                                                                        echo "active";
                                                                                                                                    } ?>">Analisis KD </a></li>

                            <li class="nav-item "><a href="<?= base_url('guru/PerencanaanPEMB/listRPP'); ?>" class="nav-link <?php if ($sub_menu == 'listRPP') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">RPP</a></li>
                        </ul>
                    </li>
                    <!-- End PEMB -->
                    <!-- PEMB -->
                    <li class="nav-item nav-item-submenu <?php if ($main_menu == 'pkb') {
                                                                echo "nav-item-open  nav-item-expanded";
                                                            } ?>">
                        <a href="#" class="nav-link <?php if ($main_menu == 'pkb') {
                                                        echo "active ";
                                                    } ?>"><i class="icon-copy"></i><span>PKB</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="PKB">
                            <!-- PKB -->
                            <li class="nav-item "><a href="<?= base_url('guru/PKB/listPengembanganDiri'); ?>" class="nav-link <?php if ($sub_menu == 'listPengembanganDiri') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Pengembangan Diri </a></li>

                            <li class="nav-item "><a href="<?= base_url('guru/PKB/listPublikasiIlmiah'); ?>" class="nav-link <?php if ($sub_menu == 'listPublikasiIlmiah') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Publikasi Ilmiah </a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/PKB/listKarya'); ?>" class="nav-link <?php if ($sub_menu == 'listKarya') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Karya Inovatif </a></li>
                        </ul>
                    </li>
                    <!-- End PEMB -->
                    <!-- Penilaian -->
                    <li class="nav-item nav-item-submenu <?php if ($main_menu == 'penilaian') {
                                                                echo "nav-item-open  nav-item-expanded";
                                                            } ?>">
                        <a href="#" class="nav-link <?php if ($main_menu == 'penilaian') {
                                                        echo "active ";
                                                    } ?>"><i class="icon-copy"></i><span>Penilaian</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Penilaian">
                            <!-- Penilaian -->
                            <li class="nav-item "><a href="<?= base_url('guru/Penilaian/listKKM'); ?>" class="nav-link <?php if ($sub_menu == 'kkm') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">KKM </a></li>

                            <li class="nav-item "><a href="<?= base_url('guru/Penilaian/listPH'); ?>" class="nav-link <?php if ($sub_menu == 'ph') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">PH</a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/Penilaian/listPAS'); ?>" class="nav-link <?php if ($sub_menu == 'pas') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">PAS/PAT </a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/Penilaian/listPraktek'); ?>" class="nav-link <?php if ($sub_menu == 'praktekIbadah') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Praktek Ibadah</a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/Penilaian/listNilaiUS'); ?>" class="nav-link <?php if ($sub_menu == 'nilaiUS') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Nilai US</a></li>
                        </ul>
                    </li>
                    <!-- End Penilaian -->
                    <!-- SuperVisi -->
                    <li class="nav-item nav-item-submenu <?php if ($main_menu == 'supervisi') {
                                                                echo "nav-item-open  nav-item-expanded";
                                                            } ?>">
                        <a href="#" class="nav-link <?php if ($main_menu == 'supervisi') {
                                                        echo "active ";
                                                    } ?>"><i class="icon-copy"></i><span>Supervisi</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Supervisi">
                            <!-- Supervisi -->
                            <li class="nav-item "><a href="<?= base_url('guru/Supervisi/listJadwal'); ?>" class="nav-link <?php if ($sub_menu == 'jadwalSupervisi') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Jadwal Supervisi/Pembinaan </a></li>

                            <li class="nav-item "><a href="<?= base_url('guru/Supervisi/listHasil'); ?>" class="nav-link <?php if ($sub_menu == 'hasil') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Hasil Supervisi</a></li>
                        </ul>
                    </li>
                    <!-- End Supervisi -->

                    <!-- Pembelajaran -->
                    <li class="nav-item nav-item-submenu <?php if ($main_menu == 'pembelajaran') {
                                                                echo "nav-item-open  nav-item-expanded";
                                                            } ?>">
                        <a href="#" class="nav-link <?php if ($main_menu == 'pembelajaran') {
                                                        echo "active ";
                                                    } ?>"><i class="icon-copy"></i><span>Pembelajaran</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Pembelajaran">
                            <!-- Pembelajaran -->
                            <li class="nav-item "><a href="<?= base_url('guru/Pembelajaran/listBuku'); ?>" class="nav-link <?php if ($sub_menu == 'listBuku') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Buku Guru/Siswa</a></li>

                            <li class="nav-item "><a href="<?= base_url('guru/Pembelajaran/listMediaPembelajaran'); ?>" class="nav-link <?php if ($sub_menu == 'listMediaPembelajaran') {
                                                                                                                                            echo "active";
                                                                                                                                        } ?>">Media Pembelajaran</a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/Pembelajaran/listMateriPembinaan'); ?>" class="nav-link <?php if ($sub_menu == 'listMateriPembinaan') {
                                                                                                                                            echo "active";
                                                                                                                                        } ?>">Materi Pembinaan</a></li>
                            <li class="nav-item "><a href="<?= base_url('guru/Pembelajaran/listBankSoal'); ?>" class="nav-link <?php if ($sub_menu == 'listBankSoal') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Bank Soal</a></li>
                        </ul>
                    </li>
                    <!-- End Pembelajaran -->
                    <!-- End Menu Guru -->
                <?php } ?>




                <!-- Pengawas -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Pengawas</div> <i class="icon-menu" title="Pengawas"></i>
                </li>
                <!-- SKMT -->
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>Guru/SKMT/listSKMT" class="nav-link"><i class="icon-copy"></i><span>SKMT</span></a>
                </li>
                <!-- ENd SKMT -->
                <!-- Dupak -->
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>Guru/Dupak/listDupak" class="nav-link"><i class="icon-copy"></i><span>Dupak</span></a>
                </li>
                <!-- ENd Dupak -->
                <!-- Menu Pengawas -->
                <!-- Guru Binaan -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'guruBinaan') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'guruBinaan') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Guru Binaan</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Guru Binaan">
                        <!-- Guru Binaan -->
                        <li class="nav-item "><a href="<?= base_url('Guru/Binaan/listGuruBinaan'); ?>" class="nav-link <?php if ($sub_menu == 'guruBinaan') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">Daftar Guru Binaan </a></li>
                    </ul>
                </li>
                <!-- End Guru Binaan -->

                <!-- Sekolah Binaan -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'sekolahBinaan') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'sekolahBinaan') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Sekolah Binaan</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Sekolah Binaan">
                        <!-- Sekolah Binaan -->
                        <li class="nav-item "><a href="<?= base_url('Pengawas/Binaan/listSekolahBinaan'); ?>" class="nav-link <?php if ($sub_menu == 'guruBinaan') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Daftar Sekolah Binaan </a></li>
                    </ul>
                </li>
                <!-- End Sekolah Binaan -->


                <!-- Program Pengawasan -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'programPengawasan') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'programPengawasan') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Program Pengawasan</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Program Pengawasan">
                        <!-- Program Pengawasan -->
                        <li class="nav-item "><a href="<?= base_url('Pengawas/Pengawasan/listProgramPengawasan'); ?>" class="nav-link <?php if ($sub_menu == 'programPengawasan') {
                                                                                                                                            echo "active";
                                                                                                                                        } ?>">Daftar Program Pengawasan </a></li>
                    </ul>
                </li>
                <!-- End Program Pengawasan -->


                <!-- Pelaksanaan Pengawasan -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'pelaksanaanPengawasan') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'pelaksanaanPengawasan') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Pelaksanaan Pengawasan</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Pelaksanaan Pengawasan">
                        <!-- Pelaksanaan Pengawasan -->
                        <li class="nav-item "><a href="<?= base_url('Pengawas/PelaksanaanPengawasan/listPembinaan'); ?>" class="nav-link <?php if ($sub_menu == 'pembinaan') {
                                                                                                                                                echo "active";
                                                                                                                                            } ?>">Pembinaan </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/PelaksanaanPengawasan/listPemantauanSNP'); ?>" class="nav-link <?php if ($sub_menu == 'pemantauanSNP') {
                                                                                                                                                    echo "active";
                                                                                                                                                } ?>">Pemantauan SNP </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/PelaksanaanPengawasan/listPKG'); ?>" class="nav-link <?php if ($sub_menu == 'pKG') {
                                                                                                                                        echo "active";
                                                                                                                                    } ?>">PKG </a></li>
                    </ul>
                </li>
                <!-- End Pelaksanaan Pengawasan -->


                <!-- Evaluasi -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'evaluasi') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'evaluasi') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Evaluasi</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Evaluasi">
                        <!-- Evaluasi -->
                        <li class="nav-item "><a href="<?= base_url('Pengawas/Evaluasi/listPembinaan'); ?>" class="nav-link <?php if ($sub_menu == 'pembinaan') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Pembinaan </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/PemantauanSNP/listPemantauanSNP'); ?>" class="nav-link <?php if ($sub_menu == 'pemantauanSNP') {
                                                                                                                                            echo "active";
                                                                                                                                        } ?>">Pemantauan SNP </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/PKG/listPKG'); ?>" class="nav-link <?php if ($sub_menu == 'PKG') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">PKG </a></li>
                    </ul>
                </li>
                <!-- End Evaluasi -->

                <!-- Bimbingan Pelatihan -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'bimbinganPelatihan') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'bimbinganPelatihan') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Bimbingan Pelatihan Professional</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="BimbinganPelatihan">
                        <!-- bimbinganPelatihan -->
                        <li class="nav-item "><a href="<?= base_url('Pengawas/Binaan/listPembinaan'); ?>" class="nav-link <?php if ($sub_menu == 'pembinaan') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Pembinaan </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/SNP/listPemantauanSNP'); ?>" class="nav-link <?php if ($sub_menu == 'pemantauanSNP') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Pemantauan SNP </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/PKG/listPKG'); ?>" class="nav-link <?php if ($sub_menu == 'PKG') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">PKG </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/Bimbingan/listBimbingan'); ?>" class="nav-link <?php if ($sub_menu == 'bimbingan') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Bimbingan </a></li>
                    </ul>
                </li>
                <!-- End bimbinganPelatihan -->


                <!-- Bimbingan Pelatihan -->
                <li class="nav-item nav-item-submenu <?php if ($main_menu == 'laporan') {
                                                            echo "nav-item-open  nav-item-expanded";
                                                        } ?>">
                    <a href="#" class="nav-link <?php if ($main_menu == 'laporan') {
                                                    echo "active ";
                                                } ?>"><i class="icon-copy"></i><span>Laporan</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Laporan">
                        <!-- Laporan -->
                        <li class="nav-item "><a href="<?= base_url('Pengawas/Binaan/listPembinaan'); ?>" class="nav-link <?php if ($sub_menu == 'pembinaan') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Pembinaan </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/SNP/listPemantauanSNP'); ?>" class="nav-link <?php if ($sub_menu == 'pemantauanSNP') {
                                                                                                                                echo "active";
                                                                                                                            } ?>">Pemantauan SNP </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/PKG/listPKG'); ?>" class="nav-link <?php if ($sub_menu == 'PKG') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">PKG </a></li>

                        <li class="nav-item "><a href="<?= base_url('Pengawas/Bimbingan/listBimbingan'); ?>" class="nav-link <?php if ($sub_menu == 'bimbingan') {
                                                                                                                                    echo "active";
                                                                                                                                } ?>">Bimbingan </a></li>
                    </ul>
                </li>
                <!-- End bimbinganPelatihan -->

                <!-- End Menu Pengawas -->


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