<?php

/* -= Простейший вариант решения тестового задания =- */

/**
 * Дана строка текста.

 * Написать программу на php,
 * которая определяет является ли строка текста палиндромом (читается с обеих сторон одинаково)
 * и осуществляет вывод строки следующим способом:

 * а) если строка является палиндромом, то она выводится полностью;

 * б) если строка не является палиндромом - выводится самый длинный подпалиндром этой строки,
 * т.е. самая длинная часть строки, являющаяся палиндромом;

 * в) если подпалиндромы отсутствуют в строке - выводится первый символ строки.

 * Примеры палиндромов:
 * - Аргентина манит негра
 * - Sum summus mus
 */

/**
 * Функция test - проверяет строку на наличие палиндрома
 * @param string $str
 * @return bool
 */
function test(string $str)
{
    $lower = mb_strtolower($str);
    $trim = str_replace(' ', '', $lower);;
    $one = iconv('utf-8', 'windows-1251', $trim);
    $two = strrev($one);
    $res = iconv('windows-1251', 'utf-8', $two);

    $verify = ($trim === $res) ? true : false;
    return $verify;
}

/**
 * Функция result - 3 варианта вывода, в зависимости от результата функции test
 * @param string $str
 * @return string
 */
function result(string $str)
{
    $verify = test($str);
    if (false === $verify) {
        $mass = explode(' ', $str);
        foreach ($mass as $el) {
            $test = test($el);
            if (false === $test) {
                continue;
            }
            $true = $el;
        }
        if (empty($true)) {
            $res = mb_substr($str, 0, 1);
        } else {
            $res = $true;
        }

    } else {
        $res = $str;
    }

    return $res;
}


if (isset($_POST['text'])) {
    $view = result($_POST['text']);
} else {
    $view = '';
}
?>

    <form action="/palindrome.php" method="post">
        текст
        <input type="text" name="text" value="<? echo $_POST['text'];?>">
        <input type="submit">
    </form>
<?php echo $view;?>
