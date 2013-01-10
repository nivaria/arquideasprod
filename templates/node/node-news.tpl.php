<?php
// $Id: node-news.tpl.php 7510 2010-06-15 19:09:36Z sheena $
  $fields = content_types($node->type);
  if (!empty($fields) && !empty($fields['fields'])) {?>
    <!-- Fields of <?php print $node->type ?>:
    <?php foreach ($fields['fields'] as $field) {
      print $field['field_name'];?>

    <?php }?>
        -->
<?php }?>
<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">
    <?php print $picture ?>

    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
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
      <div class="userpicture">
          <?php
            $account = user_load($node->uid);
            if(!empty($account->picture)){
                print theme_imagecache('user_picture_meta', $account->picture, $realname);
            }
          ?>
      </div>
      <div class="comments-count">
          <?php /*print $comment_count*/
             print $comment_count;
          ?>
      </div>
      <div class="submitted">
          <?php /*print $submitted*/
             print t('Send by !name', array('!name' => l($realname,'user/'.$node->uid)));
          ?>
      </div>
      <div class="userpoints">
          <?php
            $user_badges = user_badges_get_badges($node->uid);
            if(count($user_badges)>0){
               foreach($user_badges as $key => $badge){
                  print theme('user_badge', $badge, $account);
                  break;
               }
            }
          ?>
          &nbsp;
          <?php print t('!points points', array('!points' => userpoints_get_current_points($node->uid))); ?>
      </div>
    </div>
    <?php endif; ?>

    <div class="date">
        <?php
          print $field_date_news_rendered;
        ?>
    </div>

    <?php if ($terms): ?>
    <div class="terms">
      <?php print $terms; ?>
    </div>
    <?php endif;?>

    <div class="content clearfix">
      <?php /*print $field_type_news_rendered*/ ?>

      <!-- Image slideshow -->
      <?php print views_embed_view('arquideas_news_slideshow', 'default', $node->nid); ?>
      <!-- End image slideshow -->

      <?php /*print $field_highlighted_text_news_rendered*/ ?>
      <?php print $node->content['body']['#value'] ?>
    </div>

    <div class="social-widgets">
      <!-- FiveStar Widget -->
      <?php
        if (user_access('rate content') && fivestar_validate_target('node', $node->nid)) {
            print fivestar_widget_form($node);
        }
      ?>
      <!-- END FiveStar Widget -->

      <!-- SHARE SOCIAL BLOCK -->
      <?php
        $block = module_invoke('arquideas_generic', 'block', 'view', '13');
        print $block['content'];
      ?>
      <!-- END SHARE SOCIAL BLOCK -->
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
<?