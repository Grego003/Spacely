<?php
$AlpStr = array(
	'8', '5', 'i', 'n', 'k', 'I', 'F', 'K', 
	'3', 'o', 'D', '4', 'x', 'W', 'y', 'O', 
	'd', 'C', 'z', 'c', 'P', 'b', '6', '7', 
	'%', 'L', 'e', '0', 'U', 'j', '@', 'V', 
	'q', '9', '1', 'E', 'v', '2', 's', 'a', 
	'h', 'B', 'A', 'f', 'w', '!', 'N', 'r', 
	'l', 'H', 'J', 'm', 'Y', 'G', 'M', 'Z', 
	'Q', 'u', 'X', 'g', 'S', '$', '#', 'T', 
	'R', 'p', 't');

function Encode($text , $key = null){
    global $AlpStr;
    $re = array(
        "key" => "",
        "encoded" => ""
    );

    if($key == null) $re['key'] = Random_String(45 - strlen($text));
    else $re['key'] = $key;

    $tmp = str_split($re["key"]) + str_split($text);
    $keylen = strlen($re["key"]);
    $tmplen = count($tmp);
    for($i = $keylen; $i < $tmplen; $i++){
        $tmp[$i] = $AlpStr[
            ReCircle(
                array_search(
                    $tmp[$i - $keylen], $AlpStr) * 
                    round($i + count($AlpStr)), 
                    count($AlpStr)
                    )
                ];
    }
    $AlpLen = count($AlpStr);
    $tmp[0] = $AlpStr[ReCircle(array_search($tmp[$tmplen/2], $AlpStr) - $i + $AlpLen, $AlpLen)];
    for($i = 1; $i < $tmplen; $i++){
        $tmp[$i] = $AlpStr[ReCircle(array_search($tmp[$i], $AlpStr) - $i + $AlpLen, $AlpLen)];
        $re["encoded"] .= $tmp[$i];
    }
    return $re;
}

function CheckEncode($text, $key, $encoded) {
    global $AlpStr;
    $re = Encode($text, $key);
    //console.log("re " + re[0] + ": en "+ encoded);
    if($re["encoded"] == $encoded) return "true";
    return "false";
};

function Random_String($RMax){
    global $AlpStr;
    $re = "";
    for($i = 0; $i < $RMax; $i++){
        $r = floor(rand(0,count($AlpStr) - 1));
        $re .= $AlpStr[$r];
    }
    return $re;
}

function ReCircle($input, $Max){
    //console.log(input + " " + Max);
    if($input >= $Max){
        $input -= $Max;
        return ReCircle($input, $Max);
    }
    else if($input < 0){
        $input += $Max;
        return ReCircle($input, $Max);
    }
    return $input;
}