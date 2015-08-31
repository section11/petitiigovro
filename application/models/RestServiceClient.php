<?php
//require_once realpath(__DIR__ . '/../libraries') . "/WindowsAzure/WindowsAzure.php";
include_once(APPPATH."/libraries/WindowsAzure/WindowsAzure.php");
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Table\Models\Entity;
use WindowsAzure\Table\Models\EdmType;

class RestServiceClient extends CI_Model {
 
	
    private $url = "http://rogovdata.cloudapp.net:8080/v1/RoGovOpenData/Petitii/"; //the URL we are pointing at
 
    private $data = array(); //data we are going to send
    private $response; //where we are going to save the response
	private $tableConnection = null;
	protected $conturi = 'conturi';
	public $nrvoturi = 0;
	public $voturitinta = 10000;
	
    public function __construct() {	
        parent::__construct();  
        //$this->load->model('general');
        $connectionString = 'DefaultEndpointsProtocol=http;AccountName=rogovdata;AccountKey=tLSPDUCHwb/WhTRwNgRLfNJtlilquET7yNyU6fFzmZoB1vTDXuJcm6r1+oTu8Xe4XQbLOKhbugNPCpNIRoLMNg==';
        $this->tableConnection = ServicesBuilder::getInstance()->createTableService($connectionString);					
    }
 
    //get the URL we were made with
    public function getUrl() {
        return $this->url;
    }
 
    //add a variable to send
    public function __set($var, $val) {
        $this->data[$var] = $val;
    }
 
    //get a previously added variable
    public function __get($var) {
        return $this->data[$var];
    }
 
    public function excuteRequest() {
        //work ok the URI we are calling
        $uri = $this->url . $this->getQueryString();
 
        //get the URI trapping errors
		
        $result = @file_get_contents($uri);
 
        // Retrieve HTTP status code
        list($httpVersion, $httpStatusCode, $httpMessage) = 
            explode(' ', $http_response_header[0], 3);
 
        //if we didn't get a '200 OK' then thow an Exception
        if ($httpStatusCode != 200) {
            throw new Exception('HTTP/REST error: ' . $httpMessage, $httpStatusCode);
        } else {
            $this->response = $result;
        }		
    }
 
    public function getResponse() {
        return $this->response;
    }
 
    //turn our array of variables to send into a query string
    protected function getQueryString() {
 
        $queryArray = array();
 
        foreach ($this->data as $var => $val) {
            $queryArray[] = $var . '=' . urlencode($val);
        }
 
        $queryString = implode('&', $queryArray);		
 
        return '?' . $queryString;
    }
    private function GetNoSpaces($s){
		$s = str_replace(' ','',$s);
		return $s;
	}   
}


?>

	