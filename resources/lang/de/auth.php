<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Diese Anmeldeinformationen stimmen nicht mit unseren Datensätzen überein.',
    'throttle' => 'Zu viele Anmeldeversuche. Bitte versuchen Sie es erneut in :seconds Sekunden.',

    // Activation items
    'sentEmail'         => 'Wir haben eine E-Mail an :email gesendet.',
    'clickInEmail'      => 'Bitte klicken Sie auf den Link in der Email, um Ihr Konto zu aktivieren.',
    'anEmailWasSent'    => 'Wir haben eine E-Mail an :email am :date gesendet.',
    'clickHereResend'   => 'Klicken Sie hier, um die E-Mail erneut zu senden.',
    'successActivated'  => 'Ihr Konto wurde erfolgreich aktiviert.',
    'unsuccessful'      => 'Ihr Konto konnte nicht aktiviert werden. Bitte versuchen Sie es erneut.',
    'notCreated'        => 'Ihr Konto konnte nicht erstellt werden. Bitte versuchen Sie es erneut.',
    'tooManyEmails'     => 'Es wurde zu viele Aktivierungsemails an :email verschickt.<br />Bitter versuchen Sie es erneut in<span class="label label-danger">:hours Stunden</span>.',
    'regThanks'         => 'Danke für die Registrierung.',
    'invalidToken'      => 'Ungültiges Aktivierungstoken. ',
    'activationSent'    => 'Aktivierungs-E-Mail gesendet. ',
    'alreadyActivated'  => 'Bereits aktiviert. ',

    // Labels
    'whoops'            => 'Upps! ',
    'someProblems'      => 'Es gab einige Probleme mit Ihrer Eingabe..',
    'email'             => 'E-Mail Addresse',
    'password'          => 'Passwort',
    'rememberMe'        => 'Dauerhafte Anmeldung',
    'login'             => 'Anmelden',
    'forgot'            => 'Passwort vergessen?',
    'forgot_message'    => 'Probleme mit dem Passwort?',
    'name'              => 'Benutzername',
    'first_name'        => 'Vorname',
    'last_name'         => 'Nachname',
    'confirmPassword'   => 'Passwort bestätigen',
    'register'          => 'Registrieren',

    // Placeholders
    'ph_name'           => 'Benutzername',
    'ph_email'          => 'E-mail Addresse',
    'ph_firstname'      => 'Vorname',
    'ph_lastname'       => 'Nachname',
    'ph_password'       => 'Passwort',
    'ph_password_conf'  => 'Passwort bestätigen',

    // User flash messages
    'sendResetLink'     => 'Link zum Zurücksetzen des Passworts senden',
    'resetPassword'     => 'Passwort zurücksetzen',
    'loggedIn'          => 'Sie sind eingeloggt!',

    // email links
    'pleaseActivate'    => 'Bitte aktivieren Sie Ihren Account.',
    'clickHereReset'    => 'Klicken Sie hier, um Ihr Passwort zurückzusetzen: ',
    'clickHereActivate' => 'Klicken Sie hier, um Ihr Konto zu aktivieren: ',

    // Validators
    'userNameTaken'     => 'Benutzername ist vergeben',
    'userNameRequired'  => 'Benutzername wird benötigt',
    'fNameRequired'     => 'Vorname ist erforderlich',
    'lNameRequired'     => 'Nachname ist erforderlich',
    'emailRequired'     => 'E-Mail ist erforderlich',
    'emailInvalid'      => 'E-Mail ist ungültig',
    'passwordRequired'  => 'Passwort wird benötigt',
    'PasswordMin'       => 'Das Passwort muss mindestens 6 Zeichen lang sein',
    'PasswordMax'       => 'Die maximale Länge des Passworts beträgt 20 Zeichen',
    'captchaRequire'    => 'Captcha ist erforderlich',
    'CaptchaWrong'      => 'Falsches Captcha, bitte versuchen Sie es erneut.',
    'roleRequired'      => 'Benutzerrolle ist erforderlich.',

];
