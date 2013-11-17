<?php

function jb_show_tabs() { 
    $tabs = array( 'information' => 'Information', 'sunday' => 'Sunday', 'wednesday' => 'Wednesday', 'announcements' => 'Announcements' ); 
    $links = array();
    $current = $_GET['tab']; 
    foreach( $tabs as $tab => $name ) : 
        if ( $tab == $current ) : 
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=create-jubo&tab=$tab'>$name</a>"; 
        else : 
            $links[] = "<a class='nav-tab' href='?page=create-jubo&tab=$tab'>$name</a>"; 
        endif; 
    endforeach; 
    echo '<h2 class=”nav-tab-wrapper”>'; 
    foreach ( $links as $link ) 
        echo $link; 
    echo '</h2>'; 
}

function jb_display_pages() {
	global $pagenow;

	jb_show_tabs();
	
    if ( $pagenow == 'admin.php' && $_GET['page'] == 'create-jubo' ) : 
      if ( isset ( $_GET['tab'] ) ) : 
          $tab = $_GET['tab']; 
      else: 
          $tab = 'information';
      endif; 
      switch ( $tab ) :
          case 'information' :
               jb_display_information();
               break;
          case 'sunday' : 
              jb_display_sunday(); 
              break; 
          case 'wednesday' : 
              jb_display_wednesday(); 
              break; 
          case 'announcements' : 
              jb_display_announcements(); 
              break; 
      endswitch;
    endif;
}

function jb_display_sunday()
{
   $options = get_option( 'jk_op_array' );
?>
   <div class="wrap">
         <script type="text/javascript">
         jQuery(document).ready(function($) {
         $('.custom_date').datepicker({
         });
         });
         </script>
      
      <?php
         if ( isset( $_GET['m'] ) && $_GET['m'] == '1' )
         {
      ?>
            <div id='message' class='updated fade'><p><strong>You have successfully updated the Sunday 주보. <a href="/service_sheet/sunday">Visit Page.</a></strong></p></div>
      <?php
         }
      ?>
      <form method="post" action="admin-post.php">
         <input type="hidden" name="action" value="jk_save_youtube_option" />
         
         <?php wp_nonce_field( 'jk_op_verify' ); ?>
         <h2>주일예배</h2>
         <table width="70%" cellpadding="10">
            <colgroup><col style="width:10%;"><col></colgroup>
            <tbody>
               <tr>
                  <td><h3>Date</h3></td>
                  <td><input type="text" class="custom_date" name="servicedate"/></td>
               </tr>
            <tr>
               <td><h3>사회</h3></td>
               <td>eg: <strong><i>백승지 집사</i></strong><br />
         1부: <input type="text" name="firstLay" id="firstLay" ><br />
	 2부: <input type="text" name="secondLay" id="secondLay" ><br>
               </td>
            </tr>
            <tr>
               <td><h3>찬송</h3></td>
               <td>eg: <strong><i>8</i></strong> or <strong><i>27</i></strong> or <strong><i>451</i></strong><br>
         1: <input type="text" name="firstSong" id="firstSong"><br>
         2: <input type="text" name="secondSong" id="secondSong"><br>
         3: <input type="text" name="lastSong" id="lastSong"><br>
               </td>
            </tr>
            <tr>
               <td><h3>기도</h3></td>
               <td>eg: <strong><i>백승지 집사</i></strong> or <strong><i>김새원 성도</i></strong><br>
         1부: <input type="text" name="firstPray" id="firstPray"><br />
	 2부: <input type="text" name="secondPray" id="secondPray"><br></td>
               
            </tr>
            <tr>
               <td><h3>목사</h3></td>
               <td>eg: <strong><i>박영덕 목사</i></strong> or <strong><i>홍서진 선교사</i></strong><br>
               설교: <input type="text" name="preacher" id="preacher" value="박영덕 목사"><br />
               축도: <input type="text" name="blessing" id="blessing" value="박영덕 목사"></td> 
            </tr>
            <tr>
               <td style="vertical-align: top;"><h3>성경</h3></td>
               <td>         eg: <strong>누가복음 24장 44~48절(신약p141)</strong><br />
         성경 Reading: <input type="text" name="bibleVerse" id="bibleVerse" size="55"/> <br>
                  Full Bible Text:<br />
         <textarea id="sun_bible_text" name="sun_bible_text" cols="80" rows="20"></textarea>
               </td>
               
            </tr>
            </tbody>
         </table>

         <input type="submit" value="Submit" class="button-primary"/>
      </form>
   </div>
<?php
}


