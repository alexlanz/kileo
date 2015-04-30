<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Kileo\Models\SchoolClass;
use Kileo\Models\User;

class DeleteClassTest extends TestCase {

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
	 * Update a class
	 *
	 * @return void
	 */
	public function testUpdateClass()
	{
        $user_id = Auth::user()->id;

        $classId = DB::table('school_classes')->insertGetId(
            ['user_id' => $user_id, 'name' => 'DeleteClass']
        );

        $response = $this->call('DELETE', '/teacher/classes/' . $classId, [
            '_token' => Session::token()
        ]);

        $deletedClass = SchoolClass::find($classId);
        $this->assertEquals(null , $deletedClass);
	}

}
