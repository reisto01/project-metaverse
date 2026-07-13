<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_marketplace_urls_must_use_http_or_https(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role_id' => 1, 'is_deleted' => 1]);

        $this->actingAs($admin)->post('/inputMetaland', [
            'owner_land' => 'Owner',
            'name_land' => 'Unsafe land',
            'desc_land' => 'Description',
            'url_land' => 'javascript:alert(1)',
            'price_land' => 10,
            'img_land' => UploadedFile::fake()->image('land.jpg'),
        ])->assertSessionHasErrors('url_land');

        $this->assertDatabaseMissing('tb_metamap', ['title' => 'Unsafe land']);
    }

    public function test_contact_schema_contains_the_answer_column(): void
    {
        $this->assertTrue(\Schema::hasColumn('tb_mail', 'answere'));
    }
}
