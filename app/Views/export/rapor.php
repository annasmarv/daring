<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type='text/css'>
		*{padding: 0;margin: 0;}
		* {
		  box-sizing: border-box;
		}
		.page_break { page-break-before: always; }
		h1 { 
			font-family: Cambria, Georgia, serif; 
			font-size: 24pt; 
			font-style: normal; 
			font-variant: normal; 
			font-weight: 700; 
			line-height: 26.4px; 
		} 
		h3 { 
			font-family: Cambria, Georgia, serif; 
			font-size: 12pt; 
			font-style: normal; 
			font-variant: normal; 
			font-weight: 700; 
			line-height: 15px; 
		} 
		p { 
			font-family: Cambria, Georgia, serif; 
			font-size: 9pt; 
			font-style: normal; 
			font-variant: normal; 
			font-weight: 250; 
			line-height: 15px; 
		} 
		body {
			font-family: Cambria, Georgia, serif; 
			font-size: 9pt;
			font-style: normal; 
			font-variant: normal; 
			font-weight: 250; 
			line-height: 15px;
		}
		.initabel {
		    font-family: Cambria, Georgia, serif; 
		    color: #000000!important;
		    border-collapse: collapse;
		    font-size: 9pt;
		    border: 1.5px solid black;
		}
		.initabel td{
			padding: 3px!important;
		}
		.initabel td .c{
			padding: 1px!important;
		}
		.initabel td {
		    border: 1.5px solid black;
		    padding: 0px 0px;
		    font-size: 9pt;
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
		    font-size: 9pt;
		}
		.tablettd td{
		   
		}
		.tablettd tr td {
		    text-align: center;
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
		@page { margin: 2cm 1cm 0 1cm; }
		body { margin: 2cm 1cm 0 1cm; }
	</style>
</head>
<body>
	<div class='wrapper'>
		<div class='form' style='text-align: justify;text-justify: inter-word;'>
  			<p style='text-align: center;font-size: 10pt;font-weight: bold'><b>LAPORAN HASIL BELAJAR SISWA</b></p>
			<p style='text-align: center;font-size: 10pt;font-weight: bold;'><b>PENILAIAN AKHIR TAHUN SEMESTER GENAP 2020/2021</b></p><br>

			<table>
				<tr>
					<td width="100">Nama Peserta Didik</td>
					<td width="10">:</td>
					<td><?= $data->fullname; ?></td>
				</tr>
				<tr>
					<td>NIS</td>
					<td>:</td>
					<td><?= $data->username; ?></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td><?= $data->class_group_name; ?></td>
				</tr>
				<tr>
					<td>Semester</td>
					<td>:</td>
					<td>Genap</td>
				</tr>
			</table>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<tr>
				</tr>
			</table>

			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>A. Nilai Akademik</p>
			</div>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<thead>
					<tr>
						<td height="20" width='20'><b>No</b></td>
						<td width='200'><b>Mata Pelajaran</b></td>
						<td><b>Pengetahuan</b></td>
						<td><b>Keteranpilan</b></td>
						<td><b>Nilai Akhir</b></td>
						<td><b>Predikat</b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan='6'><b>A. Muatan Nasional</b></td>
					</tr>
					<?php $no = 1; foreach ($dataa as $a): ?>
						<tr>
							<td class="c"><?= $no++; ?></td>				
							<td><?= $a['subject_name']; ?></td>				
							<td class="c"><?= $a['knowledge']; ?></td>				
							<td class="c"><?= $a['skils']; ?></td>				
							<td class="c"><?= 70/100*$a['skils']+30/100*$a['knowledge']; ?></td>				
							<td class="c"><?= predikat(70/100*$a['skils']+30/100*$a['knowledge']); ?></td>				
						</tr>
					<?php endforeach ?>	
					<tr>
						<td colspan='6'><b>B. Muatan Kewilayahan</b></td>
					</tr>
					<?php $no = 1; foreach ($datab as $b): ?>
						<tr>
							<td class="c"><?= $no++; ?></td>				
							<td><?= $b['subject_name']; ?></td>				
							<td class="c"><?= $b['knowledge']; ?></td>				
							<td class="c"><?= $b['skils']; ?></td>				
							<td class="c"><?= 70/100*$b['skils']+30/100*$b['knowledge']; ?></td>				
							<td class="c"><?= predikat(70/100*$b['skils']+30/100*$b['knowledge']); ?></td>				
						</tr>
					<?php endforeach ?>					
					<tr>
						<td colspan='6'>
							<b>C. Muatan Peminatan Kejuruan</b>
						</td>
					</tr>

					<?php if ($data->classid == 1 || $data->classid == 2 || $data->classid == 3 || $data->classid == 4): ?>
					<tr>
						<td colspan='6'><b>C1. Dasar Bidang Keahlian</b></td>
					</tr>
					<?php endif ?>
					<?php $no = 1; foreach ($datac1 as $c1): ?>
						<tr>
							<td class="c"><?= $no++; ?></td>				
							<td><?= $c1['subject_name']; ?></td>				
							<td class="c"><?= $c1['knowledge']; ?></td>				
							<td class="c"><?= $c1['skils']; ?></td>				
							<td class="c"><?= 70/100*$c1['skils']+30/100*$c1['knowledge']; ?></td>				
							<td  class="c"><?= predikat(70/100*$c1['skils']+30/100*$c1['knowledge']); ?></td>				
						</tr>
					<?php endforeach ?>	
					<?php if ($data->classid == 1 || $data->classid == 2 || $data->classid == 3 || $data->classid == 4): ?>
					<tr>
						<td colspan='6'><b>C2. Dasar Program Keahlian</b></td>
					</tr>
					<?php endif ?>
					<?php $no = 1; foreach ($datac2 as $c2): ?>
						<tr>
							<td class="c"><?= $no++; ?></td>				
							<td><?= $c2['subject_name']; ?></td>				
							<td class="c"><?= $c2['knowledge']; ?></td>				
							<td class="c"><?= $c2['skils']; ?></td>				
							<td class="c"><?= 70/100*$c2['skils']+30/100*$c2['knowledge']; ?></td>				
							<td  class="c"><?= predikat1(70/100*$c2['skils']+30/100*$c2['knowledge']); ?></td>				
						</tr>
					<?php endforeach ?>
					<?php if ($data->classid == 4 || $data->classid == 5 || $data->classid == 6 || $data->classid == 7 || $data->classid == 8): ?>
                    <tr>
						<td colspan='6'><b>C3. Kompetensi Keahlian</b></td>
					</tr>
					<?php endif ?>
					<?php $no = 1; foreach ($datac3 as $c3): ?>
						<tr>
							<td class="c"><?= $no++; ?></td>				
							<td><?= $c3['subject_name']; ?></td>				
							<td class="c"><?= $c3['knowledge']; ?></td>				
							<td class="c"><?= $c3['skils']; ?></td>				
							<td class="c"><?= 70/100*$c3['skils']+30/100*$c3['knowledge']; ?></td>				
							<td  class="c"><?= predikat1(70/100*$c3['skils']+30/100*$c3['knowledge']); ?></td>				
                    	</tr>
					<?php endforeach ?>	
				</tbody>
			</table>

			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>B. Catatan Akademik</p>
			</div>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<tr>
					<td valign='middle' height='30'><?php foreach ($cttakdm as $catatanakdm): ?>
						<?= $catatanakdm['deskripsi']  ?>
					<?php endforeach ?></td>
				</tr>
			</table>

			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>C. Praktek Kerja Lapangan</p>
			</div>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<thead>
				<tr>
					<td width='20' height="20">No.</td>
					<td>Mitra DUDI</td>
					<td>Lokasi</td>
					<td>Lamanya (Bulan)</td>
					<td>Keterangan</td>
				</tr>
				</thead>
				<tr>
					<td height='30' class='c'>-</td>
					<td class="c">-</td>
					<td class="c">-</td>
					<td class='c'> - </td>
					<td class="c">-</td>
				</tr>
			</table>
			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>D. Ekstrakulikuler</p>
			</div>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<thead>
				<tr>
					<td width='20' height="20">No.</td>
					<td width='180'>Kegiatan Ekstrakulikuler</td>
					<td>Keterangan</td>
				</tr>
				</thead>
                    <tr>
					    <td class='c'>-</td>
					    <td class="c">-</td>
					    <td class="c">-</td>
					</tr>
					<tr>
					    <td class='c'>-</td>
					    <td class="c">-</td>
					    <td class="c">-</td>
					</tr>
					<tr>
					    <td class='c'>-</td>
					    <td class="c">-</td>
					    <td class="c">-</td>
					</tr>
			</table>

			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>E. Kehadiran</p>
			</div>
			<table align='left' style='width: 35%;margin: 10px 0;border:1.5px solid black!important' >
				<?php foreach ($kehadiran as $x): ?>
				<tr>
					<td width='30'>Sakit</td>
					<td width='10'>:</td>
					<td width='5'><?= $x['sakit']; ?></td>
					<td width='1'>Hari</td>
				</tr>
				<tr>
					<td>Ijin</td>
					<td>:</td>
					<td width='5'><?= $x['ijin']; ?></td>
					<td>Hari</td>
				</tr>
				<tr>
					<td>Tanpa Keterangan</td>
					<td>:</td>
					<td width='5'><?= $x['absen']; ?></td>
					<td>Hari</td>
				</tr>
				<?php endforeach ?>
			</table>

			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>F. Kenaikan Kelas</p>
			</div>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<tr>
					<td valign='middle' height='30'>Naik / <span style='text-decoration: line-through;'>Tidak naik</span> ke kelas : <?php if ($data->classid == 1 ) {
						echo "XI TBSM 1";
					}elseif ($data->classid == 2) {
						echo "XI TBSM 2";
					}elseif ($data->classid == 3) {
						echo "XI TKJ 1";
					}elseif ($data->classid == 4) {
						echo "XI TKJ 2"; 
					}elseif ($data->classid == 5) {
						echo "XII TBSM 1";
					}elseif ($data->classid == 6) {
						echo "XII TBSM 2";
					}elseif ($data->classid == 7) {
						echo "XII TKJ 1";
					}elseif ($data->classid == 8) {
						echo "XII TKJ 2";
					}
				?></td>
				</tr>
			</table>
			
			<table class='tablettd' width='100' style='width: 100%'>
				<tr>
					<td width='5'>
						Mengetahui<br>
						Orang Tua<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						__________________<br>
						<br>
					</td>
					<td width='100'>&nbsp;</td>
					<td width='75'>
						Kendal, 18 Juni 2021<br>
						Wali Kelas<br>
						<br>
						<img src='https://daring.smkn7kendal.sch.id/assets/ttd/<?= $data->classid ?>.png' style='position: relative;height: 55px;'>
						<br>
						<?php
							if ($data->classid == 1) {
								$walas = "Dany Nurdiyanto, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 2) {
								$walas = "Rahayu Ariyani, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 3) {
								$walas = "Dahvia Arisma Widiastini, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 4) {
								$walas = "Ratna Widyawati, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 5) {
								$walas = "Beni Saputro, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 6) {
								$walas = "Miftakhul Rizki, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 7) {
								$walas = "Astri Widya Ramadhani, S.Pd.Kom";
								$nip = "-";
							}elseif ($data->classid == 8) {
								$walas = "Wawan Ragil Saputra, S.Pd";
								$nip = "-";
							}
							?>
						<u><?= $walas ?></u><br>
						NIP. <?= $nip ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class='stempel'>Mengetahui,<br>
						Kepala Sekolah<br>
						<br>
						<img src='https://daring.smkn7kendal.sch.id/assets/ttd/kepsek2.png' style='position: relative;height: 65px;'>
						<br>
						<u>BAMBANG MULYANTO, S.Pd</u><br>
						NIP. 19720214 200801 1 005</td>
					<td></td>
				</tr>
			</table>
		</div>
		<div class="page_break"></div>
		<div class='form' style='text-align: justify;text-justify: inter-word;'>
			<table>
				<tr>
					<td width="100">Nama Peserta Didik</td>
					<td width="10">:</td>
					<td><?= $data->fullname; ?></td>
				</tr>
				<tr>
					<td>NIS</td>
					<td>:</td>
					<td><?= $data->username; ?></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td><?= $data->class_group_name; ?></td>
				</tr>
				<tr>
					<td>Semester</td>
					<td>:</td>
					<td>Genap</td>
				</tr>
			</table>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<tr>
				</tr>
			</table>

			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>G. Deskripsi Perkembangan Karakter</p>
			</div>
			
			<?php if (empty($karakter)): ?>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<thead>
				<tr>
					<td width='200' height="15">Karakter yang dibangun</td>
					<td>Deskripsi</td>
				</tr>
				</thead>
				<tr>
					<td height='20' class='c'>-</td>
					<td class="c"></td>
				</tr>
				<tr>
					<td height='20' class='c'>-</td>
					<td class="c">-</td>
				</tr>
				<tr>
					<td height='20' class='c'>-</td>
					<td class="c">-</td>
				</tr>
				<tr>
					<td height='20' class='c'>-</td>
					<td class="c">-</td>
				</tr>
				<tr>
					<td height='20' class='c'>-</td>
					<td class="c">-</td>
				</tr>
			</table>
			
			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>H. Catatan Perkembangan Karakter</p>
			</div>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<tr>
					<td valign='middle' height='30'></td>
				</tr>
			</table>
			<?php endif ?>

			<?php foreach ($karakter as $kar): ?>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<thead>
				<tr>
					<td width='200' height="15">Karakter yang dibangun</td>
					<td>Deskripsi</td>
				</tr>
				</thead>
				<tr>
					<td height='20' class='c'>Integritas</td>
					<td class="c"><?= $kar['integritas']; ?></td>
				</tr>
				<tr>
					<td height='20' class='c'>Religius</td>
					<td class="c"><?= $kar['religius']; ?></td>
				</tr>
				<tr>
					<td height='20' class='c'>Nasionalis</td>
					<td class="c"><?= $kar['nasionalis']; ?></td>
				</tr>
				<tr>
					<td height='20' class='c'>Mandiri</td>
					<td class="c"><?= $kar['mandiri']; ?></td>
				</tr>
				<tr>
					<td height='20' class='c'>Gotong Royong</td>
					<td class="c"><?= $kar['gotong']; ?></td>
				</tr>
			</table>
			
			<div style='text-align: justify;text-justify: inter-word;font-weight:bold;' >
				<p style='font-weight:bold'>H. Catatan Perkembangan Karakter</p>
			</div>
			<table  class='initabel' align='left' width='100' style='width: 100%;margin: 10px 0;'>
				<tr>
					<td valign='middle' height='30'><?= $kar['catatan'] ?></td>
				</tr>
			</table>
			<?php endforeach ?>

			<table class='tablettd' width='100' style='width: 100%'>
				<tr>
					<td width='5'>
						Mengetahui<br>
						Orang Tua<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						__________________<br>
						<br>
					</td>
					<td width='100'>&nbsp;</td>
					<td width='75'>
						Kendal, 18 Juni 2021<br>
						Wali Kelas<br>
						<br>
						<img src='https://daring.smkn7kendal.sch.id/assets/ttd/<?= $data->classid ?>.png' style='position: relative;height: 55px;'>
						<br>
						<?php
							if ($data->classid == 1) {
								$walas = "Dany Nurdiyanto, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 2) {
								$walas = "Rahayu Ariyani, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 3) {
								$walas = "Dahvia Arisma Widiastini, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 4) {
								$walas = "Ratna Widyawati, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 5) {
								$walas = "Beni Saputro, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 6) {
								$walas = "Miftakhul Rizki, S.Pd";
								$nip = "-";
							}elseif ($data->classid == 7) {
								$walas = "Astri Widya Ramadhani, S.Pd.Kom";
								$nip = "-";
							}elseif ($data->classid == 8) {
								$walas = "Wawan Ragil Saputra, S.Pd";
								$nip = "-";
							}
							?>
						<u><?= $walas ?></u><br>
						NIP. <?= $nip ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class='stempel'>Mengetahui,<br>
						Kepala Sekolah<br>
						<br>
						<img src='https://daring.smkn7kendal.sch.id/assets/ttd/kepsek2.png' style='position: relative;height: 66px;'>
						<br>
						<u>BAMBANG MULYANTO, S.Pd</u><br>
						NIP. 19720214 200801 1 005</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>