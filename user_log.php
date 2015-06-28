<?php

//eventcastからxmlファイルを取得。それを配列に変換。
$rss =  'http://clip.eventcast.jp/api/v1/Search?';
$xml = simplexml_load_file($rss);
$data = get_object_vars($xml);

//空配列
$user_inte = array();

//タグを空配列に挿入
foreach($data['Items']->Item->Tags as $tags){
	array_push($user_inte, $tags->Tag->Name);
	}
