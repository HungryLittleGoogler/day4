<?php

use Database\Seeders\SchoolSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(SchoolSeeder::class);
});

test('the sections page lists both sections', function () {
    $this->get('/sections')
        ->assertOk()
        ->assertSee('Sampaguita')
        ->assertSee('Narra');
});

test('Andrea is INC because one grade is missing', function () {
    $this->get('/students/4')
        ->assertOk()
        ->assertSee('86.7')
        ->assertSee('INC');
});

test('a student with no grades shows NO GRADES', function () {
    $this->get('/students/11')->assertOk()->assertSee('NO GRADES');
});

test('an unknown student gives 404', function () {
    $this->get('/students/999')->assertNotFound();
});

test('Carlo Ramos passes on average', function () {
    $this->get('/sections/2')->assertOk()->assertSee('77.96')->assertSee('PASSED');
});
