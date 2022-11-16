<?php

namespace App\Http\Services\Traits;

use App\Models\Skill;
use ArrayAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use InvalidArgumentException;

trait HasTags
{
    protected array $queuedTags = [];

    public static function getTagClassName(): string
    {
        return Skill::class;
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'skillable');
    }

    /**
     * @param array|\ArrayAccess|\App\Models\Skill $tags
     * @param string|null $type
     * @return $this
     */
    public function attachTags($tags, string $type = null)
    {
        $className = static::getTagClassName();

        $tags = collect($className::findOrCreate($tags, $type));

        $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        return $this;
    }

    /**
     * @param string|\App\Models\Skill $tag
     *
     * @param string|null $type
     * @return $this
     */
    public function attachTag($tag, string $type = null)
    {
        return $this->attachTags([$tag], $type);
    }

    public function syncTag($tags)
    {
        $className = static::getTagClassName();

        $tags = collect($className::findOrCreate($tags));

        $this->tags()->sync($tags->pluck('id')->toArray());

        return $this;
    }
}