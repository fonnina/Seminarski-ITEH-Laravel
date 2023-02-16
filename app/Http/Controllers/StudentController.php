<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function sviStudenti()
    {
        $studenti = User::where('admin', '=', 0)->get();

        return response()->json([
            'studenti' => $studenti,
        ]);
    }
}
