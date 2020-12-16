<?php
namespace develhopper;

class Curly{
    public $handler;
    private $options=array();
    
    public function __construct($url=null){
        if($url){
            $this->setOption(CURLOPT_URL,$url);
        }
        $this->handler=curl_init();
        $this->setOption(CURLOPT_RETURNTRANSFER,true);
    }

    public function setOption($key,$value){
        $this->options[$key]=$value;
    }

    public function getOption($key){
        if(isset($this->options[CURLOPT_URL]))
            return $this->options[CURLOPT_URL];
    }
    
    public function send($type,$param=array()){
        $type=strtoupper($type);
        if($type=="GET"){
            $this->setOption(CURLOPT_HTTPGET,true);
            $url=$this->getOption(CURLOPT_URL)."?".http_build_query($param);
            $this->setOption(CURLOPT_URL,$url);
        }else{
            $this->setOption(CURLOPT_CUSTOMREQUEST,$type);
            $this->setOption(CURLOPT_POSTFIELDS,$param);
        }
        return $this->exec();
    }

    private function exec(){
        curl_setopt_array($this->handler,$this->options);
        $result=curl_exec($this->handler);
        curl_close($this->handler);
    }

}