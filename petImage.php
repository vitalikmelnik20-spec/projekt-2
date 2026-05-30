<?php

header ("content-type: image/jpeg");




$small_maneken_x = 80;
$small_maneken_y = 100;









$small_maneken   = imagecreatetruecolor(
		$small_maneken_x,
		$small_maneken_y
		);

$_GET['pet']= isset ($_GET['pet']) ? intval($_GET['pet']):0;

$_GET['sex']= isset ($_GET['sex']) ? intval($_GET['sex']):0;


$_GET['w_8'] = isset ($_GET['w_8'])?intval($_GET['w_8']):0;
$_GET['w_7'] = isset ($_GET['w_7'])?intval($_GET['w_7']):0;
$_GET['w_6'] = isset ($_GET['w_6'])?intval($_GET['w_6']):0;
$_GET['w_5'] = isset ($_GET['w_5'])?intval($_GET['w_5']):0;
$_GET['w_4'] = isset ($_GET['w_4'])?intval($_GET['w_4']):0;
$_GET['w_3'] = isset ($_GET['w_3'])?intval($_GET['w_3']):0;
$_GET['w_2'] = isset ($_GET['w_2'])?intval($_GET['w_2']):0;
$_GET['w_1'] = isset ($_GET['w_1'])?intval($_GET['w_1']):0;


$maneken     = imagecreatefrompng ("images/maneken/sex/$_GET[sex].png");


if ($_GET['w_7']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_7].png"), 0, 0, 0, 0, 120, 160);
}
if ($_GET['w_8']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_8].png"), 0, 0, 0, 0, 120, 160);
}
if ($_GET['w_3']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_3].png"), 0, 0, 0, 0, 120, 160);
}
if ($_GET['w_1']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_1].png"), 0, 0, 0, 0, 120, 160);
}
if ($_GET['w_2']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_2].png"), 0, 0, 0, 0, 120, 160);
}
if ($_GET['w_4']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_4].png"), 0, 0, 0, 0, 120, 160);
}
if ($_GET['w_6']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_6].png"), 0, 0, 0, 0, 120, 160);
}
if ($_GET['w_5']!=0) {
    imagecopy($maneken, imagecreatefrompng ("images/maneken/$_GET[sex]/$_GET[w_5].png"), 0, 0, 0, 0, 120, 160);
}


imagecopyresized (
		$small_maneken,
		$maneken,
		0,
		0,
		0,
		0,
		$small_maneken_x,
		$small_maneken_y,
		120,
		160
);

imagecolortransparent (
		$small_maneken,
		imagecolorallocate (
				$small_maneken,
				0,
				0,
				0
		)
);


$pet = imagecreatefrompng("images/pet/$_GET[pet].png");


$offset_x  = array(
    0,   // 0 
    10,   // 1
    110, // 2
    65,  // 3
    65   // 4
);
$offset_y = array (

);

imagecopymerge (
		$pet,
		$small_maneken,
		$offset_x[ $_GET['pet'] ],
		20,
		10,
		0,
		$small_maneken_x,
		$small_maneken_y,
		100
);

imagejpeg ($pet);
