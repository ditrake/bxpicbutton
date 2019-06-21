<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Application;
use \Bitrix\Main\EventManager;

Loc::loadMessages(__FILE__);

class ditrake_bxpicbutton extends CModule
{
    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_ID = 'ditrake.bxpicbutton';
        $this->MODULE_NAME = Loc::getMessage('BX_CONTENT_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('BX_CONTENT_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = Loc::getMessage('BX_CONTENT_MODULE_PARTNER_NAME');
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installFiles();
        $this->installDB();
    }

    public function doUninstall()
    {
        $this->unInstallFiles();
        $this->uninstallDB();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    /**
     * Вносит в базу данных изменения, требуемые модулем
     *
     * @return bool
     */
    public function installDB()
    {
        $eventManager = EventManager::getInstance();

        $eventManager->registerEventHandler(
            'fileman',
            'OnBeforeHTMLEditorScriptRuns',
            'ditrake.bxpicbutton',
            'ditrake\bxpicbutton\HtmlEditorPictureButton',
            'OnBeforeHTMLEditorScriptRuns'
        );

        return true;
    }

    /**
     * Удаляет из базы данных изменения, требуемые модулем
     *
     * @return bool
     */
    public function uninstallDB()
    {
        $eventManager = EventManager::getInstance();

        $eventManager->unRegisterEventHandler(
            'fileman',
            'OnBeforeHTMLEditorScriptRuns',
            'ditrake.bxpicbutton',
            'ditrake\bxpicbutton\HtmlEditorPictureButton',
            'OnBeforeHTMLEditorScriptRuns'
        );

        return true;
    }

    /**
     * Копирует файлы модуля в битрикс
     *
     * @return bool
     */
    public function installFiles()
    {
        CopyDirFiles(
            $this->getInstallatorPath() . '/tools/js',
            Application::getDocumentRoot() . '/bitrix/tools/' . $this->MODULE_ID."/js",
            true,
            true
        );
        return true;
    }

    /**
     * Удаляет файлы модуля из битрикса.
     *
     * @return bool
     */
    public function unInstallFiles()
    {
        Directory::deleteDirectory(Application::getDocumentRoot() . '/bitrix/tools/' . $this->MODULE_ID);
        return true;
    }


    /**
     * Возвращает путь к папке с модулем
     *
     * @return string
     */
    public function getInstallatorPath()
    {
        return str_replace('\\', '/', __DIR__);
    }
}