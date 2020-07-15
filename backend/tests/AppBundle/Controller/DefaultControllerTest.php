<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testSuccessfulLogin()
    {

        $client = static::createClient();
        $data = new \stdClass();
        $data->username = "admin";
        $data->password = "admin";
        $data->getHash = true;

        $client->request('POST', '/login', [], [], ['Content-Type' => 'application/x-www-form-urlencoded'], json_encode($data));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        $this->assertContains($data->username, $client->getResponse()->getContent());
    }

    public function testFailedLogin()
    {

        $client = static::createClient();
        $data = new \stdClass();
        $data->username = "admin";
        $data->password = "123";
        $data->getHash = true;

        $client->request('POST', '/login', [], [], ['Content-Type' => 'application/x-www-form-urlencoded'], json_encode($data));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        $this->assertContains('error', $client->getResponse()->getContent());
    }

    public function testUserDetails()
    {
        $client = static::createClient();
        $data = new \stdClass();
        $data->username = "admin";
        $data->password = "admin";
        $data->getHash = true;

        $client->request('POST', '/login', [], [], ['Content-Type' => 'application/x-www-form-urlencoded'], json_encode($data));

        $req = 'authorization=' . $client->getResponse()->getContent();

        $crawler = $client->request('POST', '/user/detail/1', [], [], ['Content-Type' => 'application/x-www-form-urlencoded'], $req);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
