<?php

namespace banana;

use Exception;

/**
 * Description of UIViewBase
 *
 * @author gmadarasz
 */
class UIView {
    
    protected $template = null;
    protected $__data;
    
    public function setTemplate(string $template) {
        $this->template = $template;
        $this->validate();
    }
    
    public function setData($data) {
        $this->__data = $data;
    }
    
    public function output() {
        $this->validate();
        ob_start();
        foreach ($this->__data as $__key => $__value) {
            $$__key = $__value;
        }
        include $this->template;
        $contents = ob_get_contents();
        ob_end_clean();
        echo $contents;
    }
    
    protected function validate() {
        if (!file_exists($this->template)) {
            throw new Exception('Template file does not exists: ' . $this->template);
        }
    }
    
}
