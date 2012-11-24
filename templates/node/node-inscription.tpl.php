<?php
// $Id: node.tpl.php 7510 2010-06-15 19:09:36Z sheena $
?>

<?php global $user; ?>

<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">
    <?php print $picture ?>

    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
    
    <?php if ($page == 1 && isset($contest_title)): ?>
    <h1 class="title"><?php print $contest_title ?></h1>
    <?php endif; ?>
    
    <?php if(!$is_edit && $page == 1): ?>
    <div class="contest-info">
    <!-- IMAGE --> 
    <?php 
        if(isset($field_contest_image[0]['filepath']) && !$is_edit){
            $preset = variable_get('nivaria_contests_base_preset_contest_inscription_detail', 'Featured');
            print theme_imagecache($preset, $field_contest_image[0]['filepath'], $contest_title);
        } 
    ?>
    <!-- END IMAGE -->

    <!-- INSCRIPTION LIMIT DATE -->
    <?php
        if(!$is_edit && isset($contest) && $contest->field_contest_state[0]['value']==ContestState::OPEN){
            print show_contest_dates_in_inscription_detail($contest);
        }
    ?>
    <!-- END INSCRIPTION LIMIT DATE -->
    
    <div class="clearfix">&nbsp;</div>
    
    <!-- INSCRIPTION, PAYMENT OR PRESENTATION LINK -->
    <?php
        if(!$is_edit && isset($contest) && $contest->field_contest_state[0]['value']==ContestState::OPEN){
            print '<div class="open-contest-button">'.openContestButton($contest).'</div>'; 
        }    
    ?>
    <!-- END INSCRIPTION, PAYMENT OR PRESENTATION LINK -->
    </div>
    <?php endif; ?>
    
    <?php if(!$is_edit && $page == 1): ?>
    <div class="block">
        <div class="title">
            <h2><?php print t('Form a team and enjoy an collaborative area with all members'); ?></h2>
        </div>
        <div class="block-inner">
            <div class="inscription-info">
                <div class="col01">
                    <!-- Inscription IMAGE-->
                    <?php $preset = variable_get('nivaria_contests_base_preset_inscription_detail', 'Featured');
                    print getInscriptionImage($node, TRUE, TRUE, $preset); ?>
                    <!-- End Inscription IMAGE-->

                    <!-- Inscription TITLE-->
                    <h3 class="title">
                    <?php print $node->title; ?>
                    </h3>
                    <!-- End Inscription TITLE-->

                    <!-- ID of Inscription-->
                    <h3 class="title">
                    <?php print 'ID'.$node->nid; ?>
                    </h3>
                    <!-- End ID of Inscription -->

                    <!-- Description of Inscription-->
                    <?php print $inscription_mission; ?>
                    <!-- END Description of Inscription-->

                    <!-- Edit link -->
                    <?php if(node_access('update', $node) && $node->field_inscription_state[0]['value']!=InscriptionState::SUBMITTED){
                        print l('<span>'.t('Edit inscription').'</span>','node/'.$node->nid.'/edit',array(
                            'attributes' => array(
                                'title' => t('Edit inscription'),
                                'class' => 'edit-content-link',
                            ),
                            'html' => TRUE,
                            'query' => 'destination=user/'.$user->uid.'/account/inscriptions/'.$node->nid,
                        ));
                    } ?>
                    <!-- End Edit link -->
                </div>
                <div class="col02">
                    <h3 class="title"><?php print t('Team members'); ?></h3>
                    <!-- Team members -->
                    <?php print views_embed_view('og_members_faces', 'default', $node->nid); ?> 
                    <!-- END Team members -->

                    <!-- Manage members link -->
                    <?php if(node_access('update', $node) && og_is_group_admin($node) && module_exists('og_manage_link') && $node->field_inscription_state[0]['value']!=InscriptionState::SUBMITTED){
                        $cnid = $node->field_contest[0]['nid'];
                        $cnode = node_load($cnid);
                        if(!empty($cnode) && $cnode->field_contest_state[0]['value']==ContestState::OPEN){
                            if($node->field_inscription_state[0]['value']==InscriptionState::INSCRIPTED || $node->field_inscription_state[0]['value']==InscriptionState::SUBMITTED){
                                //Gets order to see if it is individual
                                $order_id = $node->field_inscription_order[0]['value'];
                                if(!empty($order_id)){
                                    $order = uc_order_load($order_id);
                                    $product_attr = $order->products[0]->data['attributes'];
                                    if(empty($product_attr)){
                                        print '<div class="info">'.t('You have made individual payment and can\'t invite other members.').'</div>';
                                    } else {
                                        print theme_og_manage_link_default($node);
                                    }
                                } else {
                                    print theme_og_manage_link_default($node);
                                }    
                            } else {
                                print theme_og_manage_link_default($node);
                            }
                        } else {
                            print '<div class="info">'.t('Contest is now in progress. You can not invite new members now.').'</div>';
                        }    
                    } ?>
                    <!-- END Manage members link -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- DOWNLOAD files -->
    <?php print show_inscription_downloads($node, $contest); ?>
    <!-- End DOWNLOAD files -->
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

  <?php $cnid = !empty($node->field_contest[0]['nid'])?$node->field_contest[0]['nid']:-1;
  $cnode = node_load($cnid);
  $cstate = !empty($cnode->field_contest_state[0]['value'])?$cnode->field_contest_state[0]['value']:NULL;
  if(!empty($cnode) && $cstate==ContestState::OPEN && !og_is_group_member($node)): ?>
  <div class="subscribe-og">
      <?php print og_subscribe_link($node); ?>
  </div>    
  <?php endif; ?>
  
  <?php if ($node_bottom && !$teaser): ?>
  <div id="node-bottom" class="node-bottom row nested">
    <div id="node-bottom-inner" class="node-bottom-inner inner">
      <?php print $node_bottom; ?>
    </div><!-- /node-bottom-inner -->
  </div><!-- /node-bottom -->
  <?php endif; ?>
</div><!-- /node-<?php print $node->nid; ?> -->
