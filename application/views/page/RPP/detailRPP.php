<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail RPP</title>
</head>

<body style="padding:2em">
    <div style="text-align: center;">
        <h3 style="bold">RENCANA PELAKSANAAN PEMBELAJARAAN HARIAN (RPPH) <br> TK KUSUMAWATI <br>
            Tahun <?php echo $queryRPP->thn_ajar_periode; ?>
        </h3>

        <table>
            <tr>
                <td>SEMESTER/BULAN/MINGGU/HARI KE</td>
                <td>:</td>
                <td><?php echo $queryRPP->rpp_Semester.'/'. ?></td>
            </tr>
        </table>
    </div>
</body>

</html>