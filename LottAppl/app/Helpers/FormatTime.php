<?php

use Carbon\Carbon;

function formatDateView($date)
{
    return Carbon::parse($date)->format('d-m-Y');
}

function formatDateDB($date)
{
    return Carbon::parse($date)->format('Y-m-d');
}
