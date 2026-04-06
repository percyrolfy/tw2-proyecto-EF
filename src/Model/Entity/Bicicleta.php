<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bicicleta Entity
 *
 * @property int $id
 * @property string $tipo
 * @property string|null $material
 * @property int|null $tamaño_rueda
 * @property string|null $modelo
 * @property string|null $precio
 * @property \Cake\I18n\DateTime|null $fecha_registro
 */
class Bicicleta extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'tipo' => true,
        'material' => true,
        'tamaño_rueda' => true,
        'modelo' => true,
        'precio' => true,
        'fecha_registro' => true,
    ];
}

