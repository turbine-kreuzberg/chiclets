<?php

namespace Tests\Unit\App\Services\GitLab\Model;

use App\Services\GitLab\Model\Project;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Services\GitLab\Model\Project
 */
class ProjectTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getName
     * @covers ::getWebUrl
     * @covers ::getAvatarUrl
     * @covers ::getDefaultBranch
     */
    public function testConstructorWithoutArgs(): void
    {
        $sut = new Project();

        $this->assertEquals(0, $sut->getId());
        $this->assertNull($sut->getName());
        $this->assertNull($sut->getWebUrl());
        $this->assertNull($sut->getAvatarUrl());
        $this->assertNull($sut->getDefaultBranch());
    }

    /**
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getProjectId
     * @covers ::getStatus
     * @covers ::getRef
     * @covers ::getWebUrl
     * @covers ::getCreatedAt
     * @covers ::getUpdatedAt
     * @dataProvider provideConstructorTestData
     */
    public function testConstructor(array $data, array $expected): void
    {
        $sut = new Project($data);

        $this->assertEquals($expected['id'], $sut->getId());
        $this->assertEquals($expected['name'], $sut->getName());
        $this->assertEquals($expected['web_url'], $sut->getWebUrl());
        $this->assertEquals($expected['avatar_url'], $sut->getAvatarUrl());
        $this->assertEquals($expected['default_branch'], $sut->getDefaultBranch());
    }

    public static function provideConstructorTestData(): array
    {
        return [
            'no data' => [
                'data' => [],
                'expected' => [
                    'id' => 0,
                    'name' => null,
                    'web_url' => null,
                    'avatar_url' => null,
                    'default_branch' => null,
                ],
            ],
            'random data' => [
                'data' => [
                    'id' => 123,
                    'name' => 'name test string',
                    'web_url' => 'web_url test string',
                    'avatar_url' => 'avatar_url test string',
                    'default_branch' => 'default_branch test string',
                ],
                'expected' => [
                    'id' => 123,
                    'name' => 'name test string',
                    'web_url' => 'web_url test string',
                    'avatar_url' => 'avatar_url test string',
                    'default_branch' => 'default_branch test string',
                ],
            ],
        ];
    }
}
