<?php
// $flinks_settings = array(
// 	'title'      => $block['title'],
// 	'intro_copy' => $block['intro_copy'],
// 	'links'      => $block['links'],
// );

?>
<div class="section container">
	<?php if ($flinks_settings['title'] || $flinks_settings['intro_copy']) { ?>
	<div class="section-heading">
		<?php if ($flinks_settings['title']) { ?>
		<h2 class="h-xl"><?php echo esc_html($flinks_settings['title']); ?></h2>
		<?php } ?>
		<?php if ($flinks_settings['intro_copy']) { ?>
		<div class="story__intro"><?php echo esc_html($flinks_settings['intro_copy']); ?></div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php if ($flinks_settings['links']) { ?>
	<div class="stories">
		<?php foreach($flinks_settings['links'] as $link) { 
			$link_title = $link['link_title'];
			$link_teaser = $link['link_teaser'];
			$link_image = $link['link_image'];
			$link_url = $link['link']['url'];
			$link_target = $link['link']['target'] ? $link['link']['target'] : '_self';
			$link_text = $link['link']['title'];
		?>
		<a class="story" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
			<div class="story__media">
				<?php if ($link_image) { ?>
				<figure class="figure">
					<div class="figure__media">
						<img src="<?php echo esc_url($link_image['url']); ?>" alt="<?php echo esc_attr($link_image['alt']); ?>">
					</div>              
				</figure>
				<?php } ?>
			</div>
			<div class="story__body">
				<?php if ($link_title) { ?>
				<h4 class="story__title"><?php echo esc_html($link_title); ?></h4>
				<?php } ?>
				<?php if ($link_teaser) { ?>
				<p>
					<?php echo esc_html($link_teaser); ?>
				</p>
				<?php } ?>
				<div class="button _arrow"><?php echo esc_html($link_text); ?></div>
			</div>
		</a>
		<?php } ?>	
	</div>
    <?php } ?>
</div>