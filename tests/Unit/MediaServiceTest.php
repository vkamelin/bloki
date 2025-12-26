<?php

namespace Tests\Unit;

use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected MediaService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new MediaService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(MediaService::class, $this->service);
    }

    /** @test */
    public function create_returns_media()
    {
        $data = [
            'path' => '/uploads/test.jpg',
            'original_name' => 'test.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Media::class, $result);
        $this->assertEquals('/uploads/test.jpg', $result->path);
    }

    /** @test */
    public function update_returns_updated_media()
    {
        $media = Media::factory()->create([
            'alt_text' => 'Original alt',
        ]);

        $result = $this->service->update($media, ['alt_text' => 'Updated alt']);

        $this->assertInstanceOf(Media::class, $result);
        $this->assertEquals('Updated alt', $result->alt_text);
    }

    /** @test */
    public function delete_returns_true_on_success()
    {
        $media = Media::factory()->create();

        $result = $this->service->delete($media);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_performs_soft_delete()
    {
        $media = Media::factory()->create();
        $id = $media->id;

        $this->service->delete($media);

        $this->assertSoftDeleted($media);
        $this->assertNotNull(Media::withTrashed()->find($id));
    }

    /** @test */
    public function restore_returns_restored_media()
    {
        $media = Media::factory()->create();
        $media->delete();

        $result = $this->service->restore($media);

        $this->assertInstanceOf(Media::class, $result);
        $this->assertNotNull($result->fresh());
    }

    /** @test */
    public function get_all_returns_media_items()
    {
        Media::factory()->count(3)->create();

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function get_all_respects_filters()
    {
        Media::factory()->count(2)->create(['is_active' => true]);
        Media::factory()->count(1)->create(['is_active' => false]);

        $result = $this->service->getAll(['is_active' => true]);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_by_id_returns_media()
    {
        $media = Media::factory()->create();

        $result = $this->service->getById($media->id);

        $this->assertInstanceOf(Media::class, $result);
        $this->assertEquals($media->id, $result->id);
    }

    /** @test */
    public function get_by_path_returns_media()
    {
        $media = Media::factory()->create([
            'path' => '/uploads/test-image.jpg',
        ]);

        $result = $this->service->getByPath('/uploads/test-image.jpg');

        $this->assertInstanceOf(Media::class, $result);
        $this->assertEquals('/uploads/test-image.jpg', $result->path);
    }

    /** @test */
    public function get_by_uuid_returns_media()
    {
        $media = Media::factory()->create();

        $result = $this->service->getByUuid($media->uuid);

        $this->assertInstanceOf(Media::class, $result);
        $this->assertEquals($media->uuid, $result->uuid);
    }

    /** @test */
    public function is_image_returns_true_for_image()
    {
        $image = Media::factory()->create([
            'mime_type' => 'image/jpeg',
        ]);

        $result = $this->service->isImage($image);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_image_returns_false_for_non_image()
    {
        $document = Media::factory()->create([
            'mime_type' => 'application/pdf',
        ]);

        $result = $this->service->isImage($document);

        $this->assertFalse($result);
    }

    /** @test */
    public function is_document_returns_true_for_document()
    {
        $document = Media::factory()->create([
            'mime_type' => 'application/pdf',
        ]);

        $result = $this->service->isDocument($document);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_video_returns_true_for_video()
    {
        $video = Media::factory()->create([
            'mime_type' => 'video/mp4',
        ]);

        $result = $this->service->isVideo($video);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_audio_returns_true_for_audio()
    {
        $audio = Media::factory()->create([
            'mime_type' => 'audio/mpeg',
        ]);

        $result = $this->service->isAudio($audio);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_true_for_active_media()
    {
        $media = Media::factory()->create(['is_active' => true]);

        $result = $this->service->isActive($media);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_false_for_inactive_media()
    {
        $media = Media::factory()->create(['is_active' => false]);

        $result = $this->service->isActive($media);

        $this->assertFalse($result);
    }

    /** @test */
    public function get_size_returns_integer()
    {
        $media = Media::factory()->create(['size' => 1024]);

        $result = $this->service->getSize($media);

        $this->assertIsInt($result);
        $this->assertEquals(1024, $result);
    }

    /** @test */
    public function get_extension_returns_string()
    {
        $media = Media::factory()->create([
            'original_name' => 'test.jpg',
        ]);

        $result = $this->service->getExtension($media);

        $this->assertIsString($result);
        $this->assertEquals('jpg', $result);
    }

    /** @test */
    public function get_mime_type_category_returns_string()
    {
        $image = Media::factory()->create(['mime_type' => 'image/jpeg']);

        $result = $this->service->getMimeTypeCategory($image);

        $this->assertIsString($result);
        $this->assertEquals('image', $result);
    }

    /** @test */
    public function update_alt_text_updates_field()
    {
        $media = Media::factory()->create();

        $result = $this->service->updateAltText($media, 'New alt text');

        $this->assertInstanceOf(Media::class, $result);
        $this->assertEquals('New alt text', $result->alt_text);
    }

    /** @test */
    public function update_caption_updates_field()
    {
        $media = Media::factory()->create();

        $result = $this->service->updateCaption($media, 'New caption');

        $this->assertInstanceOf(Media::class, $result);
        $this->assertEquals('New caption', $result->caption);
    }

    /** @test */
    public function add_transform_adds_transform()
    {
        $media = Media::factory()->create();

        $result = $this->service->addTransform($media, [
            'width' => 800,
            'height' => 600,
        ]);

        $this->assertInstanceOf(Media::class, $result);
    }

    /** @test */
    public function remove_transform_removes_transform()
    {
        $media = Media::factory()->create();

        $result = $this->service->removeTransform($media, 0);

        $this->assertInstanceOf(Media::class, $result);
    }

    /** @test */
    public function get_transforms_returns_array()
    {
        $media = Media::factory()->create();

        $result = $this->service->getTransforms($media);

        $this->assertIsArray($result);
    }
}