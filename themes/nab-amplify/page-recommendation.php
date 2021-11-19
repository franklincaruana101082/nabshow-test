<?php
/**
 * Template Name: Recommendation Homepage
 *
 */

get_header();

//get JSON with cURL

$pop_content_url = 'http://one.wordpress.test//wp-json/wp/v2/articles?include=1014,1039,30499';
// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, $pop_content_url);

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);   

$pop_content = json_decode($output);

?>

	<!-- START Reccomendation homepage -->
	<div class="container">
	<main id="primary" class="site-main rec">

		<?php
			foreach($pop_content as $key => $article) {
				$title = $article->title->rendered;
				$link = $article->link;
				$excerpt = $article->excerpt->rendered;
				$photo_id = $article->featured_media;
				if($key === 0) {
					?>
					<div class="nabcard">
						<div class="nabcard__content">
							<div class="rec__featured">
								<div class="textimage">
									<a class="textimage__link" href="<?php echo esc_url($link); ?>" data-id="<?php echo($photo_id); ?>">
										<div class="textimage__image">
											<?php echo wp_get_attachment_image($photo_id, 'large', "", array('class' => 'textimage__img')); ?>
										</div>
									</a>
								</div>
								<div class="rec__desc">
									<h2 class="rec__title"><a href="<?php echo esc_url($link); ?>"><?php echo($title); ?></a></h2>
									<div class="rec__excerpt"><?php echo($excerpt); ?></div>
									<a class="button _gradientpink rec__button" href="<?php echo esc_url($link); ?>">See More</a>
								</div>
							</div>
						</div>
					</div>
					<?php
				} else {
					if($key === 1) {
						?>
						<div class="rec__grid">
						<?php
					}
					?>

					<div class="weekly__feature">
						<div class="weekly__image" style="background-image: url('<?php echo wp_get_attachment_image_url($photo_id, 'large'); ?>');">
							<a class="weekly__link" href="<?php echo esc_url($link); ?>">
								<?php echo wp_get_attachment_image($photo_id, 'large', "", array('class' => 'relatedlink__img')); ?>
							</a>
						</div>
						<a class="weekly__link" href="<?php echo esc_url($link); ?>">
							<h2 class="weekly__headline"><?php echo($title); ?></h2>
						</a>
						<div class="weekly__desc introtext"><?php echo($excerpt); ?></div>
					</div>
					<?php
					if($key === array_key_last($pop_content)) {
						?>
						</div>
						<?php	
					}
				}
			}
			//print_r($pop_content);
		?>

	</main><!-- #main -->
	</div><!-- .container -->
	<!-- END Reccomendation homepage -->

<?php
get_footer();
/*
phpinfo();
*/
