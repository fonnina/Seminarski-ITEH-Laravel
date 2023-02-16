<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class APIAuthController extends Controller
{
    public function prijava(Request $request)
    {

        $user = User::where('korisnicko_ime', $request->get('korisnicko_ime'))->first();


        if (!$user) {
            return response()->json([
                'message' => 'Greška! Pokušajte ponovo',
            ]);
        } else {
            if ($user->lozinka == $request->get('lozinka'))
                return response()->json([
                    'message' => 'Uspešno ste se prijavili',
                    'admin' => $user->admin
                ]);
            else
                return response()->json([
                    'message' => 'Greška! Pokušajte ponovo',
                ]);
        }
    }
}
