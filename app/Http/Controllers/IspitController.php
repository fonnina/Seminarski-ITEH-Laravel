<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IspitController extends Controller
{

    public function ispiti()
    {
        $ispiti = DB::table('ispiti')->get();

        return response()->json([
            'ispiti' => $ispiti
        ]);
    }
}
