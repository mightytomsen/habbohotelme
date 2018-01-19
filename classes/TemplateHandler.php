<?php

final class TemplateHandler {
    
    private $templates = [];
    private $templatePath = '';
    
    public function __construct($tempaltePath) {
        $this->templatePath = $tempaltePath;
	}
    
    public function getTemplate($tplName) {
        if(!isset($this->templates[$tplName]))
            $this->templates[$tplName] = new Template($this->templatePath.'\\'.$tplName, $this);
        
        return $this->templates[$tplName];
    }
	
	public function generate(Template $mainTpl) {
		$main = [
			$this->getTemplate('head.php'),

			$mainTpl
		];
		
		foreach($main as $temp) {
			$temp->display();
		}
	}
}