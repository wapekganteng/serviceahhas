<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function pelaporan()
    {
        $pelaporan = DB::table('form_values')->where('form_id', 3)->get();

        $pelaporan->transform(function ($json) {
            $decodedJson = json_decode($json->json, true);
            $values = [];

            foreach ($decodedJson as $array) {
                foreach ($array as $formArray) {
                    if (isset($formArray['value'])) {
                        $values[] = $formArray['value'];
                    }
                }
            }
            $json->json = $values;
            return $json;
        });

        return response()->json(['data' => $pelaporan]);
    }
}
