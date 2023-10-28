<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Export PDF</title>
    <style type='text/css'>
        *{padding: 0;margin: 0;}
        * {
          box-sizing: border-box;
        }
        h1 { 
            font-family: Arial, Georgia, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 700; 
        } 
        h3 { 
            font-family: Arial, Georgia, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 700; 
        } 
        p { 
            font-family: Arial, Georgia, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 250;
            font-size: 16px;
        } 
        body {
            font-family: Times New Roman, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 250;
        }
        .garis {
            line-height: 20px;
            border-color: black;
            border-style: double;
            border-width: 4px 0 0 0;
            box-shadow: /*-6px 0 0 0 black,*/  /* left */
                      /*6px 0 0 0 black,*/  /* right */
                      3px -3px 0 0 black, /* top */
                      -3px -3px 0 0 black; /* top */
        }
        .initabel {
            font-family: Arial, Georgia, serif; 
            color: #000000!important;
            border-collapse: collapse;
            font-size: 11pt;
            word-spacing: ;
        }
        .initabel td{
            padding: 3px!important;
        }
        .initabel td .c{
            padding: 1px!important;
        }
        .initabel td {
            border: 1px solid black;
            padding: 0px 0px;
            font-size: 11pt;
            word-spacing: 1px;
        }
        .initabel thead{
            text-align: center;
        }
        .initabel tbody .c{
            text-align: center;
        }
        .tablettd {
            font-family: Cambria, Georgia, serif; 
            color: #000000!important;
            border-collapse: collapse;
            font-size: 11pt;
            word-spacing: 1px;
        }
        .tablettd td{
           
        }
        .tablettd tr td {
        }
        .tablettd thead{
            text-align: center;
        }
        .wrapper {
            width: 100%;
            margin: 0 auto;
            line-height: 15px;
            padding:10px;
        }
        .header {
            margin-bottom: 1px;
            border-bottom: 3px solid black;
            padding: 10px 0;
        }
        .form {
            margin-bottom: 0px;
            padding: 0 0px;
            line-height: 15px;
        }
        table {
            width: 100%;
        }
        .form table td {
            padding: 1px 0px;
            line-height: 15px;
        }
        .kanan {
            align: right;
        }
        .ttd {
            position: absolute;
              right: 50px;
              padding: 20px;
              line-height: 15px;

        }
        .column {
            float: left;
        }
        .row:after {
            content: '';
            display: table;
            clear: both;
        }
        .footer{
            padding: 0 0px;
            line-height: 15px;
        }
        .cborder{
            border-top:1px solid black;
            margin-bottom: 10px;
        }
        .stempel{
            background-image: url('../assets/images/stempelsekolah.png');
            position: fixed;
            bottom:   0px;
            left:     0px;
            z-index:  -1;
            background-repeat:no-repeat;
        }
        .stemped{
            
            position: fixed;
            bottom:   0px;
            left:     0px;
            z-index:  -1;
            background-repeat:no-repeat;
        }
        #boxsatu, #boxdua, #boxtiga, #boxempat, #boxlima{
            position: fixed;
            height: 100%;
        }
        #boxsatu{
            width: 100px;
            left: 0px;
            bottom:   0px;
            background-color:red;
            z-index: 5;
        }
        #boxdua{
            width: 100px;
            left: 25px;
            bottom:   0px;
            background-color:green;
            z-index: 2;
        }
        #boxtiga{
            width: 3cm;
            right: 300px;
            bottom:   0px;
            background-color:transparent;
            z-index: 3;
        }
        #boxempat{
            width: 160px;
            right:180px;
            bottom:   0px;
            background-color:transparent;
            z-index: 4;
        }
        #boxlima{
            width: 210px;
            right:50px;
            bottom: 0;
            background-color:transparent;
            z-index: 5;
        }
        @page { margin: 1cm 2cm; }
        body { margin: 1cm 2cm; }
    </style>
