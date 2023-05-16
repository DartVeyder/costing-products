<?php 
class Calculate{
    /**
     * Process calculate volume.
     *
     * @param integer $length            → довжина
     * @param integer $width             → ширина 
     * @param integer $height            → висота
     * @param integer $output_unit       → Одиниці виміру в яких вивести результат
     *                                    1 =  м.кб / 1
     *                                    2 = см.кб / 1000000
     *                                    3 = мм.кб / 1000000000
     * 
     * @param integer $input_unit        → Одиниці виміру в яких вносять дані
     *                                    1 =  м.кб 
     *                                    2 = см.кб 
     *                                    3 = мм.кб  
     * @return mixed                     → float, integer
     */
    public static function volume($length, $width, $height, $input_unit = 1, $output_unit = 1){
        $volume = $length * $width * $height;
        switch ($input_unit) {
            case 1: 
                $volume /= 1000;
            case 2:
                $volume /= 10;
            break;  

        } 
        switch ($output_unit) {
            case 1: 
                $unit = 'кб.см';
                $volume /= 1000000;
            case 2:
                $unit = 'кб.м';
                $volume /= 1000;
            break;  
            case 3:
                $unit = 'кб.мм';
            break;  
        }
        return $volume . " $unit";
    }

    public static function cost_price_raw($unit_cost, $quantity, $percentage_expenditure){
        $array = [
            'result' =>  $unit_cost / ((1 / 100 * $percentage_expenditure) /  $quantity),
            'formula' => "$unit_cost / ((1 / 100 * $percentage_expenditure) /  $quantity)"
        ];
        return $array;
    }
}