<?php /* Template Name: Guest Pass */ ?>

<?php

$results = FALSE;
$dest = $src = $error = $booth = $code = '';
$x_diff = $y_diff = 0;
$ad_files = array();

$ad_options = array(
	array(
		'width' => 300,
		'height' => 250,
		'logo_x' => 64,
		'logo_y' => 22,
		'logo_width' => 270,
		'logo_height' => 270,
		'booth_x' => 485,
		'booth_y' => 128,
		'booth_size' => 92,
		'code_x' => 918,
		'code_y' => 233,
		'code_size' => 24,
		'color' => array('red'=>0,'grn'=>121,'blu'=>149),
		'padding' => 10,
	),
	array(
		'width' => 728,
		'height' => 90,
		'logo_x' => 24,
		'logo_y' => 24,
		'logo_width' => 225,
		'logo_height' => 225,
		'booth_x' => 366,
		'booth_y' => 108,
		'booth_size' => 80,
		'code_x' => 734,
		'code_y' => 198,
		'code_size' => 20,
		'color' => array('red'=>0,'grn'=>121,'blu'=>149),
		'padding' => 10,
	),
	array(
		'width' => 440,
		'height' => 220,
		'logo_x' => 143,
		'logo_y' => 63,
		'logo_width' => 202,
		'logo_height' => 202,
		'booth_x' => 100,
		'booth_y' => 423,
		'booth_size' => 60,
		'code_x' => 183,
		'code_y' => 522,
		'code_size' => 18,
		'color' => array('red'=>0,'grn'=>121,'blu'=>149),
		'padding' => 15,
	),
	array(
		'width' => 1200,
		'height' => 630,
		'logo_x' => 158,
		'logo_y' => 78,
		'logo_width' => 202,
		'logo_height' => 202,
		'booth_x' => 115,
		'booth_y' => 443,
		'booth_size' => 62,
		'code_x' => 200,
		'code_y' => 545,
		'code_size' => 18,
		'color' => array('red'=>0,'grn'=>121,'blu'=>149),
		'padding' => 15,
	),
	array(
		'width' => 1080,
		'height' => 1080,
		'logo_x' => 46,
		'logo_y' => 43,
		'logo_width' => 277,
		'logo_height' => 277,
		'booth_x' => 470,
		'booth_y' => 150,
		'booth_size' => 95,
		'code_x' => 920,
		'code_y' => 260,
		'code_size' => 24,
		'color' => array('red'=>0,'grn'=>121,'blu'=>149),
		'padding' => 15,
	),
	array(
		'width' => 1080,
		'height' => 1920,
		'logo_x' => 340,
		'logo_y' => 100,
		'logo_width' => 400,
		'logo_height' => 400,
		'booth_x' => 200,
		'booth_y' => 683,
		'booth_size' => 132,
		'code_x' => 846,
		'code_y' => 840,
		'code_size' => 33,
		'color' => array('red'=>0,'grn'=>121,'blu'=>149),
		'padding' => 15,
	),
);

