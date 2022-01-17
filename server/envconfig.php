<?php
enum MODE
{
    case DEBUG;
    case RELEASE;
}

$APP_MODE = MODE::RELEASE;