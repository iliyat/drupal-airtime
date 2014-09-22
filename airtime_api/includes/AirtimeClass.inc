<?


class Airtime
	{
		protected $show_version = false;
		protected $api_key;
		
		function __construct(array $options)
			{
				if(!empty($options['host']))
				{
					$this->host = $options['host'];

					/* Set API key if exists */
					if(!empty($options['api_key'])) $this->api_key = $options['api_key'];
				}
				else
				{
					die('Not set API->host');
				}
			}
			
		private function getJSON($method, $key = false)
			{
				if($key && !empty($this->api_key))
				{
					$json = file_get_contents($this->host.'/api/'.$method.'/?api_key='.$this->api_key);
				}
				else
				{
					$json = file_get_contents($this->host.'/api/'.$method);
				}

				if(!empty($json))
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
				if(!empty($this->api_key))
				{$result = $this->getJSON('schedule');
					return $result;
				}
				return array('error' => 'API key needed for this method.');
			}
			
		private function version()
			{
				if(!empty($this->api_key))
				{$result = $this->getJSON('version');
					return $result;
				}
				return array('error' => 'API key needed for this method.');
			}
			
		private function media_file($id)
			{
				if(!empty($id))
				{
					$result['file'] = $this->host.'/api/get-media/file/'.$id.'?api_key='.$this->options->api_key;
					return $result;
				}

				return array('error' => 'File ID not set.');
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
							return $this->media_file($arg);
							break;
						default:
							return false;
					}	
				
			}
	}

