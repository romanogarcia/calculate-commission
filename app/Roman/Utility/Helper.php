<?php namespace Roman\Utility;

class Helper {
    private $cash_in_commission = 0.03;
    private $max_cash_in_commission = 5;
    private $cash_out_commission = 0.3;
    private $max_cash_out_commission = 0.5;
    
    public function getCommission($data)
    {   
        $user_type = $data[2];
        $cash_type = $data[3];
        $amount = $data[4];
        $currency = $data[5];
        $commission_amount = 0;

        /* Cash-in */
        if ($cash_type == "cash_in"){
            $commission = ($this->cash_in_commission / 100) * $amount;
            
            if ($commission > $this->max_cash_in_commission)
            {
                $commission_amount = $this->max_cash_in_commission;
            }
            else {
                $commission_amount = $commission;
            }
        } 
        /* Cash-out  */
        else {
            /* User Type Natural */
            if ($user_type == "natural"){
                $commission_amount = ($this->cash_out_commission / 100) * $amount;
            }
            else if ($user_type == "legal") {
                $commission = ($this->cash_out_commission / 100) * $amount;            
                if ($commission <= $this->max_cash_out_commission)
                {
                    $commission_amount = $this->max_cash_out_commission;
                }
                else {
                    $commission_amount = $commission;
                }
            }
        }
        
        return money_format('%.2n', $commission_amount);
    }

    public function getCsv($file)
    {
        $rows = [];

        if (($handle = fopen("$file", "r")) !== FALSE) 
        {
            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                $rows[] = $data;
            }
            fclose($handle);
        }
        
        return $rows;
    } 
}