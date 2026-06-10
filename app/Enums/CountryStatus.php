<?php

namespace App\Enums;

enum CountryStatus: string
{
    case GOOD = 'Good';
    case OK = 'is OK';
    case SO_SO = 'So so';
    case NO_DATA = 'No data';

    public static function fromGini(float $gini): self
    {
        if(empty($gini)) {
            return self::NO_DATA;
        }
        
        if($gini > 30 && $gini < 36) {
            return self::OK;
        }
        else if($gini <= 30) {
            return self::GOOD;
        }
        else {
            return self::SO_SO;
        }
    }
}
