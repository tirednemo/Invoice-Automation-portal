<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UploadFileController extends Controller
{
    public function uploadPDF(Request $request)
    {
        $request->validate([
            'invoice' => 'required|mimes:pdf|max:2048',
        ], [
            'invoice.required' => 'The invoice file is required.',
            'invoice.mimes' => 'Only PDF files are allowed.',
            'invoice.max' => 'The invoice file size must not exceed 2MB.',
        ]);

        if ($request->file('invoice')->isValid()) {
            $pdfFile = $request->file('invoice');
            //$pdfFileName = $pdfFile->getClientOriginalName();
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();

            $storagePath = 'pdfs/';
            //$pdfFile->move($storagePath, $pdfFileName, );
            $pdfFile->storeAs($storagePath, $pdfFileName, 'external');

            Session::put('pdfFileName', $pdfFileName);

            return redirect()->back()->with('success', 'PDF file uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload PDF file.');
    }
}
