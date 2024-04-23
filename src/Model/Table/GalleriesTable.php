<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Galleries Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AlbumsTable&\Cake\ORM\Association\BelongsTo $Albums
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 * @property \App\Model\Table\LikesTable&\Cake\ORM\Association\HasMany $Likes
 *
 * @method \App\Model\Entity\Gallery newEmptyEntity()
 * @method \App\Model\Entity\Gallery newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Gallery> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gallery get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Gallery findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Gallery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Gallery> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gallery|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Gallery saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery> deleteManyOrFail(iterable $entities, array $options = [])
 */
class GalleriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('galleries');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'gallery_id',
        ]);
        $this->hasMany('Likes', [
            'foreignKey' => 'gallery_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('album_id')
            ->notEmptyString('album_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('desk')
            ->requirePresence('desk', 'create')
            ->notEmptyString('desk');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        $validator
            ->scalar('lockfile')
            ->maxLength('lockfile', 100)
            ->requirePresence('lockfile', 'create')
            ->notEmptyString('lockfile');

        $validator
            ->allowEmptyFile('images')
            ->requirePresence('images','create')
            ->uploadedFile('images', [
                'types'=> [
                    'image/jpg',
                    'image/png',
                    'image/jpeg',
                ],
            ], 'The File Cannot Be innput Cause File Allowed is .jpg, .png and .jpeg');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['album_id'], 'Albums'), ['errorField' => 'album_id']);

        return $rules;
    }
}
