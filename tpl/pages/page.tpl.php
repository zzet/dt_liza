<div id="main">
  <div id="header">
    <div id="linkhead">
      <a href="/"><div class="lmain"></div></a>
      <div id="top_menu">
        <a href="#l"><div class="l"></div></a>
        <a href="#i"><div class="i"></div></a>
        <a href="#s"><div class="s"></div></a>
        <a href="#a"><div class="a"></div></a>
        <a href="#v"><div class="v"></div></a>
        <a href="#e"><div class="e"></div></a>
        <a href="#t"><div class="t"></div></a>
        <a href="#a"><div class="a2"></div></a>
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

<?php
/*
  <div id="branding" class="clearfix">
  <?php print $breadcrumb; ?>


  <div id="content-block">
  <div id="block">
  <div class="top">
  <a href="#"><img src="./images/block1.jpg" alt=""></img></a>
  </div>
  <div class="bot">
  <h3>Logo for All-team company</h3>
  <a href=#"">Logos & styles</a>
  </div>
  </div>
  <div id="block">
  <div class="top">
  <a href="#"><img src="./images/block2.jpg" alt=""></img></a>
  </div>
  <div class="bot">
  <h3>Site for Technical University</h3>
  <a href=#"">Sites & web</a>
  </div>
  </div>
  <div id="block">
  <div class="top">
  <a href="#"><img src="./images/block3.jpg" alt=""></img></a>
  </div>
  <div class="bot">
  <h3>Logo for All-team company</h3>
  <a href=#"">Logos & styles</a>
  </div>
  </div>
  <div id="block">
  <div class="top">
  <a href="#"><img src="./images/block4.jpg" alt=""></img></a>
  </div>
  <div class="bot">
  <h3>Summer school site</h3>
  <a href=#"">Sites & web</a>
  </div>
  </div>
  <div id="block">
  <div class="top">
  <a href="#"><img src="./images/block5.jpg" alt=""></img></a>
  </div>
  <div class="bot">
  <h3>Logo for All-team company</h3>
  <a href=#"">Sites & web</a>
  </div>
  </div>
  <div id="block">
  <div class="top">
  <a href="#"><img src="./images/block6.jpg" alt=""></img></a>
  </div>
  <div class="bot">
  <h3>Logo for All-team company</h3>
  <a href=#"">Sites & web</a>
  </div>
  </div>

  </div>
  </div>
 */
?>