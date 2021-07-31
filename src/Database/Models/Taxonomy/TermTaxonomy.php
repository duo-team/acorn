<?php

namespace DuoTeam\Acorn\Database\Models\Taxonomy;

use DuoTeam\Acorn\Database\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int $term_taxonomy_id
 * @property int $term_id
 * @property string $taxonomy
 * @property string $description
 * @property int $parent
 * @property int $count
 *
 * @property Term $term
 * @property Collection|Post[] $posts
 */
class TermTaxonomy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'term_taxonomy';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term_id',
        'taxonomy',
        'description',
        'parent',
        'count'
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'term_taxonomy_id';

    /**
     * Get related term.
     *
     * @return BelongsTo
     */
    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }

    /**
     * Get related posts.
     *
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        {
            return $this
                ->belongsToMany(
                    Post::class,
                    'term_relationships',
                    'term_taxonomy_id',
                    'object_id',
                    'term_taxonomy_id',
                    'ID'
                )
                ->withPivot(['term_order']);
        }
    }
}