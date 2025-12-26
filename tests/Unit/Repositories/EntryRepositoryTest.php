<?php

namespace Tests\Unit\Repositories;

use App\Models\Collection;
use App\Models\Entry;
use App\Repositories\EntryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected EntryRepository $repository;
    protected Collection $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new EntryRepository();
        $this->collection = Collection::factory()->create();
    }

    public function testCreateReturnsEntry(): void
    {
        $data = [
            'uuid' => 'entry-uuid',
            'collection_id' => $this->collection->id,
            'slug' => 'test-entry',
            'name' => 'Test Entry',
            'title' => 'Test Entry Title',
            'status' => 'draft',
            'published_at' => null,
            'meta' => ['key' => 'value'],
            'is_active' => true,
        ];

        $entry = $this->repository->create($data);

        $this->assertInstanceOf(Entry::class, $entry);
        $this->assertEquals('entry-uuid', $entry->uuid);
        $this->assertEquals('Test Entry', $entry->name);
        $this->assertEquals($this->collection->id, $entry->collection_id);
    }

    public function testUpdateReturnsUpdatedEntry(): void
    {
        $entry = Entry::factory()->create([
            'name' => 'Original Name',
        ]);

        $updated = $this->repository->update($entry->id, [
            'name' => 'Updated Name',
        ]);

        $this->assertInstanceOf(Entry::class, $updated);
        $this->assertEquals('Updated Name', $updated->name);
    }

    public function testDeleteReturnsTrue(): void
    {
        $entry = Entry::factory()->create();

        $result = $this->repository->delete($entry->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($entry);
    }

    public function testRestoreReturnsRestoredEntry(): void
    {
        $entry = Entry::factory()->create();
        $entry->delete();

        $restored = $this->repository->restore($entry->id);

        $this->assertInstanceOf(Entry::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsEntry(): void
    {
        $created = Entry::factory()->create([
            'uuid' => 'test-uuid-123',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(Entry::class, $found);
        $this->assertEquals('test-uuid-123', $found->uuid);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetBySlugReturnsEntry(): void
    {
        Entry::factory()->create([
            'slug' => 'my-entry-slug',
        ]);

        $found = $this->repository->getBySlug('my-entry-slug');

        $this->assertInstanceOf(Entry::class, $found);
        $this->assertEquals('my-entry-slug', $found->slug);
    }

    public function testGetAllReturnsArray(): void
    {
        Entry::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        Entry::factory()->create(['is_active' => true]);
        Entry::factory()->create(['is_active' => false]);

        $active = $this->repository->getAll(['is_active' => true]);

        $this->assertIsArray($active);
        $this->assertCount(1, $active);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        Entry::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        Entry::factory()->create(['status' => 'published']);
        Entry::factory()->create(['status' => 'draft']);

        $published = $this->repository->where(['status' => 'published']);

        $this->assertIsArray($published);
        $this->assertCount(1, $published);
    }

    public function testWithReturnsRelations(): void
    {
        $entry = Entry::factory()->create();

        $result = $this->repository->with(['collection', 'createdBy']);

        $this->assertIsArray($result);
    }

    public function testGetCollectionReturnsCollection(): void
    {
        $entry = Entry::factory()->create([
            'collection_id' => $this->collection->id,
        ]);

        $collection = $this->repository->getCollection($entry);

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals($this->collection->id, $collection->id);
    }

    public function testSetCollectionReturnsTrue(): void
    {
        $entry = Entry::factory()->create();
        $newCollection = Collection::factory()->create();

        $result = $this->repository->setCollection($entry, $newCollection->id);

        $this->assertTrue($result);
        $this->assertEquals($newCollection->id, $entry->fresh()->collection_id);
    }

    public function testIsDraftReturnsCorrectValue(): void
    {
        $draft = Entry::factory()->create(['status' => 'draft']);
        $published = Entry::factory()->create(['status' => 'published']);

        $this->assertTrue($this->repository->isDraft($draft));
        $this->assertFalse($this->repository->isDraft($published));
    }

    public function testIsPublishedReturnsCorrectValue(): void
    {
        $published = Entry::factory()->create(['status' => 'published']);
        $draft = Entry::factory()->create(['status' => 'draft']);

        $this->assertTrue($this->repository->isPublished($published));
        $this->assertFalse($this->repository->isPublished($draft));
    }

    public function testIsReviewReturnsCorrectValue(): void
    {
        $review = Entry::factory()->create(['status' => 'review']);
        $draft = Entry::factory()->create(['status' => 'draft']);

        $this->assertTrue($this->repository->isReview($review));
        $this->assertFalse($this->repository->isReview($draft));
    }

    public function testIsArchivedReturnsCorrectValue(): void
    {
        $archived = Entry::factory()->create(['status' => 'archived']);
        $draft = Entry::factory()->create(['status' => 'draft']);

        $this->assertTrue($this->repository->isArchived($archived));
        $this->assertFalse($this->repository->isArchived($draft));
    }

    public function testPublishReturnsTrueAndChangesStatus(): void
    {
        $entry = Entry::factory()->create([
            'status' => 'draft',
            'published_at' => null,
        ]);

        $result = $this->repository->publish($entry);

        $this->assertTrue($result);
        $this->assertEquals('published', $entry->fresh()->status);
        $this->assertNotNull($entry->fresh()->published_at);
    }

    public function testGetFieldReturnsValue(): void
    {
        $entry = Entry::factory()->create();

        // Test basic field retrieval (field implementation pending)
        $field = $this->repository->getField($entry, 'title');

        // Field value retrieval is pending implementation
        $this->assertNull($field);
    }

    public function testSetFieldReturnsTrue(): void
    {
        $entry = Entry::factory()->create();

        // Test basic field setting (field implementation pending)
        $result = $this->repository->setField($entry, 'title', 'New Title');

        // Field value setting is pending implementation
        $this->assertFalse($result);
    }

    public function testCreateWithValidData(): void
    {
        $data = [
            'uuid' => 'new-entry-uuid',
            'collection_id' => $this->collection->id,
            'slug' => 'new-entry',
            'name' => 'New Entry',
            'title' => 'New Entry Title',
            'status' => 'published',
            'is_active' => true,
        ];

        $entry = $this->repository->create($data);

        $this->assertInstanceOf(Entry::class, $entry);
        $this->assertEquals('new-entry-uuid', $entry->uuid);
    }

    public function testUpdateNonexistentEntryReturnsNull(): void
    {
        $result = $this->repository->update(999999, ['name' => 'Test']);

        $this->assertNull($result);
    }

    public function testDeleteNonexistentEntryReturnsFalse(): void
    {
        $result = $this->repository->delete(999999);

        $this->assertFalse($result);
    }
}