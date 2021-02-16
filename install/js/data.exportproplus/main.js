$( function(){
    var ret = {};

    $( 'select[name="PROFILE[LID]"]' ).change( function(){
        getData( 'change_site' );
    });

    $( 'input[name="PROFILE[USE_REMARKETING]"]' ).click( function(){
        if( $( this ).attr( 'checked' ) != 'checked' ){
            $( 'input[name="PROFILE[USE_REMARKETING]"]' ).attr( 'checked', false );
        }
    });

    $( 'input[name="PROFILE[VIEW_CATALOG]"]' ).click( function(){
        getData( 'catalog_only' );
    });

    $( 'input[name="PROFILE[CHECK_INCLUDE]"]' ).click( function(){
        getData( 'include_subsection' );
    });

    $( document ).on( 'change', 'select[name="PROFILE[IBLOCK_TYPE_ID][]"]', function(){
        getData( 'change_ibtype' );
    });

    $( document ).on( 'change', 'select[name="PROFILE[IBLOCK_ID][]"]', function(){
        getData( 'change_iblock' );
    });

    $( document ).on( 'change', 'select[name="PROFILE[TYPE]"]', function(){
        getData( 'change_type' );

        $( '#tab_cont_step6' ).show();
        $( '#tab_cont_step10' ).hide();
        $( '#tab_cont_step13' ).hide();
        $( '#tab_cont_step16' ).hide();
        $( '#tab_cont_step17' ).hide();
        $( '#tab_cont_step18' ).hide();
        $( '#tab_cont_step12' ).hide();
        $( '#tab_cont_step21' ).hide();
        $( '#tab_cont_step22' ).hide();
        $( '#tab_cont_step23' ).hide();
        $( '#tab_cont_step24' ).hide();
        $( '#tab_cont_step25' ).hide();
        $( '#tab_cont_step26' ).hide();
        $( '#tab_cont_step27' ).hide();
        $( '#tab_cont_step28' ).hide();
        $( '#tab_cont_step29' ).hide();
        $( '#tab_cont_step30' ).hide();
        $( '#tab_cont_step31' ).hide();
        $( '#export_step_value' ).val( 50 );
        $( '.file-field' ).removeClass( 'hide' );
        switch( $( this ).val() ){
            case 'activizm':
                $( '#tab_cont_step10' ).show();
                $( '#tab_cont_step6' ).hide();
                break;
            case 'ebay_1':
            case 'ebay_2':
                $( '#tab_cont_step12' ).show();
                $( '#tab_cont_step6' ).hide();
                break;
            case 'ozon':
            case 'ozon_api':
                $( '#tab_cont_step16' ).show();
                $( '#tab_cont_step13' ).show();
                $( '#tab_cont_step6' ).hide();
                break;
            case 'ua_hotline_ua':
                $( '#tab_cont_step17' ).show();
                break;
            case 'google':
            case 'google_online':
                $( '#tab_cont_step18' ).show();
                break;
            case 'tiu_standart':
            case 'tiu_standart_vendormodel':
                $( '#tab_cont_step20' ).show();
                break;
            case 'mailru':
            case 'mailru_clothing':
                $( '#tab_cont_step21' ).show();
                break;
            case 'vk_trade':
                $( '#tab_cont_step22' ).show();
                $( '#tab_cont_step23' ).show();
                $( '#tab_cont_step24' ).show();
                $( '#tab_cont_step25' ).show();
                $( '#tab_cont_step6' ).hide();
                $( '#export_step_value' ).val( 3 );
                $( '.file-field' ).addClass( 'hide' );
                break;
            case 'fb_trade':
                $( '#tab_cont_step26' ).show();
                $( '#tab_cont_step6' ).hide();
                $( '#export_step_value' ).val( 3 );
                $( '.file-field' ).addClass( 'hide' );
                break;
            case 'fb_ads':
                $( '#tab_cont_step28' ).show();
                $( '#tab_cont_step6' ).hide();
                break;
            case 'ok_trade':
                $( '#tab_cont_step27' ).show();
                $( '#tab_cont_step29' ).show();
                $( '#tab_cont_step31' ).show();
                $( '#tab_cont_step6' ).hide();
                $( '#export_step_value' ).val( 3 );
                $( '.file-field' ).addClass( 'hide' );
                break;
            case 'instagram_trade':
                $( '#tab_cont_step30' ).show();
                $( '#tab_cont_step6' ).hide();
                $( '#export_step_value' ).val( 1 );
                $( '.file-field' ).addClass( 'hide' );
                break;
            default:
                $( '#tab_cont_step6' ).show();
                break;
        }
    });

    $( document ).on( 'click', '#step5 .fieldset-item-delete', function(){
        $( this ).parent().parent().remove();
    });

    $( document ).on( 'click', '#step5 .composite-data-item-delete', function(){
        $( this ).parent().remove();
    });

    $( document ).on( 'click', '#step5 .arithmetics-data-item-delete', function(){
        $( this ).parent().remove();
    });

    $( document ).on( 'click', '#step5 .stack-data-item-delete', function(){
        $( this ).parent().remove();
    });

    $( document ).on( 'click', '#step9 .agent-fieldset-item-delete', function(){
        var agentContainer = $( this ).parent().parent();

        var id = agentContainer.attr( 'data-id' );
        var profile_id = agentContainer.attr( 'profile-id' );

        BX.showWait( 'waitContainer' );
        $.ajax({
            'type': 'POST',
            'method': 'POST',
            'dataType': 'json',
            'url': '/bitrix/admin/data_exportproplus_ajax.php',
            'data': 'id=' + id + "&profile_id=" + profile_id + "&ajax_action=agent_fieldset_delete&sessid=" + BX.message( 'bitrix_sessid' ),
            'success': function( data ){
                if( data.result == 'ok' ){
                    agentContainer.remove();
                }
                BX.closeWait( 'waitContainer' );
            },
        });
    });

    $( document ).on( 'click', '#step7 .fieldset-item-delete', function(){
        $( this ).parent().parent().remove();
    });
});

