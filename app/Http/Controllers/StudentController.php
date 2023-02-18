<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function sviStudenti()
    {
        $studenti = User::where('admin', '=', 0)->get();

        return response()->json([
            'studenti' => $studenti,
        ]);
    }


    public function studentiUplate()
    {
        $studenti = DB::table('users')
            ->leftJoin('uplate', 'uplate.student_id', '=', 'users.id')
            ->where('budzet', '=', 0)
            ->get();

        return response()->json([
            'studenti' => $studenti,
        ]);
    }


    public function promeniStatusUplate(Request $request)
    {
        $korisnicko_ime = $request->get('korisnicko_ime');

        $student = DB::table('users')
            ->where('korisnicko_ime', '=', $korisnicko_ime)
            ->first();

        $skolarina = DB::table('skolarine')
            ->where('godina', '=', $student->godina)
            ->first();

        DB::table('users')
            ->where('korisnicko_ime', '=', $korisnicko_ime)
            ->update([
                'uplata_skolarine' => 'da'
            ]);

        DB::table('uplate')->insert([
            'student_id' => $student->id,
            'skolarina_id' => $skolarina->id,
            'datum' => date('Y-m-d')
        ]);

        return response()->json([
            'message' => 'Uspešna promena statusa uplate školarine',
        ]);
    }

    public function obrisiStudenta($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return response()->json([
            'message' => 'Student uspešno obrisan'
        ]);
    }


    public function sacuvajStudenta(Request $request)
    {
        DB::table('users')->insert([
            'ime_prezime' => $request->get('ime_prezime'),
            'email' => $request->get('email'),
            'korisnicko_ime' => $request->get('korisnicko_ime'),
            'lozinka' => $request->get('lozinka'),
            'budzet' => $request->get('budzet'),
            'uplata_skolarine' => $request->get('uplata_skolarine'),
            'godina' => $request->get('godina'),
            'prosek' => $request->get('prosek'),
            'admin' => $request->get('admin'),
        ]);

        return response()->json([
            'message' => 'Student uspešno sačuvan'
        ]);
    }
}
