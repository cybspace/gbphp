<?php
function check_values_is_numbers ($x, $y) {
    //some code
};

function add ($x, $y) {
    return (int)$x + (int)$y;
};
        
function substract ($x, $y) {
    return (int)$x - (int)$y;
};

function multiply ($x, $y) {
    return (int)$x * (int)$y;
};

function divide ($x, $y) {
    if ((int)$y === 0) return "На ноль не делится!";
    return (int)$x / (int)$y;
};

function do_some_math($arg1, $arg2, $operation) {
    switch ($operation) {
        case '+': return add($arg1, $arg2); break;
        case '-': return substract($arg1, $arg2); break;
        case '*': return multiply($arg1, $arg2); break;
        case '/': return divide($arg1, $arg2); break;
        default: return 'Unknown operation: ' . $operation; break;
    };
};