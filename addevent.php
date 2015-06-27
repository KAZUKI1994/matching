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



//eventとscheduleのマッチング
$user_prefecture = '東京都';
$event_location = array();
foreach($data['Items']->Item as $item){
	if(!array_search($item->StartDate, $schedule)){
		$event_location_count = array_push($event_location, $item->Location->Location['Value']);
		if(preg_grep("/".$user_prefecture."/", $event_location)){
			echo '<li>' . $item->Title . '</li>';
			echo '<li>' . $item->Url . '</li>';
			echo '<li>' . $item->StartDate . '</li>';
			echo '<li>' . $item->EndDate . '</li>';
			echo '<li>' . $item->Location->Location["Value"] . '</li>';
			echo '<li>' . $item->Tags->Tag->Name . '</li>';
			echo '<hr />';

			//ここからgoogle calender追加のためのコード
			$startdate = str_replace("/", "", $item->StartDate);
			$enddate = str_replace("/", "", $item->EndDate);

			$url = "http://www.google.com/calendar/event?"
			."action="."TEMPLATE"
			."&text=".$item->Title
			."&details=".""
			."&location=".$item->Location->Location["Value"]
			."&dates="	.$startdate."/".$enddate;
			echo "<a href=\"$url\">カレンダーに登録</a>";
			//ここまで
			$event_location = array();
	}
	}
}



