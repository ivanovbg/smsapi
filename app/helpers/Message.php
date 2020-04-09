<?php
namespace App\Helpers;

class Message{

    static function count_ucs2_string($str){
        $utf16str = mb_convert_encoding($str, 'UTF-16', 'UTF-8');
        $byteArray = unpack('C*', $utf16str);
        return count($byteArray) / 2;
    }

    static function multipart_count($str){
        $one_part_limit = 160;
        $multi_limit = 153;
        $max_parts = 3;

        $str_length = self::count_gsm_string($str);
        if($str_length === -1) {
            $one_part_limit = 70;
            $multi_limit = 67;
            $str_length = self::count_ucs2_string($str);
        }

        if($str_length <= $one_part_limit) {
            return 1;
        } else if($str_length > ($max_parts * $multi_limit)) {
            return -1;
        } else {
            return ceil($str_length / $multi_limit);
        }
    }

    static function count_gsm_string($str){
        $gsm_7bit_basic = "@£\nØø\rÅåΔ_ΦΓΛΩΠΨΣΘΞÆæßÉ !\"#¤%&'()*+,-./0123456789:;<=>?¡ABCDEFGHIJKLMNOPQRSTUVWXYZÄÖÑÜ§¿abcdefghijklmnopqrstuvwxyzäöñüà";
        $gsm_7bit_extended = "^{}\\[~]|€";
        $len = 0;

        for($i = 0; $i < mb_strlen($str); $i++) {
            if(mb_strpos($gsm_7bit_basic, $str[$i]) !== FALSE) {
                $len++;
            } else if(mb_strpos($gsm_7bit_extended, $str[$i]) !== FALSE) {
                $len += 2;
            } else {
                return -1;
            }
        }
        return $len;
    }
}