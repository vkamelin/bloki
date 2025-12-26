<?php

namespace Tests\Unit\Repositories;

use App\Models\Collection;
use App\Models\Section;
use App\Repositories\SectionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected SectionRepository $repository;
    protected Collection $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new SectionRepository();
        $this->collection = Collection::factory()->create();
    }

    public function testCreateReturnsSection(): void
    {
        $data = [
            'uuid' => 'section-uuid',
            'collection_id' => $this->collection->id,
            'slug' => 'test-section',
            'name' => 'Test Section',
            'title' => 'Test Section Title',
            'description' => 'Test description',
            'status' => 'published',
            'meta' => ['key' => 'value'],
            'is_active' => true,
        ];

        $section = $this->repository->create($data);

        $this->assertInstanceOf(Section::class, $section);
        $this->assertEquals('section-uuid', $section->uuid);
        $this->assertEquals('Test Section', $section->name);
        $this->assertEquals($this->collection->id, $section->collection_id);
    }

    public function testUpdateReturnsUpdatedSection(): void
    {
        $section = Section::factory()->create([
            'name' => 'Original Name',
        ]);

        $updated = $this->repository->update($section->id, [
            'name' => 'Updated Name',
        ]);

        $this->assertInstanceOf(Section::class, $updated);
        $this->assertEquals('Updated Name', $updated->name);
    }

    public function testDeleteReturnsTrue(): void
    {
        $section = Section::factory()->create();

        $result = $this->repository->delete($section->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($section);
    }

    public function testRestoreReturnsRestoredSection(): void
    {
        $section = Section::factory()->create();
        $section->delete();

        $restored = $this->repository->restore($section->id);

        $this->assertInstanceOf(Section::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsSection(): void
    {
        $created = Section::factory()->create([
            'uuid' => 'test-uuid-123',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(Section::class, $found);
        $this->assertEquals('test-uuid-123', $found->uuid);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetBySlugReturnsSection(): void
    {
        Section::factory()->create([
            'slug' => 'my-section-slug',
        ]);

        $found = $this->repository->getBySlug('my-section-slug');

        $this->assertInstanceOf(Section::class, $found);
        $this->assertEquals('my-section-slug', $found->slug);
    }

    public function testGetAllReturnsArray(): void
    {
        Section::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        Section::factory()->create(['is_active' => true]);
        Section::factory()->create(['is_active' => false]);

        $active = $this->repository->getAll(['is_active' => true]);

        $this->assertIsArray($active);
        $this->assertCount(1, $active);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        Section::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        Section::factory()->create(['status' => 'published']);
        Section::factory()->create(['status' => 'draft']);

        $published = $this->repository->where(['status' => 'published']);

        $this->assertIsArray($published);
        $this->assertCount(1, $published);
    }

    public function testWithReturnsRelations(): void
    {
        $section = Section::factory()->create();

        $result = $this->repository->with(['collection', 'parent']);

        $this->assertIsArray($result);
    }

    public function testGetParentReturnsSectionOrNull(): void
    {
        $parent = Section::factory()->create();
        $child = Section::factory()->create([
            'parent_id' => $parent->id,
        ]);

        $foundParent = $this->repository->getParent($child);

        $this->assertInstanceOf(Section::class, $foundParent);
        $this->assertEquals($parent->id, $foundParent->id);
    }

    public function testGetParentReturnsNullForRoot(): void
    {
        $root = Section::factory()->create([
            'parent_id' => null,
        ]);

        $parent = $this->repository->getParent($root);

        $this->assertNull($parent);
    }

    public function testHasParentReturnsCorrectValue(): void
    {
        $parent = Section::factory()->create();
        $child = Section::factory()->create([
            'parent_id' => $parent->id,
        ]);
        $root = Section::factory()->create([
            'parent_id' => null,
        ]);

        $this->assertTrue($this->repository->hasParent($child));
        $this->assertFalse($this->repository->hasParent($root));
    }

    public function testGetChildrenReturnsArray(): void
    {
        $parent = Section::factory()->create();
        Section::factory()->count(3)->create([
            'parent_id' => $parent->id,
        ]);

        $children = $this->repository->getChildren($parent);

        $this->assertIsArray($children);
        $this->assertCount(3, $children);
    }

    public function testHasChildrenReturnsCorrectValue(): void
    {
        $parent = Section::factory()->create();
        Section::factory()->create(['parent_id' => $parent->id]);

        $withoutChildren = Section::factory()->create();

        $this->assertTrue($this->repository->hasChildren($parent));
        $this->assertFalse($this->repository->hasChildren($withoutChildren));
    }

    public function testGetAncestorsReturnsArray(): void
    {
        $grandparent = Section::factory()->create();
        $parent = Section::factory()->create(['parent_id' => $grandparent->id]);
        $child = Section::factory()->create(['parent_id' => $parent->id]);

        $ancestors = $this->repository->getAncestors($child);

        $this->assertIsArray($ancestors);
        $this->assertCount(2, $ancestors);
    }

    public function testGetDescendantsReturnsArray(): void
    {
        $parent = Section::factory()->create();
        $child = Section::factory()->create(['parent_id' => $parent->id]);
        $grandchild = Section::factory()->create(['parent_id' => $child->id]);

        $descendants = $this->repository->getDescendants($parent);

        $this->assertIsArray($descendants);
        $this->assertCount(2, $descendants);
    }

    public function testGetCollectionReturnsCollection(): void
    {
        $section = Section::factory()->create([
            'collection_id' => $this->collection->id,
        ]);

        $collection = $this->repository->getCollection($section);

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals($this->collection->id, $collection->id);
    }

    public function testGetSectionsByCollectionReturnsArray(): void
    {
        Section::factory()->count(2)->create([
            'collection_id' => $this->collection->id,
        ]);
        Section::factory()->count(3)->create();

        $sections = $this->repository->getSectionsByCollection($this->collection->id);

        $this->assertIsArray($sections);
        $this->assertCount(2, $sections);
    }

    public function testGetTreeReturnsHierarchicalStructure(): void
    {
        $parent = Section::factory()->create([
            'collection_id' => $this->collection->id,
        ]);
        $child1 = Section::factory()->create([
            'collection_id' => $this->collection->id,
            'parent_id' => $parent->id,
        ]);
        $child2 = Section::factory()->create([
            'collection_id' => $this->collection->id,
            'parent_id' => $parent->id,
        ]);

        $tree = $this->repository->getTree();

        $this->assertIsArray($tree);
    }

    public function testGetTreeByCollectionIdReturnsFilteredTree(): void
    {
        $parent = Section::factory()->create([
            'collection_id' => $this->collection->id,
        ]);
        Section::factory()->create([
            'collection_id' => $this->collection->id,
            'parent_id' => $parent->id,
        ]);

        $tree = $this->repository->getTreeByCollectionId($this->collection);

        $this->assertIsArray($tree);
    }

    public function testGetTreeBySectionReturnsDescendantsTree(): void
    {
        $parent = Section::factory()->create([
            'collection_id' => $this->collection->id,
        ]);
        $child = Section::factory()->create([
            'collection_id' => $this->collection->id,
            'parent_id' => $parent->id,
        ]);

        $tree = $this->repository->getTreeBySection($parent);

        $this->assertIsArray($tree);
    }
}