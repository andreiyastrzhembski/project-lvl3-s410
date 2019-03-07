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

    public function testDomainsShow()
    {
        $url = 'https://ru.hexlet.io/';
        $this->post('/domains', ['url' => $url]);
        $this->get('/domains/1');
        $content = $this->response->getContent();
        $this->assertContains($url, $content);
    }

    public function testDomainsAll()
    {
        $url1 = 'https://mail.ru/';
        $url2 = 'https://tut.by';
        $this->post('/domains', ['url' => $url1]);
        $this->post('/domains', ['url' => $url2]);
        $this->get('/domains');
        $content = $this->response->getContent();
        $this->assertContains($url1, $content);
        $this->assertContains($url2, $content);
    }
}
