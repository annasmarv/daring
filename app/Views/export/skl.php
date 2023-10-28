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
            font-family: Cambria, Georgia, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 700; 
        } 
        h3 { 
            font-family: Cambria, Georgia, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 700; 
        } 
        p { 
            font-family: Cambria, Georgia, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 250;
            font-size: 15px;
        } 
      
        body {
            font-family: Cambria, Georgia, serif; 
            font-style: normal; 
            font-variant: normal; 
            font-weight: 350;
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
            font-family: Cambria, Georgia, serif; 
            color: #000000!important;
            border-collapse: collapse;
            font-size: 14px!important;
        }
        .iinitabel td{
            padding: 30px!important;
        }
        .initabel td .c{
            padding: 10px!important;
        }
        .initabel td {
            border: 1px solid black;
            padding: 5px 5px;
            font-size: 14px;
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
            font-size: 14px;
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
            line-height: 18px;
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
            line-height: 18px;
        }
        table {
            width: 100%;
        }

        .kanan {
            align: right;
        }
        .ttd {
            position: absolute;
              right: 50px;
              padding: 20px;
              line-height: 18px;

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
            line-height: 18px;
        }
        .cborder{
            border-top:1px solid black;
            margin-bottom: 10px;
        }
        .stempel{
            background-image: url('https://daring.smkn7kendal.sch.id/assets/ttd/stempel3.png');
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
        @page { margin: 1cm 1.5cm; }
        body { margin: 1cm 1.5cm; }
    </style>
</head>
<body>

    <div class='wrapper'>
        <div class='form' style='text-align: justify;text-justify: inter-word;'>
            <table width="100">
                <tr>
                    <td style="width: 10%;"><img style="max-width: 80px!important" src="https://daring.smkn7kendal.sch.id/assets/ttd/jateng.jpg" /></td>
                    <td style="width: 67%">
                        <center>
                            <p style="line-height: 16px;font-weight: bold;">PEMERINTAH PROVINSI JAWA TENGAH</p>
                            <p style="line-height: 16px;font-weight: bold;">DINAS PENDIDIKAN DAN KEBUDAYAAN</p>
                            <h3 style="line-height: 20px;padding: 0 50px">SEKOLAH MENENGAH KEJURUAN NEGERI 7 KENDAL</h3>
                            <p style="line-height: 13px;font-size: 12px">Jalan Raya Sukorejo-Bawang Plantungan Kendal 51362</p>
                            <p style="line-height: 13px;font-size: 12px">Telp. (0294) 365 2992 E-mail : info@smkn7kendal.sch.id Website : <u>www.smkn7kendal.sch.id</u></p>
                        </center>
                    </td>
                    <td style="width: 10%">
                         <!-- <img style="max-width: 80px!important" src="https://corona.jatengprov.go.id/assets/images/logo.png" /> -->
                    </td>
                </tr>
            </table>
            <div class="garis" style="margin-top: 1px">
            </div><br>
            <div style="margin-top: 0;text-align: center;">
                <p><b>SURAT KETERANGAN LULUS</b></p>
                <p><b>SMK NEGERI 7 KENDAL</b></p>
                <p><b>PROGRAM KEAHLIAN : TEKNIK OTOMOTIF</b></p>
                <p><b>KOMPETENSI KEAHLIAN : TEKNIK DAN BISNIS SEPEDA MOTOR</b></p>
                <p><b>TAHUN PELAJARAN 2020/2021</b></p><br>
                <p>Nomor : 423.2 / 456 / SMK</p>
            </div><br>
            <p style="">Yang  bertanda  tangan  di  bawah  ini,  Kepala  Sekolah  Menengah  Kejuruan  Negeri  7  Kendal,  Kabupaten  Kendal, Provinsi Jawa Tengah menerangkan bahwa :</p>
            <table  class='beda' align='left' width='100' style='width: 100%;margin: 10px 0;'>
                <tr>
                  <td width="50">&nbsp;</td>
                    <td width="150"><p>Nama</p></td>
                    <td width="10">:</td>
                    <td><p></p></td>
                </tr>
                <tr>
                  <td></td>
                    <td width="150"><p>Tempat dan Tanggal Lahir</p></td>
                    <td width="10">:</td>
                    <td><p></p></td>
                </tr>
                <tr>
                  <td></td>
                    <td width="150"><p>Nama Orang Tua</p></td>
                    <td width="10">:</td>
                    <td><p></p></td>
                </tr>
                <tr>
                  <td></td>
                    <td width="150"><p>Nomor Induk Siswa</p></td>
                    <td width="10">:</td>
                    <td><p></p></td>
                </tr>
                <tr>
                  <td></td>
                    <td width="150"><p>Nomor Induk Siswa Nasional</p></td>
                    <td width="10">:</td>
                    <td><p></p></td>
                </tr>
            </table>
            <p style="">dinyatakan <b>LULUS</b> dari SMK  Negeri  7  Kendal berdasarkan  kriteria  kelulusan  SMK Negeri  7  Kendal  Kabupaten Kendal Tahun Pelajaran 2020/2021, dengan nilai sebagai berikut : </p><br>

            <table  class='initabel' align='left' width='100' row style='width: 100%;margin: 1px 0;'>
                <thead>
                    <tr>
                        <td width='1' align="center">NO</td>
                        <td width='250'>MATA PELAJARAN</td>
                        <td width="70">NILAI UJIAN SEKOLAH</td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                      <td class="c">1</td>
                      <td>Pendidikan Agama dan Budi Pekerti</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">2</td>
                      <td>Pendidikan Pancasila dan Kewarganegaraan</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">3</td>
                      <td>Bahasa Indonesia</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">4</td>
                      <td>Matematika</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">5</td>
                      <td>Sejarah Indonesia</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">6</td>
                      <td>Bahasa Inggris</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">7</td>
                      <td>Seni Budaya</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">8</td>
                      <td>Pendidikan Jasmani, Olahraga dan Kesehatan</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">9</td>
                      <td>Bahasa Jawa</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">10</td>
                      <td>Simulasi dan Komunikasi Digita</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">11</td>
                      <td>Fisika</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">12</td>
                      <td>Kimia</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">13</td>
                      <td>C2 Dasar Program Keahlian</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="c">14</td>
                      <td>C3 Kompetensi Keahlian</td>
                      <td></td>
                  </tr>
                </tbody>
            </table>
           <br>
           <p style="">Surat Keterangan   Lulus   ini   berlaku   sementara   sampai   dengan   diterbitkannya Ijazah   Tahun   Pelajaran 2020/2021, untuk menjadikan maklum bagi yang berkepentingan. </p>

            <table class='tablettd' width='100' style='width: 100%;margin: 5px 0 0 0'>
                <tr>
                    <td width='145'>
                      &nbsp;
                    </td>
                    <td align="center" width='50'>&nbsp;</td>
                    <td width='100' class="sstempel" style="text-align: center;">

                        Kendal, 3 Juni 2021<br>
                        KEPALA SEKOLAH<br>
                        <br><br><br>
                        <!-- <img src='https://daring.smkn7kendal.sch.id/assets/ttd/kepsek2.png' style='position: relative;height: 55px;left: 100px;margin-right: 101px;'> -->
                        <br>
                        <b><u>BAMBANG MULYANTO, S.Pd</u></b><br>
                        NIP.  19720214  200801  1  005
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>