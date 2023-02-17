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

    function obrisiStudenta($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return response()->json([
            'message' => 'Student uspešno obrisan'
        ]);
    }
}
