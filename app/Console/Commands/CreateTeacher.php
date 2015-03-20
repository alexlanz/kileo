<?php namespace Kileo\Console\Commands;

use Kileo\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class CreateTeacher extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'kileo:create-teacher';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a teacher account';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
        $name = $this->argument('name');
        $username = $this->argument('username');
        $password = $this->argument('password');

        $teacher = User::where('username', $username)->first();

        if ( ! is_null($teacher))
        {
            $this->error("Username $username already taken.");
            return;
        }

        $teacher = new User();
        $teacher->name = $name;
        $teacher->username = $username;
        $teacher->password = $password;
        $teacher->type = 'teacher';
        $teacher->save();

        $this->info("Teacher $username created!");
	}

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'The name of the teacher.'),
            array('username', InputArgument::REQUIRED, 'The username of the teacher.'),
            array('password', InputArgument::REQUIRED, 'The password of the teacher.'),
        );
    }

}
