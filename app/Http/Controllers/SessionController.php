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
}