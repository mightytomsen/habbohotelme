		<title>Habme: Community Forum, lerne neue Freunde kennen, unterhalte dich mit Staffs und tausch dich aus!</title>
        <meta name="description" content="Das Habbohotel.me Community Forum ist ein toller Ort, um neue Freunde kennenzulernen! Nehme bei Gewinnspielen teil und unterhalte dich mit Staffs!">
        <script type="text/javascript" src="lib/js/stylechooser.js"></script>
        <script type="text/javascript">var styler = new Stylechooser();</script>
        <link rel="stylesheet" href="styles/forum.css">

        <script src="lib/js/forum.js"></script>
        <script>
        $(function() {
          $( document ).tooltip();
        });r
        </script>
        <style>
        #communityContent, #announcementContent {
                display:none;
        }

        #threadPopup {
                display:none;
        }
        </style>


    </head>

<?php
	$forumObj = new Forum();
  $slogin = new Login($GLOBALS['connection']);

	$threads = $forumObj->loadEntries();

	if(isset($_GET["showthread"])) {
		if(is_numeric($_GET["showthread"])) {
			if($forumObj->existsTopic($_GET["showthread"])) {
				$thread = $forumObj->showthread_popup($_GET["showthread"]);
				if(isset($_GET["category"])) {
					echo "<script>$(document).ready(function() { forumConstruct.showEntries('" . $_GET["category"] . "') });</script>";
				}
				echo "<script>$(document).ready(forumConstruct.displayTopic);</script>";
			}
		}
	}

  ?>
    <body>


    <script>styler.loadColor();</script>
    <div id="cocontainer">
      <div id="co" class="bg1" onclick="styler.changeBackground('#3498db');" style="background: #3498db;"></div>
      <div id="co" class="bg2" onclick="styler.changeBackground('#fdb145');" style="background: #fdb145;"></div>
      <div id="co" class="bg3" onclick="styler.changeBackground('#87D37C');" style="background: #87D37C;"></div>
      <div id="co" class="bg4" onclick="styler.changeBackground('#b46acf');" style="background: #b46acf;"></div>
      <div id="co" class="bg4" onclick="styler.changeBackground('#F5D76E');" style="background: #F5D76E;"></div>
    </div>
    <div id="overlay"></div>
        <div id="threadPopup">


                <?php
                  if(isset($_GET['showthread'])) {
                  $data = $forumObj->loadTopic($_GET['showthread']);
                  foreach($data as $topicdata){
                ?>
                <div class="line" style="margin-top: -10px;">
                  <img src="web-gallery/threadpin.png" style="margin-top: 17px;margin-right: 20px;float: left;">
                  <?php echo $topicdata['title']; ?>
                    - von
                  <?php echo $topicdata['username']; ?>
                </div>
            <div class="abtrenner" style="margin-bottom:10px;"></div>
            <div class="threadcontent">
              <div class="topicpost">
                <div class="commentarea post<?php echo $topicdata['id']; ?>">
                    <div class="leftcom">
                      <br /><br />
                    <div class="auuser"><?php echo $topicdata['username']; ?></div>
                    <div class="auimg" style="background: url(<?php echo $topicdata['avatar']; ?>)30% 40%;"></div>

                    
                    <div class="userrank" style="background: url(web-gallery/userbar.png),#F7CA18;">Thread-Ersteller</div>
                    </div>
                  <div class="rightcom">
                    <div class="postdate"><span style="font-weight: bold;"><?php echo $topicdata['title']; ?></span><div style="float: right;"><img src="web-gallery/owner_icon.gif" title="Verfasser des Themas" style="margin-top: -6px;"></div>
                        <div style="float:right">
                            <?php 
                              if($slogin->isLoggedIn(true)) {
                              if($_SESSION['username'] == $topicdata['username'] || $forumObj->hasAdmin($_SESSION['username'])) { ?>
                              <a href="<?php echo Config::PATH; ?>/edit?id=<?php echo $topicdata['id']; ?>&type=thread">
                                <div style="background:none; border:none; background-image:url('web-gallery/edit.gif'); width:16px; height:16px"></div>
                              </a>

                              <a href="<?php echo Config::PATH; ?>/close?id=<?php echo $topicdata['id']; ?>">
                                <div style="background:none; border:none; background-image:url('web-gallery/close.gif'); width:16px; height:16px"></div>
                              </a>
                            <?php }} ?>
                        </div>
                    </div>
                   <div class="usercomment"><?php echo $topicdata['content']; ?></div>
                 </div>
                </div>

                  <?php }} ?>


                    <?php if(isset($_SESSION['username'])){ ?>


                        <?php

                        if(isset($_POST['commentsubmit'])){
                            if($topicdata['close'] < 1) {
                              $forumObj->comment($_POST['comment'], $_SESSION['username'], $_SESSION['avatar'], $_GET['showthread']);
                            }
                        }
                        ?>

                <?php } ?>
                    <br />


                    <?php
                        $data = $forumObj->loadComment($_GET['showthread']);
                        foreach($data as $topicComment){
                    ?>

                    <div class="commentarea post<?php echo $topicComment['id']; ?>">
                        <div class="leftcom">
                          <br /><br />
                        <div class="auuser"><?php echo $topicComment['username']; ?></div>
                        <div class="auimg" style="background: url(<?php echo $topicComment['avatar']; ?>)30% 40%;"></div>

                        

                        </div>
                      <div class="rightcom">
                        <div class="postdate">
                            Geschrieben am: <?php echo $topicComment['date']; ?><div style="float: right;"><img src="web-gallery/date.png" style="margin-top: -5px;" title="postID: <?php echo $topicComment['id']; ?>"></div>
                            <div style="float:right;">
                                <?php 
                                if($slogin->isLoggedIn(true)) {
                                if($_SESSION['username'] == $topicComment['username'] || $forumObj->hasAdmin($_SESSION['username'])) { ?>
                                  <a href="<?php echo Config::PATH; ?>/edit?id=<?php echo $topicComment['id']; ?>&type=post">
                                    <div style="background:none; border:none; background-image:url('web-gallery/edit.gif'); width:16px; height:16px"></div>
                                  </a>
                                <?php }} ?>
                            </div>
                        </div>
                        <div class="usercomment"><?php echo $topicComment['content']; ?></div>
                     </div>
                    </div>


                    <?php } ?>

                    
                </div>
            </div>
        </div>

      <div class="header">
        <div class="headcon">
          <img id="logo" src="web-gallery/logo.png" style="margin-top:45px; float: left; ">
          <div class="place">Community place</div>
          <?php if (isset($_SESSION['username'])){?>
          <a href="<?php echo Config::PATH; ?>/logout"><div class="place" style="float: right; background:rgba(217, 30, 24, 0.5);">Logout</div></a>
          <?php }else{ ?>
          <a href="<?php echo Config::PATH; ?>/login"><div class="place" style="float: right; background:rgba(135, 211, 124, 0.8);">Einloggen</div></a>
          <a href="<?php echo Config::PATH; ?>/registrieren"><div class="place" style="float: right; background:rgba(34, 167, 240, 0.8);">Registrieren</div></a>
          <?php } ?>
          <div class="nav">
            <div class="body"></div>
            <div class="icon1"></div>
            <div class="icon2"></div>
          </div>
        </div>
      </div>
      <div class="dash">
        <div class="line">
            <h1 style="font-family: Roboto;">Willkommen im Forum, <?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } else { echo "Gast"; } ?>! </h1>
        </div>
        <div class="abtrenner"></div>
        <div class="dashcon">
          <div id="comEntries" class="com" alt="Habbohotel.me Community Beiträge von unseren Habbo User" style="cursor:pointer;"></div>
          <div id="annoEntries" class="ank" alt="Habbohotel.me Ankündigungen von unseren Habbo Staffs" style="cursor:pointer;"></div>
        </div>

        <a href="<?php echo Config::PATH; ?>/create">Thema erstellen</a><br>
        <a href="<?php echo Config::PATH; ?>/create&type=announcement">Thema erstellen (Announcement)</a><br>

        <div class="abtrenner" style="margin-top: 35px;"></div>
        <div class="line" style="margin-top: -20px;">Die aktuellsten Beiträge aus dem Community Forum</div>
        <div class="abtrenner" style="margin-bottom:50px;"></div>
           <div id="communityContent">
           <?php
                          foreach($threads['community'] as $topic) {
                                  echo ("
                                  <div class='dashcon'>
                                          <div class='balkencontent'>
                                                  <div class='balkengreen'>" . strtoupper($topic['type']) .  "</div>
                                                  <div class='userpost'>by " . htmlspecialchars(strtoupper($topic['username'])) .  "</div>
                                          </div>

                                          <div class='updatelineright' style='font-family:Roboto; width:550px;'>
                                                  <div onclick='forumConstruct.showTopic(\"" . $topic['type'] . "\", " . $topic['id'] . ")' class='shorttitle'>" . $topic['title'] .  "</div>
                                                  <div class='shorttext'>" . nl2br(substr($topic['content'],0,230)) .  "...</div>
                                          </div>
                                          <div class='rightavatarcontent'>
                                                  <div class='useravatar' style='background: url(" . $topic['avatar'] .  ")50% 30%;'></div>
                                          </div>
                  </div>

                          <div class='shorttrenner' style='margin-bottom:50px;'></div>
                                  ");
                          }
                    ?>
          </div>
          <div id="announcementContent">
           <?php
                          foreach($threads['announcement'] as $topic) {
                                  echo ("
                                  <div class='dashcon'>
                                          <div class='balkencontent'>
                                                  <div class='balken'>" . strtoupper($topic['type']) .  "</div>
                                                  <div class='userpost'>by " . htmlspecialchars(strtoupper($topic['username'])) .  "</div>
                                          </div>

                                          <div class='updatelineright' style='font-family:Roboto; width:550px;'>
                                                  <div onclick='forumConstruct.showTopic(\"" . $topic['type'] . "\", " . $topic['id'] . ")' class='shorttitle'>" . $topic['title'] .  "</div>
                                                  <div class='shorttext'>" . nl2br(substr($topic['content'], 0, 230)) .  "...</div>
                                          </div>
                                          <div class='rightavatarcontent'>
                                                  <div class='useravatar' style='background: url(" . $topic['avatar'] .  ")50% 30%;'></div>
                                          </div>
                  </div>

                          <div class='shorttrenner' style='margin-bottom:50px;'></div>
                                  ");
                          }
                    ?>
          </div>
        </div>
    </body>
