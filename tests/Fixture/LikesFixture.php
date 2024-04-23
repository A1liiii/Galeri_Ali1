<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LikesFixture
 */
class LikesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'gallery_id' => 1,
                'user_id' => 1,
                'date' => '2024-04-22 01:51:01',
            ],
        ];
        parent::init();
    }
}
