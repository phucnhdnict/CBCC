<?php
/**
 * Author: Phucnh
 * Date created: Apr 23, 2015
 * Company: DNICT
 */
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$activeSheet = $objPHPExcel->getActiveSheet(); 
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
$style = array(
		'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		)
);
$left = array(
		'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		)
);
$bold = array(
		'font' => array(
				'bold' => true
		),
);
$underline = array(
		'font' => array(
				'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
		),
);

$activeSheet->getDefaultStyle()->applyFromArray($style);
$activeSheet->getStyle('A6:AA7')->applyFromArray($styleArray); 
$activeSheet->getStyle('A8:AA24')->applyFromArray($border); 
$activeSheet->setCellValue('A1', 'UBND THÀNH PHỐ'); 
$activeSheet->setCellValue('D1', 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
$activeSheet->getStyle('D1:X1')->applyFromArray($bold);
$activeSheet->setCellValue('Y1', 'Mẫu số 1');
$activeSheet->setCellValue('A2', 'CƠ QUAN, ĐƠN VỊ:');
$activeSheet->getStyle('A2:C2')->applyFromArray($bold);
$activeSheet->setCellValue('D2', 'Độc lập - Tự do - Hạnh phúc');
$activeSheet->getStyle('D2:X2')->applyFromArray($bold);
$activeSheet->getStyle('D2:X2')->applyFromArray($underline);
$activeSheet->setCellValue('A4', 'TỔNG HỢP KẾT QUẢ ĐÀO TẠO BỒI DƯỠNG CÁN BỘ, CÔNG CHỨC TRONG NƯỚC');
$tungay = $this->tungay; $denngay = $this->denngay;
$activeSheet->setCellValue('K5', 'Từ ngày: '.$tungay);
$activeSheet->mergeCells('K5:M5');
$activeSheet->setCellValue('N5', 'Đến ngày: '.$denngay);
$activeSheet->mergeCells('N5:P5');
$activeSheet->setCellValue('A6', 'TT');
$activeSheet->setCellValue('B6', 'Đối tượng');
$activeSheet->setCellValue('D6', 'Lý luận chính trị');
$activeSheet->setCellValue('D7', 'Cử nhân');
$activeSheet->setCellValue('E7', 'Cao cấp');
$activeSheet->setCellValue('F7', 'Trung cấp');
$activeSheet->setCellValue('G7', 'Sơ cấp');
$activeSheet->setCellValue('H6', 'Quản lý nhà nước');
$activeSheet->setCellValue('H7', 'CV cao cấp');
$activeSheet->setCellValue('I7', 'CV chính');
$activeSheet->setCellValue('J7', 'Chuyên viên');
$activeSheet->setCellValue('K7', 'Cán sự');
$activeSheet->setCellValue('L6', 'Chuyên môn');
$activeSheet->setCellValue('L7', 'Tiến sĩ (CK II)');
$activeSheet->setCellValue('M7', 'Thạc sĩ (CK I)');
$activeSheet->setCellValue('N7', 'Đại học');
$activeSheet->setCellValue('O7', 'Cao đẳng');
$activeSheet->setCellValue('P7', 'Trung cấp');
$activeSheet->setCellValue('Q7', 'Sơ cấp');
$activeSheet->setCellValue('R6', 'Bồi dưỡng ngắn hạn');
$activeSheet->setCellValue('R7', 'Kiến thức, kỹ năng chuyên ngành');
$activeSheet->setCellValue('S7', 'Kỹ năng lãnh đạo, quản lý');
$activeSheet->setCellValue('T7', 'Tiếng dân tôc');
$activeSheet->setCellValue('U7', 'Khác');
$activeSheet->setCellValue('V6', 'QP-AN');
$activeSheet->setCellValue('W6', 'Ngoại ngữ');
$activeSheet->setCellValue('X6', 'Tin học');
$activeSheet->setCellValue('Y6', 'Tổng số');
$activeSheet->setCellValue('Z6', 'Trong đó');
$activeSheet->setCellValue('Z7', 'Người dân tộc thiểu số');
$activeSheet->setCellValue('AA7', 'Nữ');

$activeSheet->mergeCells('A1:B1');
$activeSheet->mergeCells('A2:B2');
$activeSheet->mergeCells('D1:X1');
$activeSheet->mergeCells('D2:X2');
$activeSheet->mergeCells('A4:AA4');
$activeSheet->mergeCells('Y1:AA1');
$activeSheet->mergeCells('A6:A7');
$activeSheet->mergeCells('B6:C7');
$activeSheet->mergeCells('V6:V7');
$activeSheet->mergeCells('W6:W7');
$activeSheet->mergeCells('X6:X7');
$activeSheet->mergeCells('Y6:Y7');
$activeSheet->mergeCells('Z6:AA6');
$activeSheet->mergeCells('Y6:Y7');
$activeSheet->mergeCells('D6:G6');
$activeSheet->mergeCells('H6:K6');
$activeSheet->mergeCells('L6:Q6');
$activeSheet->mergeCells('R6:U6');
$activeSheet->mergeCells('Z6:AA6');
$activeSheet->getStyle('A6:AD30')
    ->getAlignment()->setWrapText(true); 

$activeSheet->getStyle('C8:C22')->applyFromArray($left);
$activeSheet->setCellValue('A8', '1');
$activeSheet->mergeCells('A8:A11');
$activeSheet->setCellValue('B8', 'Cán bộ, công chức lãnh đạo quản lý');
$activeSheet->mergeCells('B8:B11');
$activeSheet->setCellValue('C8', 'Cấp tỉnh, thành phố');
$activeSheet->setCellValue('C9', 'Cấp sở & tương đương');
$activeSheet->setCellValue('C10', 'Cấp huyện và tương đương');
$activeSheet->setCellValue('C11', 'Cấp phòng và tương đương');

$activeSheet->setCellValue('A12', '2');
$activeSheet->mergeCells('A12:A16');
$activeSheet->setCellValue('B12', 'Các ngạch công chức');
$activeSheet->mergeCells('B12:B16');
$activeSheet->setCellValue('C12', 'Chuyên viên cao cấp');
$activeSheet->setCellValue('C13', 'Chuyên viên chính');
$activeSheet->setCellValue('C14', 'Chuyên viên');
$activeSheet->setCellValue('C15', 'Cán sự');
$activeSheet->setCellValue('C16', 'Công chức tập sự');

$activeSheet->setCellValue('A17', '3');
$activeSheet->setCellValue('B17', 'Công chức trong nguồn quy hoạch');
$activeSheet->mergeCells('B17:C17');

$activeSheet->setCellValue('A18', '4');
$activeSheet->mergeCells('A18:A20');
$activeSheet->setCellValue('B18', 'Đại biểu HĐND');
$activeSheet->mergeCells('B18:B20');
$activeSheet->setCellValue('C18', 'Cấp thành phố');
$activeSheet->setCellValue('C19', 'Cấp quận, huyện');
$activeSheet->setCellValue('C20', 'Cấp xã');

$activeSheet->setCellValue('A21', '5');
$activeSheet->mergeCells('A21:A22');
$activeSheet->setCellValue('B21', 'CBCC cấp xã');
$activeSheet->mergeCells('B21:B22');
$activeSheet->setCellValue('C21', 'Cán bộ chuyên trách');
$activeSheet->setCellValue('C22', 'Công chức cấp xã');

$activeSheet->setCellValue('A23', '6');
$activeSheet->setCellValue('B23', 'Những người hoạt động không chuyên trách');
$activeSheet->mergeCells('B23:C23');

$activeSheet->setCellValue('A24', '');
$activeSheet->setCellValue('B24', 'Cộng');
$activeSheet->mergeCells('B24:C24');

$activeSheet->setCellValue('B25', 'Kinh phí sử dụng cho công tác ĐT,BD cán bộ, công chức ở trong nước năm 2014 (ĐVT: triệu đồng) ……………………………………');
$activeSheet->mergeCells('B25:S25');
$activeSheet->setCellValue('B26', 'Trong đó: Ngân sách TW: ……………………………..;');
$activeSheet->mergeCells('B26:F26');
$activeSheet->setCellValue('H26', 'Trong đó: Ngân sách ĐP: ……………………………..;');
$activeSheet->mergeCells('H26:L26');
$activeSheet->setCellValue('N26', 'Trong đó: Nguồn khác: ……………………………..;');
$activeSheet->mergeCells('N26:R26');
$activeSheet->setCellValue('C27', 'Người lập biểu');
$activeSheet->mergeCells('C27:D27');
$activeSheet->getStyle('C27:D27')->applyFromArray($bold);
$activeSheet->getStyle('B24:C24')->applyFromArray($bold);
$activeSheet->getStyle('A4:AA4')->applyFromArray($bold);
$json= $this->json;

for($i=1; $i<=count($json);$i++){
	$activeSheet->setCellValue('D'.($i+7), $json[$i]->cunhan_ctri);
	$activeSheet->setCellValue('E'.($i+7), $json[$i]->caocap_ctri);
	$activeSheet->setCellValue('F'.($i+7), $json[$i]->trungcap_ctri);
	$activeSheet->setCellValue('G'.($i+7), $json[$i]->socap_ctri);
	
	$activeSheet->setCellValue('H'.($i+7), $json[$i]->qlnn_cvcc);
	$activeSheet->setCellValue('I'.($i+7), $json[$i]->qlnn_cvc);
	$activeSheet->setCellValue('J'.($i+7), $json[$i]->qlnn_cv);
	$activeSheet->setCellValue('K'.($i+7), $json[$i]->qlnn_cansu);
	
	$activeSheet->setCellValue('L'.($i+7), $json[$i]->cm_tiensi);
	$activeSheet->setCellValue('M'.($i+7), $json[$i]->cm_thacsi);
	$activeSheet->setCellValue('N'.($i+7), $json[$i]->cm_daihoc);
	$activeSheet->setCellValue('O'.($i+7), $json[$i]->cm_caodang);
	$activeSheet->setCellValue('P'.($i+7), $json[$i]->cm_trungcap);
	$activeSheet->setCellValue('Q'.($i+7), $json[$i]->cm_socap);
	
	$activeSheet->setCellValue('R'.($i+7), $json[$i]->chuyenmon);
	$activeSheet->setCellValue('S'.($i+7), $json[$i]->quanly);
	$activeSheet->setCellValue('T'.($i+7), $json[$i]->tiengdantoc);
	$activeSheet->setCellValue('U'.($i+7), $json[$i]->khac);
	
	$activeSheet->setCellValue('V'.($i+7), $json[$i]->qphong_tong);
	$activeSheet->setCellValue('W'.($i+7), $json[$i]->tong_ngoaingu);
	$activeSheet->setCellValue('X'.($i+7), $json[$i]->tong_tinhoc);
	
	$activeSheet->setCellValue('Y'.($i+7), $json[$i]->tongso);
	$activeSheet->setCellValue('Z'.($i+7), $json[$i]->thieuso);
	$activeSheet->setCellValue('AA'.($i+7), $json[$i]->nu);
}
/**
 * start export
*/
ob_end_clean();
$excelFileName = 'Bcdaotaoboiduong';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $excelFileName .'.xlsx"');
header('Cache-Control: max-age=1');
header ('Expires: 23 Apr 2015 05:00:00 GMT');
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header ('Cache-Control: cache, must-revalidate');
header ('Pragma: public');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
exit();
?>