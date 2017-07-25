<?php

namespace TMCms\Tests\Orm;

use TMCms\Routing\Languages;

define('TEST_PAGE_ID', 999999999);

class EntityTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!defined('LNG')) {
            define('LNG', 'en');
        }

        // Ensure db exists
        new TestEntityRepository();
    }

    public function testSaveTranslationData()
    {
        $test_title = 'test_title_for_lng_' . LNG;
        $test_description = 'Some kind of text';

        $languages = Languages::getPairs();
        $desrc_array = [];
        foreach ($languages as $short => $full) {
            $desrc_array[$short] = $test_description . $short;
        }

        $entity = new TestEntity();
        $entity->debug = true;
        $entity->setDate(NOW);
        $entity->setTitle($test_title);
        $entity->setDescription($desrc_array);

        $entity->save();

        $id = $entity->getId();

        $entity = new TestEntity($id);

        $this->assertEquals($test_title, $entity->getTitle());
        $this->assertEquals($test_description . LNG, $entity->getDescription());


        $entity->setTitle($test_title . '2');
        $entity->setDescription([
            'en' => $test_description . '2',
            'ru' => $test_description . '2',
        ]);
        $this->assertEquals($test_title . '2', $entity->getTitle());
        $this->assertEquals($test_description . '2', $entity->getDescription());
    }
}