<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DHLAddressController extends Controller
{
    public function transformAddress(Request $request)
    {
        /* assuming no data sanitizing needed */
        $addr1 = $request->input('address1');
        $addr2 = $request->input('address2');
        $addr3 = $request->input('address3');

        $addr = preg_replace('/\s+/', ' ', "$addr1 $addr2 $addr3");
        $addr = trim($addr);

        $words = explode(' ', $addr);
        $address = [
            'address1' => '',
            'address2' => '',
            'address3' => ''
        ];

        foreach (range(1, 3) as $i) {
            $this->generateAddressLine($words, $address["address$i"]);
            if (count(array_filter($words)) == 0)
                break;
        }

        if (count(array_filter($words)) > 0) {
            return response()->json([
                'status' => 'failed',
                'dhl_address' => '',
                'message' => 'Incoming address length exceed limit.',
            ], 400);
        }
        
        return response()->json([ 'status' => 'success', 'dhl_address' => json_encode($address), 'message' => 'Transformed to DHL compliance address.'], 200);
    }

    private static function generateAddressLine(&$words, &$str)
    {
        $str = $newStr = '';
        while (1) {
            $nextWord = array_shift($words);
            $newStr = trim($newStr . ' ' . $nextWord);

            if (strlen($newStr) > 30) {
                array_unshift($words, $nextWord);
                break;
            }

            $str = $newStr;

            if (count(array_filter($words)) == 0)
                break;
        }
    }

}
