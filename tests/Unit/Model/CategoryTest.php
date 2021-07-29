<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTest extends TestCase
{
    public function test_hasMany_song()
    {
        $category = new Category();

        $relation = $category->songs();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('cate_id', $relation->getForeignKeyName());

        $this->assertEquals('categories.id', $relation->getQualifiedParentKeyName());
    }

    public function test_hasMany_childen()
    {
        $category = new Category();

        $relation = $category->children();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('parent_id', $relation->getForeignKeyName());

        $this->assertEquals('categories.id', $relation->getQualifiedParentKeyName());
    }

    public function test_category_belongsTo_parent_Category()
    {
        $category = new Category();

        $relation = $category->parent();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('parent_id', $relation->getForeignKeyName());
    }
}
