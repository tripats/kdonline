für kuenstlerdorf international ..
user->profile->profile_public 1 bedeutet kann für kunstnetzinternational verwendet werden. bool applications->is_international ist der flag
der für veröffentlichung gesetzt werden kann. media->international sind die files die explizit vom künstler freigegeben wurden

kdonline
# kdonline
für fab
php artisan jeweils im root starten. zeigt dann liste aller befehle
php artisan migrate:fresh
resettet alle Migrations und lädt neu danach
php artisan db:seed legt standart einträge an wird aber nicht unbedingt benötigt
die meistens configs sind in .env im root verzeichnis zu finden
einige nützliche commands:
php artisan route:list
für routen.
php artisan serve  startet entwicklungsserver
in controller und template dd($var/$object/$collection) als erweitertes var_dump
# einige Hinweise
Nach Seeder class erstellen composer dump-autoload erforderlich
habe in applications ein bool is_international.das wäre dann für die einträge knetz international
alle medien files befinden unter storage/app/public/media
die lassen sich dann in blade z.b. mit {{ asset('storage/media/images_large/'.$medium->file_name) }} aufrufen.
ist ganz gut wegen crossdomain krams
media type als integer
1 = Picture
2 = Video
3 = Audio/mp3
4 = PDF

activity_id
1 Bildende Kunst
2 Mixed media
3 kww
4 Literatur
5 Composition

added boolean in medien 'international' für files die für kunstnetzinternational genutzt werden dürfen

Middleware CheckAppStatus selbst erstellt aber noch nicht 100% implementiert sprich admin interface

Tabelle: application_statuses 1 offline 2 kwww 3 artist in residence
wird in app\http\Middleware\CheckAppStatus abgefragt

Folgende Routes für Testzwecke - nachher löschen!!!
  // Test routes for additional features

  Route::get('/import', 'ImportController@import_user')->name('userimport');

  Route::get('/fileupload', 'FileController@index')->name('fileupload');
  Route::post('/add-category', ['as'=>'catagory_add','uses'=>'FileController@catadd']);

  Route::get('dropzone', 'FileController@dropzone');
  Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'FileController@dropzoneStore']);

  Route::get('/mail', 'MailController@index');
  Route::get('/send', 'MailController@send');


  Jobs SendWelcomeEmail testen / löschen etc.pp

  wird "field of activity" noch gebraucht?
 png upload geht nicht!?
 only mp4 oder auch convertieren zulassen?

media type als integer
1 = Picture
2 = Video
3 = Audio/mp3
4 = PDF

 https://limonte.github.io/sweetalert2/ einbindung? oder halt modals anschauen für löschbestätigungen
 https://github.com/PHP-FFMpeg/PHP-FFMpeg einbindung?

vielleicht such nach textfilter autolink php lib für simple_format_text($text) in Helper/helper.php

Tutorial für locales session switching
https://mydnic.be/post/laravel-5-and-his-fcking-non-persistent-app-setlocale
alternativ summernote https://summernote.org/getting-started/#compiled-css-js  implementation?
habe ich noch nicht ans laufen bekommen :(

# Todo:
mp3 file validator funzt nicht in MediaController / audioUpload
emails. translations

email config / log driver umstellen
