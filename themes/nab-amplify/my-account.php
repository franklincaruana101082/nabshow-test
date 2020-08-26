<?php
/*
 * Template Name: account templete
 */
get_header();
if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	$user_thumb   = get_avatar_url( $current_user->ID );
}
?>
<div class="container">
	<div class="nab-profile">
		<h2 class="entry-title">MY PROFILE</h2>
		<div class="nab-section section-nab-profile">
			<div class="nab-profile-head">
				<h3>PROFILE PICTURES</h3>
				<a href="javascript:void(0)" class="button">view profile</a>
			</div>
			<div class="nab-profile-body flex-row">
				<div class="flex-column">
					<div class="flex-box">
						<div class="nab-profile-image">
							<img src="<?php echo esc_url( $user_thumb ); ?>"/>
						</div>
						<div class="nab-profile-button">
							<a href="javascript:void(0)" class="button">update</a>
						</div>
					</div>
				</div>
				<div class="flex-column">
					<div class="flex-box">
						<div class="nab-avtar-image">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar.jpg">
						</div>
						<div class="nab-profile-button">
							<a href="javascript:void(0)" class="button">update</a>
							<a href="javascript:void(0)" class="button">remove</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="nab-section section-professional-details">
			<h3>PROFESSIONAL DETAILS</h3>
			<div class="professional-details-form">
				<div class="nab-form-row">
					<input type="text" class="input-text" placeholder="Title">
				</div>
				<div class="nab-form-row">
					<input type="text" class="input-text" placeholder="Company">
				</div>
				<div class="nab-form-submit">
					<button type="submit" class="button" name="save_professional_details" value="update">update</button>
				</div>
			</div>
		</div>
		<div class="nab-section section-social-links">
			<h3>SOCIAL LINKS</h3>
			<div class="social-links-form">
				<div class="nab-form-row">
					<div class="social-icon">
						<i class="fa fa-twitter"></i>
					</div>
					<div class="social-input">
						<input type="text" class="input-text" placeholder="Twitter">
					</div>
				</div>
				<div class="nab-form-row">
					<div class="social-icon">
						<i class="fa fa-linkedin"></i>
					</div>
					<div class="social-input">
						<input type="text" class="input-text" placeholder="LinkedIn">
					</div>
				</div>
				<div class="nab-form-row">
					<div class="social-icon">
						<i class="fa fa-facebook-square"></i>
					</div>
					<div class="social-input">
						<input type="text" class="input-text" placeholder="Facebook">
					</div>
				</div>
				<div class="nab-form-row">
					<div class="social-icon">
						<i class="fa fa-instagram"></i>
					</div>
					<div class="social-input">
						<input type="text" class="input-text" placeholder="Instagram">
					</div>
				</div>
				<div class="nab-form-row">
					<div class="social-icon">
						<i class="fa fa-link"></i>
					</div>
					<div class="social-input">
						<input type="text" class="input-text" placeholder="Website">
					</div>
				</div>
				<div class="nab-form-submit">
					<button type="submit" class="button" name="save_professional_details" value="update">update</button>
				</div>
			</div>
		</div>
		<div class="nab-section section-about-me">
			<h3>ABOUT ME</h3>
			<div class="about-me-form">
				<div class="nab-form-row">
					<div class="row-label">
						<label>I’m interested in…</label>
					</div>
					<div class="row-input-wrp">
						<div class="row-input">
							<input type="text" class="input-text" placeholder="Interest 1">
						</div>
						<div class="row-input">
							<input type="text" class="input-text" placeholder="Interest 2">
						</div>
						<div class="row-input">
							<input type="text" class="input-text" placeholder="Interest 3">
						</div>
					</div>
				</div>
				<div class="nab-form-row">
					<div class="row-label">
						<label>I’m excited about…</label>
					</div>
					<div class="row-input-wrp">
						<div class="row-input">
							<input type="text" class="input-text" placeholder="Interest 1">
						</div>
						<div class="row-input">
							<input type="text" class="input-text" placeholder="Interest 2">
						</div>
						<div class="row-input">
							<input type="text" class="input-text" placeholder="Interest 3">
						</div>
					</div>
				</div>
				<div class="nab-form-row">
					<div class="row-label">
						<label>I’m knowledgeable about…</label>
					</div>
					<div class="row-input-wrp">
						<textarea placeholder="max 200 characters"></textarea>
					</div>
				</div>
				<div class="nab-form-submit">
					<button type="submit" class="button" name="save_professional_details" value="update">update</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();