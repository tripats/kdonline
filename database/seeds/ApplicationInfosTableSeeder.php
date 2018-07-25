<?php
use App\Models\ApplicationInfos;
use App\Models\ApplicationConfig;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ApplicationInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $app = ApplicationInfos::create([
              'short_name'                           => 'off',
              'long_name'                     => 'maintenance',
              'info_en'                        => 'Notice of upcoming calls for applications:
                                                  Until the start of the next round of applications for an "artist in  residence stay with stipend you can only register in the general database of www.kuenstlerdorf-online.de with your "profile ".

The deadline for the next artist in residence stipend offers will be given in time. This will be in spring 2012. Then the start for the next round of applications for the segment of KWW-stipends for projects in the intersection of art,
science and / or economy is scheduled. ',
            'info_de' => 'Bis zum Beginn der nächsten Ausschreibungen kann man sich lediglich in der allgemeinen Datenbank
von www.kuenstlerdorf-online mit seinem "Profil" anmelden.

Die Termine für die nächsten Stipendienausschreibungen werden wie immer rechtzeitig in 2017 bekannt gegeben.'
          ]);
        $app->save();
        $app = ApplicationInfos::create([
              'short_name' => 'kww',
              'long_name' => 'Kunst Wisseschaft Wirtschaft'
          ]);
        $app->save();

        $app = ApplicationInfos::create([
              'short_name'                           => 'air',
              'long_name'                     => 'Artist in Residence',
          ]);
        $app->save();

        $info = ApplicationConfig::create([
            'application_info_id' => 2,
            'application_year' => 2017
          ]);
        $info->save();
    }
}
