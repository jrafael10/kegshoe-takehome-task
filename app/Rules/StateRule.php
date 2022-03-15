<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $states;
    public function __construct()
    {
        $this->states = [
            "new york", "new_york",
            "alabama", "alaska",
            "arkansas", "california",
            "colorado", "connecticut",
            "delaware", "florida",
            "georgia", "hawaii",
            "idaho", "illinois",
            "indiana", "iowa",
            "kansas", "kentucky",
            "louisiana", "maine",
            "maryland", "massachussetts",
            "michigan", "minnesota",
            "mississippi", "missouri",
            "montana", "nebraska",
            "nevada", "new_hampshire",
            "new hampshire", "new_jersey",
            "new jersey", "new_mexico",
            "new mexico", "north_carolina",
            "north carolina", "north_dakota",
            "north dakota", "ohio", "oklahoma",
            "oregon", "pennsylvania",
            "rhode_island", "rhode island",
            "south_carolina", "south carolina",
            "south_dakota", "south dakota",
            "tennessee", "texas", "utah",
            "vermont", "virginia", "washington",
            "west_virginia", "west virginia",
            "wisconsin", "wyoming"

        ];

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

        return in_array(strtolower($value), $this->states);
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter the valid name for the state.';
    }
}
