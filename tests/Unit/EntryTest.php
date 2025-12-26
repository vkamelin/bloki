<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Collection;
use App\Models\Entry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_entry()
    {
        $collection = Collection::factory()->create();
        
        $entry = Entry::factory()->create([
            'collection_id' => $collection->id,
            'name' => 'Test Entry',
            'slug' => 'test-entry',
            'title' => 'Test Entry Title',
            'status' => 'published',
            'is_active' => true,
        ]);

        $this->assertInstanceOf(Entry::class, $entry);
        $this->assertEquals($collection->id, $entry->collection_id);
        $this->assertEquals('Test Entry', $entry->name);
        $this->assertEquals('test-entry', $entry->slug);
        $this->assertEquals('Test Entry Title', $entry->title);
        $this->assertEquals('published', $entry->status);
        $this->assertTrue($entry->isActive());
    }

    /** @test */
    public function it_belongs_to_a_collection()
    {
        $collection = Collection::factory()->create();
        $entry = Entry::factory()->create(['collection_id' => $collection->id]);

        $this->assertInstanceOf(Collection::class, $entry->collection);
        $this->assertEquals($collection->id, $entry->collection->id);
    }

    /** @test */
    public function it_belongs_to_created_by_admin()
    {
        $admin = Admin::factory()->create();
        $entry = Entry::factory()->create([
            'created_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $entry->createdBy);
        $this->assertEquals($admin->id, $entry->createdBy->id);
    }

    /** @test */
    public function it_belongs_to_updated_by_admin()
    {
        $admin = Admin::factory()->create();
        $entry = Entry::factory()->create([
            'updated_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $entry->updatedBy);
        $this->assertEquals($admin->id, $entry->updatedBy->id);
    }

    /** @test */
    public function get_meta_returns_array()
    {
        $meta = ['custom_key' => 'custom_value', 'priority' => 1];
        $entry = Entry::factory()->create([
            'meta' => json_encode($meta),
        ]);

        $result = $entry->getMetaAttribute();
        $this->assertIsArray($result);
        $this->assertEquals('custom_value', $result['custom_key']);
        $this->assertEquals(1, $result['priority']);
    }

    /** @test */
    public function set_meta_encodes_to_json()
    {
        $entry = Entry::factory()->create();
        $meta = ['custom_key' => 'custom_value', 'priority' => 1];

        $entry->setMetaAttribute($meta);

        $this->assertEquals(json_encode($meta), $entry->attributes['meta']);
    }

    /** @test */
    public function get_collection_returns_collection()
    {
        $collection = Collection::factory()->create();
        $entry = Entry::factory()->create(['collection_id' => $collection->id]);

        $resultCollection = $entry->getCollection();
        $this->assertInstanceOf(Collection::class, $resultCollection);
        $this->assertEquals($collection->id, $resultCollection->id);
    }

    /** @test */
    public function is_active_returns_correct_value()
    {
        $activeEntry = Entry::factory()->create(['is_active' => true]);
        $inactiveEntry = Entry::factory()->create(['is_active' => false]);

        $this->assertTrue($activeEntry->isActive());
        $this->assertFalse($inactiveEntry->isActive());
    }

    /** @test */
    public function is_draft_returns_correct_value()
    {
        $draftEntry = Entry::factory()->create(['status' => 'draft']);
        $publishedEntry = Entry::factory()->create(['status' => 'published']);

        $this->assertTrue($draftEntry->isDraft());
        $this->assertFalse($publishedEntry->isDraft());
    }

    /** @test */
    public function is_published_returns_correct_value()
    {
        $publishedEntry = Entry::factory()->create(['status' => 'published']);
        $draftEntry = Entry::factory()->create(['status' => 'draft']);

        $this->assertTrue($publishedEntry->isPublished());
        $this->assertFalse($draftEntry->isPublished());
    }

    /** @test */
    public function is_review_returns_correct_value()
    {
        $reviewEntry = Entry::factory()->create(['status' => 'review']);
        $publishedEntry = Entry::factory()->create(['status' => 'published']);

        $this->assertTrue($reviewEntry->isReview());
        $this->assertFalse($publishedEntry->isReview());
    }

    /** @test */
    public function is_archived_returns_correct_value()
    {
        $archivedEntry = Entry::factory()->create(['status' => 'archived']);
        $publishedEntry = Entry::factory()->create(['status' => 'published']);

        $this->assertTrue($archivedEntry->isArchived());
        $this->assertFalse($publishedEntry->isArchived());
    }

    /** @test */
    public function get_field_value_todo_method_exists()
    {
        $entry = Entry::factory()->create();

        // Тестируем, что метод существует (TODO: реализация)
        $this->assertTrue(method_exists($entry, 'getFieldValue'));
    }

    /** @test */
    public function set_field_value_todo_method_exists()
    {
        $entry = Entry::factory()->create();

        // Тестируем, что метод существует (TODO: реализация)
        $this->assertTrue(method_exists($entry, 'setFieldValue'));
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $entry = Entry::factory()->create();
        $entryId = $entry->id;

        $entry->delete();

        $this->assertSoftDeleted($entry);
        $this->assertNotNull(Entry::withTrashed()->find($entryId));
    }

    /** @test */
    public function it_casts_meta_to_array()
    {
        $meta = ['key' => 'value', 'number' => 42];
        $entry = Entry::factory()->create([
            'meta' => $meta,
        ]);

        $this->assertIsArray($entry->meta);
        $this->assertEquals('value', $entry->meta['key']);
        $this->assertEquals(42, $entry->meta['number']);
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $entry = Entry::factory()->create(['is_active' => true]);
        $this->assertIsBool($entry->is_active);
        $this->assertTrue($entry->is_active);
    }

    /** @test */
    public function it_casts_published_at_to_timestamp()
    {
        $timestamp = now();
        $entry = Entry::factory()->create([
            'published_at' => $timestamp,
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $entry->published_at);
        $this->assertEquals($timestamp->format('Y-m-d H:i:s'), $entry->published_at->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_can_handle_null_published_at()
    {
        $entry = Entry::factory()->create([
            'published_at' => null,
        ]);

        $this->assertNull($entry->published_at);
    }

    /** @test */
    public function it_validates_status_values()
    {
        $statuses = ['draft', 'published', 'review', 'archived'];
        
        foreach ($statuses as $status) {
            $entry = Entry::factory()->create(['status' => $status]);
            $this->assertEquals($status, $entry->status);
        }
    }

    /** @test */
    public function it_handles_uuid()
    {
        $entry = Entry::factory()->create();

        $this->assertNotNull($entry->uuid);
        $this->assertIsString($entry->uuid);
    }
}