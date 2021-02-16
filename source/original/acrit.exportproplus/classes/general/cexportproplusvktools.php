<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\Loader::includeModule( "acrit.exportproplus" );

Loc::loadMessages( __FILE__ );

class CAcritExportproplusVkTools{
    public $profile = null;
    public $log = null;
    public $vkAccount = null;
    public $obVkModel = null;
    public $dbProfile = null;

    public function __construct( $profile ){
        $this->dbProfile = new CExportproplusProfileDB();
        $this->profile = $profile;
        $this->log = new CAcritExportproplusLog( $this->profile["ID"] );
        $this->obVkModel = new CAcritExportproplusVkModel( $this->profile );
        $this->vkAccount = $this->obVkModel->GetAccessAccountData();
    }

    public function GetTypes(){
        $arCategories = $this->obVkModel->GetMarketCategories();
        
        $arProcessCategories = array();
        if( is_array( $arCategories["response"]["items"] ) && !empty( $arCategories["response"]["items"] ) ){
            foreach( $arCategories["response"]["items"] as $categoriesItemIndex => $arCategoriesItem ){
                $arProcessCategories[$arCategoriesItem["id"]] = $arCategoriesItem["section"]["name"]."/".$arCategoriesItem["name"];
            }
        }
        
        return $arProcessCategories;
    }

    public function GetMarketAlbumId( $categoryId, $bCheckOther = true ){
        $arProductRelations = $this->profile["VK"]["VK_RELATIONS"];

        $vkMarketAlbumId = false;
        if( isset( $arProductRelations["MARKET_ALBUMS"][$categoryId] )
            && ( intval( $arProductRelations["MARKET_ALBUMS"][$categoryId] ) > 0 )
        ){
            $vkMarketAlbumId = $arProductRelations["MARKET_ALBUMS"][$categoryId];
        }
        elseif( $bCheckOther ){
            $categoryName = $this->profile["VK"]["VK_MARKET_ALBUMS"][$categoryId];
            $arProcessCatIds = array_keys( $this->profile["VK"]["VK_MARKET_ALBUMS"], $categoryName );

            foreach( $arProcessCatIds as $procCategoryId ){
                if( isset( $arProductRelations["MARKET_ALBUMS"][$procCategoryId] )
                    && ( intval( $arProductRelations["MARKET_ALBUMS"][$procCategoryId] ) > 0 )
                ){
                    $vkMarketAlbumId = $arProductRelations["MARKET_ALBUMS"][$procCategoryId];
                    break;
                }
            }
        }

        return $vkMarketAlbumId;
    }

    public function GetPhotoAlbumId( $categoryId, $bCheckOther = true  ){
        $arProductRelations = $this->profile["VK"]["VK_RELATIONS"];

        $vkPhotoAlbumId = false;
        if( isset( $arProductRelations["PHOTO_ALBUMS"][$categoryId] )
            && ( intval( $arProductRelations["PHOTO_ALBUMS"][$categoryId] ) > 0 )
        ){
            $vkPhotoAlbumId = $arProductRelations["PHOTO_ALBUMS"][$categoryId];
        }
        elseif( $bCheckOther ){
            $categoryName = $this->profile["VK"]["VK_ALBUMS"][$categoryId];
            $arProcessCatIds = array_keys( $this->profile["VK"]["VK_ALBUMS"], $categoryName );

            foreach( $arProcessCatIds as $procCategoryId ){
                if( isset( $arProductRelations["PHOTO_ALBUMS"][$procCategoryId] )
                    && ( intval( $arProductRelations["PHOTO_ALBUMS"][$procCategoryId] ) > 0 )
                ){
                    $vkPhotoAlbumId = $arProductRelations["PHOTO_ALBUMS"][$procCategoryId];
                    break;
                }
            }
        }

        return $vkPhotoAlbumId;
    }

