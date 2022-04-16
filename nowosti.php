<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
    <?php
    error_reporting(0);
    $PARSER_COUNT_NEWS = 5;
    $PARSER_COUNT_EVENTS = 5;
    $PARSER_DIVIDER = "<hr>";
    $PARSER_MORE_LINK = "http://donntu.ru/news";
    $doc = new DOMDocument();
    $buffer = new DOMDocument();
    $doc->loadHTMLFile('http://donntu.ru');
    $block_event = $doc->getElementById("block-views-main-news-block-5");
    $block_news = $doc->getElementById("block-views-main-news-block");
    /* Working events */

    
      
	


	$nodes=array();

	$childNodeList = $block_news->getElementsByTagName("div");
	for ($i = 0; $i < $childNodeList->length; $i++) {
	  $temp = $childNodeList->item($i);
	  if (stripos($temp->getAttribute('class'), "news-main") !== false) {
	      $nodes[]=$temp;
	  }
	}
	$res = [];
	foreach($nodes as $node){
	  $item = '';
	  // echo utf8_decode($node->textContent);
	  $item .= '<div class="item">';
	  $event_news_node = $node->getElementsByTagName("div");
	  for ($i = 0; $i < $event_news_node->length; $i++) {
	      $temp = $event_news_node->item($i);
	      if (stripos($temp->getAttribute('class'), "views-field-field-image") !== false) {
		  $item .= '<img src="'.$temp->getElementsByTagName("img")->item(0)->getAttribute("src").'">';
	      }
	      if (stripos($temp->getAttribute('class'), "views-field-title") !== false) {
		  $item .= '<a href="http://donntu.ru'.$temp->getElementsByTagName("a")->item(0)->getAttribute("href").'">'.utf8_decode($temp->getElementsByTagName("a")->item(0)->textContent).'</a>';
	  // <a class="detail" href="'.$temp->getElementsByTagName("a")->item(0)->getAttribute("href").'">Подробнее</a>';
	      }
	  }
	  $item .=   '</div>';
	  array_push($res, $item);
	}
	$news = join($PARSER_DIVIDER, array_slice($res, 0, $PARSER_COUNT_NEWS));
	$news .= '<a href="'.$PARSER_MORE_LINK.'">все новости</a>';
	echo $news;

    ?>

    </body>
</html>
