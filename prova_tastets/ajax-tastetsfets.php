 <?php
session_start();
    header('Content-type: application/json; charset=utf-8');
   if(isset($_GET["id"]))
    {   
        try{
            $con = new PDO('mysql:host=localhost;dbname=activitats', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
       
    $sel="SELECT activitats_fetes.*,solicituts.centre,activitats.nom from activitats_fetes,solicituts,activitats where solicituts.id=activitats_fetes.solicitut_id and activitats.id=activitats_fetes.activitat_id and solicituts.activitat_id=".$_GET["id"].";";
        $res=$con->query($sel);
        $dat=$res->fetchAll();
       if(count($dat)>0)
       {
           for($i=0;$i<count($dat);$i++)
           {
               foreach($dat[$i] as $clave=>$valor)
               {
                   if(!is_numeric($clave)) $dato[$i][$clave]=$valor;

               }
           }
           $dat=$dato;
            echo json_encode($dat);

       }
      else 
      {
          $dat="No Hi han tastets fets";
          echo json_encode($dat);
      }
       
   }
?>