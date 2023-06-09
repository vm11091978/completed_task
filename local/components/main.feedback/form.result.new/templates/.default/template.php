<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="contact-form">
    <div class="contact-form__head">
        <div class="contact-form__head-title">Связаться</div>
        <div class="contact-form__head-text">Наши сотрудники помогут выполнить подбор услуги и&nbsp;расчет цены с&nbsp;учетом
            ваших требований
        </div>
    </div>
    <form class="contact-form__form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
    <?=bitrix_sessid_post()?>
        <div class="contact-form__form-inputs">
            <div class="input contact-form__input"><label class="input__label" for="medicine_name">
                <div class="input__label-text">Ваше имя*</div>
                <input class="input__input" type="text" id="medicine_name" name="medicine_name"
                       value="<?=$arResult['AUTHOR_NAME']?>" required="">
                <div class="input__notification">Поле должно содержать не менее 3-х символов</div>
            </label></div>
            <div class="input contact-form__input"><label class="input__label" for="medicine_company">
                <div class="input__label-text">Компания/Должность*</div>
                <input class="input__input" type="text" id="medicine_company" name="medicine_company"
                       value="<?=$arResult['AUTHOR_COMPANY']?>" required="">
                <div class="input__notification">Поле должно содержать не менее 3-х символов</div>
            </label></div>
            <div class="input contact-form__input"><label class="input__label" for="medicine_email">
                <div class="input__label-text">Email*</div>
                <input class="input__input" type="email" id="medicine_email" name="medicine_email"
                       value="<?=$arResult['AUTHOR_EMAIL']?>" required="">
                <div class="input__notification">Неверный формат почты</div>
            </label></div>
            <div class="input contact-form__input"><label class="input__label" for="medicine_phone">
                <div class="input__label-text">Номер телефона*</div>
                <input class="input__input" type="tel" id="medicine_phone"
                       data-inputmask="'mask': '+79999999999', 'clearIncomplete': 'true'" maxlength="12"
                       x-autocompletetype="phone-full" name="medicine_phone"
                       value="<?=$arResult['AUTHOR_PHONE']?>" required="">
            </label></div>
        </div>
        <div class="contact-form__form-message">
            <div class="input"><label class="input__label" for="medicine_message">
                <div class="input__label-text">Сообщение</div>
                <textarea class="input__input" type="text" id="medicine_message" name="medicine_message"
                          value=""></textarea>
                <div class="input__notification"></div>
            </label></div>
        </div>
        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                данных&raquo;.
            </div>
            <button class="form-button contact-form__bottom-button" onclick="javascript:somefunction(event);"
                    data-success="Отправлено" data-error="Ошибка отправки">
                <div class="form-button__title">Оставить заявку</div>
            </button>
        </div>
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult['PARAMS_HASH']?>">
        <input id="input__unical" type="submit" name="submit" style="display: none" value="submit">
    </form>
</div>

<script>
    function somefunction(event) {
        event.preventDefault();
        document.querySelector('#input__unical').click();
    }
</script>
