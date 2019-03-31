<?php
require('./A.php');
$rubric_count = 3;
$sub_rubric_count = 2;
$rubric = [];
$sub_rubric = [];
for ($i = 0; $i < $rubric_count; $i++) {
    $rubric[$i][0] = 'Rubric ' . $i;
    $rubric[$i][1] = 'Description ' . $i;
}
for ($i = 0; $i < $sub_rubric_count; $i++) {
    $sub_rubric[$i][0] = 'SubRubric ' . $i;
    $sub_rubric[$i][1] = 'Description ' . $i;
}
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
} elseif (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
} else {
    $id = -1;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <title>ID</title>
</head>
<body>
<div class="ui centered grid">
    <div class="row"></div>
    <div class="row">
        <div class="four wide column">
            <div class="ui segment">
                <form method="post" action="?<?= rand(0, 100000) ?>">
                    <div class="ui form">
                        <div class="field">
                            <h2>ID</h2>
                            <input type="text" name="id" size="2" placeholder="Введите ID">
                        </div>
                        <input type="submit" value="Далее" class="ui fluid button">
                    </div>
                </form>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="four wide column">
                <div class="ui segment">
                    <?php if ($id == -1) { ?>
                        <?php for ($i = 1; $i <= $rubric_count; $i++) { ?>
                            <a href="menuall.php?id=<?=$i ?>">Rubric <?=$i ?></a><br>
                            <?php for ($j = 1; $j <= $sub_rubric_count; $j++) { ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="menuall.php?sub=1&id=<?=$j ?>">SubRubric <?=$j ?></a><br>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <h3>ID: <?= $id ?></h3>
                        <?php if (isset($_GET['sub'])) { ?>
                            (sub)
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
</body>
</html>
