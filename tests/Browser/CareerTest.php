<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Career;
use App\Models\Term;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CareerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Can we access inside the career page being ADMIN?
     *
     * @return void
     */
    public function testAccessCareerPageAdmin()
    {
        // Creating a new data for testing Career.
        $term = Term::factory()->create();
        $user = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->browse(function (Browser $browser) use ($user, $term) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard/terms')
                    ->pause(5000)
                    ->clickLink($term->name)
                    ->assertSee('Llistat de cicles del curs '. $term->name);
        });
    }

    /**
     * Can we not access inside the career page being STUDENT?
     *
     * @return void
     */
    public function testAccessCareerPageStudent()
    {
        // Creating a new data for testing Career.
        $term = Term::factory()->create();
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $term) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard/careers?term='. $term->id)
                    ->pause(5000)
                    ->assertDontSee('Llistat de cicles del curs '. $term->name);
        });
    }

    /**
     * Create a Career.
     *
     * @return void
     */
    public function testCreateNewCareer()
    {
        // Creating a new data for testing Career.
        $career = Career::factory();
        $term = Term::factory()->create();
        $user = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->browse(function (Browser $browser) use ($user, $career, $term) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard/careers?term='. $term->id)
                    ->pause(5000)
                    ->press('Afegeix un nou curs')
                    ->type('#code', $career->code)
                    ->type('#name', $career->name)
                    ->type('#description', $career->description)
                    ->type('#hours', $career->hours)
                    ->type('#start', $career->start)
                    ->type('#end', $career->end)
                    ->press('Crea')
                    ->pause(5000)
                    ->assertSee($career->name);
        });
    }
}
