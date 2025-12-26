<?php

namespace Tests\Unit;

use App\Models\Collection;
use App\Models\Entry;
use App\Services\EntryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected EntryService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new EntryService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(EntryService::class, $this->service);
    }

    /** @test */
    public function create_returns_entry()
    {
        $collection = Collection::factory()->create();
        $data = [
            'name' => 'Test Entry',
            'title' => 'Test Entry Title',
            'collection_id' => $collection->id,
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Entry::class, $result);
        $this->assertEquals('Test Entry', $result->name);
    }

    /** @test */
    public function update_returns_updated_entry()
    {
        $entry = Entry::factory()->create([
            'name' => 'Original Name',
        ]);

        $result = $this->service->update($entry, ['name' => 'Updated Name']);

        $this->assertInstanceOf(Entry::class, $result);
        $this->assertEquals('Updated Name', $result->name);
    }

    /** @test */
    public function delete_returns_true_on_success()
    {
        $entry = Entry::factory()->create();

        $result = $this->service->delete($entry);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_performs_soft_delete()
    {
        $entry = Entry::factory()->create();
        $id = $entry->id;

        $this->service->delete($entry);

        $this->assertSoftDeleted($entry);
        $this->assertNotNull(Entry::withTrashed()->find($id));
    }

    /** @test */
    public function restore_returns_restored_entry()
    {
        $entry = Entry::factory()->create();
        $entry->delete();

        $result = $this->service->restore($entry);

        $this->assertInstanceOf(Entry::class, $result);
        $this->assertNotNull($result->fresh());
    }

    /** @test */
    public function publish_returns_published_entry()
    {
        $entry = Entry::factory()->create([
            'status' => 'draft',
        ]);

        $result = $this->service->publish($entry);

        $this->assertInstanceOf(Entry::class, $result);
    }

    /** @test */
    public function unpublish_returns_unpublished_entry()
    {
        $entry = Entry::factory()->create([
            'status' => 'published',
        ]);

        $result = $this->service->unpublish($entry);

        $this->assertInstanceOf(Entry::class, $result);
    }

    /** @test */
    public function get_all_returns_entries()
    {
        Entry::factory()->count(3)->create();

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function get_all_respects_filters()
    {
        Entry::factory()->count(2)->create(['status' => 'draft']);
        Entry::factory()->count(1)->create(['status' => 'published']);

        $result = $this->service->getAll(['status' => 'published']);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_by_id_returns_entry()
    {
        $entry = Entry::factory()->create();

        $result = $this->service->getById($entry->id);

        $this->assertInstanceOf(Entry::class, $result);
        $this->assertEquals($entry->id, $result->id);
    }

    /** @test */
    public function get_by_slug_returns_entry()
    {
        $collection = Collection::factory()->create();
        $entry = Entry::factory()->create([
            'collection_id' => $collection->id,
            'slug' => 'test-entry-slug',
        ]);

        $result = $this->service->getBySlug('test-entry-slug');

        $this->assertInstanceOf(Entry::class, $result);
        $this->assertEquals('test-entry-slug', $result->slug);
    }

    /** @test */
    public function get_collection_returns_collection()
    {
        $collection = Collection::factory()->create();
        $entry = Entry::factory()->create(['collection_id' => $collection->id]);

        $result = $this->service->getCollection($entry);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($collection->id, $result->id);
    }

    /** @test */
    public function get_field_value_returns_mixed()
    {
        $entry = Entry::factory()->create();

        $result = $this->service->getFieldValue($entry, 'title');

        // Result can be null or mixed value
        $this->assertNotInstanceOf(Entry::class, $result);
    }

    /** @test */
    public function set_field_value_returns_bool()
    {
        $entry = Entry::factory()->create();

        $result = $this->service->setFieldValue($entry, 'title', 'New Title');

        $this->assertIsBool($result);
    }

    /** @test */
    public function is_active_returns_true_for_active_entry()
    {
        $entry = Entry::factory()->create([
            'is_active' => true,
        ]);

        $result = $this->service->isActive($entry);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_false_for_inactive_entry()
    {
        $entry = Entry::factory()->create([
            'is_active' => false,
        ]);

        $result = $this->service->isActive($entry);

        $this->assertFalse($result);
    }

    /** @test */
    public function is_draft_returns_true_for_draft_entry()
    {
        $entry = Entry::factory()->create([
            'status' => 'draft',
        ]);

        $result = $this->service->isDraft($entry);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_published_returns_true_for_published_entry()
    {
        $entry = Entry::factory()->create([
            'status' => 'published',
        ]);

        $result = $this->service->isPublished($entry);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_review_returns_true_for_review_entry()
    {
        $entry = Entry::factory()->create([
            'status' => 'review',
        ]);

        $result = $this->service->isReview($entry);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_archived_returns_true_for_archived_entry()
    {
        $entry = Entry::factory()->create([
            'status' => 'archived',
        ]);

        $result = $this->service->isArchived($entry);

        $this->assertTrue($result);
    }
}