<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\Loader::includeModule( "acrit.exportproplus" );

Loc::loadMessages( __FILE__ );

class CAcritExportproplusOkTools{
    public $profile = null;
    public $log = null;
    public $okAccount = null;
    public $obOkModel = null;
    public $dbProfile = null;

    public function __construct( $profile ){
        $this->dbProfile = new CExportproplusProfileDB();
        $this->profile = $profile;
        $this->log = new CAcritExportproplusLog( $this->profile["ID"] );
        $this->obOkModel = new CAcritExportproplusOk( $this->profile );
        $this->okAccount = $this->obOkModel->GetAccessAccountData();
    }

    public function GetPhotoAlbumId( $categoryId ){
        $arProductRelations = $this->profile["OK"]["OK_RELATIONS"];

        $okPhotoAlbumId = false;
        if( isset( $arProductRelations["PHOTO_ALBUMS"][$categoryId] )
            && ( intval( $arProductRelations["PHOTO_ALBUMS"][$categoryId] ) > 0 )
        ){
            $okPhotoAlbumId = $arProductRelations["PHOTO_ALBUMS"][$categoryId];
        }
        else{
            $categoryName = $this->profile["OK"]["OK_ALBUMS"][$categoryId];
            $arProcessCatIds = array_keys( $this->profile["OK"]["OK_ALBUMS"], $categoryName );

            foreach( $arProcessCatIds as $procCategoryId ){
                if( isset( $arProductRelations["PHOTO_ALBUMS"][$procCategoryId] )
                    && ( intval( $arProductRelations["PHOTO_ALBUMS"][$procCategoryId] ) > 0 )
                ){
                    $okPhotoAlbumId = $arProductRelations["PHOTO_ALBUMS"][$procCategoryId];
                    break;
                }
            }
        }

        return $okPhotoAlbumId;
    }

    public function CheckPhotoInAlbum( $albumId, $dataId ){
        $bHasPhotoInAlbum = false;

        $arAlbumPhotos = $this->obOkModel->GetPhotos( array( "ID" => $albumId ) );
        if( !empty( $arAlbumPhotos ) ){
            $arRelations = $this->profile["OK"]["OK_RELATIONS"];

            if( is_array( $arRelations["PHOTO_ITEMS"][$dataId] )
                && !empty( $arRelations["PHOTO_ITEMS"][$dataId] )
            ){
                $arIntersertPhotos = array_intersect( $arRelations["PHOTO_ITEMS"][$dataId], $arAlbumPhotos );

                if( is_array( $arIntersertPhotos ) && !empty( $arIntersertPhotos ) ){
                    $bHasPhotoInAlbum = true;
                }
            }
        }

        return $bHasPhotoInAlbum;
    }

    public function GetItemCatalogId( $categoryId ){
        $arProductRelations = $this->profile["OK"]["OK_RELATIONS"];

        $okItemCatalogId = false;
        if( isset( $arProductRelations["MARKET_CATALOGS"][$categoryId] )
            && ( intval( $arProductRelations["MARKET_CATALOGS"][$categoryId] ) > 0 )
        ){
            $okItemCatalogId = $arProductRelations["MARKET_CATALOGS"][$categoryId];
        }
        else{
            $categoryName = $this->profile["OK"]["OK_CATALOGS"][$categoryId];
            $arProcessCatIds = array_keys( $this->profile["OK"]["OK_CATALOGS"], $categoryName );

            foreach( $arProcessCatIds as $procCategoryId ){
                if( isset( $arProductRelations["MARKET_CATALOGS"][$procCategoryId] )
                    && ( intval( $arProductRelations["MARKET_CATALOGS"][$procCategoryId] ) > 0 )
                ){
                    $okItemCatalogId = $arProductRelations["MARKET_CATALOGS"][$procCategoryId];
                    break;
                }
            }
        }

        return $okItemCatalogId;
    }

