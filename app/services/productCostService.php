<?php
    class ProductCostService{ 
        public function calculate__total_cost_quantity($unit_cost, $processing_area, $working_resource){ 
            $quantity =  $working_resource /  $processing_area;
            $total_cost = round($unit_cost / $quantity,5);
            $formula_total_cost = "$unit_cost / $quantity";
            $quantity = round(1 /  $quantity , 5 ); 
            $formula_quantity = " 1 / ($working_resource / $processing_area)";
            
            return [
                'quantity' => [ 
                    'formula' => $formula_quantity, 
                    'result' => $quantity],
                'total_cost' => [ 
                    'formula' => $formula_total_cost, 
                    'result' => $total_cost]
            ];
        }
    }