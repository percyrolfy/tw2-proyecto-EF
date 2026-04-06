<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $titulo
 * @property string|null $descripcion
 * @property string $estado
 * @property \Cake\I18n\DateTime|null $fecha_limite
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property \App\Model\Entity\User|null $user
 */
class Task extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'titulo' => true,
        'descripcion' => true,
        'estado' => true,
        'fecha_limite' => true,
        'user_id' => false,
    ];
}
