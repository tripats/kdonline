<?php
use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $app = Application::create(
            [
          'user_id' => 1,
              'expectations' => 'hier kommmen die expectations',
              'description' => 'meine beschreibung',
              'activity_id' => 1,
              'application_year' => 2016,
              'family' => 1,
              'preferred_start' => 1,
              'homepage' => 'http://www.wurst.de',
              'duration'  => 2,
              'is_painting' => 1,
              'is_graphic'  => 1,
              'is_photography' => 1,
              'is_video' => 1,
              'is_sculpture' => 1,
              'is_installation' => 1,
              'is_object' => 1,
              'is_performance' => 1,
              'is_mixed_media' => 1,
              'is_participative' => 1,
              'is_sound' => 0,
              'is_internet' => 1,
              'is_interdisciplinary' => 1,
              'is_focus_visual' => 1,
              'is_focus_sciences' => 1,
              'is_focus_economics' => 1,
              'is_roman' => 1,
          'is_energy' => 1,
              'is_literature_both' => 1,
          'is_theather' => 1,
              'is_proposed' => 1]
            );
        $app->save();
    }
}
