<?php

namespace Packfire\Octurlpus\Drivers\Vimeo;

use Packfire\Octurlpus\OEmbedProvider as OcturlpusProvider;

/**
 * Provider class
 * 
 * Providing Driver for Viddler URLs
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Octurlpus\Drivers\Viddler
 * @since 1.0
 */
class Provider extends OcturlpusProvider {
    
    
    protected function match($url){
        return preg_match('`^https*://(www\.)*vimeo\.com/\S+$`is', $url)
                || preg_match('`^https*://(www\.)*vimeo\.com/groups/\S+/videos/\S+$`is', $url);
    }
    
    protected function oembed(){
        return 'http://vimeo.com/api/oembed.json';
    }
    
}