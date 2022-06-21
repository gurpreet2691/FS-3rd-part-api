<?php

namespace Tests\Feature;

use Tests\TestCase;

class UsersTest extends TestCase
{
    public function test_user_api_response()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    public function test_user_api_content_type()
    {
        $response = $this->get('/api/users');


        $response->assertHeader("content-type" ,"application/xml");
    }

}
