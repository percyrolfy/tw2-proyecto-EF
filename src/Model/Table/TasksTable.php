<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tasks Model
 *
 * @method \App\Model\Entity\Task newEmptyEntity()
 * @method \App\Model\Entity\Task newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Task get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Task patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Task|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 */
class TasksTable extends Table
{
    public const ESTADO_PENDIENTE = 'pendiente';
    public const ESTADO_EN_PROGRESO = 'en_progreso';
    public const ESTADO_COMPLETADA = 'completada';

    /**
     * @return array<string, string>
     */
    public static function estadosDisponibles(): array
    {
        return [
            self::ESTADO_PENDIENTE => __('Pending'),
            self::ESTADO_EN_PROGRESO => __('In progress'),
            self::ESTADO_COMPLETADA => __('Completed'),
        ];
    }

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tasks');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 255)
            ->requirePresence('titulo', 'create')
            ->notEmptyString('titulo');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('estado')
            ->maxLength('estado', 50)
            ->requirePresence('estado', 'create')
            ->notEmptyString('estado')
            ->inList('estado', array_keys(static::estadosDisponibles()));

        $validator
            ->dateTime('fecha_limite')
            ->allowEmptyDateTime('fecha_limite');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
