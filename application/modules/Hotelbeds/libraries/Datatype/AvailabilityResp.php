<?php

class AvailabilityResp {
    
    public $resp;
    public $imagePath = 'http://photos.hotelbeds.com/giata/';

    public function __construct($resp)
    {
        $this->resp = $resp;
    }

    public function get_auditData()
    {
        return $this->resp->auditData;
    }

    public function get_hotels()
    {
        if($this->resp->hotels->total == 0) {
            return [];
        }
        $this->dbhb = getDatabaseConnection('hotelbeds');
        $this->dbhb->where_in('code', array_column($this->resp->hotels->hotels, 'code'));
        $dataAdapter = $this->dbhb->get('hotels');
        $dataset = $dataAdapter->result();
        foreach($this->resp->hotels->hotels as $index => &$hotel) {
            foreach($dataset as $dataObj) {
                if($dataObj->code == $hotel->code) {
                    $hotelArray = (array) $hotel;
                    $hotelArray['description'] = $dataObj->description;
                    $imagePath = "";
                    $images = json_decode($dataObj->images);
                    if(! empty($images)) {
                        $imagePath = current($images)->path;
                    }
                    $hotelArray['image'] = $this->imagePath . $imagePath;
                    $hotel = (object) $hotelArray;
                }
                unset($hotel->rooms);
            }
        }
        return $this->resp->hotels->hotels;
    }

    public function count()
    {
        return $this->resp->hotels->total;
    }
}