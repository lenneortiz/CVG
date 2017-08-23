<?php /**
 *
 */
class estadisticaController extends Controller
{


  function __construct()
  {
    parent::__construct();
      $this->_estadistica = $this->loadModel('estadisticas');

  }

  public function index()
  {

      $this->_view->titulo ="ADMIN | Perfiles";

      $this->_view->loadView('index','admin');
      //print_r($this->_view->perfiles);
  }

  public function estadisticaBienes()
  {
    /////////////////////////////////////////////////////////////////////////////
    $query = "SELECT
            count(case estado  when '1'then 1 else null end)as operativo,
            count(case estado when '0'then 0 else null end)as inoperativo,
            count(case estado when '2'then 2 else null end)as regular
            from bienes";

    $this->_view->estadisticas_bienes_total = $this->_estadistica->joins($query);

        $rows['name'] = 'operativo';
        $rows1['name'] = 'inoperativo';
        $rows2['name'] = 'regular';
    foreach ($this->_view->estadisticas_bienes_total as $key => $row) {

      $rows['data'][] = $row['operativo'];
     $rows1['data'][] = $row['inoperativo'];
     $rows2['data'][] = $row['regular'];



    }
       $result = array();
        array_push($result,$rows,$rows1,$rows2);
        print json_encode($result, JSON_NUMERIC_CHECK);
  }
}
 ?>
