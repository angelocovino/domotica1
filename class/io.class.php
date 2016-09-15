<?php
    class saIO {
        private $types = array("led", "btn");
        
        private $type;
        private $number;
        private $port;
        
        private function __construct($type, $number, $port){
            if(in_array($type, $this->types)){
                $this->type = $type;
                $this->number = $number;
                $this->port = $port;
            }else{
                throw new Exception("Sei una capra", 666);
            }
        }
        
        function getData(){
            return (" data-port='{$this->port}' data-acceso='0' data-{$this->type}='{$this->number}'");
        }
        
        static public function led($number, $port){ return (new saIO('led', $number, $port)); }
        static public function btn($number, $port){ return (new saIO('btn', $number, $port)); }
    }
?>