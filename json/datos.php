<?php
header('Content-Type: application/json');
$pdo=new PDO("mysql:dbname=CVG;host=127.0.0.1","root","12345");


            $query=$pdo->prepare("SELECT
            count(case estado  when '1'then 1 else null end)as operativo,
            count(case estado when '0'then 0 else null end)as inoperativo,
            count(case estado when '2'then 2 else null end)as regular
            from bienes
            ");
            $query->execute();

            if($query->rowCount() > 0):

      $rows['name'] = 'operativo';
      $rows1['name'] = 'inoperativo';
      $rows2['name'] = 'regular';
      while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $rows['data'][] = $row['operativo'];
      $rows1['data'][] = $row['inoperativo'];
      $rows2['data'][] = $row['regular'];
      }

      $result = array();
      array_push($result,$rows,$rows1,$rows2);
      print json_encode($result, JSON_NUMERIC_CHECK);


      $listaEmpleos = "json/listaUsers.json";

      $data = json_encode($result);

      if ($fp = fopen($listaEmpleos, "w"))
      {
      fwrite($fp, $data);
      }
      fclose($fp);




endif;



?>
