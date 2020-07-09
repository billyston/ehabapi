<?php

use Cake\Chronos\Chronos;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

/*
 * Response for failed Authorization
 */
function failedAuthorizationResponse ( $message = '')
{
    throw new HttpResponseException(response()->json([
        'error' => true,
        'message' => ($message)?: 'you are not allowed to perform this action!'
    ], 403));
}

/**
 * Prepare Failed Validation Response
 *
 * @param array $validator_errors
 */
function failedValidationResponse (array $validator_errors)
{
    $errors = ['error' => true];
    foreach ($validator_errors as $error) {
        $errors['message'][] = $error;
    }
    throw new HttpResponseException(response()->json($errors, 422));
}

function guard (string $guard = null)
{
    return auth($guard);
}

function errorResponse (string $message = 'something went wrong, please try again later!', int $code = 200)
{
    return response()->json([
        'error' => true,
        'message' => $message
    ], $code);
}

function successResponse (string $message, int $code = 200)
{
    return response()->json([
        'error' => false,
        'message' => $message
    ], $code);
}

function defaultDisk()
{
    return 'public';
}

function SmartId()
{
    return ( string ) Str::uuid();
}

/**
 * @return array
 */
function includeResources()
{
    return (request()->get('include')) ? explode(',', request()->get('include')) : [];
}

/**
 * @return bool
 */
function addStats()
{
    return (bool)request()->get('stats');
}

function getDateFilters()
{
    return [
        'from' => (request()->get('from')) ? Chronos::parse(request()->get('from'))->startOfDay()->toDateTimeString() : Chronos::today()->startOfDay()->toDateTimeString(),
        'to' => (request()->get('to')) ? Chronos::parse(request()->get('to'))->endOfDay()->toDateTimeString() : Chronos::today()->endOfDay()->toDateTimeString()
    ];
}

function serverErrorMessage()
{
    return 'sorry, something went wrong. Please try again later';
}

function getStatusFilter()
{
    return request()->get('status');
}

function checkResourceRelation(bool $is_related)
{
    abort_unless(
        $is_related,
        409,
        'the resource you are trying to access does not belong to your hospital'
    );
}

