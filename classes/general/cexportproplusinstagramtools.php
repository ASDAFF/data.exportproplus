<?
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\Loader::includeModule( "data.exportproplus" );

Loc::loadMessages( __FILE__ );

class CDataExportproplusInstagramTools{
    public $profile = null;
    public $log = null;
    public $instagramAccount = null;
    public $obInstagramModel = null;
    public $dbProfile = null;

    public function __construct( $profile ){
        $this->dbProfile = new CExportproplusProfileDB();
        $this->profile = $profile;
        $this->log = new CDataExportproplusLog( $this->profile["ID"] );
        $this->obInstagramModel = new CDataExportproplusInstagram( $this->profile );
        $this->instagramAccount = $this->obInstagramModel->GetAccessAccountData();
    }

    public function SavePost( $arData ){
        $arProductRelations = $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"];
				 $arProductRelations = array();

        $instagramPostId = false;

        #if( $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"] != null ){
        #    $instagramPostId = isset( $arProductRelations["POSTS"][$arData["ID"]] ) ? $arProductRelations["POSTS"][$arData["ID"]] : false;
        #}

        if( $instagramPostId ){
            $arUpdatePostData = $arData;
            $arUpdatePostData["POST_ID"] = $instagramPostId;
            $arUpdatedPost = $this->obInstagramModel->UpdatePhoto( $arUpdatePostData );

            if( isset( $arUpdatedPost["status"] ) && ( $arUpdatedPost["status"] != "ok" ) ){
                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#INSTAGRAM_ERROR#", "CODE: Instagram fail", GetMessage( "DATA_EXPORTPROPLUS_REQUIRED_FIELD_INSTAGRAM_SKIP" ) ) );
                $this->log->IncProductError();
            }
        }
        else{
            $arAddPostData = $arData;
            $arAddPostResponse = json_decode( $this->obInstagramModel->AddPhoto( $arAddPostData ), true );

            if( isset( $arAddPostResponse["status"] ) && ( $arAddPostResponse["status"] != "ok" ) ){
                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#INSTAGRAM_ERROR#", "CODE: Instagram fail", GetMessage( "DATA_EXPORTPROPLUS_REQUIRED_FIELD_INSTAGRAM_SKIP" ) ) );
                $this->log->IncProductError();
            }

            $instagramPostId = $arAddPostResponse["media"]["id"];

            if( $instagramPostId ){
                $this->log->IncProductExport();
                $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"]["POSTS"][$arData["ID"]] = $instagramPostId;
            }
        }

        $this->dbProfile->Update( $this->profile["ID"], $this->profile );
    }

    public function ClearSyncData(){
        self::DeleteSyncProducts();
        self::ResetSyncSettings();
    }

    /*public function DeleteSyncProducts(){
        $arProcessedProducs = array();
        foreach( $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"]["POSTS"] as $productId => $productInstagramId ){
            $arDeleteResponse = $this->obInstagramModel->DeletePhoto( array( $productInstagramId ) );

            if( $arDeleteResponse["response"] == 1 ){
                $arProcessedProducs[] = $productInstagramId;
            }
            else{
                break;
            }
        }

        $arUnprocessedProducts = array_diff( $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"]["POSTS"], $arProcessedProducs );
        if( empty( $arUnprocessedProducts ) ){
            $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"]["POSTS"] = null;
        }
        else{
            $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"]["POSTS"] = $arUnprocessedProducts;
        }

        $this->dbProfile->Update( $this->profile["ID"], $this->profile );

        if( !empty( $arUnprocessedProducts ) ){
            self::DeleteSyncProducts();
        }
    }

    public function ResetSyncSettings(){
        $this->profile["INSTAGRAM"]["INSTAGRAM_RELATIONS"] = null;
        $this->dbProfile->Update( $this->profile["ID"], $this->profile );
    }*/
}