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

	$childNodeList = $block_event->getElementsByTagName("div");
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
	  $event_date_node = $node->getElementsByTagName("div");
	  for ($i = 0; $i < $event_date_node->length; $i++) {
	      $temp = $event_date_node->item($i);
	      if (stripos($temp->getAttribute('class'), "views-field-field-announce") !== false) {
		  if (stripos($temp->getAttribute('class'), "views-field-field-announce-date") !== false) {
		      $item .= '<p class="date">' . $temp->getElementsByTagName("a")->item(0)->textContent . '</p>';
		  } else {
		      $item .= '<p class="event_text"><a href="' . $temp->getElementsByTagName("a")->item(0)->getAttribute("href") . '">' . utf8_decode($temp->getElementsByTagName("a")->item(0)->textContent) . '</a></p>';
		  }
	      }
	  }
	  $item .=   '</div>';
	  array_push($res, $item);
	}
	echo join($PARSER_DIVIDER, array_slice($res, 0, $PARSER_COUNT_EVENTS));


	

    ?>

    </body>
</html>
