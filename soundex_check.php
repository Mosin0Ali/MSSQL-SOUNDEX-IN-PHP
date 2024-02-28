<?php

$data=['Smith','Smyth','Mark','Merk','Suman','Sumen','Mohsin','Mohsen','Mohsan'];

function generateSoundexCode($string){
    $string=strtoupper($string);
    $soundex= $string[0];
    $encoding=[
        'B' => 1, 'F' => 1, 'P' => 1, 'V' => 1,
        'C' => 2, 'G' => 2, 'J' => 2, 'K' => 2, 'Q' => 2, 'S' => 2, 'X' => 2, 'Z' => 2,
        'D' => 3, 'T' => 3,
        'L' => 4,
        'M' => 5, 'N' => 5,
        'R' => 6
        ];
    for($i=1;$i<strlen($string);$i++){
        $char=$string[$i];
        if(isset($encoding[$char])){
            if($encoding[$char]!=$encoding[$string[$i-1]]){
                if($encoding[$char]!=0){
                    $soundex.=$encoding[$char];
                }
            }
        }
    }
    $soundex=str_replace('0','',$soundex);
    $soundex=str_pad($soundex,4,'0',STR_PAD_RIGHT);
    return $soundex;
}

function search(&$data,$search_string){
    $matched=array();
    $soundex_code=generateSoundexCode($search_string);
    foreach($data as $key=>$value){
        if(generateSoundexCode($value)==$soundex_code){
            $matched[]=$value;
        }
    }
    return $matched;
}

$matches=search($data,'Mohsin');
print_r($matches);

?>
