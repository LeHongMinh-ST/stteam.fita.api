<?php

if (!function_exists('getOnlyFields')) {
    function getOnlyFields($data, $keys): array
    {
        return array_intersect_key($data, array_flip((array)$keys));
    }
}
