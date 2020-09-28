<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-size: 10px;
    }

    .headerTitle {
        font-size: 10px;
        font-weight: 600;
    }

    .subHeader {
        margin-top: -10px
    }

    .myTable {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    thead .report-header {
        display: table-header-group;
    }



    .myTable td {
        border: 1px solid #000;
        font-size: 10px;
        text-align: center;
    }
</style>

<body>
    <?php $query = $this->db->query("SELECT *FROM TBL_PROMES INNER JOIN TBL_SCHOOLCLASS ON TBL_SCHOOLCLASS.CLASS_ID=TBL_PROMES.CLASS_ID WHERE PROMES_ID='1'")->row(); ?>
    <div style="text-align:center">
        <p class="headerTitle">PROGRAM SEMESTER</p>
        <p class="headerTitle subHeader">TAHUN PELAJARAN 2019/2020</p>
        <p class="headerTitle subHeader">TK <?php echo $query->CLASS_NAME ?></p>
        <p class="headerTitle subHeader"><?php echo $query->CLASS_NAME ?></p>
        <p class="headerTitle subHeader">(STRATEGI PEMBELAJARAN : <?php echo $query->PROMES_STRATEGY ?>)</p>
        <div>
            <table class="myTable">
                <thead class="report-header">
                    <tr>

                        <td>
                            <?= $nama_file; ?>
                        </td>
                        <td>
                            TEMA
                        </td>
                        <td>
                            SUB TEMA
                        </td>
                        <td>
                            CAPAIAN PERKEMBANGAN
                        </td>
                        <td colspan="2">
                            KOMPETENSI DASAR
                        </td>
                        <td>
                            EVALUASI PENILAIAN BULANAN
                        </td>
                        <td>
                            ALOKASI WAKTU
                        </td>

                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid black;">
                        <td rowspan="27">1</td>
                        <td rowspan="27">LEBARAN</td>
                        <td rowspan="27">LEBARAN</td>
                        <td rowspan="3">Nilai Agama Dan Moral</td>
                        <td>1.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                        <td rowspan="27">Penugasan Observasi Unjuk Kerja Hasil Karya</td>
                        <td rowspan="27">1 Minggu</td>
                    </tr>
                    <tr style="border-bottom: 1px solid black;">

                        <td>3.1</td>
                        <td>Mengenal kegiatan beribadah sehari-hari</td>
                    </tr>

                    <tr style="border-bottom: 1px solid black;">

                        <td>4.1</td>
                        <td>Melakukan kegiatan beribadah sehari-hari dengan tuntutan orang dewasa</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Fisik Motorik</td>
                        <td>2.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>3.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>3.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>

                    <tr>
                        <td rowspan="3">Kognitif</td>
                        <td>4.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>4.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>4.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>


                    <tr>
                        <td rowspan="3">Sosial Emosional</td>
                        <td>5.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>


                    <tr>
                        <td rowspan="3">Bahasa</td>
                        <td>4.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>4.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>4.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>


                    <tr>
                        <td rowspan="3">Seni</td>
                        <td>5.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>


                    <tr>
                        <td rowspan="3">Bahasa</td>
                        <td>4.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>4.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>4.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>


                    <tr>
                        <td rowspan="3">Seni</td>
                        <td>5.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>

                    <tr>
                        <td rowspan="3">Seni</td>
                        <td>5.1</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.2</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>
                    <tr>
                        <td>5.4</td>
                        <td> Mempercepat Adanya Tuhan Melalui Ciptaan Nya</td>
                    </tr>




                    <!-- <?php $queryTema = $this->db->query("SELECT *FROM TBL_PROMES_THEME")->result_array(); ?>

                    <?php $no = 1;
                    for ($nomer = 1; $nomer < 200; $nomer++) : ?>

                        <tr>

                            <td><?php echo $no; ?></td>
                        </tr>

                    <?php endfor; ?> -->
                </tbody>
            </table>
            <div>
                <div style="display: flex;">
                    <p style="margin-left:80px;justify-content:flex-start;text-align:left">Mengetahui, <span style="text-align:left"><br> Kepala TK Hj.Muhammad Fatah</span></p>
                    <p style="margin-right:80px;justify-content:flex-end;text-align:right"> Bekasi, 04 Agustus 2020</p> <br>
                    <p style="margin-right:80px;justify-content:flex-end;text-align:right">Guru Kelas</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>