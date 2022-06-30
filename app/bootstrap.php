<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * handle global errors
 */
set_error_handler(['App\Core\Errors\GlobalErrorHandler', 'handle']);

/**
 * catch exception that may not anywhere
 */
set_exception_handler(['App\Core\Exceptions\GlobalExceptionHandler', 'handle']);