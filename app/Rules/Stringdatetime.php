<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Stringdatetime implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        return preg_match("/^[0-9]{4}-(0[0-9]|1[0-2])-(0[0-9]|[1-2][0-9]|3[0-1]) ([0-9][0-9]):([0-9][0-9]):([0-9][0-9])$/",$value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The date must be in the yyyy-mm-dd hh:ii:ss structure';
    }
}
