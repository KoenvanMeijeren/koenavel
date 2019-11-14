<?php
declare(strict_types=1);

return [
    /**
     * Page translations.
     */
    'home_page_title' => 'Home',
    'page_expired_title' => 'De sessie is verlopen.',
    'page_not_found_title' => 'Pagina niet gevonden',
    'page_not_found_title_fallback' => 'Page not found',
    'page_not_found_description' => 'Ga terug naar waar je vandaan kwam',
    'internal_server_error_title' => ' - Interne server error',
    'internal_server_error_description', 'Deze website werkt niet meer =>neem contact op met de website beheerder.',

    /**
     * Mail page translations.
     */
    'mail_page_title' => 'Mail',

    /**
     * Admin login page translations.
     */
    'login_page_title' => 'Inloggen',
    'register_page_title' => 'Registreren',
    'login_successful_message' => 'Succesvol ingelogd.',
    'login_failed_message' => 'Gebruikersnaam en/of wachtwoord is onjuist.',
    'login_wrong_email_message' => 'Ongeldige email opgegeven.',
    'login_wrong_password_message' => 'Ongeldige wachtwoord opgegeven.',
    'login_failed_blocked_account_message', 'Dit account is geblokkeerd. Neem contact op met de beheerder van deze website.',

    /**
     * Admin page translations.
     */
    'admin_dashboard_title' => 'Dashboard',
    'admin_page_title' => 'Pagina\'s overzicht',
    'admin_account_title' => 'Account overzicht',
    'admin_debug_title' => 'Debug informatie',

    /**
     * Admin pages maintenance translations.
     */
    'admin_pages_maintenance_title' => 'Pagina\'s beheren',
    'no_pages_were_found_message' => 'Er zijn geen pagina\'s gevonden.',
    'page_successfully_created' => 'De pagina is succesvol aangemaakt',
    'page_unsuccessfully_created' => 'De pagina kon niet worden aangemaakt',
    'page_successfully_updated' => 'De pagina is succesvol bijgewerkt',
    'page_unsuccessfully_updated' => 'De pagina kon niet worden bijgwerkt',
    'page_successfully_deleted' => 'De pagina is successvol verwijderd',
    'page_unsuccessfully_deleted' => 'De pagina kon niet worden verwijderd',
    'page_already_exists' => 'De pagina die je probeerde aan te maken bestaat al. Kies een andere url en probeer het opnieuw.',
    'delete_page_confirmation_message' => 'Weet je zeker dat je deze pagina wilt verwijderen?',
    'page_slug_cannot_be_edited' => 'De pagina url van een statische pagina kan niet worden aangepast.',
    'page_in_menu_cannot_be_edited' => 'De pagina in menu waarde van een statische pagina kan niet worden aangepast.',

    /**
     * Admin Projects maintenance translations.
     */
    'admin_projects_maintenance_title' => 'Projecten beheren',
    'admin_create_project_title' => 'Project aanmaken',
    'admin_edit_project_title' => 'Project bewerken',
    'no_projects_were_found_message' => 'Er zijn geen projecten gevonden.',
    'project_successfully_created' => 'Het project is succesvol aangemaakt',
    'project_unsuccessfully_created' => 'Het project kon niet worden aangemaakt',
    'project_successfully_updated' => 'Het project is succesvol bijgewerkt',
    'project_unsuccessfully_updated' => 'Het project kon niet worden bijgwerkt',
    'project_successful_deleted' => 'Het project is successvol verwijderd',
    'project_unsuccessful_deleted' => 'Het project kon niet worden verwijderd',
    'delete_project_confirmation_message' => 'Weet je zeker dat je dit project wilt verwijderen?',

    /**
     * Admin settings page translations.
     */
    'admin_settings_title' => 'Instellingen',
    'admin_updated_settings_successful_message' => 'Instellingen zijn succesvol opgeslagen.',
    'admin_updated_settings_failed_message' => 'Instellingen opslaan is mislukt.',
    'admin_company_settings_title' => 'Bedrijf',
    'admin_social_settings_title' => 'Sociale media',
    'admin_email_settings_title' => 'Student en docent email domein',
    'admin_regular_settings_title' => 'Algemeen',

    /**
     * Admin translation page translations.
     */
    'admin_translations_title' => 'Teksten',
    'admin_updated_translations_successful_message' => 'Teksten zijn succesvol opgeslagen.',
    'admin_updated_translations_failed_message' => 'Teksten opslaan is mislukt.',
    'translation_already_exists' => 'De tekst die je probeerde aan te maken bestaat al.',
    'no_translations_were_found_message' => 'Er zijn geen teksten gevonden.',

    /**
     * Admin account(s) maintenance page translations.
     */
    'admin_account_maintenance_title' => 'Account beheer',
    'admin_accounts_maintenance_title' => 'Accounts beheren',
    'admin_create_account_title' => 'Account aanmaken',
    'admin_create_account_successful_message' => 'Account is succesvol aangemaakt.',
    'admin_create_account_failed_message', 'Er is iets fout gegaan met het aanmaken van een nieuw account.',
    'admin_edit_account_title' => 'Account aanpassen',
    'admin_edit_account_wrong_current_password_message', 'Onjuist huidig wachtwoord gegeven. Wachtwoord is niet bijgewerkt.',
    'admin_edited_account_successful_message' => 'Account is succesvol bijgewerkt.',
    'admin_edited_account_failed_message' => 'Er is iets fout gegaan met het bijwerken van dit account.',
    'admin_account_cannot_be_visited' => 'Account kan om onbekende redenen niet worden bekeken.',
    'admin_accounts_maintenance_cannot_be_visited', 'Account kan om onbekende redenen niet worden bekeken.',
    'admin_edited_other_account_successful_message' => 'Account is succesvol bijgewerkt.',
    'admin_edited_other_account_failed_message' => 'Account kon niet worden bijgwerkt.',
    'no_accounts_were_found_message' => 'Er zijn geen accounts gevonden',
    'delete_account_confirmation_message' => 'Weet je zeker dat je dit account wilt verwijderen?',
    'cannot_delete_own_account_message' => 'Je kan niet je eigen account verwijderen.',
    'cannot_edit_own_account_message' => 'Je kan je eigen account niet in beheerders modus bewerken.',
    'admin_deleted_account_successful_message' => 'Account verwijderen is gelukt.',
    'admin_deleted_account_failed_message' => 'Account verwijderen is gelukt.',
    'admin_account_successful_unblocked_message' => 'Account is succesvol gedeblokkeerd.',
    'admin_account_failed_unblocked_message' => 'Account kon niet worden gegedeblokkeerd.',
    'admin_logout_message' => 'Succesvol uitgelogd.',
    'admin_email_already_exists_message' => 'Het account met email %s bestaat al.',
    'admin_invalid_passwords_message' => 'Ongeldige wachtwoorden opgegeven.',
    'admin_passwords_are_not_the_same_message' => 'De wachtwoorden zijn niet hetzelfde.',
    'admin_invalid_rights_message' => 'Ongeldige rechten opgegeven.',
    'unknown_account_visited' => 'Je probeerde een onbekend account te bezoeken.',
    'student_email_already_exists' => 'Je kan alleen een account aanmaken op je eigen email van landstede.',
    'create_student_account_successful_message' => 'Je account is succesvol aangemaakt maar moet nog worden geactiveerd. Je hebt een mail ontvangen om je account te activeren.',
    'account_successful_activated' => 'Je account is succesvol geactiveerd en kan nu in gebruik worden genomen.',
    'account_unsuccessful_activated' => 'Je account kon niet worden geactiveerd =>probeer het opnieuw of neem contact op met de website beheerder.',
    'user_cannot_delete_his_own_account' => 'Je kan niet je eigen account verwijderen.',

    /**
     * Admin menu translations.
     */
    'admin_menu_dashboard' => 'Dashboard',
    'admin_menu_pages' => 'Pagina\'s',
    'admin_menu_settings' => 'Instellingen',
    'admin_menu_translations' => 'Teksten',
    'admin_menu_account' => 'Account',
    'admin_menu_account_maintenance' => 'Account beheer',
    'admin_menu_logout' => 'Uitloggen',

    /**
     * Regular table texts translations.
     */
    'table_row_identifier' => 'Nr',
    'table_row_workspace_identifier' => 'Categorie',
    'table_row_branch' => 'Werkveld',
    'table_row_landscape' => 'Landschap',
    'table_row_name' => 'Naam',
    'table_row_title' => 'Titel',
    'table_row_location' => 'Locatie',
    'table_row_datetime' => 'Datum en tijdstip',
    'table_row_banner' => 'Banner',
    'table_row_thumbnail' => 'Thumbnail',
    'table_row_email' => 'Email',
    'table_row_rights' => 'Rol',
    'table_row_maximum_persons' => 'Aantal plekken',
    'table_row_sign_ups' => 'Aanmeldingen',
    'table_row_block' => 'Blokkeren',
    'table_row_archive' => 'Archiveren',
    'table_row_edit' => 'Bewerken',

    /**
     * Regular Form texts translations.
     */
    'form_register_title' => 'Account registreren',
    'form_login_title' => 'Inloggen',
    'form_file_upload' => 'Bestand uploaden',
    'form_choose_file' => 'Bestand kiezen',
    'form_no_file__is_chosen' => 'Geen bestand gekozen',
    'form_name' => 'Naam',
    'form_name_placeholder' => 'Typ naam',
    'form_email' => 'Email',
    'form_email_placeholder' => 'Typ email',
    'form_your_email_placeholder' => 'Typ je email',
    'form_phone' => 'Telefoonnummer',
    'form_phone_placeholder' => 'Typ telefoonnummer',
    'form_address' => 'Adres',
    'form_address_placeholder' => 'Typ adres',
    'form_postal' => 'Postcode',
    'form_postal_placeholder' => 'Typ postcode',
    'form_subject' => 'Onderwerp',
    'form_subject_placeholder' => 'Typ onderwerp',
    'form_message' => 'Bericht',
    'form_message_placeholder' => 'Typ bericht',
    'form_city' => 'Plaats',
    'form_city_placeholder' => 'Typ plaats',
    'form_location' => 'Locatie',
    'form_location_placeholder' => 'Typ locatie',
    'form_maximum_persons' => 'Aantal plekken',
    'form_maximum_persons_placeholder' => 'Typ aantal plekken',
    'form_duration' => 'Duur',
    'form_date' => 'Datum',
    'form_social_facebook' => 'Facebook account',
    'form_social_instagram' => 'Instagram account',
    'form_social_linkedIn' => 'LinkedIn account',
    'form_social_youtube' => 'Youtube account',
    'form_social_twitter' => 'Twitter account',
    'form_password' => 'Wachtwoord',
    'form_password_placeholder' => 'Typ wachtwoord',
    'form_current_password' => 'Huidig wachtwoord',
    'form_new_password' => 'Nieuw wachtwoord',
    'form_confirm_password' => 'Bevestig wachtwoord',
    'form_confirm_password_placeholder' => 'Bevestig wachtwoord',
    'form_rights' => 'Rollen',
    'form_rights_placeholder' => 'Kies de rol',
    'form_rights_admin' => 'Beheerder',
    'form_rights_super_admin' => 'Super beheerder',
    'form_rights_unknown' => 'Onbekende rol',
    'form_message_for_required_fields' => 'Velden met een * zijn verplicht',
    'form_empty_name_message' => 'Naam is verplicht om op te geven.',
    'form_invalid_name_message' => 'Ongeldige naam opgegeven.',
    'form_empty_email_message' => 'Email is verplicht om op te geven.',
    'form_invalid_email_message' => 'Ongeldige email opgegeven.',
    'form_invalid_url_message' => 'Ongeldige URL opgegeven.',
    'form_invalid_phone_number' => 'Ongeldige telefoonnummer opgegeven.',
    'form_delete_confirmation_message' => 'Weet je zeker dat je dit item wilt verwijderen?',
    'form_title' => 'Titel',
    'form_title_placeholder' => 'Typ de titel',
    'form_page_slug' => 'Pagina URL',
    'form_page_slug_placeholder' => 'Typ de pagina URL',
    'form_picture' => 'Afbeelding',
    'form_page_content' => 'De content van de pagina',
    'form_project_content' => 'De content van het project',
    'form_show_page_in_menu' => 'Pagina in menu',
    'form_yes' => 'Ja',
    'form_yes_public' => 'Ja, openbaar',
    'form_yes_loggedIn' => 'Ja, ingelogd',
    'form_yes_in_footer' => 'Ja, in de footer',
    'form_yes_and_in_footer' => 'Ja, in menu én in footer',
    'form_no' => 'Nee',
    'form_static' => 'Statisch',
    'form_unknown' => 'Onbekend',
    'filter_records' => 'Toon',
    'form_opening_hour' => 'Openingstijd',
    'form_closing_hour' => 'Sluitingstijd',
    'form_invalid_date' => 'Ongeldige waardes opgegeven.',
    'form_invalid_data' => 'Ongeldige waardes opgegeven.',
    'form_invalid_email_domain' => 'Ongeldige email domein opgegeven.',
    'form_name_already_exists' => 'De gekozen naam bestaat al =>kies een andere naam en probeer het opnieuw.',
    'form_email_already_exists' => 'De gekozen email bestaat al =>kies een andere email en probeer het opnieuw.',
    'form_choose_workspace_or_meeting_room' => 'Wat wil je reserveren?',
    'form_translation_name' => 'De tekst sleutel',
    'form_translation_value' => 'De sleutel waarde',
    'form_invalid_string_length' => '%s moet minimaal %u en maximaal %u tekens bevatten.',
    'form_min_invalid_string_length' => '%s moet minimaal %u tekens bevatten.',
    'form_max_invalid_string_length' => '%s mag maximaal %u tekens bevatten.',

    /**
     * Button translations.
     */
    'archive' => 'Archiveren',
    'recover' => 'Herstellen',
    'edit' => 'Bewerken',
    'delete' => 'Verwijderen',
    'login_button' => 'Inloggen',
    'register_button' => 'Registreren',
    'mail_button' => 'Verzend mail',
    'back_button' => 'Terug',
    'previous_button' => 'Vorige',
    'next_button' => 'Volgende',
    'add_button' => 'Toevoegen',
    'save_button' => 'Opslaan',
    'create_button' => 'Aanmaken',
    'sign_up_button' => 'Aanmelden >',
    'signUp_button' => 'Aanmelden',
    'send_button' => 'Verzenden',
    'reset_button' => 'Reset',
    'edit_button' => 'Bewerken >',
    'upload_button' => 'Uploaden',
    'unblock_button' => 'Deblokkeren',
    'accounts_maintenance_button' => 'Accounts beheren',
    'account_maintenance_button' => 'Account beheren',
    'add_account_button' => 'Account toevoegen',
    'information_button' => 'Informatie >',
    'view_button' => 'Bekijken >',
    'view_all_button' => 'Bekijk alles >',
    'create_page_button' => 'Pagina toevoegen',

    /**
     * Language translations.
     */
    'choose_language_title' => 'Taal',
    'dutch_language' => 'Nederlands',
    'dutch_language_flag_alt' => 'Nederlandse vlag',
    'english_language' => 'Engels',
    'english_language_flag_alt' => 'Engelse vlag',

    /**
     * Mail translations.
     */
    'email_is_not_valid_mail_error' => 'Ongeldige email opgegeven.',

    /**
     * Upload translations.
     */
    'not_allowed_file_upload', 'Je probeerde een niet toegestaan bestand te uploaden. Alleen bestanden met .svg =>.jpg =>.jpeg en .png zijn toegestaan.',
    'error_while_uploading_file' => 'Het bestand kon niet worden geüpload.',

    /**
     * CSRF translations.
     */
    'failed_csrf_check_message' => 'De sessie is verlopen.',

    /**
     * Recaptcha translations.
     */
    'failed_recaptcha_check_message' => 'Er is iets fout gegaan. Probeer het opnieuw.',
    'something_went_wrong' => 'Er is iets fout gegaan. Probeer het later opnieuw.',

];
