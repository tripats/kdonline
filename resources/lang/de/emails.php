<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various emails that
    | we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    /*
     * Activate new user account email.
     *
     */

    'activationSubject'  => 'Aktivierung erforderlich',
    'activationGreeting' => 'Willkommen!',
    'activationMessage'  => 'Sie müssen Ihre E-Mail-Adresse aktivieren, bevor Sie alle unsere Dienste nutzen können.',
    'activationButton'   => 'Aktivieren',
    'activationThanks'   => 'Vielen Dank für die Nutzung unserer Anwendung!',

    /*
     * Goobye email.
     *
     */
    'goodbyeSubject'    => 'Schade, dass Sie uns verlassen...',
    'goodbyeGreeting'   => 'Hallo :username,',
    'goodbyeMessage'    => 'Es tut uns leid, dass Sie Ihre Konto löschen wollen. Sie haben '.config('settings.restoreUserCutoff').' Tage Zeit, um Ihr Konto wiederherzustellen.',
    'goodbyeButton'     => 'Konto wiederherstellen',
    'goodbyeThanks'     => 'Wir hoffen Sie wieder zu sehen!',

];
