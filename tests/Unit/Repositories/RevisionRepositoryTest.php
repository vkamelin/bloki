<?php

namespace Tests\Unit\Repositories;

use App\Models\Admin;
use App\Models\Entry;
use App\Models\Revision;
use App\Repositories\RevisionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevisionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected RevisionRepository $repository;
    protected Entry $entry;
    protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new RevisionRepository();
        $this->entry = Entry::factory()->create();
        $this->admin = Admin::factory()->create();
    }

    public function testCreateReturnsRevision(): void
    {
        $data = [
            'entry_type' => 'entry',
            'entity_id' => $this->entry->id,
            'data' => ['title' => 'Test Title'],
            'created_by' => $this->admin->id,
            'timestamp' => now(),
            'note' => 'Test revision note',
        ];

        $revision = $this->repository->create($data);

        $this->assertInstanceOf(Revision::class, $revision);
        $this->assertEquals('entry', $revision->entry_type);
        $this->assertEquals($this->entry->id, $revision->entity_id);
    }

    public function testUpdateReturnsUpdatedRevision(): void
    {
        $revision = Revision::factory()->create([
            'note' => 'Original note',
        ]);

        $updated = $this->repository->update($revision->id, [
            'note' => 'Updated note',
        ]);

        $this->assertInstanceOf(Revision::class, $updated);
        $this->assertEquals('Updated note', $updated->note);
    }

    public function testDeleteReturnsTrue(): void
    {
        $revision = Revision::factory()->create();

        $result = $this->repository->delete($revision->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($revision);
    }

    public function testRestoreReturnsRestoredRevision(): void
    {
        $revision = Revision::factory()->create();
        $revision->delete();

        $restored = $this->repository->restore($revision->id);

        $this->assertInstanceOf(Revision::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsRevision(): void
    {
        $created = Revision::factory()->create([
            'note' => 'test-revision',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(Revision::class, $found);
        $this->assertEquals('test-revision', $found->note);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetAllReturnsArray(): void
    {
        Revision::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        Revision::factory()->count(2)->create([
            'entry_type' => 'entry',
        ]);
        Revision::factory()->count(1)->create([
            'entry_type' => 'collection',
        ]);

        $entries = $this->repository->getAll(['entry_type' => 'entry']);

        $this->assertIsArray($entries);
        $this->assertCount(2, $entries);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        Revision::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        Revision::factory()->create(['entry_type' => 'entry']);
        Revision::factory()->create(['entry_type' => 'collection']);

        $entries = $this->repository->where(['entry_type' => 'entry']);

        $this->assertIsArray($entries);
        $this->assertCount(1, $entries);
    }

    public function testWithReturnsRelations(): void
    {
        $revision = Revision::factory()->create();

        $result = $this->repository->with(['createdBy']);

        $this->assertIsArray($result);
    }

    public function testGetByEntryReturnsRevision(): void
    {
        $revision = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $found = $this->repository->getByEntry($this->entry);

        $this->assertInstanceOf(Revision::class, $found);
        $this->assertEquals($this->entry->id, $found->entity_id);
    }

    public function testGetDataReturnsArray(): void
    {
        $revision = Revision::factory()->create([
            'data' => json_encode(['title' => 'Test', 'content' => 'Content']),
        ]);

        $data = $this->repository->getData($revision);

        $this->assertIsArray($data);
        $this->assertEquals('Test', $data['title']);
    }

    public function testSaveDataReturnsTrue(): void
    {
        $revision = Revision::factory()->create([
            'data' => json_encode(['title' => 'Original']),
        ]);

        $result = $this->repository->saveData($revision, ['title' => 'Updated', 'new_field' => 'Value']);

        $this->assertTrue($result);
    }

    public function testGetEntityReturnsEntry(): void
    {
        $revision = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $entity = $this->repository->getEntity($revision);

        $this->assertInstanceOf(Entry::class, $entity);
        $this->assertEquals($this->entry->id, $entity->id);
    }

    public function testSetEntryReturnsTrue(): void
    {
        $revision = Revision::factory()->create();
        $newEntry = Entry::factory()->create();

        $result = $this->repository->setEntry($revision, 'entry', $newEntry);

        $this->assertTrue($result);
    }

    public function testGetAdminReturnsAdmin(): void
    {
        $revision = Revision::factory()->create([
            'created_by' => $this->admin->id,
        ]);

        $admin = $this->repository->getAdmin($revision);

        $this->assertInstanceOf(Admin::class, $admin);
        $this->assertEquals($this->admin->id, $admin->id);
    }

    public function testSetAdminReturnsTrue(): void
    {
        $revision = Revision::factory()->create();
        $newAdmin = Admin::factory()->create();

        $result = $this->repository->setAdmin($revision, $newAdmin);

        $this->assertTrue($result);
    }

    public function testGetNoteReturnsString(): void
    {
        $revision = Revision::factory()->create([
            'note' => 'Test note content',
        ]);

        $note = $this->repository->getNote($revision);

        $this->assertEquals('Test note content', $note);
    }

    public function testSetNoteReturnsTrue(): void
    {
        $revision = Revision::factory()->create([
            'note' => 'Original note',
        ]);

        $result = $this->repository->setNote($revision, 'Updated note');

        $this->assertTrue($result);
        $this->assertEquals('Updated note', $revision->fresh()->note);
    }

    public function testTimestampIsSet(): void
    {
        $revision = Revision::factory()->create();

        $this->assertNotNull($revision->timestamp);
    }

    public function testDataIsArray(): void
    {
        $revision = Revision::factory()->create([
            'data' => json_encode(['key' => 'value']),
        ]);

        $this->assertIsArray($revision->data);
    }

    public function testRevisionBelongsToEntry(): void
    {
        $revision = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $this->assertInstanceOf(Entry::class, $revision->entry);
    }

    public function testRevisionBelongsToAdmin(): void
    {
        $revision = Revision::factory()->create([
            'created_by' => $this->admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $revision->createdBy);
    }

    public function testRevisionDataAccessor(): void
    {
        $revision = Revision::factory()->create([
            'data' => ['title' => 'Hello World', 'count' => 42],
        ]);

        $this->assertEquals('Hello World', $revision->data['title']);
        $this->assertEquals(42, $revision->data['count']);
    }

    public function testRevisionTimestampCast(): void
    {
        $revision = Revision::factory()->create([
            'timestamp' => now(),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $revision->timestamp);
    }

    public function testSoftDeletesTrait(): void
    {
        $revision = Revision::factory()->create();
        $revision->delete();

        $this->assertSoftDeleted($revision);
    }
}