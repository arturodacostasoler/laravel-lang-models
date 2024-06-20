<?php

declare(strict_types=1);

use LaravelLang\Config\Facades\Config;
use Tests\Constants\FakeValue;

/** @deprecated  */
function jsonEncode(array $value): string
{
    return jsonEncodeRaw([FakeValue::ColumnTitle => $value]);
}

/** @deprecated  */
function jsonEncodeRaw(array $value): string
{
    return json_encode($value, Config::shared()->models->flags);
}
