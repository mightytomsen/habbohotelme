
        <title>Habme: Kostenlose Taler, Rares und Events!</title>
        <script type="text/javascript" src="lib/js/stylechooser.js"></script>
        <script type="text/javascript">var styler = new Stylechooser();</script>
        
        <meta name="keywords" content="habbo.de, habbohotel, habbohotel.me, habbo retro, retro hotel, retro, kostenlose taler, kostenlos, habbo rares, staffs, habme, habhotel.me">
        <meta name="description" content="Im Habbohotel.me kriegst du täglich kostenlose Taler und Rares, gefolgt von super coolen Events! Registrier dich jetzt komplett kostenfrei und trete einer unglaublichen Community bei!">
    </head>

    <body>
        <script>styler.loadColor();</script>
        <div id="cocontainer">
          <div id="co" class="bg1" onclick="styler.changeBackground('#3498db');" style="background: #3498db;"></div>
          <div id="co" class="bg2" onclick="styler.changeBackground('#fdb145');" style="background: #fdb145;"></div>
          <div id="co" class="bg3" onclick="styler.changeBackground('#87D37C');" style="background: #87D37C;"></div>
          <div id="co" class="bg4" onclick="styler.changeBackground('#b46acf');" style="background: #b46acf;"></div>
          <div id="co" class="bg4" onclick="styler.changeBackground('#F5D76E');" style="background: #F5D76E;"></div>
        </div>
        <div class="container animated fadeInDown">
            <div class="maincontainer">
                <div class="leftsite">
                    <img id="logo" src="web-gallery/logo.png" alt="Habbohotel.me: Kostenlose Taler und Rares!" style="margin-top:-45px; margin-left:60px;">
                    <div class="update">
                        <i class="fa fa-clock-o cock"></i>
                        Updates
                    </div>
                    <?php
					$connection = new Connection(new MySQLi(Config::MYSQL_HOST,Config::MYSQL_USER,Config::MYSQL_PASSWORD,Config::MYSQL_DATABASE,Config::MYSQL_PORT));
					$connection->utf();
                    $queryUpdates = $connection->query("SELECT * FROM maintance ORDER BY id DESC LIMIT 5");
					
					$data = [];
					
					while($row = $queryUpdates->fetch_assoc()){
						array_push($data, $row);
					}
					
					foreach($data as $updates){
                    ?>
                    <div class="team">
                        <div class="teamavatar" style="background: url(<?php echo $updates['avatar']; ?>)50% 30%;">

                        </div>
                        <div class="teamname">
                            <?php echo $updates['username']; ?>
                        </div>

                        <div class="teamwork">
                            <?php echo $updates['work']; ?>
                        </div>
                    </div>
                    <?php } ?>

                </div>

                <div class="rightsite">
                    <div class="rtscon">
                        <?php
                        foreach($data as $updates){

                        ?>

                        <div class="updateline">
                            <div class="updateblock">UPDATE</div>
                            <div class="updatebyuser">by <?php echo $updates['username']; ?></div>
                        </div>

                        <div class="updatelineright">
                            <div class="updatetitle"><?php echo $updates['title']; ?></div>
                            <div class="updatecontent"><?php echo $updates['content']; ?></div>
                        </div>
                        <div class="teamavatar" style="background: url(<?php echo $updates['avatar']; ?>)50% 30%;"></div>
                        <div class="trenner"></div>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </body>
    