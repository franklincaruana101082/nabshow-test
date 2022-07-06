<?php
//part-heroContent.php
// $hero_settings = array(
//  'icon'       => $block['icon'],
//  'subhead'    => $block['subhead'],
//  'headline'   => $block['headline'],
//  'hero_image' => $block['hero_image'],
//  'hero_copy'  => $block['hero_copy'],
//  'ctas'       => $block['ctas'],
// );

if($hero_settings['headline']) {
?>
<div class="intro _nobg _short">
	<div class="container intro__container">
		<?php if($hero_settings['subhead']) {?>
		<h2 class="intro__label">
			<?php if($hero_settings['icon']) {?>
			<span class="inline-icon icon-pillar" style="background-image: url('<?php echo esc_url($hero_settings['icon']['url']); ?>');">
			<?php } ?>
				<?php echo $hero_settings['subhead']; ?>
			<?php if($hero_settings['icon']) {?>
			</span>
			<?php } ?>
		</h2>
		<?php } ?>
		<h1 class="intro__title"><?php echo $hero_settings['headline']; ?></h1>
	</div>
</div>

<?php
}

if($hero_settings['hero_image']) {
?>
<div class="container">
	<img class="hero__image" src="<?php echo esc_url($hero_settings['hero_image']['url']); ?>" alt="<?php echo esc_attr($hero_settings['hero_image']['alt']); ?>" />
</div>
<?php
}

if($hero_settings['hero_copy']) {
?>
<div class="container">
	<div class="hero__copy">
		<?php echo $hero_settings['hero_copy']; 

		if($hero_settings['ctas']) {
		?>
		<ul class="hero__ctas">
			<?php
			foreach($hero_settings['ctas'] as $cta) {
				$cta_url = $cta['cta']['url'];
				$cta_title = $cta['cta']['title'];
				$cta_target = $cta['cta']['target'] ? $cta['cta']['target'] : '_self';
			?>
			<li class="hero__cta">
				<a class="button" href="<?php echo esc_url($cta_url); ?>" target="<?php esc_attr($cta_target); ?>"><?php echo esc_html($cta_title); ?></a>
			</li>
			<?php 
			} 
			?>
		</ul>
		<?php
		}
		?>
	</div>
</div>
<?php
}