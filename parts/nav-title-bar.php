<?php
// Adjust the breakpoint of the title-bar by adjusting this variable
$breakpoint = "medium"; ?>

<div class="title-bar" data-responsive-toggle="top-bar-menu" data-hide-for="<?php echo esc_attr($breakpoint); ?>">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title"><?php esc_html_e( 'Menu', 'betube' ); ?></div>
</div>

<div class="top-bar" id="top-bar-menu">
	<div class="top-bar-left show-for-<?php echo esc_attr($breakpoint) ?>">
		<ul class="menu">
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></li>
		</ul>
	</div>
	<div class="top-bar-right">
		<?php betube_off_canvas_nav(); ?>
	</div>
</div>