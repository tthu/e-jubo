<?php
function process_jk_youtube_options()
//SUNDAY
{
   if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   // Check that nonce field
   check_admin_referer( 'jk_op_verify' );
   
//break down date
	$dateYear = substr(($_POST['servicedate']), -4);
	$dateMonth = substr(($_POST['servicedate']), 0, 2);
	$dateDay = substr(($_POST['servicedate']), 3, 2);
	$fReader = ($_POST['firstLay']);
	$sReader = ($_POST['secondLay']);
	$fPray = ($_POST['firstPray']);
	$sPray = ($_POST['secondPray']);
	$bible = ($_POST['bibleVerse']);
	$preacher = ($_POST['preacher']);
	$blesser = ($_POST['blessing']);




	//get song numbers
//	$songs = array(($_POST['firstSong']),($_POST['secondSong']), ($_POST['lastSong']))
	$song1 = trim(($_POST['firstSong']));
	$song2 = trim(($_POST['secondSong']));
	$song3 = trim(($_POST['lastSong']));
	$ssong1 = trim(($_POST['firstSong']));
	$ssong2 = trim(($_POST['secondSong']));
	$ssong3 = trim(($_POST['lastSong']));

	//check length of song numbers. If length < 3, add 0s to the start to get url value
	
	while (strlen($song1) < 3) {
		$song1 = "0" . $song1;
	}

	while (strlen($song2) < 3) {
		$song2 = "0" . $song2;
	}

	while (strlen($song3) < 3) {
		$song3 = "0" . $song3;
	}

$pagestart="<p style=\"text-align: center;\">{$dateYear}년 {$dateMonth}월 {$dateDay}일</p>

<table style=\"text-align: left;\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><colgroup> <col style=\"width: 50%;\" /> <col style=\"width: 20%;\" /> <col style=\"width: 30%;\" /> </colgroup>
<tbody>
<tr>
<td>1부 오전 9시30분<br />
2부 오전 11시40분</td>
<td style=\"text-align: right;\">사회: </td>
<td>{$fReader}<br />
{$sReader}</td>
</tr>
</tbody>
</table>
<br>
<table style=\"text-align: center; height: 152px, font-size:0.8em;\" width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<colgroup> <col style=\"width: 30%;\" /> <col style=\"width: 40%;\" /> <col style=\"width: 30%;\" /> </colgroup>
<tbody>
<tr>
<td>묵도</td>
<td></td>
<td>다같이</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>♦찬송</td>
<td><a href=\"/song.php?hymn={$song1}&day=sun\">{$ssong1}장</a></td>
<td>다같이</td>
</tr>
<tr>
<td>♦신앙고백</td>
<td><a title=\"신앙고백\" href=\"/service_sheet/sunday/creed\">찬송가 1면</a></td>
<td>다같이</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>찬송</td>
<td><a href=\"/song.php?hymn={$song2}&day=sun\">{$ssong2}장</a></td>
<td>다같이</td>
</tr>
<tr>
<td>기도</td>
<td style=\"text-align: right;\">1부<br />
2부</td>
<td>{$fPray}<br />
{$sPray}</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>성경봉독</td>
<td><a title=\"성경\" href=\"/service_sheet/sunday/sundaybible\">{$bible}</td>
<td>사회자</td>
</tr>
<tr>
<td>♦헌금봉독</td>
<td><a href=\"/song.php?hymn=50&day=sun\">50장</a></td>
<td>다같이</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>찬양</td>
<td></td>
<td>성가대</td>
</tr>
<tr>
<td>설교</td>
<td></td>
<td><strong>{$preacher}</strong></td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>환영및소식</td>
<td><a title=\"교회소식\" href=\"announcement\">교회소식</a></td>
<td>사회자</td>
</tr>
<tr>
<td>♦찬송</td>
<td><a href=\"/song.php?hymn={$song3}&day=sun\">{$ssong3}장</a></td>
<td>다같이</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>♦축 도 </td>
<td></td>
<td><strong>{$blesser}</strong></td>
</tr>
</tbody>
</table>
<p style=\"text-align: center;\">찬송가, 성경구절을 누르면 바로 보실 수 있는 화면으로 이동합니다.(파란색)
♦ 표는 일어서 주십시오
헌금은 들어오실 때 헌금함에 드립니다</p>

<table style=\"text-align: left;\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tbody>
<tr>
<td><a title=\"주보\" href=\"/service_sheet\">&lt;&lt; 주보</a></td>
<td style=\"text-align: right;\"><a title=\"교회소식\" href=\"announcement\">교회소식 &gt;&gt;</a></td>
</tr>
</tbody>
</table>";
   
   //get page ID
   $postid = url_to_postid( 'service_sheet/sunday' );

   //create array to replace page
   $my_post = array(
      'ID'           => $postid,
      'post_content' => $pagestart
  );
  
   //save new post to DB
   wp_update_post( $my_post );
   
   $sunbibletext = trim($_POST['sun_bible_text']);
   
   $sunbiblepage = "<h2>{$bible}</h2>
<p style=\"font-size: 16px;\">
{$sunbibletext}
</p>
<a title=\"주일예배\" href=\"/service_sheet/sunday\">&lt;&lt; 주일예배</a>";
   
   
   $sunbiblepostid = url_to_postid( 'service_sheet/sunday/sundaybible' );
   
   $sunbiblepost = array(
      'ID'           => $sunbiblepostid,
      'post_content' => $sunbiblepage      
      
   );
   
   wp_update_post( $sunbiblepost );
   
   wp_redirect(  admin_url( 'admin.php?page=create-jubo&tab=sunday&m=1' ) );
   exit;
}


