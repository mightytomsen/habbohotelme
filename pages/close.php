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
$error = true;
$login = new Login($GLOBALS['connection']);
if($login->isLoggedIn()) {
	if(isset($_GET['id'])) {
		if(is_numeric($_GET['id'])) {
			if($forum->editPermission_thread($_GET['id'])) {
				$error = false;
			}
		}
	}
}

if($error) {
	header('Location: ' . Config::PATH . '/forum');
}

$type = $_GET['type'];	
$postData = $forum->loadPostdata($_GET['id'], $type);

$forum->closeTopic($_GET['id']);
header('Location: ' . Config::PATH . '/forum');
?>

