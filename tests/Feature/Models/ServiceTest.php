<?php

namespace Tests\Feature\Models;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{

    use RefreshDatabase;

    public function test_soft_delete_for_model(): void
    {
        $service = Service::factory()->create();

        $service->delete();

        $this->assertSoftDeleted($service);
    }
}
