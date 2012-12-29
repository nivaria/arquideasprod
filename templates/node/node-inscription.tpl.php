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
    <!-- Identifier Code -->
    <div class="inscription-code">
        <?php print t('Your identifier is !code',array('!code' => $node->field_inscription_code[0]['value'])); ?>
    </div>
    <!-- Identifier Code -->
        
    <!-- IMAGE --> 
    <?php 
        if(isset($field_contest_image[0]['filepath']) && !$is_edit){
            $preset = 'inscriptions_336_162';
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
    
    <!-- INSCRIPTION, PAYMENT OR PRESENTATION LINK -->
    <?php
        if(!$is_edit && isset($contest) && $contest->field_contest_state[0]['value']==ContestState::OPEN && $node->field_inscription_state[0]['value']!=InscriptionState::PREINSCRIPTED){
            print '<div class="open-contest-button">'.openContestButton($contest).'</div>'; 
        }    
    ?>
    <!-- END INSCRIPTION, PAYMENT OR PRESENTATION LINK -->
    
    <div class="clearfix">&nbsp;</div>
    
    <!-- Introduction text -->
    <?php if(($node->field_inscription_state[0]['value']==InscriptionState::PREINSCRIPTED && $num_members>1) 
            || $node->field_inscription_state[0]['value']!=InscriptionState::PREINSCRIPTED): ?>
    <div class="two-columns">
        <div class="column-01">
            <h3 class="title"><?php print t('Team members'); ?></h3>
            <!-- Team members -->
            <?php print views_embed_view('og_members_faces', 'default', $node->nid); ?> 
            <!-- END Team members -->
        </div>
        <div class="column-02">
            <?php
                $block = module_invoke('nodeblock', 'block', 'view', 868);
                print '<div class="block block-nodeblock"><div class="inner clearfix"><div class="content">'.$block['content'].'</div></div></div>';
            ?>
        </div>
    </div>
    
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
            print '<div class="info">'.t('You can not invite members at this stage of the competition').'</div>';
        }    
    } ?>
    <!-- END Manage members link -->
    <?php endif; ?>
    
    <?php if($node->field_inscription_state[0]['value']==InscriptionState::PREINSCRIPTED && $num_members==1): ?>
    <div class="introduction">
        <?php print t('You can participate in this contest as individuals or form your group'); ?>
    </div>
    
    <div class="clearfix">&nbsp;</div>
    
    <div class="two-columns">
        <div class="column-01">
            <?php
                $block = module_invoke('nodeblock', 'block', 'view', 863);
                print '<div class="block block-nodeblock"><div class="inner clearfix"><h2 class="title block-title">'.$block['subject'].'</h2><div class="content">'.$block['content'].'</div></div></div>';
            ?>
        </div>
        <div class="column-02">
            <?php
                $block = module_invoke('nodeblock', 'block', 'view', 865);
                print '<div class="block block-nodeblock"><div class="inner clearfix"><h2 class="title block-title">'.$block['subject'].'</h2><div class="content">'.$block['content'].'</div></div></div>';
            ?>
        </div>
    </div>
    
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
            print '<div class="info">'.t('You can not invite members at this stage of the competition').'</div>';
        }    
    } ?>
    <!-- END Manage members link -->
    <?php endif; ?>
    <!-- End Introduction text -->

    
    <!-- INSCRIPTION, PAYMENT OR PRESENTATION LINK -->
    <?php
        if(!$is_edit && isset($contest) && $contest->field_contest_state[0]['value']==ContestState::OPEN && $node->field_inscription_state[0]['value']==InscriptionState::PREINSCRIPTED){
            print '<div class="open-contest-button">'.openContestButton($contest).'</div>'; 
        }    
    ?>
    <!-- END INSCRIPTION, PAYMENT OR PRESENTATION LINK -->
    
    <div class="clearfix">&nbsp;</div>
    
    <!-- Mark Special Arquideas Prize -->
    <?php if($contest->field_contest_state[0]['value']==ContestState::FINISHED && user_access(PERM_ADMIN_CONTESTS)) : ?>
    <div class="link-special-arquideas-prize">
        <?php print flag_create_link('arquideas_prize', $node->nid); ?>
    </div>
    <?php endif; ?>
    <!-- End Mark Special Arquideas Prize -->
    </div>
    <?php endif; ?>
    
    <?php if(!$is_edit && $page == 1): ?>
        <!-- Edit link -->
        <?php if(node_access('update', $node) && $node->field_inscription_state[0]['value']!=InscriptionState::SUBMITTED
                && isset($contest) && $contest->field_contest_state[0]['value']==ContestState::OPEN){
            $uid = $user->uid;
            if(!og_is_group_member($node->nid)){
                $uid = $node->uid;
            }
            print l('<span>'.t('Edit inscription').'</span>','node/'.$node->nid.'/edit',array(
                'attributes' => array(
                    'title' => t('Edit inscription'),
                    'class' => 'edit-content-link',
                ),
                'html' => TRUE,
                'query' => 'destination=user/'.$uid.'/account/inscriptions/'.$node->nid,
            ));
        } ?>
        <!-- End Edit link -->

        <!-- Delete link -->
        <?php if(node_access('delete', $node) && $node->field_inscription_state[0]['value']!=InscriptionState::SUBMITTED
                && isset($contest) && $contest->field_contest_state[0]['value']==ContestState::OPEN){

            print l('<span>'.t('Unsubscribe').'</span>','node/'.$node->nid.'/delete',array(
                'attributes' => array(
                    'title' => t('Delete inscription'),
                    'class' => 'delete-content-link',
                ),
                'html' => TRUE,
            ));
        } ?>
        <!-- End Delete link -->

        <!-- DOWNLOAD files -->
        <?php print show_inscription_downloads($node, $contest); ?>
        <!-- End DOWNLOAD files -->
    <?php endif; ?>
        
    <?php if($node->field_inscription_state[0]['value']==InscriptionState::PREINSCRIPTED && $num_members==1): ?>
        <!-- THIS DIV MUST BE POSITIONED OVER THE WALL -->
        <div class="inscription-wall-overlay">
            <div class="inner clearfix">
                <?php print t('Form a team and enjoy an collaborative area with all members'); ?>
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