function textToImage(
  $text,
  $size=24,
  $color=array('red'=>0,'grn'=>0,'blu'=>0),
  $bg_color=array('red'=>255,'grn'=>255,'blu'=>255),
  $pad=5,
  $font='./fonts/Arial-BoldMT.otf'
){
    $separate_line_after_chars=40;
    $rotate=0;
    $padding=2;
    $transparent=true;
    $amount_of_lines= ceil(strlen($text)/$separate_line_after_chars);
    $x=explode("\n", $text); $final='';
    foreach($x as $key=>$value){
        $returnes='';
        do{ $first_part=mb_substr($value, 0, $separate_line_after_chars, 'utf-8');
            $value= "\n".mb_substr($value, $separate_line_after_chars, null, 'utf-8');
            $returnes .=$first_part;
        }  while( mb_strlen($value,'utf-8')>$separate_line_after_chars);
        $final .= $returnes."\n";
    }
    $text=$final;
    //Header("Content-type: image/jpg");
    $width=$height=$offset_x=$offset_y = 0;
    // get the font height.
    $bounds = ImageTTFBBox($size, $rotate, $font, "W");
    if ($rotate < 0)        {$font_height = abs($bounds[7]-$bounds[1]); }
    elseif ($rotate > 0)    {$font_height = abs($bounds[1]-$bounds[7]); }
    else { $font_height = abs($bounds[7]-$bounds[1]);}
    // determine bounding box.
    $bounds = ImageTTFBBox($size, $rotate, $font, $text);
    if ($rotate < 0){       $width = abs($bounds[4]-$bounds[0]);                    $height = abs($bounds[3]-$bounds[7]);
                            $offset_y = $font_height;                               $offset_x = 0;
    }
    elseif ($rotate > 0) {  $width = abs($bounds[2]-$bounds[6]);                    $height = abs($bounds[1]-$bounds[5]);
                            $offset_y = abs($bounds[7]-$bounds[5])+$font_height;    $offset_x = abs($bounds[0]-$bounds[6]);
    }
    else{                   $width = abs($bounds[4]-$bounds[6]);                    $height = abs($bounds[7]-$bounds[1]);
                            $offset_y = $font_height;                               $offset_x = 0;
    }
    $image = imagecreate($width+($padding*$pad)+2,$height+($padding*$pad)+2);
    $background = ImageColorAllocate($image, $bg_color['red'], $bg_color['grn'], $bg_color['blu']);
    $foreground = ImageColorAllocate($image, $color['red'], $color['grn'], $color['blu']);
		$bg_color = imagecolorat($image,1,1);
		imagecolortransparent($image, $bg_color);
    ImageInterlace($image, true);
  // render the image
    ImageTTFText($image, $size, $rotate, $offset_x+$padding, $offset_y+$padding, $foreground, $font, $text);
    imagealphablending($image, true);
    imagesavealpha($image, true);
  // output JPG object.
    return $image;
}
	//======helper function==========
	if(!function_exists('mb_substr_replace')){
	  function mb_substr_replace($string, $replacement, $start, $length = null, $encoding = "UTF-8") {
		if (extension_loaded('mbstring') === true){
			$string_length = (is_null($encoding) === true) ? mb_strlen($string) : mb_strlen($string, $encoding);
			if ($start < 0) { $start = max(0, $string_length + $start); }
			else if ($start > $string_length) {$start = $string_length; }
			if ($length < 0){ $length = max(0, $string_length - $start + $length);  }
			else if ((is_null($length) === true) || ($length > $string_length)) { $length = $string_length; }
			if (($start + $length) > $string_length){$length = $string_length - $start;}
			if (is_null($encoding) === true) {  return mb_substr($string, 0, $start) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length); }
			return mb_substr($string, 0, $start, $encoding) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length, $encoding);
		}
		return (is_null($length) === true) ? substr_replace($string, $replacement, $start) : substr_replace($string, $replacement, $start, $length);
	  }
	}

