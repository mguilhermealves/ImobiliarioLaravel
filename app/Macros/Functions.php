<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

function pre($expression, bool $json = true, bool $stop = true)
{
    echo '<pre>';
    if ($json) {
        echo print_r($expression);
    } else {
        var_dump($expression);
    }
    if ($stop) {
        die();
    }
}

function assets($file = null)
{
    return url('/') . "/resources/assets/{$file}";
}

function dateBdToApp($date)
{
    $old = new Datetime($date);

    return $old->format('d/m/Y');
}

function dateToApp($date)
{
    if ($date) {
        $old = new Datetime($date);

        return $old->format('Y-m-d');
    }

    return null;
}

function dateToAppYear($date)
{
    if ($date) {
        $old = new Datetime($date);

        return $old->format('Y');
    }

    return null;
}

function dateAppToBd($date)
{
    if ($date) {
        $old = \Carbon\Carbon::createfromformat('d/m/Y', $date);

        return $old->format('Y-m-d');
    }

    return null;
}

function dateTimeAppToBd($date)
{
    if ($date) {
        $old = \Carbon\Carbon::createfromformat('d/m/Y H:i:s', $date);

        return $old->format('Y-m-d H:i:s');
    }

    return null;
}

function dateAppToBdYear($date)
{
    if ($date) {
        $old = \Carbon\Carbon::createfromformat('Y', $date);

        return $old->format('Y-m-d');
    }

    return null;
}

function dateInFull($date)
{
    if ($date) {
        $old = \Carbon\Carbon::createFromFormat('Y-m-d', $date);

        return $old->formatLocalized('%e de %B de %Y');
    }

    return null;
}

function dateTimeBdToApp($date)
{
    if ($date != '0000-00-00 00:00:00') {
        $old = new Datetime($date);

        return $old->format('d/m/Y H:i:s');
    }

    return null;
}

function timeBdToApp($date)
{
    if ($date != '0000-00-00 00:00:00') {
        $old = new Datetime($date);

        return $old->format('H:i:s');
    }

    return null;
}

function currencyToBd($str)
{
    $s = preg_replace('/[^0-9,]/', '', $str);

    return preg_replace('/[,]/', '.', $s);
}

function currencyToApp($curr)
{
    return 'R$ ' . number_format($curr, 2, ',', '.');
}

function currencyToAppOnlyNumbersFront($curr)
{
    if ($curr) {
        return number_format($curr, 2, ',', '.');
    }

    return null;
}

function currencyToAppOnlyNumbers($curr)
{
    if ($curr) {
        return number_format($curr, 2, ',', '.');
    }

    return null;
}

function break_text($text, $limit)
{
    if (strlen($text) > $limit) {
        $pos = strpos($text, ' ', $limit);

        return substr($text, 0, $pos) . '...';
    }

    return $text;
}

function limpaNumeros($n)
{
    return preg_replace('/[^0-9]/', '', $n);
}

function preparaTelefone($n)
{
    $tel = preg_replace('/[^0-9]/', '', $n);
    $ddd = substr($tel, 0, 2);
    $numero = substr($tel, 2, 10);

    return [$ddd,$numero];
}

function cpfToApp($value)
{
    $cnpj_cpf = preg_replace("/\D/", '', $value);

    if (strlen($cnpj_cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", '$1.$2.$3-$4', $cnpj_cpf);
    }

    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", '$1.$2.$3/$4-$5', $cnpj_cpf);
}

function getFirstName($name)
{
    $names = explode(' ', $name);

    return reset($names);
}

function multiKeyExists(array $arr, $key)
{
    if (array_key_exists($key, $arr)) {
        return true;
    }

    foreach ($arr as $element) {
        if (is_array($element)) {
            if (multiKeyExists($element, $key)) {
                return true;
            }
        }
    }

    return false;
}

function unique_multidim_array($array, $key)
{
    $temp_array = [];
    $i = 0;
    $key_array = [];

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }

    return $temp_array;
}

function nl2p($text)
{
    return '<p>' . str_replace(["\r\n", "\r", "\n"], '</p><p>', $text) . '</p>';
}

function routeName()
{
    $previousRequest = app('request')->create(app('url')->previous());

    try {
        $routeName = app('router')->getRoutes()->match($previousRequest)->getName();
    } catch (NotFoundHttpException $exception) {
        return null;
    }

    return $routeName;
}

function yesNo(Int $value)
{
    return 0 == $value ? 'Não' : 'Sim';
}

function limitless(Int $value)
{
    return 0 == $value ? 'Ilimitado' : $value;
}
