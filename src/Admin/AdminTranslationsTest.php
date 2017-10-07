<?php
declare(strict_types=1);

namespace TMCms\Tests\Admin;

use TMCms\Admin\AdminTranslations;

class AdminTranslationsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetActualValueByKey()
    {
        $admin_translations = AdminTranslations::getInstance();
        $admin_translations->setOverrideLanguage('ru');

        $this->assertEquals('Главная', $admin_translations->getActualValueByKey('Main'));
    }
}
