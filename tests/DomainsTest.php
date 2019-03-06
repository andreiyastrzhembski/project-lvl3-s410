<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class DomainsTest extends TestCase
{
    use DatabaseMigrations;

    public function testDomainsAdd()
    {
        $url = 'https://www.google.com/';
        $this->post('/domains', ['url' => $url]);
        $this->seeInDatabase('domains', ['name' => $url]);
    }
}
