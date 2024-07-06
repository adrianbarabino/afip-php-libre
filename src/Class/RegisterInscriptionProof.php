<?php
/**
 * SDK for AFIP Register Scope Five (ws_sr_constancia_inscripcion)
 * 
 * @link http://www.afip.gob.ar/ws/ws_sr_constancia_inscripcion/manual_ws_sr_constancia_inscripcion_v1.0.pdf WS Specification
 *
 * @author 	Afip SDK
 * @package Afip
 * @version 1.0
 **/

class RegisterInscriptionProof extends AfipWebService {

	var $soap_version 	= SOAP_1_1;
	var $WSDL 			= 'ws_sr_constancia_inscripcion-production.wsdl';
	var $URL 			= 'https://aws.afip.gov.ar/sr-padron/webservices/personaServiceA5';
	var $WSDL_TEST 		= 'ws_sr_constancia_inscripcion.wsdl';
	var $URL_TEST 		= 'https://awshomo.afip.gov.ar/sr-padron/webservices/personaServiceA5';

	/**
	 * Asks to web service for servers status {@see WS 
	 * Specification item 3.1}
	 *
	 * @since 1.0
	 *
	 * @return object { appserver => Web Service status, 
	 * dbserver => Database status, authserver => Autentication 
	 * server status}
	**/
	public function GetServerStatus()
	{
		return $this->ExecuteRequest('dummy');
	}

	/**
	 * Asks to web service for taxpayer details {@see WS 
	 * Specification item 3.2}
	 *
	 * @since 1.0
	 *
	 * @throws Exception if exists an error in response 
	 *
	 * @return object|null if taxpayer does not exists, return null,  
	 * if it exists, returns full response {@see 
	 * WS Specification item 3.2.2}
	**/
	public function GetTaxpayerDetails($identifier)
	{
		$ta = $this->afip->GetServiceTA('ws_sr_constancia_inscripcion');
		
		$params = array(
			'token' 			=> $ta->token,
			'sign' 				=> $ta->sign,
			'cuitRepresentada' 	=> $this->afip->CUIT,
			'idPersona' 		=> $identifier
		);

		try {
			return $this->ExecuteRequest('getPersona_v2', $params);
		} catch (Exception $e) {
			if (strpos($e->getMessage(), 'No existe') !== FALSE)
				return NULL;
			else
				throw $e;
		}
	}


	
	/**
	 * Asks to web service for taxpayer type {@see WS
	 * Specification item 3.2}
	 * first get the taxpayer details and then return the type
	 * 
	 * @since 1.1
	 * 
	*/

	public function GetTaxpayerType($identifier)
	{
		$data = $this->GetTaxpayerDetails($identifier);



		if (isset($data->datosRegimenGeneral->impuesto)) {
			foreach ($data->datosRegimenGeneral->impuesto as $impuesto) {
				if (strpos($impuesto->descripcionImpuesto, 'IVA EXENTO') !== false) {
					return 'Iva Exento';
				}
				if ($impuesto->idImpuesto == 30) {
					return 'Responsable Inscripto';
				}
			}
		}

		if (isset($data->datosMonotributo->impuesto)) {
			
			foreach ($data->datosMonotributo->impuesto as $impuesto) {
				
				if ($impuesto == 20) {
					return 'Responsable Monotributo';
				}
			}
		}

		return 'Consumidor Final';


	}

	/**
	 * Asks to web service for taxpayers details 
	 *
	 * @throws Exception if exists an error in response 
	 *
	 * @return [object] returns web service full response
	**/
	public function GetTaxpayersDetails($identifiers)
	{
		$ta = $this->afip->GetServiceTA('ws_sr_constancia_inscripcion');
		
		$params = array(
			'token' 			=> $ta->token,
			'sign' 				=> $ta->sign,
			'cuitRepresentada' 	=> $this->afip->CUIT,
			'idPersona' 		=> $identifiers
		);

		return $this->ExecuteRequest('getPersonaList_v2', $params)->persona;
	}

	/**
	 * Sends request to AFIP servers
	 * 
	 * @since 1.0
	 *
	 * @param string 	$operation 	SOAP operation to do 
	 * @param array 	$params 	Parameters to send
	 *
	 * @return mixed Operation results 
	 **/
	public function ExecuteRequest($operation, $params = array())
	{
		$this->options = array('service' => 'ws_sr_constancia_inscripcion');

		$results = parent::ExecuteRequest($operation, $params);

		return $results->{
			$operation === 'getPersona_v2' ? 'personaReturn' :
				($operation === 'getPersonaList_v2' ? 'personaListReturn': 'return')
			};
	}
}

