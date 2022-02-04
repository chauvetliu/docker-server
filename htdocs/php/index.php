<?php


// echo date("m-d",39219742);die;

echo 1643903999 - 1430409600;die;


var_dump($_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"]);die;



$tab=4;
$exception_status=15;
$stage = [1=>1, 2=>2, 3=>4, 4=>8];



var_dump( 10 & 2);die;

var_dump($exception_status & $stage[$tab]);
die;

if( ($exception_status & $stage[$tab]) != $stage[$tab]) {//无异常
    echo  'llliuxxxwwww';
}


echo "ookkk";
die;





$a = 2.30;
echo json_encode($a);die;



var_dump(strtotime("-1 year"));

die;


$a = -1;

if($a==0){
	die('ok');
}else{
	die('no');
}




phpinfo();
