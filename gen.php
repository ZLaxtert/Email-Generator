<?php

ini_set('memory_limit', '-1');
date_default_timezone_set("Asia/Jakarta");
$date = date("l, h-m-Y (H:m:s)");
$jam = date("H:m:s");

system("clear");
echo banner();
type:
echo "
=============[ TYPE ]=============
=                                =
= [1] USER ONLY    [3] USER&PWD  =
= [2] EMAIL ONYL   [4] EMAIL&PWD =
=                                =
==================================

[+] Chose type >> ";
$t = trim(fgets(STDIN));
if(!preg_match("/^[0-9]*$/", $t)){
    echo "\n\n[!] INPUT NUMBER ONLY [!]\n\n";
    goto type;
}
if($t == '1'){
    $type = 'username';
}elseif($t == '2'){
    $type = 'email';
    system("clear");
    echo banner();
    domain:
    echo "
=============[ DOMAIN ]============
=                                 =
= [1] GMAIL    [4] HOTMAIL FAMILY =
= [2] YAHOO    [5] GMX            =
= [3] MAIL     [6] RANDOM         =
=                                 =
===================================
 
[+] Chose number >> ";
    $dom = trim(fgets(STDIN));
    if(!preg_match("/^[0-9]*$/", $dom)){
        echo "\n\n[!] INPUT NUMBER ONLY [!]\n\n";
        goto domain;
    }
    if($dom == '1'){
        $domain = 'gmail';
    }elseif($dom == '2'){
        $domain = 'yahoo';
    }elseif($dom == '3'){
        $domain = 'mail';
    }elseif($dom == '4'){
        $domain = 'msn';
    }elseif($dom == '5'){
        $domain = 'msn';
    }elseif($dom == '6'){
        $domain = 'random';
    }else{
        echo "\n\n[!] INCORECT INPUT [!]\n\n";
        goto domain;
    }
}elseif($t == '3'){
    $type = 'uspas';
}elseif($t == '4'){
    $type = 'empas';
    system("clear");
    echo banner();
    echo "
=============[ DOMAIN ]============
=                                 =
= [1] GMAIL    [4] HOTMAIL FAMILY =
= [2] YAHOO    [5] GMX            =
= [3] MAIL     [6] RANDOM         =
=                                 =
===================================
 
[+] Chose number >> ";
    $dom = trim(fgets(STDIN));
    if(!preg_match("/^[0-9]*$/", $dom)){
        echo "\n\n[!] INPUT NUMBER ONLY [!]\n\n";
        goto domain;
    }
    if($dom == '1'){
        $domain = 'gmail';
    }elseif($dom == '2'){
        $domain = 'yahoo';
    }elseif($dom == '3'){
        $domain = 'mail';
    }elseif($dom == '4'){
        $domain = 'msn';
    }elseif($dom == '5'){
        $domain = 'msn';
    }elseif($dom == '6'){
        $domain = 'random';
    }else{
        echo "\n\n[!] INCORECT INPUT [!]\n\n";
        goto domain;
    }
}else{
    echo "\n\n[!] INCORECT TYPE [!]\n\n";
    goto type;
}

system("clear");
echo banner();
count:
echo "[+] Count (max 500) >> ";
$count = trim(fgets(STDIN));
if($count > 500){
    echo "\n\n[!] MAX 500 [!]\n\n";
    goto count;
}

echo "\n============[LOADING]============\n\n";

$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.banditcoding.xyz/gen/?submit=$type&domain=$domain&count=$count");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$res = curl_exec($ch);
$result = str_replace("<br />","\n",$res);
$result = "$result";
$result = str_replace("<pre>","",$result);
$result = str_replace("</pre>","",$result);

if(strpos($res, '"status":"failed"')){
    exit("\n\n[!] FAILED [!]\n\n");
}
else{
    system("clear");
    echo banner();
    echo "\n\n============[RESULT]============\n\n";
    file_put_contents("result/$jam.txt", $result.PHP_EOL, FILE_APPEND);
    echo $result;
    echo "\n============[THANKS]============\n";
    echo "\n[!] Result saved in folder 'result' [!]\n\n";
}

function banner(){
    date_default_timezone_set("Asia/Jakarta");
    $date = date("l, h-m-Y (H:m:s)");
    $banner = "
   ___ ___ _  _ ___ ___    _ _____ ___  ___ 
  / __| __| \| | __| _ \  /_\_   _/ _ \| _ \
 | (_ | _|| .` | _||   / / _ \| || (_) |   /
  \___|___|_|\_|___|_|_\/_/ \_\_| \___/|_|_\
                                        
-------------------------------------------------
 Author   : Zlaxtert
 Version  : 2.0
 Date Now : $date
-------------------------------------------------
";
    return $banner;
}
?>
