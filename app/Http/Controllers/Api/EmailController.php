<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\PrestataireDemandeMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function envoyerDemande(Request $request)
    {
    try {
        $data = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        Mail::to($data['to'])->send(new PrestataireDemandeMail($data['subject'], $data['message'], $data['prestataire']));

        return response()->json(['message' => 'Email sent successfully!'], 200);
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Email sending error: ' . $e->getMessage());

        return response()->json(['error' => 'Failed to send email.'], 500);
    }
}}