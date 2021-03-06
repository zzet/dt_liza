<div id="main">
  <div id="header">
    <div id="linkhead">
      <a href="/"><div class="lmain"></div></a>
      <div id="top_menu">
        <a href="<?=  drupal_get_path_alias('taxonomy/term/2', $language->language);?>"><div class="l"></div></a>
        <a href="<?=  drupal_get_path_alias('taxonomy/term/3', $language->language);?>"><div class="i"></div></a>
        <a href="<?=  drupal_get_path_alias('taxonomy/term/1', $language->language);?>"><div class="s"></div></a>
        <a href="<?=  drupal_get_path_alias('taxonomy/term/4', $language->language);?>"><div class="a"></div></a>
        <a href="<?=  drupal_get_path_alias('taxonomy/term/5', $language->language);?>"><div class="v"></div></a>
        <a href="mailto:lizaveta.exe@gmail.com"><div class="e"></div></a>
        <a href="<?=  drupal_get_path_alias('taxonomy/term/6', $language->language);?>"><div class="t"></div></a>
        <a href="<?=  drupal_get_path_alias('node/7', $language->language);?>"><div class="a2"></div></a>
      </div>
      <a href="/"><div id="twitter_link"></div></a>
    </div>
  </div>
  <div id="header_bottom"></div>


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
      <?php print render($page['content']); ?>
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

