<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use App\Usr;

class FunctionalityTest extends DuskTestCase
{
    // /**@test */
    // public function testHomepageStatusCheck(){
    //     $this->browse(function ($browser){
    //         $browser->visit('/')->assertStatus(200);
    //     });
        
    // }

    // /**@test */
    // public function testHomepageLoginPageRedirect(){
    //     $this->browse(function ($browser){
    //         $browser->visit('/login')
    //         ->press('login')
    //         ->assertRedirect('/login');
    //     });
    // }
    
    /**@test */
    public function testHomePageProfilePageRedirect(){
        $user = factory(User::class)->create(['surname'=>'userlastname'],);
        $this->browse(function ($browser) use($user){
            $browser->loginAs($user);
            $browser->visit('/')
            ->click('navbarDropdown')
            ->click('Mijn gegevens')
            ->assertRedirect('/user');
        });

    }
}
