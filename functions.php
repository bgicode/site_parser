<?php
// получение разметки из выбранного сайта
function GetLayout(string $url) : string
{
    $connect = curl_init($url);
    curl_setopt($connect, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($connect, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($connect, CURLOPT_CONNECTTIMEOUT, 5);
    $html = curl_exec($connect);
    curl_close($connect);
    return $html;
}

// вывод сообщения и выход из программы
function EndScript(string $massage) : void
{
    exit("<div style='margin-left: 20px; margin-top: 20px;'>
            <p>$massage</p>
            <a href='/index.php' style = 'margin-bottom: 15px; padding: 10px 20px; display: inline-block;
            background: rgb(200, 200, 200); text-decoration: none;'>OK</a>
        </div>");
}

// запись в базу и формирование сообщения об успехе
function Success(string $dataPath, array $arSearchData) : void
{
    Write($dataPath, $arSearchData);

    if ($arSearchData[3]) {
        $SuccessfulMassage = "на сайте <strong>" . $arSearchData[1] . "</strong> найдено тэгов <strong>" . $arSearchData[2] . "</strong> c классом \"<strong>" . $arSearchData[3] . "</strong>\" в количестве: <strong>" . $arSearchData[4] . "</strong> шт.";
    } else {
        $SuccessfulMassage = "на сайте <strong>" . $arSearchData[1] . "</strong> найдено тэгов <strong>" . $arSearchData[2] . "</strong> в количестве: <strong>" . $arSearchData[4] . "</strong> шт.";
    }

    EndScript($SuccessfulMassage);
}
