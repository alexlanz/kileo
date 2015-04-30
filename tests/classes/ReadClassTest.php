<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Kileo\Models\SchoolClass;
use Kileo\Models\User;

class ReadClassTest extends TestCase {

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Session::start();
        $user = User::where('username', 'alex')->first();
        $this->be($user);

        DB::beginTransaction();

    }

    /**
     *
     * Tear down test environment
     *
     */
    public function tearDown()
    {
        DB::rollback();
    }


	/**
	 * Read a class
	 *
	 * @return void
	 */
	public function testReadClass()
	{
        $user_id = Auth::user()->id;

        $classId = DB::table('school_classes')->insertGetId(
            ['user_id' => $user_id, 'name' => 'ReadClass']
        );

        $response = $this->call('GET', '/teacher/classes/' . $classId);

        $this->assertResponseOk();
        $this->assertContains('ReadClass', $response->getContent());
	}

}
