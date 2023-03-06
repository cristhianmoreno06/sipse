<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Kid
 *
 * @property int $id
 * @property string $first_name
 * @property string $second_first_name
 * @property string $first_surname
 * @property string $second_surname
 * @property int $identification_number
 * @property string $gender
 * @property string $date_of_birth
 * @property int $course_id Identificador del curso al que ingresa el niño
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Database\Factories\KidFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kid newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kid query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereFirstSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereIdentificationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereSecondFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereSecondSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kid whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Kid extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return hasMany
     */
    public function course(): hasMany
    {
        return $this->hasMany(Course::class, 'id', 'course_id');
    }
}
