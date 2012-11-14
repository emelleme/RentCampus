<?php

class ListingsTask extends ScheduledTask {
	public function process(){
     	$currenttime = time();
     	list($usec, $sec) = explode(' ', microtime());
   		$script_start = (float) $sec + (float) $usec;
		//if( $member = Member::currentUser() ) {
		$j = new JSONDataFormatter;
		$addys = DataObject::get('Unit');
		foreach ($addys as $a)
		{
			# Slice and dice
			$loc = $a->GLatLng;
			$lng = substr(strstr($loc,','),1);
			$lat = strstr($loc,',',true);
			$a->Lat = $lat;
			$a->Lng = $lng;
			$a->write();
			echo "updated!".PHP_EOL;
		}
		
		list($usec, $sec) = explode(' ', microtime());
		$script_end = (float) $sec + (float) $usec;
		$elapsed_time = round($script_end - $script_start, 5);
		printf('Process took '.$elapsed_time.PHP_EOL);
		//}
	}
}
