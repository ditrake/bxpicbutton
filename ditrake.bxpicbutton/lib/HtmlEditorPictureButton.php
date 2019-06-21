<?php


namespace ditrake\bxpicbutton;


class HtmlEditorPictureButton
{
    private const MODULE_ID = "ditrake.bxpicbutton";
    /**
     * Обработчик события для добавления кнопки в визуальный редактор
     */
    public static function OnBeforeHTMLEditorScriptRuns()
    {
        /*Регистрируем расширение, с подключением основного скрипта и подключением языкового файла*/
        \CJSCore::RegisterExt('ditrake_htmleditor_picture_button', array(
            /*Путь до скрипта расширения*/
            'js' => '/bitrix/tools/'.self::MODULE_ID.'/js/script.js',

            /*Путь до языкового файла*/
            'lang' => '/bitrix/modules/'.self::MODULE_ID.'/lang/'.LANGUAGE_ID.'/install/tools/js/script.php',
        ));

        //Инициализируем наше расширение
        \CJSCore::Init(array('ditrake_htmleditor_picture_button'));
    }

    public static function generateHtmlForm(){
        ?>
        <tr id="tr_DETAIL_PICTURE" class="adm-detail-file-row">
            <td width="40%" class="adm-detail-valign-top adm-detail-content-cell-l">Детальная картинка:</td>
            <td width="60%" class="adm-detail-content-cell-r">
                <script>
                    if (!window.BX && top.BX)
                        window.BX = top.BX;

                    if (typeof ML_MESS === "undefined")
                    {
                        var ML_MESS =
                            {
                                AccessDenied : 'Доступ запрещен',
                                SessExpired : 'Истек период активности Вашей сессии',
                                DelCollection : 'Удалить коллекцию из медиабиблиотеки',
                                DelItem : 'Удалить элемент из коллекции',
                                DelCollectionConf : 'Вы действительно хотите удалить коллекцию из медиабиблиотеки?',
                                DelItemConf : 'Вы действительно хотите удалить элемент из коллекции?',
                                EditCollection : 'Редактировать коллекцию',
                                EditItem : 'Редактировать элемент',
                                NewCollection : 'Новая коллекция',
                                Collection : 'Коллекция',
                                ColLocEr : 'Вы не можете переместить коллекцию саму в себя',
                                ColLocEr2 : 'Вы не можете переместить редактируемую коллекцию в выбранную',
                                Item : 'Элемент',
                                NewItem : 'Новый элемент',
                                DelColFromItem : 'Удалить элемент из коллекции',
                                ItemNoColWarn : 'Ошибка! Элемент должен принадлежать хотя бы одной коллекции',
                                DateModified : 'Изменен',
                                FileSize : 'Размер файла',
                                ImageSize : 'Размеры картинки',
                                CheckedColTitle : 'Эта коллекция уже выбрана',
                                ItSourceError : 'Файл не выбран!',
                                ItFileSizeError : 'Превышен максимальный размер файла (#FILESIZE# Мб)',
                                ItNameError : 'Название элемента не задано',
                                ItCollsError : 'Элемент должен быть привязан как минимум к одной коллекции',
                                ColNameError : 'Название коллекции не задано',
                                DelItConfTxt : 'Вы можете удалить элемент только из текущей коллекции или из всех коллекций. Удалить элемент?',
                                DelItB1 : 'Из текущей коллекции',
                                DelItB2 : 'Из всех коллекций',
                                CollAccessDenied : 'Нет доступа к информации о коллекции',
                                CollAccessDenied2 : 'У вас нет прав для добавления элементов в эту коллекцию',
                                CollAccessDenied3: 'У вас нет прав для создания коллекций внутри этой коллекции',
                                CollAccessDenied4: 'Недостаточно прав для создания или редактирования элемента в этой коллекции',
                                BadSubmit: 'Во время вставки данных произошла ошибка. Возможно параметры вызова диалога медиабиблиотеки были заданы некорректно',
                                ItemExtError: 'Файл с таким расширением не может быть загружен в медиабиблиотеку',
                                EditItemError: 'При редактировании элемента произошла ошибка, элемент не был сохранен',
                                SearchResultEx: 'Результаты поиска \"#SEARCH_QUERY#\"',
                                DelElConfirm: 'Вы действительно хотите удалить элемент из всех коллекций медиабиблиотеки?',
                                DelElConfirmYes: 'Удалить',
                                SearchDef: ' - Поиск - ',
                                NoResult: 'По вашему запросу ничего не найдено',
                                ViewItem : 'Детальный просмотр элемента',
                                FileExt : 'Тип файла',
                                CheckExtTypeConf : 'Внимание! Исходный файл имеет расширение не предусмотренное в описании текущего типа содержимого медиабиблиотеки. Вы действительно хотите сохранить элемент?'
                            };
                    }
                    window.OpenMedialibDialogbx_file_detail_picture = function(bLoadJS)
                    {
                        if (window.oBXMedialib && window.oBXMedialib.bOpened)
                            return false;


                        if (!window.BXMediaLib)
                        {
                            if (bLoadJS !== false)
                            {
                                // Append CSS
                                BX.loadCSS("/bitrix/js/fileman/medialib/medialib.css");

                                var arJS = [];
                                if (!window.jsAjaxUtil)
                                    arJS.push("/bitrix/js/main/ajax.js?v=1560930773");
                                if (!window.jsUtils)
                                    arJS.push("/bitrix/js/main/utils.js?v=1560930773");
                                if (!window.CHttpRequest)
                                    arJS.push("/bitrix/js/main/admin_tools.js?v=1560930774");

                                arJS.push("/bitrix/js/fileman/medialib/common.js?v=1560930923");
                                arJS.push("/bitrix/js/fileman/medialib/core.js?v=1560930923");
                                BX.loadScript(arJS);
                            }
                            return setTimeout(function(){OpenMedialibDialogbx_file_detail_picture(false)}, 50);
                        }

                        BX.loadCSS("/bitrix/js/fileman/medialib/medialib.css");
                        if (!window.jsUtils && top.jsUtils)
                            window.jsUtils = top.jsUtils;
                        if (!window.jsUtils)
                            BX.loadScript('/bitrix/js/main/utils.js?v=1560930773');

                        if (!window.CHttpRequest && top.CHttpRequest)
                            window.CHttpRequest = top.CHttpRequest;
                        if (!window.CHttpRequest)
                            BX.loadScript('/bitrix/js/main/admin_tools.js?v=1560930774');

                        if (!window.jsAjaxUtil && top.jsAjaxUtil)
                            window.jsAjaxUtil = top.jsAjaxUtil;
                        if (!window.jsAjaxUtil)
                            BX.loadScript('/bitrix/js/main/ajax.js?v=1560930773');
                        window._mlUserSettings = window._mlUserSettings || {width: 600, height: 450, coll_id: 0}

                        var oConfig =
                            {
                                sessid: "2b7f09d039b92367910c89e1e2254388",
                                thumbWidth : 140,
                                thumbHeight : 105,
                                userSettings : window._mlUserSettings,
                                resType: "FUNCTION",
                                Types : [{'id':'1','code':'image','name':'Изображения','ext':'jpg,jpeg,gif,png','system':true,'desc':'Фотографии, картинки, иконки, рисунки и другие графические файлы','type_icon':'/bitrix/images/fileman/medialib/type_image.gif','empty':false},{'id':'2','code':'video','name':'Видео','ext':'flv,mp4,wmv','system':true,'desc':'Видеофайлы','type_icon':'/bitrix/images/fileman/medialib/type_video.gif','empty':true},{'id':'3','code':'sound','name':'Аудио','ext':'mp3,wma,aac','system':true,'desc':'Аудиофайлы','type_icon':'/bitrix/images/fileman/medialib/type_sound.gif','empty':true}],
                                arResultDest : {'FUNCTION_NAME':'SetValueFromMedialibbx_file_detail_picture'},
                                rootAccess: {
                                    new_col: '1',
                                    edit: '1',
                                    del: '1',
                                    new_item: '1',
                                    edit_item: '1',
                                    del_item: '1',
                                    access: '1'
                                },
                                bCanUpload: true,
                                bCanViewStructure: true,
                                strExt : "jpg,jpeg,gif,png,flv,mp4,wmv,wma,mp3,ppt,aac",
                                lang : "ru",
                                description_id : ''
                            };

                        window.oBXMedialib = new BXMediaLib(oConfig);
                        oBXMedialib.Open();
                    };
                </script>
                <script>
                    var mess_SESS_EXPIRED = 'Ошибка файлового диалога: Сессия пользователя истекла';
                    var mess_ACCESS_DENIED = 'Ошибка файлового диалога: У вас недостаточно прав для использования диалога выбора файла';
                    window.OpenFileDialogbx_file_detail_picture = function(bLoadJS, Params)
                    {
                        if (!Params)
                            Params = {};

                        var UserConfig;
                        UserConfig =
                            {
                                site : 'ru',
                                path : '/upload',
                                view : "list",
                                sort : "type",
                                sort_order : "asc"
                            };
                        if (!window.BXFileDialog)
                        {
                            if (bLoadJS !== false)
                                BX.loadScript('/bitrix/js/main/file_dialog.js?15609307747313');
                            return setTimeout(function(){window['OpenFileDialogbx_file_detail_picture'](false, Params)}, 50);
                        }

                        var oConfig =
                            {
                                submitFuncName : 'OpenFileDialogbx_file_detail_pictureResult',
                                select : 'F',
                                operation: 'O',
                                showUploadTab : true,
                                showAddToMenuTab : false,
                                site : 'ru',
                                path : '/upload',
                                lang : 'ru',
                                fileFilter : '',
                                allowAllFiles : true,
                                saveConfig : true,
                                sessid: "2b7f09d039b92367910c89e1e2254388",
                                checkChildren: true,
                                genThumb: true,
                                zIndex: 2500				};

                        if(window.oBXFileDialog && window.oBXFileDialog.UserConfig)
                        {
                            UserConfig = oBXFileDialog.UserConfig;
                            oConfig.path = UserConfig.path;
                            oConfig.site = UserConfig.site;
                        }

                        if (Params.path)
                            oConfig.path = Params.path;
                        if (Params.site)
                            oConfig.site = Params.site;

                        oBXFileDialog = new BXFileDialog();
                        oBXFileDialog.Open(oConfig, UserConfig);
                    };
                    window.OpenFileDialogbx_file_detail_pictureResult = function(filename, path, site, title, menu)
                    {
                        path = jsUtils.trim(path);
                        path = path.replace(/\\/ig,"/");
                        path = path.replace(/\/\//ig,"/");
                        if (path.substr(path.length-1) == "/")
                            path = path.substr(0, path.length-1);
                        var full = (path + '/' + filename).replace(/\/\//ig, '/');
                        if (path == '')
                            path = '/';

                        var arBuckets = [];
                        if(arBuckets[site])
                        {
                            full = arBuckets[site] + filename;
                            path = arBuckets[site] + path;
                        }

                        if ('F' == 'D')
                            name = full;

                        SetValueFromFileDialogbx_file_detail_picture(filename, path, site, title || '', menu || '');							};
                </script>
                <div class="adm-fileinput-wrapper adm-fileinput-wrapper-single">
                    <div class="adm-fileinput-btn-panel">
                        <span class="adm-btn add-file-popup-btn" id="bx_file_detail_picture_add"></span>
                        <div class="adm-fileinput-mode mode-pict" id="bx_file_detail_picture_mode">
                            <a href="#" class="mode-pict" id="bx_file_detail_pictureThumbModePreview" title="Показывать картинки"></a>
                            <a href="#" class="mode-file" id="bx_file_detail_pictureThumbModeNonPreview" title="Показывать иконки"></a>
                        </div>
                    </div>
                    <div id="bx_file_detail_picture_block" class="adm-fileinput-area mode-pict adm-fileinput-drag-area" dropzone="copy f:*/*">
                        <div class="adm-fileinput-area-container" id="bx_file_detail_picture_container"></div>
                        <span class="adm-fileinput-drag-area-hint" id="bx_file_detail_pictureNotice">(Drag&amp;Drop) <br> Перетащите картинку</span>
                        <script>
                            (function(BX)
                            {
                                if (BX)
                                {
                                    BX.ready(BX.defer(function(){
                                        new BX.UI.FileInput('bx_file_detail_picture', {'upload':'YTozOntzOjI6ImlkIjtzOjQ6InBhdGgiO3M6MTE6ImFsbG93VXBsb2FkIjtzOjE6IkkiO3M6MTQ6ImFsbG93VXBsb2FkRXh0IjtzOjA6IiI7fQ==.8a18e3cee63ee512d203dbd5255e5c53ec5c0c3d214e11182ef939f3678b9e2f','uploadType':'path','medialib':{'click':'OpenMedialibDialogbx_file_detail_picture','handler':'SetValueFromMedialibbx_file_detail_picture'},'fileDialog':{'click':'OpenFileDialogbx_file_detail_picture','handler':'SetValueFromFileDialogbx_file_detail_picture'},'cloud':false,'maxCount':'1','maxSize':'0','allowUpload':'I','allowUploadExt':'','allowSort':'Y','frameFiles':'N','pinDescription':'N','mode':'mode-pict','presets':[{'width':'200','height':'200','title':'200x200'}],'presetActive':'0','maxIndex':'0'}, {'name':'DETAIL_PICTURE','description':true,'delete':true,'edit':true,'thumbSize':'640'}, [], '<div class=\"adm-fileinput-item\"><div class=\"adm-fileinput-item-preview\"><span class=\"adm-fileinput-item-loading\"><span class=\"container-loading-title\">Идёт загрузка...<\/span><span class=\"container-loading-bg\"><span class=\"container-loading-bg-progress\" style=\"width: 5%;\" id=\"#id#Progress\"><\/span><\/span><\/span><div class=\"adm-fileinput-item-preview-icon\"><div class=\"bx-file-icon-container-medium icon-#ext#\"><div class=\"bx-file-icon-cover\"><div class=\"bx-file-icon-corner\"><div class=\"bx-file-icon-corner-fix\"><\/div><\/div><div class=\"bx-file-icon-images\"><\/div><\/div><div class=\"bx-file-icon-label\"><\/div><\/div><span class=\"container-doc-title\" id=\"#id#Name\">#name#<\/span><\/div><div class=\"adm-fileinput-item-preview-img\">#preview#<\/div><input class=\"bx-bxu-fileinput-value\" type=\"hidden\" id=\"#id#Value\" name=\"DETAIL_PICTURE\" value=\"\" /><\/div><input type=\"text\" id=\"#id#Description\" name=\"DETAIL_PICTURE_descr\" value=\"#description#\" class=\"adm-fileinput-item-description\" /><div class=\"adm-fileinput-item-panel\"><span class=\"adm-fileinput-item-panel-btn adm-btn-setting\" id=\"#id#Edit\">&nbsp;<\/span><span class=\"adm-fileinput-item-panel-btn adm-btn-del\" id=\"#id#Del\">&nbsp;<\/span><\/div><div id=\"#id#Properties\" class=\"adm-fileinput-item-properties\"><\/div><\/div>');
                                    }));
                                }
                            })(window["BX"] || top["BX"]);
                        </script>
                        <input class="adm-fileinput-drag-area-input" type="file" id="bx_file_detail_picture_input" data-fileinput="Y" name="bxu_files[]" accept="image/*"></div>
                </div>					</td>
        </tr>
        <?
    }
}