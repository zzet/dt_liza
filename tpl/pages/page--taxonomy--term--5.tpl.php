<? global $language; ?>
<div id="second-main">
  <div id="header">
    <div id="linkhead">
      <a href="/"><div class="lmain">Home</div></a>
      <div id="top_menu">
        <a href="/<?= drupal_get_path_alias('taxonomy/term/2', $language->language); ?>"><div class="l"></div></a>
        <a href="/<?= drupal_get_path_alias('taxonomy/term/3', $language->language); ?>"><div class="i"></div></a>
        <a href="/<?= drupal_get_path_alias('taxonomy/term/1', $language->language); ?>"><div class="s"></div></a>
        <a href="/<?= drupal_get_path_alias('taxonomy/term/4', $language->language); ?>"><div class="a"></div></a>
        <a href="/<?= drupal_get_path_alias('taxonomy/term/5', $language->language); ?>"><div class="v"></div></a>
        <a href="mailto:lizaveta.exe@gmail.com"><div class="e"></div></a>
        <a href="/<?= drupal_get_path_alias('taxonomy/term/6', $language->language); ?>"><div class="t"></div></a>
        <a href="/<?= drupal_get_path_alias('node/7', $language->language); ?>"><div class="a2"></div></a>
      </div>
      <a href="/"><div id="twitter_link"></div></a>
    </div>
  </div>


  <div id="page">
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php print render($primary_local_tasks); ?>
    <?php print render($secondary_local_tasks); ?>

    <div id="content" class="clearfix">
      <div class="element-invisible"><a id="main-content"></a></div>
      <?php if ($messages): ?>
        <div id="console" class="clearfix"><?php print $messages; ?></div>
      <?php endif; ?>
      <?php if ($page['help']): ?>
        <div id="help">
          <?php print render($page['help']); ?>
        </div>
      <?php endif; ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php //print render($page['content']); ?>
      <?php
      /*
       * To change this template, choose Tools | Templates
       * and open the template in the editor.
       */

      $page = 0;
      if (isset($_REQUEST['page'])) {
        $page = (int) $_REQUEST['page'];
      }
      $num_per_page = 6;

      $offset = $num_per_page * $page;

      $return = '<div id="works_wrapper">';
      // select last work nodes
      $query = db_select('node', 'n');
      // we need nid to link
      $query->addField('n', 'nid');
      // we need only work nodes
      $query->condition('n.type', 'work');
      // view our term
      $query->join('field_data_field_work_category', 'fwc', 'fwc.entity_id = n.nid');
      // and table with term onformation
      $query->join('taxonomy_term_data', 't', 't.tid = fwc.field_work_category_tid');
      // where
      $query->condition('t.tid', '5')
        // sort by create date
        ->orderBy('n.created')
        // we group nid by id (if have multiple images or term)
        ->groupBy('n.nid');
      // we need last 6 nodes
      $query_count = $query;
      // view count of nodes
      $maxcount = $query_count->range($offset, $num_per_page)->execute()->rowCount();
      // prepare pager
      $page = pager_default_initialize($maxcount, $num_per_page);
      // Aliase to image query
      $query_aliase_image = $query;
      // Aliase to term query
      $query_aliase_category = $query;
      // on image we have a title of work
      $query->addField('n', 'title');
      // get works date
      $res = $query->execute();
      // to our nodes join tables with image work information
      $query_aliase_image->innerJoin('field_data_field_work_file', 'fwf', 'fwf.entity_id = n.nid');
      // also we need table with information about files
      $query_aliase_image->innerJoin('file_managed', 'f', 'f.fid = fwf.field_work_file_fid');
      // we select fields title and atl of image
      $query_aliase_image->fields('fwf', array('field_work_file_title', 'field_work_file_alt'));
      // and we select uri path to file
      $query_aliase_image->addField('f', 'uri', 'uri');
      // get all data
      $images = $query_aliase_image->execute()->fetchAll();
      // to term we need table of term infirmation
      $query_aliase_category->join('field_data_field_work_category', 'fwc', 'fwc.entity_id = n.nid');
      // and table with term onformation
      $query_aliase_category->join('taxonomy_term_data', 't', 't.tid = fwc.field_work_category_tid');
      // we selecct name and tid (to link generate)
      $query_aliase_category->fields('t', array('name', 'tid'));
      // get all data
      //$db_result = db_query_range($sql, $offset, $num_per_page);

      $terms = $query_aliase_category->execute()->fetchAll();
      //$db_query = db_query($query);

      $i = 0;
      while ($row = $res->fetchAssoc()) {
        $return .= '<figure>
<div class="preview_work_block">
  <div class="preview_work_top">

      <a href="/' . drupal_get_path_alias('node/' . $row['nid'], $language->language) . '"><img src="' . image_style_url('front', $images[$i]->uri) . '" alt="' . $images[$i]->field_work_file_alt . '" title="' . $images[$i]->field_work_file_title . '" hspace="20" /></a>
      <figcaption>
      <div class="bot">
        <h3>' . $row['title'] . '</h3>
          <a href="/' . drupal_get_path_alias('taxonomy/term/' . $terms[$i]->tid, $language->language) . '" alt="View term ' . $terms[$i]->name . ' page" title="view term ' . $terms[$i]->name . ' page">' . $terms[$i]->name . '</a>
        </div>
      </figcaption>

  </div>
  </div>
  </figure>';
        $i++;
      }

      print $return . '</div>';
      ?>

    </div>


    <?php print $feed_icons; ?>

  </div>


  <div id="footer_top"></div>
  <div id="footer">
    <div id="footermid">
      <div id="info">
        <div class="top">

        </div>
        <div class="bottom"></div>
      </div>
    </div>
  </div>
</div>


