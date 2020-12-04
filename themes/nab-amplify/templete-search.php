<?php
/**
* Template Name: Search
*/
get_header();
?>

<div class="nab-search-page dark-mode">
	<div class="container">
		<div class="nab-search-inner">
			<div class="nab-search-wrp">
				<div class="nab-search-filter">
					<div class="nab-search-header">
						<div class="nab-search-controle">
							<input type="search">
						</div>
						<div class="filter-devider" style="background-image:url('<?php echo get_template_directory_uri() ?>/assets/images/search-bar.svg');width:100%;height:50px;"></div>
					</div>
					<div class="nab-search-body">
						<div class="nab-filter-top">
							<div class="nab-controles-wrp nab-filter-toggle">
								<div class="nab-filter-row">
									<strong>people</strong>
									<div class="nab-toggle-btn">
										<input type="checkbox">
										<span class="toggle-switch"></span>
									</div>
								</div>
								<div class="nab-filter-row">
									<strong>products</strong>
									<div class="nab-toggle-btn">
										<input type="checkbox">
										<span class="toggle-switch"></span>
									</div>
								</div>
								<div class="nab-filter-row">
									<strong>companies</strong>
									<div class="nab-toggle-btn">
										<input type="checkbox">
										<span class="toggle-switch"></span>
									</div>
								</div>
								<div class="nab-filter-row">
									<strong>content</strong>
									<div class="nab-toggle-btn">
										<input type="checkbox">
										<span class="toggle-switch"></span>
									</div>
								</div>
							</div>
							<div class="nab-controles-wrp nab-filter-checkbox">
								<div class="nab-clear-filter">
									<a href="javascript:void(0)">clear filter</a>
								</div>
								<strong>By Type:</strong>
								<div class="nab-controles-main">
									<div class="nab-filter-row">
										<div class="nab-check-btn">
											<input type="checkbox">
											<span class="checkmark-switch"></span>
										</div>
										<strong>Articles</strong>
									</div>
									<div class="nab-filter-row">
										<div class="nab-check-btn">
											<input type="checkbox">
											<span class="checkmark-switch"></span>
										</div>
										<strong>video</strong>
									</div>
									<div class="nab-filter-row">
										<div class="nab-check-btn">
											<input type="checkbox">
											<span class="checkmark-switch"></span>
										</div>
										<strong>forum posts</strong>
									</div>
								</div>
								<strong>By Topic:</strong>
								<div class="nab-controles-main">
									<div class="nab-filter-row">
										<div class="nab-check-btn">
											<input type="checkbox">
											<span class="checkmark-switch"></span>
										</div>
										<strong>Topic 1</strong>
									</div>
									<div class="nab-filter-row">
										<div class="nab-check-btn">
											<input type="checkbox">
											<span class="checkmark-switch"></span>
										</div>
										<strong>Topic 2</strong>
									</div>
									<div class="nab-filter-row">
										<div class="nab-check-btn">
											<input type="checkbox">
											<span class="checkmark-switch"></span>
										</div>
										<strong>Topic 3</strong>
									</div>
								</div>
							</div>
						</div>
						
						<div class="nab-filter-bottom nab-filter-toggle">
							<strong>Include results from these sites:</strong>
							<div class="nab-controles-wrp nab-filter-toggle">
								<div class="nab-filter-row">
									<strong>Amplify</strong>
									<div class="nab-toggle-btn">
										<input type="checkbox">
										<span class="toggle-switch"></span>
									</div>
								</div>
								<div class="nab-filter-row">
									<strong>Nab Show</strong>
									<div class="nab-toggle-btn">
										<input type="checkbox">
										<span class="toggle-switch"></span>
									</div>
								</div>
								<div class="nab-filter-row">
									<strong>nabshow new york</strong>
									<div class="nab-toggle-btn">
										<input type="checkbox">
										<span class="toggle-switch"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="nab-search-result">
					<div class="nab-result-header">
						
					</div>
					<div class="nab-result-body">
						<div class="nab-custom-select">
							<select>
								<option>test</option>
								<option>test</option>
								<option>test</option>
								<option>test</option>
								<option>test</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();