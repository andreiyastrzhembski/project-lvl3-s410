<?php

class MainPageTest extends TestCase
{

    public function testMainPage()
    {
        $code = $this->call('GET', '/')->status();
        $this->assertResponseOk($code);
    }
}
