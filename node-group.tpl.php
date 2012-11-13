<?php
// $Id: node-group.tpl.php 7510 2010-06-15 19:09:36Z sheena $
?>

<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">

    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
    
    <!-- Short Group Description -->
    <?php if ($page == 1): ?>
    <div class="og-description">
        <?php print $og_description; ?>
    </div>    
    <?php endif; ?>
    <!-- End Short Group Description -->

    <?php if ($node_top && !$teaser): ?>
    <div id="node-top" class="node-top row nested">
      <div id="node-top-inner" class="node-top-inner inner">
        <?php print $node_top; ?>
      </div><!-- /node-top-inner -->
    </div><!-- /node-top -->
    <?php endif; ?>
    
    <!-- BLOCK USERS TOTAL -->
  <?php if($page && !$is_edit){
    $block_user_total = module_invoke('arquideas_generic','block','view','1');
    print $block_user_total['content'];
  }
  ?>
  <!-- END BLOCK USERS TOTAL -->
  
  <!-- BLOCK JOIN NETWORK -->
  <?php if($page && !$is_edit){
    $block_join_network = module_invoke('arquideas_generic','block','view','2');
    print $block_join_network['content'];
  }
  ?>
  <!-- END BLOCK JOIN NETWORK -->
  
  <!-- BLOCK ADDTHIS -->
  <?php if($page && !$is_edit){
    $block_addthis = module_invoke('addthis','block','view','0');
    print $block_addthis['content'];
  }
  ?>
  <!-- END BLOCK ADDTHIS -->
  
  <!-- COUNT GROUP MEMBERS -->
  <?php
    $members = contest_notifications_get_group_members($node);
  ?>
  <?php if($page && !$is_edit): ?>
  <div class="group-members-count">
      <span>
          <?php print count($members).' '.t('in this group'); ?>
      </span>
  </div>
  <?php endif; ?>
  <!-- END COUNT GROUP MEMBERS -->
  

    <div class="content clearfix">
      <?php if($page && !$is_edit){print $content;} ?>
        
      <?php 
        $subgroups = og_subgroups_get_group_children($node,FALSE);
        if(isset($subgroups) && count($subgroups)>0){
           $strvalsg = ''; 
           foreach($subgroups as $subnid => $subgroup){
              $strvalsg .= ($strvalsg!==''?', ':'').l($subgroup->title,'node/'.$subnid,array(
                 'attributes' => array(
                     'title' => $subgroup->title,
                 ),
              )); 
           } ?>
           <div class="terms">
           <h4><?php print t('Subgroups'); ?>: </h4>
           <?php print $strvalsg; ?>
           </div>
      <?php
        }
      ?>  
      <?php if ($terms): ?>
        <div class="terms">
    	  <h4>Tags:</h4>
          <?php print $terms; ?>
         </div>
      <?php endif;?>
    </div>
    
    <!-- Edit link -->
    <?php if(isset($node->content['nivaria_edit_content_link']) && !empty($node->content['nivaria_edit_content_link']['#value'])): ?>
    <div class="node-edit-link">
        <?php print $node->content['nivaria_edit_content_link']['#value']; ?>
    </div>
    <?php endif; ?>
    <!-- End Edit link -->

    <!-- Translate link -->
    <?php if(isset($node->content['nivaria_translate_content_link']) && !empty($node->content['nivaria_translate_content_link']['#value'])): ?>
    <div class="node-translate-link">
        <?php print $node->content['nivaria_translate_content_link']['#value']; ?>
    </div>
    <?php endif; ?>
    <!-- End Translate link -->

    <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
    <?php endif;?>
    </div>
    
    <!-- JOIN GROUP OR LEAVE GROUP BUTTON -->
    <?php if($page && !$is_edit): 
        if(og_is_group_member($node,FALSE)): ?>
                <div class="og-buttons">
                <?php global $user;
                    if(og_menu_access_unsubscribe($node)){
                        print l('<span>'.t('Leave').'</span>','og/unsubscribe/'.$node->nid.'/'.$user->uid,array(
                            'attributes' => array(
                                'title' => t('Leave this group'),
                                'class' => 'og-unsubscribe-button',
                                'rel' => 'nofollow',
                            ),
                            'html' => TRUE,
                            'query' => drupal_get_destination(),
                        ));
                    }?>
                </div>    
    <?php 
        else: ?>    
            <div class="og-buttons"> 
            <?php print og_subscribe_link($node); ?>
            </div>    
    <?php 
        endif;
    endif; ?>
    <!-- END JOIN GROUP OR LEAVE GROUP BUTTON -->
    
    <!-- /inner -->

    <?php if($page){
        /*$node_bottom .= '<div class="two-columns">';
        $node_bottom .= '<div class="column-1">';
        $block_notif = module_invoke('notifications_ui','block','view','0');
        $node_bottom .= '<div id="block-notifications_ui-0" class="block block-notifications_ui">';
        $node_bottom .= '<div class="inner clearfix">';
        $node_bottom .= '<h2 class="title block-title collapsiblock">';
        $node_bottom .= $block_notif['subject']; 
        $node_bottom .= '</h2>';
        $node_bottom .= '<div class="content">';
        $node_bottom .= $block_notif['content']; 
        $node_bottom .= '</div>';
        $node_bottom .= '</div>';
        $node_bottom .= '</div>';
        $node_bottom .= '</div>';
        $node_bottom .= '<div class="column-2">';
        $block_featured = module_invoke('views','block','view','29a6f88b4b3b4e056713daa56b994c9e');
        $node_bottom .= '<div id="block-views-29a6f88b4b3b4e056713daa56b994c9e" class="block block-views">';
        $node_bottom .= '<div class="inner clearfix">';
        $node_bottom .= '<h2 class="title block-title collapsiblock">';
        $node_bottom .= $block_featured['subject']; 
        $node_bottom .= '</h2>';
        $node_bottom .= '<div class="content">';
        $node_bottom .= $block_featured['content']; 
        $node_bottom .= '</div>';
        $node_bottom .= '</div>';
        $node_bottom .= '</div>';
        $node_bottom .= '</div>';
        $node_bottom .= '</div>';*/
    } ?>
    
    
  <?php if ($node_bottom && !$teaser): ?>
  <div id="node-bottom" class="node-bottom row nested">
    <div id="node-bottom-inner" class="node-bottom-inner inner">
      <?php print $node_bottom; ?>
    </div><!-- /node-bottom-inner -->
  </div><!-- /node-bottom -->
  <?php endif; ?>
</div>