    public function CheckItemInCatalog( $catalogId, $dataId ){
        $bHasItemInCatalog = false;

        $arCatalogItems = $this->obOkModel->GetMarketItemsByCatalog( $catalogId );
        if( !empty( $arCatalogItems ) ){
            $arRelations = $this->profile["OK"]["OK_RELATIONS"];

            if( is_array( $arRelations["MARKET_ITEMS"][$dataId] )
                && !empty( $arRelations["MARKET_ITEMS"][$dataId] )
            ){
                $arIntersertItems = array_intersect( $arRelations["MARKET_ITEMS"][$dataId], $arCatalogItems );

                if( is_array( $arIntersertItems ) && !empty( $arIntersertItems ) ){
                    $bHasItemInCatalog = true;
                }
            }
        }

        return $bHasItemInCatalog;
    }

    public function ProcessData( $arData ){
        $arProductRelations = $this->profile["OK"]["OK_RELATIONS"];

        $okMediatopicId = false;
        $okPhotoId = false;

        if( $this->profile["OK"]["OK_RELATIONS"] != null ){
            $okMediatopicId = isset( $arProductRelations["MEDIATOPIC_ITEMS"][ $arData["ID"] ] ) ? $arProductRelations["MEDIATOPIC_ITEMS"][ $arData["ID"] ] : false;
            $okPhotoId = isset( $arProductRelations["PHOTO_ITEMS"][$arData["ID"]] ) ? $arProductRelations["PHOTO_ITEMS"][$arData["ID"]] : false;
        }

        if( !$okMediatopicId ){
            if( intval( $this->obOkModel->okAccount["GROUP"] ) > 0 ){
                if( $this->profile["OK"]["OK_RELATIONS"] == null ){
                    $this->profile["OK"]["OK_RELATIONS"] = array();
                    $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"] = array();
                    $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"] = array();
                    $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ITEMS"] = array();
                    $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"] = array();
                    $this->profile["OK"]["OK_RELATIONS"]["MARKET_ITEMS"] = array();
                }

                $arAddMediatopicResponse = $this->obOkModel->AddMediatopic( $arData );

                if( isset( $arAddMediatopicResponse["error_code"] ) ){
                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#OK_ERROR#", "CODE: ".$arAddMediatopicResponse["error_code"]." - ".$arAddMediatopicResponse["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP" ) ) );
                    $this->log->IncProductError();
                }
                else{
                    $okMediatopicId = $arAddMediatopicResponse;
                }

                if( $okMediatopicId ){
                    $this->log->IncProductExport();
                    $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"][$arData["ID"]] = $okMediatopicId;

                    $arOkPhotoAlbumFiles = array();
                    $arOkPhotoAlbumFiles[] = array(
                        "PHOTO" => $arData["PHOTO"],
                        "DESCRIPTION" => $arData["DESCRIPTION"],
                        "URL" => $arData["URL"],
                    );

                    if( is_array( $arData["OK"]["OK_ALBUMS"] ) && !empty( $arData["OK"]["OK_ALBUMS"] ) ){
                        foreach( $arData["OK"]["OK_ALBUMS"] as $okMultiAlbumItemIndex => $okMultiAlbumItem ){
                            $okPhotoAlbumId = self::GetPhotoAlbumId( $okMultiAlbumItem["ID"] );

                            if( !$okPhotoAlbumId ){
                                $arCreateAlbumData = array(
                                    "NAME" => $okMultiAlbumItem["NAME"]
                                );

                                $arCreatedGroupAlbum = $this->obOkModel->CreateAlbum( $arCreateAlbumData );

                                if( isset( $arCreatedGroupAlbum["error_code"] ) ){
                                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#OK_ERROR#", "CODE: ".$arCreatedGroupAlbum["error_code"]." - ".$arCreatedGroupAlbum["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP" ) ) );
                                    $this->log->IncProductError();
                                }
                                else{
                                    $okPhotoAlbumId = $arCreatedGroupAlbum;
                                }

                                $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"][$okMultiAlbumItem["ID"]] = $okPhotoAlbumId;

                                $bHasPhotoItem = self::CheckPhotoInAlbum( $okPhotoAlbumId, $arData["ID"] );
                                if( !$bHasPhotoItem ){
                                    $arAddPhotoData = array(
                                        "PHOTO" => $arData["PHOTO"],
                                        "AID" => $okPhotoAlbumId
                                    );

                                    $arAddedGroupPhoto = $this->obOkModel->UploadPhotosToAlbum( $arAddPhotoData );

                                    if( isset( $arAddedGroupPhoto["error_code"] ) ){
                                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#OK_ERROR#", "CODE: ".$arAddedGroupPhoto["error_code"]." - ".$arAddedGroupPhoto["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP" ) ) );
                                        $this->log->IncProductError();
                                    }
                                    else{
                                        $okPhotoId = $arAddedGroupPhoto["photos"][0]["assigned_photo_id"];
                                    }

                                    $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ITEMS"][$arData["ID"]][] = $okPhotoId;
                                }
                            }
                            else{
                                $bHasPhotoItem = self::CheckPhotoInAlbum( $okPhotoAlbumId, $arData["ID"] );
                                if( !$bHasPhotoItem ){
                                    $arAddPhotoData = array(
                                        "PHOTO" => $arData["PHOTO"],
                                        "AID" => $okPhotoAlbumId
                                    );

                                    $arAddedGroupPhoto = $this->obOkModel->UploadPhotosToAlbum( $arAddPhotoData );

                                    if( isset( $arAddedGroupPhoto["error_code"] ) ){
                                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#OK_ERROR#", "CODE: ".$arAddedGroupPhoto["error_code"]." - ".$arAddedGroupPhoto["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP" ) ) );
                                        $this->log->IncProductError();
                                    }
                                    else{
                                        $okPhotoId = $arAddedGroupPhoto["photos"][0]["assigned_photo_id"];
                                    }


                                    $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ITEMS"][$arData["ID"]][] = $okPhotoId;
                                }
                            }
                        }
                    }

                    if( is_array( $arData["OK"]["OK_CATALOGS"] ) && !empty( $arData["OK"]["OK_CATALOGS"] ) ){
                        foreach( $arData["OK"]["OK_CATALOGS"] as $okMultiCatalogItemIndex => $okMultiCatalogItem ){
                            $okMarketCatalogId = self::GetItemCatalogId( $okMultiCatalogItem["ID"] );

                            if( !$okMarketCatalogId ){
                                $arAddMarketCatalogData = array(
                                    "NAME" => $okMultiCatalogItem["NAME"],
                                    "PHOTO" => $arData["PHOTO"],
                                );

                                $arAddMarketCatalog = $this->obOkModel->AddMarketCatalog( $arAddMarketCatalogData );

                                if( isset( $arAddMarketCatalog["error_code"] ) ){
                                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#OK_ERROR#", "CODE: ".$arAddMarketCatalog["error_code"]." - ".$arAddMarketCatalog["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP" ) ) );
                                    $this->log->IncProductError();
                                }
                                else{
                                    $okMarketCatalogId = $arAddMarketCatalog["catalog_id"];
                                }

                                $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"][$okMultiCatalogItem["ID"]] = $okMarketCatalogId;

                                $bHasItemInCatalog = self::CheckItemInCatalog( $okMarketCatalogId, $arData["ID"] );
                                if( !$bHasItemInCatalog ){
                                    $arAddMarketItemData = $arData;
                                    $arAddMarketItemData["CATALOGS"] = array(
                                        $okMarketCatalogId
                                    );

                                    $arAddedMarketItem = $this->obOkModel->AddMarketItem( $arAddMarketItemData );

                                    if( isset( $arAddedMarketItem["error_code"] ) ){
                                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#OK_ERROR#", "CODE: ".$arAddedMarketItem["error_code"]." - ".$arAddedMarketItem["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP" ) ) );
                                        $this->log->IncProductError();
                                    }
                                    else{
                                        $okMarketItemId = $arAddedMarketItem["product_id"];
                                    }

                                    $this->profile["OK"]["OK_RELATIONS"]["MARKET_ITEMS"][$arData["ID"]][] = $okMarketItemId;
                                }
                            }
                            else{
                                $bHasItemInCatalog = self::CheckItemInCatalog( $okMarketCatalogId, $arData["ID"] );
                                if( !$bHasItemInCatalog ){
                                    $arAddMarketItemData = $arData;
                                    $arAddMarketItemData["CATALOGS"] = array(
                                        $okMarketCatalogId
                                    );

                                    $arAddedMarketItem = $this->obOkModel->AddMarketItem( $arAddMarketItemData );

                                    if( isset( $arAddedMarketItem["error_code"] ) ){
                                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#OK_ERROR#", "CODE: ".$arAddedMarketItem["error_code"]." - ".$arAddedMarketItem["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP" ) ) );
                                        $this->log->IncProductError();
                                    }
                                    else{
                                        $okMarketItemId = $arAddedMarketItem["product_id"];
                                    }

                                    $this->profile["OK"]["OK_RELATIONS"]["MARKET_ITEMS"][$arData["ID"]][] = $okMarketItemId;
                                }
                            }
                        }
                    }
                }
            }
        }

        $this->dbProfile->Update( $this->profile["ID"], $this->profile );
    }

