<?php

namespace Tests\Feature;

use Database\Factories\ProjectFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectsPageTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_lists_projects_with_their_link_and_summary(): void
    {
        ProjectFactory::new()->create([
            'name' => 'laravel-thing',
            'url' => 'https://github.com/svenluijten/laravel-thing',
            'summary' => 'A thing for Laravel.',
        ]);

        $this->get(route('projects.index'))
            ->assertOk()
            ->assertSee('laravel-thing')
            ->assertSee('href="https://github.com/svenluijten/laravel-thing"', escape: false)
            ->assertSee('A thing for Laravel.');
    }
}
