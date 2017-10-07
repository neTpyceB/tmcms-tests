<?php
declare(strict_types=1);

namespace TMCms\Tests\Admin;

use TMCms\Admin\AdminLanguages;
use TMCms\Admin\Entity\LanguageEntityRepository;

class AdminLanguagesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPairs()
    {
        $pairs = AdminLanguages::getPairs();

        $this->assertTrue(is_array($pairs));
        $this->assertTrue(count($pairs) > 0);
        $this->assertArrayHasKey(LanguageEntityRepository::ADMIN_LANGUAGE_DEFAULT_SHORT, $pairs);
    }
}
