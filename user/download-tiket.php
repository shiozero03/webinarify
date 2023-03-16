<?php
include '../php/config.php';
include('../php/session-user.php');
if(isset($_SESSION['id_user'])){
    require ("../library/fpdf/fpdf.php");
    $query = mysqli_query($conn, "SELECT * FROM daftar_webinar WHERE id_pendaftaran = '".$_GET['id']."'");

    $result = mysqli_fetch_assoc($query);

    $query2 = mysqli_query($conn, "SELECT * FROM event_webinar WHERE id_event = '".$result['id_event']."'");

    $result2 = mysqli_fetch_assoc($query2);

	$pdf = new FPDF();
    $pdf->AddPage('L','A5','C');
    $pdf->SetFont('arial','B','15');
    $pdf->Cell(0, 6, $result2['judul_event'], 0, 1, 'C');
    $pdf->SetFont('Arial', 'B',10);
    $pdf->Cell(0,6,'Tanggal Event : '.date('d-M-Y', strtotime($result2['tanggal_event'])),0,0, 'C');
    $pdf->Cell(0,12,'',0,1);

    $pdf->SetFont('Arial', 'B',14);
    $pdf->Cell(55,6,'Nama',0,0);
    $pdf->Cell(135,6,': '.$result['nama'],0,0);
    $pdf->Cell(0,6,'',0,1);
    $pdf->Cell(55,6,'Email',0,0);
    $pdf->Cell(135,6,': '.$result['email'],0,0);
    $pdf->Cell(0,6,'',0,1);
    $pdf->Cell(55,6,'Telepon',0,0);
    $pdf->Cell(135,6,': '.$result['telepon'],0,0);
    $pdf->Cell(0,12,'',0,1);

    $pdf->SetFont('Arial','B',10);
    $pdf->cell(0, 6, 'NOTA PEMBAYARAN', 1, 0, 'C');
    $pdf->Cell(0,6,'',0,1);
    $pdf->SetFont('Arial', 'I',10);
    $pdf->Cell(95,6,'Harga Tiket',1,0);
    $pdf->Cell(95,6,'Rp '.number_format($result2['harga'],2, ',','.').' ',1,0, 'R');
    $pdf->Cell(0,6,'',0,1);
    $pdf->Cell(95,6,'Diskon',1,0);
    $pdf->Cell(95,6,'Rp 0,00',1,0, 'R');
    $pdf->Cell(0,6,'',0,1);
    $pdf->SetFont('Arial', 'B',10);
    $pdf->Cell(95,6,'Harga Tiket',1,0);
    $pdf->Cell(95,6,'Rp '.number_format($result['harga'],2, ',','.').' ',1,0, 'R');
    $pdf->Cell(0,22,'',0,1);
    $pdf->cell(0, 6, 'Penyelenggara', 0, 0, 'R');
    $pdf->Cell(0,18,'',0,1);
    $pdf->cell(0, 6, $result2['penyelenggara'], 0, 0, 'R');
    $pdf->Output();
}
?>