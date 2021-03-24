<?php
		
	class cStove{
		//variables
		private $c_target_power_level = "RC50005A";
		private $c_target_ambient_temp = "RC60005B";
		private $c_current_exhaust_temp = "RD000056";		
		private $c_current_ambient_temp = "RD100057";
		private $c_current_speed_exhaustt_vent = "RD200058";
		private $c_current_speed_ambient_vent = "RD300059";
		private $c_current_speed_pellet_snail = "RD40005A";
		
		private $c_current_state = "RD90005F";
		
		private $c_power_levels = array(
										0 => "RF000058",
										1 => "RF001059",
										2 => "RF00205A",
										3 => "RF00305B",
										4 => "RF00405C",
										5 => "RF00505D");
										//unchecked: RF00605E may be AUTO  ?
										//unchecked: RF00705F may be TURBO ?
										
		public $stove_states = array(
										0 => "On",
										1 => "Off",
										2 => "Firing",
										3 => "Cooling",
										4 => "Stand-By",
										5 => "Cleaning");
																	
					
		//functions
		public function __construct() {
			//$this->stove_state = $this->getState()
		}
		
		public function setPowerState(int $state) {
			$output = shell_exec( "/opt/scripte/duepi-serial-interface/sendData.sh " . $this->c_power_levels[$state]);
			if (substr($output,1,8) == "00000020") {
				return true;
			} else {
				return false;
			}
		}
		
		public function getStoredPowerState() {
			$output = shell_exec( "/opt/scripte/duepi-serial-interface/sendData.sh " . $this->c_target_power_level );
			$output = substr($output,4,1);
			$output = hexdec($output);
			return $output;
		}
		
		public function getTargetTemp() {
			$output = shell_exec( "/opt/scripte/duepi-serial-interface/sendData.sh " . $this->c_target_ambient_temp );
			$output = substr($output,1,4);
			$output = hexdec($output);
			return $output . " °C";
		}
		
		public function getAmbientTemp() {
			$output = shell_exec( "/opt/scripte/duepi-serial-interface/sendData.sh " . $this->c_current_ambient_temp );
			$output = substr($output,1,4);
			$output = hexdec($output) / 10.0;
			return $output . " °C";
		}
		
		public function getState() {
			$output = shell_exec( "/opt/scripte/duepi-serial-interface/sendData.sh" . $this->c_current_state );
			$part_a = substr($output, 1,2);
			$part_b = substr($output,4,1);
			switch ($part_a) {
				case "00":	//Aus
				return 0;
				break;
				
				case "01":	//Anfeuern
				return 2;
				break;
				
				case "02":	//An
				return 1;
				break;
				
				case "04":	//cleaning
				return 5;
				break;
				
				case "08":	//Abkühlen
				return 3;
				break;
				
				case "10":
				if (($part_b == "1") or ($part_b == "2")) {
					return 3;
				} else {
					return 0;
				}
				break;
				
				default:
				return -1;
			}			
		}
		
		private function generateTemperatureTelegram(int $t_temp) {
			$xx = dechex($t_temp);
			$yy = dechex($t_temp + 75);
			return "RF2" . str_pad($xx,2,"0", STR_PAD_LEFT) . "0" . str_pad($yy,2,"0", STR_PAD_LEFT);
		}
		
		public function setTargetTemperature(int $t_temp) {
			if ($t_temp < 7) { $t_temp = 7; }
			if ($t_temp > 40) { $t_temp = 40; }
			$output = shell_exec( "/opt/scripte/duepi-serial-interface/sendData.sh " . $this->generateTemperatureTelegram($t_temp) );
		}
		
		
		
	}
?>