<?php
class dbmanagment{
    private $pdo;
    function __construct__(){
        $pdo=null;
    }

    function opendatabase(){
        try{
            if($this->pdo==null){
                $this->pdo = new PDO("sqlite:database/domotica.sqlite3");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
            }
        }catch(PDOException $e){
            // logerror($e->getMessage(), "opendatabase");
            print "Error in openhrsedb ".$e->getMessage();
        }
    }

    function createDB(){
        if($this->tableExists("Comando") == FALSE){
                 $this->pdo->exec("CREATE TABLE Comando(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome TEXT,
                istruzione INTEGER)");     
            $this->insertComandi();
        }
        if($this->tableExists("Evento") == FALSE){
                 $this->pdo->exec("CREATE TABLE Evento(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ora INTEGER,
                minuti INTEGER,
                giorno INTEGER,
                mese INTEGER,
                anno INTEGER,
                comando INTEGER,
                FOREIGN KEY(comando) REFERENCES Comando(Id))");            
        }
    }

    function insertComandi(){

        $eventi = array(
        8 => "ON CLIMA CALDAIA",
        80 => " OFF CLIMA CALDAIA ",
        17 => "ON LUCE INGRESSO ",
        117 => "OFF LUCE INGRESSO  ",
        18 => "ON LUCE CUCINA ",
        118 => "OFF LUCE CUCINA ",
        19 => "ON LUCE PIANO CUCINA ",
        119 => "OFF LUCE PIANO CUCINA  ",
        20 => "ON MACCHINA DEL CAFFE",
        120 => "OFF MACCHINA DEL CAFFE",
        21 => "ON LUCE TAVOLO SNACK",
        121 => "OFF LUCE TAVOLO SNACK",
        22 => "ON LUCE TAVOLO GIORNO",
        122 => "OFF LUCE TAVOLO GIORNO",
        23 => "ON LUCE AREA GIORNO",
        123 => "OFF LUCE AREA GIORNO",
        25 => "ON PRESA COMANDATA SALONE",-
        125 => "OFF PRESA COMANDATA SALONE",
        26 => "ON FARETTI PARETE TV",
        126 => "OFF FARETTI PARETE TV",
        27 => "ON PRESA COMANDATA 2 SALONE ",
        127 => "OFF PRESA COMANDATA 2 SALONE ",
        28 => "ON PRESA COMANDATA 3 SALONE ",
        128 => "OFF PRESA COMANDATA 3 SALONE ",
        29 => "ON BOILER BAGNO ",
        129 => "OFF BOILER BAGNO ",
        30 => "ON CARICO FORNO ",
        130 => "OFF CARICO FORNO ",
        31 => "ON CARICO LAVATRICE ",
        131 => "OFF CARICO LAVATRICE ",
        32 => "ON CARICO ASCIUGATRICE ",
        132 => "OFF CARICO ASCIUGATRICE ",
        41 => "ON LUCE DISIMPEGNO NOTTE ",
        61 => "OFF LUCE DISIMPEGNO NOTTE ",
        42 => "ON LUCE BAGNO PRINCIPALE ",
        62 => "OFF LUCE BAGNO PRINCIPALE ",
        43 => "ON LUCE SPECCHIO LAVABI ",
        63 => "OFF LUCE SPECCHIO LAVABI  ",
        44 => "ON LUCE AREA WC ",
        64 => "OFF LUCE AREA WC ",
        45 => "ON  LUCE BAGNO OSPITI ",
        65 => "OFF LUCE BAGNO OSPITI ",
        46 => "ON LUCE SERVIZI BAGNO OSPITI ",
        66 => "OFF LUCE SERVIZI BAGNO OSPITI ",
        47 => "ON LUCE CAMERA MATRIMONIALE ",
        67 => "OFF LUCE CAMERA MATRIMONIALE ",
        48 => "ON SOFT CAMERA MATRIMONIALE ALINA  ",
        68 => "OFF SOFT CAMERA MATRIMONIALE ALINA ",
        49 => "ON SOFT CAMERA MATRIMONIALE ARTURO",
        69 => "OFF SOFT CAMERA MATRIMONIALE ARTURO",
        50 => "ON LUCE CAMERA TONY",
        70 => "OFF LUCE CAMERA TONY",
        51 => "ON SOFT CAMERA TONY",
        71 => "OFF SOFT CAMERA TONY",
        52 => "ON LUCE CAMERA ANDREA",
        72 => "OFF LUCE CAMERA ANDREA",
        53 => "ON SOFT CAMERA ANDREA",
        73 => "OFF SOFT CAMERA ANDREA",
        54 => "ON LUCE CAMERA ELISA",
        74 => "OFF LUCE CAMERA ELISA",
        55 => "ON SOFT CAMERA ELISA",
        75 => "OFF SOFT CAMERA ELISA",
        56 => "START ASPIRAZIONE BAGNO",
        86 => "ON LUCE BALCONE",
        87 => "OFF LUCE BALCONE",
        88 => "ON LUCE RIPOSTIGLIO",
        89 => "OFF LUCE RIPOSTIGLIO",
        90 => "ON IRRIGAZIONE BALCONE",
        91 => "OFF IRRIGAZIONE BALCONE",
        92 => "ON CLIMA FREDDO",
        93 => "OFF CLIMA FREDDO",
        99 => "ACCENDI LE LUCI AREA GIORNO",
        199 => "SPEGNI LE LUCI AREA GIORNO");
    
        foreach($eventi as $key => $value){
            $this->pdo->exec("INSERT INTO Comando (nome,istruzione) VALUES ('" . $value . "'," . $key . ");");
        }
    }
    
    
    function getComando(){
        $result = $this->pdo->query('SELECT * FROM Comando');
        $result = $result->fetchAll();
        return $result;
    }
    
    function getEvents(){
        $result = $this->pdo->query('SELECT * FROM Evento');
        $result = $result->fetchAll();
        return $result;
    }
    
    function getEventsWithParams($mese,$anno){
        $query = "SELECT Comando.nome, Evento.id, (Evento.ora || ':' || Evento.minuti) as ora, Evento.giorno FROM Evento INNER JOIN Comando ON Evento.comando = Comando.id WHERE mese = {$mese} and anno = {$anno} ORDER BY giorno , ora , minuti";
        $result = $this->pdo->query($query);
        $result = $result->fetchAll();
        $arr = array();
        foreach($result as $i => $cose){
            $arr[$cose['giorno']][$cose['ora']] = array(
                'id' => $cose['id'],
                'comandoNome' => $cose['nome']
            );
        }   
        return $arr;
    }
    
    function addEvents($ora, $minuti, $giorno, $mese, $anno, $comando ){
        $str = "INSERT INTO Evento (ora, minuti, giorno, mese, anno, comando) VALUES ({$ora},{$minuti},{$giorno},{$mese},{$anno},{$comando});";
        $this->pdo->exec($str);
    }
    
    function deleteEvents($id){
        $str = "DELETE FROM Evento WHERE id={$str}";
        $this->pdo->exec($str);
    }
    
    
    private function tableExists($table) {

    // Try a select statement against the table
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
    try {
        $result = $this->pdo->query("SELECT 1 FROM $table LIMIT 1");
    } catch (Exception $e) {
        // We got an exception == table not found
        return FALSE;
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== FALSE;
}

}

?>