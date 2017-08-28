<?php
//function get_search_data( $pickUpDate, $dropOffDate, $pickUpSearchTerm, $dropOffSearchTerm = '', $pickUpTime = 1200, $dropOffTime = 1200 ) {
//	$url         = 'https://www.expedia.co.uk/carsearch/pickup/list/results';
//	$user_agents = array(
//		'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A',
//		'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
//		'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
//		'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
//		'Mozilla/5.0 (Windows; U; Windows NT 6.1; x64; fr; rv:1.9.2.13) Gecko/20101203 Firebird/3.6.13',
//		'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
//		'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
//		'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
//		'Mozilla/5.0 (X11; Linux x86_64; rv:17.0) Gecko/20121202 Firefox/17.0 Iceweasel/17.0.1',
//		'Mozilla/5.0 (X11; Linux i686; rv:15.0) Gecko/20100101 Firefox/15.0.1 Iceweasel/15.0.1'
//	);
//
//	$n2 =rand(1, 255);
//	$n3 =rand(1, 255);
//	$n4 =rand(1, 255);
//	$ip = "109.$n2.$n3.$n4";
//
//	$post_params                = array();
//	$post_params['pickUpDate']  = (string) $pickUpDate;
//	$post_params['pickUpTime']  = (int) $pickUpTime;
//	$post_params['dropOffDate'] = (string) $dropOffDate;
//	$post_params['dropOffTime'] = (int) $dropOffTime;;
//	$post_params['pickUpSearchTerm']  = (string) $pickUpSearchTerm;
//	$post_params['dropOffSearchTerm'] = (string) $dropOffSearchTerm;
//	$post_params['radiusDistance']    = 20;
//	$post_params['ageInRange']        = true;
//
//	$ch = curl_init( $url );
//	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//	curl_setopt($ch , CURLOPT_AUTOREFERER, true);
//	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
//	curl_setopt( $ch, CURLOPT_HEADER, false );
//	curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_params );
//	curl_setopt( $ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
//	curl_setopt($ch, CURLOPT_USERAGENT,  $user_agents[rand(0,9)]);
//	$data = curl_exec( $ch );
//
//	curl_error( $ch );
//	curl_close( $ch );
//
//	return $data;
//}
//function xml_out($output){
//	$xml = '<?xml version="1.0" encoding="UTF-8"';
//	$xml .= "<scrape>";
//	$xml .= "<searchdetails>";
//	$xml .= "</searchdetails>";
//
//	if(sizeof($output) > 0)
//	{
//		$xml .= "<vehicles>";
//		foreach ($output as $vehicle)
//		{
//			$xml .= "<vehicle>";
//			foreach ($vehicle as $key => $val)
//			{
//				$xml .= "<$key>$val</$key>";
//			}
//			$xml .= "</vehicle>";
//		}
//		$xml .= "</vehicles>";
//	}
//	else
//	{
//		$xml .= "<error>No data</error>";
//	}
//
//	$xml .= "</scrape>";
//	return $xml;
//}
//function parse_data( $data ) {
//	$output   = array();
//	$response = array();
//	foreach ( $data as $key => $value ) {
//		if ( $key == 'offers' or $key == 'offer' ) {
//			$count =0;
//			foreach ( $value as $offer ) {
//				echo $count++;
//				$response['name']     = str_replace( ' or similar', '', $offer->vehicle->description );
//				$response['price']    = $offer->fare->total->value;
//				$response['category'] = $offer->vehicle->classification->name;
//				$response['data']     = 'book-' . $offer->vendor->code . '-' . $offer->vehicle->classification->code . '-Car';
//				if ( $offer->vehicle->passengerCapacity->start == $offer->vehicle->passengerCapacity->end ) {
//					$response['numberOfPassenger'] = $offer->vehicle->passengerCapacity->start;
//				} else {
//					$response['numberOfPassenger'] = $offer->vehicle->passengerCapacity->start . '' . $offer->vehicle->passengerCapacity->end;;
//				}
//				if ( $offer->vehicle->doorCount->start == $offer->vehicle->doorCount->end ) {
//					$response['numberOfDoors'] = $offer->vehicle->doorCount->start;
//				} else {
//					$response['numberOfDoors'] = $offer->vehicle->doorCount->start . '' . $offer->vehicle->doorCount->end;;
//				}
//
//				$response['transmissionType'] = $offer->vehicle->transmission;
//				$response['company']          = $offer->vendor->name;
//				array_push( $output, $response  );
//			}
//		}
//	}
//    echo sizeof($output);
//	return $output;
//}
//
//$scraped_page = get_search_data( '25/09/2017', '30/09/2017', 'Warsaw, Poland (WAW-Frederic Chopin)', 'Warsaw, Poland (WAW-Frederic Chopin)', '1200', '1500' );
//$data         = json_decode( $scraped_page );
//$output       = parse_data( $data );
//echo  xml_out($output). "\n"; // output in xml format
//echo  json_encode($output->length) ; //output json format
//
//
//?>
<?php
function get_search_data( $pickUpDate, $dropOffDate, $pickUpSearchTerm, $dropOffSearchTerm = '', $pickUpTime = 1200, $dropOffTime = 1200 ) {
	$url         = 'https://www.expedia.co.uk/carsearch/pickup/list/results/';

	$user_agents = array(
		'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A',
		'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
		'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
		'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
		'Mozilla/5.0 (Windows; U; Windows NT 6.1; x64; fr; rv:1.9.2.13) Gecko/20101203 Firebird/3.6.13',
		'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
		'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
		'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
		'Mozilla/5.0 (X11; Linux x86_64; rv:17.0) Gecko/20121202 Firefox/17.0 Iceweasel/17.0.1',
		'Mozilla/5.0 (X11; Linux i686; rv:15.0) Gecko/20100101 Firefox/15.0.1 Iceweasel/15.0.1'
	);

	$n2 =rand(1, 255);
	$n3 =rand(1, 255);
	$n4 =rand(1, 255);
	$ip = "94.$n2.$n3.$n4";

	$post_params                = array();
	$post_params['pickUpDate']  = (string) $pickUpDate;
	$post_params['pickUpTime']  = (int) $pickUpTime;
	$post_params['dropOffDate'] = (string) $dropOffDate;
	$post_params['dropOffTime'] = (int) $dropOffTime;;
	$post_params['pickUpSearchTerm']  = (string) $pickUpSearchTerm;
	$post_params['dropOffSearchTerm'] = (string) $dropOffSearchTerm;
	$post_params['radiusDistance']    = 20;
	$post_params['ageInRange']        = 'true';
	$post_params['delayLoading'] = 0;
	$post_params['delayResults'] = 0;
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_HEADER, false );
	curl_setopt($ch , CURLOPT_AUTOREFERER, true);
