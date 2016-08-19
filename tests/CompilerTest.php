<?php

namespace Svengerlach\VanillaJSTemplate\Tests;

use Svengerlach\VanillaJSTemplate\Compiler;

class CompilerTest extends \PHPUnit_Framework_TestCase
{

    private function getCompiler() {
        return new Compiler();
    }
    
    public function testSingleLine() {
        $expected = $this->getStart() . '    p.push(\'<h2>\', foo, \', \', bar, \'</h2>\');' . PHP_EOL . $this->getEnd();
        $actual = $this->getCompiler()->compile('<h2><%= foo %>, <%= bar %></h2>');
        
        $this->assertEquals(
            $expected, 
            $actual
        );
    }
    
    public function testMultiLine() {
        $expected = $this->getStart() . '    p.push(\'<h1>\', foo, \'</h1> <h2>\', bar, \'</h2>\');' . PHP_EOL . $this->getEnd();
        $actual = $this->getCompiler()->compile("<h1><%= foo %></h1>\n<h2><%= bar %></h2>");

        $this->assertEquals(
            $expected,
            $actual
        );        
    }

    private function getStart() {
        return 'function(obj) {' . PHP_EOL
            . '  var p = [];' . PHP_EOL
            . '  ' . PHP_EOL
            . '  with(obj) {' . PHP_EOL
        ;
    }
    
    private function getEnd() {
        return "  }" . PHP_EOL
            . '  ' . PHP_EOL
            . "  return p.join('');" . PHP_EOL
            . '}'
        ;
    }
    
}