<?php

final class Template {
    private $file;
    private $vars = [];
    private $templateHandler;
	
    public function __construct($file, TemplateHandler $tplh) {
        $this->file = $file;
		$this->templateHandler = $tplh;
    }
    
    public function __set($var, $val) {
		
        $this->vars[$var] = $val;
    }
    
    public function __get($var) {
        return isset($this->vars[$var]) ? $this->vars[$var] : null;
    }

    public function display($constructSite = false) {
		global $connection;
		if($constructSite) {
			return $this->templateHandler->generate($this);	
		} else {
	        require $this->file;
		}
    }
    
    public function __call($var, $arguments) {
        return isset($this->vars[$var]) && is_callable($this->vars[$var]) ? $this->vars[$var]($arguments) : null;
    }
}