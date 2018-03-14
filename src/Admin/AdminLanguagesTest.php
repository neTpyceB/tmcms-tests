<?php
declare(strict_types=1);

namespace TMCms\Tests\Admin;

use TMCms\Admin\AdminLanguages;
use TMCms\Admin\Entity\LanguageEntityRepository;
use TMCms\Config\Constants;

/**
 * Class AdminLanguagesTest
 * @package TMCms\Tests\Admin
 */
class AdminLanguagesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPairs()
    {
        $pairs = AdminLanguages::getPairs();

        static::assertInternalType('array', $pairs);
        static::assertTrue(\count($pairs) > 0);
        static::assertArrayHasKey(Constants::ADMIN_LANGUAGE_DEFAULT_SHORT, $pairs);
    }
}
