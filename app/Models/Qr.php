<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Qr
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $content
 * @property int|null $size
 * @property string|null $background_color
 * @property string|null $fill_color
 * @property string|null $path
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User|null $user
 * @package App\Models
 * @property-read mixed $status_value
 * @method static \Illuminate\Database\Eloquent\Builder|Qr active()
 * @method static \Illuminate\Database\Eloquent\Builder|Qr available()
 * @method static \Database\Factories\QrFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr hidden()
 * @method static \Illuminate\Database\Eloquent\Builder|Qr newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Qr newQuery()
 * @method static \Illuminate\Database\Query\Builder|Qr onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Qr query()
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereFillColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qr whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Qr withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Qr withoutTrashed()
 */
class Qr extends Model
{
	use SoftDeletes;
	use HasFactory;
	protected $table = 'qrs';

	protected $casts = [
		'user_id' => 'int',
		'size' => 'int'
	];

	protected $fillable = [
		'user_id',
		'content',
		'size',
		'background_color',
		'fill_color',
		'path'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
