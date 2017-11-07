<?php
declare(strict_types=1);

namespace TMCms\Tests\Orm;

use TMCms\Orm\EntityRepository;
use TMCms\Orm\TableStructure;

class TestEntityRepository extends EntityRepository
{
    protected $db_table = 'm_entity_tests';
    protected $translation_fields = ['title', 'description'];
    protected $table_structure = [
        'fields' => [
            'date'        => [
                'type' => TableStructure::FIELD_TYPE_UNSIGNED_INTEGER,
            ],
            'title'       => [
                'type' => TableStructure::FIELD_TYPE_TRANSLATION,
            ],
            'description' => [
                'type' => TableStructure::FIELD_TYPE_TRANSLATION,
            ],
        ],
    ];
}
