<?php
declare(strict_types=1);

namespace TMCms\Tests\Orm;

use TMCms\Orm\EntityRepository;

class TestEntityRepository extends EntityRepository
{
    protected $db_table = 'm_entity_tests';
    protected $translation_fields = ['title', 'description'];
    protected $table_structure = [
        'fields' => [
            'date'        => [
                'type' => 'ts',
            ],
            'title'       => [
                'type' => 'translation',
            ],
            'description' => [
                'type' => 'translation',
            ],
        ],
    ];
}