<?php

use Carbon\Carbon;

function formatDateView($date)
{
    return Carbon::parse($date)->format('d-m-Y');
}

function formatDateDB($date)
{
    return $date ? Carbon::parse($date)->format('Y-m-d') : NULL; //BEWARE!!! Carbon::parse($date) = now() if $date = NULL
}
