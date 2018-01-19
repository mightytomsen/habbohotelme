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
$forum = new Forum();
$login = new Login($GLOBALS['connection']);
$type = "community";
$errors = [];

if(isset($_GET['type'])) {
    if($_GET["type"] == "announcement") {
        $type = $_GET["type"];
        if(!$forum->hasAdmin($_SESSION['username'])) {
            header('Location: ' . Config::PATH . '/forum');
        }
    }
}

if(!$login->isLoggedIn()) {
	header('Location: ' . Config::PATH . '/forum');
}

if(isset($_POST['submit'])) {
    if(empty($_POST['title'])) {
        array_push($errors, "Bitte wähle einen Titel!");
    } elseif(empty($_POST['content'])) {
        array_push($errors, "Du kannst kein Thema ohne Inhalt erstellen!");
    }

    if(empty($errors)) {
        $forum->createTopic($_POST['title'], $_POST['content'], $_SESSION['username'], $type);
        header('Location: ' . Config::PATH . "/forum");
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

      <?php
        if(!empty($errors)) {
            echo $errors[0];
        }
      ?>

      <div class="dash">
        <div class="line">
            <form method="post" action="<?php echo Config::PATH . '/create?type=' . $type; ?>">
                <input type="text" name="title" placeholder="Titel"><br>
                <textarea name="content"></textarea><br>
                <input type="submit" name="submit">
            </form>
        </div>

      </div>
    </body>

