<?php
if(!class_exists('connectionClass')){ include_once('connection.class.php'); };


class quotaClass {

    private $connClass;

    public function __construct(){
        $this->connClass = new connectionClass();
    }

    public function getQuotaListAll($selectTop = null, $startDate = null, $endDate = null){

        $arrResults = array();

        $conn = $this->connClass->sqlsrv_connection();
        if(!is_null($startDate) && !is_null($endDate)):
            $sql = "{CALL [RSS_getQuotaOpportunityListAll]($selectTop, '$startDate', '$endDate')}";
        else:
            $sql = "{CALL [RSS_getQuotaOpportunityListAll]($selectTop, null, null)}";
        endif;
        $query = sqlsrv_query($conn, $sql) or die( print_r( sqlsrv_errors(), true));
        while($result = sqlsrv_fetch_array($query)):
            $arrResults[] = array(
                $result[0] // status
                , $result[1] // quota
                , $result[2] // total
                , $result[3] // create_dttm
            );
        endwhile;
        return $arrResults;
    }//END: getQuotaListAll()

    public function getQuotaByDate(){

        $arrResults = array();

        $conn = $this->connClass->sqlsrv_connection();
        $sql = "{CALL [RSS_getQuotaOpportunityByDate](1)}";
        $query = sqlsrv_query($conn, $sql) or die( print_r( sqlsrv_errors(), true));
        while($result = sqlsrv_fetch_array($query)):
            $arrResults[] = array(
                $result[0] // date
            , $result[1] // status
            , $result[2] // total
            );
        endwhile;
        return $arrResults;

    }//END: getQuotaByDate()

    public function getQuotaGroupByDate(){

        $arrResults = array();

        $conn = $this->connClass->sqlsrv_connection();
        $sql = "{CALL [RSS_getQuotaOpportunityByDate](2)}";
        $query = sqlsrv_query($conn, $sql) or die( print_r( sqlsrv_errors(), true));
        while($result = sqlsrv_fetch_array($query)):
            $arrResults[] = array(
                $result[0] // date
                , $result[1] // AC
                , $result[2] // ACD
                , $result[3] // IA
            );
        endwhile;
        return $arrResults;

    }//END: getQuotaByDate()

}//END: quotaClass