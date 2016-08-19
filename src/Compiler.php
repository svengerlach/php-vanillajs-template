<?php

namespace Svengerlach\VanillaJSTemplate;

class Compiler implements CompilerInterface
{
    
    public function compile($template)
    {
        $template = preg_replace('/[\r\t\n]/', ' ', $template);
        $template = implode("\t", preg_split('/<%/', $template));
        $template = preg_replace('/((^|%>)[^\t]*)\'/', "$1\r", $template);
        $template = preg_replace('/\t=\s*(.*?)\s*%>/', "', $1, '", $template);
        $template = implode("');", preg_split('/\t/', $template));
        $template = implode("p.push('", preg_split('/%>/', $template));
        $template = implode("\\'", preg_split('/\r/', $template));
        
        $fn = 'function(obj) {' . PHP_EOL
            . '  var p = [];' . PHP_EOL
            . '  ' . PHP_EOL
            . '  with(obj) {' . PHP_EOL
            . "    p.push('" . $template . "');" . PHP_EOL
            . "  }" . PHP_EOL
            . '  ' . PHP_EOL
            . "  return p.join('');" . PHP_EOL
            . '}'
        ;
        
        return $fn;    
    }

}