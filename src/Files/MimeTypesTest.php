<?php

namespace TMCms\Tests\Files;

use TMCms\Files\MimeTypes;

class MimeTypesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMimeType()
    {
        $res = MimeTypes::getMimeTypeByExt('pdf');

        $this->assertEquals('application/pdf', $res);
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