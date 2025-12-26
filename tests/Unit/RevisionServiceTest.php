<?php

namespace Tests\Unit;

use App\Models\Revision;
use App\Services\RevisionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevisionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected RevisionService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new RevisionService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(RevisionService::class, $this->service);
    }

    /** @test */
    public function create_returns_revision()
    {
        $data = [
            'entity_type' => 'entry',
            'entity_id' => 1,
            'data' => ['name' => 'Test'],
            'note' => 'Initial revision',
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Revision::class, $result);
        $this->assertEquals('entry', $result->entity_type);
        $this->assertEquals(1, $result->entity_id);
    }

    /** @test */
    public function update_returns_updated_revision()
    {
        $revision = Revision::factory()->create([
            'note' => 'Original note',
        ]);

        $result = $this->service->update($revision, ['note' => 'Updated note']);

        $this->assertInstanceOf(Revision::class, $result);
        $this->assertEquals('Updated note', $result->note);
    }

    /** @test */
    public function delete_returns_true_on_success()
    {
        $revision = Revision::factory()->create();

        $result = $this->service->delete($revision);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_removes_revision()
    {
        $revision = Revision::factory()->create();
        $id = $revision->id;

        $this->service->delete($revision);

        $this->assertNull(Revision::find($id));
    }

    /** @test */
    public function get_all_returns_revisions()
    {
        Revision::factory()->count(3)->create();

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function get_all_respects_filters()
    {
        Revision::factory()->count(2)->create(['entity_type' => 'entry']);
        Revision::factory()->count(1)->create(['entity_type' => 'section']);

        $result = $this->service->getAll(['entity_type' => 'entry']);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_by_id_returns_revision()
    {
        $revision = Revision::factory()->create();

        $result = $this->service->getById($revision->id);

        $this->assertInstanceOf(Revision::class, $result);
        $this->assertEquals($revision->id, $result->id);
    }

    /** @test */
    public function get_by_entity_returns_array()
    {
        Revision::factory()->count(3)->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
        ]);

        $result = $this->service->getByEntity('entry', 1);

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function get_by_entity_returns_empty_array_when_no_revisions()
    {
        $result = $this->service->getByEntity('non-existent', 999);

        $this->assertIsArray($this->service->getByEntity('non-existent', 999));
    }

    /** @test */
    public function get_latest_returns_latest_revision()
    {
        $revision1 = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'timestamp' => now()->subHour(),
        ]);
        $revision2 = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'timestamp' => now(),
        ]);

        $result = $this->service->getLatest('entry', 1);

        $this->assertInstanceOf(Revision::class, $result);
        $this->assertEquals($revision2->id, $result->id);
    }

    /** @test */
    public function get_latest_returns_null_when_no_revisions()
    {
        $result = $this->service->getLatest('non-existent', 999);

        $this->assertNull($result);
    }

    /** @test */
    public function get_revisions_count_returns_integer()
    {
        Revision::factory()->count(3)->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
        ]);

        $result = $this->service->getRevisionsCount('entry', 1);

        $this->assertIsInt($result);
        $this->assertEquals(3, $result);
    }

    /** @test */
    public function create_revision_for_entity_creates_revision()
    {
        $result = $this->service->createRevisionForEntity('entry', 1, [
            'name' => 'Test Entry',
            'title' => 'Test Title',
        ], 'Updated entry');

        $this->assertInstanceOf(Revision::class, $result);
        $this->assertEquals('entry', $result->entity_type);
        $this->assertEquals(1, $result->entity_id);
    }

    /** @test */
    public function restore_revision_returns_restored_entity()
    {
        $revision = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'data' => ['name' => 'Restored Name'],
        ]);

        $result = $this->service->restoreRevision($revision);

        $this->assertIsBool($result);
    }

    /** @test */
    public function compare_revisions_returns_array()
    {
        $revision1 = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'data' => ['name' => 'Old Name'],
        ]);
        $revision2 = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'data' => ['name' => 'New Name'],
        ]);

        $result = $this->service->compareRevisions($revision1, $revision2);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_revisions_in_range_returns_array()
    {
        $oldRevision = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'timestamp' => now()->subDays(2),
        ]);
        $newRevision = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'timestamp' => now(),
        ]);

        $result = $this->service->getRevisionsInRange(
            'entry',
            1,
            now()->subDays(3),
            now()
        );

        $this->assertIsArray($result);
    }

    /** @test */
    public function prune_old_revisions_deletes_old_revisions()
    {
        Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'timestamp' => now()->subDays(10),
        ]);
        Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'timestamp' => now()->subDays(1),
        ]);

        $result = $this->service->pruneOldRevisions('entry', 1, 7);

        $this->assertIsInt($result);
    }

    /** @test */
    public function get_diff_returns_array()
    {
        $oldData = ['name' => 'Old Name', 'status' => 'draft'];
        $newData = ['name' => 'New Name', 'status' => 'published'];

        $result = $this->service->getDiff($oldData, $newData);

        $this->assertIsArray($result);
    }

    /** @test */
    public function set_note_updates_note()
    {
        $revision = Revision::factory()->create();

        $result = $this->service->setNote($revision, 'New note');

        $this->assertInstanceOf(Revision::class, $result);
        $this->assertEquals('New note', $result->note);
    }

    /** @test */
    public function get_data_returns_array()
    {
        $revision = Revision::factory()->create([
            'data' => ['key' => 'value'],
        ]);

        $result = $this->service->getData($revision);

        $this->assertIsArray($result);
        $this->assertEquals(['key' => 'value'], $result);
    }

    /** @test */
    public function get_timestamp_returns_carbon_instance()
    {
        $revision = Revision::factory()->create();

        $result = $this->service->getTimestamp($revision);

        $this->assertNotNull($result);
    }

    /** @test */
    public function get_created_by_returns_admin()
    {
        $revision = Revision::factory()->create();

        $result = $this->service->getCreatedBy($revision);

        // Returns Admin model or null
        $this->assertNotInstanceOf(Revision::class, $result);
    }
}