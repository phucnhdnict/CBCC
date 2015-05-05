<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 */ 
?>
<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:42.0pt;
	font-size:14.0pt;
	font-family:"Times New Roman","serif";}
a:link, span.MsoHyperlink
	{color:blue;
	text-decoration:underline;}
a:visited, span.MsoHyperlinkFollowed
	{color:purple;
	text-decoration:underline;}
p.DefaultParagraphFontParaCharCharCharCharChar, li.DefaultParagraphFontParaCharCharCharCharChar, div.DefaultParagraphFontParaCharCharCharCharChar
	{mso-style-name:"Default Paragraph Font Para Char Char Char Char Char";
	margin-top:6.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:130%;
	font-size:13.0pt;
	font-family:"Arial","sans-serif";}
p.Char, li.Char, div.Char
	{mso-style-name:" Char";
	margin-top:6.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:130%;
	font-size:13.0pt;
	font-family:"Arial","sans-serif";}
 /* Page Definitions */
 @page WordSection1
	{size:21.0cm 842.0pt;
	margin:2.0cm 2.0cm 2.0cm 3.0cm;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>
</head>
<body lang=EN-US>
<div class=WordSection1>
<?php 
$data = $this->data;
$donvichuquan	=	$data->donvichuquan == null ? '......................':mb_strtoupper($data->donvichuquan);
$hoten					=	$data->hoten;
$gioitinh				=	$data->gioitinh == 'Nam' ? 'ông':'bà';
$loaihinh				=	$data->ins_loaihinh;
if ($loaihinh == 1){
	$congvienchuc = 'công chức';
	$cancu = 'Căn cứ Quyết định số 23/2013/QĐ-UBND ngày 09 tháng 10 năm 2013 của Ủy ban nhân dân thành phố Cần Thơ về việc ban hành Quy định phân cấp quản lý tổ chức, cán bộ, công chức thành phố Cần Thơ;';
}
elseif($loaihinh==2){
	$congvienchuc = 'viên chức';
	$cancu = 'Căn cứ Quyết định số 29/2013/QĐ-UBND ngày 20 tháng 12 năm 2013 của Ủy ban nhân dân thành phố Cần Thơ về việc ban hành Quy định về phân cấp quản lý viên chức;';
}
$congtac_donvi			=	$data->congtac_donvi ==null ? '...............':$data->congtac_donvi;
$donviup 						=	mb_strtoupper($congtac_donvi);
$luong_tenngach			=	$data->luong_tenngach;
$luong_mangach			=	$data->luong_mangach;
$luong_bac					=	$data->luong_bac_cu;
$thoidiemhuong				=	$data->thoidiemhuong;
$thoidiemhuong2			= explode("-", $thoidiemhuong);
$luong_ngayhuong        = 'ngày '.$thoidiemhuong2[2].' tháng '.$thoidiemhuong2[1].' năm '.$thoidiemhuong2[0];
$luong_heso_cu			=	$data->luong_heso_cu;
$luong_vuotkhung_cu	=	$data->luong_vuotkhung_cu;

$bac_moi						=	$data->bac_moi;
$heso_moi					=	$data->heso_moi;
$vk_moi						=	$data->vk_moi;
$ngayhuong_moi  	= 'ngày .... tháng .... năm ....';
$str="<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=634
 style='width:475.35pt;margin-left:5.4pt;border-collapse:collapse'>
 <tr><td colspan='2'>
 <table>
  <tr>
  <td colspan='3' style='width:35%'>
  <p class=MsoNormal align=center style='text-align:center'>$donvichuquan</p>
  </td>
  <td width=385 colspan='6' style='width:65%' valign=top>
  <p class=MsoNormal align=center style='text-align:center'><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></p>
  </td>
 </tr>
  <tr>
  <td width=249 valign=top  style='width:35%'  colspan='3'>
  <p class=MsoNormal align=center style='text-align:center'><b><span>$donviup</span></b></p>
  </td>
  <td width=385 valign=top colspan='6' style='width:65%'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.0pt'>Độc lập - tự do - Hạnh phúc</span></b></p>
  </td>
 </tr>
 <tr>
 <td style='width:10%'></td><td style='width:15%'><hr/></td><td style='width:10%'></td>
 <td colspan='6' style='width:65%'><hr style='width:180'/></td>
 </tr>
 </table>
 </td></tr>
 </tr>
 </table>
 <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=634 style='width:475.35pt;margin-left:5.4pt;border-collapse:collapse'>
 <tr>
  <td width=249 valign=top style='width:186.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Số: &nbsp;&nbsp;&nbsp;&nbsp;/QĐ-CQ,ĐV</p>
  </td>
  <td width=385 valign=top style='width:288.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><i>Cần Thơ,  ngày       tháng       năm 201…</i></p>
  </td>
 </tr>
 <tr>
  <td width=249 valign=top style='width:186.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoBodyTextIndent align=center style='margin-top:6.0pt;text-align:
  center;text-indent:0in;line-height:120%'><span style='font-size:9.0pt;
  line-height:120%'>&nbsp;</span></p>
  </td>
  <td width=385 valign=top style='width:288.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><i><span
  style='font-size:9.0pt'>&nbsp;</span></i></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='margin-top:6.0pt;text-align:center'><b><span
style='font-size:13.0pt'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-top:6.0pt;text-align:center'><b><span
style='font-size:13.0pt'>QUYẾT ĐỊNH</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:13.0pt'>Về việc nâng bậc lương  trước thời hạn đối với $congvienchuc</span></span></b></p>

<p class=MsoNormal align=center style='text-align:center'>

<table cellpadding=0 cellspacing=0 align=left>
 <tr>
  <td width=251 height=5></td>
 </tr>
 <tr>
  <td></td>
  <td><hr style='width=151'/></td>
 </tr>
</table>

<i><span style='font-size:13.0pt'>&nbsp;</span></i></p>

<br clear=ALL>

<p class=MsoNormal align=center style='margin-top:6.0pt;text-align:center'><b><span
style='font-size:13.0pt'>THỦ TRƯỞNG CƠ QUAN ĐƠN VỊ</span></b></p>

<p class=MsoNormal style='text-align:justify'><b><span style='font-size:13.0pt'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><b><span
style='font-size:13.0pt'></span></b><span style='font-size:13.0pt'>Căn cứ Nghị định số 204/2004/NĐ-CP ngày 14 tháng 12 năm 2004 của Chính phủ về chế độ tiền lương đối với cán bộ, công chức, viên chức và lực lượng vũ trang;</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'>Căn cứ Thông tư số 08/2013/TT-BNV ngày 31 tháng 7 năm 2013 của Bộ Nội vụ hướng dẫn thực hiện chế độ nâng bậc lương thường xuyên và nâng bậc lương trước thời hạn đối với cán bộ, công chức, viên chức và người lao động;</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'>$cancu</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'>Theo Công văn số       /SNV-TCCBCC ngày … tháng … năm … … của Sở Nội vụ về việc phê duyệt danh sách nâng lương trước hạn do lập thành tích xuất sắc trong thực hiện nhiệm vụ; </span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'>Xét đề nghị của ................................................................................,</span></span></p>

<p class=MsoNormal align=center style='margin-top:12.0pt;text-align:center;
line-height:150%'><b><span style='font-size:13.0pt;line-height:150%'>QUYẾT ĐỊNH:</span></b></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'><b>Điều 1. </b>Nâng bậc lương thường xuyên đối với $gioitinh $hoten</span></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0in;margin-bottom:0in;
margin-left:1.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in'><span
style='font-size:13.0pt'>-<span style='font:7.0pt Times New Roman'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:13.0pt'>Đơn vị:
$congtac_donvi</span></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0in;margin-bottom:0in;
margin-left:1.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in'><span
style='font-size:13.0pt'>-<span style='font:7.0pt Times New Roman'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:13.0pt'>Ngạch
lương: $luong_tenngach, mã ngạch ($luong_mangach)</span></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0in;margin-bottom:0in;
margin-left:1.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in'><span
style='font-size:13.0pt'>-<span style='font:7.0pt Times New Roman'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:13.0pt'>Từ bậc: $luong_bac, hệ số lương: $luong_heso_cu, từ $luong_ngayhuong</span></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0in;margin-bottom:0in;
margin-left:1.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in'><span
style='font-size:13.0pt'>-<span style='font:7.0pt Times New Roman'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:13.0pt'>Lên bậc: $bac_moi, hệ số lương: $heso_moi, từ $ngayhuong_moi</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><b><span
style='font-size:13.0pt'>Điều 2. </b><span style='font-size:
13.0pt'>.................................................................................., Th&#7911; tr&#432;&#7903;ng
c&#417; quan, &#273;&#417;n v&#7883; có liên quan và $gioitinh $hoten chịu trách nhiệm thi hành Quyết định này./.</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify;text-indent:.5in'><span
style='font-size:13.0pt'>&nbsp;</span></p>

<div align=center>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=615
 style='width:461.5pt;margin-left:-18.7pt;border-collapse:collapse'>
 <tr>
  <td width=320 valign=top style='width:240.1pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><i><span style='font-size:11.0pt'>N&#417;i nh&#7853;n:</span></i></b><b><i><br>
  </i></b><span style='font-size:10.0pt'>- Nh&#432; Điều 2;<br>
  - L&#432;u: VT.  </span></p>
  </td>
  <td width=295 valign=top style='width:221.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.0pt'>TH&#7910; TR&#431;&#7902;NG<br>
  <br>
  </span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><i><span
  style='font-size:13.0pt'>&nbsp;</span></i></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.0pt'></span></b></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal><span style='font-size:11.0pt'>&nbsp;</span></p>

</div>";
echo $str;
?>
</body>

</html>
