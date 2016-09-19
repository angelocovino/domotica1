<?php
    class saIO {
        private $types = array("led", "btn", "rgb", "white");
        
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
            if(strcasecmp($this->type, "rgb") == 0){
                return (" data-port='{$this->port}'");
            }elseif(strcasecmp($this->type, "white") == 0){
                $turnoff = 0;
                if(is_bool($this->number) && ($this->number)){ $turnoff = 1; }
                return (" data-port='{$this->port}' data-turnoff='" . $turnoff . "'");
            }else{
                return (" data-port='{$this->port}' data-acceso='0' data-{$this->type}='{$this->number}'");
            }
        }
        
        static public function led($number, $port){ return (new saIO('led', $number, $port)); }
        static public function btn($number, $port){ return (new saIO('btn', $number, $port)); }
        static public function rgb($port){ return (new saIO('rgb', false, $port)); }
        static public function white($port, $turnOff = false){ return (new saIO('white', $turnOff, $port)); }
    }
?>