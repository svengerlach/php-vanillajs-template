<?php

namespace Svengerlach\VanillaJSTemplate\Tests;

use Svengerlach\VanillaJSTemplate\Compiler, 
    Svengerlach\VanillaJSTemplate\TwigExtension;

class TwigExtensionTest extends \PHPUnit_Framework_TestCase
{

    private function getCompiler() {
        return new Compiler();
    }
    
    private function getTwigExtension() {
        return new TwigExtension($this->getCompiler());
    }
    
    private function getTwig(array $templates = []) {
        $loader = new \Twig_Loader_Array($templates);
        $twig = new \Twig_Environment($loader);
        
        $twig->addExtension($this->getTwigExtension());
        
        return $twig;
    }
    
    public function testTwigExtension() {
        $template = <<<TEMPLATE
var tmpl = {{ vanillajstemplate('<h1><%= foo %></h1>') }};
TEMPLATE;
        
        $expected = <<<EXPECTED
var tmpl = function(obj) {
  var p = [];
  
  with(obj) {
    p.push('<h1>', foo, '</h1>');
  }
  
  return p.join('');
};
EXPECTED;
        
        $this->assertEquals($expected, $this->getTwig(['template' => $template])->render('template'));
    }
    
}