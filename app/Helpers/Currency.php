<?php 

namespace APP\Helpers ;

use NumberFormatter;

class Currency {
    public function __invoke(...$params)
    {
        return $this->format(...$params);
    }

    public static function format($ammount , $currency = null){

        $formater = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if ($currency == null) {
            $currency = config('app.currency');
        }
        return $formater->formatCurrency($ammount,$currency);
    }

}

?>