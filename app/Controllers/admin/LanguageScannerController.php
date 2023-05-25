<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Gettext\Translation;
use Gettext\Loader\PoLoader;
use Gettext\Loader\JsonLoader;
use Gettext\Generator\JsonGenerator;
use Gettext\Translations;
use Gettext\GettextTranslator;

class LanguageScannerController extends BaseController
{
    public function index()
    {
        //Create a new instance
        $t = new GettextTranslator();

        //It detects the environment variables to set the locale, but you can change it:
        $t->setLanguage('gl');

        //Load the domains:
        $t->loadDomain('messages', 'project/Locale');
        //this means you have the file "project/Locale/gl/LC_MESSAGES/messages.mo"

        //Now you can use it in your templates
        echo $t->gettext('apple');
    }
}
