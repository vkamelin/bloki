<?php

namespace Tests\Unit\Repositories;

use App\Models\Collection;
use App\Repositories\CollectionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected CollectionRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new CollectionRepository();
    }

    public function testCreateReturnsCollection(): void
    {
        $data = [
            'uuid' => 'test-uuid',
            'name' => 'Test Collection',
            'slug' => 'test-collection',
            'description' => 'Test description',
            'has_sections' => false,
            'section_structure' => 'flat',
            'entry_behavior' => ['behavior' => 'standalone'],
            'is_singleton' => false,
            'full_text_search' => true,
            'default_template_section' => null,
            'default_template_entry' => 'default',
            'route_patterns' => ['show' => '/test/{slug}'],
            'api_visibility' => ['public' => true],
            'is_active' => true,
        ];

        $collection = $this->repository->create($data);

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals('test-uuid', $collection->uuid);
        $this->assertEquals('Test Collection', $collection->name);
        $this->assertEquals('test-collection', $collection->slug);
    }

    public function testUpdateReturnsUpdatedCollection(): void
    {
        $collection = Collection::factory()->create([
            'name' => 'Original Name',
        ]);

        $updated = $this->repository->update($collection->id, [
            'name' => 'Updated Name',
        ]);

        $this->assertInstanceOf(Collection::class, $updated);
        $this->assertEquals('Updated Name', $updated->name);
    }

    public function testDeleteReturnsTrue(): void
    {
        $collection = Collection::factory()->create();

        $result = $this->repository->delete($collection->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($collection);
    }

    public function testRestoreReturnsRestoredCollection(): void
    {
        $collection = Collection::factory()->create();
        $collection->delete();

        $restored = $this->repository->restore($collection->id);

        $this->assertInstanceOf(Collection::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsCollection(): void
    {
        $created = Collection::factory()->create([
            'uuid' => 'test-uuid-123',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(Collection::class, $found);
        $this->assertEquals('test-uuid-123', $found->uuid);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetBySlugReturnsCollection(): void
    {
        Collection::factory()->create([
            'slug' => 'my-slug',
        ]);

        $found = $this->repository->getBySlug('my-slug');

        $this->assertInstanceOf(Collection::class, $found);
        $this->assertEquals('my-slug', $found->slug);
    }

    public function testGetAllReturnsArray(): void
    {
        Collection::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        Collection::factory()->create(['is_active' => true]);
        Collection::factory()->create(['is_active' => false]);

        $active = $this->repository->getAll(['is_active' => true]);

        $this->assertIsArray($active);
        $this->assertCount(1, $active);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        Collection::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        Collection::factory()->create(['is_singleton' => true]);
        Collection::factory()->create(['is_singleton' => false]);

        $singletons = $this->repository->where(['is_singleton' => true]);

        $this->assertIsArray($singletons);
        $this->assertCount(1, $singletons);
    }

    public function testWithReturnsRelations(): void
    {
        $collection = Collection::factory()->create();

        $result = $this->repository->with(['createdBy']);

        $this->assertIsArray($result);
    }

    public function testIsSingletonReturnsCorrectValue(): void
    {
        $singleton = Collection::factory()->create(['is_singleton' => true]);
        $regular = Collection::factory()->create(['is_singleton' => false]);

        $this->assertTrue($this->repository->isSingleton($singleton));
        $this->assertFalse($this->repository->isSingleton($regular));
    }

    public function testHasSectionsReturnsCorrectValue(): void
    {
        $withSections = Collection::factory()->create(['has_sections' => true]);
        $withoutSections = Collection::factory()->create(['has_sections' => false]);

        $this->assertTrue($this->repository->hasSections($withSections));
        $this->assertFalse($this->repository->hasSections($withoutSections));
    }

    public function testGetSectionStructureReturnsArray(): void
    {
        $collection = Collection::factory()->create([
            'section_structure' => json_encode(['type' => 'nested']),
        ]);

        $structure = $this->repository->getSectionStructure($collection);

        $this->assertIsArray($structure);
        $this->assertEquals('nested', $structure['type']);
    }

    public function testGetDefaultTemplateSection(): void
    {
        $collection = Collection::factory()->create([
            'default_template_section' => 'custom-section-template',
        ]);

        $template = $this->repository->getDefaultTemplateSection($collection);

        $this->assertEquals('custom-section-template', $template);
    }

    public function testGetDefaultTemplateEntry(): void
    {
        $collection = Collection::factory()->create([
            'default_template_entry' => 'custom-entry-template',
        ]);

        $template = $this->repository->getDefaultTemplateEntry($collection);

        $this->assertEquals('custom-entry-template', $template);
    }

    public function testGetEntryBehaviorReturnsArray(): void
    {
        $collection = Collection::factory()->create([
            'entry_behavior' => ['type' => 'page'],
        ]);

        $behavior = $this->repository->getEntryBehavior($collection);

        $this->assertIsArray($behavior);
        $this->assertEquals('page', $behavior['type']);
    }

    public function testSetDefaultTemplateSection(): void
    {
        $collection = Collection::factory()->create([
            'default_template_section' => null,
        ]);

        $result = $this->repository->setDefaultTemplateSection($collection, 'new-template');

        $this->assertTrue($result);
        $this->assertEquals('new-template', $collection->fresh()->default_template_section);
    }

    public function testSetDefaultTemplateEntry(): void
    {
        $collection = Collection::factory()->create([
            'default_template_entry' => null,
        ]);

        $result = $this->repository->setDefaultTemplateEntry($collection, 'new-template');

        $this->assertTrue($result);
        $this->assertEquals('new-template', $collection->fresh()->default_template_entry);
    }

    public function testDuplicateCreatesCopy(): void
    {
        $original = Collection::factory()->create([
            'name' => 'Original',
            'slug' => 'original',
        ]);

        $duplicate = $this->repository->duplicate($original);

        $this->assertInstanceOf(Collection::class, $duplicate);
        $this->assertNotEquals($original->id, $duplicate->id);
        $this->assertEquals('Original (Copy)', $duplicate->name);
    }

    public function testGetSingletonReturnsCollectionOrNull(): void
    {
        Collection::factory()->create(['is_singleton' => true, 'slug' => 'singleton-1']);
        Collection::factory()->create(['is_singleton' => false, 'slug' => 'regular']);

        $singleton = $this->repository->getSingleton('singleton-1');

        $this->assertInstanceOf(Collection::class, $singleton);
        $this->assertTrue($singleton->is_singleton);
    }
}