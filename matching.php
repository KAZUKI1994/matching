<?php

//google calender情報
$calId = "2rjkpjtbu40ehubsr5273ei08s%40group.calendar.google.com";
$feedURL = "http://www.google.com/calendar/feeds/$calId/public/basic?futureevents=false&orderby=starttime&sortorder=ascending";
$sxml = simplexml_load_file($feedURL);
$schedule = array();
foreach ($sxml->entry as $entry) {
	$title = stripslashes($entry -> title);
	$content = stripslashes($entry -> content);
	$content = ltrim($content, '開始日: ');
	$content =  substr($content, 0, 10);
	$content = mb_convert_encoding($content, "utf-8");
	//chr($content);
	//$location = stripslashes($entry -> children('gd', true) -> where -> attributes() -> valueString);
 	//echo '<span class="xxxx">' .$title . '<br/>' . $content . '</span>';
 	$schedule_count = array_push($schedule, $content);
}

//eventcast情報
$rss =  'http://clip.eventcast.jp/api/v1/Search?';
$xml = simplexml_load_file($rss);
$data = get_object_vars($xml);
/*
echo '<!doctype html>';
echo '<html lang="ja">';
echo '<head>';
echo '<meta charset="utf-8">';
echo '</head>';
echo '<body>';
echo '<ul>';
$event_date = array();
foreach ($data['Items']->Item as $item) {
	echo '<li>' . $item->Title . '</li>';
	echo '<li>' . $item->Url . '</li>';
	echo '<li>' . $item->StartDate . '</li>';
	echo '<li>' . $item->EndDate . '</li>';
	echo '<li>' . $item->Location->Location["Value"] . '</li>';
	echo '<li>' . $item->Tags->Tag->Name . '</li>';
	echo '<hr />';
}

echo '</ul>';
echo '</body>';
echo '</html>';
*/
//eventとscheduleのマッチング

foreach($data['Items']->Item as $item){
	if(!array_search($item->StartDate, $schedule)){
		echo '<li>' . $item->Title . '</li>';
		echo '<li>' . $item->Url . '</li>';
		echo '<li>' . $item->StartDate . '</li>';
		echo '<li>' . $item->EndDate . '</li>';
		echo '<li>' . $item->Location->Location["Value"] . '</li>';
		echo '<li>' . $item->Tags->Tag->Name . '</li>';
		echo '<hr />';
		var_dump($item->StartDate);
	}
}

//userのスケジュールを配列に保存

//eventの配列でループを回し、userスケジュールの配列に同じ日時があるかないかを検証

	//同じ日時があればeventは非表示
	//同じ日時がなければeventは表示
?>
