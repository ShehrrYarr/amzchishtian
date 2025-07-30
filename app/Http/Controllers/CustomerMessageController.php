<?php

namespace App\Http\Controllers;
use App\Models\CustomerInfo;
use App\Jobs\SendWhatsAppMessageJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerMessageController extends Controller
{
    public function showSendMessageForm(){

        return view('customerMessage.sendMessage');
    }

    public function sendMessageToAllCustomers(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB limit
        ]);
    
        $message = $request->input('message');
        $media_url = null;
        $filename = null;
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid('whatsapp_').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('whatsapp_uploads'), $filename);
            $media_url = url('whatsapp_uploads/' . $filename);
        }
    
        $mobiles = CustomerInfo::whereNotNull('mobile')
            ->where('mobile', '!=', '')
            ->distinct()
            ->pluck('mobile');
    
        $count = 0;
        foreach ($mobiles as $mobile) {
            if (preg_match('/\d{8,}/', $mobile)) {
                dispatch(new \App\Jobs\SendWhatsAppMessageJob(
                    $mobile, $message, $media_url, $filename
                ));
                $count++;
            }
        }
    
        return back()->with('success', "Message sent to $count customers!");
    }
    
}
