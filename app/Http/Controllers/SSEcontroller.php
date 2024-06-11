<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SSEcontroller extends Controller
{
    public function stream(Request $request)
    {

      $count =Cache::get('count');

        dd($count);

            // Send SSE headers
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');
            header('Connection: keep-alive');


            if($count > 0){
                // Send SSE data
                echo "data: " . json_encode($count) . "\n\n";
            }else{
                echo "data: " . json_encode(0) . "\n\n";
            }
                // Flush the output buffer
                ob_flush();
                flush();

                // Sleep for a short while to avoid CPU overload
                sleep(2);

    }

}
