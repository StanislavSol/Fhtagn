<?php

const BASE_ELEMENTS = 1;
const ELEMENTS_STEP = 2;
const MIN_NUMBER = 1;
const REQUIRED_ARGS = 2;
const CLI_INTERFACE = 'cli';

function calculateTriangle(int $totalNumbers): void {
    $rows = 0;
    $usedNumbers = 0;
    
    while (true) {
        $nextRow = BASE_ELEMENTS + ($rows * ELEMENTS_STEP);
        if ($usedNumbers + $nextRow > $totalNumbers) break;
        $rows++;
        $usedNumbers += $nextRow;
    }

    if ($usedNumbers != $totalNumbers) {
        echo "Невозможно построить треугольник\n";
        return;
    }

    $currentNumber = 1;
    for ($row = 1; $row <= $rows; $row++) {
        $elements = BASE_ELEMENTS + (($row - 1) * ELEMENTS_STEP);
        $spaces = str_repeat(' ', $rows - $row);
        $numbers = [];
        
        for ($i = 0; $i < $elements; $i++) {
            $numbers[] = $currentNumber++;
        }
        
        echo $spaces . implode(' ', $numbers) . "\n";
    }
}

if (php_sapi_name() !== CLI_INTERFACE) {
    exit("Запускайте только через командную строку\n");
}

if ($argc != REQUIRED_ARGS || !is_numeric($argv[1])) {
    exit("Используйте: php triangle.php <число>\n");
}

$inputNumber = (int)$argv[1];
if ($inputNumber < MIN_NUMBER) {
    exit("Число должно быть положительным\n");
}

calculateTriangle($inputNumber);
