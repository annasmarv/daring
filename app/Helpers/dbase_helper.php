<?php

if (! function_exists('dbase'))
{
    function dbase()
    {
    $schoolModel = new \App\Models\Data\SchoolModel;
    $row = $schoolModel->getProfile();
    return $row;

    }
}