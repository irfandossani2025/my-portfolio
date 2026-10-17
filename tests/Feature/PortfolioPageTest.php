<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioPageTest extends TestCase
{
    public function test_the_portfolio_homepage_loads(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Irfan Shiraj Dossani')
            ->assertSee('Designing the');
    }
}
