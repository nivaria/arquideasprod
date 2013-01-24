<?php
// $Id: page-arqbook.tpl.php
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  
  <link href="/sites/all/libraries/booklet/jquery.booklet.1.4.0.css" type="text/css" rel="stylesheet" media="screen, projection, tv" />
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

  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
  <script src="/sites/all/libraries/booklet/jquery.easing.1.3.js" type="text/javascript"></script>
  <script src="/sites/all/libraries/booklet/jquery.booklet.1.4.0.min.js" type="text/javascript"></script>
  <script type="text/javascript">var switchTo5x=true;</script>
  <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
  <script type="text/javascript">stLight.options({publisher: "229e3f66-d682-4563-a7b5-18c5e67a7e77"});</script>
</head>

<body id="<?php print $body_id; ?>" class="<?php print $body_classes; ?> book">
<!-- <h1 style="font-size: 3em">Area: <?=$area?></h1> -->
  <div id="page" class="page page-full-view">
    <div id="page-inner" class="page-inner">
      <div id="skip">
        <a href="#main-content-area"><?php print t('Skip to Main Content Area'); ?></a>
      </div>

      <!-- preface-top row: width = grid_width -->
      <?php print theme('grid_row', $preface_top, 'preface-top', 'full-width', $grid_width); ?>
      <div id="preface-top-wrapper" class="preface-top-wrapper full-width">
      	<div id="preface-top" class="preface-top row <?php print $grid_width; ?> clearfix">
  				<?php print theme('grid_block', $breadcrumb, 'breadcrumbs'); ?>
				<div class="logo">
		            <a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
		        </div>
        </div>
      </div>

      <!-- main row: width = grid_width -->
      <div id="main-wrapper" class="main-wrapper full-width">
	  	
        <div id="main" class="main row">
		
          <div id="main-inner" class="main-inner inner clearfix">
            <?php if ($content_top || $help || $messages): ?>

            <div id="content-top" class="content-top row nested">
              <div id="content-top-inner" class="content-top-inner inner">
                <?php print theme('grid_block', $help, 'content-help'); ?>
                <?php print theme('grid_block', $messages, 'content-messages'); ?>
                <?php print $content_top; ?>
              </div><!-- /content-top-inner -->
            </div><!-- /content-top -->
            <?php endif; ?>
                
            <!-- main group: width = grid_width - sidebar_first_width -->
            <div id="main-group" class="main-group row nested <?php print $main_group_width; ?>">
              <div id="main-group-inner" class="main-group-inner inner">
                <?php print theme('grid_row', $preface_bottom, 'preface-bottom', 'nested'); ?>

                <div id="main-content" class="main-content row nested">
                  <div id="main-content-inner" class="main-content-inner inner">

                    <!-- content group: width = grid_width - (sidebar_first_width + sidebar_last_width) -->
                    <div id="content-group" class="content-group row nested <?php print $content_group_width; ?>">
                      <div id="content-group-inner" class="content-group-inner inner">
                        <div id="content-region" class="content-region row nested">
                          <div id="content-region-inner" class="content-region-inner inner">
                            <a id="main-content-area"></a>

                            <div id="content-inner" class="content-inner block">
                              <div id="content-inner-inner" class="content-inner-inner inner">
                                <?php print theme('grid_block', $tabs, 'content-tabs'); ?>
                                <div id="content-content" class="content-content">
                                    <!-- Start Book Layout -->
                                    <div id="mybook">
                                        <div>
                                            <div id="general-info">
                                                <?php if(isset($arqbook_image)): ?>
                                                    <?php print $arqbook_image; ?>
                                                <?php endif; ?>
                                                <h1 class="title"><?php print $arqbook_realname; ?></h1>
												<div class="about-me"><?php print $arqbook_i_am; ?></div>
												 <div class="country"><?php print $arqbook_address.' '.$arqbook_country; ?></div>
                                            </div>
											<div class="buttons">
												<ul>
													<!-- <li><a href="">Recomendar CV</a></li> -->
													<li><?php print l(t('Ver perfil en Arquideas'),'user/'.$arqbook_uid,array(
                                                            'attributes' => array(
                                                                'title' => t('Ver perfil en Arquideas'),
                                                                'class' => 'view-profile',
                                                            ),
                                                        )); ?></li>
												</ul>
												
											</div>
                                            <div id="personal-info" class="clearfix">
                                                <div class="company">
                                                    <label>Trabaja en: </label><?php print $arqbook_company; ?>
                                                </div>
                                                <div class="university last">
                                                   	<label>Universidad:</label> <?php print $arqbook_university; ?> (<?php print $arqbook_finished_year; ?>)
                                                </div>
                                                <div class="birthdate">
                                                    <label>Fecha de nacimiento: </label><?php print $arqbook_birthdate; ?>
                                                </div>
                                                <div class="phone last">
                                                     <label>Tel&eacute;fono: </label> <?php print $arqbook_phone; ?>
                                                </div>  
                                                <div class="mail">
                                                     <label>Email: </label> <a href="mailto:<?php print $arqbook_email; ?>"><?php print $arqbook_email; ?></a>
                                                </div>    
                                               <!--  <div class="links">
                                                    <div class="link-profile">
                                                        <?php print l(t('View profile'),'user/'.$arqbook_uid,array(
                                                            'attributes' => array(
                                                                'title' => t('View profile'),
                                                                'class' => 'view-profile',
                                                            ),
                                                        )); ?>
                                                    </div>
                                                </div> -->
                                            </div>
											<div class="clear"></div>
                                            <div id="social-networks" class="clearfix">
                                                <?php if(count($arqbook_social_networks)>0): ?>
												<h3>S&iacute;guelo en:</h3>
                                                <ul class="clearfix">
                                                    <?php 
													$i=0;
													foreach($arqbook_social_networks as $key => $link){ 
													$i++;
													$frst=($i==1)?'first':'';
													?>
                                                    <li class="<?php print $key." ".$frst; ?>">
                                                        <?php print $link; ?>
                                                    </li>    
                                                    <?php } ?>
                                                </ul>
                                                <?php endif; ?>
                                                <div class="clear"></div>
                                                <div class="share-in clearfix">
													<h3>Compartir</h3>
                                                    <span class='st_email_large' displayText='Email'></span>
                                                    <span class='st_facebook_large' displayText='Facebook'></span>
                                                    <span class='st_pinterest_large' displayText='Pinterest'></span>
                                                    <span class='st_twitter_large' displayText='Tweet'></span>
                                                    <span class='st_googleplus_large' displayText='Google +'></span>
                                                    <span class='st_linkedin_large' displayText='LinkedIn'></span>
                                                    <span class='st_stumbleupon_large' displayText='StumbleUpon'></span>
                                                </div>
												<div class="clear"></div>
                                                <div class="url">
                                                    <strong>url:</strong> <?php print $arqbook_page_url; ?>
                                                </div>
                                                <?php //if(isset($arqbook_qrcode)): ?>
                                                    <?php //print $arqbook_qrcode; ?>
                                                <?php //endif; ?>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="description">
                                                <?php print $arqbook_description; ?>    
                                            </div>
                                            <div class="cv">
                                                <?php print $arqbook_cv; ?>    
                                            </div>
                                        </div>
                                        <?php foreach($arqbook_images as $imageobj){ ?>
                                        <div>
                                           <!--  <div class="logo">
                                                <a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
                                            </div> -->
                                            <?php print $imageobj['image']; ?>
                                            <div class="image-title">
                                                <?php print $imageobj['title']; ?> 
                                            </div>
                                            <div class="image-subtitle">
                                                <?php print $imageobj['subtitle']; ?> 
                                            </div>
                                            <div class="image-type">
                                                <?php print $imageobj['type']; ?> 
                                            </div>
                                            <div class="image-contest">
                                                <?php print $imageobj['contest']; ?> 
                                            </div>
                                            <div class="image-prize">
                                                <?php print $imageobj['prize']; ?> 
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>    
                                    <!-- Finish Book Layout -->
                                </div><!-- /content-content -->
                              </div><!-- /content-inner-inner -->
                            </div><!-- /content-inner -->
                          </div><!-- /content-region-inner -->
                        </div><!-- /content-region -->
                        <?php print theme('grid_row', $content_bottom, 'content-bottom', 'nested'); ?>
                      </div><!-- /content-group-inner -->
                    </div><!-- /content-group -->
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

    </div><!-- /page-inner -->
  </div><!-- /page -->
  <?php print $closure; ?>
</body>
<script type="text/javascript">
    $(function(){
        $('#mybook').booklet({
            width: 960,
            height:630,
            pageNumbers: true,
            keyboard: true,
			pagePadding: 40
        });
    });
</script>    
</html>
