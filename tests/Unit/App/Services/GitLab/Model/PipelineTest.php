<?php

namespace Tests\Unit\App\Services\GitLab\Model;

use App\Services\GitLab\Model\Pipeline;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Services\GitLab\Model\Pipeline
 */
class PipelineTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getProjectId
     * @covers ::getStatus
     * @covers ::getRef
     * @covers ::getWebUrl
     * @covers ::getCreatedAt
     * @covers ::getUpdatedAt
     */
    public function testConstructorWithoutArgs(): void
    {
        $sut = new Pipeline();

        $this->assertEquals(0, $sut->getId());
        $this->assertNull($sut->getProjectId());
        $this->assertNull($sut->getStatus());
        $this->assertNull($sut->getRef());
        $this->assertNull($sut->getName());
        $this->assertNull($sut->getWebUrl());
        $this->assertNull($sut->getCreatedAt());
        $this->assertNull($sut->getUpdatedAt());
    }

    /**
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getProjectId
     * @covers ::getStatus
     * @covers ::getName
     * @covers ::getRef
     * @covers ::getWebUrl
     * @covers ::getCreatedAt
     * @covers ::getUpdatedAt
     * @dataProvider provideConstructorTestData
     */
    public function testConstructor(array $data, array $expected): void
    {
        $sut = new Pipeline($data);

        $this->assertEquals($expected['id'], $sut->getId());
        $this->assertEquals($expected['project_id'], $sut->getProjectId());
        $this->assertEquals($expected['status'], $sut->getStatus());
        $this->assertEquals($expected['ref'], $sut->getRef());
        $this->assertEquals($expected['name'], $sut->getName());
        $this->assertEquals($expected['web_url'], $sut->getWebUrl());
        $this->assertEquals($expected['created_at'], $sut->getCreatedAt());
        $this->assertEquals($expected['updated_at'], $sut->getUpdatedAt());
    }

    public static function provideConstructorTestData(): array
    {
        return [
            'no data' => [
                'data' => [],
                'expected' => [
                    'id' => 0,
                    'project_id' => null,
                    'status' => null,
                    'name' => null,
                    'ref' => null,
                    'web_url' => null,
                    'created_at' => null,
                    'updated_at' => null,
                ],
            ],
            'random data' => [
                'data' => [
                    'id' => 123,
                    'project_id' => 456,
                    'status' => 'status test string',
                    'name' => 'name test string',
                    'ref' => 'ref test string',
                    'web_url' => 'web_url test string',
                    'created_at' => 'created_at test string',
                    'updated_at' => 'updated_at test string',
                ],
                'expected' => [
                    'id' => 123,
                    'project_id' => 456,
                    'status' => 'status test string',
                    'name' => 'name test string',
                    'ref' => 'ref test string',
                    'web_url' => 'web_url test string',
                    'created_at' => 'created_at test string',
                    'updated_at' => 'updated_at test string',
                ],
            ],
        ];
    }
}
