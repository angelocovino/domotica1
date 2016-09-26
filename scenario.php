<?php @include('shared/header.php'); ?>

<style>
    
@media screen and (min-width: 1800px) {
    .table{
        display: inline-block;
        width: 35%;  
        box-shadow: 0 0 1px 1px darkgray;
        border-radius: 20px;
        margin: 1%;
    }
    .single .image{
        width: 50%;
        font-size: 1em;
    }
     .single .image img{
            width: 50px;
     }
     .image{
        width: 43%;
        margin: 10px;
        display: inline-block;
        text-align: center;
        background-color: lightgray;
        box-shadow: 0 0 1px 1px darkgray;
        padding: 10px;
        border-radius: 20px;
        cursor: pointer;
    }
}
    
@media screen and (min-width: 801px) and (max-width: 1799px){
 .table{
        display: inline-block;
        width: 54%;  
        box-shadow: 0 0 1px 1px darkgray;
        border-radius: 20px;
        margin: 1%;
        font-size: 0.8em;
    }
    
    .single .image{
        width: 40%;
        font-size: 0.7em;
    }

     .single .image img{
        width: 50px;
     }
    
     .image{
        width: 35%;
        margin: 10px;
        display: inline-block;
        text-align: center;
        background-color: lightgray;
        box-shadow: 0 0 1px 1px darkgray;
        padding: 10px;
        border-radius: 20px;
        cursor: pointer;
    }
}
    
    
@media screen and (max-width: 800px) {

    .table{
        display: inline-block;
        width: 100%;  
        box-shadow: 0 0 1px 1px darkgray;
        border-radius: 20px;
        margin: 1%;
        font-size: 0.8em;
    }
    
    .single .image{
        width: 40%;
        font-size: 0.7em;
    }

     .single .image img{
        width: 30px;
     }
    
     .image{
        width: 35%;
        margin: 10px;
        display: inline-block;
        text-align: center;
        background-color: lightgray;
        box-shadow: 0 0 1px 1px darkgray;
        padding: 10px;
        border-radius: 20px;
        cursor: pointer;
    }
    
}
    
    .table{
        cursor: pointer;
    }
    
    .content{
        text-align: center;
    }

    .table img{
        width: 10%;
        margin-top: 10px;
    }
    .single{
        display: inline-block;
        margin: 1%;
        cursor: pointer;
    }

   
♀</style>

<div class="content">

    <div class="table">
        <img src="immagini/sun1.svg"><br>
        <div class="image" id="U" onclick="setLed('91','U','all')">
            Accendi area Giorno
        </div>
        <div class="image" id="V" onclick="setLed('91','V','all')">
            Spegni area Giorno
        </div>
    </div><br>
    <div class="table">
            <img src="immagini/moon-on.svg"><br>
        <div class="image" id="2" onclick="setLed('91','2','all')">
            Accendi area Notte
        </div>
        <div class="image" id="1" onclick="setLed('91','1','all')">
            Spegni area Notte
        </div>
    </div><br>
    <div class="table">
        <img src="immagini/bulb.svg"><br>
        <div class="image" id="Y" onclick="setLed('91','Y','all')">
            Accendi tutto
        </div>
        <div class="image" id="W" onclick="setLed('91','W','all')">
            Spegni tutto
        </div>
    </div><br>
    
    <div class="single">
        <div class="image" id="X" onclick="setLed('91','X','all')">
            <img src="immagini/sofa.svg" />
            Modalita Relax
        </div>
    </div>
    <div class="single">
        <div class="image" id="L" onclick="setLed('91','L','all')">
            <img src="immagini/video-camera.svg" />
            Modalita Cinema
        </div>
    </div>
    <div class="single">
        <div class="image" id="Z" onclick="setLed('91','Z','all')">
            <img src="immagini/ospite.svg" />
            Modalita Ospite
        </div>
    </div>
    
</div>

<?php @include('shared/footer.php'); ?>