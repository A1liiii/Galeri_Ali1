<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gallery Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $album_id
 * @property string $title
 * @property string $desk
 * @property \Cake\I18n\DateTime $date
 * @property string $lockfile
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Album $album
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Like[] $likes
 */
class Gallery extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'album_id' => true,
        'title' => true,
        'desk' => true,
        'date' => true,
        'lockfile' => true,
        'user' => true,
        'album' => true,
        'comments' => true,
        'likes' => true,
    ];

    public function isLiked($userId)
    {
        foreach ($this->likes as $like) {
            if ($like->user_id == $userId) {
                return $like;
            }
        }
        return false;
    }
    
}
