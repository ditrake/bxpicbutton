<?php


namespace ditrake\bxpicbutton;


class HtmlEditorPictureButton
{
    private const MODULE_ID = "ditrake.bxpicbutton";
    /**
     * Обработчик события для добавления кнопки в визуальный редактор
     */
    public static function OnIncludeHTMLEditorScriptRuns()
    {
        /*Регистрируем расширение, с подключением основного скрипта и подключением языкового файла*/
        CJSCore::RegisterExt('ditrake_htmleditor_picture_button', array(
            /*Путь до скрипта расширения*/
            'js' => '/bitrix/tools/'.self::MODULE_ID.'/js/script.js',

            /*Путь до языкового файла*/
            'lang' => '/bitrix/modules/'.self::MODULE_ID.'/lang/'.LANGUAGE_ID.'/install/tools/js/script.php',
        ));

        //Инициализируем наше расширение
        CJSCore::Init(array('ditrake_htmleditor_picture_button'));
    }
}