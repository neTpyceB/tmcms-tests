<?php
declare(strict_types=1);

namespace TMCms\Tests\Admin;

use function stripos;
use TMCms\Admin\Menu;

class MenuTest extends \PHPUnit_Framework_TestCase
{
    protected $menu_item = [
        'title' => 'Test item'
    ];

    public function testDisableMenu()
    {
        $menu = Menu::getInstance();
        $menu->disableMenu();

        $this->assertFalse($menu->isMenuEnabled());
    }

    public function test__toStringThrowsNoErrors()
    {
        $menu = (string)Menu::getInstance();

        $this->assertFalse(stripos('error', $menu));
        $this->assertFalse(stripos('exception', $menu));

    }

    public function testGetMenuHeaderView()
    {
        // Test no auth
        $menu = Menu::getInstance();
        $header = $menu->getMenuHeaderView();

        $this->assertFalse(stripos('error', $header));
        $this->assertFalse(stripos('exception', $header));

        // Test authorized
        if (!defined('USER_ID')) {
            define('USER_ID', 1);
        }
        if (!defined('P')) {
            define('P', 'guest');
        }

        $menu = Menu::getInstance();
        $header = $menu->getMenuHeaderView();

        $this->assertFalse(stripos('error', $header));
        $this->assertFalse(stripos('exception', $header));
    }

    public function testMayAddItemsFlag()
    {
        $menu = Menu::getInstance();
        $menu->setMayAddItemsFlag(false);

        $this->assertFalse($menu->isAddingItemsAllowed());
    }

    public function testAddMenuSeparator()
    {
        $menu = Menu::getInstance();
        $res = $menu->addMenuSeparator('test');

        $this->assertEquals($menu, $res);
    }

    public function testAddMenuItem()
    {
        $menu = Menu::getInstance();
        $res = $menu->addMenuItem('test', $this->menu_item);

        $this->assertEquals($menu, $res);
    }

    public function testAddSubMenuItem()
    {
        // Test-related
        if (!defined('P')) {
            define('P', 'guest');
        }

        $menu = Menu::getInstance();
        $res = $menu->addSubMenuItem('_default');

        $this->assertEquals($menu, $res);
    }

    public function testAddMultipleItems()
    {
        // Test-related
        if (!defined('P')) {
            define('P', 'guest');
        }

        $menu = Menu::getInstance();

        $menu->addMenuItem('tools', $this->menu_item);
        $menu->addSubMenuItem('_default');
        $menu->addSubMenuItem('login');
        $menu->addHelpText('Help text');
        $menu->setMayAddItemsFlag(false);
        $menu->addMenuItem('users', $this->menu_item);
        $menu->addSubMenuItem('item');
        $menu->addSubMenuItem('_default');
        $menu->addSubMenuItem('exit');
        $menu->setMayAddItemsFlag(true);
        $menu->addMenuItem('third', $this->menu_item);
        $menu->addLabelForMenuItem('Label text', '_default', 'guest');
        $menu->addSubMenuItem('_default');
        $menu->addSubMenuItem('exit');

        $res = $menu->addMenuItem('guest', $this->menu_item);


        $this->assertEquals($menu, $res);
    }

    public function testSetAddingFlag()
    {
        $menu = Menu::getInstance();
        $res = $menu->setMayAddItemsFlag(false);

        $this->assertEquals($menu, $res);
    }

    public function testGetPageTitle()
    {
        $radnom_string = 'random_string';

        $menu = Menu::getInstance();
        $res = $menu->setPageTitle($radnom_string);

        $this->assertEquals($radnom_string, $menu->getPageTitle());
    }

    public function testGetPageDescription()
    {
        $radnom_string = 'random_string';

        $menu = Menu::getInstance();
        $res = $menu->setPageDescription($radnom_string);

        $this->assertEquals($radnom_string, $menu->getPageDescription());
    }
}