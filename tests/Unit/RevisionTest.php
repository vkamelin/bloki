<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Entry;
use App\Models\Revision;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevisionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_revision()
    {
        $entry = Entry::factory()->create();
        
        $revision = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $entry->id,
            'data' => ['title' => 'Updated Title', 'content' => 'Updated content'],
            'note' => 'Updated title and content',
        ]);

        $this->assertInstanceOf(Revision::class, $revision);
        $this->assertEquals('entry', $revision->entity_type);
        $this->assertEquals($entry->id, $revision->entity_id);
        $this->assertIsArray($revision->data);
        $this->assertEquals('Updated Title', $revision->data['title']);
        $this->assertEquals('Updated content', $revision->data['content']);
        $this->assertEquals('Updated title and content', $revision->note);
    }

    /** @test */
    public function it_belongs_to_an_entry()
    {
        $entry = Entry::factory()->create();
        $revision = Revision::factory()->create([
            'entry_type' => 'entry',
            'entry_id' => $entry->id,
        ]);

        $this->assertInstanceOf(Entry::class, $revision->entry);
        $this->assertEquals($entry->id, $revision->entry->id);
    }

    /** @test */
    public function it_belongs_to_created_by_admin()
    {
        $admin = Admin::factory()->create();
        $revision = Revision::factory()->create([
            'created_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $revision->createdBy);
        $this->assertEquals($admin->id, $revision->createdBy->id);
    }

    /** @test */
    public function get_data_returns_array()
    {
        $data = [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'metadata' => ['key' => 'value'],
        ];
        $revision = Revision::factory()->create([
            'data' => json_encode($data),
        ]);

        $result = $revision->getDataAttribute();
        $this->assertIsArray($result);
        $this->assertEquals('Test Title', $result['title']);
        $this->assertEquals('Test Content', $result['content']);
        $this->assertEquals('value', $result['metadata']['key']);
    }

    /** @test */
    public function set_data_encodes_to_json()
    {
        $revision = Revision::factory()->create();
        $data = [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'metadata' => ['key' => 'value'],
        ];

        $revision->setDataAttribute($data);

        $this->assertEquals(json_encode($data), $revision->attributes['data']);
    }

    /** @test */
    public function it_does_not_have_timestamps()
    {
        $revision = Revision::factory()->create();
        
        $this->assertFalse($revision->timestamps);
        $this->assertFalse($revision->usesTimestamps());
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $revision = Revision::factory()->create();
        $revisionId = $revision->id;

        $revision->delete();

        $this->assertSoftDeleted($revision);
        $this->assertNotNull(Revision::withTrashed()->find($revisionId));
    }

    /** @test */
    public function it_casts_data_to_array()
    {
        $data = ['key' => 'value', 'number' => 42];
        $revision = Revision::factory()->create([
            'data' => $data,
        ]);

        $this->assertIsArray($revision->data);
        $this->assertEquals('value', $revision->data['key']);
        $this->assertEquals(42, $revision->data['number']);
    }

    /** @test */
    public function it_casts_timestamp_to_timestamp()
    {
        $timestamp = now();
        $revision = Revision::factory()->create([
            'timestamp' => $timestamp,
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $revision->timestamp);
        $this->assertEquals($timestamp->format('Y-m-d H:i:s'), $revision->timestamp->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_handles_empty_data()
    {
        $revision = Revision::factory()->create([
            'data' => json_encode([]),
        ]);

        $data = $revision->getDataAttribute();
        $this->assertIsArray($data);
        $this->assertEmpty($data);
    }

    /** @test */
    public function it_handles_null_data()
    {
        $revision = Revision::factory()->create([
            'data' => null,
        ]);

        $data = $revision->getDataAttribute();
        $this->assertNull($data);
    }

    /** @test */
    public function it_handles_complex_data_structures()
    {
        $data = [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'metadata' => [
                'author' => 'John Doe',
                'tags' => ['tag1', 'tag2', 'tag3'],
                'settings' => [
                    'featured' => true,
                    'priority' => 1,
                    'custom_fields' => [
                        'field1' => 'value1',
                        'field2' => 42,
                    ],
                ],
            ],
            'nested' => [
                'level1' => [
                    'level2' => [
                        'level3' => 'deep value',
                    ],
                ],
            ],
        ];

        $revision = Revision::factory()->create([
            'data' => json_encode($data),
        ]);

        $result = $revision->getDataAttribute();
        $this->assertIsArray($result);
        $this->assertEquals('Test Title', $result['title']);
        $this->assertEquals('John Doe', $result['metadata']['author']);
        $this->assertEquals(['tag1', 'tag2', 'tag3'], $result['metadata']['tags']);
        $this->assertTrue($result['metadata']['settings']['featured']);
        $this->assertEquals('deep value', $result['nested']['level1']['level2']['level3']);
    }

    /** @test */
    public function it_handles_different_entity_types()
    {
        $entityTypes = ['entry', 'section', 'collection'];
        
        foreach ($entityTypes as $entityType) {
            $revision = Revision::factory()->create([
                'entity_type' => $entityType,
            ]);
            $this->assertEquals($entityType, $revision->entity_type);
        }
    }

    /** @test */
    public function it_handles_different_entity_ids()
    {
        $entry1 = Entry::factory()->create();
        $entry2 = Entry::factory()->create();
        $entry3 = Entry::factory()->create();

        $revision1 = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $entry1->id,
        ]);
        $revision2 = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $entry2->id,
        ]);
        $revision3 = Revision::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $entry3->id,
        ]);

        $this->assertEquals($entry1->id, $revision1->entity_id);
        $this->assertEquals($entry2->id, $revision2->entity_id);
        $this->assertEquals($entry3->id, $revision3->entity_id);
    }

    /** @test */
    public function it_handles_notes()
    {
        $notes = [
            'Initial creation',
            'Updated title',
            'Modified content',
            'Added metadata',
            'Status change to published',
        ];
        
        foreach ($notes as $note) {
            $revision = Revision::factory()->create([
                'note' => $note,
            ]);
            $this->assertEquals($note, $revision->note);
        }
    }

    /** @test */
    public function it_handles_null_note()
    {
        $revision = Revision::factory()->create([
            'note' => null,
        ]);

        $this->assertNull($revision->note);
    }

    /** @test */
    public function it_handles_empty_note()
    {
        $revision = Revision::factory()->create([
            'note' => '',
        ]);

        $this->assertEquals('', $revision->note);
    }

    /** @test */
    public function it_handles_long_notes()
    {
        $longNote = str_repeat('This is a very long note. ', 100);
        $revision = Revision::factory()->create([
            'note' => $longNote,
        ]);

        $this->assertEquals($longNote, $revision->note);
        $this->assertGreaterThan(1000, strlen($revision->note));
    }

    /** @test */
    public function it_can_be_created_with_minimal_data()
    {
        $revision = Revision::factory()->create([
            'entity_type' => 'entry',
            'data' => ['title' => 'Test'],
        ]);

        $this->assertInstanceOf(Revision::class, $revision);
        $this->assertEquals('entry', $revision->entity_type);
        $this->assertIsArray($revision->data);
        $this->assertEquals('Test', $revision->data['title']);
    }

    /** @test */
    public function it_handles_unicode_in_data()
    {
        $unicodeData = [
            'title' => 'Тестовый заголовок',
            'content' => 'Содержимое с русским текстом',
            'emoji' => '🚀 Привет мир! 🎉',
            'chinese' => '你好世界',
        ];

        $revision = Revision::factory()->create([
            'data' => json_encode($unicodeData, JSON_UNESCAPED_UNICODE),
        ]);

        $result = $revision->getDataAttribute();
        $this->assertEquals('Тестовый заголовок', $result['title']);
        $this->assertEquals('Содержимое с русским текстом', $result['content']);
        $this->assertEquals('🚀 Привет мир! 🎉', $result['emoji']);
        $this->assertEquals('你好世界', $result['chinese']);
    }

    /** @test */
    public function it_handles_unicode_in_notes()
    {
        $unicodeNotes = [
            'Заметка на русском языке',
            'Note with émojis 🚀',
            '中文注释',
            'العربية note',
        ];
        
        foreach ($unicodeNotes as $note) {
            $revision = Revision::factory()->create([
                'note' => $note,
            ]);
            $this->assertEquals($note, $revision->note);
        }
    }
}