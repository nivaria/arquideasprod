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
      <span class="submitted"><?php /*print $submitted*/ ?></span>
    </div>
    <?php endif; ?>

    <?php if ($terms): ?>
    <div class="terms">
      <?php print $terms; ?>
    </div>
    <?php endif;?>

    <div class="content clearfix">
        <div class="colaborator-top">
           <?php print theme_imagecache('image_220_220', $field_square_image_col[0]['filepath'], $node->title); ?>
            <h1 class="title"><?php print $node->title; ?></h1>
            <div class="short-description">
            <?php print $field_short_description[0]['value']; ?>
            </div>
            <?php print $field_link_col_rendered; ?>
            <?php print $field_colaborator_type_col_rendered; ?>
            <?php if(!empty($node->field_colaborator_user[0]['uid'])): ?>
            <div class="user-profile">
                <?php print l(t('View profile in Arquideas Network'), 'user/'.$node->field_colaborator_user[0]['uid'], array(
                    'attributes' => array(
                        'title' => t('View profile in Arquideas Network'),
                    ),
                )); ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="colaborator-comment">
           <div class="comment-title">
           <?php print $field_comment_title_col[0]['safe']; ?>
           </div>
           <div class="comment-body">
           <?php print $field_comment_body_col[0]['safe']; ?>
           </div>
        </div>
        <div class="colaborator-presentation">
            <h2><?php print t('Presentation'); ?></h2>
            <?php print $node->content['body']['#value'] ?>
        </div>
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