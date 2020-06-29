<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdMustMatch implements Rule
{
    private $resource;

    /**
     * Create a new rule instance.
     *
     * @param $resource
     */
    public function __construct( $resource )
    {
        $this->resource = $resource;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes( $attribute, $value ): bool
    {
        return ( int ) $this -> resource -> id === ( int ) $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'resource id does not match id field';
    }
}
