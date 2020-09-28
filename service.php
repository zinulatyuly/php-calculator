<?php

function solve(string $str): float
{
    $openBracket = strrpos($str, "(");
    if ($openBracket === false) return solveInsideBrackets($str);
    $strAfterOpenBracket = substr($str, $openBracket, strlen($str) - $openBracket);
    $closeBracket = strpos($strAfterOpenBracket, ")");
    $resultInsideBrackets = solveInsideBrackets(substr($str, $openBracket + 1, $closeBracket - 1));
    $str = str_replace_last(substr($str, $openBracket, $closeBracket + 1), $resultInsideBrackets, $str);
    return solve($str);
}

function solveInsideBrackets(string $str): float
{
    $operations = ['^', '/', '*', '+', '-'];
    $result = 0;
    while ($str) {
        foreach ($operations as $operation) {
            $pattern = '/([+-]?)([0-9]+)\\' . $operation . '([0-9]+)/';
            if (preg_match($pattern, $str, $matches)) {
                $str = preg_replace('/' . preg_quote($matches[0], '/') . '/', '', $str);
                $result += solveSimpleEquation(floatval($matches[2]), floatval($matches[3]), $operation, $matches[1]);
                break;
            }
        }
        if (preg_match('/^([+-]?)[0-9]+\.?[0-9]*$/', $str)) {
            $result += floatval($str);
            $str = '';
        }
    }
    return $result;
}

function solveSimpleEquation(float $first, float $second, string $operation, string $beforeSign): float
{
    $coefficient = $beforeSign === '-' ? -1 : 1;
    if ($first === '') return $second;
    if ($second === '') return $first;
    switch ($operation) {
        case '^':
            return $coefficient * pow($first, $second);
        case '+':
            return $coefficient * $first + $second;
        case '-':
            return $coefficient * $first - $second;
        case '*':
            return $coefficient * $first * $second;
        case '/':
            return $coefficient * $first / $second;
    }
}

function str_replace_last($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);
    if ($pos !== false) $subject = substr_replace($subject, $replace, $pos, strlen($search));
    return $subject;
}