<?php

/**
 * Canonical DeshiBazaar application version. The root VERSION file is the
 * single source of truth and is updated for each SemVer release.
 */
return [
    'current' => trim((string) file_get_contents(base_path('VERSION'))),
];
