<?php
class Request extends Object{

	var $MerchantId	=	NULL;
	var $Url 		= "https://cieloecommerce.cielo.com.br/api/public/v1/orders/";
	var $Method 	= "POST";

	public function __construct($merchant_id)
	{
		$this->MerchantId = $merchant_id;
		return $this;
	}

	function send(CieloCheckOut $cieloCheckOut = null){
		
        $headers = [
            //'Accept-Encoding: gzip',
            'User-Agent: CieloCheckOut/3.0 PHP SDK by dialogo.digital',
            'MerchantId: ' . $this->MerchantId,
            //'RequestId: ' . uniqid()
        ];
        
        $curl = curl_init($this->Url);

        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        switch ($this->Method) {
            case 'GET':
                break;
			case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                break;
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->Method);
        }

        if ($cieloCheckOut !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $cieloCheckOut->toJson());
            $headers[] = 'Content-Type: application/json';
        } else {
            $headers[] = 'Content-Length: 0';
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response   = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        
        if (curl_errno($curl)) {
            throw new RuntimeException('Curl error: ' . curl_error($curl));
        }

        curl_close($curl);

       return $this->readResponse($statusCode, $response);
	}
	
	protected function readResponse($statusCode, $responseBody)
    {
        $unserialized = null;

        switch ($statusCode) {
            case 200:
            case 201:
                $unserialized = json_decode($responseBody);
                break;
            case 400:
                $exception = null;
                $response  = json_decode($responseBody);

                foreach ($response as $error) {
                    $cieloError = new CieloError($error->Message, $error->Code);
                    $exception  = new CieloRequestException('Request Error', $statusCode, $exception);
                    $exception->setCieloError($cieloError);
                }

                throw $exception;
            case 404:
                throw new CieloRequestException('Resource not found', 404, null);
            default:
                throw new CieloRequestException('Unknown status', $statusCode);
        }

        return $unserialized;
	}

}
