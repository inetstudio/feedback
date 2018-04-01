<?php

namespace InetStudio\Feedback\Models;

use App\User;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * InetStudio\Feedback\Models\FeedbackModel.
 *
 * @property int $id
 * @property int $is_read
 * @property string $user_id
 * @property string $name
 * @property string $email
 * @property string|null $message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\InetStudio\Feedback\Models\FeedbackModel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel unread()
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Feedback\Models\FeedbackModel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\InetStudio\Feedback\Models\FeedbackModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\InetStudio\Feedback\Models\FeedbackModel withoutTrashed()
 * @mixin \Eloquent
 */
class FeedbackModel extends Model
{
    use Notifiable;
    use Searchable;
    use SoftDeletes;

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'feedback';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'is_read', 'user_id', 'name', 'email', 'message',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Настройка полей для поиска.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $arr = array_only($this->toArray(), [
            'id', 'user_id', 'name', 'email', 'message',
        ]);

        return $arr;
    }

    /**
     * Заготовка запроса "Непрочитанные сообщения".
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    /**
     * Обратное отношение с моделью пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
