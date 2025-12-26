<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Collection;
use App\Models\Entry;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_collection()
    {
        $collection = Collection::factory()->create([
            'name' => 'Test Collection',
            'slug' => 'test-collection',
            'description' => 'This is a test collection',
            'has_sections' => true,
            'section_structure' => 'tree',
            'entry_behavior' => ['auto_slug' => true],
            'is_singleton' => false,
            'full_text_search' => true,
            'is_active' => true,
        ]);

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals('Test Collection', $collection->name);
        $this->assertEquals('test-collection', $collection->slug);
        $this->assertTrue($collection->hasSections());
        $this->assertFalse($collection->isSingleton());
        $this->assertTrue($collection->full_text_search);
        $this->assertTrue($collection->is_active);
    }

    /** @test */
    public function it_belongs_to_created_by_admin()
    {
        $admin = Admin::factory()->create();
        $collection = Collection::factory()->create([
            'created_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $collection->createdBy);
        $this->assertEquals($admin->id, $collection->createdBy->id);
    }

    /** @test */
    public function it_belongs_to_updated_by_admin()
    {
        $admin = Admin::factory()->create();
        $collection = Collection::factory()->create([
            'updated_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $collection->updatedBy);
        $this->assertEquals($admin->id, $collection->updatedBy->id);
    }

    /** @test */
    public function it_has_many_sections()
    {
        $collection = Collection::factory()->create();
        $section1 = Section::factory()->create(['collection_id' => $collection->id]);
        $section2 = Section::factory()->create(['collection_id' => $collection->id]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $collection->sections);
        $this->assertEquals(2, $collection->sections->count());
        $this->assertTrue($collection->sections->contains($section1));
        $this->assertTrue($collection->sections->contains($section2));
    }

    /** @test */
    public function it_has_many_entries()
    {
        $collection = Collection::factory()->create();
        $entry1 = Entry::factory()->create(['collection_id' => $collection->id]);
        $entry2 = Entry::factory()->create(['collection_id' => $collection->id]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $collection->entries);
        $this->assertEquals(2, $collection->entries->count());
        $this->assertTrue($collection->entries->contains($entry1));
        $this->assertTrue($collection->entries->contains($entry2));
    }

    /** @test */
    public function is_singleton_returns_correct_value()
    {
        $singletonCollection = Collection::factory()->create(['is_singleton' => true]);
        $regularCollection = Collection::factory()->create(['is_singleton' => false]);

        $this->assertTrue($singletonCollection->isSingleton());
        $this->assertFalse($regularCollection->isSingleton());
    }

    /** @test */
    public function has_sections_returns_correct_value()
    {
        $collectionWithSections = Collection::factory()->create(['has_sections' => true]);
        $collectionWithoutSections = Collection::factory()->create(['has_sections' => false]);

        $this->assertTrue($collectionWithSections->hasSections());
        $this->assertFalse($collectionWithoutSections->hasSections());
    }

    /** @test */
    public function get_section_structure_returns_enum_value()
    {
        $collection = Collection::factory()->create([
            'section_structure' => 'tree',
        ]);

        $this->assertEquals('tree', $collection->section_structure);
        $this->assertContains($collection->section_structure, ['tree', 'single']);
    }

    /** @test */
    public function get_default_template_section_returns_correct_value()
    {
        $collection = Collection::factory()->create([
            'default_template_section' => 'custom-section-template',
        ]);

        $this->assertEquals('custom-section-template', $collection->getDefaultTemplateSection());
    }

    /** @test */
    public function get_default_template_entry_returns_correct_value()
    {
        $collection = Collection::factory()->create([
            'default_template_entry' => 'custom-entry-template',
        ]);

        $this->assertEquals('custom-entry-template', $collection->getDefaultTemplateEntry());
    }

    /** @test */
    public function it_casts_entry_behavior_to_array()
    {
        $collection = Collection::factory()->create([
            'entry_behavior' => ['auto_slug' => true, 'revision_control' => false],
        ]);

        $this->assertIsArray($collection->entry_behavior);
        $this->assertTrue($collection->entry_behavior['auto_slug']);
        $this->assertFalse($collection->entry_behavior['revision_control']);
    }

    /** @test */
    public function it_casts_route_patterns_to_array()
    {
        $patterns = ['/collections/{slug}', '/{slug}'];
        $collection = Collection::factory()->create([
            'route_patterns' => $patterns,
        ]);

        $this->assertIsArray($collection->route_patterns);
        $this->assertEquals($patterns, $collection->route_patterns);
    }

    /** @test */
    public function it_casts_api_visibility_to_array()
    {
        $visibility = ['public' => true, 'admin' => true];
        $collection = Collection::factory()->create([
            'api_visibility' => $visibility,
        ]);

        $this->assertIsArray($collection->api_visibility);
        $this->assertTrue($collection->api_visibility['public']);
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $collection = Collection::factory()->create();
        $collectionId = $collection->id;

        $collection->delete();

        $this->assertSoftDeleted($collection);
        $this->assertNotNull(Collection::withTrashed()->find($collectionId));
    }
}