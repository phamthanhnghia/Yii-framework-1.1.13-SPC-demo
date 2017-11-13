<?php

// write log exception, delete log... - PDQuang
class DbLogRoute extends CDbLogRoute
{
    public $ip_address;
    public $country;
    public $description;
    public function processLogs($logs)
    {
        $this->ip_address = MyFormat::getIpUser();
        $this->country = '';        
        if( $this->ip_address != '::1' && $this->ip_address != '127.0.0.1'){
            $location = Yii::app()->geoip->lookupLocation($this->ip_address);
            $this->country  = 'EMPTY';
            if($location){
                $this->country =  $location->countryName;
                $this->description =  $location->region." - $location->regionName - $location->city - PostalCode: $location->postalCode";
            }            
        }        
        
        parent::processLogs($logs);
        
        $count=$this->getDbConnection()->createCommand('SELECT COUNT(*) FROM '.$this->logTableName)->queryScalar();
        if($count >= LOGGER_TABLE_MAX_RECORDS)
        {
            $query = "DELETE FROM $this->logTableName limit 200";
            $command = Yii::app()->db->createCommand($query);
            $command->execute();
        }
    }
}
?>
