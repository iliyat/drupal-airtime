<?


class Airtime
	{
		
		function __construct($host)
			{
				$this->api = new AirtimeAPI($host);
				$this->api->version = 'airtime-class-test';
			}
	}

class AirtimeAPI
	{
		var $show_version = false;
		
		function __construct($host)
			{
				if($host)
					{
						$this->host = $host;
						$this->api_key = '';
					}
				else
					{
						die('Airtime API host not set.');
					}
			}
		private function getJSON($method, $arg = null)
			{
				//if(!$this->api_key) $this->api_key = '';
				$json = file_get_contents($this->host.'/api/'.$method.'/'.$arg.'/?api_key='.$this->api_key);
				$json = json_decode($json);
				if(!$this->show_version)	
					{
						unset($json->AIRTIME_API_VERSION);
					}
				return $json;
			}
		private function live_info()
			{
				$result = $this->getJSON('live-info');
				return $result;
			}
		private function week_info()
			{
				$result = $this->getJSON('week-info');
				return $result;
			}	
		
		private function schedule()
			{
				$result = $this->getJSON('schedule');
				return $result;
			}
			
		private function version()
			{
				$result = $this->getJSON('version');
				return $result;
			}
			
		private function media_file($id)
			{
				$result['file'] = $this->host.'/api/get-media/file/'.$id.'?api_key='.$this->api_key;
				return $result;
			}	
			
		public function set_api_key($key)
			{
				if($key)
					{
						$this->api_key = $key;
					}
				else
					{
						return false;
					}
			}
		
		public function get($method, $arg = false)
			{
				switch ($method)
					{
						case 'live-info':
							return $this->live_info();
							break;
						case 'week-info':
							return $this->week_info();
							break;
						case 'schedule':
							return $this->schedule();
							break;
						case 'version':
							return $this->version();
							break;
						case 'get-media-file':
							return $this->media_file($_GET['file']);
							break;
						default:
							return false;
					}	
				
			}
		
		
	}
