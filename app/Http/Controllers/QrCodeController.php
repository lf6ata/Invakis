<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
// use Endroid\QrCode\Factory\QrCodeFactory;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeController extends Controller
{

    public function index(){
        return view('fiture.scan_qrcode.scan');
    }

    // public function generate()
    // {
    //     $qrCode = QrCode::create('');
    //     $writer = new PngWriter();
    //     $result = $writer->write($qrCode);

    //     // dd($result->getString());
    //     return response($result->getString(), 200)
    //         ->header('Content-Type', 'image/png');
    // }
}
