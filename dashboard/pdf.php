<?php
// memanggil library FPDF
require_once("../config.php");
require_once("../auth.php");
require_once('../assets/pdf/fpdf.php');

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(200, 10, 'DATA PENJUALAN', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(20, 8, 'Transaction', 1, 0, 'C');
$pdf->Cell(50, 8, 'User', 1, 0, 'C');
$pdf->Cell(75, 8, 'Total', 1, 0, 'C');
$pdf->Cell(55, 8, 'Date', 1, 0, 'C');
$pdf->Cell(55, 8, 'Item', 1, 0, 'C');


$pdf->Cell(10, 8, '', 0, 1);
$pdf->SetFont('Times', '', 10);

$sql = "SELECT a.*, b.user, GROUP_CONCAT(d.product_name  SEPARATOR '\n') as product_name FROM transaction_header a LEFT JOIN login b ON a.user_id = b.id LEFT JOIN transaction_detail c ON a.doc_code = c.code_doc and a.doc_number = c.doc_number LEFT JOIN product d ON c.code_product = d.product_code GROUP BY a.doc_number";
$stmt = $db->query($sql);
while ($row = $stmt->fetch()) {
    $pdf->Cell(20, 8, $row['doc_code']."-".$row['doc_number'], 1, 0);
    $pdf->Cell(50, 8, $row['user'], 1, 0);
    $pdf->Cell(75, 8, $row['total'], 1, 0);
    $pdf->Cell(55, 8, $row['date'], 1, 0);
    $pdf->MultiCell(55, 4, $row['product_name'], 1, 1);
}

$pdf->Output();

?>