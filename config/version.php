<?php

/**
 * Canonical application version.
 *
 * The VERSION file is deliberately the single source of truth. Laravel caches
 * this resolved value when config:cache is used in production.
 */
return [
    'current' => trim((string) file_get_contents(base_path('VERSION'))),
];
