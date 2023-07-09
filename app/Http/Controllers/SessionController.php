<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function storeDataInSession(Request $request)
    {
        $data = $request->input('data');
        Session::put('pdfData', $data);

        return response()->json(['message' => 'Data stored in session successfully']);
    }

    public function deleteSessionData() {
        Session::forget(['pdfFileName', 'pdfData']);
        return response()->json(['message' => 'Data removed from session successfully']);
    }

    public function getRegexApiUrl(){
        $api = env('REGEX_API');
        return response()->json(['api' => $api]);
    }
    public function getOCRApiUrl(){
        $api = env('OCR_API');
        return response()->json(['api' => $api]);
    }
    public function getDLApiUrl(){
        $api = env('DL_API');
        return response()->json(['api' => $api]);
    }
}