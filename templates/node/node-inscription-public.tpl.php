<?php
// $Id: node.tpl.php 7510 2010-06-15 19:09:36Z sheena $
?>

<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">
    <?php print $picture ?>

    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
    
    <?php if ($page == 1 && isset($contest_title)): ?>
    <h1 class="title"><?php print $contest_title ?></h1>
    <?php endif; ?>
    
    <!-- NAVIGATION -->
    <?php print arquideas_generic_get_inscription_detail_navigation($node); ?>
    <!-- END NAVIGATION -->
    
    <!-- ADDTHIS widget -->
    <?php
        $block = module_invoke('arquideas_generic', 'block', 'view', '13');
        print $block['content'];
    ?>
    <!-- END ADDTHIS widget -->
    
    <?php if(!$is_edit && $page == 1): ?>
    <div class="inscription-info-public">
        <div class="col01">
            <!-- Inscription TITLE-->
            <h2 class="title">
            <?php print $node->title; ?>
            </h2>
            <!-- End Inscription TITLE-->
            
            <!-- ID of Inscription-->
            <h2 class="title">
            <?php print 'ID'.$node->nid; ?>
            </h2>
            <!-- End ID of Inscription -->
            
            <!-- FiveStar Widget --> 
            <?php 
            $flag = flag_get_flag('finalist');
            if($contest->field_contest_state[0]['value']==ContestState::PUBLIC_CONTEST && $flag->is_flagged($node->nid)){
                if (user_access('rate content') && fivestar_validate_target('node', $node->nid)) {
                    print fivestar_widget_form($node);
                }
            }    
            if($contest->field_contest_state[0]['value']==ContestState::FINISHED && $flag->is_flagged($node->nid)){
                if (fivestar_validate_target('node', $node->nid)) {
                    print fivestar_static('node', $node->nid, 'vote', 'inscription');
                }    
            }
            ?>
            <!-- END FiveStar Widget -->
            
            <!-- University and Country -->
            <div class="university-country">
            <?php 
                $univ_country = '';
                if(!empty($field_inscription_university[0]['view'])){
                    $univ_country .= $field_inscription_university[0]['view'];
                }
                if(!empty($field_inscription_country[0]['view'])){
                    $univ_country .= ($univ_country!=''?' / ':'').theme('countryicons_icon',  strtolower($field_inscription_country[0]['value'])).' '.$field_inscription_country[0]['view'];
                }
                print  $univ_country; 
            ?>
            </div>    
            <!-- End University and Country -->
            
            <!-- Number of members -->
            <div class="number-members">
                <?php
                    $members = contest_notifications_get_group_members($node);
                    print count($members).' '.t('members');
                ?>
            </div>
            <!-- END Number of members -->
            
            <!-- Team members -->
            <?php print views_embed_view('og_members_faces', 'block_1', $node->nid); ?> 
            <!-- END Team members -->
            
            <!-- Description of Inscription-->
            <?php print $inscription_mission; ?>
            <!-- END Description of Inscription-->
            
            <!-- DOWNLOAD files -->
            <?php print show_inscription_downloads($node, $contest); ?>
            <!-- End DOWNLOAD files -->
            
            <!-- Votation period -->
            <div class="public-voting-interval clearfix">
                <?php print show_public_vote_contest_date($contest); ?>
            </div>
            <!-- End Votation period -->
            
        </div>
        <div class="col02">
            <!-- Inscription IMAGES -->
            <?php $preset = variable_get('nivaria_contests_base_jpgpreset', 'Featured');
            print getInscriptionImage($node, TRUE, FALSE, $preset); ?>
            <!-- End Inscription IMAGES -->
            
        </div>
    </div>
    <?php endif; ?>
    
    
    <?php if ($node_top && !$teaser): ?>
    <div id="node-top" class="node-top row nested">
      <div id="node-top-inner" class="node-top-inner inner">
        <?php print $node_top; ?>
      </div><!-- /node-top-inner -->
    </div><!-- /node-top -->
    <?php endif; ?>

    <?php if ($submitted): ?>
    <div class="meta">
      <span class="submitted"><?php print $submitted ?></span>
    </div>
    <?php endif; ?>

    <?php if ($terms): ?>
    <div class="terms">
      <?php print $terms; ?>
    </div>
    <?php endif;?>
    
        <div class="content clearfix<?php print ($node_right && !$teaser?' node-right':''); ?>">
        <div class="node-content-main">  
            <?php if ($page == 0){print $content;} ?>
        </div>
        <?php if ($node_right && !$teaser): ?>
        <div class="node-right">
            <div class="node-right-inner inner">
                <?php print $node_right; ?>
            </div><!-- /node-right-inner -->
        </div><!-- /node-right -->
        <?php endif; ?>
    </div>

    <?php if ($page==0 && $links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
    <?php endif; ?>
  </div><!-- /inner -->

  <?php if ($node_bottom && !$teaser): ?>
  <div id="node-bottom" class="node-bottom row nested">
    <div id="node-bottom-inner" class="node-bottom-inner inner">
      <?php print $node_bottom; ?>
    </div><!-- /node-bottom-inner -->
  </div><!-- /node-bottom -->
  <?php endif; ?>
</div><!-- /node-<?php print $node->nid; ?> -->
