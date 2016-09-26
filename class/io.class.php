<?php
    class saIO {
        private $types = array("led", "btn", "rgb", "white");
        
        private $type;
        private $number;
        private $port;
        private $isDifferentImage;
        private $imageOn;
        private $imageOff;
        
        private function __construct($type, $number, $port){
            if(in_array($type, $this->types)){
                $this->type = $type;
                $this->number = $number;
                $this->port = $port;
                $this->isDifferentImage = false;
                $this->imageOn = false;
                $this->imageOff = false;
            }else{
                throw new Exception("Sei una capra", 666);
            }
        }
        
        public function setImage($imageOn, $imageOff){
            $this->isDifferentImage = true;
            $this->imageOn = $imageOn;
            $this->imageOff = $imageOff;
            return ($this);
        }
        public function setImageTapparella(){
            $this->setImage();
            return ($this);
        }
        public function getData(){
            $str = "";
            if(strcasecmp($this->type, "rgb") == 0){
                $turnoff = 0;
                if(is_bool($this->number) && ($this->number)){
                    $turnoff = 1;
                    $str .= " data-turnoff-rgb='" . $turnoff . "'";
                }
                $str .= " data-port='{$this->port}'";
            }elseif(strcasecmp($this->type, "white") == 0){
                $turnoff = 0;
                if(is_bool($this->number) && ($this->number)){ $turnoff = 1; }
                $str .= " data-port='{$this->port}' data-turnoff='" . $turnoff . "'";
            }else{
                $str .= " data-port='{$this->port}' data-acceso='0' data-{$this->type}='{$this->number}'";
            }
            if($this->isDifferentImage){
                $str .= " data-image-on='" . $this->imageOn . "' data-image-off='" . $this->imageOff . "'";
            }
            return ($str);
        }
        public function getImageOff(){return ($this->imageOff);}
        
        static public function led($number, $port){ return (new saIO('led', $number, $port)); }
        static public function btn($number, $port){ return (new saIO('btn', $number, $port)); }
        static public function rgb($port, $turnOff = false){ return (new saIO('rgb', $turnOff, $port)); }
        static public function white($port, $turnOff = false){ return (new saIO('white', $turnOff, $port)); }
    }
?>