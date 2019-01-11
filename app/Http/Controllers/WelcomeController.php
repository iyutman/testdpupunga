<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        //
    }
     */
    
    public function postConvertString (Request $request)
    {
        $data = $this->wordsToNumber( $request->input );
        return $data;
    }

    private function wordsToNumber($data) {

            $data = strtr(
                $data,[
                    "se" => '1',
                    "satu" => '1',
                    "dua" => '2',
                    "tiga" => '3',
                    "empat" => '4',
                    "lima" => '5',
                    "enam" => '6',
                    "tujuh" => '7',
                    "delapan" => '8',
                    "sembilan" => '9',
                    "belas" => 'pw-10-1',
                    "puluh" => 'pw-10-2',
                    "ratus" => 'pw-100-3',
                    "ribu" => 'pw-1000-4',
                    "juta" => 'pw-1000000-5',
                    "miliar" => 'pw-1000000000-6',
                    "sepuluh" => '10',
                    "seratus" => '100',
                    "seribu" => '1000',
                    "sejuta" => '1000000',
                    "semiliar" => '1000000000',
                ]
            );

            $data = collect( explode(' ', $data) );            
            $no = 1; $sum = 0; $flag_pw = 0; $temp_val = 0;$temp_lvl = 9;$check_ribu = 0;
            foreach ($data as $key => $value) {
                
                if( strpos( $value, 'pw') !== false){
                    $value_pw_pre = explode('-', $value);
                    $value_pw = $value_pw_pre[1];

                    if($check_ribu == 1 && $value_pw_pre[2] >= 4){
                        $sum = 0;
                        break;
                    }

                    $check_ribu = ($value_pw_pre[2] == 4) ? 1 : $check_ribu;
                    if($value_pw_pre[2] == $temp_lvl){
                        $sum = 0;
                        break;
                    } else if($value_pw_pre[2] == 1){
                        $sum = $sum - $temp_val + ( $temp_val + $value_pw ) ;
                    } elseif($temp_lvl > $value_pw_pre[2]){
                        // dump($temp_lvl .'#'. $sum .'-'. $temp_val .' + ( '. $temp_val .' * '. $value_pw .')');
                        $sum = $sum - $temp_val + ( $temp_val * $value_pw ) ;
                    } else {
                        // dump($temp_lvl .'# '.$value_pw_pre[2].' #'. $sum .'*='. $value_pw);
                        if($temp_lvl < 4 && $value_pw_pre[2] > 3){
                            $sum *= $value_pw;
                        }else {
                            $sum = 0;
                            break;
                        }
                    }

                    $flag_pw = 1;
                    $temp_lvl = $value_pw_pre[2];
                } else {
                    // dump($sum.' += '.$value);
                        $sum += $value;
                    $flag_pw = 0;
                }
                $temp_val = $value;
                // dump('______ '.$sum.' ______');
            }
            if($sum == 0){
                $sum = 'invalid';
            } else {
                $sum = number_format($sum);
            }
            return $sum;
        }
}
