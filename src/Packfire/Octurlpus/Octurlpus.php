<?php

namespace Packfire\Octurlpus;

/**
 * Octurlpus class
 * 
 * Main functioning class for Octurlpus functionality
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Octurlpus
 * @since 1.0
 */
class Octurlpus {
    
    /**
     * Service providers
     * @var array
     * @since 1.0
     */
    private $providers = array(
        'YouTube',
        'Viddler',
        'WordPress',
        'SpeakerDeck',
        'Vimeo'
    );
    
    /**
     * Create a new Octurlpus instance
     * @since 1.0
     */
    public function __construct(){
        $this->loadProviders();
    }
    
    /**
     * Load the service providers
     * @since 1.0
     */
    private function loadProviders(){
        $providers = array();
        foreach($this->providers as $provider){
            $name = 'Packfire\\Octurlpus\\Drivers\\' . $provider . '\\Provider';
            $providers[$provider] = new $name();
        }
        $this->providers = $providers;
    }
    
    /**
     * Get the provider name for the URL
     * @param string $url The URL to check
     * @return string Returns the provider name if the URL matches, or NULL if
     *          no suitable provider can handle the URL.
     * @since 1.0
     */
    public function type($url){
        foreach($this->providers as $name => $provider){
            /* @var Packfire\Octurlpus\Provider $provider */
            if($provider->peek($url)){
                return $name;
            }
        }
    }
    
    /**
     * Request additional data about the URL
     * @param string $url The URL to retrieve more data
     * @return array Returns the data retrieved or NULL if no handler can handle
     *      the URL.
     * @since 1.0
     */
    public function request($url){
        foreach($this->providers as $provider){
            /* @var Packfire\Octurlpus\Provider $provider */
            if($provider->peek($url)){
                return $provider->fetch();
            }
        }
    }
    
}