<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeController extends Controller
{
    public function generateBarcode($code)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($code, $generator::TYPE_CODE_128));

        return response()->json([
            'barcode' => 'data:image/png;base64,' . $barcode
        ]);
    }
}
