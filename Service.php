<?php
    class Service
    { 
         

        public function getConsultoras($params) {
            

            try 
            {		
                // Initialize the "standard" SOAP Options
                $options = array('cache_wsdl' => WSDL_CACHE_NONE, 'encoding' => 'utf-8', 'soap_version' => SOAP_1_1, 'exceptions' => true, 'trace' => true); 


                // Create a connection to the WCF Service
    	       $client = new SoapClient('http://52.2.37.165/WSODS/WCFConsultorasService.svc?singleWsdl', $options);
                   //$client = new SoapClient('http://alcazar/WCF_Consultora/WCFConsultorasService.svc?singleWsdl', $options);

                                



                if($client == null)
                {
                  throw new Exception('Could not connect to WCF Service');
	            }
              		   
                // Submit the $params object
	             $result = $client->get_consultoras(array('request' => $params));
         
                if(isset($result))
                {
                  return $result;
                 
                }
                else
                {
                   return false;
                }

               // throw new Exception($result->get_consultorasResult);    

    	   } 
            catch (Exception $ex) 
    	   {
    	       echo 'Error in WCF Service: '.$ex->getMessage().'<br/>';
                
                return false;
    	   }
        }
    }
?>