function prepareData(){
    queryData = {
        'PROFILE[VIEW_CATALOG]' : typeof $( 'input[name="PROFILE[VIEW_CATALOG]"]' ).attr( 'checked' ) === "undefined" ? '' : 'Y',
        'PROFILE[USE_SKU]' : typeof $( 'input[name="PROFILE[USE_SKU]"]' ).attr( 'checked' ) === "undefined" ? '' : 'Y',
        'PROFILE[CHECK_INCLUDE]' : typeof $( 'input[name="PROFILE[CHECK_INCLUDE]"]' ).attr( 'checked' ) === "undefined" ? '' : 'Y',
        'PROFILE[IBLOCK_TYPE_ID][]' : $( 'select[name="PROFILE[IBLOCK_TYPE_ID][]"]' ).val(),
        'PROFILE[IBLOCK_ID][]' : $( 'select[name="PROFILE[IBLOCK_ID][]"]' ).val(),
        'PROFILE[CATEGORY][]' : $( 'select[name="PROFILE[CATEGORY][]"]' ).val(),
        'PROFILE[LID]' : $( 'select[name="PROFILE[LID]"]' ).val(),
        'PROFILE[TYPE]' : $( 'select[name="PROFILE[TYPE]"]' ).val(),
        'sessid' : BX.message( 'bitrix_sessid' )
    };

    return queryData;
}

function getData( action, data, async, append ){
    if( typeof data === 'undefined' ){
        data = prepareData();
    }
    BX.showWait( 'waitContainer' );
    data['ajax_action'] = action;
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': data,
        'async': async,
        'success': function( data ){
            if( data.result == 'ok' ){
                if( typeof data.site !== 'undefined' ){
                    document.getElementById( 'PROFILE[DESCRIPTION]' ).value = data.site['SITE_NAME'];
                    document.getElementById( 'PROFILE[SHOPNAME]' ).value = data.site['SITE_NAME'];
                    document.getElementById( 'PROFILE[COMPANY]' ).value = data.site['NAME'];
                    document.getElementById( 'PROFILE[DOMAIN_NAME]' ).value = data.site['SERVER_NAME'];
                }

                if( data.special == 'true' ){
                    $( '#market_category_edit_btn' ).css( 'display', 'none' );
                    $( '#market_category_delete_btn' ).css( 'display', 'none' );
                }
                else{
                    $( '#market_category_edit_btn' ).css( 'display', 'inline' );
                    $( '#market_category_delete_btn' ).css( 'display', 'inline' );
                }

                for( var block_key in data.blocks ){
                    if( data.blocks[block_key].append == true ){
                        $( data.blocks[block_key].id ).append( data.blocks[block_key].html );
                    }
                    else{
                        $( data.blocks[block_key].id ).html( data.blocks[block_key].html );
                    }
                }
                if( typeof ret === 'object' ){
                    ret = data;
                }
            }
            BX.closeWait( 'waitContainer' );
            if( action == 'change_type' ){
                var checkedFileType = $( 'input[name="PROFILE[SETUP][FILE_TYPE]"]:checked' ).val();
                if( checkedFileType !== undefined ){
                    ChangeFileType( checkedFileType );
                }
            }
        },
    });
}

