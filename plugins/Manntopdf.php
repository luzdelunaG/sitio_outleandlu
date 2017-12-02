<?php
namespace Plugins;
use Core\plugins;
use Core\Config;

include("Fpdf.php");
class Manntopdf extends \Fpdf {
	var $header_data = [];

	function Header(){
		global $header_data;
		$this->SetFont('Arial','B',11);
		$this->SetMargins(10, 10,10);
		$this->Image('templates//mifactura/fileimages/4logo.png' , 16,13,30  );

		if($this->header_data["img"]!=""){
						 $this->Image("fileimages".DS."voluntarios".DS.$this->header_data["img"] , 140,14,50,40 );
						 $nx=$nx+60;
	}
		$y = $this->GetY();
		$this->Cell(185,15, utf8_decode("Fundación Esperanza Contigo, A.C.") ,"",0,'C');
		$this->Ln();

		$this->SetFont('Arial','B',10);
		$this->Sety($y+12);
		$this->MultiCell(185, 9 , "Voluntario", "",'C');


	}


	function crearReporte($Datos){
		$this->SetFont('Arial','B',9);

		$y = $this->GetY();
		$this->SetX(9);
		$this->Ln();
		$this->Cell(40, 10, "Fecha De Nacimiento:", 0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(28, 10 ,date("d-m-Y",strtotime($Datos["fecha"])), 0,0,'L');
		$this->SetFont('Arial','B',9);

		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell(85, 9 , utf8_decode("Información Personal del Voluntario") ,"B",0,'L');
		$this->Cell(12, 9 , "" ,"",0,'C');
		$this->Cell(85, 9 , utf8_decode("") ,"B",0,'L');
		$this->Ln();
		$y = $this->GetY();
		$this->SetFont('Arial','B',8);
		$this->Cell(25, 7 , utf8_decode("Nombre:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["nombre"]) ,"",0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(25, 7 , utf8_decode("Apellido Paterno:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["apeidopat"]) ,"",0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(25, 7 , utf8_decode("Apellido Materno:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["apeidomat"]) ,"",0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Lugar de Nacimiento:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["lnacimiento"]) ,"",0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Lugar de Residencia:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["residencia"]) ,"",0,'L');
		$this->Ln();

		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Tiempo radicando en el lugar de residencia actual:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Ln();
		$this->Cell(73, 7 , utf8_decode($Datos["tiempoactual"]." años") ,"",0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Teléfono fijo:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["telefono"]) ,"",0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Teléfono celular:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["celular"]) ,"",0,'L');
		$this->Ln();


		$this->Sety($y);
		$this->Setx(107);
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Email:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["email"]) ,"",0,'L');
		$this->Ln();
		$this->Setx(107);
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Nivel estudios:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["nivel"]) ,"",0,'L');
		$this->Ln();
		$this->Setx(107);
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Profesión:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(73, 7 , utf8_decode($Datos["profesion"]) ,"",0,'L');
		$this->Ln();
		$this->Setx(107);
		$this->SetFont('Arial','B',8);
		$this->Cell(29, 7 , utf8_decode("Tiempo (mensualmente) capaz de trabajar como voluntario:") ,"",0,'L');
		$this->SetFont('Arial','',8);
		$this->Ln();
			$this->Setx(107);
		$this->Cell(29, 7 , utf8_decode($Datos["tiempo"]) ,"",0,'L');
		$this->Ln();
		$this->Setx(107);
		$this->SetFont('Arial','B',8);
		$this->Cell(17, 7 , utf8_decode("Zona de la ciudad:") ,"",0,'L');
		$this->SetFont('Arial','',8);
			$this->Ln();
			$this->Setx(107);
		$this->Cell(73, 7 , utf8_decode($Datos["zona"]) ,"",0,'L');
		$this->Ln();
		$this->Setx(107);
		$this->SetFont('Arial','B',8);
		$this->Cell(17, 7 , utf8_decode("Tipo de actividades en las que se puede involucrar:") ,"",0,'L');
		$this->SetFont('Arial','',8);

			$acts= explode( '-', $Datos["actividades"] );
			foreach ($acts as $cv => &$value) {
				$this->Setx(107);
			$this->Cell(73, 7 , utf8_decode($value) ,"",0,'L');
			$this->Ln();
			}
			$this->Setx(107);

		$this->Setx(107);
		$this->SetFont('Arial','B',8);


		$this->Ln();
		$this->Ln();
		$this->SetFont('Arial','B',8);
		$this->MultiCell(185, 9 , utf8_decode("Motivación para ser Voluntario de F.E.C."), "B",'L');
		$this->SetFont('Arial','',8);

		$this->SetFont('Arial','',8);
		$this->MultiCell(185, 9 , utf8_decode($Datos["motivo"]), "B",'L');
		$this->SetFont('Arial','',8);

		$this->SetFont('Arial','B',8);
			$this->Ln();



	}

	function Footer(){
    	// Go to 1.5 cm from bottom
global $header_data;
			$this->SetY(-12);

    	// Select Arial italic 8
		$this->SetFont('Arial','B',9);
    	// Print centered page number

		$this->Cell(80,6,  utf8_decode("Fecha/hora de registro: ".$this->header_data["fregistro"]),"",0,'');
	}
}
?>