if (isset($_POST['action']) && $_POST['action'] == 'makeImage') :
	$results = TRUE;
	$target_dir = "custom/";
	$target_file = $target_dir . basename($_FILES["logo"]["name"]);$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$source_file = $_FILES["logo"]["tmp_name"];
	$check = getimagesize($_FILES["logo"]["tmp_name"]);
	if($check === false || ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif")) {
		$error = 'Select a jpg, png or gif image file';
		$uploadOk = 0;
	}
	// Check file size
	elseif ($_FILES["logo"]["size"] > 500000) {
		$error = "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	if ($uploadOk) {

		$current_timestamp = time();

		// Create image instances
		switch($imageFileType)
    {
			case 'png':
				$uploaded_logo = imagecreatefrompng($source_file);
				break;
			case 'gif':
				$uploaded_logo = imagecreatefromgif($source_file);
				break;
			case 'jpeg':
			case 'jpg':
				$uploaded_logo = imagecreatefromjpeg($source_file);
				break;
    }

    list($uploaded_width, $uploaded_height, $type, $attr) = getimagesize($source_file);

    foreach ($ad_options as $ad) {

    	// Create Booth number image
			$booth_image = textToImage($_POST['booth'], $ad['booth_size'],$ad['color'],$ad['color'],$ad['padding'],'./fonts/Arial-BoldMT.otf');

    	// Create Code image
			$code_image = textToImage($_POST['code'], $ad['code_size'],$ad['color'],$ad['color'],$ad['padding']/2,'./fonts/OpenSans.ttf');

			//Scale and maintain aspect ratio of the uploaded logo image
      $old_x = imageSX($uploaded_logo);
      $old_y = imageSY($uploaded_logo);

      if($old_x > $old_y)
      {
        $thumb_w = $ad['logo_width'];
        $thumb_h = $old_y*($ad['logo_height']/$old_x);
      }

      if($old_x < $old_y)
      {
        $thumb_w = $old_x*($ad['logo_width']/$old_y);
        $thumb_h = $ad['logo_height'];
      }

      if($old_x == $old_y)
      {
        $thumb_w = $ad['logo_width'];
        $thumb_h = $ad['logo_height'];
      }
      $logo = ImageCreateTrueColor($thumb_w,$thumb_h);
      imagecopyresampled($logo,$uploaded_logo,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
			imagealphablending($logo,true); //allows us to apply logo over ad

			// Center logo based on aspect ratio
			if ($thumb_w < $ad['logo_width']) {
			  $x_diff = ($ad['logo_width'] - $thumb_w) / 2;
			}
			if ($thumb_h < $ad['logo_height']) {
			  $y_diff = ($ad['logo_height'] - $thumb_h) / 2;
			}

			//Load the ad image
			$ad_image = imagecreatefromjpeg('orig/custom_'.$ad['width'].'x'.$ad['height'].'.jpg');
			imagealphablending($ad_image,true); //allows us to apply logo over ad

			//Apply logo to ad
      imagecopy($ad_image,$logo,$ad['logo_x']+$x_diff,$ad['logo_y']+$y_diff,0,0,$thumb_w,$thumb_h);
			//Apply booth number to ad
			imagecopy($ad_image,$booth_image,$ad['booth_x'],$ad['booth_y'],0,0,1000,1000);
			//Apply code to ad
			imagecopy($ad_image,$code_image,$ad['code_x'],$ad['code_y'],0,0,1000,1000);
			//Resize new image
			$ad_image = imagescale($ad_image, $ad['width'], $ad['height'], IMG_BICUBIC);
			$cropped = imagecropauto($ad_image, IMG_CROP_THRESHOLD, null, 0);
			if ($cropped !== false) { // in case a new image resource was returned
					imagedestroy($ad_image);    // we destroy the original image
					$ad_image = $cropped;       // and assign the cropped image to $im
			}
			//Save new image
			$filename = $target_dir . $current_timestamp . '_' . $_POST['booth'] . '_'.$ad['width'].'x'.$ad['height'].'.png';
			array_push($ad_files, $filename);
			$success = imagejpeg($ad_image,$filename);

			imagedestroy($logo);
			imagedestroy($ad_image);
			imagedestroy($booth_image);
			imagedestroy($code_image);
    }

		imagedestroy($uploaded_logo);
	} else {
		$results = FALSE;
	}
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Customized Web Ads</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="/guestpass/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="/guestpass/js/jquery.validate.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#customAdForm").validate({
					rules: {
						booth: "required",
						company_name: "required"
					},
					messages: {
						booth: "Please enter your booth number",
						company_name: "Please enter your code",
					logo: "Select a jpg, png or gif image file"
					}
				});
			});
		</script>
	</head>
	<body>
		<div style="clear: both;">
			<form id="customAdForm" name="customAdForm" method="post" action="" class="cmxform" enctype="multipart/form-data">
				<input type="hidden" name="action" value="makeImage">
					<fieldset>

							<label for="booth">Booth: </label>
							<input id="booth" size="8" name="booth" class="required" value="<?php if (isset($_POST['booth'])) print $_POST['booth']; ?>" maxlength="7">

							&nbsp;&nbsp;&nbsp;<label for="code">Code: </label>
							<input id="code" size="8" name="code" class="required" value="<?php if (isset($_POST['code'])) print $_POST['code']; ?>" maxlength="7">


							&nbsp;&nbsp;&nbsp;<label for="logo"> Logo (GIF, JPG, PNG, in RGB color mode, under 2MB): </label><input id="logo" name="logo" type="file" style="display:inline;" value="" class=""><?php print '<p>'.$error.'</p>'; ?><input type="submit"  style="display:inline;" value="Create Ads">

				</fieldset>
			</form>
		</div>
		<?php if ($results) : ?>
		<p>Click on a thumbnail below to download the custom ad to use on your website or social media to let people know that you will be participating in the Show.</p>
		<h3>Your Custom Web Ads</h3>
		<?php foreach($ad_files as $ad) : ?>
		<a href="<?php echo $ad; ?>"><img src="<?php echo $ad; ?>" class="customIMG"></a>&nbsp;
		<?php endforeach; ?>
		<br />
		<?php endif; ?>
		<div style="width:100%;padding-bottom:70px;"></div>
		<script type="text/javascript" src="/guestpass/js/iframeResizer.contentWindow.min.js"></script>
	</body>
</html>
