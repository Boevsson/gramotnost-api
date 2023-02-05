<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

    }

    public function testGetSubsection()
    {
        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonStructure([[
            'id',
            'name',
            'color',
            'subsection_id',
            'created_at',
            'updated_at',
        ]]);
    }

    public function testGetOneSubsection()
    {
        $response = $this->getJson('/api/categories/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'color',
            'subsection_id',
            'created_at',
            'updated_at',
        ]);
    }

    public function testCreateSubsection()
    {
        $name         = 'New Name';
        $color        = 'New Color';
        $SubsectionId = 1;

        $response = $this->postJson('/api/categories', [
            'name'          => $name,
            'color'         => $color,
            'subsection_id' => $SubsectionId,
        ]);

        $response->assertStatus(200);

        $category = Category::find(2);

        $this->assertSame($category->id, 2);
        $this->assertSame($category->name, $name);
        $this->assertSame($category->color, $color);
        $this->assertSame($category->subsection_id, $SubsectionId);
    }

    public function testUpdateSubsection()
    {
        $id          = 1;
        $name        = 'New Name';
        $color       = 'New Color';
        $subsectionId = 1;

        $response = $this->putJson('/api/categories/' . $id, [
            'name'          => $name,
            'color'         => $color,
            'subsection_id' => $subsectionId,
        ]);

        $response->assertStatus(200);

        $category = Category::find($id);

        $this->assertSame($category->name, $name);
        $this->assertSame($category->color, $color);
        $this->assertSame($category->subsection_id, $subsectionId);
    }
}
