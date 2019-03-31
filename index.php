<?php

$_mysql_host = "localhost";
$_mysql_user = "petrova";
$_mysql_password = "lRkh7ExW";
$_mysql_database = "site";

try {
    $connection = new PDO("mysql:host={$_mysql_host}; dbname={$_mysql_database}", $_mysql_user, $_mysql_password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $categories = $connection->query('SELECT categories.* FROM categories')->fetchAll();

    for ($i=0; $i < count($categories); $i++) {
    	$links[$categories[$i]['id']] = $connection->query("SELECT links.* FROM links WHERE category_id = {$categories[$i]['id']}")->fetchAll();
    }

} catch (PDOException $e) {
    throw new Exception($e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>2LevelMenu</title>

	<!-- Подключаем всякую дич по типу jQuery (ну и semantic-ui, для стилей) -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</head>
<body>
	<!-- HTML сетка (grid) -->
	<div class="ui centered grid">
		<!-- Один ROW для отступа сверху -->
		<div class="row"></div>
		<!-- ROW для самой менюшки -->
		<div class="row">
			<!-- Колонка для менюшки, которая будет занимать 15 частей от размера экрана (всего их 16 в semantic-ui) -->
			<div class="fifteen wide column">
				<!-- Элемент вертикального меню -->
				<div class="ui vertical menu">
					<!-- Сами item-ы -->
					<?php for ($i=0; $i < count($categories); $i++) { ?>
					<!-- Проходим по всем категориям -->
						
					<div class="item">
						<!-- Пихаем имя категории -->
						<div class="header"><?=$categories[$i]['name']?></div>
						<div class="menu">
							<!-- Проходимся по всем субкатегориям с id как у category_id -->
							<?php for ($x=0; $x < count($links[$categories[$i]['id']]); $x++) { ?>								
								<a href="<?=$links[$categories[$i]['id']][$x]['link']?>" class="item"><?=$links[$categories[$i]['id']][$x]['value']?></a>
							<?php } ?>

						</div>
					</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>