<?php

namespace App\Helper_Functions;

class Helper_Functions
{
    /****************
     * Sanitize Form Inputs FUNCTIONS- START
     ****************/
    public static function formDataStoreFormat($formElement)
    {
        $formElement = filter_var($formElement, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $formElement = stripslashes($formElement);
        $formElement = strtolower($formElement);
        $formElement = ucwords($formElement);
        return $formElement;
    }
    /****************
     * Sanitize Form Inputs FUNCTIONS- END
     ****************/
}
