BX.addCustomEvent('OnEditorInitedBefore', function(editor)
{
    /*Объект визуального редатора*/
    var _this=this;
    var _class = 'ditrake_htmleditor_picture_button';

    /*Описание кнопки добавляемой в визуальный редактор*/
    this.AddButton({
        iconClassName: 'bxhtmled-button-ditrake-add-img',

        /*Путь до иконки кнопки*/
        src: '/bitrix/modules/ditrake.bxpicbutton/images/icon.png',
        id: 'ditrake-add-img',

        /*Названия кнопки из языкового файла*/
        name: BX.message('DITRAKE_HTML_EDITOR_MODAL_IMAGES_TITLE'),

        /*Событие по нажатию на кнопку*/
        handler:function(e){

            /*Описание модального окна */
            var SotbitDialogAddImg = new BX.CDialog({

                /*Заголовок модального окна из языкового файла*/
                title: BX.message('SOTBIT_HTML_EDITOR_MODAL_IMAGES_TITLE'),

                /*Путь до файла контента отображаемого в модальном окне*/
                content_url: '/bitrix/tools/sotbit.htmleditoraddition/include/ajax/loadImg.php',

                /*Запрос к файлу с контентом модального окна*/
                content_post: 'ajax=yes&action=openWindow',

                min_width:400,
                min_height:400,

                /*Описание кнопок модального окна*/
                buttons: [
                    /*Описание кнопки загрузку изображений в визуальный редактор*/
                    {
                        /*Заголовок кнопки из языкового файла*/
                        title: BX.message('SOTBIT_HTML_EDITOR_MODAL_IMAGES_BTN_LOADIMG'),
                        name: 'loadImg',
                        id: 'loadImg',
                        /*Действие по нажатию на кнопку*/
                        action: function () {
                            /*Действие выполняемое по нажатию данной кнопки в части обработки изображений можно найти в данном файле script.js  модуля */

                            /*Получение контента визуального редактора*/
                            var content = _this.GetContent();

                            /*После обработки content и получения нового контента (content_new), устанавливаем новый контент в визуальный редактор*/
                            _this.SetContent(content_new, true);
                            _this.ReInitIframe();

                            /*Закрытие модального окна*/
                            _thisBtn.parentWindow.Close();

                        },

                        /*Вывод кнопки отмены в модальном окне*/
                        BX.CDialog.prototype.btnCancel,

                    }
                ]
            });

            /*Вызов модального окна описанного выше*/
            SotbitDialogAddImg.Show();
        }
    });

});