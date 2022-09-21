<?php
function nama_hari($hari)
{
	switch ($hari) {
		case 'Sun':
		$nama = 'Minggu';
		break;
		case 'Mon':
		$nama = 'Senin';
		break;
		case 'Tue':
		$nama = 'Selasa';
		break;
		case 'Wed':
		$nama = 'Rabu';
		break;
		case 'Thu':
		$nama = 'Kamis';
		break;
		case 'Fri':
		$nama = 'Jumat';
		break;
		case 'Sat':
		$nama = 'Sabtu';
		break;
		default:
		$nama = "Hari Kiamat.";
		break;
	}
	return $nama;
}

function nama_bulan($bulan)
{
	switch ($bulan) {
		case '01':
		$nama = 'Januari';
		break;
		case '02':
		$nama = 'Februari';
		break;
		case '03':
		$nama = 'Maret';
		break;
		case '04':
		$nama = 'April';
		break;
		case '05':
		$nama = 'Mei';
		break;
		case '06':
		$nama = 'Juni';
		break;
		case '07':
		$nama = 'Juli';
		break;
		case '08':
		$nama = 'Agustus';
		break;
		case '09':
		$nama = 'September';
		break;
		case '10':
		$nama = 'Oktober';
		break;
		case '11':
		$nama = 'November';
		break;
		case '12':
		$nama = 'Desember';
		break;
		default:
		$nama = "Bulan Not Found";
		break;
	}
	return $nama;
}

$link = new mysqli("localhost","root","","rekeg");

// Check connection
if ($link -> connect_errno) {
	echo "Failed to connect to MySQL: " . $link -> connect_error;
	exit();
}
?>