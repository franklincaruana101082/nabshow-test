<?php
// $plink_settings = array(
// 	'title' => $block['title'],
// 	'image' => $block['image'],
//  'caption' => $block['image_caption'],
// 	'copy'  => $block['copy'],
// 	'link'  => $block['link'],
// );

?>
<div class="container section _toplarge">
	<?php if($plink_settings['title']) { ?>
	<div class="section-heading _centered">
		<h2 class="h-xl"><?php echo esc_html($plink_settings['title']); ?></h2>
	</div>
	<?php } ?>

	<div class="testimonial">
		<div class="testimonial__media">
			<?php if ($plink_settings['image']) { ?>
			<figure class="figure">
				<div class="figure__media">
					<img src="<?php echo esc_url($plink_settings['image']['url']); ?>" alt="<?php echo esc_attr($plink_settings['image']['alt']); ?>">
				</div>
				<?php if ($plink_settings['caption']) { ?>
				<figcaption class="figure__caption">
					<p><?php echo esc_html($plink_settings['caption']); ?></p>
				</figcaption>
				<?php } ?>
			</figure>
			<?php } ?>
		</div>
		<div class="testimonial__body">
			<?php if ($plink_settings['copy']) { ?>
			<blockquote class="pullquote">
				<p><?php echo esc_html($plink_settings['copy']); ?></p>
				<?php if ($plink_settings['link']) { 
					$link_url = $plink_settings['link']['url'];
					$link_target = $plink_settings['link']['target'] ? $plink_settings['link']['target'] : '_self';
					$link_text = $plink_settings['link']['title'];
				?>
				<a class="cite _arrow" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_text); ?></a>
				<?php } ?>
			</blockquote>
			<?php } ?>
		</div>
	</div>
</div>