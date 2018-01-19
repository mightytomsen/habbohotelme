<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="de">
    	<?php require_once 'classes/Config.php'; ?>
		<?php require_once 'classes/autoload.php'; ?>
        <?php
			$pages = [
				[
					"url" => "/",
					"name" => "home"
				],
				
				[
					"url" => "/forum",
					"name" => "forum"
				],
                            
				[
					"url" => "/registrieren",
					"name" => "registrieren"
				],
                            
				[
					"url" => "/login",
					"name" => "login"
				],
			
				[
					"url" => "/logout",
					"name" => "logout"
				],
				
				[
					"url" => "/edit",
					"name" => "edit"
				],

				[
					"url" => "/close",
					"name" => "close"
				],

				[
					"url" => "/create",
					"name" => "create"
				]
			];
		?>
	
    <?php
	$templateHandler = new TemplateHandler(Config::PHP_PATH . "\pages");
	$route = new Route();
        $route->setTemplateHandler($templateHandler);
	
	$connection = new Connection(new MySQLi(Config::MYSQL_HOST,Config::MYSQL_USER,Config::MYSQL_PASSWORD,Config::MYSQL_DATABASE,Config::MYSQL_PORT));
        $connection->utf();
	
	foreach($pages as $site) {
		$route->add($site["url"], function(TemplateHandler $templateHandler) use($site) {
			$tpl = $templateHandler->getTemplate($site["name"] . '.php');
			$tpl->display(true);
		});	
	}
	
	$route->submit();
	?>
        
</html>