    public function ClearSyncData(){
        self::DeleteSyncAlbums();
        self::DeleteSyncMediatopics();
        self::DeleteSyncCatalogs();
        self::DeleteSyncMarketItems();
        self::ResetSyncSettings();
    }

    public function DeleteSyncMediatopics(){
        $arProcessedMediatopics = array();
        foreach( $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"] as $mediatopicId => $mediatopicOkId ){
            if( intval( $mediatopicOkId ) > 0 ){
                $arDeleteResponse = $this->obOkModel->DeleteMediaTopicById( $mediatopicOkId );

                if( $arDeleteResponse["success"] == 1 ){
                    $arProcessedMediatopics[] = $mediatopicOkId;
                }
                else{
                    break;
                }
            }
            else{
                unset( $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"][$mediatopicId] );
            }
        }

        $arUnprocessedMediatopics = array_diff( $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"], $arProcessedMediatopics );
        if( empty( $arUnprocessedMediatopics ) ){
            $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"] = null;
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"] = $arUnprocessedMediatopics;
        }

        $this->dbProfile->Update( $this->profile["ID"], $this->profile );

        if( !empty( $arUnprocessedMediatopics ) ){
            self::DeleteSyncMediatopics();
        }
    }

    public function DeleteAllMediatopics(){
        $bDeleteAllMediatopicsFinish = false;
        $arOkAllMediatopicResponse = $this->obOkModel->GetTopics();

        if( count( $arOkAllMediatopicResponse ) > 0 ){
            foreach( $arOkAllMediatopicResponse as $mediatopicId ){
                $this->obOkModel->DeleteMediaTopic( $mediatopicId );
            }
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["MEDIATOPIC_ITEMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllMediatopicsFinish = true;
        }

        if( !$bDeleteAllMediatopicsFinish ){
            self::DeleteAllMediatopics();
        }
    }

    public function DeleteSyncMarketItems(){
        $arProcessedMarketItems = array();

        $arMarketItems = array();
        foreach( $this->profile["OK"]["OK_RELATIONS"]["MARKET_ITEMS"] as $marketItemId => $arMarketItem ){
            foreach( $arMarketItem as $arMarketItemId )
            $arMarketItems[] = $arMarketItemId;
        }

        $arMarketItems = array_unique( $arMarketItems );

        $arOkMarketItemResponse = $this->obOkModel->GetMarketItems();
        if( count( $arOkMarketItemResponse ) > 0 ){
            foreach( $arOkMarketItemResponse as $marketItemId ){
                if( ( intval( $marketItemId ) > 0 ) && in_array( $marketItemId, $arMarketItems ) ){
                    $this->obOkModel->DeleteMarketItem( $marketItemId );
                }
            }
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["MARKET_ITEMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllMarketItemsFinish = true;
        }

        if( !$bDeleteAllMarketItemsFinish ){
            self::DeleteAllMarketItems();
        }
    }

    public function DeleteAllMarketItems(){
        $bDeleteAllMarketItemsFinish = false;
        $arOkAllMarketItemResponse = $this->obOkModel->GetMarketItems();

        if( count( $arOkAllMarketItemResponse ) > 0 ){
            foreach( $arOkAllMarketItemResponse as $marketItemId ){
                $this->obOkModel->DeleteMarketItem( $marketItemId );
            }
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["MARKET_ITEMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllMarketItemsFinish = true;
        }

        if( !$bDeleteAllMarketItemsFinish ){
            self::DeleteAllMarketItems();
        }
    }

    public function DeleteSyncAlbums(){
        $arProcessedPhotoAlbums = array();
        foreach( $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"] as $albumId => $albumOkId ){
            if( intval( $albumOkId ) > 0 ){
                $arDeleteResponse = $this->obOkModel->DeleteAlbum( array( "ID" => $albumOkId ) );
                if( $arDeleteResponse == 1 ){
                    $arProcessedPhotoAlbums[] = $albumOkId;
                }
                else{
                    break;
                }
            }
            else{
                unset( $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"][$albumId] );
            }
        }

        $arUnprocessedPhotoAlbums = array_diff( $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"], $arProcessedPhotoAlbums );

        if( empty( $arUnprocessedPhotoAlbums ) ){
            $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"] = null;
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"] = $arUnprocessedPhotoAlbums;
        }

        $this->dbProfile->Update( $this->profile["ID"], $this->profile );

        if( !empty( $arUnprocessedPhotoAlbums ) ){
            self::DeleteSyncAlbums();
        }
    }

    public function DeleteAllAlbums(){
        $bDeleteAllAlbumsFinish = false;
        $arOkAllAlbumsResponse = $this->obOkModel->GetAlbums();

        if( is_array( $arOkAllAlbumsResponse ) && !empty( $arOkAllAlbumsResponse ) ){
            foreach( $arOkAllAlbumsResponse as $albumId ){
                $this->obOkModel->DeleteAlbum( array( "ID" => $albumId ) );
            }
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["PHOTO_ALBUMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllAlbumsFinish = true;
        }

        if( !$bDeleteAllAlbumsFinish ){
            self::DeleteAllAlbums();
        }
    }

    public function DeleteSyncCatalogs(){
        $arProcessedPhotoCatalogs = array();

        foreach( $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"] as $catalogId => $catalogOkId ){
            if( intval( $catalogOkId ) > 0 ){
                $arDeleteResponse = $this->obOkModel->DeleteMarketCatalog( $catalogOkId, true );
                if( $arDeleteResponse["success"] == 1 ){
                    $arProcessedPhotoCatalogs[] = $catalogOkId;
                }
                else{
                    break;
                }
            }
            else{
                unset( $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"][$catalogId] );
            }
        }

        $arUnprocessedPhotoCatalogs = array_diff( $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"], $arProcessedPhotoCatalogs );

        if( empty( $arUnprocessedPhotoCatalogs ) ){
            $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"] = null;
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"] = $arUnprocessedPhotoCatalogs;
        }

        $this->dbProfile->Update( $this->profile["ID"], $this->profile );

        if( !empty( $arUnprocessedPhotoCatalogs ) ){
            self::DeleteSyncCatalogs();
        }
    }

    public function DeleteAllCatalogs(){
        $bDeleteAllCatalogsFinish = false;
        $arOkAllCatalogsResponse = $this->obOkModel->GetMarketCatalogsByGroup();

        if( is_array( $arOkAllCatalogsResponse ) && !empty( $arOkAllCatalogsResponse ) ){
            foreach( $arOkAllCatalogsResponse as $catalogId ){
                $this->obOkModel->DeleteMarketCatalog( $catalogId, true );
            }
        }
        else{
            $this->profile["OK"]["OK_RELATIONS"]["MARKET_CATALOGS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllCatalogsFinish = true;
        }

        if( !$bDeleteAllCatalogsFinish ){
            self::DeleteAllCatalogs();
        }
    }

    public function ResetSyncSettings(){
        $this->profile["OK"]["OK_RELATIONS"] = null;
        $this->dbProfile->Update( $this->profile["ID"], $this->profile );
    }
}