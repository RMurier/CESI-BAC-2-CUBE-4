<?php

use PHPUnit\Framework\TestCase;
use App\Models\Articles;

class ArticlesTest extends TestCase
{
    protected $articles;

    protected function setUp(): void
    {
        $this->articles = $this->getMockBuilder(Articles::class)
                               ->onlyMethods(['getDB'])
                               ->getMock();
    }

    public function testGetAll()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();
        
        $mockDB->expects($this->once())
               ->method('query')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('fetchAll')
                 ->willReturn([['id' => 1, 'name' => 'Test Article']]);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $result = $this->articles->getAll('');
        $this->assertIsArray($result);
        $this->assertEquals(1, count($result));
    }

    public function testGetOne()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();
        
        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->with([1]);

        $mockStmt->expects($this->once())
                 ->method('fetchAll')
                 ->willReturn([['idUser' => 1, 'username' => 'testuser']]);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $result = $this->articles->getOne(1);
        $this->assertIsArray($result);
    }

    public function testGetById()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->with([1]);

        $mockStmt->expects($this->once())
                 ->method('fetch')
                 ->willReturn(['id' => 1, 'name' => 'Test Article']);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $result = $this->articles->getById(1);
        $this->assertIsArray($result);
    }

    public function testAddOneView()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->with([1]);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $this->articles->addOneView(1);
        $this->assertTrue(true);  // Just testing if no exceptions are thrown
    }

    public function testGetByUser()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->with([1]);

        $mockStmt->expects($this->once())
                 ->method('fetchAll')
                 ->willReturn([['id' => 1, 'name' => 'Test Article']]);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $result = $this->articles->getByUser(1);
        $this->assertIsArray($result);
    }

    public function testGetSuggest()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute');

        $mockStmt->expects($this->once())
                 ->method('fetchAll')
                 ->willReturn([['id' => 1, 'name' => 'Test Article']]);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $result = $this->articles->getSuggest();
        $this->assertIsArray($result);
    }

    public function testSearchByName()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->with([':name' => '%test%']);

        $mockStmt->expects($this->once())
                 ->method('fetchAll')
                 ->willReturn([['id' => 1, 'name' => 'Test Article']]);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $result = $this->articles->searchByName('test');
        $this->assertIsArray($result);
    }

    public function testSave()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute');

        $mockDB->expects($this->once())
               ->method('lastInsertId')
               ->willReturn(1);

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $data = ['name' => 'Test Article', 'description' => 'Test Desc', 'user_id' => 1];
        $result = $this->articles->save($data);
        $this->assertEquals(1, $result);
    }

    public function testAttachPicture()
    {
        $mockDB = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $mockStmt = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockDB->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute');

        $this->articles->expects($this->once())
                       ->method('getDB')
                       ->willReturn($mockDB);

        $this->articles->attachPicture(1, 'image.png');
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        unset($this->articles);
    }
}
