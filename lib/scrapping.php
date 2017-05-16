<?php
class Scrapping
{

  function __construct()
  {
    require 'simple_html_dom.php';
  }

  public function scrapping($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, "Googleboot/2.1 (http://www.googlebot.com/bot.html)");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    if (!$site = curl_exec($ch)) {
      return 'offline';
    }else {
      return $site;
    }
  }

  public function show($url)
  {
    $result = array();
    $curl = $this->scrapping($url);
    if ($curl == "offline") {
      $result['status'] = "error";
    }else {
      $html = str_get_html($curl);
      // echo $html;

      if ($html->find('div[class=edgtf-post-text-inner]')) {
        $result['status'] = "sukses";

        foreach ($html->find('div[class=edgtf-post-text-inner]') as $value) {
          $title = $value->find('a', 0);
          $author = $value->find('a[class=edgtf-post-info-author-link]', 0);
          $isi = $value->find('p[class=edgtf-post-excerpt]', 0);

          $result['hasil'][] = array(
            'title' => $title->innertext,
            'author' =>$author->innertext,
            'isi' =>$isi->innertext);
        }

      }
    }
    return $result;

  }
}