function process_jk_youtube_options2()
{
   if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   // Check that nonce field
   check_admin_referer( 'jk_op_verify' );
     
   //get page ID
   $postid = url_to_postid( 'service_sheet/wednesday' );
      //break down date
   $dateYear = substr(($_POST['wedServiceDate']), -4);
	$dateMonth = substr(($_POST['wedServiceDate']), 0, 2);
	$dateDay = substr(($_POST['wedServiceDate']), 3, 2);
	$reader = ($_POST['wedLay']);

	$bible = ($_POST['wbibleVerse']);
	$preacher = ($_POST['wpreacher']);

	//get song numbers
	$song1 = trim(($_POST['wfirstSong']));
	$song2 = trim(($_POST['wsecondSong']));
	$song3 = trim(($_POST['wlastSong']));
	$ssong1 = trim(($_POST['wfirstSong']));
	$ssong2 = trim(($_POST['wsecondSong']));
	$ssong3 = trim(($_POST['wlastSong']));

	//check length of song numbers. If length < 3, add 0s to the start to get url value
	while (strlen($song1) < 3) {
		$song1 = "0" . $song1;
	}

	while (strlen($song2) < 3) {
		$song2 = "0" . $song2;
	}

	while (strlen($song3) < 3) {
		$song3 = "0" . $song3;
	}

$pagestart = "<p style=\"text-align: center;\">{$dateYear}년 {$dateMonth}월 {$dateDay}일</p>

<table style=\"text-align: left;\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tbody>
<tr>
<td>오후 7시30분</td>
<td style=\"text-align: right;\">사회 : <strong>{$reader}</strong></td>
</tr>
</tbody>
</table>
<br>
<table style=\"text-align: center; height: 152px;\" width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<colgroup> <col style=\"width: 30%;\" /> <col style=\"width: 40%;\" /> <col style=\"width: 30%;\" /> </colgroup>
<tbody>
<tr>
<td>묵도</td>
<td></td>
<td>다같이</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>찬송</td>
<td><a href=\"/song.php?hymn={$song1}&day=wed\">{$ssong1}장</a> / <a href=\"/song.php?hymn={$song2}&day=wed\">{$ssong2}장</a></td>
<td>다같이</td>
</tr>
<tr>
<td>합심기도</td>
<td></td>
<td>다같이</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>성경봉독</td>
<td><a title=\"성경(수요예배)\" href=\"/service_sheet/wednesday/wednesday_bible\">{$bible}</a></td>
<td>사회자</td>
</tr>
<tr>
<td>설교</td>
<td></td>
<td><strong>{$preacher}</strong></td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>소식</td>
<td><a title=\"교회소식\" href=\"announcement\">교회소식</a></td>
<td>사회자</td>
</tr>
<tr>
<td>찬송</td>
<td><a href=\"/song.php?hymn={$song3}&day=wed\">{$ssong3}장</a></td>
<td>다같이</td>
</tr>
<tr style=\"background-color: #e9e9e9;\">
<td>주기도문</td>
<td> <a title=\"주기도문\" href=\"/service_sheet/wednesday/lords_prayer\">주기도문</a></td>
<td>다같이</td>
</tr>
</tbody>
</table>
<br>
<table style=\"text-align: left;\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tbody>
<tr>
<td><a title=\"주보\" href=\"/service_sheet\">&lt;&lt; 주보</a></td>
<td style=\"text-align: right;\"><a title=\"교회소식\" href=\"announcement\">교회소식 &gt;&gt;</a></td>
</tr>
</tbody>
</table>";

   //create array to replace page
   $my_post = array(
      'ID'           => $postid,
      'post_content' => $pagestart
  );
  
   //save new post to DB
   wp_update_post( $my_post );
   
   $bibletext = trim($_POST['wed_bible_text']);
   
   $biblepage = "<h2>{$bible}</h2>
<p style=\"font-size: 16px;\">
{$bibletext}
</p>
<a title=\"수요예배\" href=\"/service_sheet/wednesday\">&lt;&lt; 수요예배</a>";
   
   $biblepostid = url_to_postid( 'service_sheet/wednesday/wednesday_bible' );
   
   $biblepost = array(
      'ID'           => $biblepostid,
      'post_content' => $biblepage      
      
   );
   
   wp_update_post( $biblepost );
   
   wp_redirect(  admin_url( 'admin.php?page=create-jubo&tab=wednesday&m=1' ) );
   exit;
}