function ShowConditionBlock( value, cnt ){
    var cntId = cnt - 1;
    var condId = $( value ).attr( 'data-id' );

    getData( 'get_condition_block', {
        'sessid' : BX.message( 'bitrix_sessid' ),
        'fId' : condId,
        'fCnt' : cnt,
        'PROFILE[USE_SKU]' : typeof $( 'input[name="PROFILE[USE_SKU]"]' ).attr( 'checked' ) === 'undefined' ? '' : 'Y',
        'PROFILE[IBLOCK_ID][]' : $( 'select[name="PROFILE[IBLOCK_ID][]"]' ).val(),
    });

    var contValueFalse = $( 'textarea[name="PROFILE[XMLDATA][' + $( value ).attr( 'data-id' ) + '][CONTVALUE_FALSE]"]' );
    var contComplexValueFalse = $( 'textarea[name="PROFILE[XMLDATA][' + $( value ).attr( 'data-id' ) + '][COMPLEX_FALSE_CONTVALUE]"]' );
    var contCompositeValueFalse = $( 'textarea[name="PROFILE[XMLDATA][' + $( value ).attr( 'data-id' ) + '][COMPOSITE_FALSE_CONTVALUE]"]' );
    var contArithmeticsValueFalse = $( 'textarea[name="PROFILE[XMLDATA][' + $( value ).attr( 'data-id' ) + '][ARITHMETICS_FALSE_CONTVALUE]"]' );
    var contStackValueFalse = $( 'textarea[name="PROFILE[XMLDATA][' + $( value ).attr( 'data-id' ) + '][STACK_FALSE_CONTVALUE]"]' );

    fieldType = $( 'select[name="PROFILE[XMLDATA][' + $( value ).attr( 'data-id' ) + '][TYPE]"] option:selected' ).val();

    if( typeof $( value ).attr( 'checked' ) !== 'undefined' ){
        $( contValueFalse ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( '.fieldset-item[data-id=' + cntId + '] .complex-block-container .complex-block div:eq(3)' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( contComplexValueFalse ).css( 'display', 'inline-block' ).removeClass( 'hide' );

        $( '.fieldset-item[data-id=' + cntId + '] .composite-block-container .composite-block div.composite-data-area-false-container' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( contCompositeValueFalse ).css( 'display', 'inline-block' ).removeClass( 'hide' );

        $( '.fieldset-item[data-id=' + cntId + '] .arithmetics-block-container .arithmetics-block div.arithmetics-data-area-false-container' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( contArithmeticsValueFalse ).css( 'display', 'inline-block' ).removeClass( 'hide' );

        $( '.fieldset-item[data-id=' + cntId + '] .stack-block-container .stack-block div.stack-data-area-false-container' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( contStackValueFalse ).css( 'display', 'inline-block' ).removeClass( 'hide' );

        $( '#PROFILE_XMLDATA_' + condId + '_CONDITION' ).removeClass( 'hide' );
    }
    else{
        $( contValueFalse ).hide().addClass( 'hide' );

        $( '.fieldset-item[data-id=' + cntId + '] .complex-block-container .complex-block div:eq(3)' ).hide().addClass( 'hide' );
        $( contComplexValueFalse ).hide().addClass( 'hide' );

        $( '.fieldset-item[data-id=' + cntId + '] .composite-block-container .composite-block div.composite-data-area-false-container' ).hide().addClass( 'hide' );
        $( contCompositeValueFalse ).hide().addClass( 'hide' );

        $( '.fieldset-item[data-id=' + cntId + '] .arithmetics-block-container .arithmetics-block div.arithmetics-data-area-false-container' ).hide().addClass( 'hide' );
        $( contArithmeticsValueFalse ).hide().addClass( 'hide' );

        $( '.fieldset-item[data-id=' + cntId + '] .stack-block-container .stack-block div.stack-data-area-false-container' ).hide().addClass( 'hide' );
        $( contStackValueFalse ).hide().addClass( 'hide' );

        $( '#PROFILE_XMLDATA_' + condId + '_CONDITION' ).addClass( 'hide' );
    }
}

function ShowConvalueBlock( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit.fieldselecter').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.const-block').hide().addClass( 'hide' );
        $( value ).siblings( '.complex-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.composite-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.arithmetics-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.stack-block-container' ).hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        getData( 'fieldset_field_select', data );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit.fieldselecter').hide().addClass( 'hide' );
        $( value ).siblings( '.complex-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.composite-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.arithmetics-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.stack-block-container' ).hide().addClass( 'hide' );
    }
    else if( value.value == 'complex' ){
        $( value ).siblings( '.complex-block-container' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.const-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit.fieldselecter' ).hide().addClass( 'hide' );
        $( value ).siblings( '.composite-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.arithmetics-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.stack-block-container' ).hide().addClass( 'hide' );
    }
    else if( value.value == 'composite' ){
        $( value ).siblings( '.composite-block-container' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.complex-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.const-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit.fieldselecter' ).hide().addClass( 'hide' );
        $( value ).siblings( '.arithmetics-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.stack-block-container' ).hide().addClass( 'hide' );
    }
    else if( value.value == 'arithmetics' ){
        $( value ).siblings( '.arithmetics-block-container' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.complex-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.const-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit.fieldselecter' ).hide().addClass( 'hide' );
        $( value ).siblings( '.composite-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.stack-block-container' ).hide().addClass( 'hide' );
    }
    else if( value.value == 'stack' ){
        $( value ).siblings( '.stack-block-container' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.complex-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.const-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit.fieldselecter' ).hide().addClass( 'hide' );
        $( value ).siblings( '.composite-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.arithmetics-block-container' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit.fieldselecter' ).hide().addClass( 'hide' );
        $( value ).siblings( '.complex-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.composite-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.arithmetics-block-container' ).hide().addClass( 'hide' );
        $( value ).siblings( '.stack-block-container' ).hide().addClass( 'hide' );
    }
}

function ShowResolveBlock( value ){
    ret = {};
    var data = prepareData();

    data['data_value'] = value.value ;
    data['data_id'] = $( value ).attr( 'data-id' );
    getData( 'fieldset_field_resolve', data , false );

    if( ret.result == 'ok' ){
        $( value ).siblings( '.resolve-block' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
    }
    else{
        $( value ).siblings( '.resolve-block' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockComplex( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-complex').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-complex.fieldselecter' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.const-block-complex').hide().addClass( 'hide' );

        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "COMPLEX_TRUE_VALUE";
        getData( 'fieldset_field_select', data );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-complex' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-complex' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-complex.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-complex' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-complex' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-complex.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockComplexFalse( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-complex-false').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-complex-false.fieldselecter').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.const-block-complex-false').hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "COMPLEX_FALSE_VALUE";
        getData( 'fieldset_field_select', data );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-complex-false' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-complex-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-complex-false.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-complex-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-complex-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-complex-false.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockComposite( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-composite').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-composite.fieldselecter').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.const-block-composite').hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "COMPOSITE_TRUE_VALUE";
        getData( 'fieldset_field_select', data , false );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-composite' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-composite' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-composite.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-composite' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-composite' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-composite.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockArithmetics( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-arithmetics').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-arithmetics.fieldselecter').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.const-block-arithmetics').hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "ARITHMETICS_TRUE_VALUE";
        getData( 'fieldset_field_select', data , false );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-arithmetics' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-arithmetics' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-arithmetics.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-arithmetics' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-arithmetics' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-arithmetics.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockStack( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-stack').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-stack.fieldselecter').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.const-block-stack').hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "STACK_TRUE_VALUE";
        getData( 'fieldset_field_select', data , false );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-stack' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-stack' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-stack.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-stack' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-stack' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-stack.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockCompositeFalse( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-composite-false').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-composite-false.fieldselecter').hide().addClass( 'hide' );
        $( value ).siblings( '.const-block-composite-false').hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "COMPOSITE_FALSE_VALUE";
        getData( 'fieldset_field_select', data );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-composite-false' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-composite-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-composite-false.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-composite-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-composite-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-composite-false.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockArithmeticsFalse( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-arithmetics-false').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-arithmetics-false.fieldselecter').hide().addClass( 'hide' );
        $( value ).siblings( '.const-block-arithmetics-false').hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "ARITHMETICS_FALSE_VALUE";
        getData( 'fieldset_field_select', data );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-arithmetics-false' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-arithmetics-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-arithmetics-false.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-arithmetics-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-arithmetics-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-arithmetics-false.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function ShowConvalueBlockStackFalse( value ){
    if( value.value == 'field' ){
        $( value ).siblings( '.field-block-stack-false').css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-edit-stack-false.fieldselecter').hide().addClass( 'hide' );
        $( value ).siblings( '.const-block-stack-false').hide().addClass( 'hide' );
        var data = prepareData();
        data['data_id'] = $( value ).attr( 'data-id' );
        data['action_holder'] = "STACK_FALSE_VALUE";
        getData( 'fieldset_field_select', data );
    }
    else if( value.value == 'const' ){
        $( value ).siblings( '.const-block-stack-false' ).css( 'display', 'inline-block' ).removeClass( 'hide' );
        $( value ).siblings( '.field-block-stack-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-stack-false.fieldselecter' ).hide().addClass( 'hide' );
    }
    else{
        $( value ).siblings( '.const-block-stack-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-block-stack-false' ).hide().addClass( 'hide' );
        $( value ).siblings( '.field-edit-stack-false.fieldselecter' ).hide().addClass( 'hide' );
    }
}

function CalcExportStep( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'calcSteps',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            if( data.result == 'ok' ){
                $( 'input[name="PROFILE[SETUP][EXPORT_STEP]"]' ).val( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });
}

function CalcExportThreads( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'calcThreads',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            if( data.result == 'ok' ){
                $( 'div#threads_recomendation' ).text( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });
}

function SendVkCaptcha( profileId, vkCaptchaWord, vkCaptchaSessid ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'vkCaptchaWord' : vkCaptchaWord,
            'vkCaptchaSessid' : vkCaptchaSessid,
            'ajax_action' : 'sendVkCaptcha',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            if( data.result == true ){
                $( '#captcha_block' ).remove();
            }
            BX.closeWait( 'waitContainer' );
        },
    });
}

function VkDeleteSyncProducts( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'vkDeleteSyncProducts',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function VkDeleteAllProducts( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'vkDeleteAllProducts',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function VkDeleteSyncProductAlbums( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'vkDeleteSyncProductAlbums',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function VkDeleteAllProductAlbums( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'vkDeleteAllProductAlbums',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function VkDeleteSyncAlbums( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'vkDeleteSyncAlbums',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function VkDeleteAllAlbums( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'vkDeleteAllAlbums',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function VkResetSyncSettings( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'vkResetSyncSettings',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkResetSyncSettings( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okResetSyncSettings',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteSyncMediatopics( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteSyncMediatopics',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteAllMediatopics( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteAllMediatopics',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteSyncAlbums( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteSyncAlbums',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteAllAlbums( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteAllAlbums',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteSyncCatalogs( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteSyncCatalogs',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteAllCatalogs( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteAllCatalogs',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteSyncMarketItems( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteSyncMarketItems',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function OkDeleteAllMarketItems( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'okDeleteAllMarketItems',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function AutofillSettingsSet( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'AutofillSettingsSet',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
            window.location = 'data_exportproplus_edit.php?ID=' + profileId;
        },
    });
}

function AutofillSettingsReset( profileId ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'profileId' : profileId,
            'ajax_action' : 'AutofillSettingsReset',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
            window.location = 'data_exportproplus_edit.php?ID=' + profileId;
        },
    });
}

function convertCurrency(){
    $( '.currency_table' ).toggle();
}

function showCategoryRedefineTagField(){
    $( '#select_category_redefine_tag' ).toggle();
}

function FieldsetAdd( obj ){
    var id = $( '#step5 tr.fieldset-item' ).last().attr( 'data-id' );
    if( typeof id === 'undefined' ){
        id = 0;
    }
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': 'id=' + id + "&ajax_action=fieldset_add&sessid=" + BX.message( 'bitrix_sessid' ),
        'success': function( data ){
            if( data.result == 'ok' ){
                var text = $( "#step5 #fieldset-container" ).append( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });

    return false;
}

function CompositeFieldsetAdd( obj ){
    var buttonContainer = $( obj ).parent();
    var rowId = $( buttonContainer ).attr( 'data-row-id' );

    var nodeType = ( $( buttonContainer ).hasClass( 'truenode' ) ) ? 'truenode' : 'falsenode';

    var compositeNodeContainer = $( obj ).parent().parent();

    if( nodeType == 'truenode' ){
        placeToAppend = $( compositeNodeContainer ).children( '.composite-data-area-true' );
    }
    else{
        placeToAppend = $( compositeNodeContainer ).children( '.composite-data-area-false' );
    }

    var id = null;

    if( $( placeToAppend ).children().length ){
        id = $( placeToAppend ).children().last().attr( 'data-id' );
    }
    else{
        id = 0;
    }

    var data = prepareData();
    data['id'] = id;
    data['rowId'] = rowId;
    data['nodeType'] = nodeType;
    data['ajax_action'] = 'composite_fieldset_add';

    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': data,
        'success': function( data ){
            if( data.result == 'ok' ){
                var text = $( placeToAppend ).append( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });

    return false;
}

function ArithmeticsFieldsetAdd( obj ){
    var buttonContainer = $( obj ).parent();
    var rowId = $( buttonContainer ).attr( 'data-row-id' );

    var nodeType = ( $( buttonContainer ).hasClass( 'truenode' ) ) ? 'truenode' : 'falsenode';

    var arithmeticsNodeContainer = $( obj ).parent().parent();

    if( nodeType == 'truenode' ){
        placeToAppend = $( arithmeticsNodeContainer ).children( '.arithmetics-data-area-true' );
        var nodeDivider = $( "input[name='PROFILE[XMLDATA][" + rowId + "][ARITHMETICS_TRUE_DIVIDER]']" );
    }
    else{
        placeToAppend = $( arithmeticsNodeContainer ).children( '.arithmetics-data-area-false' );
        var nodeDivider = $( "input[name='PROFILE[XMLDATA][" + rowId + "][ARITHMETICS_FALSE_DIVIDER]']" );
    }

    var id = null;

    if( $( placeToAppend ).children().length ){
        id = $( placeToAppend ).children().last().attr( 'data-id' );
    }
    else{
        id = 0;
    }

    var data = prepareData();
    data['id'] = id;
    data['rowId'] = rowId;
    data['nodeType'] = nodeType;
    data['ajax_action'] = 'arithmetics_fieldset_add';

    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': data,
        'success': function( data ){
            if( data.result == 'ok' ){
                var text = $( placeToAppend ).append( data.data );

                nodeDividerValue = $( nodeDivider ).val();
                if( nodeDividerValue === '' ){
                    nodeDividerValue = 'x' + ( +id + +1 );
                }
                else{
                    nodeDividerValue = nodeDividerValue + ' + x' + ( +id + +1 );
                }

                $( nodeDivider ).val( nodeDividerValue );
            }

            BX.closeWait( 'waitContainer' );
        },
    });

    return false;
}

function StackFieldsetAdd( obj ){
    var buttonContainer = $( obj ).parent();
    var rowId = $( buttonContainer ).attr( 'data-row-id' );

    var nodeType = ( $( buttonContainer ).hasClass( 'truenode' ) ) ? 'truenode' : 'falsenode';

    var stackNodeContainer = $( obj ).parent().parent();

    if( nodeType == 'truenode' ){
        placeToAppend = $( stackNodeContainer ).children( '.stack-data-area-true' );
    }
    else{
        placeToAppend = $( stackNodeContainer ).children( '.stack-data-area-false' );
    }

    var id = null;

    if( $( placeToAppend ).children().length ){
        id = $( placeToAppend ).children().last().attr( 'data-id' );
    }
    else{
        id = 0;
    }

    var data = prepareData();
    data['id'] = id;
    data['rowId'] = rowId;
    data['nodeType'] = nodeType;
    data['ajax_action'] = 'stack_fieldset_add';

    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': data,
        'success': function( data ){
            if( data.result == 'ok' ){
                var text = $( placeToAppend ).append( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });

    return false;
}

function ConvertFieldsetAdd( obj ){
    var id = $( '#step7 table#convert-fieldset-container tr.fieldset-item' ).last().attr( 'data-id' );
    if( typeof id === 'undefined' ){
        id = 0;
    }
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': 'id=' + id + "&ajax_action=convert_fieldset_add&sessid=" + BX.message( 'bitrix_sessid' ),
        'success': function( data ){
            if( data.result == 'ok' ){
                var text = $( "#step7 table#convert-fieldset-container tbody" ).append( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });

    return false;
}

function FieldsetConvertFieldsetAdd( obj ){
    var buttonContainer = $( obj ).parent();
    var rowId = $( buttonContainer ).attr( 'data-row-id' );

    var id = $( '#step5 table#fieldset-convert-fieldset-container' + rowId + ' tr.convert-fieldset-item'  ).last().attr( 'data-id' );
    if( typeof id === 'undefined' ){
        id = 0;
    }

    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': 'id=' + id + '&rowId=' + rowId + "&ajax_action=fieldset_convert_fieldset_add&sessid=" + BX.message( 'bitrix_sessid' ),
        'success': function( data ){
            if( data.result == 'ok' ){
                var text = $( '#step5 #fieldset-convert-fieldset-container' + rowId ).append( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });

    return false;
}

function AgentFieldsetAdd( obj ){
    var id = $( '#step9 tr#tr_cron_table td table tbody tr' ).last().attr( 'data-id' );
    if( typeof id === 'undefined' ){
        id = 0;
    }
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': 'id=' + id + "&ajax_action=agent_fieldset_add&sessid=" + BX.message( 'bitrix_sessid' ),
        'success': function( data ){
            if( data.result == 'ok' ){
                var text = $( "#step9 tr#tr_cron_table table tbody" ).append( data.data );
            }
            BX.closeWait( 'waitContainer' );
        },
    });

    return false;
}

function ShowMarketForm( type ){
    var marketId = $( 'select[name="PROFILE[MARKET_CATEGORY][CATEGORY]"]' ).val();
    if( type == 'edit' ){
        BX.showWait( 'waitContainer' );
        $.ajax({
            'type': 'POST',
            'method': 'POST',
            'dataType': 'json',
            'url': '/bitrix/admin/data_exportproplus_ajax.php',
            'data': {
                'marketId' : marketId,
                'ajax_action' : 'market_edit',
                'sessid' : BX.message( 'bitrix_sessid' ),
            },
            'success': function( data ){
                if( data.result == 'ok' ){
                    $( 'input[name="PROFILE[MARKET_CATEGORY_NAME]"]' ).val( data.name );
                    $( 'textarea[name="PROFILE[MARKET_CATEGORY_DATA]"]' ).val( data.data );
                    $( 'input[name="PROFILE[MARKET_CATEGORY_ID]"]' ).val( data.id );
                }
                BX.closeWait( 'waitContainer' );
            },
        });
    }
    $( '#step6 #category_add' ).show();
}

function DeleteMarketCategoryType( profileId ){
    var marketId = $( 'select[name="PROFILE[MARKET_CATEGORY][CATEGORY]"]' ).val();
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'marketId' : marketId,
            'ajax_action' : 'market_delete',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
            window.location = 'data_exportproplus_edit.php?ID=' + profileId;
        },
    });
}

function HideMarketForm(){
    $( 'input[name="PROFILE[MARKET_CATEGORY_ID]"]' ).val( '' );
    $( 'input[name="PROFILE[MARKET_CATEGORY_NAME]"]' ).val( '' );
    $( 'textarea[name="PROFILE[MARKET_CATEGORY_DATA]"]' ).val( '' );
    $( '#step6 #category_add' ).hide();
}

function SaveMarketForm(){
    var marketId = $( 'input[name="PROFILE[MARKET_CATEGORY_ID]"]' ).val();
    var marketName = $( 'input[name="PROFILE[MARKET_CATEGORY_NAME]"]' ).val();
    var marketData = $( 'textarea[name="PROFILE[MARKET_CATEGORY_DATA]"]' ).val();
    var current = $( 'select[name="PROFILE[MARKET_CATEGORY][CATEGORY]"]' ).val();

    var data = {
        'marketId' : marketId,
        'marketName' : marketName,
        'marketData' : marketData,
        'current' : current,
        'sessid' : BX.message( 'bitrix_sessid' )
    };

    getData( 'market_save', data );
    HideMarketForm();
}

function ChangeMarketCategory( marketId ){
    var data = {
        'marketId' : marketId,
        'sessid' : BX.message( 'bitrix_sessid' ),
        'PROFILE[IBLOCK_ID][]' : $( 'select[name="PROFILE[IBLOCK_ID][]"]' ).val(),
        'PROFILE[CHECK_INCLUDE]' : typeof $( 'input[name="PROFILE[CHECK_INCLUDE]"]' ).attr( 'checked' ) === "undefined" ? '' : 'Y',
        'PROFILE[CATEGORY][]' : $( 'select[name="PROFILE[CATEGORY][]"]' ).val(),
    };
    getData( 'change_market_category', data );
}

var MarketCategoryItem = '';
var FieldsListItem = '';
var MarketCategoryObject;
var FieldsListObject;
var PropertyListItem = '';
var PropertyListItemValue = '';
var PropertyListObject;

function SetMarketCategory( categoryValue ){
    $( 'input[name="PROFILE[MARKET_CATEGORY][CATEGORY_LIST][' + MarketCategoryItem + ']"]').val( categoryValue );
    MarketCategoryItem = '';
    MarketCategoryObject.close();
}

function SetMarketCategoryEbay( categoryValue, categoryName ){
    categoryName = $( categoryName ).find( 'option[value="' + categoryValue + '"]' ).text();
    $( 'input[name="PROFILE[MARKET_CATEGORY][EBAY][CATEGORY_LIST][' + MarketCategoryItem + ']"]' ).val( categoryValue );
    $( 'input[name="PROFILE_MARKET_CATEGORY_CATEGORY_LIST_EBAY_' + MarketCategoryItem + '_NAME"]' ).val( categoryName );
    MarketCategoryItem = '';
    MarketCategoryObject.close();
}

function SetMarketCategoryOzon( categoryValue, categoryName ){
    categoryName = $( categoryName ).find( 'option[value="' + categoryValue + '"]' ).text();
    $( 'input[name="PROFILE[MARKET_CATEGORY][OZON][CATEGORY_LIST][' + MarketCategoryItem + ']"]' ).val( categoryValue );
    $( 'input[name="PROFILE_MARKET_CATEGORY_CATEGORY_LIST_OZON_' + MarketCategoryItem + '_NAME"]' ).val( categoryName );
    MarketCategoryItem = '';
    MarketCategoryObject.close();
}

function SetMarketCategoryVk( categoryValue, categoryName ){
    categoryName = $( categoryName ).find( 'option[value="' + categoryValue + '"]' ).text();
    $( 'input[name="PROFILE[MARKET_CATEGORY][VK][CATEGORY_LIST][' + MarketCategoryItem + ']"]' ).val( categoryValue );
    $( 'input[name="PROFILE_MARKET_CATEGORY_CATEGORY_LIST_VK_' + MarketCategoryItem + '_NAME"]' ).val( categoryName );
    MarketCategoryItem = '';
    MarketCategoryObject.close();
}

function SetMarketCategoryTiu( categoryValue , categoryName){
    $( 'input[name="PROFILE[MARKET_CATEGORY][TIU][CATEGORY_LIST][' + MarketCategoryItem + ']"]' ).val( categoryValue );
    MarketCategoryItem = '';
    MarketCategoryObject.close();
}

function SetFieldsListField( fieldValue, fieldName, fieldPrefix, CompositeArithmeticsStackFieldId, CompositeArithmeticsStackFieldPrefix ){
    if( ( CompositeArithmeticsStackFieldId != false ) && ( CompositeArithmeticsStackFieldPrefix != false ) ){
        $( 'input[name="PROFILE[XMLDATA][' + FieldsListItem + '][' + fieldPrefix + '][' + CompositeArithmeticsStackFieldId + '][' + CompositeArithmeticsStackFieldPrefix + ']"]' ).val( fieldValue );
        $( 'input[name="PROFILE[XMLDATA][' + FieldsListItem + '][' + fieldPrefix + '][' + CompositeArithmeticsStackFieldId + '][' + CompositeArithmeticsStackFieldPrefix + '_SHOW]"]' ).val( fieldName );
    }
    else{
        $( 'input[name="PROFILE[XMLDATA][' + FieldsListItem + '][' + fieldPrefix + ']"]' ).val( fieldValue );
        $( 'input[name="PROFILE[XMLDATA][' + FieldsListItem + '][' + fieldPrefix + '_SHOW]"]' ).val( fieldName );
    }

    FieldsListItem = '';
    FieldsListObject.close();
}

function ChangeFileType( value ){
    if( value == 'csv' ){
        $fieldVal = $( '#URL_DATA_FILE' ).val();
        $fieldVal = $fieldVal.replace( '.xml', '.csv' );
        $fieldVal = $fieldVal.replace( '.xlsx', '.csv' );

        $( '#URL_DATA_FILE' ).val( $fieldVal );
        $( '#export_step_value' ).val( 50 );
        $( '#tr_csv_info' ).show();
    }
    else if( value == 'xlsx' ){
        $fieldVal = $( '#URL_DATA_FILE' ).val();
        $fieldVal = $fieldVal.replace( '.xml', '.xlsx' );
        $fieldVal = $fieldVal.replace( '.csv', '.xlsx' );

        $( '#URL_DATA_FILE' ).val( $fieldVal );
        $( '#export_step_value' ).val( 50 );
        $( '#tr_csv_info' ).show();
    }
    else{
        $fieldVal = $( '#URL_DATA_FILE' ).val();
        $fieldVal = $fieldVal.replace( '.csv', '.xml' );
        $fieldVal = $fieldVal.replace( '.xlsx', '.xml' );

        $( '#URL_DATA_FILE' ).val( $fieldVal );
        $( '#export_step_value' ).val( 50 );
        $( '#tr_csv_info' ).hide();
    }
}

function ChangeRunType( value ){
    if( value == 'cron' ){
        $( '#tr_cron_next_run' ).removeClass( 'hide' );
        $( '#tr_cron_task_options_mode' ).removeClass( 'hide' );
        $( '#tr_cron_task_options_php' ).removeClass( 'hide' );
        $( '#tr_cron_task_options_shorttag_php' ).removeClass( 'hide' );
        $( '#tr_cron_php_paths' ).removeClass( 'hide' );
        $( '#tr_cron_table' ).removeClass( 'hide' );
        $( '#tr_cron_button' ).removeClass( 'hide' );
        $( '#tr_cron_info' ).removeClass( 'hide' );
        $( '#tr_comp_threads' ).addClass( 'hide' );
        $( '#tr_run_new_window' ).addClass( 'hide' );
        $( '#tr_run_new_window_cron' ).removeClass( 'hide' );
    }
    else{
        $( '#tr_cron_next_run' ).addClass( 'hide' );
        $( '#tr_cron_task_options_mode' ).addClass( 'hide' );
        $( '#tr_cron_task_options_shorttag_php' ).addClass( 'hide' );
        $( '#tr_cron_php_paths' ).addClass( 'hide' );
        $( '#tr_cron_task_options_php' ).addClass( 'hide' );
        $( '#tr_cron_table' ).addClass( 'hide' );
        $( '#tr_cron_button' ).addClass( 'hide' );
        $( '#tr_cron_info' ).addClass( 'hide' );
        $( '#tr_comp_threads' ).removeClass( 'hide' );
        $( '#tr_run_new_window' ).removeClass( 'hide' );
        $( '#tr_run_new_window_cron' ).addClass( 'hide' );
    }
}

function ChangeCronMode( value ){
    if( value == 'php' ){
        $( '#tr_cron_task_options_php' ).removeClass( 'hide' );
        $( '#tr_cron_task_options_shorttag_php' ).removeClass( 'hide' );
    }
    else{
        $( '#tr_cron_task_options_php' ).addClass( 'hide' );
        $( '#tr_cron_task_options_shorttag_php' ).addClass( 'hide' );
    }
}

function RunExpressAgent( profileID ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': "profileID=" + profileID + "&ajax_action=run_express_agent&sessid=" + BX.message( 'bitrix_sessid' ),
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function SetCronAgentOptions(){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'ajax_action' : 'SetCronAgentOptions',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function UpdateBitrixCloudMonitoring( addEmail ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'ajax_action' : 'UpdateBitrixCloudMonitoring',
            'sessid' : BX.message( 'bitrix_sessid' ),
            'add_email' : addEmail,
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
            window.location = '/bitrix/admin/settings.php?mid=data.exportproplus';
        },
    });
}

function UpdateMarketCategories(){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'ajax_action' : 'UpdateMarketCategories',
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function UpdateLog( obj ){
    getData( 'update_log', {
        'sessid' : BX.message( 'bitrix_sessid' ),
        'profileID' : $( obj ).attr( 'profileID' )
    });
}

$( document ).on( 'change', '#property_list select', function(){
    $( 'input[name="' + PropertyListItem + '"]' ).val( $( this ).find( 'option:selected' ).text() );
    $( 'input[name="' + PropertyListItemValue + '"]' ).val( $( this ).val() );
    PropertyListObject.close();
});

function UnlockExport( profileID ){
    getData( 'unlock_export', {
        'sessid' : BX.message( 'bitrix_sessid' ),
        'profileID' : profileID
    });
}

function ClearExportData( profileID ){
    getData( 'clear_export_data', {
        'sessid' : BX.message( 'bitrix_sessid' ),
        'profileID' : profileID
    });

    setTimeout(
        function(){
            window.location = 'data_exportproplus_edit.php?ID=' + profileID;
        },
        100
    );
}

function UnlockExportExpress( profileID ){
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': "profileID=" + profileID + "&ajax_action=unlock_export_express&sessid=" + BX.message( 'bitrix_sessid' ),
        'success': function( data ){
            BX.closeWait( 'waitContainer' );
        },
    });
}

function FilterMarketCategoryList( obj, $container ){
    if( $( obj ).val() == '' ){
        $( '#' + $container + ' select option' ).show();
    }
    else{
        searchWords = $( obj ).val().replace( /\s+/g, '' );
        $( '#' + $container + ' select option' ).each( function(){
            var cOption = $( this );
            var cOoptionSearch = cOption.data( 'search' );
            var find = true;
            if( typeof( cOoptionSearch ) == 'string' ){
                cOoptionSearch = cOoptionSearch.toLowerCase().trim().replace( /\s+/g, '' );
                if( cOoptionSearch.indexOf( searchWords.toLowerCase().trim() ) == -1 )
                    find = false;
            }

            if( find ){
                cOption.show();
            }
            else{
                cOption.hide();
            }
        });
    }
}

/*function FilterMarketCategoryList( obj, $container ){
    if( $( obj ).val() == '' ){
        $( '#' + $container + ' select option' ).show();
    }
    else{
        searchWords = $( obj ).val().split( " " );
        $( '#' + $container + ' select option' ).each( function(){
            var cOption = $( this );
            var cOoptionSearch = cOption.data( 'search' );
            var find = true;
            searchWords.forEach( function( curVal, ind, arr ){
                if( typeof( cOoptionSearch ) == 'string' ){
                    if( cOoptionSearch.indexOf( curVal.toLowerCase().trim() ) == -1 )
                        find = false;
                }

            })
            if( find ){
                cOption.show();
            }
            else{
                cOption.hide();
            }
        });
    }
}*/

function FilterFieldsList( obj, $container ){
    if( $( obj ).val() == '' ){
        $( '#' + $container + ' select option' ).show();
    }
    else{
        searchWords = $( obj ).val().trim().split( " " );
        $( '#' + $container + ' select option' ).each( function(){
            var cOption = $( this );
            var cOoptionSearch = cOption.data( 'search' );
            var find = false;
            searchWords.forEach( function( curVal, ind, arr ){
                if( typeof( cOoptionSearch ) == 'string' ){
                    if( cOoptionSearch.toLowerCase().indexOf( curVal.toLowerCase().trim() ) >= 0 ) {
                        find = true;
										}
                }

            })
            if( find ){
                cOption.show();
            }
            else{
                cOption.hide();
            }
        });
    }
}

function ExtractAccessToken(){
    var accessTokenId = $( '#VK_ACCESS_TOKEN' );
    accessToken = accessTokenId.val().match( /access_token=(\w+)/i );
    if( accessToken != null ){
        accessTokenId.val( accessToken[1] );
    }
}

function GetFbAccessToken(){
    var pageId = $( '#FB_PAGE_PUBLISH' ).val();
    var appId = $( '#FB_APP_ID' ).val();
    var appSecret = $( '#FB_APP_SECRET' ).val();

    var scope = 'publish_actions,manage_pages,publish_pages,public_profile';

    if( !appId || !appSecret ){
        alert( FB_ALERT_NOT_APP_ID );
        return;
    }

    var callback = '/bitrix/admin/data_exportproplus_ajax.php?ajax_action=' + 'setFbLoginUrl';
    var width = 800;
    var height = 600;

    url = '/bitrix/admin/data_exportproplus_ajax.php?appId=' + appId + '&appSecret=' + appSecret + '&callback=' + callback + '&scope=' + scope + '&ajax_action=' + 'getFbLogin' + '&sessid=' + BX.message( 'bitrix_sessid' );

    window.open( url, 'DataFBAccess', 'location=yes,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',left=' + ( ( window.innerWidth - width ) / 2 ) + ',top=' + ( ( window.innerHeight - height ) / 2 ) );
}

function SetFbAccessToken( accessToken ){
    if( !accessToken )
        return;
    
    $( '#FB_ACCESS_TOKEN' ).val( accessToken );
    $( '#FB_ADS_ACCESS_TOKEN' ).val( accessToken );

    return true;
}

function collapseRow( rowId ){
    if( $( '#'+rowId ).css( 'display' ) == 'none' ){
        BX( 'img_' + rowId ).src = '/bitrix/images/catalog/load/minus.gif';
        $( '#'+rowId ).removeClass( 'hide' );
    }
    else{
        BX( 'img_' + rowId ).src = '/bitrix/images/catalog/load/plus.gif';
        $( '#'+rowId ).addClass( 'hide' );
    }
}

$(document).delegate('#URL_DATA_FILE','change',function(){
    var URL_DATA_FILE_USED = $('#URL_DATA_FILE_used');
    BX.showWait( 'waitContainer' );
    $.ajax({
        'type': 'POST',
        'method': 'POST',
        'dataType': 'json',
        'url': '/bitrix/admin/data_exportproplus_ajax.php',
        'data': {
            'ajax_action' : 'is_url_used',
            'profileId' : URL_DATA_FILE_USED.attr('data-profile-id'),
            'url' : $(this).val(), 
            'sessid' : BX.message( 'bitrix_sessid' ),
        },
        'success': function( data ){
            URL_DATA_FILE_USED.hide().find('span').text('0');
            if(data.result=='no' && data.profile_id>0) {
              URL_DATA_FILE_USED.show().find('span').text(data.profile_id);
            }
            BX.closeWait( 'waitContainer' );
        },
    });
});
