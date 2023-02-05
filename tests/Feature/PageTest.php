<?php

namespace Tests\Feature;

use App\Models\QuestionType;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

    }

    public function testGetPages()
    {
        $response = $this->getJson('/api/pages');

        $response->assertStatus(200);
        $response->assertJsonStructure([[
                                            'id',
                                            'text',
                                            'title',
                                            'slug',
                                            'created_at',
                                            'updated_at',
                                        ]]);
    }

    public function testGetOnePage()
    {
        $response = $this->getJson('/api/pages');

        $response->assertStatus(200);
        $response->assertJsonStructure([[
                                            'id',
                                            'text',
                                            'title',
                                            'slug',
                                            'created_at',
                                            'updated_at',
                                        ]]);
    }

    public function testCreatePage()
    {
        $text = 'test text';
        $title = 'test title';
        $slug = 'test-title';

        $response = $this->postJson('/api/pages', [
            'text'  => $text,
            'title' => $title,
            'slug'  => $slug,
        ]);

        $response->assertStatus(200);

        $teachersPage = Page::find(2);

        $this->assertSame($teachersPage->id, 2);
        $this->assertSame($teachersPage->text, $text);
        $this->assertSame($teachersPage->title, $title);
        $this->assertSame($teachersPage->slug, $slug);
    }

    public function testUpdatePage()
    {
        $id = 1;
        $text = 'test text';
        $title = 'test title';
        $slug = 'test-title';

        $response = $this->putJson('/api/pages/' . $id, [
            'text'  => $text,
            'title' => $title,
            'slug'  => $slug,
        ]);

        $response->assertStatus(200);

        $teachersPage = Page::find($id);

        $this->assertSame($teachersPage->text, $text);
        $this->assertSame($teachersPage->title, $title);
        $this->assertSame($teachersPage->slug, $slug);
    }
}
