<?php

/**
 * @file search-result.tpl.php
 * Default theme implementation for displaying a single search result.
 *
 * This template renders a single search result and is collected into
 * search-results.tpl.php. This and the parent template are
 * dependent to one another sharing the markup for definition lists.
 *
 * Available variables:
 * - $url: URL of the result.
 * - $title: Title of the result.
 * - $snippet: A small preview of the result. Does not apply to user searches.
 * - $info: String of all the meta information ready for print. Does not apply
 *   to user searches.
 * - $info_split: Contains same data as $info, split into a keyed array.
 * - $type: The type of search, e.g., "node" or "user".
 *
 * Default keys within $info_split:
 * - $info_split['type']: Node type.
 * - $info_split['user']: Author of the node linked to users profile. Depends
 *   on permission.
 * - $info_split['date']: Last update of the node. Short formatted.
 * - $info_split['comment']: Number of comments output as "% comments", %
 *   being the count. Depends on comment.module.
 * - $info_split['upload']: Number of attachments output as "% attachments", %
 *   being the count. Depends on upload.module.
 *
 * Since $info_split is keyed, a direct print of the item is possible.
 * This array does not apply to user searches so it is recommended to check
 * for their existance before printing. The default keys of 'type', 'user' and
 * 'date' always exist for node searches. Modules may provide other data.
 *
 *   <?php if (isset($info_split['comment'])) : ?>
 *     <span class="info-comment">
 *       <?php print $info_split['comment']; ?>
 *     </span>
 *   <?php endif; ?>
 *
 * To check for all available data within $info_split, use the code below.
 *
 *   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
 *
 * @see template_preprocess_search_result()
 */
?>
<li>
  <?php if(isset($result['node']->nid)): ?>
     <?php print nodetype_apachesolr_get_node_image($result['node']->nid,'user_picture_meta'); ?> 
     <h2 class="title">
     <?php
        $username = $result['node']->name;
        if(isset($result['node']->realname)){
            $username = $result['node']->realname;
        } else {
            if(isset($result['node']->profile_name) && isset($result['node']->profile_last_name)){
                $username = $result['node']->profile_name . ' ' . $result['node']->profile_last_name;
            } else {
                $node = node_load($result['node']->nid);
                if($node && isset($node->field_name_acp) && isset($node->field_surname_acp)){
                    $username = $node->field_name_acp . ' ' . $node->field_surname_acp;
                }
            }
        }
        print l($username,'user/'.$result['node']->uid,array(
         'attributes' => array(
            'title' => $username,
            'class' => 'user-'.$result['node']->uid, 
          ),
        )); ?> 
     </h2>
  <?php else: ?>
    <h2 class="title">
    <a href="#" title=""><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php if(isset($result['node']->nid)): ?>
    <div class="job">
        <?php
            $jobname = '';
            if(!empty($result['node']->profile_job)){
                $jobname = $result['node']->profile_job;
            } else {
                $node = node_load($result['node']->nid);
                if($node && !empty($node->field_trabajo_como_acp)){
                    $jobname = $node->field_trabajo_como_acp;
                }
            }
            print $jobname;
        ?>
    </div>
  <?php endif; ?>
</li>
