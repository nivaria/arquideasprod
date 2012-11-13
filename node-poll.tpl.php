<?php
/**
 * @file node-poll.tpl.php
 * 
 * Og has added a brief section at bottom for printing links to affiliated groups.
 * This template is used by default for non group nodes.
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>

<?php if ($page): ?>
<div class="buildmode-full">
<?php endif; ?>
<div id="node-<?php print $node->nid; ?>" class="node node-type-poll odd full-node <?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clear-block">
<?php if ($page): ?>
<div class="nd-region-header clear-block">
<?php endif; ?>
    
<?php if (!$page): ?>
    <?php print $picture ?>
    <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <div class="meta">
    <?php if ($submitted): ?>
        <span class="submitted"><?php print $submitted ?></span>
    <?php endif; ?>

    <?php if ($terms): ?>
        <div class="terms terms-inline"><h4>Tags:</h4><?php print $terms ?></div>
    <?php endif;?>
    </div>
<?php endif; ?>

<?php if ($page): ?>
    <div class="field field-category-poll">
        <div class="field-items">
            <div class="field-item odd">
                <?php if($node->field_category_poll[0]["value"]==25){ ?>
                <a href="/category/categoria/encuestas/encuesta" rel="tag" title="">Encuesta</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="field field-ds-group-ds-node-date-type-vote field-group">
        <div class="field field-date-author-info">
            <div class="field-items">
                <div class="field-item odd">
                    <?php print views_embed_view('node_date_author', 'default', $node->nid); ?>
                </div>
            </div>    
        </div>
        
    </div>
    <?php if ($node->og_groups) { ?>
        <div class="field field-ds-og-groups">
            <div class="field-label-inline-first">En: </div>
            <?php print $og_links['view']; ?>
        </div>
    <?php } ?>
    <div class="field field-terms">
        <div class="field-label-inline-first">Etiquetas: </div>
        <?php print $terms ?>
    </div>
<?php endif; ?>

    <div class="content clearfix<?php print ($node_right && !$teaser?' node-right':''); ?>">
        <div class="node-content-main">  
            <?php print $content ?>
        </div>
        <?php if ($node_right && !$teaser): ?>
        <div class="node-right">
            <div class="node-right-inner inner">
                <?php print $node_right; ?>
            </div><!-- /node-right-inner -->
        </div><!-- /node-right -->
        <?php endif; ?>
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

<?php if ($page): ?>    
 <div class="field field-links">
     <div class="field-label">Crea tu vigilancia: </div>
     <?php print $links; ?>
 </div> 
<?php endif; ?>
  
<?php if ($page): ?>
</div>
<?php endif; ?>  
</div>
<?php if ($page): ?>
</div>
<?php endif; ?>
