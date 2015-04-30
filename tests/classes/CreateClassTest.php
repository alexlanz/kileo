<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Kileo\Models\User;

class CreateClassTest extends TestCase {

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


    public function tearDown()
    {
        DB::rollback();
    }


	/**
	 * Create a new class
	 *
	 * @return void
	 */
	public function testCreateClass()
	{
        $user_id = Auth::user()->id;

        $original_classes = DB::table('school_classes')->where('user_id', $user_id)->lists('id');

		$response = $this->call('POST', '/teacher/classes', [
            'name'  => 'Test',
            '_token' => Session::token()
        ]);

		$this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/teacher');


        $classes = DB::table('school_classes')->where('user_id', $user_id)->lists('id');
        $this->assertEquals(count($original_classes) + 1, count($classes));

	}

    /**
     * Create a new class without name
     *
     * @return void
     */
    public function testCreateClassWithoutName()
    {
        $user_id = Auth::user()->id;
        $original_classes = DB::table('school_classes')->where('user_id', $user_id)->lists('id');

        $this->call('POST', '/teacher/classes', [
            'name'  => '',
            '_token' => Session::token()
        ]);

        $this->assertSessionHasErrors('name');

        $classes = DB::table('school_classes')->where('user_id', $user_id)->lists('id');
        $this->assertEquals(count($original_classes), count($classes));
    }

}
