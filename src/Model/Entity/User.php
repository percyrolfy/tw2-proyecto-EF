<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property string|null $password
 * @property string|null $lenguaje
 * @property int|null $edad
 */
class User extends Entity
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
        'nombre' => true,
        'apellido' => true,
        'correo' => true,
        'created' => true,
        'modified' => true,
        'password' => true,
        'lenguaje' => true,
        'edad' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];

    /**
     * Hashea la contraseña en alta/edición; cadenas vacías no se transforman aquí.
     *
     * @param string|null $password Valor enviado en el formulario.
     * @return string|null
     */
    protected function _setPassword(?string $password): ?string
    {
        if ($password === null || $password === '') {
            return $password;
        }

        return password_hash($password, PASSWORD_DEFAULT);
    }
}
