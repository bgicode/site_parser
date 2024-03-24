<?php
declare(strict_types = 1);
include_once('readWriteCSV.php');
require_once('parsing.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parsing</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="./script.js" type="text/javascript"></script>
</head>
<body>
    <div class="wraper">
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
            <label>URL</label>
            <input class="input" type="url" name="url" required />
            <label>Тэг</label>
            <input class="input" type="text" name="tag" required />
            <label>Класс тэга</label>
            <input id="tagClass" class="input" type="text" name="tagClass" />
            <div class="input checkboxWraper">
                <input id="checkbox" type="checkbox" name="checkbox" />
                <span>выбрать класс тэга</span>
            </div>
            <input class="input" type="submit" name="booking" value="Получить кол-во тэгов">
        </form>
        <div>
            <div class="listTitle">Исторя поиска</div>
            <?php
            if ($data = Read($dataPath)) {
                echo '<table>';
                foreach ($data as $line) {
                    echo '<tr>';
                    foreach ($line as $cel) {
                        echo '<td>' . $cel . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
    </div>
</body>
</html>
