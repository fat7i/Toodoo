<?php

namespace Toodoo\Tests\Feature;

use Toodoo\Helpers\Helper;
use Toodoo\Tests\TestCase;

class TodoListTest extends TestCase
{
    /**
     * @param array $postArray
     * @dataProvider validPayload
     */
    public function testValidCreate(array $postArray)
    {
        $response = $this->json('POST', 'api.php/lists/', $postArray);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(['id', 'uuid', 'name']);
    }

    /**
     *
     */
    public function testCreateWithoutParams()
    {
        $response = $this->json('POST', 'api.php/lists/', []);

        $response
            ->assertStatus(400)
            ->assertJsonStructure(['name', 'participants'])
            ->assertJson([
                'name' => ['The name field is required.'],
                'participants' => ['The participants field is required.'],
            ]);
    }

    /**
     *
     */
    public function testDelete()
    {
        $uuid = $this->getUuid();
        $response = $this->json('DELETE', 'api.php/lists/'. $uuid);
        //$response->assertStatus(204);
    }

    /**
     * @param string $fakeUuid
     * @dataProvider getFakeUuid
     */
    public function testDeleteNotFoundList($fakeUuid)
    {
        $response = $this->json('DELETE', 'api.php/lists/'. $fakeUuid);

        $response->assertStatus(404);
    }

    /**
     *
     */
    public function testReadValidList()
    {
        $uuid = $this->getUuid();
        $response = $this->json('GET', 'api.php/lists/'. $uuid .'/todos');

        //$response->assertStatus(200);
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        $postArray = [
            "name" => "Todo List Name",
            "participants" => [
                "participant1@example.org",
                "participant2@example.org",
                "participant3@example.org"
            ]
        ];

        $response = $this
            ->json('POST', 'api.php/lists/', $postArray)
            ->decodeResponseJson();

        return $response['uuid'];
    }

    /**
     * @return array
     */
    public function getFakeUuid(): array
    {
        return array( Helper::uuid() );
    }

    /**
     * @return array
     */
    public function validPayload(): array
    {
        return [[
            [
                "name" => "Todo List Name",
                "participants" => [
                    "participant1@example.org",
                    "participant2@example.org",
                    "participant3@example.org"
                ]
            ]
        ]];
    }
}
