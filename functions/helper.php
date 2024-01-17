<?php

function redirect($page)
{
    header("Location: $page");
    exit;
}

function dump(array $data): void
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}
