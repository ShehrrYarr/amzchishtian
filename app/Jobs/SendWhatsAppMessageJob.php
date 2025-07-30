<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWhatsAppMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $number, $message, $media_url, $filename;

    public function __construct($number, $message, $media_url = null, $filename = null)
    {
        $this->number = $number;
        $this->message = $message;
        $this->media_url = $media_url;
        $this->filename = $filename;
    }

    // public function handle()
    // {

        
    //     $client = new \GuzzleHttp\Client();
    //     $url = "https://wa980.50015001.xyz/api/send";

    //     // Choose type: media if media_url+filename given, otherwise text
    //     if ($this->media_url && $this->filename) {
    //         $params = [
    //             'number'       => preg_replace('/\D/', '', $this->number),
    //             'type'         => 'media',
    //             'message'      => $this->message,
    //             'media_url'    => $this->media_url,
    //             'filename'     => $this->filename,
    //             'instance_id'  => env('WA_INSTANCE_ID', '6860FBD0A05BE'),
    //             'access_token' => env('WA_ACCESS_TOKEN', '6860cd24517cb'),
    //         ];
    //     } else {
    //         $params = [
    //             'number'       => preg_replace('/\D/', '', $this->number),
    //             'type'         => 'text',
    //             'message'      => $this->message,
    //             'instance_id'  => env('WA_INSTANCE_ID', '6860FBD0A05BE'),
    //             'access_token' => env('WA_ACCESS_TOKEN', '6860cd24517cb'),
    //         ];
    //     }

    //     try {
    //         $response = $client->get($url, ['query' => $params, 'timeout' => 20]);
    //         $body = $response->getBody()->getContents();
    //         \Log::info('WhatsApp API result: ' . $body);
    //     } catch (\Exception $e) {
    //         \Log::error('WhatsApp send error: '.$e->getMessage());
    //     }
    // }

    public function handle()
{
    $url = "https://wa980.50015001.xyz/api/send";
    $params = [
        'number'       => preg_replace('/\D/', '', $this->number),
        'message'      => $this->message,
        'instance_id'  => env('WA_INSTANCE_ID', '6860FBD0A05BE'),
        'access_token' => env('WA_ACCESS_TOKEN', '6860cd24517cb'),
    ];

    if ($this->media_url && $this->filename) {
        $params['type'] = 'media';
        $params['media_url'] = $this->media_url;
        $params['filename'] = $this->filename;
    } else {
        $params['type'] = 'text';
    }

    $client = new \GuzzleHttp\Client();
    try {
        $client->get($url, ['query' => $params, 'timeout' => 20]);
    } catch (\Exception $e) {
        \Log::error('WhatsApp send error: '.$e->getMessage());
    }
}

}