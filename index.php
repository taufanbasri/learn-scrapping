<?php

  require 'lib/scrapping.php';

  $scrapping = new Scrapping();
  $hasil = $scrapping->show("https://acidopal.com");

  header('Content-Type: application/json');
  echo json_encode($hasil);

 ?>
