<?php
/**
 * MageHelper Print Hello World Simple module with the use of Layout and Block
 *
 * @package      MageHelper_UseOfLayoutAndBlock
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */

namespace MageHelper\UseOfLayoutAndBlock\Controller\Hello;

class World extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ){
        $this->resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }
     
    public function execute()
    {
        return $this->resultPageFactory->create();
    } 
}