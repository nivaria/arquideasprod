<?php
// $Id: page.tpl.php 6635 2010-03-01 00:39:49Z chris $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $setting_styles; ?>
  <!--[if IE 8]>
  <?php print $ie8_styles; ?>
  <![endif]-->
  <!--[if IE 7]>
  <?php print $ie7_styles; ?>
  <![endif]-->
  <!--[if IE 6]>
  <?php print $ie6_styles; ?>
  <![endif]-->
  <?php print $local_styles; ?>
  <?php print $scripts; ?>
</head>

<body id="<?php print $body_id; ?>" class="<?php print $body_classes; ?>">
  <div id="page" class="page">
    <div id="page-inner" class="page-inner">
      <div id="skip">
        <a href="#main-content-area"><?php print t('Skip to Main Content Area'); ?></a>
      </div>

      <!-- user-bar row: width = grid_width -->
      <div id="user-menu-wrapper" class="full-width">
        <div id="user-menu" class="max-width row inner clearfix">
					<?php print $user_bar; ?>
  			</div><!-- /user-menu-wrapper -->
      </div><!-- /user-menu -->

      <!-- header-group row: width = grid_width -->
      <div id="header-large-wrapper" class="full-width">
        <div id="header-large-inner" class="max-width row inner clearfix">
    			<div id="header-top-region" class="clearfix">
            <?php print $header_top; ?>
    			</div><!-- /header-top-region -->

  				<?php if ($logo): ?>
          <div class="logo">
            <a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
          </div>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
          <div class="slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>

          <?php if ($search_box): ?>
            <?php print drupal_get_form('search_block_form');  ?>
          <?php endif; ?>

    			<div id="header-region">
            <?php print $header; ?>
    			</div><!-- /header-region -->

        </div><!-- /header-large-inner -->
      </div><!-- /header-large-wrapper -->

      <div id="header-small-wrapper" class="full-width">
        <div id="header-small-inner" class="max-width row inner clearfix">
          <div id="header-region-top-following">
    				<?php if ($logo): ?>
            <div class="logo">
              <a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
            </div>
            <?php endif; ?>
            <?php if ($search_box): ?>
              <?php print drupal_get_form('search_block_form'); ?>
            <?php endif; ?>
  					<?php print $header_top_following; ?>
    			</div><!-- /header-region-top-following -->
        </div><!-- /header-small-inner -->
      </div><!-- /header-small-wrapper -->

      <div id="header-region-following" class="full-width">
        <div id="header-region-following-inner" class="max-width row inner clearfix">
					<?php print $header_following; ?>
  			</div><!-- /header-region-following-inner -->
      </div><!-- /header-region-following -->

      <!-- preface-top row: width = grid_width -->
  		<?php print theme('grid_row', $preface_top, 'preface-top', 'full-width', $grid_width); ?>
  		<div id="preface-top-wrapper" class="preface-top-wrapper full-width">
      	<div id="preface-top" class="preface-top row <?php print $grid_width; ?> clearfix">
  				<?php print theme('grid_block', $breadcrumb, 'breadcrumbs'); ?>
        </div>
  		</div>

  		<!-- main row: width = grid_width -->
      <div id="main-wrapper" class="main-wrapper full-width">
        <div id="main" class="main row &lt;?php print $grid_width; ?&gt;">
          <div id="main-inner" class="main-inner inner clearfix">
            <?php if ($content_top || $help || $messages): ?>

            <div id="content-top" class="content-top row nested">
              <div id="content-top-inner" class="content-top-inner inner">
                <?php print theme('grid_block', $help, 'content-help'); ?><?php print theme('grid_block', $messages, 'content-messages'); ?><?php print $content_top; ?>
              </div><!-- /content-top-inner -->
            </div><!-- /content-top -->
            <?php endif; ?><?php if ($content_front_left || $content_front_right): ?>

            <div id="content-front" class="content-front">
              <div id="content-front-inner" class="content-front-inner inner">
                <?php if ($content_front_left): ?>

                <div id="content-front-left" class="content-front-left">
                  <div class="content-inner">
                    <?php print $content_front_left; ?>
                  </div>
                </div><?php endif; ?><?php if ($content_front_right): ?>

                <div id="content-front-right" class="content-front-right">
                  <div class="content-inner">
                    <?php print $content_front_right; ?>
                  </div>
                </div><?php endif; ?>
              </div>
            </div><?php endif; ?><?php print theme('grid_row', $sidebar_first, 'sidebar-first', 'nested', $sidebar_first_width); ?>

            <!-- main group: width = grid_width - sidebar_first_width -->
            <div id="main-group" class="main-group row nested &lt;?php print $main_group_width; ?&gt;">
              <div id="main-group-inner" class="main-group-inner inner">
                <?php print theme('grid_row', $preface_bottom, 'preface-bottom', 'nested'); ?>

                <div id="main-content" class="main-content row nested">
                  <div id="main-content-inner" class="main-content-inner inner">

                    <!-- content group: width = grid_width - (sidebar_first_width + sidebar_last_width) -->
                    <div id="content-group" class="content-group row nested &lt;?php print $content_group_width; ?&gt;">
                      <?php if ($title && !$is_front): ?>

                      <h1 class="title"><?php print $title; ?></h1><?php endif; ?>

                      <div id="content-group-inner" class="content-group-inner inner">
                        <div id="content-region" class="content-region row nested">
                          <div id="content-region-inner" class="content-region-inner inner">
                            <a id="main-content-area"></a>

                            <div id="content-inner" class="content-inner block">
                              <div id="content-inner-inner" class="content-inner-inner inner">
                                <?php print theme('grid_block', $tabs, 'content-tabs'); ?><?php if ($content): ?>

                                <div id="content-content" class="content-content">
                                  <?php print $content; ?><?php print $feed_icons; ?>
                                </div><!-- /content-content -->
                                <?php endif; ?>
                              </div><!-- /content-inner-inner -->
                            </div><!-- /content-inner -->
                          </div><!-- /content-region-inner -->
                        </div><!-- /content-region -->
                        <?php print theme('grid_row', $content_bottom, 'content-bottom', 'nested'); ?>
                      </div><!-- /content-group-inner -->
                    </div><!-- /content-group -->
                    <?php print theme('grid_row', $sidebar_last, 'sidebar-last', 'nested', $sidebar_last_width); ?>
                  </div><!-- /main-content-inner -->
                </div><!-- /main-content -->
                <?php print theme('grid_row', $postscript_top, 'postscript-top', 'nested'); ?>
              </div><!-- /main-group-inner -->
            </div><!-- /main-group -->
          </div><!-- /main-inner -->
        </div><!-- /main -->
      </div><!-- /main-wrapper -->

      <!-- postscript-bottom row: width = grid_width -->
      <?php print theme('grid_row', $postscript_bottom, 'postscript-bottom', 'full-width', $grid_width); ?>

      <!-- footer row: width = grid_width -->
      <?php if ($footer || $footer_message): ?>
			  <?php print theme('grid_row', $footer . $footer_message, 'footer', 'full-width', $grid_width); ?>
	    <?php endif; ?>

    </div><!-- /page-inner -->
  </div><!-- /page -->
  <?php print $closure; ?>
</body>
</html>