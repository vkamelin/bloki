<?php

namespace Tests\Unit;

use App\Models\Collection;
use App\Services\CollectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected CollectionService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CollectionService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(CollectionService::class, $this->service);
    }

    /** @test */
    public function create_returns_null_when_data_is_empty()
    {
        $result = $this->service->create([]);
        $this->assertNull($result);
    }

    /** @test */
    public function create_returns_null_when_name_is_missing()
    {
        $result = $this->service->create(['slug' => 'test-collection']);
        $this->assertNull($result);
    }

    /** @test */
    public function create_returns_collection_when_data_is_valid()
    {
        $data = [
            'name' => 'Test Collection',
            'slug' => 'test-collection',
            'description' => 'Test description',
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals('Test Collection', $result->name);
        $this->assertEquals('test-collection', $result->slug);
    }

    /** @test */
    public function create_generates_slug_if_not_provided()
    {
        $data = [
            'name' => 'My New Collection',
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals('my-new-collection', $result->slug);
    }

    /** @test */
    public function update_returns_null_when_collection_not_found()
    {
        $result = $this->service->update(999, ['name' => 'Updated']);
        $this->assertNull($result);
    }

    /** @test */
    public function update_returns_updated_collection()
    {
        $collection = Collection::factory()->create([
            'name' => 'Original Name',
        ]);

        $result = $this->service->update($collection, ['name' => 'Updated Name']);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals('Updated Name', $result->name);
    }

    /** @test */
    public function update_accepts_collection_id()
    {
        $collection = Collection::factory()->create();

        $result = $this->service->update($collection->id, ['name' => 'Updated Name']);

        $this->assertInstanceOf(Collection::class, $result);
    }

    /** @test */
    public function delete_returns_false_when_collection_not_found()
    {
        $result = $this->service->delete(999);
        $this->assertFalse($result);
    }

    /** @test */
    public function delete_returns_true_on_success()
    {
        $collection = Collection::factory()->create();

        $result = $this->service->delete($collection);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_performs_soft_delete()
    {
        $collection = Collection::factory()->create();
        $id = $collection->id;

        $this->service->delete($collection);

        $this->assertSoftDeleted($collection);
        $this->assertNotNull(Collection::withTrashed()->find($id));
    }

    /** @test */
    public function restore_returns_null_when_collection_not_found()
    {
        $result = $this->service->restore(999);
        $this->assertNull($result);
    }

    /** @test */
    public function restore_returns_restored_collection()
    {
        $collection = Collection::factory()->create();
        $collection->delete();

        $result = $this->service->restore($collection);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotNull($result->fresh());
    }

    /** @test */
    public function duplicate_returns_null_when_collection_not_found()
    {
        $result = $this->service->duplicate(999);
        $this->assertNull($result);
    }

    /** @test */
    public function duplicate_returns_new_collection()
    {
        $collection = Collection::factory()->create([
            'name' => 'Original Collection',
            'slug' => 'original',
        ]);

        $duplicate = $this->service->duplicate($collection);

        $this->assertInstanceOf(Collection::class, $duplicate);
        $this->assertNotEquals($collection->id, $duplicate->id);
        $this->assertStringContainsString('Original Collection', $duplicate->name);
    }

    /** @test */
    public function duplicate_copies_all_attributes()
    {
        $collection = Collection::factory()->create([
            'name' => 'Test Collection',
            'description' => 'Test description',
            'is_singleton' => true,
            'has_sections' => true,
        ]);

        $duplicate = $this->service->duplicate($collection);

        $this->assertEquals($collection->description, $duplicate->description);
        $this->assertEquals($collection->is_singleton, $duplicate->is_singleton);
        $this->assertEquals($collection->has_sections, $duplicate->has_sections);
    }

    /** @test */
    public function get_all_returns_empty_array_by_default()
    {
        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    /** @test */
    public function get_all_returns_collections()
    {
        Collection::factory()->count(3)->create();

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertInstanceOf(Collection::class, $result[0]);
    }

    /** @test */
    public function get_all_respects_filters()
    {
        Collection::factory()->create(['is_active' => true]);
        Collection::factory()->create(['is_active' => false]);

        $result = $this->service->getAll(['is_active' => true]);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_by_id_returns_null_when_not_found()
    {
        $result = $this->service->getById(999);
        $this->assertNull($result);
    }

    /** @test */
    public function get_by_id_returns_collection()
    {
        $collection = Collection::factory()->create();

        $result = $this->service->getById($collection->id);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($collection->id, $result->id);
    }

    /** @test */
    public function get_by_slug_returns_null_when_not_found()
    {
        $result = $this->service->getBySlug('non-existent-slug');
        $this->assertNull($result);
    }

    /** @test */
    public function get_by_slug_returns_collection()
    {
        $collection = Collection::factory()->create([
            'slug' => 'my-collection-slug',
        ]);

        $result = $this->service->getBySlug('my-collection-slug');

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals('my-collection-slug', $result->slug);
    }

    /** @test */
    public function get_singleton_returns_null_when_not_found()
    {
        $result = $this->service->getSingleton(999);
        $this->assertNull($result);
    }

    /** @test */
    public function get_singleton_returns_singleton_collection()
    {
        $singleton = Collection::factory()->create([
            'is_singleton' => true,
        ]);

        $result = $this->service->getSingleton($singleton->id);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue($result->is_singleton);
    }

    /** @test */
    public function is_singleton_returns_true_for_singleton_collection()
    {
        $singleton = Collection::factory()->create(['is_singleton' => true]);

        $result = $this->service->isSingleton($singleton);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_singleton_returns_false_for_regular_collection()
    {
        $collection = Collection::factory()->create(['is_singleton' => false]);

        $result = $this->service->isSingleton($collection);

        $this->assertFalse($result);
    }

    /** @test */
    public function has_sections_returns_true_when_collection_has_sections()
    {
        $collection = Collection::factory()->create(['has_sections' => true]);

        $result = $this->service->hasSections($collection);

        $this->assertTrue($result);
    }

    /** @test */
    public function has_sections_returns_false_when_collection_no_sections()
    {
        $collection = Collection::factory()->create(['has_sections' => false]);

        $result = $this->service->hasSections($collection);

        $this->assertFalse($result);
    }

    /** @test */
    public function get_section_structure_returns_array()
    {
        $collection = Collection::factory()->create();

        $result = $this->service->getSectionStructure($collection);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_default_template_section_returns_string()
    {
        $collection = Collection::factory()->create([
            'default_template_section' => 'custom-section-template',
        ]);

        $result = $this->service->getDefaultTemplateSection($collection);

        $this->assertIsString($result);
        $this->assertEquals('custom-section-template', $result);
    }

    /** @test */
    public function get_default_template_entry_returns_string()
    {
        $collection = Collection::factory()->create([
            'default_template_entry' => 'custom-entry-template',
        ]);

        $result = $this->service->getDefaultTemplateEntry($collection);

        $this->assertIsString($result);
        $this->assertEquals('custom-entry-template', $result);
    }
}