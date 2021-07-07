<?php

if (!function_exists('carbon_now')) {
    /**
     * 必ず固定時間を返す
     *
     * @return \Carbon\CarbonImmutable
     */
    function carbon_now(): \Carbon\CarbonImmutable
    {
        return app('carbon_now');
    }
}

