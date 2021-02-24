<div class="si_settings si-settings-admin-header">
	<header class="si_header">
		<a href="#">
			<img class="header_sa_logo" src="<?php echo SI_RESOURCES . 'admin/img/sprout/headshot.png' ?>" aria-label="<?php _e( 'Hello! My name is Sprout.', 'sprout-invoices' ) ?>"/>
			<h1 class="si_title"><b>Sprout</b> Invoices</h1>
		</a>
	</header>
	<nav id="si-header-nav" class="si-header-nav">
		<ul>
			<?php
				$ifactive = ( isset( $_GET['page'] ) && 'sprout-invoices' === $_GET['page']  ) ? 'nav-tab-active' : '' ;
					?>
			<a href="<?php echo admin_url( 'admin.php?page=sprout-invoices' )  ?>" class="nav-item <?php echo $ifactive ?>"><?php _e( 'Getting Started', 'sprout-invoices' ) ?></a>
			<?php foreach ( $sub_pages as $slug => $subpage ) : ?>
				<?php
					$ifactive = ( isset( $_GET['page'] ) && 'sprout-invoices-' . $slug === $_GET['page']  ) ? 'nav-tab-active' : '' ;
						?>
				<a href="<?php echo admin_url( 'admin.php?page=sprout-invoices-' . $slug );  ?>" class="nav-item <?php echo $ifactive ?>"><?php echo $subpage['menu_title'] ?></a>
			<?php endforeach ?>
		</ul>
	</nav>

	<div id="si_progress_tracker_wrap">
		<?php do_action( 'sprout_settings_progress' ) ?>
	</div><!-- #si_progress_tracker_wrap -->
</div>

<?php if ( apply_filters( 'si_show_help_desk', true ) ) :  ?>
<script>!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});window.Beacon('init', '0857c75f-2142-4344-9c48-ccc5333af6eb')</script>
<?php endif ?>