//    curl_setopt($process, CURLOPT_POST, true);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_params );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
	//curl_setopt( $ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
	curl_setopt($ch, CURLOPT_USERAGENT,  $user_agents[rand(0,9)]);
	$data = curl_exec( $ch );

	curl_error( $ch );
	curl_close( $ch );
	$data         = json_decode( $data );
	$output       = parse_data( $data );

	return $output;
}
function xml_out($output){
	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml .= "<scrape>";
	$xml .= "<searchdetails>";
	$xml .= "</searchdetails>";

	if(sizeof($output) > 0)
	{
		$xml .= "<vehicles>";


//		echo count($output);
		foreach ($output as $vehicle)
		{
			$xml .= "<vehicle>";
			foreach ($vehicle as $key => $val)
			{
				$val=str_replace("'","",$val);
				$val=str_replace("&","",$val);
				$xml .= "<$key>$val</$key>";
			}
			$xml .= "</vehicle>";
		}
		$xml .= "</vehicles>";
	}
	else
	{
		$xml .= "<error>No data</error>";
	}

	$xml .= "</scrape>";
	return $xml;
}
function parse_data( $data ) {
	$output   = array();
	$response = array();
	var_dump($data);
	foreach ( $data as $key => $value ) {
		if ( $key == 'offers' or $key == 'offer' ) {
			$count =0;
			foreach ( $value as $offer ) {

				$response['name']     = str_replace( ' or similar', '', $offer->vehicle->description );
				$response['price']    = $offer->fare->total->formattedValue;
				$response['category'] = $offer->vehicle->classification->name;
				if ( $response['category'] == 'Economy' ) {
					++ $count;
				}
				$response['data'] = 'book-' . $offer->vendor->code . '-' . $offer->vehicle->classification->code . '-Car';
				if ( $offer->vehicle->passengerCapacity->start == $offer->vehicle->passengerCapacity->end ) {
					$response['numberOfPassenger'] = $offer->vehicle->passengerCapacity->start;
				} else {
					$response['numberOfPassenger'] = $offer->vehicle->passengerCapacity->start . '' . $offer->vehicle->passengerCapacity->end;;
				}
				if ( $offer->vehicle->doorCount->start == $offer->vehicle->doorCount->end ) {
					$response['numberOfDoors'] = $offer->vehicle->doorCount->start;
				} else {
					$response['numberOfDoors'] = $offer->vehicle->doorCount->start . '' . $offer->vehicle->doorCount->end;;
				}

				$response['transmissionType'] = $offer->vehicle->transmission;
				$response['company']          = $offer->vendor->name;
				array_push( $output, $response );
			}
			//echo $count . "Economy \n";
		}
	}

	return $output;
}

function main(){
	//$scraped_page = get_search_data( $_GET[PickUpDateTime], $_GET[ReturnDateTime], 'MIA-Miami Intl', 'MIA-Miami Intl', '1300', '1300' );
//echo $scraped_page;

	$scraped_page = get_search_data( '25/09/2017', '30/09/2017', 'Warsaw, Poland (WAW-Frederic Chopin)', 'Warsaw, Poland (WAW-Frederic Chopin)', '1000', '1000' );
	$_GET[PickUpDateTime]=str_replace("-","/",$_GET[PickUpDateTime]);
	$_GET[ReturnDateTime]=str_replace("-","/",$_GET[ReturnDateTime]);

//$scraped_page = get_search_data($_GET[PickUpDateTime],$_GET[ReturnDateTime],'Miami, FL, United States (MIA-Miami Intl.)','Miami, FL, United States (MIA-Miami Intl.)','1500' ,'1000');

//$scraped_page = get_search_data($_GET['PickUpDateTime'], $_GET['ReturnDateTime'], $_GET['pickupID'], $_GET['pickupID'],'1000' ,'1000');


	echo xml_out($scraped_page). "\n"; // output in xml format
//ho  json_encode($output) ; //output json format
}


main()


?>