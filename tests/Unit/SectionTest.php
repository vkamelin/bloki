<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Collection;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_section()
    {
        $collection = Collection::factory()->create();
        
        $section = Section::factory()->create([
            'collection_id' => $collection->id,
            'name' => 'Test Section',
            'slug' => 'test-section',
            'title' => 'Test Section Title',
            'description' => 'This is a test section',
            'status' => 'published',
            'is_active' => true,
        ]);

        $this->assertInstanceOf(Section::class, $section);
        $this->assertEquals($collection->id, $section->collection_id);
        $this->assertEquals('Test Section', $section->name);
        $this->assertEquals('test-section', $section->slug);
        $this->assertEquals('Test Section Title', $section->title);
        $this->assertEquals('published', $section->status);
        $this->assertTrue($section->isActive());
    }

    /** @test */
    public function it_belongs_to_a_collection()
    {
        $collection = Collection::factory()->create();
        $section = Section::factory()->create(['collection_id' => $collection->id]);

        $this->assertInstanceOf(Collection::class, $section->collection);
        $this->assertEquals($collection->id, $section->collection->id);
    }

    /** @test */
    public function it_can_have_a_parent_section()
    {
        $parentSection = Section::factory()->create();
        $childSection = Section::factory()->create([
            'parent_id' => $parentSection->id,
        ]);

        $this->assertInstanceOf(Section::class, $childSection->parent);
        $this->assertEquals($parentSection->id, $childSection->parent->id);
    }

    /** @test */
    public function it_can_have_child_sections()
    {
        $parentSection = Section::factory()->create();
        $childSection1 = Section::factory()->create([
            'parent_id' => $parentSection->id,
        ]);
        $childSection2 = Section::factory()->create([
            'parent_id' => $parentSection->id,
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $parentSection->children);
        $this->assertEquals(2, $parentSection->children->count());
        $this->assertTrue($parentSection->children->contains($childSection1));
        $this->assertTrue($parentSection->children->contains($childSection2));
    }

    /** @test */
    public function it_belongs_to_created_by_admin()
    {
        $admin = Admin::factory()->create();
        $section = Section::factory()->create([
            'created_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $section->createdBy);
        $this->assertEquals($admin->id, $section->createdBy->id);
    }

    /** @test */
    public function it_belongs_to_updated_by_admin()
    {
        $admin = Admin::factory()->create();
        $section = Section::factory()->create([
            'updated_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $section->updatedBy);
        $this->assertEquals($admin->id, $section->updatedBy->id);
    }

    /** @test */
    public function get_meta_returns_array()
    {
        $meta = ['custom_key' => 'custom_value', 'priority' => 1];
        $section = Section::factory()->create([
            'meta' => json_encode($meta),
        ]);

        $result = $section->getMetaAttribute();
        $this->assertIsArray($result);
        $this->assertEquals('custom_value', $result['custom_key']);
        $this->assertEquals(1, $result['priority']);
    }

    /** @test */
    public function set_meta_encodes_to_json()
    {
        $section = Section::factory()->create();
        $meta = ['custom_key' => 'custom_value', 'priority' => 1];

        $section->setMetaAttribute($meta);

        $this->assertEquals(json_encode($meta), $section->attributes['meta']);
    }

    /** @test */
    public function get_children_returns_collection()
    {
        $parentSection = Section::factory()->create();
        $childSection = Section::factory()->create([
            'parent_id' => $parentSection->id,
        ]);

        $children = $parentSection->getChildren();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $children);
        $this->assertTrue($children->contains($childSection));
    }

    /** @test */
    public function get_parent_returns_parent_section()
    {
        $parentSection = Section::factory()->create();
        $childSection = Section::factory()->create([
            'parent_id' => $parentSection->id,
        ]);

        $parent = $childSection->getParent();
        $this->assertInstanceOf(Section::class, $parent);
        $this->assertEquals($parentSection->id, $parent->id);
    }

    /** @test */
    public function get_parent_returns_null_for_root_section()
    {
        $section = Section::factory()->create(['parent_id' => null]);

        $parent = $section->getParent();
        $this->assertNull($parent);
    }

    /** @test */
    public function get_collection_returns_collection()
    {
        $collection = Collection::factory()->create();
        $section = Section::factory()->create(['collection_id' => $collection->id]);

        $resultCollection = $section->getCollection();
        $this->assertInstanceOf(Collection::class, $resultCollection);
        $this->assertEquals($collection->id, $resultCollection->id);
    }

    /** @test */
    public function is_active_returns_correct_value()
    {
        $activeSection = Section::factory()->create(['is_active' => true]);
        $inactiveSection = Section::factory()->create(['is_active' => false]);

        $this->assertTrue($activeSection->isActive());
        $this->assertFalse($inactiveSection->isActive());
    }

    /** @test */
    public function is_published_returns_correct_value()
    {
        $publishedSection = Section::factory()->create(['status' => 'published']);
        $draftSection = Section::factory()->create(['status' => 'draft']);
        $hiddenSection = Section::factory()->create(['status' => 'hidden']);

        $this->assertTrue($publishedSection->isPublished());
        $this->assertFalse($draftSection->isPublished());
        $this->assertFalse($hiddenSection->isPublished());
    }

    /** @test */
    public function is_hidden_returns_correct_value()
    {
        $hiddenSection = Section::factory()->create(['status' => 'hidden']);
        $publishedSection = Section::factory()->create(['status' => 'published']);

        $this->assertTrue($hiddenSection->isHidden());
        $this->assertFalse($publishedSection->isHidden());
    }

    /** @test */
    public function is_archived_returns_correct_value()
    {
        $archivedSection = Section::factory()->create(['status' => 'archived']);
        $publishedSection = Section::factory()->create(['status' => 'published']);

        $this->assertTrue($archivedSection->isArchived());
        $this->assertFalse($publishedSection->isArchived());
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $section = Section::factory()->create();
        $sectionId = $section->id;

        $section->delete();

        $this->assertSoftDeleted($section);
        $this->assertNotNull(Section::withTrashed()->find($sectionId));
    }

    /** @test */
    public function it_casts_meta_to_array()
    {
        $meta = ['key' => 'value', 'number' => 42];
        $section = Section::factory()->create([
            'meta' => $meta,
        ]);

        $this->assertIsArray($section->meta);
        $this->assertEquals('value', $section->meta['key']);
        $this->assertEquals(42, $section->meta['number']);
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $section = Section::factory()->create(['is_active' => true]);
        $this->assertIsBool($section->is_active);
        $this->assertTrue($section->is_active);
    }
}