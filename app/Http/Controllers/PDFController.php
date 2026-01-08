<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Patient;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    //
    public function generatePDF(){

        $dompdf = new Dompdf();
        $patients = Patient::with('rendezVous','docteurs')->get();
        $dompdf->setPaper('A4', 'landscape');
        $data = [
            'patients' => $patients
        ];
        $pdf = PDF::loadView('listPatients',$data);
        return $pdf->download('listPatients.pdf');

    }

}
