<?php
declare(strict_types = 1);

include_once('functions.php');
include_once('sources.php');

$tagsCount = 0;
$SearchDate = date("d-m H:i");

if ($_POST['booking']) {
    $url = trim(($_POST['url']));

    // проверка возможности получить разметку сайта
    if (GetLayout($url)) {
        $layout = GetLayout($url);
    } else {
        EndScript('по данному URL отсутсвует разметка');
    }

    // выбранный тэг исправление ошибки при копировании и попадание <> c пробелами
    $tag = trim(preg_replace('/(?:^|^\s{0,})<|>(?:$|\s$)/', '', ($_POST['tag'])));

    // валидация тега допускаются толко цифры, буквы, (_) и (-) первый символь только буква
    if (!preg_match('/^[a-z][\w_\-]{0,}$/m', $tag)) {
        EndScript('неправильный тэг');
    }

    // строка для поиска по классу по умолчанию пустая
    $regExClass = '';

    // фильтрация названия класса
    if ($_POST['tagClass']) {
        $tagClass = trim(($_POST['tagClass']));

        // валидация класса тега допускаются толко цифры, буквы, (_) и (-) первый символь только буква или цифра
        if (!preg_match('/^[a-z0-9][\w\-]+?$/', $tagClass)) {
            EndScript('вероятно в названии класса ошибка');
        }

        // регулярное выражение для поиска класса тэга
        $regExClass = '(class\s*?=\s*?\"[^<>\"\']*\b' . $tagClass . '[^<>\"\']*\")[^<>]*>';
    }

    // регулярное выражение для поиска тэга
    $regExTag ="/(?<!<!--.{0, })(<" . $tag . "[^<>]*" . $regExClass . ")(?!.*?-->)/";

    // нахождение совпадений в полученной разметке
    preg_match_all($regExTag, $layout, $matches);

    $tagsCount = count($matches[1]);

    $arSearchData = [$SearchDate, $url, $tag, $tagClass, $tagsCount];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Success($dataPath, $arSearchData);
    }
}