</head>
<body>

    <div class='wrapper'>
        <div class='form' style='text-align: justify;text-justify: inter-word;'>
            <table width="100">
                <tr>
                    <td style="width: 20%;padding: 10px;"><img style="max-width: 80px!important" src="https://corona.jatengprov.go.id/assets/images/logo.png" /></td>
                    <td style="width: 80%">
                        <center>
                            <p style="line-height: 15px;font-weight: bold;">PEMERINTAH PROVINSI JAWA TENGAH</p>
                            <p style="line-height: 15px;font-weight: bold;">DINAS PENDIDIKAN DAN KEBUDAYAAN</p>
                            <h3 style="line-height: 20px">SEKOLAH MENENGAH KEJURUAN NEGERI 7 KENDAL</h3>
                            <p style="line-height: 13px;font-size: 12px">Jalan Raya Sukorejo - Bawang KM 7 Plantungan Kendal 51362</p>
                            <p style="line-height: 13px;font-size: 12px">Telp/Fax (0294) 3652992 E-mail: info@smkn7kendal.sch.id</u></p>
                            <p style="line-height: 13px;font-size: 12px">Website : <u>www.smkn7kendal.sch.id</u></p>
                        </center>
                    </td>
                    <td style="width: 5%">
                         &nbsp;
                    </td>
                </tr>
            </table>
            <div class="garis" style="margin-top: 1px">
            </div><br>
            <div style="margin-top: 10px;text-align: center;">
                <h4>RENCANA PEMBELAJARAN</h4>
            </div>
            <br>
            <table  class='beda' align='left' width='100' style='width: 100%;margin: 10px 0;'>
                <tr>
                    <td width="150"><p>Nama Guru</p></td>
                    <td width="10">:</td>
                    <td><p><?= $plan['fullname'] ?></p></td>
                </tr>
                <tr>
                    <td width="150"><p>Mata Pelajaran</p></td>
                    <td width="10">:</td>
                    <td><p><?= $plan['subject_name'] ?></p></td>
                </tr>
                <tr>
                    <td width="150"><p>Tema</p></td>
                    <td width="10">:</td>
                    <td><p><?= $plan['title'] ?></p></td>
                </tr>
                <tr>
                    <td width="150"><p>Alokasi Waktu</p></td>
                    <td width="10">:</td>
                    <td><p><?= $plan['alokasi_jp']; ?> JP</p></td>
                </tr>
                <tr>
                    <td width="150"><p>Kelas</p></td>
                    <td width="10">:</td>
                    <td><p><?php if ($plan['class_group_id']) {
                                                $kelass = explode(',', str_replace('+', '', $plan['class_group_id']));
                                                foreach ($kelass as $x) { 
                                                    foreach ($classes as $y) {  
                                                        if ($y['id'] == $x) { 
                                                            echo $y['class_group_name'].", "."</button> ";
                                                        }
                                                    }
                                                }
                                            } ?></p></td>
                </tr>
            </table>
            <br>
            <div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
                <p style='font-weight:bold'>Tujuan Pembelajaran</p>
            </div>
            <table  class='initabel' align='left' width='100' style='width: 100%;margin: 1px 0;'>
                <tr>
                    <td valign='middle' height='30'>
                        <?= $plan['goal']  ?>
                    </td>
                </tr>
            </table>
           <br>
            <div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
                <p style='font-weight:bold'>Refleksi Pembelajaran</p>
            </div>
            <table  class='initabel' align='left' width='100' style='width: 100%;margin: 1px 0;'>
                <tr>
                    <td valign='middle' height='30'>
                        <?= $plan['activity']  ?>
                    </td>
                </tr>
            </table>
            <br>
            <div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
                <p style='font-weight:bold'>Asesmen Pembelajaran</p>
            </div>
            <table  class='initabel' align='left' width='100' style='width: 100%;margin: 1px 0;'>
                <tr>
                    <td valign='middle' height='30'>
                        <?= $plan['asesmen']  ?>
                    </td>
                </tr>
            </table>
           <br>
            <table class='tablettd' width='100' style='width: 100%;margin: 5px 0 0 0'>
                <tr>
                    <td width='125' style="text-align: left;">

                        <br>
                        Guru Mapel<br>
                        <br><br><br>
                        <!-- <img src='../assets/ttd/X TBSM 1.png' style='height: 60px'> -->
                        <br><br>
                        <b><u><?= $plan['fullname'] ?></u></b><br>
                        NIP. 
                    </td>
                    <td width='100'>&nbsp;</td>
                    <td width='105'>
                        Kendal, <?= tgl_indo(date("Y-m-d")); ?><br>
                        Kepala Sekolah<br>
                        <br><br><br>
                        <!-- <img src='../assets/images/ttdd.png' style='height: 60px'> -->
                        <br><br>
                        <b><u>Heri Kurniadi, S.Pd., M.M.</u></b><br>
                        NIP. 19680214 200501 1 007
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>