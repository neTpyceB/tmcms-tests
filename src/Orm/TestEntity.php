<?php
declare(strict_types=1);

namespace TMCms\Tests\Orm;

use TMCms\Orm\Entity;

/**
 * Class TestEntity
 * @package TMCms\Tests\Orm
 *
 * @method string getDescription()
 * @method string getTitle()
 *
 * @method $this setDate(int $time_stamp)
 * @method $this setDescription(array | string $description)
 * @method $this setTitle(string $title)
 */
class TestEntity extends Entity
{
    protected $db_table = 'm_entity_tests';
    protected $translation_fields = ['title', 'description'];
}