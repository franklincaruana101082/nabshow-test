<?php /* Template Name: Guest Pass */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Customized Web Ads</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo get_template_directory_uri(). '/css/bootstrap.css'; ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(). '/js/jquery.validate.min.js';?>"></script>
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
	<?php
	echo do_shortcode( '[guest_pass]' );
	?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(). '/js/iframeResizer.contentWindow.min.js';?>"></script>
</body>
</html>
