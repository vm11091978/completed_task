<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '')
{
	if(check_bitrix_sessid())
	{
        $arFields = Array(
            "AUTHOR" => $_POST["medicine_name"],
            "AUTHOR_COMPANY" => $_POST["medicine_company"],
            "AUTHOR_EMAIL" => $_POST["medicine_email"],
            "AUTHOR_PHONE" => $_POST["medicine_phone"],
            "EMAIL_TO" => $arParams["EMAIL_TO"],
            "TEXT" => $_POST["medicine_message"],
        );

        CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);

        $_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["medicine_name"]);
        $_SESSION["MF_COMPANY"] = htmlspecialcharsbx($_POST["medicine_company"]);
        $_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["medicine_email"]);
        $_SESSION["MF_PHONE"] = htmlspecialcharsbx($_POST["medicine_phone"]);

        LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));

		$arResult["MESSAGE"] = htmlspecialcharsbx($_POST["medicine_message"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["medicine_name"]);
        $arResult["AUTHOR_COMPANY"] = htmlspecialcharsbx($_POST["medicine_company"]);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["medicine_email"]);
		$arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_POST["medicine_phone"]);
	}
}

if($USER->IsAuthorized())
{
    $arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
    $arResult["AUTHOR_COMPANY"] = htmlspecialcharsbx($_SESSION["MF_COMPANY"]);
    $arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
    $arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_SESSION["MF_PHONE"]);
}
else
{
    if($_SESSION["MF_NAME"] <> '')
        $arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
    if($_SESSION["MF_COMPANY"] <> '')
        $arResult["AUTHOR_COMPANY"] = htmlspecialcharsbx($_SESSION["MF_COMPANY"]);
    if($_SESSION["MF_EMAIL"] <> '')
        $arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
    if($_SESSION["MF_PHONE"] <> '')
        $arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_SESSION["MF_PHONE"]);
}

$this->IncludeComponentTemplate();