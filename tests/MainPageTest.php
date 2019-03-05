<?php

class MainPageTest extends TestCase
{

    public function testMainPage()
    {
        $this->assertResponseOk($this->call('GET', '/')->status());
    }
}
