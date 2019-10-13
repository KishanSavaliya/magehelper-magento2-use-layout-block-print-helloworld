<?php
/**
 * MageHelper Print Hello World Simple module with the use of Layout and Block
 *
 * @package      MageHelper_UseOfLayoutAndBlock
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */

namespace MageHelper\UseOfLayoutAndBlock\Block;
  
class HelloWorld extends \Magento\Framework\View\Element\Template
{   
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ){
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        $this->setValue("Hello World from setValue() function in _prepareLayout()");
    }

    public function getContent(){
    	$content = "Hello, How are you? - using getContent() function.";
    	return $content;
    }
}