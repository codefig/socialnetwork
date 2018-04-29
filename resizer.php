<?php

function resizer($target_file, $newcopy, $rwidth, $rheight, $ext){
	list($w_orig, $h_orig) = getimagesize($target_file);

	$scale_ratio = $w_orig / $h_orig;

	if(($rwidth/$rheight) > $scale_ratio) {
		$rwidth = $rheight * $scale_ratio;
	}
	else{
		$rheight= $rwidth / $scale_ratio;
	}


	$img = "";

	if($ext == "gif" || $ext == "GIF"){
		$img = imagecreatefromgif($target_file);
  }

    elseif($ext == "png" || $ext == "PNG"){
    	$img = imagecreatefrompng($target_file);
    }

    else{
    	$img = imagecreatefromjpeg($target_file);
    }

    $tci = imagecreatetruecolor($rwidth, $rheight);

    // imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);
    imagecopyresampled($tci,$img, 0,0,0,0, $rwidth, $rheight, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 80);

}


?>