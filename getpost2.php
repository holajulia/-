<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GET - POST</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
</head>
<body>
	<div class="ui centered grid">
		<div class="row"></div>
		<div class="row">
			<div class="six wide column">
				<form method="get" class="ui form">
					<div class="field">
						<label>ВВЕДИТЕ СВОЙ АЙДИ:</label>
						<input type="text" name="id" placeholder="GET Parameter">
					</div>
					<button class="ui button" type="submit">Send</button>
				</form>
				<div class="ui divider"></div>
				<form method="post"  class="ui form">
					<div class="field">
						<label>СЮДА ТОЖЕ</label>
						<input type="text" name="id" placeholder="POST Parameter">
					</div>
					<button class="ui button" type="submit">Send</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="ui segment">
				<?php 
				if (isset($_GET['id'])) {
					echo 'ГЕТОМ  ID ' . (int)$_GET['id'];
				} elseif (isset($_POST['id'])) {
					echo 'ПОСТОМ ID ' . (int)$_POST['id'];
				} else {
					echo 'ВООБЩЕ НИЧЕГО НЕТ >=[';
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>