<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UserTable;
use Bitrix\Catalog;

Loc::loadMessages( __FILE__ );

class CExportproplusMarketTiuDB{
    private $tableName = "data_exportproplus_market_tiu";
    private $serial = array();

    public function GetList(){
        global $DB;
        $arResult = array();
        $dbRes = $DB->Query( "SELECT * FROM {$this->tableName}" );
        if( $dbRes ){
            while( $arItem = $dbRes->Fetch() ){
                $arResult[$arItem["ID"]] = array(
                    "ID" => $arItem["ID"],
                    "NAME" => implode( " > ", array_diff( array( $arItem["NAME1"], $arItem["NAME2"], $arItem["NAME3"], $arItem["NAME4"] ), array( "" ) ) ),
                    "PORTAL_URL" => $arItem["PORTAL_URL"],
                    "PORTAL_ID" => $arItem["PORTAL_ID"]
                );
            }
        }
        return $arResult;
    }

    public function GetMarketList( $marketId ){
        $arMarketCategory = false;

        $marketTiuCategory = $this->GetList();

        if( is_array( $marketTiuCategory ) && !empty( $marketTiuCategory ) ){
            $arMarketCategory = array();
            foreach( $marketTiuCategory as $marketTiuCategoryItem ){
                $arMarketCategory[] = $marketTiuCategoryItem["NAME"];
            }
            array_walk( $arMarketCategory, "CDataExportproplusStringProcess::DataArrayTrimFunc" );
        }

        return $arMarketCategory;
    }

    public function GetByID( $id = 0 ){
        global $DB;
        $id = intval( $id );
        $arResult = array();
        $dbRes = $DB->Query( "SELECT * FROM {$this->tableName} WHERE id=$id" );
        if( $dbRes )
            $arResult = $dbRes->Fetch();

        return $arResult;
    }

    public function Add( array $arFields ){
        global $DB;

        $arResultFields = array();
        $arDataFields = array_keys( $DB->GetTableFields( $this->tableName ) );
        foreach( $arFields as $fieldsItemIndex => $arFieldsItem ){
            $arResultFields[$arDataFields[$fieldsItemIndex]] = $arFieldsItem;
        }

        $this->PrepareFields( $arResultFields );
		$id = $DB->Insert( $this->tableName, $arResultFields );

        return $id;
    }

    public function Update( $id, array $arFields ){
        global $DB;
		$this->PrepareFields( $arFields );
		$Cnt = $DB->Update( $this->tableName, $arFields, "WHERE id=$id" );
		return $Cnt;
    }

    private function PrepareFields( &$arFields ){
        global $DB;
        foreach( $arFields as &$value )
            $value = "'".$DB->ForSql( $value )."'";
    }

    public function Delete( $id ){
        global $DB;
        $id = intval( $id );
        $arResult = $DB->Query( "DELETE FROM ".$this->tableName." WHERE ID='".$id."'", false, "File: ".__FILE__."<br/>Line: ".__LINE__ );

        return $arResult;
    }

    public function DeleteAll(){
        global $DB;
        $arResult = $DB->Query( "DELETE FROM ".$this->tableName, false, "File: ".__FILE__."<br/>Line: ".__LINE__ );

        return $arResult;
    }

    private function SerializeData( $arFields ){
		foreach( $this->serial as $type ){
			$arFields[$type] = base64_encode( serialize( $arFields[$type] ) );
		}
		return $arFields;
	}

	private function UnserializeData( $arFields ){
		$arFields = $arFields->Fetch();
		if( !$arFields ){
			return false;
		}

		foreach( $this->serial as $type ){
			$arFields[$type] = unserialize( base64_decode( $arFields[$type] ) );
		}

		return $arFields;
	}
}