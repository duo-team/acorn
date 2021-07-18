<?php

namespace DuoTeam\Acorn\Database\Models\Post;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DuoTeam\Acorn\Database\Support;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $ID
 * @property int $post_author
 * @property Carbon $post_date
 * @property Carbon $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $post_excerpt
 * @property string $post_status
 * @property string $comment_status
 * @property string $ping_status
 * @property string $post_password
 * @property string $post_name
 * @property string $to_ping
 * @property string $pinged
 * @property Carbon $post_modified
 * @property Carbon $post_modified_gmt
 * @property string $post_content_filtered
 * @property int $post_parent
 * @property string $guid
 * @property int $menu_order
 * @property string $post_type
 * @property string $post_mime_type
 * @property int $comment_count
 *
 * @property Collection|PostMeta[] $meta
 */
class Post extends Model
{
    use Support\HasPostTimestamps;

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = 'post_date';

    /**
     * The name of the "created at" column in GMT.
     *
     * @var string|null
     */
    const CREATED_AT_GMT = 'post_date_gmt';

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = 'post_modified';

    /**
     * The name of the "updated at" column in GMT.
     *
     * @var string|null
     */
    const UPDATED_AT_GMT = 'post_modified_gmt';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'post_date' => 'date',
        'post_date_gmt' => 'date',
        'post_modified' => 'date',
        'post_modified_gmt' => 'date',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_author',
        'post_date',
        'post_date_gmt',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'post_password',
        'post_name',
        'to_ping',
        'pinged',
        'post_modified',
        'post_modified_gmt',
        'post_content_filtered',
        'post_parent',
        'guid',
        'menu_order',
        'post_type',
        'post_mime_type',
        'comment_count'
    ];

    /**
     * Set the value of the "created at" attribute.
     *
     * @param mixed $value
     * @return $this
     */
    public function setCreatedAt($value): self
    {
        parent::setCreatedAt($value);
        $this->{$this->getCreatedAtGmtColumn()} = Carbon::parse($value)->utc();

        return $this;
    }

    /**
     * Set the value of the "updated at" attribute.
     *
     * @param mixed $value
     * @return $this
     */
    public function setUpdatedAt($value): self
    {
        parent::setUpdatedAt($value);
        $this->{$this->getUpdatedAtGmtColumn()} = Carbon::parse($value)->utc();

        return $this;
    }

    /**
     * Get post related meta.
     *
     * @return HasMany
     */
    public function meta(): HasMany
    {
        return $this->hasMany(PostMeta::class, 'post_id', 'ID');
    }
}