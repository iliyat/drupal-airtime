<?


class Airtime
	{
		var $show_version = false;
		
		function __construct($options)
			{
				//$this->api = new AirtimeAPI($options);
				//$this->api->version = 'airtime-class-test';
				$this->options = $options;
				$node = node_load($options->nid);
				if($node->field_airtime_api['und'][0]['value'] != '')
					{
						$this->options->host = $node->field_airtime_api['und'][0]['value'];
					}
				else
					{
						die('Not set API->host');
					}
			}
		function json()
			{
				return $this->get($this->options->method);
			}
			
		private function getJSON()
			{
				//if(!$this->api_key) $this->api_key = '';
				$json = @file_get_contents($this->options->host.'/api/'.$this->options->method.'/?api_key='.$this->options->api_key);
			
				if($json !== false)
					{
						$json = json_decode($json);
						if(!$this->show_version)	
							{
								unset($json->AIRTIME_API_VERSION);
							}
						return $json;
					}
				else
					{
						return false;
					}
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
				$result['file'] = $this->options->host.'/api/get-media/file/'.$id.'?api_key='.$this->options->api_key;
				return $result;
			}	
			
		public function set_api_key($key)
			{
				if($key)
					{
						$this->options->api_key = $key;
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
							return $this->media_file($arg->file);
							break;
						default:
							return false;
					}	
				
			}
	}

