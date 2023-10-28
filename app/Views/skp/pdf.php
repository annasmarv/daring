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
        .c{
            text-align: center;
        }
        .brl{
            border-right-color: white!important;
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
        @page { margin: 0.5cm 1.5cm; }
        body { margin: 0.5cm 1.5cm; }
    </style>
</head>
<body>

    <div class='wrapper'>
        <div class='form' style='text-align: justify;text-justify: inter-word;'>
            <div style="margin-top: 10px;text-align: center;">
                <h4>PENILAIAN SASARAN KINERJA PEGAWAI</h4>
            </div>
            <br>
            <table  class='beda' align='left' width='100' style='width: 100%;margin: 10px 0;'>
                <tr>
                    <td height="11" width="245"><p>Periode Penilaian</p></td>
                    <td width="10"><p>Nama</p></td>
                    <td><p style="margin-left:10px">: <?= $data['fullname']; ?></p></td>
                </tr>
                <tr>
                    <td height="11" width="245"><p>BULAN  : <?= strtoupper($data['month_name']); ?></p></td>
                    <td width="10"><p>NIP</p></td>
                    <td><p style="margin-left:10px">: -</p></td>
                </tr>
            </table>
            <table  class='initabel' border="1" align='left' width='100' style='width: 100%;margin: 1px 0;'>
                <thead>
                    <tr class="text-center">
                        <td width="5" rowspan="2"><strong>NO</strong></td>
                        <td rowspan="2" style="width: 300px;"><strong>I. KEGIATAN TUGAS JABATAN</strong></td>
                        <td colspan="2"><strong>TARGET</strong></td>
                        <td colspan="3"><strong>REALISASI</strong></td>
                        <td style="width:110px" rowspan="2"><strong>NILAI CAPAIAN SKP</strong></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="2" style="width:300px">Kuant/Output</td>
                        <td colspan="2" style="width:300px">Kuant/Output</td>
                        <td height="20" style="width:40px">Kual/ Mutu</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($skps as $skp): ?>
                    <tr>
                        <td class="c"><?= $no++; ?></td>
                        <td><?= $skp['kegiatan'] ?></td>
                        <td class="c brl"><?= $skp['target']; ?></td>
                        <td><?= $skp['output']; ?></td>
                        <td class="c brl"><?= $skp['realisasi']; ?></td>
                        <td><?= $skp['output']; ?></td>
                        <td class="c"><?= $skp['mutu']; ?></td>
                        <td class="c"><?= number_format((float)$skp['nilai'], 2, '.', ''); ?></td>
                    </tr>
                    <?php endforeach ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="brl"></td>
                        <td></td>
                        <td class="brl"></td>
                        <td></td>
                        <td></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="brl"></td>
                        <td></td>
                        <td class="brl"></td>
                        <td></td>
                        <td></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7"><strong>II. TUGAS TAMBAHAN DAN KREATIVITAS :</strong></td>
                    </tr>
                    <tr>
                        <td class="c">1</td>
                        <td>(tugas tambahan)</td>
                        <td class="brl"></td>
                        <td></td>
                        <td class="brl"></td>
                        <td class="brl"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td class="brl"></td>
                        <td></td>
                        <td class="brl"></td>
                        <td class="brl"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="c">2</td>
                        <td>(kreativitas)</td>
                        <td class="brl"></td>
                        <td></td>
                        <td class="brl"></td>
                        <td class="brl"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="brl"></td>
                        <td></td>
                        <td class="brl"></td>
                        <td class="brl"></td>
                        <td></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                       <td rowspan="2" colspan="7" class="c">
                           <strong>NILAI CAPAIAN SKP</strong>
                       </td> 
                       <td class="c">
                           <?php  
                           $sum = 0;
                            foreach($skps as $skp)
                            {
                               $sum+= $skp['nilai'];
                            }
                            ?>
                            <?= number_format((float)$sum/$count, 2, '.', ''); ?>
                       </td>
                    </tr>
                    <tr>
                        <td class="c"><?= 'Baik' ?></td>
                    </tr>
                </tbody>
            </table>

           <br>
            <table class='tablettd' border="0" width='100' style='margin: 5px 0 0 0'>
                <tr>
                    <td width='10' style="text-align: center;">

                        <br>
                        Pegawai Yang Dinilai<br>
                        <br><br><br>
                        <!-- <img src='../assets/ttd/X TBSM 1.png' style='height: 60px'> -->
                        <br><br>
                        <b><u><?= $data['fullname']; ?></u></b><br>
                        <p style="margin-top:5px">NIP.- </p>
                    </td>
                    <td width='5'>&nbsp;</td>
                    <td width='10' style="text-align:center;">
                        Kendal, <?= tgl_indo(date("Y-m-d")); ?><br>
                        Pejabat Penilai<br>
                        <br><br><br>
                        <!-- <img src='../assets/images/ttdd.png' style='height: 60px'> -->
                        <br><br>
                        <b><u>Heri Kurniadi, S.Pd., M.M.</u></b><br>
                        <p style="margin-top:5px">NIP. 19680214 200501 1 007</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>