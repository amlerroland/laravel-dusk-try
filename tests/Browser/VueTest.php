<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VueTest extends DuskTestCase
{
    /** @test */
    public function vue_component_title_is_visible()
    {
        $this->browse(function (Browser $browser) {
            // basic stuff
            $browser->loginAs(1)
                ->visit('/home')
                ->assertSee('Laravel')
                ->assertSee('Example Component');
        });
    }

    /** @test */
    public function page_length_selector_is_visible()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/home')
                ->assertSee('Page Length');
        });
    }

    /** @test */
    public function products_list_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/home')
                ->with('#products', function ($ul) {
                    $ul->waitFor('.product')
                        ->assertSee('product1');
                });
        });
    }

    /** @test */
    public function page_length_select_loads_new_products()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/home')
                ->waitFor('.product')
                ->select('page_length', 25)
                ->pause(1000)
                ->assertSee('product11');
        });
    }

    /** @test */
    public function can_paginate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/home')
                ->waitFor('.product')
                ->click('@page-2')
                ->pause(1000)
                ->assertSee('product11');
        });
    }
}