    public function CheckPhotoInAlbum( $albumId, $dataId ){
        $bHasPhotoInAlbum = false;

        $arResponsePhotos = $this->obVkModel->GetGroupPhotos( array( "ALBUM_ID" => $albumId ) );
        if( !empty( $arResponsePhotos["response"]["items"] ) ){
            $arRelations = $this->profile["VK"]["VK_RELATIONS"];

            $arAlbumPhotos = array();
            foreach( $arResponsePhotos["response"]["items"] as $arPhoto ){
                $arAlbumPhotos[] = $arPhoto["id"];
            }

            if( !empty( $arAlbumPhotos ) ){
                if( is_array( $arRelations["PHOTO_ITEMS"][$dataId] )
                    && !empty( $arRelations["PHOTO_ITEMS"][$dataId] )
                ){
                    $arIntersertPhotos = array_intersect( $arRelations["PHOTO_ITEMS"][$dataId], $arAlbumPhotos );

                    if( is_array( $arIntersertPhotos ) && !empty( $arIntersertPhotos ) ){
                        $bHasPhotoInAlbum = true;
                    }
                }
            }
        }

        return $bHasPhotoInAlbum;
    }

    public function SaveMarketItem( $arData ){
        $arProductRelations = $this->profile["VK"]["VK_RELATIONS"];

        $vkMarketItemId = false;
        $arPhotoIds = false;
        $vkWallPostId = false;

        if( $this->profile["VK"]["VK_RELATIONS"] != null ){
            $vkMarketItemId = isset( $arProductRelations["MARKET_ITEMS"][$arData["ID"]] ) ? $arProductRelations["MARKET_ITEMS"][$arData["ID"]] : false;
            $arPhotoIds = isset( $arProductRelations["PHOTO_ITEMS"][$arData["ID"]] ) ? $arProductRelations["PHOTO_ITEMS"][$arData["ID"]] : false;
            $vkWallPostId = isset( $arProductRelations["WALL_ITEMS"][$arData["ID"]] ) ? $arProductRelations["WALL_ITEMS"][$arData["ID"]] : false;
        }

        if( $vkMarketItemId ){
            if( intval( $this->vkAccount["GROUP_PUBLISH"] ) > 0 ){
                $arUpdateMarketItemData = $arData;
                $arUpdateMarketItemData["ID"] = $vkMarketItemId;
                $bUpdatedMarketItem = $this->obVkModel->AddMarketItem( $arUpdateMarketItemData, true );

                $this->profile["VK"]["VK_NEW_RELATIONS"]["MARKET_ITEMS"][$arData["ID"]] = $vkMarketItemId;

                if( is_array( $bUpdatedMarketItem["error"] ) && !empty( $bUpdatedMarketItem["error"] ) ){
                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$bUpdatedMarketItem["error"]["error_code"]." - ".$bUpdatedMarketItem["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                    $this->log->IncProductError();
                }
                else{
                    foreach( $arData["VK"]["VK_MARKET_ALBUMS"] as $procVkMarketAlbumLocalId => $procVkMarketAlbum ){
                        $vkMarketAlbumId = self::GetMarketAlbumId( $procVkMarketAlbumLocalId );

                        if( !$vkMarketAlbumId ){
                            $arAddMarketAlbumData = array(
                                "PICTURE" => ( $procVkMarketAlbum["PICTURE"] ? $procVkMarketAlbum["PICTURE"] : ( $procVkMarketAlbum["DETAIL_PICTURE"] ? $procVkMarketAlbum["DETAIL_PICTURE"] : $arData["PHOTO"] ) ),
                                "NAME" => $procVkMarketAlbum["NAME"]
                            );

                            $arAddMarketAlbumResponse = $this->obVkModel->AddMarketAlbum( $arAddMarketAlbumData );

                            if( is_array( $arAddMarketAlbumResponse["error"] ) && !empty( $arAddMarketAlbumResponse["error"] ) ){
                                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arAddMarketAlbumResponse["error"]["error_code"]." - ".$arAddMarketAlbumResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                $this->log->IncProductError();
                            }
                            else{
                                $vkMarketAlbumId = $arAddMarketAlbumResponse["response"]["market_album_id"];
                                $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"][$procVkMarketAlbumLocalId] = $vkMarketAlbumId;

                                $arAddMarketItemToAlbumsData = array(
                                    "ID" => $vkMarketItemId,
                                    "ALBUMS" => $vkMarketAlbumId
                                );

                                $bAddMarketItemToAlbums = $this->obVkModel->AddMarketItemToAlbums( $arAddMarketItemToAlbumsData );

                                if( is_array( $bAddMarketItemToAlbums["error"] ) && !empty( $bAddMarketItemToAlbums["error"] ) ){
                                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$bAddMarketItemToAlbums["error"]["error_code"]." - ".$bAddMarketItemToAlbums["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                    $this->log->IncProductError();
                                }
                            }
                        }
                        else{
                            $arUpdateMarketAlbumData = array(
                                "ID" => $vkMarketAlbumId,
                                "PICTURE" => ( $procVkMarketAlbum["PICTURE"] ? $procVkMarketAlbum["PICTURE"] : ( $procVkMarketAlbum["DETAIL_PICTURE"] ? $procVkMarketAlbum["DETAIL_PICTURE"] : $arData["PHOTO"] ) ),
                                "NAME" => $procVkMarketAlbum["NAME"],
                            );

                            $bUpdatedMarketAlbumItem = $this->obVkModel->AddMarketAlbum( $arUpdateMarketAlbumData, false, true );

                            if( is_array( $bUpdatedMarketAlbumItem["error"] ) && !empty( $bUpdatedMarketAlbumItem["error"] ) ){
                                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE 777: ".$bUpdatedMarketAlbumItem["error"]["error_code"]." - ".$bUpdatedMarketAlbumItem["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                $this->log->IncProductError();
                            }
                        }

                    }

                    foreach( $arPhotoIds as $vkPhotoId ){
                        $arUpdateGroupPhotoData = array(
                            "ID" => $vkPhotoId,
                            "DESCRIPTION" => $arData["DESCRIPTION"],
                            "URL" => $arData["URL"],
                            "URL_LABEL" => $arData["URL_LABEL"],
                        );
                        $bUpdatedGroupPhoto = $this->obVkModel->EditGroupPhoto( $arUpdateGroupPhotoData );

                        if( is_array( $bUpdatedGroupPhoto["error"] ) && !empty( $bUpdatedGroupPhoto["error"] ) ){
                            $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$bUpdatedGroupPhoto["error"]["error_code"]." - ".$bUpdatedGroupPhoto["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                            $this->log->IncProductError();
                        }
                    }

                    foreach( $arData["VK"]["VK_ALBUMS"] as $vkMultiAlbumItemIndex => $vkMultiAlbumItem ){
                        $vkPhotoAlbumId = self::GetPhotoAlbumId( $vkMultiAlbumItemIndex );

                        if( !$vkPhotoAlbumId ){
                            $arCreateGroupAlbumData = array(
                                "TITLE" => $vkMultiAlbumItem["NAME"],
                                "DESCRIPTION" => ""
                            );

                            $arCreatedGroupAlbum = $this->obVkModel->CreateGroupAlbum( $arCreateGroupAlbumData );

                            if( is_array( $arCreatedGroupAlbum["error"] ) && !empty( $arCreatedGroupAlbum["error"] ) ){
                                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arCreatedGroupAlbum["error"]["error_code"]." - ".$arCreatedGroupAlbum["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                $this->log->IncProductError();
                            }
                            else{
                                $vkPhotoAlbumId = $arCreatedGroupAlbum["response"]["id"];
                                $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"][$vkMultiAlbumItemIndex] = $vkPhotoAlbumId;

                                $bHasPhotoItem = self::CheckPhotoInAlbum( $vkPhotoAlbumId, $arData["ID"] );
                                if( !$bHasPhotoItem ){
                                    $arAddGroupPhotoData = array(
                                        "FILES" => $arVkPhotoAlbumFiles,
                                        "ALBUM_ID" => $vkPhotoAlbumId,
                                        "URL_LABEL" => $arData["URL_LABEL"],
                                    );

                                    $arAddedGroupPhoto = $this->obVkModel->AddGroupPhoto( $arAddGroupPhotoData );

                                    if( is_array( $arAddedGroupPhoto["error"] ) && !empty( $arAddedGroupPhoto["error"] ) ){
                                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arAddedGroupPhoto["error"]["error_code"]." - ".$arAddedGroupPhoto["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                        $this->log->IncProductError();
                                    }
                                    else{
                                        $vkPhotoId = $arAddedGroupPhoto[0]["response"][0]["id"];
                                        $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"][$arData["ID"]][] = $vkPhotoId;
                                    }
                                }
                            }
                        }
                        else{
                            $arUpdateGroupAlbumData = array(
                                "ID" => $vkPhotoAlbumId,
                                "TITLE" => $vkMultiAlbumItem["NAME"],
                                "DESCRIPTION" => ""
                            );
                            $bUpdatedGroupAlbum = $this->obVkModel->CreateGroupAlbum( $arUpdateGroupAlbumData, true );

                            if( is_array( $bUpdatedGroupAlbum["error"] ) && !empty( $bUpdatedGroupAlbum["error"] ) ){
                                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$bUpdatedGroupAlbum["error"]["error_code"]." - ".$bUpdatedGroupAlbum["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                $this->log->IncProductError();
                            }
                        }
                    }
                }
            }
        }
        else{
            if( intval( $this->vkAccount["GROUP_PUBLISH"] ) > 0 ){
                if( $this->profile["VK"]["VK_RELATIONS"] == null ){
                    $this->profile["VK"]["VK_RELATIONS"] = array();
                    $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"] = array();
                    $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"] = array();
                    $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"] = array();
                    $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"] = array();
                    $this->profile["VK"]["VK_RELATIONS"]["WALL_ITEMS"] = array();

                    $this->profile["VK"]["VK_NEW_RELATIONS"] = array();
                    $this->profile["VK"]["VK_NEW_RELATIONS"]["MARKET_ITEMS"] = array();
                }

                $arAddMarketItemResponse = $this->obVkModel->AddMarketItem( $arData );
                
                if( is_array( $arAddMarketItemResponse["error"] ) && !empty( $arAddMarketItemResponse["error"] ) ){
                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arAddMarketItemResponse["error"]["error_code"]." - ".$arAddMarketItemResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                    $this->log->IncProductError();
                }
                else{
                    $vkMarketItemId = $arAddMarketItemResponse["response"]["market_item_id"];

                    if( $vkMarketItemId ){
                        $this->log->IncProductExport();
                        $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"][$arData["ID"]] = $vkMarketItemId;
                        $this->profile["VK"]["VK_NEW_RELATIONS"]["MARKET_ITEMS"][$arData["ID"]] = $vkMarketItemId;

                        foreach( $arData["VK"]["VK_MARKET_ALBUMS"] as $procVkMarketAlbumLocalId => $procVkMarketAlbum ){
                            $vkMarketAlbumId = self::GetMarketAlbumId( $procVkMarketAlbumLocalId );

                            if( !$vkMarketAlbumId ){
                                $arAddMarketAlbumData = array(
                                    "PICTURE" => ( $procVkMarketAlbum["PICTURE"] ? $procVkMarketAlbum["PICTURE"] : ( $procVkMarketAlbum["DETAIL_PICTURE"] ? $procVkMarketAlbum["DETAIL_PICTURE"] : $arData["PHOTO"] ) ),
                                    "NAME" => $procVkMarketAlbum["NAME"]
                                );

                                $arAddMarketAlbumResponse = $this->obVkModel->AddMarketAlbum( $arAddMarketAlbumData );

                                if( is_array( $arAddMarketAlbumResponse["error"] ) && !empty( $arAddMarketAlbumResponse["error"] ) ){
                                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arAddMarketAlbumResponse["error"]["error_code"]." - ".$arAddMarketAlbumResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                    $this->log->IncProductError();
                                }
                                else{
                                    $vkMarketAlbumId = $arAddMarketAlbumResponse["response"]["market_album_id"];
                                    $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"][$procVkMarketAlbumLocalId] = $vkMarketAlbumId;

                                    $arAddMarketItemToAlbumsData = array(
                                        "ID" => $vkMarketItemId,
                                        "ALBUMS" => $vkMarketAlbumId
                                    );

                                    $bAddMarketItemToAlbums = $this->obVkModel->AddMarketItemToAlbums( $arAddMarketItemToAlbumsData );

                                    if( is_array( $bAddMarketItemToAlbums["error"] ) && !empty( $bAddMarketItemToAlbums["error"] ) ){
                                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$bAddMarketItemToAlbums["error"]["error_code"]." - ".$bAddMarketItemToAlbums["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                        $this->log->IncProductError();
                                    }
                                }
                            }
                            else{
                                $arAddMarketItemToAlbumsData = array(
                                    "ID" => $vkMarketItemId,
                                    "ALBUMS" => $vkMarketAlbumId
                                );

                                $bAddMarketItemToAlbums = $this->obVkModel->AddMarketItemToAlbums( $arAddMarketItemToAlbumsData );

                                if( is_array( $bAddMarketItemToAlbums["error"] ) && !empty( $bAddMarketItemToAlbums["error"] ) ){
                                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$bAddMarketItemToAlbums["error"]["error_code"]." - ".$bAddMarketItemToAlbums["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                    $this->log->IncProductError();
                                }
                            }
                        }

                        $arVkPhotoAlbumFiles = array();
                        $arVkPhotoAlbumFiles[] = array(
                            "PHOTO" => $arData["PHOTO"],
                            "DESCRIPTION" => $arData["DESCRIPTION"],
                            "URL" => $arData["URL"],
                        );

                        if( is_array( $arData["VK"]["VK_ALBUMS"] ) && !empty( $arData["VK"]["VK_ALBUMS"] ) ){
                            foreach( $arData["VK"]["VK_ALBUMS"] as $vkMultiAlbumItemIndex => $vkMultiAlbumItem ){
                                $vkPhotoAlbumId = self::GetPhotoAlbumId( $vkMultiAlbumItemIndex );

                                if( !$vkPhotoAlbumId ){
                                    $arCreateGroupAlbumData = array(
                                        "TITLE" => $vkMultiAlbumItem["NAME"],
                                        "DESCRIPTION" => ""
                                    );

                                    $arCreatedGroupAlbum = $this->obVkModel->CreateGroupAlbum( $arCreateGroupAlbumData );

                                    if( is_array( $arCreatedGroupAlbum["error"] ) && !empty( $arCreatedGroupAlbum["error"] ) ){
                                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arCreatedGroupAlbum["error"]["error_code"]." - ".$arCreatedGroupAlbum["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                        $this->log->IncProductError();
                                    }
                                    else{
                                        $vkPhotoAlbumId = $arCreatedGroupAlbum["response"]["id"];
                                        $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"][$vkMultiAlbumItemIndex] = $vkPhotoAlbumId;

                                        $bHasPhotoItem = self::CheckPhotoInAlbum( $vkPhotoAlbumId, $arData["ID"] );
                                        if( !$bHasPhotoItem ){
                                            $arAddGroupPhotoData = array(
                                                "FILES" => $arVkPhotoAlbumFiles,
                                                "ALBUM_ID" => $vkPhotoAlbumId
                                            );

                                            $arAddedGroupPhoto = $this->obVkModel->AddGroupPhoto( $arAddGroupPhotoData );

                                            if( is_array( $arAddedGroupPhoto["error"] ) && !empty( $arAddedGroupPhoto["error"] ) ){
                                                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arAddedGroupPhoto["error"]["error_code"]." - ".$arAddedGroupPhoto["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                                $this->log->IncProductError();
                                            }
                                            else{
                                                $vkPhotoId = $arAddedGroupPhoto[0]["response"][0]["id"];
                                                $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"][$arData["ID"]][] = $vkPhotoId;
                                            }
                                        }
                                    }
                                }
                                else{
                                    $bHasPhotoItem = self::CheckPhotoInAlbum( $vkPhotoAlbumId, $arData["ID"] );
                                    if( !$bHasPhotoItem ){
                                        $arAddGroupPhotoData = array(
                                            "FILES" => $arVkPhotoAlbumFiles,
                                            "ALBUM_ID" => $vkPhotoAlbumId
                                        );

                                        $arAddedGroupPhoto = $this->obVkModel->AddGroupPhoto( $arAddGroupPhotoData );

                                        if( is_array( $arAddedGroupPhoto["error"] ) && !empty( $arAddedGroupPhoto["error"] ) ){
                                            $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arAddedGroupPhoto["error"]["error_code"]." - ".$arAddedGroupPhoto["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                                            $this->log->IncProductError();
                                        }
                                        else{
                                            $vkPhotoId = $arAddedGroupPhoto[0]["response"][0]["id"];
                                            $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"][$arData["ID"]][] = $vkPhotoId;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if( $vkWallPostId ){
            if( intval( $this->vkAccount["USER_PUBLISH"] ) > 0 ){
                $arUpdateWallItemData = $arData;
                $arUpdateWallItemData["DESCRIPTION"] = $arUpdateWallItemData["DESCRIPTION_PREFIX"].$arUpdateWallItemData["DESCRIPTION"];
                $arUpdateWallItemData["ID"] = $vkWallPostId;
                $bUpdatedWallItem = $this->obVkModel->AddWallItem( $arUpdateWallItemData, true );

                if( is_array( $bUpdatedWallItem["error"] ) && !empty( $bUpdatedWallItem["error"] ) ){
                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$bUpdatedWallItem["error"]["error_code"]." - ".$bUpdatedWallItem["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                    $this->log->IncProductError();
                }
            }
        }
        else{
            if( intval( $this->vkAccount["USER_PUBLISH"] ) > 0 ){
                $arAddWallItemData = $arData;
                $arAddWallItemData["DESCRIPTION"] = $arAddWallItemData["DESCRIPTION_PREFIX"].$arAddWallItemData["DESCRIPTION"];

                $arAddWallItemResponse = $this->obVkModel->AddWallItem( $arAddWallItemData );

                if( is_array( $arAddWallItemResponse["error"] ) && !empty( $arAddWallItemResponse["error"] ) ){
                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arAddWallItemResponse["error"]["error_code"]." - ".$arAddWallItemResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                    $this->log->IncProductError();
                }

                $vkWallItemId = $arAddWallItemResponse["response"]["post_id"];

                if( $vkWallItemId ){
                    $this->log->IncProductExport();
                    $this->profile["VK"]["VK_RELATIONS"]["WALL_ITEMS"][$arData["ID"]] = $vkWallItemId;
                }
            }
        }

        $this->dbProfile->Update( $this->profile["ID"], $this->profile );
    }

    public function SyncDataDiver(){
        foreach( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"] as $localMarketItemId => $vkMarketItemId ){
            if( !isset( $this->profile["VK"]["VK_NEW_RELATIONS"]["MARKET_ITEMS"][$localMarketItemId] ) ){
                foreach( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"][$localMarketItemId] as $vkPhotoIndex => $vkPhotoId ){
                    $arDeleteGroupPhotoResponse = $this->obVkModel->DeleteGroupPhoto( array( "ID" => $vkPhotoId ) );
                    if( is_array( $arDeleteGroupPhotoResponse["error"] ) && !empty( $arDeleteGroupPhotoResponse["error"] ) ){
                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arDeleteGroupPhotoResponse["error"]["error_code"]." - ".$arDeleteGroupPhotoResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                        $this->log->IncProductError();
                    }
                    else{
                        unset( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"][$localMarketItemId][$vkPhotoIndex] );
                    }
                }

                if( empty( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"][$localMarketItemId] ) ){
                    unset( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"][$localMarketItemId] );
                }

                $arDeleteResponse = $this->obVkModel->DeleteMarketItem( $vkMarketItemId );
                if( is_array( $arDeleteResponse["error"] ) && !empty( $arDeleteResponse["error"] ) ){
                    $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arDeleteResponse["error"]["error_code"]." - ".$arDeleteResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                    $this->log->IncProductError();
                }
                else{
                    unset( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"][$localMarketItemId] );
                }
            }
        }

        foreach( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"] as $localPhotoAlbumId => $vkPhotoAlbumId ){
            $arGetGroupPhotosResponse = $this->obVkModel->GetGroupPhotos( array( "ALBUM_ID" => $vkPhotoAlbumId ) );
            if( is_array( $arGetGroupPhotosResponse["error"] ) && !empty( $arGetGroupPhotosResponse["error"] ) ){
                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arGetGroupPhotosResponse["error"]["error_code"]." - ".$arGetGroupPhotosResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                $this->log->IncProductError();
            }
            else{
                if( empty( $arGetGroupPhotosResponse["response"]["items"] ) ){
                    $arDeleteGroupAlbumResponse = $this->obVkModel->DeleteGroupAlbum( array( "ID" => $vkPhotoAlbumId ) );
                    if( is_array( $arDeleteGroupAlbumResponse["error"] ) && !empty( $arDeleteGroupAlbumResponse["error"] ) ){
                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arDeleteGroupAlbumResponse["error"]["error_code"]." - ".$arDeleteGroupAlbumResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                        $this->log->IncProductError();
                    }
                    else{
                        unset( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"][$localPhotoAlbumId] );
                    }
                }
            }
        }

        foreach( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"] as $localMarketAlbumId => $vkMarketAlbumId ){
            $arGetMarketItemsResponse = $this->obVkModel->GetMarketItems( array( "ALBUM_ID" => $vkMarketAlbumId ) );
            if( is_array( $arGetMarketItemsResponse["error"] ) && !empty( $arGetMarketItemsResponse["error"] ) ){
                $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arGetMarketItemsResponse["error"]["error_code"]." - ".$arGetMarketItemsResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                $this->log->IncProductError();
            }
            else{
                if( intval( $arGetMarketItemsResponse["response"]["count"] ) <= 0 ){
                    $arDeleteMarketAlbumResponse = $this->obVkModel->DeleteMarketAlbum( $vkMarketAlbumId );
                    if( is_array( $arDeleteMarketAlbumResponse["error"] ) && !empty( $arDeleteMarketAlbumResponse["error"] ) ){
                        $this->log->AddMessage( "{$arData["NAME"]} (ID:{$arData["ID"]}) : ".str_replace( "#VK_ERROR#", "CODE: ".$arDeleteMarketAlbumResponse["error"]["error_code"]." - ".$arDeleteMarketAlbumResponse["error"]["error_msg"], GetMessage( "ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_VK_SKIP" ) ) );
                        $this->log->IncProductError();
                    }
                    else{
                        unset( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"][$localMarketAlbumId] );
                    }
                }
            }
        }

        unset( $this->profile["VK"]["VK_NEW_RELATIONS"] );
        return $this->profile;
    }

    public function ClearSyncData(){
        self::DeleteSyncAlbums();
        self::DeleteSyncProductAlbums();
        self::DeleteSyncProducts();
        self::ResetSyncSettings();
    }

    public function DeleteSyncProducts(){
        $arVkAllProductResponse = $this->obVkModel->GetMarketItems();
        if( intval( $arVkAllProductResponse["response"]["count"] ) > 0 ){
            $arVkProducs = array();
            foreach( $arVkAllProductResponse["response"]["items"] as $iProductIndex => $arVkProduct ){
                $arVkProducs[] = $arVkProduct["id"];
            }

            $arProcessedProducs = array();
            foreach( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"] as $productId => $productVkId ){
                if( ( intval( $productVkId ) > 0 ) && in_array( $productVkId, $arVkProducs ) ){
                    $arDeleteResponse = $this->obVkModel->DeleteMarketItem( $productVkId );

                    if( $arDeleteResponse["response"] == 1 ){
                        $arProcessedProducs[] = $productVkId;
                    }
                    else{
                        break;
                    }
                }
                else{
                    unset( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"][$productId] );
                }
            }

            $arUnprocessedProducts = array_diff( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"], $arProcessedProducs );
            if( empty( $arUnprocessedProducts ) ){
                $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"] = null;
            }
            else{
                $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"] = $arUnprocessedProducts;
            }

            $this->dbProfile->Update( $this->profile["ID"], $this->profile );

            if( !empty( $arUnprocessedProducts ) ){
                self::DeleteSyncProducts();
            }
        }
        else{
            $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllProductsFinish = true;
        }
    }

    public function DeleteAllProducts(){
        $bDeleteAllProductsFinish = false;
        $arVkAllProductResponse = $this->obVkModel->GetMarketItems();
        
        if( intval( $arVkAllProductResponse["response"]["count"] ) > 0 ){
            foreach( $arVkAllProductResponse["response"]["items"] as $iProductIndex => $arVkProduct ){
                $this->obVkModel->DeleteMarketItem( $arVkProduct["id"] );
            }
        }
        else{
            $this->profile["VK"]["VK_RELATIONS"]["MARKET_ITEMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllProductsFinish = true;
        }

        if( !$bDeleteAllProductsFinish ){
            self::DeleteAllProducts();
        }
    }

    public function DeleteSyncProductAlbums(){
        $arVkAllProductAlbumsResponse = $this->obVkModel->GetMarketAlbums();
        if( intval( $arVkAllProductAlbumsResponse["response"]["count"] ) > 0 ){
            $arVkProductAlbums = array();
            foreach( $arVkAllProductAlbumsResponse["response"]["items"] as $iProductAlbumIndex => $arVkProductAlbum ){
                $arVkProductAlbums[] = $arVkProductAlbum["id"];
            }

            $arProcessedProductAlbums = array();
            foreach( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"] as $productAlbumId => $productAlbumVkId ){
                if( ( intval( $productAlbumVkId ) > 0 ) && in_array( $productAlbumVkId, $arVkProductAlbums ) ){
                    $arDeleteResponse = $this->obVkModel->DeleteMarketAlbum( $productAlbumVkId );
                    if( $arDeleteResponse["response"] == 1 ){
                        $arProcessedProductAlbums[] = $productAlbumVkId;
                    }
                    else{
                        break;
                    }
                }
                else{
                    unset( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"][$productAlbumId] );
                }
            }

            $arUnprocessedProductAlbums = array_diff( $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"], $arProcessedProductAlbums );
            if( empty( $arUnprocessedProductAlbums ) ){
                $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"] = null;
            }
            else{
                $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"] = $arUnprocessedProductAlbums;
            }

            $this->dbProfile->Update( $this->profile["ID"], $this->profile );

            if( !empty( $arUnprocessedProductAlbums ) ){
                self::DeleteSyncProductAlbums();
            }
        }
        else{
            $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllProductAlbumsFinish = true;
        }
    }

    public function DeleteAllProductAlbums(){
        $bDeleteAllProductAlbumsFinish = false;
        $arVkAllProductAlbumsResponse = $this->obVkModel->GetMarketAlbums();
        
        CAcritExportproplusLog::AcritDump( $arVkAllProductAlbumsResponse );
        if( intval( $arVkAllProductAlbumsResponse["response"]["count"] ) > 0 ){
            foreach( $arVkAllProductAlbumsResponse["response"]["items"] as $iProductAlbumIndex => $arVkProductAlbum ){
                $this->obVkModel->DeleteMarketAlbum( $arVkProductAlbum["id"] );
            }
        }
        else{
            $this->profile["VK"]["VK_RELATIONS"]["MARKET_ALBUMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllProductAlbumsFinish = true;
        }
        
        if( !$bDeleteAllProductAlbumsFinish ){
            self::DeleteAllProductAlbums();
        }
    }

    public function DeleteSyncAlbums(){
        $arVkAllAlbumsResponse = $this->obVkModel->GetGroupAlbums();
        
        if( is_array( $arVkAllAlbumsResponse["response"]["items"] ) && !empty( $arVkAllAlbumsResponse["response"]["items"] ) && ( intval( $arVkAllAlbumsResponse["response"]["count"] ) > 0 ) ){
            $arVkAlbums = array();
            foreach( $arVkAllAlbumsResponse["response"]["items"] as $iAlbumIndex => $arVkAlbum ){
                $arVkAlbums[] = $arVkAlbum["id"];
            }
            
            $arProcessedPhotoAlbums = array();
            foreach( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"] as $albumId => $albumVkId ){
                if( ( intval( $albumVkId ) > 0 ) && in_array( $albumVkId, $arVkAlbums ) ){
                    $arDeleteResponse = $this->obVkModel->DeleteGroupAlbum( array( "ID" => $albumVkId ) );
                    if( $arDeleteResponse["response"] == 1 ){
                        $arProcessedPhotoAlbums[] = $albumVkId;
                    }
                    else{
                        break;
                    }
                }
                else{
                    unset( $this->profile["VK"]["VK_RELATIONS"] );
                }

            }

            $arUnprocessedPhotoAlbums = array_diff( $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"], $arProcessedPhotoAlbums );
            if( empty( $arUnprocessedPhotoAlbums ) ){
                $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"] = null;
                $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"] = null;
            }
            else{
                $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"] = $arUnprocessedPhotoAlbums;
            }

            $this->dbProfile->Update( $this->profile["ID"], $this->profile );

            if( !empty( $arUnprocessedPhotoAlbums ) ){
                self::DeleteSyncAlbums();
            }
        }
        else{
            $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"] = null;
            $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllAlbumsFinish = true;
        }
    }

    public function DeleteAllAlbums(){
        $bDeleteAllAlbumsFinish = false;                                                                                           
        $arVkAllAlbumsResponse = $this->obVkModel->GetGroupAlbums();
        
        if( is_array( $arVkAllAlbumsResponse["response"]["items"] ) && !empty( $arVkAllAlbumsResponse["response"]["items"] ) && ( intval( $arVkAllAlbumsResponse["response"]["count"] ) > 1 ) ){
            foreach( $arVkAllAlbumsResponse["response"]["items"] as $iAlbumIndex => $arVkAlbum ){
                $this->obVkModel->DeleteGroupAlbum( array( "ID" => $arVkAlbum["id"] ) );
            }
        }
        else{
            $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ALBUMS"] = null;
            $this->profile["VK"]["VK_RELATIONS"]["PHOTO_ITEMS"] = null;
            $this->dbProfile->Update( $this->profile["ID"], $this->profile );
            $bDeleteAllAlbumsFinish = true;
        }

        if( !$bDeleteAllAlbumsFinish ){
            self::DeleteAllAlbums();
        }
    }

    public function ResetSyncSettings(){
        $this->profile["VK"]["VK_NEW_RELATIONS"] = null;
        $this->profile["VK"]["VK_RELATIONS"] = null;
        $this->dbProfile->Update( $this->profile["ID"], $this->profile );
    }
}