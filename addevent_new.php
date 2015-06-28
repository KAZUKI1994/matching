//eventとscheduleのマッチング<=NUllを検知するためのif文追加
$user_prefecture = '東京都';
$event_location = array();
foreach($data['Items']->Item as $item){
	if(!array_search($item->StartDate, $schedule)){
		if( is_null($user_prefecture)){
			if(is_null($item->Title)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Title . '</li>';
			if(is_null($item->Url)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Url . '</li>';
			
			if(is_null($item->StartDate)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->StartDate . '</li>';
	
			if(is_null($item->EndDate)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->EndDate . '</li>';
	
			if(is_null($item->Location->Location["Value"])){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Location->Location["Value"] . '</li>';
			
			if(is_null($item->Tags->Tag->Name)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Tags->Tag->Name . '</li>';
			//カレンダー登録画面
			$startdate = str_replace("/", "", $item->StartDate);
			$enddate = str_replace("/", "", $item->EndDate);

			$url = "http://www.google.com/calendar/event?"
			."action="."TEMPLATE"
			."&text=".$item->Title
			."&details=".""
			."&location=".$item->Location->Location["Value"]
			."&dates="	.$startdate."/".$enddate;
			echo "<a href=\"$url\">カレンダーに登録</a>";
			$event_location = array();
			echo '<hr />';
		}
		$event_location_count = array_push($event_location, $item->Location->Location['Value']);
		if(preg_grep("/".$user_prefecture."/", $event_location)){
			/*
			echo '<li>' . $item->Title . '</li>';
			echo '<li>' . $item->Url . '</li>';
			echo '<li>' . $item->StartDate . '</li>';
			echo '<li>' . $item->EndDate . '</li>';
			echo '<li>' . $item->Location->Location["Value"] . '</li>';
			echo '<li>' . $item->Tags->Tag->Name . '</li>';
			*/
			if(is_null($item->Title)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Title . '</li>';
			if(is_null($item->Url)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Url . '</li>';
			
			if(is_null($item->StartDate)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->StartDate . '</li>';
	
			if(is_null($item->EndDate)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->EndDate . '</li>';
	
			if(is_null($item->Location->Location["Value"])){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Location->Location["Value"] . '</li>';
			
			if(is_null($item->Tags->Tag->Name)){
				echo '<li>' . '情報なし' . '</li>';
			}
			echo '<li>' . $item->Tags->Tag->Name . '</li>';
			$startdate = str_replace("/", "", $item->StartDate);
			$enddate = str_replace("/", "", $item->EndDate);

			$url = "http://www.google.com/calendar/event?"
			."action="."TEMPLATE"
			."&text=".$item->Title
			."&details=".""
			."&location=".$item->Location->Location["Value"]
			."&dates="	.$startdate."/".$enddate;
			echo "<a href=\"$url\">カレンダーに登録</a>";
			$event_location = array();
			echo '<hr />';
		}
	}
}

//doorkeeper

//doorkeeper情報
$door_url =  'http://api.doorkeeper.jp/events';
$json = file_get_contents($door_url);
$arr = json_decode($json, true);

/*echo '<pr>';
var_dump($arr);
echo '</pr>';*/
//doorkeeper<=ここを編集。if文の追加・<hr />の位置の編集
foreach($arr as $event){
	if($event["event"]["title"]==""){
		echo '<li>' . '情報なし' . '</li>';
	}
	echo '<li>' . $event["event"]["title"] . '</li>';

	if(is_null($event["event"]["starts_at"])){
		echo '<li>' . '情報なし' . '</li>';
	}
	echo '<li>' . $event["event"]["starts_at"] . '</li>';
	if(is_null($event["event"]["ends_at"])){
		echo '<li>' . '情報なし' . '</li>';
	}
	echo '<li>' . $event["event"]["ends_at"] . '</li>';
	if(is_null($event["event"]["address"])){
		echo '<li>' . '情報なし' . '</li>';
	}
	echo '<li>' . $event["event"]["address"] . '</li>';

	/*if(is_null($event["event"]["banner"])){
		echo '<li>' . '情報なし' . '</li>';
	}
	echo '<li>' . $event["event"]["banner"] . '</li>';
*/

	/*カレンダー登録ボタン
	$startdate = str_replace("/", "", $item->StartDate);
	$enddate = str_replace("/", "", $item->EndDate);
	*/
	$url = "http://www.google.com/calendar/event?"
	."action="."TEMPLATE"
	."&text=".$event["event"]["title"]
	."&details=".""
	."&location=".$event["event"]["address"]
	."&dates="	.$event["event"]["starts_at"]."/".$event["event"]["ends_at"];
	echo "<a href=\"$url\">カレンダーに登録</a>";
	echo '<hr />';
