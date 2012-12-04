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

    <div class="content clearfix">
      
      <?php print $node->content['body']['#value'] ?>
            
      <?php if($general_newsletter): ?>
            <!-- Contests block -->
            <?php if($field_simplenews_last_contests[0]['value']==1): ?>
                <div class="simplenews-last-contests-block block">
                    <div class="inner clearfix">
                        <h2 class="title block-title">
                            <?php print t('Upcoming Contests'); ?>
                        </h2>
                        <div class="content">
                            <?php print views_embed_view('arquideas_newsletter_contest_bl', 'default'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- End Contests block -->
            
            <!-- News block -->
            <?php if($field_simplenews_news[0]['value']==1): ?>
                <div class="simplenews-news-block block">
                    <div class="inner clearfix">
                        <h2 class="title block-title">
                            <?php print t('News'); ?>
                        </h2>
                        <div class="content">
                            <?php print views_embed_view('arquideas_newsletter_news_block', 'default'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- End News block -->
            
            <!-- KM block -->
            <?php if($field_simplenews_group_content[0]['value']==1): ?>
                <div class="simplenews-km-block block">
                    <div class="inner clearfix">
                        <h2 class="title block-title">
                            <?php print t('Arquideas Community'); ?>
                        </h2>
                        <div class="content">
                            <?php print views_embed_view('arquideas_newsletter_km_block', 'default'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- End KM block -->
            
            <!-- Partners & Co block -->
            <?php if($field_simplenews_send_partners[0]['value']==1): ?>
                <div class="simplenews-partners-block block">
                    <div class="inner clearfix">
                        <h2 class="title block-title">
                            <?php print t('PARTNERS & Co'); ?>
                        </h2>
                        <div class="content">
                            <?php print views_embed_view('arquideas_newsletter_partners_bl', 'default'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- End Partners & Co block -->
      <?php else: ?>
            <!-- Partners & Co block -->
            <div class="simplenews-partners-block block">
                <div class="inner clearfix">
                        <h2 class="title block-title">
                            <?php print t('PARTNERS & Co'); ?>
                        </h2>
                        <div class="content">
                            <?php print views_embed_view('arquideas_newsletter_partners_nl', 'default', $node->nid); ?>
                        </div>
                </div>
            </div>
            <!-- End Partners & Co block -->
      <?php endif; ?>
    </div>
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