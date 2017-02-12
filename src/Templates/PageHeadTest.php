<?php

namespace TMCms\Tests\Templates;

use TMCms\Admin\Entity\LanguageEntity;
use TMCms\Admin\Entity\LanguageEntityRepository;
use TMCms\Admin\Structure\Entity\PageEntity;
use TMCms\Admin\Structure\Entity\PageEntityRepository;
use TMCms\Admin\Structure\Entity\PageTemplateEntity;
use TMCms\Admin\Structure\Entity\PageTemplateEntityRepository;
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

        // Pre-create tables
        new LanguageEntityRepository();
        new PageTemplateEntityRepository();
        new PageEntityRepository();

        // Create fake language
        $language = new LanguageEntity();
        $language->loadDataFromArray([
            'short' => 'xx',
            'long' => 'XXXX'
        ]);
        $language->findAndLoadPossibleDuplicateEntityByFields(['short']);
        $language->save();

        // Create template
        $template = new PageTemplateEntity();
        $template->setFile('xx.xx');
        $template->findAndLoadPossibleDuplicateEntityByFields(['file']);
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
        $page->findAndLoadPossibleDuplicateEntityByFields(['location', 'pid']);
        $page->save();
    }

    public function tearDown()
    {
        // Delete xx page, template and language


        // Create fake language
        $language = new LanguageEntity();
        $language->loadDataFromArray([
            'short' => 'xx',
            'long' => 'XXXX'
        ]);
        $language->findAndLoadPossibleDuplicateEntityByFields(['short']);
        $language->deleteObject();

        // Create template
        $template = new PageTemplateEntity();
        $template->setFile('xx.xx');
        $template->findAndLoadPossibleDuplicateEntityByFields(['file']);
        $template->deleteObject();

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
        $page->findAndLoadPossibleDuplicateEntityByFields(['location', 'pid']);
        $page->deleteObject();
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