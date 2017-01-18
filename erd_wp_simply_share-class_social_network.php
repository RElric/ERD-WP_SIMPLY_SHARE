<?php

/**** Class definition to use in other files ****/
class erd_ss_social_network {
    private $name;
    private $url;
    private $ordering;

    public function __construct($name, $url, $ordering) {
        $this->name = $name;
        $this->url = $url;
        $this->ordering = $ordering;
    }

    public function get($key) {
        return $this->$key;
    }

    public function set($key, $value) {
        $this->$key = $value;
    }

    public function retrieve_html() {
    		return '<a href="'.$this->url.'" rel="external no_follow" target="_blank" class="'.strtolower($this->name).'_btn"><span class="fa fa-2x fa-twitter"></span></a>';
    }

    public function retrieve_array() {
    		return array(
    				"name" => $this->name,
    				"url" => $this->url,
    				"ordering" => $this->ordering
    		);
    }
}
