<?php

if (! isset($_GET['cmd']) && ! isset($_GET['plugin'])) {

  // cmd, plugin が無いときは query_string がページ名 (pukiwiki の実装に準拠)
  $name = preg_replace("#^([^&]*)&.*$#", "$1", $_SERVER['QUERY_STRING']);
  $eucjp_title = rawurldecode($name);
  $utf8_title = mb_convert_encoding($eucjp_title, 'utf-8', 'euc-jp');

  $query_string = rawurlencode($utf8_title);

} else {

  if (isset($_GET['page'])) {
    $_GET['page'] = mb_convert_encoding($_GET['page'], 'utf-8', 'euc-jp');
  }
  if (isset($_GET['word'])) {
    $_GET['word'] = mb_convert_encoding($_GET['word'], 'utf-8', 'euc-jp');
  }

  $query_string = http_build_query($_GET);

}

# TODO: change path
header("Location: /~nonylene/pukiwiki/?" . $query_string, TRUE, 301);
