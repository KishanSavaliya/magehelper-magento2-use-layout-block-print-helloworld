# MageHelper Print Hello World Simple module with the use of Layout and Block with the use of Layout and Block

We will learn here, how to create new simple "Hello World" module in Magento 2 step by step.

We can create new module in `app/code/` directory, previously in Magento 1 there were three code pools which are local, community and core but that has been removed now.

In this blog post we will see how to create a new module, create a route and display `hello world` using Magento 2 Block, Controller and Layout files and you can download this module as well for practice.

### Step - 1 - Create a directory for the module

- In Magento 2, module name divided into two parts i.e Vendor_Module (for e.g Magento_Theme, Magento_Catalog)
- We will create `MageHelper_UseOfLayoutAndBlock` here, So `MageHelper` is vendor name and `UseOfLayoutAndBlock` is name of this module.
- So first create your namespace directory (`MageHelper`) and move into that directory.
- Then create module name directory (`UseOfLayoutAndBlock`)

Now Go to : `app/code/MageHelper/UseOfLayoutAndBlock`

### Step - 2 - Create module.xml file to declare new module.

- Magento 2 looks for configuration information for each module in that module’s etc directory. so we need to add module.xml file here in our module `app/code/MageHelper/UseOfLayoutAndBlock/etc/module.xml` and it's content for our module is :

