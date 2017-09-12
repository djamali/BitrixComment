<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');


//add comments
if($_POST) {
    $el = new CIBlockElement;
    $iblock_id = 5;
    $properties=array();
    $properties["USER"]=CUser::GetLogin();
    $properties["DATE_CREATE"]=date("d.m.y");
    $properties["COMMENT"]=$_POST["text"];
    $properties["URL"]=$arParams["URL"];
    $fields = array(
        "PROPERTY_VALUES" => $properties,
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "NAME" => $_POST["text"],
        "URL"=>$url
    );
    if ($PRODUCT_ID = $el->Add($fields)) {
    } else {ddd
        echo "Error: " . $el->LAST_ERROR;
    }
}
//end add comments

//show comments
    $arSelect = Array("ID", "NAME","PROPERTY_COMMENT","DATE_CREATE","PROPERTY_USER");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        //print_r($arFields);
        print $arFields["DATE_CREATE"]." ".$arFields["PROPERTY_USER_VALUE"]." ".$arFields["PROPERTY_COMMENT_VALUE"]."<br>";
    }

//end show comments
$this->IncludeComponentTemplate();
?>