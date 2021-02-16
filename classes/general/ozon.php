<?
class CExportproplusOzon{
    private $appID;
    private $signKey;
    private $token = null;
    private $expiration = 0;
    private $dbProfile = null;
    private $obXml = null;

    private $services = array(
        "get_types" => "merchants/products/types",
        "get_all_types" => "merchants/products/types/all",
        "get_all_products" => "merchants/products/all",
        "get_product" => "merchants/products",
        "save_product" => "merchants/products",
        "update_product" => "merchants/products/id/#ID#",
        "get_orders" => "merchants/orders",
        "get_description" => "merchants/xsd/description/#ID#",
        "get_job" => "merchants/jobs/#ID#",
    );

    public function __construct( $appID, $signKey ){
        $this->appID = $appID;
        $this->signKey = $signKey;
        $this->dbProfile = new CExportproplusProfileDB();
        $this->obXml = new CDataXML();
    }

    public function GetToken(){
        global $USER;
        if( is_array( $_SESSION[$USER->GetSessionHash()."-".$USER->GetID()]["OZON"] ) ){
            $this->token = $_SESSION[$USER->GetSessionHash()."-".$USER->GetID()]["OZON"]["TOKEN"];
            $this->expiration = $_SESSION[$USER->GetSessionHash()."-".$USER->GetID()]["OZON"]["EXPIRATION"];
        }

        if( ( $this->token != null ) && ( $this->expiration > time() ) ){
            return $this->token;
        }
        else{
            $s = curl_init();
            curl_setopt( $s, CURLOPT_URL, "https://api.ozon.ru/auth/token/merchants?applicationid={$this->appID}&sign=".hash_hmac( "sha1", "/auth/token/merchants?applicationid={$this->appID}", $this->signKey ) );
            curl_setopt( $s, CURLOPT_HTTPHEADER, array( "X-ApiVersion: 0.1" ) );
            curl_setopt( $s, CURLOPT_RETURNTRANSFER, true );
            $reply = curl_exec( $s );
            $reply = json_decode( $reply, true );
            if( isset( $reply["token"] ) ){
                $this->token = $reply["token"];
                $this->expiration = intval( $reply["expiration"] ) + time();
                $_SESSION[$USER->GetSessionHash()."-".$USER->GetID()]["OZON"]["TOKEN"] = $this->token;
                $_SESSION[$USER->GetSessionHash()."-".$USER->GetID()]["OZON"]["EXPIRATION"] = $this->expiration;
            }
            return $reply["responseStatus"];
        }
        return $this->token;
    }

    private function Process( $service, $id = false, $jsdecode = true, $arData = false, $sMethod = false ){
        $token = $this->GetToken();

        $s = curl_init();
        if( $id !== false )
            $service = str_replace( "#ID#", $id, $service );

        curl_setopt( $s, CURLOPT_URL, "https://api.ozon.ru/$service" );
        if( ( strlen( $arData ) > 0 ) && ( strlen( $sMethod ) > 0 ) && ( $sMethod != "GET" ) ){
            curl_setopt( $s, CURLOPT_CUSTOMREQUEST, $sMethod );
            curl_setopt( $s, CURLOPT_POSTFIELDS, $arData );
        }
        elseif( $sMethod == "GET" ){
            curl_setopt( $s, CURLOPT_URL, "https://api.ozon.ru/$service?".$arData );
        }

        curl_setopt( $s, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $s, CURLOPT_HTTPHEADER, array(
            "x-applicationid:{$this->appID}",
            "x-token:{$token}",
            "x-ApiVersion: 0.1",
            "Content-Type: application/json",
        ) );

        $reply = curl_exec( $s );

        curl_close( $s );

        if( $jsdecode ){
            $reply = mb_convert_encoding( $reply, "utf8", "cp1251" );
            try{
                $reply = \Bitrix\Main\Web\Json::decode( $reply );
            }
            catch( Exception $e ){
                $reply = array();
            }
        }

        return $reply;
    }

    public function GetTypes(){
        $data = $this->Process( $this->services["get_types"] );
        return is_array( $data ) ? $data["ProductTypes"] : array();
    }

    public function GetAllTypes(){
        $data = $this->Process( $this->services["get_all_types"] );
        return is_array( $data ) ? $data["ProductTypes"] : array();
    }

    public function GetAllProducts(){
        return $this->Process( $this->services["get_all_products"] );
    }

    public function GetOrders(){
        return $this->Process( $this->services["get_orders"] );
    }

    public function GetDescription( $id ){
        $data = $this->Process( $this->services["get_description"], $id );
        return is_array( $data ) ? $data["Xsd"] : "";
    }

    public function GetJob( $id ){
        return $this->Process( $this->services["get_job"], $id );
    }

