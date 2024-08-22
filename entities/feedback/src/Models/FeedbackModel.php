<?php

namespace InetStudio\FeedbackPackage\Feedback\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;

/**
 * Class FeedbackModel.
 */
class FeedbackModel extends Model implements FeedbackModelContract
{
    use Notifiable;
    use SoftDeletes;
    use BuildQueryScopeTrait;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'feedback';

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
        'is_read',
        'user_id',
        'name',
        'email',
        'phone',
        'message',
        'response',
        'feedbackable_type',
        'feedbackable_id',
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
     * Загрузка модели.
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id',
            'is_read',
            'user_id',
            'name',
            'email',
            'phone',
            'message',
            'response',
            'feedbackable_type',
            'feedbackable_id',
        ];
    }

    /**
     * Сеттер атрибута is_read.
     *
     * @param $value
     */
    public function setIsReadAttribute($value): void
    {
        $this->attributes['is_read'] = (bool) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута user_id.
     *
     * @param $value
     */
    public function setUserIdAttribute($value): void
    {
        $this->attributes['user_id'] = (int) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута name.
     *
     * @param $value
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута email.
     *
     * @param $value
     */
    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута phone.
     *
     * @param $value
     */
    public function setEmailAttribute($value): void
    {
        $this->attributes['phone'] = ($value) ? trim(str_replace(['+', '-', '(', ')', ' '], '', (string) $value)) : null;
    }

    /**
     * Сеттер атрибута message.
     *
     * @param $value
     */
    public function setMessageAttribute($value): void
    {
        $value = (isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : '');

        $this->attributes['message'] = trim(str_replace('&nbsp;', ' ', strip_tags($value)));
    }

    /**
     * Сеттер атрибута response.
     *
     * @param $value
     */
    public function setResponseAttribute($value): void
    {
        $value = (isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : '');

        $this->attributes['response'] = trim(str_replace('&nbsp;', ' ', strip_tags($value)));
    }

    /**
     * Сеттер атрибута feedbackable_type.
     *
     * @param $value
     */
    public function setFeedbackableTypeAttribute($value): void
    {
        $this->attributes['feedbackable_type'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута feedbackable_id.
     *
     * @param $value
     */
    public function setFeedbackableIdAttribute($value): void
    {
        $this->attributes['feedbackable_id'] = (int) trim(strip_tags($value));
    }

    /**
     * Геттер атрибута type.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }

    /**
     * Заготовка запроса "Непрочитанные сообщения".
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    use HasUser;

    /**
     * Полиморфное отношение с остальными моделями.
     *
     * @return MorphTo
     */
    public function feedbackable(): MorphTo
    {
        return $this->morphTo();
    }
}
