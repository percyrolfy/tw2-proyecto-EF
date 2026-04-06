<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bicicletas Model
 *
 * @method \App\Model\Entity\Bicicleta newEmptyEntity()
 * @method \App\Model\Entity\Bicicleta newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Bicicleta> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bicicleta get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Bicicleta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Bicicleta> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bicicleta|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Bicicleta saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Bicicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Bicicleta>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Bicicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Bicicleta> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Bicicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Bicicleta>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Bicicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Bicicleta> deleteManyOrFail(iterable $entities, array $options = [])
 */
class BicicletasTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bicicletas');
        $this->setDisplayField('modelo');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 50)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->scalar('material')
            ->maxLength('material', 50)
            ->allowEmptyString('material');

        $validator
            ->integer('tamaño_rueda')
            ->allowEmptyString('tamaño_rueda');

        $validator
            ->scalar('modelo')
            ->maxLength('modelo', 50)
            ->allowEmptyString('modelo');

        $validator
            ->decimal('precio')
            ->allowEmptyString('precio');

        return $validator;
    }
}

