<?php
define ('FIRST_BG_IMAGE',FPDF_LIBPATH.'f112ep_1.png');

require(FPDF_LIBPATH.'ufpdf_my.php');

require_once (FPDF_LIBPATH.'nums.class.php');

class PDF_F112ep extends UFPDF_My {

	function PrintFirstPage($title) {
		//Выводим фон-форму
		$this->SetTitle($title);
		$this-> AddFont('TimesNewRomanPS-BoldItalicMT','','timesbi.php');
		$this-> AddFont('Tahoma','','Tahoma.php');
		$this-> AddFont('ArialMT','','arial.php');
		$this-> SetFont('ArialMT','',9);


		$this->AddPage('P');
		$this->Image(FIRST_BG_IMAGE,0,0,210,297);
	}

	function PrintSecondPage() {

	}

	function  PrintAddrPhone ($phone) {  // выводим телефон получателя
		$this->SetFont('Tahoma','',13);
		if (isset($phone)and(mb_strlen($phone, 'UTF-8')>=1)) {
			$i=0;
			while ($i<=(mb_strlen($phone, 'UTF-8')-1)){
				$this->SetXY(155+$i*3.75,68);
				$this->Cell(0,0,$phone[$i]);
				$i++;
			}
		}
	}

	function  PrintSenderPhone ($phone) {  // выводим телефон получателя
		$this->SetFont('Tahoma','',13);
		if (isset($phone)and(mb_strlen($phone, 'UTF-8')>=1)) {
			$i=0;
			while ($i<=(mb_strlen($phone, 'UTF-8')-1)){
				$this->SetXY(155+$i*3.75,62);
				$this->Cell(0,0,$phone[$i]);
				$i++;
			}
		}
	}
	
	function  PrintAddrIndex ($indx) {  // выводим индекс получателя
		$this->SetFont('Tahoma','',14);
		if (isset($indx)and(mb_strlen($indx, 'UTF-8')>=1)) {
			$i=0;
			while ($i<=(mb_strlen($indx, 'UTF-8')-1)){
				$this->SetXY(170+$i*3.9,142);
				$this->Cell(0,0,$indx[$i]);
				$i++;
			}
		}
	}

	function  PrintSenderIndex ($indx) { // выводим индекс отправителя
		$this->SetFont('Tahoma','',13);
		if (isset($indx)and(mb_strlen($indx, 'UTF-8')>=1)) {
			$i=0;
			while ($i<=(mb_strlen($indx, 'UTF-8')-1)){
				$this->SetXY(170+$i*3.8,90);
				$this->Cell(0,0,$indx[$i]);
				$i++;
			}
		}
	}

	function PrintNumSum ($val) { // выводим сумму числом
		if ($val == '') return;
		
		$val = floatval($val);
		$rub = floor($val).'';
		$kop = round($val*0 - floor($val)*0);
		$kop = ($kop == 0 ? '00' : $kop.'');

		$this->SetFont('ArialMT','',13);

		$this->SetXY(15,55);
		$this->Cell(17,3.7, $rub ,0,0,'C',0);
		$this->SetXY(40,57);
		$this->Cell(0,0, $kop);
	}

	//Ф.И.О. получателя
	function PrintAddrName ($name) {  // выводим имя адресата
		$this->SetFont('Tahoma','',12);
		$name_parts = $this->splitOnWords($name, array(30, 60));
		/*вывод названия или Ф.И.О.*/
		$this->SetXY(35,130,1);
		$this->MultiCell(0,0,$name,0,1,'L');
	}

	//Адрес и индекс получателя
	function PrintAddrAddress($address, $indx) { // выводим адрес адресата
		$this->SetFont('Tahoma','',11);
		$address_parts = $this->splitOnWords($address, array(45, 60, 50));
		/*вывод названия или Ф.И.О.*/
		$this->SetXY(50,136.2);
		$this->MultiCell(0,0,$address,0,1,'L');

	}

