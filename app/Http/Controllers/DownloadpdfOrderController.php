<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DownloadpdfOrderController extends Controller
{
    public function download(Order $record){
        dd($record);
    }
}
