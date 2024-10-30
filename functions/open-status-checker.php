<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	/*********** Open Status checker ************** */
	if (!function_exists('cleanup_check_time')) {		
		function cleanup_check_time($listingid) {
			$status = esc_html__('Day Off!','cleanup');	
			$storeSchedule= get_post_meta($listingid ,'_opening_time',true);
			if(is_array($storeSchedule)){

			$getClosestTimezone= cleanup_getClosestTimezone(get_post_meta($listingid,'latitude',true),get_post_meta($listingid,'longitude',true) );
			$timeObject = new DateTime($getClosestTimezone);
			$timeObject = new DateTime();
			$timestamp = $timeObject->getTimeStamp();
			// default status
			$status = esc_html__('Closed Now!','cleanup');
			// get current time object
			$currentTime = (new DateTime())->setTimestamp($timestamp);
			// loop through time ranges for current day
			if(isset($storeSchedule[gmdate('D', $timestamp)] )){
				foreach ($storeSchedule[gmdate('D', $timestamp)] as $startTime => $endTime) {
					// create time objects from start/end times
					$startTime = DateTime::createFromFormat('h:i A', $startTime);
					$endTime   = DateTime::createFromFormat('h:i A', $endTime);	
					// check if current time is within a range
					if (($startTime < $currentTime) && ($currentTime < $endTime)) {
						$status =esc_html__('Open Now','cleanup');
						break;
					}
				}
			}	
			}	
			return $status;
		}
	}
	if (!function_exists('cleanup_getClosestTimezone')) {
		function cleanup_getClosestTimezone($lat, $lng)
		{
			if (!empty($lat) && !empty($lng)) {
				$diffs = array();
				foreach (DateTimeZone::listIdentifiers() as $timezoneID) {
					$timezone = new DateTimeZone($timezoneID);
					$location = $timezone->getLocation();
					$tLat = $location['latitude'];
					$tLng = $location['longitude'];
					$diffLat = abs($lat - $tLat);
					$diffLng = abs($lng - $tLng);
					$diff = $diffLat + $diffLng;
					$diffs[$timezoneID] = $diff;
				}
				$timezone = array_keys($diffs, min($diffs));
				$timestamp = time();
				
				$zones_GMT = gmdate('O', $timestamp) / 100;
				if(isset($timezone[0])){
					return $timezone[0];
					}else{
					return 'America/New_York';
				}
			}
		}
	}	