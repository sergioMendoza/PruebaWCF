<?php 

require_once('Service.php');
require_once('Crypter.php');

$wcfClient = new Service();

$cr = new Crypter();


//claves para la encriptacion.
$ky = 'lkirwf897+22#bbtrm8814z5qq=498j5'; // 32 * 8 = 256 bit key
$iv = '741952hheeyy66#cs!9hjv887mxx7@8y'; // 32 * 8 = 256 bit iv


$sk = "yNwfdKZTXVaG2d2FcVj5T7KMugFT9x4bCQkDZaQLNnA=";



//encriptar el secretKey.
//$secretKey = $cr->encryptRJ256($ky,$iv,"66a8f2813dac128f9d3d9abeaaae607b");

//print_r($secretKey);


$html = '';
$lider = '';
$count = 1;
$next = true;

	while ($next==true)
	{

		$result = $wcfClient->getConsultoras(array('PageNumber'=>$count ,'Pais'=> 'MASTER', 'SecretKey'=>$sk));
		
		if(!$result)
		{
			break 1;
		}

		$Token = $result->get_consultorasResult->ResultList->Token;

		if(!$Token)
	    {
	    	print_r("Token Null");
	    	break 1;
	    }

	    $consultoras = $result->get_consultorasResult->ResultList->_dataSource->Consultoras;

	  
	    $html .= '<table border="1" width="99%" cellspacing="0" cellpadding="0">
				<tr align="center">	
					<td><strong>isoCodconsultora</strong></td>
					<td><strong>Nombre</strong></td>
					<td><strong>Email</strong></td>
					<td><strong>Region</strong></td>
					<td><strong>Zona</strong></td>
					<td><strong>Segmento</strong></td>
					<td><strong>Seccion</strong></td>
					<td><strong>Lider</strong></td>
					<td><strong>NivelLider</strong></td>
					<td><strong>CampanaLider</strong></td>
					<td><strong>SeccionGestionLider</strong></td>
					<td><strong>NivelProyectado</strong></td>
				</tr>';
     
		if(isset($consultoras))
	    foreach ($consultoras as $value) {
	     	
	     		 if($value->Lider==true)
	     		 {
	     		 	$lider = "si";
	     		 }
	     		 else
	     		 {
	     		 	$lider= "no";
	     		 }

	     		  $html .='	<tr align="center">
								<td>'. $value->isoCodconsultora .'</td>
								<td>'. $value->Nombre .'</td>
								<td>'. $value->Email .'</td>
								<td>'. $value->Region .'</td>
								<td>'. $value->Zona .'</td>
								<td>'. $value->Segmento .'</td>
								<td>'. $value->Seccion .'</td>
								<td>'. 	$lider	.'</td>
								<td>'. $value->NivelLider .'</td>
								<td>'. $value->CampanaLider .'</td>
								<td>'. $value->SeccionGestionLider .'</td>
								<td>'. $value->NivelProyectado .'</td>
							</tr>';
	    }
	    
	    $html .= '</table><br><br><br>';

		$count++;
		$next = $result->get_consultorasResult->ResultList->HasNextPage;
	}

	
    print_r($html);


?>