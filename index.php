<h1>Курл</h1>
<?php
unlink($_SERVER['DOCUMENT_ROOT']."/tmp/cookie.txt");
function request($url, $post=null, $cookiejar=''){
    $ch = curl_init($url);
    $cookiejar = $_SERVER['DOCUMENT_ROOT']."/tmp/cookie.txt";
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 //   curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//чтобы не было редиректов
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36');
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar);


   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // для https
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // для https
    //curl_setopt($ch, CURLOPT_NOBODY, true); //получим только заголовки без тела
if($post) {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); //если передаем в функцию пост, курл передаст пост данные на сервер, мб массив или строка
}
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

    $page = request('https://skz.by/login/');
    //echo $page;
    $html = new DOMDocument();
    $html->loadHTML($page);
    $finder = new DomXPath($html);
    $hiddens = $finder->query('//input[@type="hidden"][1]');
    foreach ($hiddens as $hidden) {
      $arr = $hidden->getAttribute('value');
    }
    echo $arr;

  $postdata = [
  'csrfmiddlewaretoken' => '',
  'username' => 'KShulga',
  'password'=> 'Kri6718847//',
  'next' => '/'
  ];
  $postdata['csrfmiddlewaretoken'] = $arr;
  $html = request('https://skz.by/login/', $postdata);
  echo $html;






?>
