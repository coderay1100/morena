<?php
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
/**
* Description of PDF
*
* @author Maman
*/
class Pdf extends fpdf
	{
		//Page header
		function Header()
			{
				//Logo
				$this->Image('images/logo-morena.gif',8,3,60,17); 
				$this->SetFont('Arial','B',15);

			}
			
		//Page footer
	public	function Footer()
			{
			
			}
			
		function hex2dec($color = "#000000"){
		$tbl_color = array();
		$tbl_color['R']=hexdec(substr($color, 1, 2));
		$tbl_color['G']=hexdec(substr($color, 3, 2));
		$tbl_color['B']=hexdec(substr($color, 5, 2));
		return $tbl_color;
	}
	
	function px2mm($px)
		{
			return $px*25.4/72;
		}
		
	function txtentities($html)
		{
			$trans = get_html_translation_table(HTML_ENTITIES);
			$trans = array_flip($trans);
			return strtr($html, $trans);
		}
		
	var $B;
	var $I;
	var $U;
	var $HREF;
	var $fontList;
	var $issetfont;
	var $issetcolor;
	
	function PDF_HTML($orientation='L', $unit='mm', $format='A4')
		{
			//Call parent constructor
			$this->fpdf($orientation,$unit,$format);
			//Initialization
			$this->B=0;
			$this->I=0;
			$this->U=0;
			$this->HREF='';
			$this->fontlist=array('arial', 'times', 'courier', 'helvetica', 'symbol');
			$this->issetfont=false;
			$this->issetcolor=false;
		}
		
	function WriteHTML($html) //utk menulis isi surat
		{
			//HTML parser
			$html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote>"); //supprime tous les tags sauf ceux reconnus
			$html=str_replace("\n",' ',$html); //remplace retour à la ligne par un espace
			$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //éclate la chaîne avec les balises
			foreach($a as $i=>$e)
				{
					if($i%2==0)
						{
							//Text
							if($this->HREF)
							$this->PutLink($this->HREF,$e);
							else
							$this->Write(5,stripslashes($e));
							// $this->Write(5,stripslashes(txtentities($e)));
						}
					else
						{
							//Tag
							if($e[0]=='/')
							$this->CloseTag(strtoupper(substr($e,1)));
							else
								{
									//Extract attributes
									$a2=explode(' ',$e);
									$tag=strtoupper(array_shift($a2));
									$attr=array();
									foreach($a2 as $v)
										{
											if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
											$attr[strtoupper($a3[1])]=$a3[2];
										}
									$this->OpenTag($tag,$attr);
								}
						}
				}
		}
		
	function OpenTag($tag, $attr)
		{
			//Opening tag
			switch($tag)
				{
					case 'STRONG':
					$this->SetStyle('B',true);
					break;
					case 'EM':
					$this->SetStyle('I',true);
					break;
					case 'B':
					case 'I':
					case 'U':
					$this->SetStyle($tag,true);
					break;
					case 'A':
					$this->HREF=$attr['HREF'];
					break;
					case 'IMG':
					if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT'])))
						{
							if(!isset($attr['WIDTH']))
							$attr['WIDTH'] = 0;
							if(!isset($attr['HEIGHT']))
							$attr['HEIGHT'] = 0;
							$this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
						}
					break;
					case 'TR':
					case 'BLOCKQUOTE':
					case 'BR':
					$this->Ln(5);
					break;
					case 'P':
					$this->Ln(10);
					break;
					case 'FONT':
					if (isset($attr['COLOR']) && $attr['COLOR']!='')
						{
							$coul=hex2dec($attr['COLOR']);
							$this->SetTextColor($coul['R'],$coul['V'],$coul['B']);
							$this->issetcolor=true;
						}
					if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist))
						{
							$this->SetFont(strtolower($attr['FACE']));
							$this->issetfont=true;
						}
					break;
				}
		}
		
	function CloseTag($tag)
		{
			//Closing tag
			if($tag=='STRONG')
			$tag='B';
			if($tag=='EM')
			$tag='I';
			if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
			if($tag=='A')
			$this->HREF='';
			if($tag=='FONT')
				{
					if ($this->issetcolor==true)
						{
							$this->SetTextColor(0);
						}
					if ($this->issetfont)
						{
							$this->SetFont('arial');
							$this->issetfont=false;
						}
				}
		}
		
	function SetStyle($tag, $enable)
		{
			//Modify style and select corresponding font
			$this->$tag+=($enable ? 1 : -1);
			$style='';
			foreach(array('B','I','U') as $s)
				{
					if($this->$s>0)
					$style.=$s;
				}
			$this->SetFont('',$style);
		}
		
	function PutLink($URL, $txt)
		{
			//Put a hyperlink
			$this->SetTextColor(0,0,255);
			$this->SetStyle('U',true);
			$this->Write(5,$txt,$URL);
			$this->SetStyle('U',false);
			$this->SetTextColor(0);
		}
