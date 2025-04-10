<?php
use PHPUnit\Framework\TestCase;

class HomePageTest extends TestCase
{
    public function testHomePageIsAvailable()
    {

        $url = 'http://localhost/';


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        $this->assertEquals(200, $httpCode, "De homepage is niet beschikbaar. HTTP-code: $httpCode");
    }
}
