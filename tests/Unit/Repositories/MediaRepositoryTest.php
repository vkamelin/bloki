<?php

namespace Tests\Unit\Repositories;

use App\Models\Media;
use App\Repositories\MediaRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected MediaRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new MediaRepository();
    }

    public function testCreateReturnsMedia(): void
    {
        $data = [
            'uuid' => 'media-uuid',
            'path' => '/uploads/images',
            'original_name' => 'test-image.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
            'alt_text' => 'Test image',
            'caption' => 'Test caption',
            'transforms' => [],
            'is_active' => true,
        ];

        $media = $this->repository->create($data);

        $this->assertInstanceOf(Media::class, $media);
        $this->assertEquals('media-uuid', $media->uuid);
        $this->assertEquals('test-image.jpg', $media->original_name);
    }

    public function testUpdateReturnsUpdatedMedia(): void
    {
        $media = Media::factory()->create([
            'original_name' => 'original.jpg',
        ]);

        $updated = $this->repository->update($media->id, [
            'original_name' => 'updated.jpg',
        ]);

        $this->assertInstanceOf(Media::class, $updated);
        $this->assertEquals('updated.jpg', $updated->original_name);
    }

    public function testDeleteReturnsTrue(): void
    {
        $media = Media::factory()->create();

        $result = $this->repository->delete($media->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($media);
    }

    public function testRestoreReturnsRestoredMedia(): void
    {
        $media = Media::factory()->create();
        $media->delete();

        $restored = $this->repository->restore($media->id);

        $this->assertInstanceOf(Media::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsMedia(): void
    {
        $created = Media::factory()->create([
            'uuid' => 'test-uuid-123',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(Media::class, $found);
        $this->assertEquals('test-uuid-123', $found->uuid);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetByUuidReturnsMedia(): void
    {
        Media::factory()->create([
            'uuid' => 'my-media-uuid',
        ]);

        $found = $this->repository->getByUuid('my-media-uuid');

        $this->assertInstanceOf(Media::class, $found);
        $this->assertEquals('my-media-uuid', $found->uuid);
    }

    public function testGetAllReturnsArray(): void
    {
        Media::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        Media::factory()->create(['is_active' => true]);
        Media::factory()->create(['is_active' => false]);

        $active = $this->repository->getAll(['is_active' => true]);

        $this->assertIsArray($active);
        $this->assertCount(1, $active);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        Media::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        Media::factory()->create(['mime_type' => 'image/jpeg']);
        Media::factory()->create(['mime_type' => 'image/png']);

        $jpeg = $this->repository->where(['mime_type' => 'image/jpeg']);

        $this->assertIsArray($jpeg);
        $this->assertCount(1, $jpeg);
    }

    public function testWithReturnsRelations(): void
    {
        $media = Media::factory()->create();

        $result = $this->repository->with(['createdBy']);

        $this->assertIsArray($result);
    }

    public function testGetTransformationsReturnsArray(): void
    {
        $media = Media::factory()->create([
            'transforms' => json_encode(['thumb' => ['width' => 100], 'large' => ['width' => 800]]),
        ]);

        $transforms = $this->repository->getTransformations($media);

        $this->assertIsArray($transforms);
        $this->assertArrayHasKey('thumb', $transforms);
    }

    public function testAddTransformationReturnsTrue(): void
    {
        $media = Media::factory()->create([
            'transforms' => json_encode([]),
        ]);

        $result = $this->repository->addTransformation($media, ['thumb' => ['width' => 100]]);

        $this->assertTrue($result);
    }

    public function testRemoveTransformationReturnsTrue(): void
    {
        $media = Media::factory()->create([
            'transforms' => json_encode(['thumb' => ['width' => 100]]),
        ]);

        $result = $this->repository->removeTransformation($media, 'thumb');

        $this->assertTrue($result);
    }

    public function testAddMetadataReturnsTrue(): void
    {
        $media = Media::factory()->create();

        $result = $this->repository->addMetadata($media, ['author' => 'Test Author']);

        $this->assertTrue($result);
    }

    public function testRemoveMetadataReturnsTrue(): void
    {
        $media = Media::factory()->create();

        $result = $this->repository->removeMetadata($media, 'author');

        $this->assertTrue($result);
    }

    public function testUpdateMetadataReturnsTrue(): void
    {
        $media = Media::factory()->create();

        $result = $this->repository->updateMetadata($media, 'author', 'New Author');

        $this->assertTrue($result);
    }

    public function testGetMetadataReturnsValue(): void
    {
        $media = Media::factory()->create();

        $author = $this->repository->getMetadata($media, 'author');

        $this->assertNull($author);
    }

    public function testGetAllMetadataReturnsArray(): void
    {
        $media = Media::factory()->create();

        $metadata = $this->repository->getAllMetadata($media);

        $this->assertIsArray($metadata);
    }

    public function testAddFlagReturnsTrue(): void
    {
        $media = Media::factory()->create();

        $result = $this->repository->addFlag($media, 'featured');

        $this->assertTrue($result);
    }

    public function testRemoveFlagReturnsTrue(): void
    {
        $media = Media::factory()->create();

        $result = $this->repository->removeFlag($media, 'featured');

        $this->assertTrue($result);
    }

    public function testHasFlagReturnsCorrectValue(): void
    {
        $media = Media::factory()->create();

        $hasFlag = $this->repository->hasFlag($media, 'featured');

        $this->assertFalse($hasFlag);
    }

    public function testGetFlagsReturnsArray(): void
    {
        $media = Media::factory()->create();

        $flags = $this->repository->getFlags($media);

        $this->assertIsArray($flags);
    }

    public function testGetOriginalPathReturnsString(): void
    {
        $media = Media::factory()->create([
            'path' => '/uploads',
            'original_name' => 'test.jpg',
        ]);

        $path = $this->repository->getOriginalPath($media);

        $this->assertEquals('/uploads/test.jpg', $path);
    }

    public function testGetPublicPathReturnsString(): void
    {
        $media = Media::factory()->create([
            'path' => '/uploads',
            'original_name' => 'test.jpg',
        ]);

        $path = $this->repository->getPublicPath($media);

        $this->assertIsString($path);
    }

    public function testGetStoragePathReturnsString(): void
    {
        $media = Media::factory()->create([
            'path' => '/uploads',
            'original_name' => 'test.jpg',
        ]);

        $path = $this->repository->getStoragePath($media);

        $this->assertIsString($path);
    }

    public function testUpdatePathReturnsTrue(): void
    {
        $media = Media::factory()->create([
            'path' => '/old/path',
        ]);

        $result = $this->repository->updatePath($media, '/new/path');

        $this->assertTrue($result);
        $this->assertEquals('/new/path', $media->fresh()->path);
    }

    public function testIsActiveReturnsCorrectValue(): void
    {
        $active = Media::factory()->create(['is_active' => true]);
        $inactive = Media::factory()->create(['is_active' => false]);

        $this->assertTrue($this->repository->isActive($active));
        $this->assertFalse($this->repository->isActive($inactive));
    }

    public function testGetFullPathReturnsString(): void
    {
        $media = Media::factory()->create([
            'path' => '/uploads/images',
            'original_name' => 'photo.jpg',
        ]);

        $fullPath = $media->getFullPath();

        $this->assertEquals('/uploads/images/photo.jpg', $fullPath);
    }

    public function testMimeTypeCategorization(): void
    {
        $image = Media::factory()->create(['mime_type' => 'image/jpeg']);
        $video = Media::factory()->create(['mime_type' => 'video/mp4']);
        $document = Media::factory()->create(['mime_type' => 'application/pdf']);

        $this->assertStringContainsString('image', $image->mime_type);
        $this->assertStringContainsString('video', $video->mime_type);
        $this->assertStringContainsString('application', $document->mime_type);
    }

    public function testSizeInBytes(): void
    {
        $media = Media::factory()->create([
            'size' => 2048,
        ]);

        $this->assertEquals(2048, $media->size);
    }
}