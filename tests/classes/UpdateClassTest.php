<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Kileo\Models\SchoolClass;
use Kileo\Models\User;

class UpdateClassTest extends TestCase {

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
            ['user_id' => $user_id, 'name' => 'UpdateClass']
        );

        $this->call('PUT', '/teacher/classes/' . $classId, [
            'name'  => 'UpdatedClass',
            '_token' => Session::token()
        ]);

        $updatedClass = SchoolClass::find($classId);
        $this->assertEquals('UpdatedClass', $updatedClass->name);
	}

    /**
     * Create a new class without name
     *
     * @return void
     */
    public function testUpdateClassWithoutName()
    {
        $user_id = Auth::user()->id;

        $classId = DB::table('school_classes')->insertGetId(
            ['user_id' => $user_id, 'name' => 'UpdateClass']
        );

        $this->call('PUT', '/teacher/classes/' . $classId, [
            'name'  => '',
            '_token' => Session::token()
        ]);

        $this->assertSessionHasErrors('name');

        $updatedClass = SchoolClass::find($classId);
        $this->assertEquals('UpdateClass', $updatedClass->name);
    }

}
