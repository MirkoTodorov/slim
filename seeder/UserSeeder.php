<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Mirko',
                'surname' => 'Todorov',
                'age' => 22
            ],
            [
                'name' => 'Pero',
                'surname' => 'Perov',
                'age' => 33
            ],
            [
                'name' => 'Brat',
                'surname' => 'Be',
                'age' => 12
            ],
            [
                'name' => 'Majstor',
                'surname' => 'Stojko',
                'age' => 44
            ],
            [
                'name' => 'Zver',
                'surname' => 'Zverov',
                'age' => 29
            ]
        ];

        $table = $this->table('user');
        $table->insert($data);
        $table->save();
    }
}