function process_jk_youtube_options3()
{
   if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   // Check that nonce field
   check_admin_referer( 'jk_op_verify' );
   
//break down date
	$dateYear = substr(($_POST['anndate']), -4);
	$dateMonth = substr(($_POST['anndate']), 0, 2);
	$dateDay = substr(($_POST['anndate']), 3, 2);

	$thisPBS = ($_POST['thisPBS']);
	$nextPBS = ($_POST['nextPBS']);

        //create array of announcements entered
	$annArray = array(($_POST['ann1']),($_POST['ann2']),($_POST['ann3']),($_POST['ann4']),($_POST['ann5']),($_POST['ann6']),($_POST['ann7']),($_POST['ann8']),($_POST['ann9']),($_POST['ann10']));

	$announceList = "";

	foreach ($annArray as $key) {
		if (strlen($key) > 0) {
			$text = trim($key); // remove the last \n or whitespace character
			$text = nl2br($text);
			$announceList .= "<li>" . $text . "</li>" . "\r\n";
		}
	}


$pagestart="<p style=\"text-align: center;\">{$dateYear}년 {$dateMonth}월 {$dateDay}일</p>

<div style=\"border-bottom: 1px solid #d9d9d9; padding: 0 0 20px 0;\">
<ol>
	{$announceList}
</ol>
</div>
<div style=\"text-align: center; border-bottom: 1px solid #d9d9d9; padding: 0 0 20px 0;\">
<h2>성경공부 나눔</h2>
<strong>이번주 : {$thisPBS}</strong>
<em>다음주 : {$nextPBS}</em>

</div>
<table style=\"text-align: left;\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><colgroup> <col style=\"width: 33%;\" /> <col style=\"width: 33%;\" /> <col style=\"width: 33%;\" /> </colgroup>
<tbody>
<tr>
<td><a title=\"주보\" href=\"/service_sheet\">주보</a></td>
<td style=\"text-align: center;\"><a title=\"주일예배\" href=\"/service_sheet/sunday\">주일예배</a></td>
<td style=\"text-align: right;\"><a title=\"수요예배\" href=\"/service_sheet/wednesday\">수요예배</a></td>
</tr>
</tbody>
</table>";

   $announceid = url_to_postid( 'service_sheet/announcement' );
   
   $annpost = array(
      'ID'           => $announceid,
      'post_content' => $pagestart      
      
   );
   
   wp_update_post( $annpost );
   
   wp_redirect(  admin_url( 'admin.php?page=create-jubo&tab=announcements&m=1' ) );
   exit;
}

?>