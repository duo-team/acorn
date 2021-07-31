<?php

namespace DuoTeam\Acorn\Database\Models\Taxonomy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property int $term_id
 * @property string $name
 * @property string $slug
 * @property int $term_group
 *
 * @property Collection|TermMeta[] $meta
 * @property TermTaxonomy $taxonomy
 */
class Term extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'terms';

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
        'name',
        'slug',
        'term_group'
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * Get all related term meta.
     *
     * @return HasMany
     */
    public function meta(): HasMany
    {
        return $this->hasMany(TermMeta::class, 'term_id', 'term_id');
    }

    /**
     * Get related taxonomy.
     *
     * @return HasOne
     */
    public function taxonomy(): HasOne
    {
        return $this->hasOne(TermTaxonomy::class, 'term_id', 'term_id');
    }
}