function jb_display_announcements()
{
   $options = get_option( 'jk_op_array' );
   wp_enqueue_style('jubostyle');
?>
   <div class="wrap">
         <script type="text/javascript">
         jQuery(document).ready(function($) {
         $('.custom_date').datepicker({
         });
         });
         </script>
      
      <?php
         if ( isset( $_GET['m'] ) && $_GET['m'] == '1' )
         {
      ?>
            <div id='message' class='updated fade'><p><strong>You have successfully updated the announcements. <a href='/service_sheet/announcement'>Visit Page</a></strong></p></div>
      <?php
         }
      ?>
      <form method="post" action="admin-post.php">
         <input type="hidden" name="action" value="jk_save_youtube_option3" />
         
         <?php wp_nonce_field( 'jk_op_verify' ); ?>
         <h2>교회소식</h2>
         
         <table width="70%" cellpadding="10">
            <colgroup><col style="width:10%;"><col></colgroup>
            <tbody>
               <tr>
                  <td><h3>Date (주)</h3></td>
                  <td><input type="text" class="custom_date" name="anndate"/></td>
               </tr>
               <tr>
                  <td><h3>PBS</h3></td>                  
                  <td>이번주: <input type="text" id="thisPBS" name="thisPBS"/><br>
                     다음주: <input type="text" id="nextPBS" name="nextPBS"/></td>
               </tr>
               <tr>
                  <td style="vertical-align: top;"><h3>Announcements</h3></td>
                  <td>
                     1. <input type="text" id="ann1" name="ann1" value="오늘 처음 오신 분을 환영합니다. 예배 후 담임목사와 만남의 시간이 있습니다." size="60"/><br />
                     <label for="ann2">2.</label>
                     <textarea id="ann2" name="ann2" cols="70" rows="3"></textarea><br />
                     <label for="ann3">3.</label>
                     <textarea id="ann3" name="ann3" cols="70" rows="3"></textarea><br />
                     <label for="ann4">4.</label>
                     <textarea id="ann4" name="ann4" cols="70" rows="3"></textarea><br />
                     <label for="ann5">5.</label>
                     <textarea id="ann5" name="ann5" cols="70" rows="3"></textarea><br />
                     <label for="ann6">6.</label>
                     <textarea id="ann6" name="ann6" cols="70" rows="3"></textarea><br />
                     <label for="ann7">7.</label>
                     <textarea id="ann7" name="ann7" cols="70" rows="3"></textarea><br />
                     <label for="ann8">8.</label>
                     <textarea id="ann8" name="ann8" cols="70" rows="3"></textarea><br />
                     <label for="ann9">9.</label>
                     <textarea id="ann9" name="ann9" cols="70" rows="3"></textarea><br />
                     <label for="ann10">10.</label>
                     <textarea id="ann10" name="ann10" cols="70" rows="3"></textarea>

                  </td>
               </tr>
               
            </tbody>
         </table>
         <br />
         <input type="submit" value="Submit" class="button-primary"/>
      </form>
   </div>
<?php
}

function jb_display_wednesday()
{
   $options = get_option( 'jk_op_array' );
?>
   <div class="wrap">
         <script type="text/javascript">
         jQuery(document).ready(function($) {
         $('.custom_date').datepicker({
         });
         });
         </script>
      
      <?php
         if ( isset( $_GET['m'] ) && $_GET['m'] == '1' )
         {
      ?>
            <div id='message' class='updated fade'><p><strong>You have successfully updated the Wednesday service sheet. <a href='/service_sheet/wednesday'>Visit Page</a></strong></p></div>
      <?php
         }
      ?>
      <form method="post" action="admin-post.php">
         <input type="hidden" name="action" value="jk_save_youtube_option2" />
         
         <?php wp_nonce_field( 'jk_op_verify' ); ?>
         <h2>수요예배</h2>
         <table width="70%" cellpadding="10">
            <colgroup><col style="width:10%;"><col></colgroup>
            <tbody>
               <tr>
                  <td><h3>Date</h3></td>
                  <td><input type="text" class="custom_date" name="wedServiceDate"/></td>
               </tr>
               <tr>
                  <td><h3>사회</h3></td>
                  <td>eg: <strong><i>백승지 집사</i></strong><br />
                  <input type="text" name="wedLay" id="wedLay"></td>
               </tr>
               <tr>
                  <td><h3>찬송</h3></td>
                  <td>eg: <strong><i>8</i></strong> or <strong><i>27</i></strong> or <strong><i>451</i></strong><br>
                  1: <input type="text" name="wfirstSong" id="wfirstSong"><br>
                  2: <input type="text" name="wsecondSong" id="wsecondSong"><br>
                  3: <input type="text" name="wlastSong" id="wlastSong">
                  </td>
               </tr>
               <tr>
                  <td><h3>설교</h3></td>
                  <td><input type="text" name="wpreacher" id="wpreacher" value="박영덕 목사"></td>
               </tr>
               <tr>
                  <td style="vertical-align: top;"><h3>성경</h3></td>
                  <td>eg: <strong>누가복음 24장 44~48절(신약p141)</strong><br />
                  성경 Reading: <input type="text" name="wbibleVerse" id="wbibleVerse" size="55"/><br>
                  Full Bible Text:<br><textarea id="wed_bible_text" name="wed_bible_text" cols="80" rows="20"></textarea>
                  </td>
               </tr>
               
            </tbody>
         </table>

         <br />
         <input type="submit" value="Submit" class="button-primary"/>
      </form>
   </div>
<?php
}

function jb_display_information()
{
   ?>
   <div class="wrap">
   <h2>e주보 Creator</h2>
   <p>
   Created by <a href="mailto:matthew.r.weaver@gmail.com">Matthew Weaver</a>.
   <br><br>
   Use the <a href="admin.php?page=create-jubo&tab=sunday">Sunday</a>, <a href="admin.php?page=create-jubo&tab=wednesday">Wednesday</a> and <a href="admin.php?page=create-jubo&tab=announcements">Announcement</a> tabs to create the weekly e주보.
   <br><br>
   <strong>NOTE: This plugin will only work for <i>regular/normal services.</i></strong> Special services with extra items such as 학습, 세례, etc will need to be edited manually through a normal page edit.
   <br><br>
   Download the <a href="/content/korean_bible.zip">Korean text bible here.</a>
   </p>
   </div>
<?php   
}


?>