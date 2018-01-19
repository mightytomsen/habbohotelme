<?php 
    
    class Route {
        
        private $urls = array();
        private $templateHandler = null;
		private $vars = [];
		
		public static $path = "/";
		
		public function __construct() {
			if(isset($_GET['url'])){
                $urlParam = rtrim($_GET['url'], '/');
				Route::$path = $urlParam;
            }
		}
        
        public function add($url, $callback){
            $this->urls[] = ['url' => strtolower($url), 'callback' => $callback];
            return $this;
        }
        
        public function setTemplateHandler(TemplateHandler $templateHandler) {
            $this->templateHandler = $templateHandler;
        }
        
        public function submit(){
            if(isset($_GET['url'])){
                $urlParam = rtrim($_GET['url'], '/');
            } else {
                $urlParam = '/';
            }
            
            foreach($this->urls as $value){
                if($value['url'] == $urlParam){
                    return $value['callback']($this->templateHandler);
                }
            }
            
            header('Location: ./');
            exit;
            
        }
        
    }