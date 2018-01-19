
        <title>Habme: Einloggen und losschreiben!</title>
        <meta name="description" content="Log dich im Habbohotel.me Community Forum ein, um mit Staffs oder User zu schreiben!">

    </head>

    <body>
        <form method="post" action="<?php echo Config::PATH;?>/login">
            <?php
                $login = new Login($GLOBALS['connection']);
				
                if(isset($_POST['login'])) {
                    $login->execute($_POST['username'], $_POST['password']);
                }

            ?>
            <input type="text" name="username" class="logininput"><br />
            <input type="password" name="password" class="logininput"><br />
            <input type="Submit" name="login" class="logininput" value="Einloggen">
        </form>
    </body>
