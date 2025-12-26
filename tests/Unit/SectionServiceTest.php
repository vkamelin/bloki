<?php

namespace Tests\Unit;

use App\Models\Collection;
use App\Models\Section;
use App\Services\SectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected SectionService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SectionService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(SectionService::class, $this->service);
    }

    /** @test */
    public function create_returns_section()
    {
        $collection = Collection::factory()->create();
        $data = [
            'name' => 'Test Section',
            'slug' => 'test-section',
            'collection_id' => $collection->id,
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Section::class, $result);
        $this->assertEquals('Test Section', $result->name);
    }

    /** @test */
    public function create_generates_slug_if_not_provided()
    {
        $collection = Collection::factory()->create();
        $data = [
            'name' => 'My Test Section',
            'collection_id' => $collection->id,
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Section::class, $result);
        $this->assertEquals('my-test-section', $result->slug);
    }

    /** @test */
    public function update_returns_updated_section()
    {
        $section = Section::factory()->create([
            'name' => 'Original Name',
        ]);

        $result = $this->service->update($section, ['name' => 'Updated Name']);

        $this->assertInstanceOf(Section::class, $result);
        $this->assertEquals('Updated Name', $result->name);
    }

    /** @test */
    public function update_accepts_section_id()
    {
        $section = Section::factory()->create();

        $result = $this->service->update($section->id, ['name' => 'Updated']);

        $this->assertInstanceOf(Section::class, $result);
    }

    /** @test */
    public function delete_returns_true_on_success()
    {
        $section = Section::factory()->create();

        $result = $this->service->delete($section);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_performs_soft_delete()
    {
        $section = Section::factory()->create();
        $id = $section->id;

        $this->service->delete($section);

        $this->assertSoftDeleted($section);
        $this->assertNotNull(Section::withTrashed()->find($id));
    }

    /** @test */
    public function restore_returns_restored_section()
    {
        $section = Section::factory()->create();
        $section->delete();

        $result = $this->service->restore($section);

        $this->assertInstanceOf(Section::class, $result);
        $this->assertNotNull($result->fresh());
    }

    /** @test */
    public function reorder_returns_true_on_success()
    {
        $section1 = Section::factory()->create(['lft' => 1, 'rgt' => 2]);
        $section2 = Section::factory()->create(['lft' => 3, 'rgt' => 4]);

        $result = $this->service->reorder([
            ['id' => $section2->id, 'position' => 0],
            ['id' => $section1->id, 'position' => 1],
        ]);

        $this->assertTrue($result);
    }

    /** @test */
    public function get_all_returns_empty_array_by_default()
    {
        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    /** @test */
    public function get_all_returns_sections()
    {
        Section::factory()->count(3)->create();

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function get_by_id_returns_section()
    {
        $section = Section::factory()->create();

        $result = $this->service->getById($section->id);

        $this->assertInstanceOf(Section::class, $result);
        $this->assertEquals($section->id, $result->id);
    }

    /** @test */
    public function get_by_slug_returns_section()
    {
        $collection = Collection::factory()->create();
        $section = Section::factory()->create([
            'collection_id' => $collection->id,
            'slug' => 'test-slug',
        ]);

        $result = $this->service->getBySlug($collection->id, 'test-slug');

        $this->assertInstanceOf(Section::class, $result);
        $this->assertEquals('test-slug', $result->slug);
    }

    /** @test */
    public function get_children_returns_array()
    {
        $parent = Section::factory()->create();
        Section::factory()->count(2)->create(['parent_id' => $parent->id]);

        $result = $this->service->getChildren($parent);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    /** @test */
    public function get_parent_returns_parent_section()
    {
        $parent = Section::factory()->create();
        $child = Section::factory()->create(['parent_id' => $parent->id]);

        $result = $this->service->getParent($child);

        $this->assertInstanceOf(Section::class, $result);
        $this->assertEquals($parent->id, $result->id);
    }

    /** @test */
    public function get_collection_returns_collection()
    {
        $collection = Collection::factory()->create();
        $section = Section::factory()->create(['collection_id' => $collection->id]);

        $result = $this->service->getCollection($section);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($collection->id, $result->id);
    }

    /** @test */
    public function get_entries_returns_array()
    {
        $section = Section::factory()->create();

        $result = $this->service->getEntries($section);

        $this->assertIsArray($result);
    }

    /** @test */
    public function is_active_returns_true_for_active_section()
    {
        $section = Section::factory()->create([
            'status' => 'active',
            'is_active' => true,
        ]);

        $result = $this->service->isActive($section);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_false_for_inactive_section()
    {
        $section = Section::factory()->create([
            'is_active' => false,
        ]);

        $result = $this->service->isActive($section);

        $this->assertFalse($result);
    }

    /** @test */
    public function is_published_returns_true_for_published_section()
    {
        $section = Section::factory()->create([
            'status' => 'published',
        ]);

        $result = $this->service->isPublished($section);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_hidden_returns_true_for_hidden_section()
    {
        $section = Section::factory()->create([
            'status' => 'hidden',
        ]);

        $result = $this->service->isHidden($section);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_archived_returns_true_for_archived_section()
    {
        $section = Section::factory()->create([
            'status' => 'archived',
        ]);

        $result = $this->service->isArchived($section);

        $this->assertTrue($result);
    }
}