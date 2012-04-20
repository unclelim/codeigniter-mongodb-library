<?php
ini_set('display_errors', TRUE);
error_reporting(-1);
header('Content-type: text/plain');

define('BASEPATH', '');
$dir = realpath(dirname(__FILE__) . '/..');
require_once 'PHPUnit/Autoload.php';
include_once $dir . '/libraries/Mongo_db.php';

class Mongo
{
	// Mock collection
	public $test;
}

class MongoLibTest extends PHPUnit_Framework_TestCase
{
	protected $mongo_db;

	public function setUp()
	{
		$this->assertTrue(class_exists('Mongo'), 'Mongo PECL library is not installed');
		$this->mongo_db = new Mongo_db();
	}

	/**
     * @expectedException Mongo_db_exception
     */
	public function testEmptyConfig()
	{
		$this->mongo_db->load();
	}

	/**
     * @expectedException PHPUnit_Framework_Error
     */
	public function testEmptyConfigArray()
	{
		$this->mongo_db->load(array());
	}

	public function testValidConfig()
	{
		$this->mongo_db->load(array(
			'mongo_hostbase'	=>	'localhost',
			'mongo_username'	=>	'test',
			'mongo_password'	=>	'test',
			'mongo_database'	=>	'test',
			'mongo_persist'	=>	TRUE,
			'mongo_persist_key'	=>	'foobar',
			'mongo_replica_set'	=>	NULL,
			'mongo_query_safety'	=>	TRUE,
			'mongo_host_db_flag'	=>	TRUE
		));
	}

	public function testHello()
	{
		$a = array();
		$this->assertEquals(0, count($a));
	}
}

//$c = new MongoLibTest;
//$c->setUp();