~~~ xml
<?xml version="1.0"?>
<!--
/**
 * MageHelper Print Hello World Simple module with the use of Layout and Block
 *
 * @package      MageHelper_UseOfLayoutAndBlock
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
-->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
	<module name="MageHelper_UseOfLayoutAndBlock" setup_version="1.0.0" />
</config>
~~~

In this file, we register a module with name `MageHelper_UseOfLayoutAndBlock` and the version is `1.0.0`.

### Step - 3 - create registration.php

- All Magento 2 module must be registered in the Magento system through the magento `ComponentRegistrar` class. This file will be placed in module's root directory.

In this step, we need to create this file:

~~~
app/code/MageHelper/UseOfLayoutAndBlock/registration.php
~~~

And it’s content for our module is:

~~~ php
<?php
/**
 * MageHelper Print Hello World Simple module with the use of Layout and Block
 *
 * @package      MageHelper_UseOfLayoutAndBlock
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'MageHelper_UseOfLayoutAndBlock',
    __DIR__
);
~~~

### Step - 4 - Enable `MageHelper_UseOfLayoutAndBlock` module.

- By finish above step, you have created an empty module. Now we will enable it in Magento environment.
- Before enable the module, we must check to make sure Magento has recognize our module or not by enter the following at the command line:

~~~ 
php bin/magento module:status
~~~

If you follow above step, you will see this in the result:

~~~
List of disabled modules:
MageHelper_UseOfLayoutAndBlock
~~~

This means the module has recognized by the system but it is still disabled. Run this command to enable it:

~~~
php bin/magento module:enable MageHelper_UseOfLayoutAndBlock
~~~

The module has enabled successfully if you saw this result:

~~~
The following modules has been enabled:
- MageHelper_UseOfLayoutAndBlock
~~~

This’s the first time you enable this module so Magento require to check and upgrade module database. We need to run this command:

~~~
php bin/magento setup:upgrade
~~~

### Step - 5 - Create Router for frontend

In the Magento system, a request URL has the following format:

~~~
[your_base_url]/<router_name>/<controller_name>/<action_name>
~~~

The Router is used to assign a URL to a corresponding controller and action. In this module. We will create router for frontend so we need to add this file: 

~~~
app/code/MageHelper/UseOfLayoutAndBlock/etc/frontend/routes.xml
~~~

And content for this file:

~~~ xml
<?xml version="1.0"?>
<!--
/**
 * MageHelper Print Hello World Simple module with the use of Layout and Block
 *
 * @package      MageHelper_UseOfLayoutAndBlock
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
-->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
    <router id="standard">
        <route id="magehelper_hello" frontName="magehelper_hello">
            <module name="MageHelper_UseOfLayoutAndBlock" />
        </route>
    </router>
</config>
~~~

After define the route, the URL path to our module of frontend will be: `http://example.com/magehelper_hello/*`

### Step - 6 - Create Controllers, Blocks, Layouts, Templates and Actions

- Now we will first create controller `Hello` and action `World`.
- For that we need to create `Controller` directory in our module here `app/code/MageHelper/UseOfLayoutAndBlock/Controller`.
- We will create another directory which is our controller's name inside Controller directory. i.e. `Hello`, So we will create that here `app/code/MageHelper/UseOfLayoutAndBlock/Controller/Hello`
- After creating controller's directory move into that directory.
- Now we will create action file. So in our case we will create `World.php` file here

`app/code/MageHelper/UseOfLayoutAndBlock/Controller/Hello/World.php`

Content for this file :

~~~ php
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
~~~

- Now our URL is `http://example.com/magehelper_hello/hello/world`

- We have added 'Magento\Framework\View\Result\PageFactory' into Controller's constructor which is used further to initialize the layout in execute() method.

- After creating controller and action, we need to create layout file now.

#### Layout

- In Magento 2 layouts are used to describe basic structure of any web page. We can use Containers and Blocks to create proper layout. Containers are used to create page layout. We can use multiple blocks and other containers as well in any single container. Blocks are designed for outputting HTML content of the page and that contains their template files.

- Now we will create new layout file for our action. We are creating layout for frontend so all frontend layout files of modules located inside this directory

~~~
app/code/MageHelper/UseOfLayoutAndBlock/view/frontend/layout/
~~~

- In Magento 2 for different actions we need to create different layout files to render HTML content.

- We will create one layout file here with this name `magehelper_hello_hello_world.xml`.

- We can create any layout files using this structure `<router_name>_<controller_name>_<action_name>.xml`

- So lets create our layout file here

~~~
app/code/MageHelper/UseOfLayoutAndBlock/view/frontend/layout/magehelper_hello_hello_world.xml
~~~

Content for this file is :

~~~ xml
<?xml version="1.0"?>
<!--
/**
 * MageHelper Print Hello World Simple module with the use of Layout and Block
 *
 * @package      MageHelper_UseOfLayoutAndBlock
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
-->
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column" xsi:noNamespaceSchemaLocation="../../../../../../../lib/internal/Magento/Framework/View/Layout/etc/page_configuration.xsd">       
    <referenceContainer name="content">
        <block
            template="MageHelper_UseOfLayoutAndBlock::helloworld.phtml"
            class="MageHelper\UseOfLayoutAndBlock\Block\HelloWorld"
            name="helloworld-with-layout-and-blocks"/>
    </referenceContainer>
</page>
~~~

- We used block and template in above xml file. So what is Block and templates in Magento 2 ?

#### Blocks and templates in Magento 2

- The Block file should contain all the view logic required, it should not contain any kind of html or css. Block file are supposed to have all application view logic.

- So we will create Block file in our module. For that we need to create `Block` directory in our module same as `Controller`.

- Then we will create `HelloWorld.php` block file here.

~~~
app/code/MageHelper/UseOfLayoutAndBlock/Block/HelloWorld.php
~~~

Content for this file :

~~~ php
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
~~~

- Afer creating above block file we need to create one template file. We can create module's template file on this location for frontend.

~~~
app/code/MageHelper/UseOfLayoutAndBlock/view/frontend/templates/helloworld.phtml
~~~

**Note : Make sure we need to create templates directory here not template**

Content for this file :

~~~
<strong><?php echo "Hello World (static)"; ?></strong><br>
<i><?php echo $this->getValue(); ?></i><br>
<?php echo $block->getContent(); ?>
~~~

- We are using phtml files for Magento template file, we can use HTML and PHP code togather here.

- We can add HTML as well as small view logics in template files in Magento.

- After creating Controller and Action file, please do run flush and clear cache commands.

### Step - 7 - Output

- Run following URL in web browser to check output.

~~~
http://example.com/magehelper_hello/hello/world
~~~

![MageHelper Print Hello World Simple module with the use of Layout and Block output](https://github.com/KishanSavaliya/magehelper-magento2-use-layout-block-print-helloworld/blob/master/MageHelper/Magento2-Use-Of-Layout-and-Block-file-output.png)


## Extra Notes :

- If we do not need to set controller or action name (like hello or world) then magento will automatically use index for both so if we run url only with our route name (like `http://example.com/magehelper_hello/`) then magento will find Index Controller and Index action. So for that we need to add code in Index.php file here `app/code/MageHelper/UseOfLayoutAndBlock/Controller/Index/Index.php` instead of `app/code/MageHelper/UseOfLayoutAndBlock/Controller/Hello/World.php`

