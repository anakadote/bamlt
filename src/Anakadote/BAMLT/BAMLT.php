<?php

namespace Anakadote\BAMLT;

/**
 * Send a lead to the default BAM Lead Tracker web service.
 *
 * @version  1.0.0
 * @author   Taylor Collins <taylor@tcdihq.com>
 */
class BAMLT
{
    /**
     * Allowed inputs
     *
     * @var array
     */
    private $allowed_inputs = [
        'first_name', 'last_name', 'email', 'phone', 'phone_ext', 'address', 'address_2', 'city', 'state', 'zip', 'interest', 'comments', 
        'lead_generator', 'delivery_source', 'media_type', 'referrer_token',
    ];
    
    /**
     * Data array to send to BAMLT
     *
     * @var array
     */
    private $data = [];
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        // Fill data array with allowed input keys
        $this->data = array_fill_keys($this->allowed_inputs, null);
    }
    
    /**
     * Send a lead to BAM Lead Tracker
     *
     * @param  string  $uri  BAMLT URI
     * @param  array   $input
     * @param  bool    $is_client_uri  true for a Client URI, false for a Store URI
     * @return bool
     */
    public function send($uri, $input, $is_client_uri = false)
    {        
        if(! $uri) return false;
        if(! is_array($input)) return false;
        
        // Allow a "name" input
        if(isset($input['name'])){
            $name = explode(' ', preg_replace('/\s+/', ' ', (trim($input['name']))));
            $input['first_name'] = isset($name[0]) ? $name[0] : '';
            $input['last_name']  = isset($name[1]) ? $name[1] : '';
        }
        
        // Loop through supplied data and take allowed values
        foreach($input as $key => $value){
            if(in_array($key, $this->allowed_inputs)){
                $this->setData($key, $value);
            }
        }
                
        // The XML
        $xml  = "<?xml version='1.0'?><root>";
        $xml .= "<source>" . $this->cleanForXML($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']) . "</source>";
        
        if($is_client_uri){
            $xml .= "<uri_client>" . $uri . "</uri_client>";
        } else {
            $xml .= "<uri>" . $uri . "</uri>";
        }

        foreach($this->data as $key => $value){
            $xml .= "<" . $key . ">" . $value . "</" . $key . ">";
        }

        $xml .= "</root>";
                            
        $ch = curl_init("https://bamleadtracker.com/track/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['xml' => $xml]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
                            
        if($output > 0){
            // Success
        }
    }
    
    /**
     * Set a piece of data
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    private function setData($key, $value)
    {
        $this->data[ $key ] = $this->cleanForXML($value);
    }
    
    /**
     * Clean string for XML
     * 
     * @param  string  $string
     * @return string
     */
    private function cleanForXML($string){
        $string = strip_tags($string);
        $string = htmlentities($string, ENT_QUOTES, "UTF-8");
        $string = preg_replace("/&#?[a-z0-9]{2,8};/i", "", $string);
        return $string;
    }
}
