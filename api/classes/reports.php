<?php
 
class reports {

    private $db;

    function __construct($db_connect) {
        $this->db = $db_connect;
    }

    //===========================================================================================================
    //================================= retorna os tipos de visitantes
    //=======================================================================================================


    public function DashLreport($company_id) {
        $datebefore = date('Y-m-d')-6;
        try {
            $query = "SELECT  date, count(access.date) as total  FROM access where date 
                BETWEEN '" .$datebefore. "' and '".date('Y-m-d')."' and access.company_id = " . $company_id . " GROUP BY date";
            //echo $query;
            $sql = $this->db->prepare($query);
            $resrow = $sql->fetchAll(PDO::FETCH_OBJ); 
            if (!empty($resrow)) {return $resrow; //retorna os dados do banco como array
            } else {

            }
            $this->db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->db = null;
    }

    //===========================================================================================================
    //================================= retorna os tipos de visitantes
    //=======================================================================================================


    public function barDashAccessDayliReport($company_id) {
        try {

            $query = "SELECT type.name as labels, count(access.visitor_type_id) as data  FROM access
                        INNER JOIN visitors_type as type on access.visitor_type_id = type.id
                        where date = '" . date('Y-m-d') . "' and access.company_id = " . $company_id . "
                        group by type.name";


        //  echo $query;

            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($resrow)) {

                return $resrow; //retorna os dados do banco como array
            } else {
                $Vararray = array("labels" => "Sem Visitas", "data" => "0");
                return $Vararray;
            }
            $this->db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->db = null;
    }

    //===========================================================================================================   
    //================================= retorna os tipos de visitantes
    //=======================================================================================================


    public function DiaryAccesss($filter_datefrom, $filter_dateto, $company_id) {
        try {

            $query = "SELECT * FROM access where date = BETWEEN '" . $filter_datefrom . "' AND '" . $filter_dateto . "'and access.company_id = " . $company_id . "
                        group by type.name";




            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($resrow)) {

                return $resrow; //retorna os dados do banco como array
            } else {

                return false;
            }
            $this->db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->db = null;
    }

}
