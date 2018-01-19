
        <title>Habme: Völlig kostenlose Registrierung. Werde ein Habbo!</title>
        <script type="text/javascript" src="lib/js/stylechooser.js"></script>
        <script type="text/javascript">var styler = new Stylechooser();</script>
        <meta name="description" content="Registriere dich völlig kostenfrei im Habbohotel.me Community Forum. Chatte mit Staffs oder andere User und erhalte zum Start viele Starttaler und Rares!">

    </head>

<?php
    $register = new Register($GLOBALS['connection']);
?>

    <body>
      <script>
      styler.loadColor();
      </script>
        <link rel="stylesheet" href="styles/register.css">

        <div id="errorBox">
            <div id="errorMsg"><?php $register->showError(); ?></div>
        </div>

        <script>

            $(document).ready(function(){
              $(".r_button").css('background-color', getCookie("background"));
              checkOnError();
            });

            function checkOnError() {
                if ($("#errorMsg > *").length > 0) {
                    if($(".form-error").text().length > 0) {
                        $('#errorBox').show();
                    }
                }
            }




         </script>
        <script>
            var $messages = $('#errorMsg');
        </script>

        <div class="container animated fadeInDown">
            <img src="web-gallery/logo.png" id="logo">

                <h1 class="r_headtitle">Registriere dir jetzt schon deinen Habbo Account!</h1><br />
                <div class="r_subtext">Reservier dir deinen Namen im Habbohotel.me und erhalte als kleines dankeschön seltene Rares & Badges!
                    Nach Eröffnung des Hotels, erhalten alle User, die sich im Zeitraum vom 15.02.16 bis zum 29.02.16 vorregistriert haben,
                    ihre extra Prämie, die es <u>nur</u> zu diesem Anlass gibt. Außerdem kannst du mit einem Account jederzeit in unserem
                    Habbo Forum schreiben und dich mit anderen User austauschen.
                </div>


                    <?php
                        //global $connection;
                        if(isset($_POST['r_user'], $_POST['r_mail'], $_POST['r_pw'], $_POST['r_repw'])){
                            $abfrage =  $register->validate($_POST['r_user'], $_POST['r_mail'], $_POST['r_pw'], $_POST['r_repw']);
                            if($abfrage){
                                $register->execute($_POST['r_user'], $_POST['r_mail'], $_POST['r_pw']);
                            }
                        }
                    ?>
                <form method="POST" style="float: left;">
                  <div style="float: left; margin-right: 10px;">
                    <input type="text" name="r_user" class="r_input" placeholder="Dein Benutzername"><br />
                    <input type="text" name="r_mail" class="r_input" placeholder="Deine E-Mail Adresse"><br />
                  </div>
                    <input type="password" name="r_pw" class="r_input" placeholder="Dein Passwort"><br />
                    <input type="password" name="r_repw" class="r_input" placeholder="Passwort wiederholen"><br />
                    <input type="submit" name="registration" class="r_button" value="Registieren">
                </form>
                <img src="web-gallery/reg.png" style="float: left; margin-top: -10px; margin-left: 85px;">



        </div>
    </body>
