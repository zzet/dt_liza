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
      $query->condition('t.tid', '2')
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

$temp = <<<END
АЛЕКСАНДРА НЕВСКОГО УЛ.
АБЛУКОВА УЛ.
АВИАСТРОИТЕЛЕЙ ПРОСП.
АВТОЗАВОДСКАЯ УЛ.
АВТОМОБИЛИСТОВ УЛ.
АГРОНОМИЧЕСКАЯ УЛ.
АЗОВСКАЯ УЛ.
КАДЕМИКА ПАВЛОВА УЛ.
АКАДЕМИКА САХАРОВА УЛ.
АКАДЕМИКА ФИЛАТОВА ПРОСП.
АМУРСКАЯ УЛ.
АМУРСКИЙ 2Й ПЕР.
АНГАРСКАЯ УЛ.
АНТОНОВА ПРОСП.
АПАШЕВАУЛ.
АРТЕМА УЛ.
БАБУШКИНА УЛ.
БАКИНСКАЯ УЛ.
БАЛТИЙСКАЯ УЛ.
БАННЫЙ ПЕР.
БАУМАНА УЛ.
БЕБЕЛЯ УЛ.
БЕЛИНСКОГО УЛ.
БЕЛОВА ПЕР.
БЕЛЯЕВА УЛ.
БОГДАНА ХМЕЛЬНИЦКОГО УЛ.
БОГДАНОВА ПЕР.
БОГДАНОВА УЛ.
БОТАНИЧЕСКАЯ УЛ.
БРЕСТСКАЯ УЛ.
БРЮХАНОВА ПЕР.
БРЯНСКИЙ 1-Й ПЕР.
БУНИНСКАЯ УЛ.
ВАРЕЙКИСАУЛ.
ВАТУТИНА 2Й ПЕР.
ВАТУТИНА УЛ.
ВЕРХНЕПОЛЕВАЯ УЛ.
ВЕРХНИЙ ПР-Д
ВЕТЕРИНАРНАЯ УЛ.
ВИННОВСКАЯ УЛ.
ВИТЕБСКАЯ УЛ.
ВИШНЕВЫЙ ПЕР.
ВОДОПРОВОДНАЯ УЛ.
ВОКЗАЛЬНАЯ УЛ.
ВОЛГОГРАДСКАЯ УЛ.
ВОЛЖСКАЯ УЛ.
ВОЛЬНАЯ УЛ.
ВОРОБЬЕВА УЛ.
ВРАЧА МИХАЙЛОВА УЛ.
ВРАЧА СУРОВА ПРОСП.
ВЫРЫПАЕВСКАЯ УЛ.
ВЫРЫПАЕВСКИЙ 2Й ПЕР.
ГАГАРИНА УЛ.
ГАСТЕЛЛО ПЕР.
ГАФУРОВА УЛ.
ГАЯ ПРОСП.
ГЕНЕРАЛА ТЮЛЕНЕВА ПРОСП.
ГЕРАСИМОВА УЛ.
ГЕРОЕВ СВИРИ УЛ.
ГЕРЦЕНА УЛ.
ГЛИНКИ УЛ.
ГОГОЛЯ УЛ.
ГОНЧАРОВА УЛ.
ГОРА УЛ.
ГОРИНА УЛ.
ГОРЬКОГО УЛ.
ГРАЖДАНСКАЯ УЛ.
ГРОМОВОЙ УЛ.
ДАЧНАЯ УЛ.
ДЕЕВА УЛ.
ДЕКАБРИСТОВ УЛ.
ДЕРЖАВИНА УЛ.
ДИМИТРОВА УЛ.
ДИМИТРОВГРАДСКОЕ ШОССЕ
ДОВАТОРА УЛ.
ДОКУЧАЕВА УЛ.
ДОСТОЕВСКОГО УЛ.
ДРУЖБЫ УЛ.
ЕФРЕМОВА УЛ.
ЖАСМИННАЯ УЛ.
ЖЕЛЕЗНОДОРОЖНАЯ УЛ.
ЖЕЛЕЗНОЙ ДИВИЗИИ УЛ.
ЖИГУЛЕВСКАЯ УЛ.
ЗАВОДСКОЙ ПР-Д
ЗАПАДНЫЙ БУЛ.
ЗАРЕЧНАЯ УЛ.
ЗВЕЗДНАЯ УЛ.
ЗЕЛЕНЫЙ ПЕР.
ЗОИ КОСМОДЕМЬЯНСКОЙ УЛ.
ИНЖЕНЕРНЫЙ ПР-Д
ИНЗЕНСКАЯ УЛ.
ИНТЕРНАЦИОНАЛА УЛ.
ИППОДРОМНАЯ УЛ.
КАДЬЯНА УЛ
КАЗАНСКАЯ УЛ.
КАЛИНИНА УЛ.
КАМЫШИНСКАЯ УЛ.
КАРАГАНОВА ПР-Д
КАРБЫШЕВА УЛ.
КАРЛА ЛИБКНЕХТА УЛ.
КАРЛА МАРКСА УЛ.
КАРСУНСКАЯ УЛ.
КАРЮКИНАУЛ.
КАШТАНКИНА УЛ.
КИЕВСКИЙ БУЛ.
КИНДЯКОВЫХ УЛ.
КИРОВА 1Й ПЕР.
КИРОВА УЛ.
КЛУБНАЯ УЛ.
КОЛЬЦЕВАЯ УЛ.
КОМСОМОЛЬСКИЙ ПЕР.
КООПЕРАТИВНАЯ УЛ.
КОРУНКОВОЙ УЛ.
КОТОВСКОГО УЛ.
КОШЕВОГО УЛ.
КРАЙНЯЯ УЛ.
КРАСНОАРМЕЙСКАЯ УЛ.
КРАСНОГВАРДЕЙСКАЯ УЛ.
КРАСНОЗНАМЕННЫЙ ПЕР.
КРАСНОПРОЛЕТАРСКАЯ УЛ.
КРАСНОЯРСКАЯ УЛ.
КРАСНОЯРСКИЙ ПЕР.
КРОЛЮНИЦКОГОУЛ.
КРЫМОВА УЛ.
КУЗНЕЦОВА ПЕР.
КУЗНЕЦОВА УЛ.
КУЗОВАТОВСКАЯ УЛ.
КУЙБЫШЕВА УЛ.
ЛЕНИНА ПЛОЩАДЬ
ЛЕНИНГРАДСКАЯ УЛ.
ЛЕНИНСКОГО КОМСОМОЛА ПРОСП.
ЛЕСНАЯ УЛ.
ЛЕСНОЙ ПР-Д.
ЛЕСОВОДОВ УЛ.
ЛИЗЫ ЧАЙКИНОЙ УЛ.
ЛИХАЧЕВА УЛ.
ЛОКОМОТИВНАЯ УЛ.
ЛУНАЧАРСКОГО УЛ.
ЛЬВА ТОЛСТОГО УЛ
ЛЬВОВСКИЙ БУЛ.
МАЙНСКИЙ ПЕР.
МАЙСКАЯ УЛ.
МАЛОСАРАТОВСКАЯ УЛ.
МАРАТА УЛ.
МАТРОСОВА УЛ.
МАЯКОВСКОГО УЛ.
МЕЛЕКЕССКАЯ УЛ.
МЕНДЕЛЕЕВА ПР-Д
МЕТАЛЛИСТОВ УЛ.
МИНАЕВА УЛ.
МИНИНА УЛ.
МИЧУРИНА УЛ.
МОЖАЙСКОГО УЛ.
МОЛОЧНЫЙ ПЕР.
МОСКОВСКАЯ УЛ.
МОСКОВСКОЕ ШОССЕ
НАБЕРЕЖНАЯ РЕКИ СВИЯГИ УЛ.
НАГАНОВА УЛ.
НАГОРНАЯ УЛ.
НАЗАРЬЕВА УЛ.
НАРИМАНОВА ПРОСП.
НАРОДНАЯ УЛ.
НАРОДНЫЙ ПЕР.
НАРОДНЫЙ 1-Й ПЕР.
НАХИМОВА УЛ.
НАЦИОНАЛЬНАЯ УЛ.
НЕВЕРОВА УЛ.
НЕМИРОВИЧА ДАНЧЕНКО УЛ.
НЕФТЯННИКОВ ПР-Д.
НОВАЯ УЛ.
НОВГОРОДСКАЯ УЛ.
НОВОСВИЯЖСКИЙ ПРИГОРОД УЛ.
НОВОСИБИРСКАЯ УЛ.
НОВОСОНДЕЦКИЙ БУЛ.
НОВЫЙ БУЛ.
НОВЫЙ ПЕР.
ОБУВЩИКОВ ПР-Д
ОВРАЖНАЯ УЛ.
ОДЕССКАЯ УЛ.
ОКТЯБРЬСКАЯ УЛ.
ОКТЯБРЬСКИЙ ПЕР.
ОМСКАЯ УЛ.
ОРДЖОНИКИДЗЕ УЛ.
ОРЕНБУРГСКАЯ УЛ.
ОРЕХОВЫЙ ПЕР.
ОРЛОВА УЛ.
ОРЛОВСКАЯ УЛ.
ОРСКАЯ УЛ.
ОСТРОВСКОГО УЛ.
ОТРАДНАЯ УЛ.
ПАНФЕРОВА УЛ.
ПАНФИЛОВЦЕВ УЛ.
ПАРХОМЕНКО УЛ.
ПЕНЗЕНСКАЯ УЛ.
ПЕНЗЕНСКИЙ БУЛ.
ПЕРВОМАЙСКАЯ УЛ.
ПИМОВА УЛ.
ПИОНЕРСКАЯ УЛ.
ПЛАСТОВА БУЛ.
ПЛЕХАНОВА УЛ.
ПОБЕДЫ УЛ.
ПОДЛЕСНАЯ УЛ.
ПОЖАРНЫЙ ПЕР.
ПОЖАРСКОГО УЛ.
ПОЛБИНА УЛ.
ПОЛИВЕНСКОЕ ШОССЕ
ПОЛИВЕНСКАЯ УЛ.
ПОЛТАВСКИЙ ПР-Д
ПОЧТОВАЯ УЛ.
ПРИВОКЗАЛЬНАЯ УЛ.
ПРИГОРОДНАЯ УЛ.
ПРИРЕЧНАЯ УЛ.
ПРОКОФЬЕВА УЛ.
ПРОЛЕТАРСКАЯ УЛ.
ПРОМЫШЛЕННАЯ УЛ.
ПРОФСОЮЗНАЯ УЛ.
ПУГАЧЕВА УЛ.
ПУТЕВАЯ УЛ.
ПУШКАРЕВА УЛ.
ПУШКИНСКАЯ УЛ.
Р. ЛЮКСЕМБУРГ УЛ.
Р. СИМБИРКИ НАБ.
РАБОЧАЯ УЛ.
РАБОЧИЙ 2-Й ПЕР.
РАДИЩЕВА УЛ.
РЕПИНА УЛ.
РОБЕСПЬЕРА УЛ.
РОССИЙСКАЯ УЛ.
РОСТОВСКАЯ УЛ.
РУЗАЕВСКИЙ ПЕР.
РЫЛЕЕВА УЛ.
РЯБИКОВА УЛ.
САМАРСКАЯ УЛ.
САМАРСКИЙ 3-Й ПЕР.
СВЕРДЛОВА УЛ.
СВИЯЖСКАЯ УЛ.
СВИЯЖСКИЙ ПЕР.
СВОБОДЫ УЛ.
СЕВАСТОПОЛЬСКАЯ УЛ.
СЕВЕРНЫЙ ВЕНЕЦ УЛ.
СЕРАФИМОВИЧА УЛ.
СИМБИРСКАЯ УЛ.
СИРЕНЕВЫЙ ПР-Д
СМЫЧКИ УЛ.
СОВЕТСКАЯ УЛ.
СОВХОЗНАЯ УЛ.
СОЗИДАТЕЛЕЙ ПРОСП.
СОЛНЕЧНАЯ УЛ.
СОЛОВЬЕВА УЛ.
СПУСК МИНАЕВА
СПУСК СТЕПАНА РАЗИНА
СПУСК ХАЛТУРИНА
СРЕДНИЙ ВЕНЕЦ УЛ.
СТАНКОСТРОИТЕЛЕЙ УЛ.
СТАСОВА УЛ.
СУВОРОВА ПЕР.
ТАШЛИНСКАЯ УЛ.
ТЕЛЬМАНА УЛ.
ТЕРЕШКОВОЙ УЛ.
ТЕТЮШИНСКАЯ УЛ.
ТИМИРЯЗЕВА УЛ.
ТИМУРОВСКАЯ УЛ.
ТИХАЯ УЛ.
ТОЛБУХИНА УЛ.
ТОПОЛЕВЫЙ ПЕР.
ТРАНСПОРТНАЯ УЛ.
ТРУДА УЛ.
ТУПОЛЕВА ПРОСП.
ТУРГЕНЕВА УЛ.
ТУХАЧЕВСКОГО УЛ.
УЛЬЯНОВСКАЯ УЛ.
УЛЬЯНОВСКИЙ ПЕР.
УЛЬЯНОВСКИЙ ПРОСП.
УРИЦКОГО УЛ.
УРОЖАЙНАЯ УЛ.
УСТИНОВА УЛ.
ФЕДЕРАЦИИ УЛ.
ФЕСТИВАЛЬНЫЙ БУЛ.
ФИЛАТОВА УЛ.
ФРУКТОВАЯ УЛ.
ХАЗОВА УЛ.
ХЛЕБОЗАВОДСКАЯ УЛ.
ХО ШИ МИНА УЛ.
ХРУСТАЛЬНАЯ УЛ.
ХРУСТАЛЬНЫЙ ПЕР.
ЦИОЛКОВСКОГО УЛ.
ЧАЙКОВСКОГО УЛ.
ЧЕЛЯБИНСКАЯ УЛ.
ЧЕРНЫШЕВСКОГО УЛ.
ЧЕРНЯХОВСКОГО УЛ.
ЧЕХОВА УЛ.
ЧИСТОПРУДНАЯ УЛ.
ЧКАЛОВА ПЕР.
ЧКАЛОВА УЛ.
ШЕВЦОВОЙ УЛ.
ШЕВЧЕНКО УЛ.
ШИГАЕВА УЛ.
ШКОЛЬНАЯ УЛ.
ШОЛМОВА УЛ.
ШОФЕРОВ УЛ.
ЩОРСА УЛ.
ЭНГЕЛЬСА УЛ.
ЭНЕРГЕТИКОВ ПР-Д
ЮЖНАЯ УЛ.
ЮНОСТИ УЛ.
ЯЗЫКОВА УЛ.
ЯКОВЛЕВА ПЕР.
ЯРОСЛАВСКОГО УЛ.
12 СЕНТЯБРЯ УЛ.
2 МТС УЛ.
40 ЛЕТ ОКТЯБРЯ УЛ.
40ЛЕТИЯ ПОБЕДЫ УЛ.
50 ЛЕТ ВЛКСМ ПРОСП.
8 МАРТА УЛ.
9 МАЯ УЛ.
END;

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


