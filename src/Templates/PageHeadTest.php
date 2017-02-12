<?php

namespace Tests\TMCms\Templates;

use TMCms\Admin\Entity\LanguageEntity;
use TMCms\Admin\Structure\Entity\PageEntity;
use TMCms\Admin\Structure\Entity\PageTemplateEntity;
use TMCms\App\Frontend;
use TMCms\Cache\Cacher;
use TMCms\Files\MimeTypes;
use TMCms\Templates\PageHead;

class PageHeadTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function setUp()
    {
        Cacher::getInstance()->clearAllCaches();

        // Create fake language
        $language = new LanguageEntity();
        $language->loadDataFromArray([
            'short' => 'xx',
            'long' => 'XXXX'
        ]);
        $language->preventDuplicateByFields(['short']);
        $language->save();

        // Create template
        $template = new PageTemplateEntity();
        $template->setFile('xx.xx');
        $template->preventDuplicateByFields(['file']);
        $template->save();

        // Create main page for it
        $page = new PageEntity();
        $page->loadDataFromArray([
            'template_id' => $template->getId(),
            'pid' => 0,
            'location' => 'xx',
            'title' => 'XXXX',
            'in_menu' => 1,
            'active' => 1,
            'string_label' => 'xx',
            'menu_name' => 'main',
            'lastmod_ts' => NOW,
        ]);
        $page->preventDuplicateByFields(['location', 'pid']);
        $page->save();
    }

    public function tearDown()
    {
        // Delete xx page and language
    }


    public function testsetHtmlTagAttributes()
    {
        PageHead::getInstance()
            ->addHtmlTagAttributes('īs_body');

        $html = Frontend::getInstance();

        $this->assertTrue(stripos($html, 'īs_body') !== false);
    }

    public function testGetMimeTypes()
    {
        $types = MimeTypes::getMimeTypes();

        $this->assertTrue(is_array($types));
    }

    public function testGetExtByMimeType()
    {
        $res = MimeTypes::getExtByMimeType('application/pdf');

        $this->assertEquals('pdf', $res);
    }
}