    public function JobsProcess( $arProfile, $obLog, $dbProfile ){
        @set_time_limit( 0 );
        @ignore_user_abort( true );

        $arProcessJobs = array();
        $this->dbMan = new CExportproplusProfileDB();

        if( is_array( $arProfile["SETUP"]["OZON_JOBS"] ) && !empty( $arProfile["SETUP"]["OZON_JOBS"] ) ){
            foreach( $arProfile["SETUP"]["OZON_JOBS"] as $jobIndex => $jobId ){
                if( ( intval( $jobId ) > 0 ) ){
                    $arOzonJobInfo = $this->GetJob( $jobId );
                    if( $arOzonJobInfo["JobInfo"]["State"] == "Finished" ){
                        if( $arOzonJobInfo["ProcessingInfos"]["0"]["Activity"] != "Error" ){
                            $obLog->IncProductExport();
                        }
                        else{
                            $this->obXml->LoadString( $arOzonJobInfo["ProcessingInfos"][0]["Entities"] );
                            $arErrorData = $this->obXml->GetArray();
                            if( $arErrorData["Entities"]["#"]["Entity"][0]["#"]["ErrorCode"][0]["#"] == 40014 ){
                                $arProductData = $this->GetProduct( "MerchantSku=".$arOzonJobInfo["JobInfo"]["EntityId"] );

                                if( is_array( $arProductData ) && !empty( $arProductData ) && ( intval( $arProductData["Products"][0]["ProductId"] ) > 0 ) ){
                                    $arUpdateJobData = $this->UpdateProduct( $arProductData["Products"][0]["ProductId"], $arProfile["SETUP"]["OZON_DATA"][$arOzonJobInfo["JobInfo"]["EntityId"]] );

                                    $arOzonJobInfo = $this->GetJob( $arUpdateJobData["JobId"] );

                                    if( $arOzonJobInfo["JobInfo"]["State"] == "Finished" ){
                                        if( $arOzonJobInfo["ProcessingInfos"]["0"]["Activity"] != "Error" ){
                                            $obLog->IncProductExport();
                                        }
                                        else{
                                            $this->obXml->LoadString( $arOzonJobInfo["ProcessingInfos"][0]["Entities"] );
                                            $arErrorData = $this->obXml->GetArray();

                                            $obLog->AddMessage( "(ID: {$arOzonJobInfo["JobInfo"]["EntityId"]}) : ".str_replace( "#OZON_ERROR#", $arErrorData["Entities"]["#"]["Entity"][0]["#"]["ErrorCode"][0]["#"].": ".$arErrorData["Entities"]["#"]["Entity"][0]["#"]["ErrorData"][0]["#"], GetMessage( "DATA_EXPORTPROPLUS_REQUIRED_FIELD_OZON_SKIP" ) ) );
                                            $obLog->IncProductError();
                                        }
                                    }
                                    else{
                                        $arProfile["SETUP"]["OZON_JOBS"][] = $arUpdateJobData["JobId"];
                                    }
                                }
                            }
                            else{
                                $obLog->AddMessage( "(ID: {$arOzonJobInfo["JobInfo"]["EntityId"]}) : ".str_replace( "#OZON_ERROR#", $arErrorData["Entities"]["#"]["Entity"][0]["#"]["ErrorCode"][0]["#"].": ".$arErrorData["Entities"]["#"]["Entity"][0]["#"]["ErrorData"][0]["#"], GetMessage( "DATA_EXPORTPROPLUS_REQUIRED_FIELD_OZON_SKIP" ) ) );
                                $obLog->IncProductError();
                            }
                        }

                        $arProcessJobs[] = $jobId;
                    }
                }
                else{
                    unset( $arProfile["SETUP"]["OZON_JOBS"][$jobIndex] );
                }
            }
        }

        $arUnprocessedJobs = array_diff( $arProfile["SETUP"]["OZON_JOBS"], $arProcessJobs );
        if( !empty( $arUnprocessedJobs ) ){
            sort( $arUnprocessedJobs );
            $arProfile["SETUP"]["OZON_JOBS"] = $arUnprocessedJobs;
        }

        $this->dbProfile->Update( $arProfile["ID"], $arProfile );

        if( !empty( $arUnprocessedJobs ) ){
            self::JobsProcess( $arProfile, $obLog, $dbProfile );
        }
    }

    public function GetProduct( $data ){
        return $this->Process( $this->services["get_product"], false, true, $data, "GET" );
    }

    public function SaveProduct( $data ){
        return $this->Process( $this->services["save_product"], false, true, $data, "POST" );
    }

    public function UpdateProduct( $productId, $data ){
        return $this->Process( $this->services["update_product"], $productId, true, $data, "PUT" );
    }

    public function GetProcessData(){
        $arOzonDataTypes = $this->GetTypes();
        $arDataTypeDescription = array();
        foreach( $arOzonDataTypes as $arOzonDataTypesItem ){
            $arDataTypeDescription[$arOzonDataTypesItem["ProductTypeId"]] = $this->GetDescription( $arOzonDataTypesItem["ProductTypeId"] );
        }

        return $arDataTypeDescription;
    }
}