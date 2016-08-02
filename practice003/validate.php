#!/usr/local/bin/php-cgi-7.0
<?php
  header("content-type: text/xml");
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

  // ホスト名
  $host = "https://acedemo043.secure.ne.jp";

  // ここにAuthTokenを記入
  $authToken = '631b917644f82ae1476b3c40c005a5c3';

  // PHPヘルパーライブラリをインクルード
  require_once('../twilio-php/Services/Twilio.php');
  $validator = new Services_Twilio_RequestValidator($authToken);

  // URLを取得
  $url = $host.$_SERVER['REQUEST_URI'];

  // POSTパラメータを取得
  $postVars = $_POST;

  // X-Twilio-Signature ヘッダオブジェクトを取得
  $signature = $_SERVER["HTTP_X_TWILIO_SIGNATURE"];

  if ($validator->validate($signature, $url, $postVars)) {
      $talk = "認証に成功しました";
  } else {
      $talk = "認証に失敗しました";
  }
?>
<Response>
  <Say language="ja-JP" voice="alice">
    <?php
      echo($talk);
    ?>
  </Say>
</Response>
