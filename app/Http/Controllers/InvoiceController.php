<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;



class InvoiceController extends Controller
{
    public function invoice()
    {
        $pdf = PDF::loadView('invoice_pdf');
        return $pdf->download('techsolutiontuff.pdf');
        //$pdf = PDF::loadView('posts.show', compact('post'));
    }
}