	function PrintSenderNameAddress ($name,$indx,$address){ // выводим иформацию о магазине
		$this->SetFont('Tahoma','',13);
		$name = rtrim ($name);

		$name_parts = $this->splitOnWords($name, array(70, 70));
		/*вывод названия или Ф.И.О.*/
		$this->SetXY(25,74.4);
		$this->MultiCell(0,0,$name,0,1,'L');


		/*вывод адреса*/
		$address = rtrim($indx .', '. $address);
		$address_parts = $this->splitOnWords($address, array(70, 70));
		$this->SetXY(8,81);
		$this->MultiCell(128.5,5.35,$address_parts[0],0,'L');

		$this->SetXY(59,79.2);
		$this->MultiCell(128.5,5.35,$address_parts[1],0,'L');
	}

	function PrintSenderBank ($inn,$name,$kor,$rs,$bik) {
		$this->SetAutoPageBreak(FALSE,1);
		$this->SetFont('Tahoma','',10);

		$this->SetXY(70,98.3);
		$this->MultiCell(129,5.1,$this->longify($name, 60),0,'L');

		if (isset($inn) && (mb_strlen($inn, 'UTF-8')>=1)){
			$i=0;
			while ($i<=(mb_strlen($inn, 'UTF-8')-1)){
				$this->SetXY(61.2+$i*3,96);
				$this->Cell(0,0,$inn[$i]);
				$i++;
			}
		}

		if (isset($kor) && (mb_strlen($kor, 'UTF-8')>=1)){
			$i=0;
			while ($i<=(mb_strlen($kor, 'UTF-8')-1)){
				$this->SetXY(213+$i*3,96);
				$this->Cell(0,0,$kor[$i]);
				$i++;
			}
		}

		if (isset($rs) && (mb_strlen($rs, 'UTF-8')>=1)){
			$i=0;
			while ($i<=(mb_strlen($rs, 'UTF-8')-1)){
				$this->SetXY(69.6+$i*2.99,106);
				$this->Cell(0,0,$rs[$i]);
				$i++;
			}
		}

		if (isset($bik) && (mb_strlen($bik, 'UTF-8')>=1)){
			$i=0;
			while ($i<=(mb_strlen($bik, 'UTF-8')-1)){
				$this->SetXY(245.8+$i*2.99,106);
				$this->Cell(0,0,$bik[$i]);
				$i++;
			}
		}
	}


	// выводим сумму прописью
	function PrintStrSum ($val) {
		if ($val == '') return;
		$this->SetFont('Tahoma','',12);
		
		$sum_parts = $this->splitOnWords(num2str($val), array(65, 1));
		$this->SetXY(56, 50);
		$this->Cell(110,5.9,$sum_parts[0],0,0,'C',0);
		$this->SetXY(56, 60);
		$this->Cell(110,5.9,$sum_parts[1],0,0,'C',0);
	}

	function PrindDocument($doc, $ser, $nomer, $vydan, $vydanday, $vydanyear) {
/*
		$this->SetFont('Tahoma','',9);
		//вывод в 1-ую строку
		$this->SetXY(40,114.8);
		$this->Cell(92,5.1,$doc,0,0,'L',0);
		
		$this->SetXY(70,114.8);
		$this->MultiCell(93,5.1,$ser,0,'L');
		$this->SetXY(86,114.8);
		$this->MultiCell(92,5.1,$nomer,0,'L');
		
		$this->SetXY(10,114.5);
		$this->MultiCell(92,5.1,$this->longify($vydanday,11),0,'L');
		$this->SetXY(30,114.4);
		$this->MultiCell(92,5.1,$vydanyear,0,'L');
		
		$this->SetXY(20,121.5);
		$this->MultiCell(92,5.1,$this->longify($vydan,80),0,'L');
*/
	}
	
	function PrintAddrName2nd ($name) {  // выводим имя адресата

	}

	function PrintAddrAddress2nd($address, $indx) { // выводим адрес адресата
		            }

	function PrintNumSum2nd ($val) { // выводим сумму числом
		}	
}
?>
