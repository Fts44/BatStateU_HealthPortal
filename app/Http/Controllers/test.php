<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use storage;

class test extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf();
    }

    public function index() 
    {
        $fpdf = $this->fpdf;
        
        $fpdf->AddPage('P','A4');
        $fpdf->SetFont('Times', '', 10);

        $fpdf->Cell(25,18,'',1,0,'C');
        $fpdf->Cell(75,18,'Reference No. BatStateU',1,0,'C');
        $fpdf->Cell(60,18,'Effectivity Date: April 26, 2019',1,0,'C');
        $fpdf->Cell(30,18,'Revision No.1',1,1,'C');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->Cell(80,8,'Title','LBT',0,'L');
        $fpdf->Cell(110,8,'Student Health Record','RBT',1,'L');

        $fpdf->SetFont('Times', '', 10);
        $fpdf->Cell(72,10,'Date of Medical Examination: '.'January 09,2000','LB',0,'L');
        $fpdf->Cell(35,10,'SR-Code: '.'19-78604','B',0,'L');
        $fpdf->Cell(83,10,'Program:'.'BS Information Technology','RB',1,'L');

        $fpdf->Cell(140, 50, '', 'BLR', 0, 'L');
        $fpdf->Cell(50, 50, '', 'BR', 1,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(50,5,'LASTNAME','L',0,'L');
        $fpdf->cell(50,5,'FIRSTNAME',0,0,'L');
        $fpdf->cell(90,5,'MIDDLENAME','R',1,'L');

        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(50,5,'CALMA','L',0,'L');
        $fpdf->cell(50,5,'JOSEPH',0,0,'L');
        $fpdf->cell(90,5,'ERMITA','R',1,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(32,5,'HOME ADDRESS:','L',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(158,5,'LUMBANGAN, TUY, BATANGAS','R',1,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(43,5,'DORMITORY ADDRESS:','L',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(147,5,'LUMBANGAN, TUY, BATANGAS','R',1,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(9,5,'SEX:','L',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(16,5,'FEMALE','',0,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(9,5,'AGE:','',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(8,5,'20','',0,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(16,5,'STATUS:','',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(20,5,'WIDOWED','',0,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(21,5,'RELIGION:','',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(45,5,'Roman Catholic','',0,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(23,5,'CONTACT #:','',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(23,5,'09067165785','R',1,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(31,5,'DATE OF BIRTH:','LB',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(47,5,'January 06, 2001','B',0,'L');

        $fpdf->SetFont('Times', 'B', 10);
        $fpdf->cell(33,5,'PLACE OF BIRTH:','B',0,'L');
        $fpdf->SetFont('Times', '', 10);
        $fpdf->cell(79,5,'PLACE OF BIRTH:','BR',0,'L');

        $fpdf->Output();

        exit;
    }
}
