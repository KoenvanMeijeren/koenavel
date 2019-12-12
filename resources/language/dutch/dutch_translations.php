<?php
declare(strict_types=1);

return [
    /**
     * Page translations.
     */
    'home_page_title' => 'Home',
    'page_not_found_title' => 'Pagina niet gevonden',
    'page_not_found_description' => 'Ga terug naar waar je vandaan kwam',
    'internal_server_error_title' => '500 - Interne server error',
    'internal_server_error_description' => 'Deze pagina werkt niet meer, neem contact op met de website beheerder.',
    'admin_dashboard_title' => 'Dashboard',
    'admin_page_title' => 'Pagina\'s overzicht',
    'admin_account_title' => 'Account overzicht',
    'admin_debug_title' => 'Debug informatie',

    /**
     * Admin menu translations.
     */
    'admin_menu_dashboard' => 'Dashboard',
    'admin_menu_pages' => 'Pagina\'s',
    'admin_menu_settings' => 'Instellingen',
    'admin_menu_translations' => 'Teksten',
    'admin_menu_account' => 'Account',
    'admin_menu_accounts' => 'Accounts',
    'admin_menu_debug' => 'Debuggen',
    'admin_menu_logout' => 'Uitloggen',

    /**
     * Admin login page translations.
     */
    'login_page_title' => 'Inloggen',
    'login_successful_message' => 'Succesvol ingelogd.',
    'login_failed_message' => 'Gebruikersnaam en/of wachtwoord is onjuist.',
    'login_wrong_email_message' => 'Ongeldige email opgegeven.',
    'login_wrong_password_message' => 'Ongeldige wachtwoord opgegeven.',
    'login_failed_blocked_account_message' => 'Dit account is geblokkeerd. Neem contact op met de beheerder van deze website.',

    /**
     * Admin pages maintenance translations.
     */
    'admin_pages_maintenance_title' => 'Pagina\'s beheren',
    'admin_create_page_title' => 'Pagina aanmaken',
    'admin_edit_page_title' => 'Pagina %s bewerken',
    'admin_page_cannot_be_visited' => 'De pagina \'%s\' bestaat niet',
    'no_pages_were_found_message' => 'Er zijn geen pagina\'s gevonden.',
    'page_successfully_created' => 'De pagina \'%s\' is succesvol aangemaakt',
    'page_unsuccessfully_created' => 'De pagina kon niet worden aangemaakt',
    'page_successfully_updated' => 'De pagina \'%s\' is succesvol bijgewerkt',
    'page_already_exists' => 'De pagina \'%s\' bestaat al.',
    'delete_page_confirmation_message' => 'Weet je zeker dat je deze pagina wilt verwijderen?',
    'page_static_slug_cannot_be_edited' => 'De pagina url van de statische pagina \'%s\' kan niet worden aangepast.',
    'page_static_cannot_be_edited' => 'De pagina zichtbaarheid van de statische pagina \'%s\' mag niet worden aangepast.',
    'page_static_cannot_be_deleted' => 'De statische pagina \'%s\' mag niet worden verwijderd.',
    'page_successfully_deleted' => 'De pagina \'%s\' is successvol verwijderd',
    'page_unsuccessfully_deleted' => 'De pagina \'%s\' kon niet worden verwijderd',
    'page_not_in_menu' => 'Nee, niet in menu tonen',
    'page_public_in_menu' => 'Ja, openbaar in het menu tonen',
    'page_logged_in_in_menu' => 'Ja, ingelogd in het menu tonen',
    'page_in_footer_menu' => 'Ja, in footer tonen',
    'page_in_footer_and_in_menu' => 'Ja, in footer en in menu tonen',
    'page_static' => 'Statisch',
    'page_in_menu_state_unknown' => 'Onbekende zichtbaarheid',

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
     * Admin account user maintenance page translations.
     */
    'admin_edit_regular_data_account_title' => 'Gegevens bewerken',
    'admin_edit_email_account_title' => 'Email bewerken',
    'admin_edit_password_account_title' => 'Wachtwoord bewerken',
    'admin_block_account_title' => 'Account blokkeren',
    'account_is_blocked' => 'Account is geblokkeerd.',

    /**
     * Admin account(s) maintenance page translations.
     */
    'admin_account_maintenance_title' => 'Account beheer',
    'admin_accounts_maintenance_title' => 'Accounts beheren',
    'admin_create_account_title' => 'Account aanmaken',
    'admin_create_account_successful_message' => 'Account is succesvol aangemaakt.',
    'admin_edit_account_title' => 'Account bewerken',
    'admin_edit_account_wrong_current_password_message' => 'Onjuist huidig wachtwoord gegeven. Wachtwoord is niet bijgewerkt.',
    'admin_edited_account_successful_message' => 'Account is succesvol bijgewerkt.',
    'admin_account_cannot_be_visited' => 'Dit account bestaat niet.',
    'admin_edited_other_account_successful_message' => 'Account is succesvol bijgewerkt.',
    'no_accounts_were_found_message' => 'Er zijn geen accounts gevonden',
    'cannot_block_own_account_message' => 'Je kan niet je eigen account blokkeren.',
    'cannot_unblock_own_account_message' => 'Je kan niet je eigen account deblokkeren.',
    'cannot_delete_own_account_message' => 'Je kan niet je eigen account verwijderen.',
    'cannot_edit_own_account_rights_message' => 'Je kan niet de rechten van je eigen account bewerken.',
    'cannot_edit_own_account_block_state_message' => 'Je kan niet je eigen account blokkeren.',
    'cannot_edit_own_account_unblock_state_message' => 'Je kan niet je eigen account deblokkeren.',
    'admin_deleted_account_successful_message' => 'Account verwijderen is gelukt.',
    'admin_deleted_account_failed_message' => 'Account kon niet worden verwijderd.',
    'admin_account_successful_blocked_message' => 'Account is succesvol geblokkeerd.',
    'admin_account_successful_unblocked_message' => 'Account is succesvol gedeblokkeerd.',
    'admin_logout_message' => 'Succesvol uitgelogd.',
    'admin_email_already_exists_message' => 'Het account met email %s bestaat al.',
    'admin_invalid_passwords_message' => 'Ongeldige wachtwoorden opgegeven.',
    'admin_passwords_are_not_the_same_message' => 'De nieuwe wachtwoorden zijn niet hetzelfde.',
    'admin_invalid_rights_message' => 'Ongeldige rechten opgegeven.',
    'user_cannot_delete_his_own_account' => 'Je kan niet je eigen account verwijderen.',
    'admin_delete_account_warning_message' => 'Weet je zeker dat je dit account wil verwijderen?',

    /**
     * Account rights
     */
    'account_rights' => 'Rechten',
    'account_rights_placeholder' => 'Kies het rechten niveau',
    'account_rights_guest' => 'Gast',
    'account_rights_admin' => 'Beheerder',
    'account_rights_super_admin' => 'Super-beheerder',
    'account_rights_developer' => 'Developer',

    /**
     * Regular table texts translations.
     */
    'table_row_identifier' => 'Nr',
    'table_row_name' => 'Naam',
    'table_row_slug' => 'URL',
    'table_row_page_in_menu' => 'Zichtbaarheid',
    'table_row_title' => 'Titel',
    'table_row_email' => 'Email',
    'table_row_rights' => 'Rol',
    'table_row_edit' => 'Bewerken',
    'table_row_delete' => 'Verwijderen',

    /**
     * Regular Form texts translations.
     */
    'form_register_title' => 'Account registreren',
    'form_rights' => 'Rechten',
    'form_choose_rights' => 'Kies de rechten',
    'form_rights_admin' => 'Beheerder',
    'form_rights_super_admin' => 'Super-beheerder',
    'form_rights_developer' => 'Developer',
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
    'form_confirmation_password' => 'Bevestig wachtwoord',
    'form_confirmation_password_placeholder' => 'Bevestig wachtwoord',
    'form_message_for_required_fields' => 'Velden met een * zijn verplicht',
    'form_empty_name_message' => 'Naam is verplicht om op te geven.',
    'form_invalid_name_message' => 'Ongeldige naam opgegeven.',
    'form_empty_email_message' => 'Email is verplicht om op te geven.',
    'form_invalid_email_message' => 'Ongeldige email: %s opgegeven.',
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
    'form_show_page_in_menu' => 'Pagina zichtbaarheid',
    'form_show_page_not_in_menu' => 'Nee, niet tonen in het menu',
    'form_show_page_public_in_menu' => 'Ja, openbaar in het menu',
    'form_show_page_logged_in_in_menu' => 'Ja, ingelogd in het menu',
    'form_show_page_static' => 'Nee, statisch',
    'form_show_page_in_footer' => 'Ja, in de footer',
    'form_show_page_in_menu_and_in_footer' => 'Ja, in footer én in menu',
    'form_no' => 'Nee',
    'form_search' => 'Zoeken',
    'form_static' => 'Statisch',
    'form_unknown' => 'Onbekend',
    'filter_records' => 'Toon',
    'form_invalid_date' => 'Ongeldige waardes opgegeven.',
    'form_invalid_data' => 'Ongeldige waardes opgegeven.',
    'form_invalid_email_domain' => 'Ongeldige email domein opgegeven.',
    'form_name_already_exists' => 'De gekozen naam bestaat al, kies een andere naam en probeer het opnieuw.',
    'form_email_already_exists' => 'De gekozen email bestaat al, kies een andere email en probeer het opnieuw.',
    'form_translation_name' => 'De tekst sleutel',
    'form_translation_value' => 'De sleutel waarde',
    'form_invalid_string_length' => '%s moet minimaal %u en maximaal %u tekens bevatten.',
    'form_min_invalid_string_length' => '%s moet minimaal %u tekens bevatten.',
    'form_max_invalid_string_length' => '%s mag maximaal %u tekens bevatten.',

    /**
     * Form validator messages
     */
    'validator_form_base_error_message' => 'Het formulier kon niet worden verzonden omdat het de volgende fouten bevat:',
    'validator_form_field_is_required' => '%s is verplicht om in te vullen.',
    'validator_form_field_is_unique' => '%s bestaat al in de database.',
    'validator_form_field_has_invalid_range' => '%s mag niet kleiner dan %u en niet groter dan %u zijn.',
    'validator_form_email_is_invalid' => 'Ongeldige email opgegeven.',
    'validator_form_passwords_are_not_equal' => 'De nieuwe wachtwoorden zijn niet hetzelfde.',
    'validator_form_new_password_cannot_be_the_same_as_the_current_password' => 'Het nieuwe wachtwoord mag niet hetzelfde zijn als het huidge wachtwoord.',
    'validator_form_passwords_is_not_verified' => 'Het huidige wachtwoord is onjuist.',

    /**
     * Buttons.
     */
    'edit' => 'Bewerken',
    'delete' => 'Verwijderen',
    'login_button' => 'Inloggen',
    'logout_button' => 'Uitloggen',
    'back_button' => 'Terug',
    'next_button' => 'Volgende',
    'add_button' => 'Toevoegen',
    'save_button' => 'Opslaan',
    'reset_button' => 'Reset',
    'filter_button' => 'Filter',
    'edit_button' => 'Bewerken',
    'upload_button' => 'Uploaden',
    'block_button' => 'Blokkeren',
    'unblock_button' => 'Deblokkeren',
    'add_account_button' => 'Account toevoegen',
    'create_page_button' => 'Pagina toevoegen',

    /**
     * Texts
     */
    'welcome_text' => 'Welkom',

    /**
     * Uploader.
     */
    'not_allowed_file_upload' => 'Je probeerde een niet toegestaan bestand te uploaden. Alleen bestanden met .svg =>.jpg =>.jpeg en .png zijn toegestaan.',
    'error_while_uploading_file' => 'Het bestand kon niet worden geüpload.',

    /**
     * Cross site request forgery  protection.
     */
    'failed_csrf_check_message' => 'De sessie is verlopen.',

    /**
     * Recaptcha protection.
     */
    'failed_recaptcha_check_message' => 'Er is iets fout gegaan. Probeer het opnieuw.',
    'something_went_wrong' => 'Er is iets fout gegaan. Probeer het later opnieuw.',
];
