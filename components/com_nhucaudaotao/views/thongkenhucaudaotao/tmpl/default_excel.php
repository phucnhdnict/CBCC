<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0); /* chon sheet active la sheet 1 */
$activeSheet = $objPHPExcel->getActiveSheet(); /* get sheet active */
$styleArray = array(
		'font' => array(
				'bold' => true
		),
		'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		),
		'borders' => array(
				'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
				)
		)
);
$border = array(
		'borders' => array(
				'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
				)
		)
);
$activeSheet->getStyle('A1:AB4')->applyFromArray($styleArray); /* apply style cho column từ A1 -> AB4 */
$activeSheet->freezePane('A5'); /* set Freeze Pane cho khung A4 */
$activeSheet->setCellValue('A1', 'STT'); /* set value cho A1 */
$activeSheet->setCellValue('B1', 'Tên đơn vị');
$activeSheet->setCellValue('C1', 'Tổng');
$activeSheet->setCellValue('D1', 'Nhu cầu đào tạo');
$activeSheet->setCellValue('D2', 'Chuyên môn');
$activeSheet->setCellValue('J2', 'Lý luận chính trị');
$activeSheet->setCellValue('M2', 'Tin học');
$activeSheet->setCellValue('P2', 'Anh văn');
$activeSheet->setCellValue('S2', 'NN khác');
$activeSheet->setCellValue('V2', 'QLNN');
$activeSheet->setCellValue('Y2', 'Quốc phòng');
$activeSheet->setCellValue('AB2', 'Khác');

$activeSheet->setCellValue('D3', 'Tiến sĩ');
$activeSheet->setCellValue('E3', 'Thạc sĩ');
$activeSheet->setCellValue('F3', 'Đại học');
$activeSheet->setCellValue('G3', 'Cao đẳng');
$activeSheet->setCellValue('H3', 'Trung cấp');
$activeSheet->setCellValue('I3', 'Còn lại');
$activeSheet->setCellValue('J3', 'Cử nhân');
$activeSheet->setCellValue('K3', 'Cao cấp');
$activeSheet->setCellValue('L3', 'Trung cấp');
$activeSheet->setCellValue('M3', 'Cử nhân trở lên');
$activeSheet->setCellValue('N3', 'TC,CĐ');
$activeSheet->setCellValue('O3', 'Cơ sở');
$activeSheet->setCellValue('P3', 'Cử nhân trở lên');
$activeSheet->setCellValue('Q3', 'TC,CĐ');
$activeSheet->setCellValue('R3', 'Cơ sở');
$activeSheet->setCellValue('S3', 'Cử nhân trở lên');
$activeSheet->setCellValue('T3', 'TC,CĐ');
$activeSheet->setCellValue('U3', 'Cơ sở');
$activeSheet->setCellValue('V3', 'CVCC');
$activeSheet->setCellValue('W3', 'CVC');
$activeSheet->setCellValue('X3', 'CV');
$activeSheet->setCellValue('Y3', 'Đối tượng 1,2');
$activeSheet->setCellValue('Z3', 'Đối tượng 3');
$activeSheet->setCellValue('AA3', 'Đối tượng 4,5');
$activeSheet->setCellValue('AB3', 'Khác');

$activeSheet->setCellValue('B4', 'A');
$activeSheet->setCellValue('C4', '1');
$activeSheet->setCellValue('D4', '2');
$activeSheet->setCellValue('E4', '3');
$activeSheet->setCellValue('F4', '4');
$activeSheet->setCellValue('G4', '5');
$activeSheet->setCellValue('H4', '6');
$activeSheet->setCellValue('I4', '7');
$activeSheet->setCellValue('J4', '8');
$activeSheet->setCellValue('K4', '9');
$activeSheet->setCellValue('L4', '10');
$activeSheet->setCellValue('M4', '11');
$activeSheet->setCellValue('N4', '12');
$activeSheet->setCellValue('O4', '13');
$activeSheet->setCellValue('P4', '14');
$activeSheet->setCellValue('Q4', '15');
$activeSheet->setCellValue('R4', '16');
$activeSheet->setCellValue('S4', '17');
$activeSheet->setCellValue('T4', '18');
$activeSheet->setCellValue('U4', '19');
$activeSheet->setCellValue('V4', '20');
$activeSheet->setCellValue('W4', '21');
$activeSheet->setCellValue('X4', '22');
$activeSheet->setCellValue('Y4', '23');
$activeSheet->setCellValue('Z4', '24');
$activeSheet->setCellValue('AA4', '25');
$activeSheet->setCellValue('AB4', '26');

$activeSheet->mergeCells('A1:A3');
$activeSheet->mergeCells('B1:B3');
$activeSheet->mergeCells('C1:C3');
$activeSheet->mergeCells('D1:AB1');
$activeSheet->mergeCells('D2:I2'); //chuyên môn
$activeSheet->mergeCells('J2:L2'); //lý luận chính trị
$activeSheet->mergeCells('M2:O2'); //tin học
$activeSheet->mergeCells('P2:R2'); //Anh văn
$activeSheet->mergeCells('S2:U2'); //NN khác 
$activeSheet->mergeCells('V2:X2'); //QLNN
$activeSheet->mergeCells('Y2:AA2'); //QPhong
$activeSheet->mergeCells('AB2:AB3'); //Khác
$arr= $this->rows;
$alpha = 'B'; // A, B, C trong excel
$start = 5; // cột số 1,2,3 trong excel
$stt=1;
for($i=0; $i<sizeof($arr);$i++)
{
	for($j=0; $j<=26;$j++)
	{	$pos = $alpha.$start; // vị trí A1, B2,...
		$activeSheet->setCellValue('A'.$start, $stt);
		$activeSheet->setCellValue($pos, $arr[$i][0][$j]);
		$alpha++;
	}
	$alpha ='B';
	$activeSheet->getStyle(
			'A'.$start.':AB'.$start
	)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$start++;
	$stt++;
}
/**
 * start export
*/
ob_end_clean();
$excelFileName = 'Thongkenhucaudaotao';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $excelFileName .'.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 20 Jan 2015 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
exit();
?>