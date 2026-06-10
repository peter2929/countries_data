<?php

namespace Tests\Feature;

use App\Services\DataFetchService;
use App\Enums\CountryStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DataFetchServiceTest extends TestCase
{
    private DataFetchService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new DataFetchService();
    }

    public function test_fetch_returns_only_eea(): void
    {
        Http::fake(['*' => Http::response($this->europeFixture(), 200)]);

        $result = $this->service->fetch();
        $names = array_column($result, 'name');
        $this->assertContains('Latvia', $names);
        $this->assertNotContains('Moldova', $names);
    }

    public function test_fetch_maps_gini_to_status(): void
    {
        Http::fake(['*' => Http::response([
            ['name' => ['common' => 'Latvia'], 'gini' => ['2021' => 35.1]],
        ], 200)]);

        $result = $this->service->fetch();

        $this->assertSame(
            CountryStatus::fromGini(35.1)->value,
            $result[0]['status']
        );
    }

    public function test_fetch_throws_on_http_server_error(): void
    {
        Http::fake(['*' => Http::response([], 500)]);

        $this->expectException(\Exception::class);
        $this->service->fetch();
    }

    private function europeFixture(): array
    {
        return [
            ['name' => ['common' => 'Latvia'],  'gini' => ['2021' => 35.1]],
            ['name' => ['common' => 'Moldova'], 'gini' => ['2018' => 25.7]], // non-EEA
            ['name' => ['common' => 'Germany'], 'gini' => ['2019' => 31.7]],
        ];
    }
}
