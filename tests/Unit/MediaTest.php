<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_media()
    {
        $media = Media::factory()->create([
            'path' => '/uploads/images',
            'original_name' => 'test-image.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024000,
            'alt_text' => 'Test Image Alt Text',
            'caption' => 'This is a test image caption',
            'is_active' => true,
        ]);

        $this->assertInstanceOf(Media::class, $media);
        $this->assertEquals('/uploads/images', $media->path);
        $this->assertEquals('test-image.jpg', $media->original_name);
        $this->assertEquals('image/jpeg', $media->mime_type);
        $this->assertEquals(1024000, $media->size);
        $this->assertEquals('Test Image Alt Text', $media->alt_text);
        $this->assertEquals('This is a test image caption', $media->caption);
        $this->assertTrue($media->isActive());
    }

    /** @test */
    public function it_belongs_to_created_by_admin()
    {
        $admin = Admin::factory()->create();
        $media = Media::factory()->create([
            'created_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $media->createdBy);
        $this->assertEquals($admin->id, $media->createdBy->id);
    }

    /** @test */
    public function it_belongs_to_updated_by_admin()
    {
        $admin = Admin::factory()->create();
        $media = Media::factory()->create([
            'updated_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $media->updatedBy);
        $this->assertEquals($admin->id, $media->updatedBy->id);
    }

    /** @test */
    public function get_transforms_returns_array()
    {
        $transforms = [
            'thumbnail' => ['width' => 150, 'height' => 150],
            'medium' => ['width' => 300, 'height' => 200],
        ];
        $media = Media::factory()->create([
            'transforms' => json_encode($transforms),
        ]);

        $result = $media->getTransformsAttribute();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('thumbnail', $result);
        $this->assertArrayHasKey('medium', $result);
        $this->assertEquals(150, $result['thumbnail']['width']);
        $this->assertEquals(150, $result['thumbnail']['height']);
    }

    /** @test */
    public function set_transforms_encodes_to_json()
    {
        $media = Media::factory()->create();
        $transforms = [
            'thumbnail' => ['width' => 150, 'height' => 150],
            'medium' => ['width' => 300, 'height' => 200],
        ];

        $media->setTransformsAttribute($transforms);

        $this->assertEquals(json_encode($transforms), $media->attributes['transforms']);
    }

    /** @test */
    public function get_full_path_returns_correct_path()
    {
        $media = Media::factory()->create([
            'path' => '/uploads/images',
            'original_name' => 'test-image.jpg',
        ]);

        $fullPath = $media->getFullPath();
        $this->assertEquals('/uploads/images/test-image.jpg', $fullPath);
    }

    /** @test */
    public function get_transformed_path_returns_empty_string_for_todo()
    {
        $media = Media::factory()->create();
        $preset = ['width' => 300, 'height' => 200];

        $transformedPath = $media->getTransformedPath($preset);
        
        // TODO: Метод возвращает пустую строку до реализации
        $this->assertEquals('', $transformedPath);
    }

    /** @test */
    public function is_active_returns_correct_value()
    {
        $activeMedia = Media::factory()->create(['is_active' => true]);
        $inactiveMedia = Media::factory()->create(['is_active' => false]);

        $this->assertTrue($activeMedia->isActive());
        $this->assertFalse($inactiveMedia->isActive());
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $media = Media::factory()->create();
        $mediaId = $media->id;

        $media->delete();

        $this->assertSoftDeleted($media);
        $this->assertNotNull(Media::withTrashed()->find($mediaId));
    }

    /** @test */
    public function it_casts_transforms_to_array()
    {
        $transforms = ['key' => 'value', 'number' => 42];
        $media = Media::factory()->create([
            'transforms' => $transforms,
        ]);

        $this->assertIsArray($media->transforms);
        $this->assertEquals('value', $media->transforms['key']);
        $this->assertEquals(42, $media->transforms['number']);
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $media = Media::factory()->create(['is_active' => true]);
        $this->assertIsBool($media->is_active);
        $this->assertTrue($media->is_active);
    }

    /** @test */
    public function it_handles_different_mime_types()
    {
        $mimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'application/pdf',
            'video/mp4',
            'audio/mp3',
        ];
        
        foreach ($mimeTypes as $mimeType) {
            $media = Media::factory()->create([
                'mime_type' => $mimeType,
                'original_name' => 'test.' . explode('/', $mimeType)[1],
            ]);
            $this->assertEquals($mimeType, $media->mime_type);
        }
    }

    /** @test */
    public function it_handles_different_file_sizes()
    {
        $sizes = [
            1024,           // 1KB
            1048576,        // 1MB
            10485760,       // 10MB
            104857600,      // 100MB
        ];
        
        foreach ($sizes as $size) {
            $media = Media::factory()->create(['size' => $size]);
            $this->assertEquals($size, $media->size);
        }
    }

    /** @test */
    public function it_handles_empty_transforms()
    {
        $media = Media::factory()->create([
            'transforms' => json_encode([]),
        ]);

        $transforms = $media->getTransformsAttribute();
        $this->assertIsArray($transforms);
        $this->assertEmpty($transforms);
    }

    /** @test */
    public function it_handles_null_transforms()
    {
        $media = Media::factory()->create([
            'transforms' => null,
        ]);

        $transforms = $media->getTransformsAttribute();
        $this->assertNull($transforms);
    }

    /** @test */
    public function it_handles_complex_transforms()
    {
        $transforms = [
            'thumbnail' => [
                'width' => 150,
                'height' => 150,
                'crop' => true,
                'quality' => 80,
            ],
            'medium' => [
                'width' => 300,
                'height' => 200,
                'crop' => false,
                'quality' => 90,
            ],
            'large' => [
                'width' => 800,
                'height' => 600,
                'crop' => true,
                'quality' => 95,
            ],
        ];

        $media = Media::factory()->create([
            'transforms' => json_encode($transforms),
        ]);

        $result = $media->getTransformsAttribute();
        $this->assertIsArray($result);
        $this->assertEquals(150, $result['thumbnail']['width']);
        $this->assertTrue($result['thumbnail']['crop']);
        $this->assertFalse($result['medium']['crop']);
    }

    /** @test */
    public function it_handles_uuid()
    {
        $media = Media::factory()->create();

        $this->assertNotNull($media->uuid);
        $this->assertIsString($media->uuid);
    }

    /** @test */
    public function it_handles_special_characters_in_file_names()
    {
        $specialNames = [
            'тест-файл.jpg',
            'test file with spaces.jpg',
            'test-file_with-special-chars@.jpg',
            'test.file.with.dots.jpg',
        ];
        
        foreach ($specialNames as $name) {
            $media = Media::factory()->create([
                'original_name' => $name,
            ]);
            $this->assertEquals($name, $media->original_name);
        }
    }

    /** @test */
    public function it_handles_different_paths()
    {
        $paths = [
            '/uploads/images',
            '/uploads/documents',
            '/uploads/videos',
            '/storage/app/public/media',
        ];
        
        foreach ($paths as $path) {
            $media = Media::factory()->create([
                'path' => $path,
            ]);
            $this->assertEquals($path, $media->path);
        }
    }

    /** @test */
    public function get_full_path_handles_different_path_formats()
    {
        $testCases = [
            ['/uploads/images', 'test.jpg', '/uploads/images/test.jpg'],
            ['uploads/images', 'test.jpg', 'uploads/images/test.jpg'],
            ['/uploads/', 'test.jpg', '/uploads/test.jpg'],
            ['uploads', 'test.jpg', 'uploads/test.jpg'],
        ];
        
        foreach ($testCases as [$path, $name, $expected]) {
            $media = Media::factory()->create([
                'path' => $path,
                'original_name' => $name,
            ]);
            
            $this->assertEquals($expected, $media->getFullPath());
        }
    }

    /** @test */
    public function it_can_be_created_with_minimal_data()
    {
        $media = Media::factory()->create([
            'original_name' => 'minimal.jpg',
            'mime_type' => 'image/jpeg',
        ]);

        $this->assertInstanceOf(Media::class, $media);
        $this->assertEquals('minimal.jpg', $media->original_name);
        $this->assertEquals('image/jpeg', $media->mime_type);
        $this->assertTrue($media->isActive());
    }
}