<?php
  require_once('functions.php');
  require_once('data.php');
  require_once('weather.php');


$page_content = render_template('templates/index.php', [
  'products' => $products,
  'time' => out_time()
]);


$layout_content = render_template('templates/layout.php', [
  'content' => $page_content,
  'title' => 'Главная страница',
  'category' => $category,
  ] );

  // print_r($response);
// print_r($return_data->current_observation->condition->temperature);
// print_r($return_data->current_observation->condition->text);
// print($layout_content);



  $get_currency = function($currency_code, $format, $date) {
    	// $cache_time_out = 0;
  	  $file_currency_cache = __DIR__.'/XML_daily.asp';

  	  // if (!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {
    		$ch = curl_init();

    		curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($ch, CURLOPT_HEADER, 0);

    		$out = curl_exec($ch);
    		curl_close($ch);
    		file_put_contents($file_currency_cache, $out);
  	  // };



  	 $content_currency = simplexml_load_file($file_currency_cache);
    return number_format(str_replace(',', '.', $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]')[0]->Value), $format);

  	// return number_format(str_replace(',', '.', $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]')[0]->Value), $format);
    };


  $date_now_str = time();
  $date_now = date('d/m/Y', $date_now_str);

  $date_1DaysAgo_str = $date_now_str - 86400*2;
  $date_1DaysAgo = date('d/m/Y', $date_1DaysAgo_str);

  $usd_value_active = $get_currency('USD', 1, $date_now);
  $usd_value_noactive = $get_currency('USD', 1, $date_1DaysAgo);

  if ($usd_value_active > $usd_value_noactive) {
    $USD_trend = 'exchange-rates--top';
  } else {
    $USD_trend = 'exchange-rates--bottom';
  };

  $eur_value_active = $get_currency('EUR', 1, $date_now);
  $eur_value_noactive = $get_currency('EUR', 1, $date_1DaysAgo);

  if ($eur_value_active > $eur_value_noactive) {
    $EUR_trend = 'exchange-rates--top';
  } else {
    $EUR_trend = 'exchange-rates--bottom';
  };

  $arr_currency = array(
    'USD_value' => $usd_value_active,
    'usd_value_noactive' => $usd_value_noactive,
    'USD_trend' => $USD_trend,
    'EUR_value' => $eur_value_active,
    'eur_value_noactive' => $eur_value_noactive,
    'EUR_trend' => $EUR_trend
  );
  // $this['usd_value_active'] = $usd_value_active;
  // $this['usd_value_noactive'] = $usd_value_noactive;

print_r($arr_currency)



?>