/*inti utk buat surat..bisa juga buat fungsi lain dibawahnya misalnya myInvoice, myRepot dengan varibel yg lain lagi..
*/



	public function mySurat($firstName,$lastName, $position, $department, $location, $class, $marriageStatus, $No_Slipgaji, $year,$month, $NIP, $workdays, $grossSalary, $fixAllowance, $Pulse, $medicalAllowance, $overtime, $Bonus,	$thr, $correctionPlus, $incentive, $jobAllowance, $marriageAllowance, $houseAllowance, $maternityAllowance, $glassesAllowance, $condolanceAllowance, $separationPay, $OPEX, $COC, $pph21, $bpjs, $benefitMin, $copAllowanceMin, $Koperasi, $MCS, $loan)
		{
			
		$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F'); // March
		$tgl=$monthName.' '.$year;
		
		$Total_Pinjaman=($Koperasi+$MCS+$loan);
		$Total_Pengurang=($Total_Pinjaman+$pph21+$bpjs+$benefitMin+$copAllowanceMin);

		$Total_Pendapatan_Kotor=($grossSalary+$fixAllowance+$Pulse+$medicalAllowance+$overtime+$Bonus+$thr+$correctionPlus+$incentive+$jobAllowance+$marriageAllowance+$houseAllowance+$maternityAllowance+$glassesAllowance+$condolanceAllowance+$separationPay+$COC+$OPEX);
		
		$Total_Gaji=($Total_Pendapatan_Kotor-$Total_Pengurang);
		
			//Jakarta, DD Bulan Tahun No.xxx/Kode/Bulan/Tahun
			$this->SetFont('TIMES','BI',18); //remove bold
			$this->Ln(12);
			$this->SetX(7);
			$this->SetLeftMargin(5);
			$this->Cell(0,30,"PT. MANDIRI CIPTA SEJAHTERA",0,0,'L');
			
			$this->SetY(15);
			$this->SetFont('ARIAL','',10); //remove bold

			$this->SetX(2);
			$this->SetLeftMargin(138);
			$this->Cell(21,7,"Name          : ",0,0,'L');
			$this->MultiCell(48,7,$firstName.' '.$lastName,0 ,'L');


			$this->SetY(29);
			$this->SetLeftMargin(109);
			$this->Cell(65, 7, "Period         : ".$tgl, 0,0,'L');
			
			$this->SetY(36);
			$this->SetLeftMargin(138);
			$this->Cell(65, 7, "Work Days  : ".$workdays." days", 0,0,'L');


			$this->SetX(0);
			$this->SetY(15);
			$this->SetLeftMargin(210);
			$this->Cell(65,7,"Position             :  ".$position,0,0,'L');
			
			$this->SetX(227);
			$this->Ln(7);
			$this->Cell(24,7,"Department       :  ".$department,0,0,'L');
			
			$this->SetX(227);
			$this->Ln(7);
			$this->Cell(24,7,"Location            :  ".$location,0,0,'L');
			
			$this->SetX(227);
	
			$this->Ln(7);
			$this->Cell(24,7,"Class                 :  ".$class,0,0,'L');


			
			$this->SetX(227);		
			$this->Ln(7);
			$this->Cell(65,7,"Marriage State  :  ".$marriageStatus,0,0,'L');
		


			
			//Penerima Surat
			$this->Ln(7);
			$this->SetX(30);
			$this->SetLeftMargin(30);
			$this->WriteHTML('',0);
			//Judul Surat
			$this->Ln(-3);
			$this->SetY(48);
			$this->SetX(10);
			$this->SetFont('ARIAL','B',10);
			$this->Cell(0,10,"PROOF OF PAYMENT OF SALARIES",0,0,'C');
		
			$this->Line(0,60,300,60);
			$this->Line(0,59,300,59);
		//	$this->Line(102,206,139,206);
		//	$this->Line(102,207,139,207);
			$this->Line(102,188,139,188);
			$this->Line(255,119,290,119);
			//$this->Line(102,194,139,194);
			$this->Line(102,200,139,200);
			$this->Line(255,125,290,125);
			$this->Line(255,137,290,137);
			$this->Line(255,133,290,138);
			$this->Line(6,68,139,68);
			
			$this->SetFont('ARIAL','',12); //remove bold
			//Isi surat
			$this->Ln(30);
			$this->SetLeftMargin(5);
			$this->SetRightMargin(5);
			$y = $this->GetY();
			$start_y = $y - 9;
			$this->SetY($start_y);
			$this->WriteHTML("",0);
			$this->WriteHTML("");
			
			$this->Ln(0);
			$this->SetX(6);
			$this->SetY(62);
			$this->SetFont('ARIAL','',11);
			$this->Cell(133,6,"Income",0,0,'L');
			
			$this->Cell(22,6,"",0,0,'L');
			$this->Cell(10,6,"Outcome",0,30,'L');
			$this->Ln(0);
			$this->SetX(5);
			$this->Cell(42,6,"Gross Salary",0,0,'L');
			$this->Cell(52,6,"",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($grossSalary,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Line(161,68,290,68);
			$this->Cell(91,6,"Job Allowance",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($jobAllowance,0,',','.').',00'),0,0,'R');
	
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Fix Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($fixAllowance,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"BPJS",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($bpjs,0,',','.').',00'),0,0,'R');
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Pulse",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($Pulse,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"Benefit (-)",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($benefitMin,0,',','.').',00'),0,0,'R');
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Overtime",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($overtime,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"COP Allowance (-)",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($copAllowanceMin,0,',','.').',00'),0,0,'R');
		/*	
			$this->SetFont('ARIAL','B',11);
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"",0,0,'L');
			$this->Cell(5,6,"",0,0,'L');
			$this->Cell(35,6,"",0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"Pinjaman  ;",0,0,'L');
			$this->SetFont('ARIAL','',11);
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
		*/	
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Bonus",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($Bonus,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"- Koperasi",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($Koperasi,0,',','.').',00'),0,0,'R');
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"THR",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($thr,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"- MCS",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($MCS,0,',','.').',00'),0,0,'R');
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Correction (+)",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($correctionPlus,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"- Loan",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($loan,0,',','.').',00'),0,0,'R');
			
		/*	if($Jabatan=='Direktur')
			
			{
		*/	
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Incentive",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($incentive,0,',','.').',00'),0,0,'R');
		/*	
			}
			
			else
			
			{
		*/	
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Job Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($jobAllowance,0,',','.').',00'),0,0,'R');
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"House Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($houseAllowance,0,',','.').',00'),0,0,'R');
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Separation Pay",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($separationPay,0,',','.').',00'),0,0,'R');
		/*	
			}
		
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"Total ",0,0,'L');
			$this->Cell(10,7,": Rp.",0,0,'L');
			$this->Cell(28,7,(number_format($Total_Pinjaman,0,',','.').',00'),0,0,'R');
		*/	
		
			$this->SetFont('ARIAL','B',11);
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Benefit (+)",0,0,'L');
			$this->Cell(5,6,"",0,0,'L');
			$this->Cell(35,6,"",0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
			$this->SetFont('ARIAL','',11); //remove bold
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(47,6,"",0,0,'L');
			$this->Cell(46,6,"Medical Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($medicalAllowance,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"Sub Total Pengurang",0,0,'L');
			$this->Cell(10,6,": Rp.",0,0,'L');
			$this->Cell(28,6,(number_format($Total_Pengurang,0,',','.').',00'),0,0,'R');
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(47,6,"",0,0,'L');
			$this->Cell(46,6,"Marriage Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($marriageAllowance,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
		/*	
			if($Jabatan=='Direktur')
			
			{
		*/	
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(47,6,"",0,0,'L');
			$this->Cell(46,6,"Maternity Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($maternityAllowance,0,',','.').',00'),0,0,'R');
		/*	
			}
			
			else
			
			{
		*/	
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(46,6,"",0,0,'L');
			$this->Cell(47,6,"Glasses Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($glassesAllowance,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
			
		//	}
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(46,6,"",0,0,'L');
			$this->Cell(47,6,"Condolance Allowance",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($condolanceAllowance,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
/*
			if($Jabatan=='Direktur')
			
			{
	
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"",0,0,'L');
			$this->Cell(5,6,"",0,0,'L');
			$this->Cell(35,6,"",0,0,'R');
	
			}
			
			else
			
			{
	*/		$this->SetFont('ARIAL','B',11);
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"COP Allowance (+)",0,0,'L');
			$this->Cell(5,6,"",0,0,'L');
			$this->Cell(35,6,"",0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
			$this->SetFont('ARIAL','',11);
	//		}
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(46,6,"",0,0,'L');

			$this->Cell(47,6,"OPEX",0,0,'L');
			$this->Cell(5,6,"",0,0,'L');
			$this->Cell(35,6,(number_format($OPEX,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(46,6,"",0,0,'L');

			$this->Cell(47,6,"COC",0,0,'L');
			$this->Cell(5,6,"",0,0,'L');
			$this->Cell(35,6,(number_format($COC,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
$this->SetAutoPageBreak(true);			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"Total Gross Salary",0,0,'L');
			$this->Cell(52,6,"",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($Total_Pendapatan_Kotor,0,',','.').',00'),0,0,'R');
			$this->Cell(2,6,"",0,0,'R');
			$this->Cell(80,6,"Penerima",0,0,'C');
			$this->SetFont('ARIAL','BU',11);
			$this->Cell(60,6,"HRD Departemen",0,0,'C');
			$this->SetFont('ARIAL','',11);
			$this->Cell(28,6,"",0,0,'L');
			
			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"Subtrahend",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($Total_Pengurang,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');

			$this->Ln(6);
			$this->SetX(6);
			$this->Cell(41,6,"Total Gaji Bulan Ini",0,0,'L');
			$this->Cell(52,6,"",0,0,'L');
			$this->Cell(5,6,": Rp.",0,0,'L');
			$this->Cell(35,6,(number_format($Total_Gaji,0,',','.').',00'),0,0,'R');
			$this->Cell(22,6,"",0,0,'R');
			$this->Cell(91,6,"",0,0,'L');
			$this->Cell(10,6,"",0,0,'L');
			$this->Cell(28,6,"",0,0,'L');
	
		//	$this->Ln(6);
			$this->SetY(6);
			$this->Cell(41,6,"",0,0,'L');
			$this->Cell(52,6,"",0,0,'L');
			$this->Cell(5,6,"",0,0,'L');
			$this->Cell(35,6,"",0,0,'R');
			$this->Cell(2,6,"",0,0,'R');
			$this->SetFont('COURIER','B',11);
			$this->Cell(80,6,"("."Nama".")",0,0,'C');
			$this->Cell(4,6,"",0,0,'L');
			$this->Cell(52,6,"(".")",0,0,'C');
			
		}
	}