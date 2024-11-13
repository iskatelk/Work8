<?php

$serials = [];
$d = 0;
$numbers = [];
for ($i = 1; $i < 3; $i++) {
    for ($j = 1; $j < 3; $j++) {
        for ($k = 1; $k < 3; $k++) {
            $str = "{$i}" . "{$j}" . "{$k}";

            $str2 = str_replace('1', 'A', $str);
            $str3 = str_replace('2', 'B', $str2);
            // echo $str3.PHP_EOL;

            for ($c = 0; $c < 3; $c++) {
                $serials[] = substr($str3, $c, 1);
            }
            for ($f = 0; $f < 223; $f++) {
                if ($f < 10) {
                    $f2 = "00{$f}";
                } elseif ($f > 9 && $f < 100) {
                    $f2 = "0{$f}";
                } else {
                    $f2 = "{$f}";
                }
                $digits = $serials[$d] . $f2 . $serials[$d + 1] . $serials[$d + 2];
                echo $digits . PHP_EOL;
                $numbers[] = $digits;
            }
            $d = $d + 3;
        }
    }
}

//получаем номера с одинаковыми цифрами
$trimNumbers = [];
foreach ($numbers as $key => $number) {
    if ($number[1] === $number[2] && $number[2] === $number[3]) {
        $trimNumbers[] = $number;
    }
}

echo "\n";
foreach ($trimNumbers as $trimNumber) {
    echo $trimNumber . PHP_EOL;
}