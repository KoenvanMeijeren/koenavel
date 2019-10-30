<?php
declare(strict_types=1);

return [
    /**
     * Page translations.
     */
    'home_page_title' => 'Home',
    'student_page_title' => 'Student',
    'company_page_title' => 'Bedrijf',
    'method_page_title' => 'Werkwijze',
    'project_page_title' => 'Projecten',
    'project_cannot_be_visited' => 'Het project wat je wilde bekijken kan om onbekende redenen niet worden bekeken. Probeer het later opnieuw.',
    'event_cannot_be_visited' => 'De meet the expert sessie die je wilde bekijken kan om onbekende redenen niet worden bekeken. Probeer het later opnieuw.',
    'meet_the_expert_page_title' => 'Meet the expert',
    'reservation_page_title' => 'Reserveren',
    'contact_page_title' => 'Contact',
    'account_page_title' => 'Account',
    'event_page_title' => 'Aanmelden voor events',
    'reservations_maintenance_page_title' => 'Reserveringen beheren',
    'sign_ups_maintenance_page_title' => 'Aanmeldingen beheren',
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
     * Admin dashboard page translations.
     */
    'admin_dashboard_title' => 'Dashboard',

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
     * Admin Events maintenance translations.
     */
    'admin_events_maintenance_title' => 'Meet the Expert sessies beheren',
    'admin_create_event_title' => 'Meet the Expert sessie aanmaken',
    'admin_edit_event_title' => 'Meet the Expert sessie bewerken',
    'no_events_were_found_message' => 'Er zijn geen Meet the Expert sessies gevonden.',
    'event_successfully_created' => 'De Meet the Expert sessie is succesvol aangemaakt',
    'event_unsuccessfully_created' => 'De Meet the Expert sessie kon niet worden aangemaakt',
    'event_successfully_updated' => 'De Meet the Expert sessie is succesvol bijgewerkt',
    'event_unsuccessfully_updated' => 'De Meet the Expert sessie kon niet worden bijgwerkt',
    'event_successful_deleted' => 'De Meet the Expert sessie is successvol verwijderd',
    'event_successful_archived' => 'De Meet the Expert sessie is successvol gearchiveerd',
    'event_successful_recovered' => 'De Meet the Expert sessie is successvol hersteld',
    'cannot_delete_event_if_there_are_sign_ups' => 'De Meet the Expert sessie kan niet worden verwijderd omdat er aanmeldingen zijn voor deze sessie.',
    'cannot_change_event_date_if_there_are_signUps' => 'De Meet the Expert sessie datum kan niet worden aangepast omdat er aanmeldingen zijn voor deze sessie.',
    'cannot_archive_event_if_it_has_not_been_held_yet' => 'De Meet the Expert sessie kan niet worden gearchiveerd omdat de sessie nog niet is geweest.',
    'event_unsuccessful_deleted' => 'De Meet the Expert sessie kon niet worden verwijderd',
    'event_unsuccessful_archived' => 'De Meet the Expert sessie kon niet worden gearchiveerd',
    'archive_event_confirmation_message' => 'Weet je zeker dat je deze Meet the Expert sessie wilt archiveren?',
    'recover_archive_event_confirmation_message' => 'Weet je zeker dat je deze Meet the Expert sessie weer actief wilt maken?',
    'delete_event_confirmation_message' => 'Weet je zeker dat je deze Meet the Expert sessie wilt verwijderen?',
    'date_cannot_be_earlier_than_today_or_be_the_same' => 'De datum en tijdstip kan niet eerder zijn dan nu en kan niet hetzelfde zijn.',

    /**
     * Sign ups maintenance translations.
     */
    'admin_sign_up_maintenance_title' => 'Aanmeldingen beheren',
    'no_sign_ups_were_found_message' => 'Er zijn geen aanmeldingen gevonden.',
    'sign_up_successfully_created' => 'Aanmelding is succesvol gedaan',
    'sign_up_unsuccessfully_created' => 'Aanmelden is mislukt',
    'invalid_user_sign_up' => 'Je kan alleen aanmelden voor Meet the Expert als je een student bent',
    'event_is_full' => 'Deze Meet the Expert is vol',
    'maximum_of_one_sign_up_per_user' => 'Je kan je maar maximaal 1 keer per Meet the Expert aanmelden',
    'sign_up_successful_deleted' => 'Aanmelding is successvol verwijderd',
    'cannot_sign_up_for_an_event_which_already_is_started',
    'Voor deze Meet the Expert kan niet meer worden aangemeld.',
    'sign_up_unsuccessful_deleted' => 'De aanmelding kon niet worden verwijderd',
    'delete_sign_up_confirmation_message' => 'Weet je zeker dat je deze aanmelding wilt verwijderen?',

    /**
     * Admin Branches maintenance translations.
     */
    'admin_branch_maintenance_title' => 'Werkvelden beheren',
    'admin_create_branch_title' => 'Werkveld aanmaken',
    'admin_edit_branch_title' => 'Werkveld bewerken',
    'no_branches_were_found_message' => 'Er zijn geen werkvelden gevonden.',
    'branch_successfully_created' => 'Het werkveld is succesvol aangemaakt',
    'branch_unsuccessfully_created' => 'Het werkveld kon niet worden aangemaakt',
    'branch_successfully_updated' => 'Het werkveld is succesvol bijgewerkt',
    'branch_unsuccessfully_updated' => 'Het werkveld kon niet worden bijgwerkt',
    'branch_successful_deleted' => 'Het werkveld is successvol verwijderd',
    'branch_unsuccessful_deleted' => 'Het werkveld kon niet worden verwijderd',
    'delete_branch_confirmation_message' => 'Weet je zeker dat je dit werkveld wilt verwijderen?',
    'branch_is_attached_to_contact' => 'Het werkveld kan niet worden verwijderd omdat het gekoppeld is aan een contact persoon.',

    /**
     * Admin Landscapes maintenance translations.
     */
    'admin_landscape_maintenance_title' => 'Landschappen beheren',
    'admin_create_landscape_title' => 'Landschap aanmaken',
    'admin_edit_landscape_title' => 'Landschap bewerken',
    'no_landscapes_were_found_message' => 'Er zijn geen landschappen gevonden.',
    'landscape_successfully_created' => 'Het landschap is succesvol aangemaakt',
    'landscape_unsuccessfully_created' => 'Het landschap kon niet worden aangemaakt',
    'landscape_successfully_updated' => 'Het landschap is succesvol bijgewerkt',
    'landscape_unsuccessfully_updated' => 'Het landschap kon niet worden bijgwerkt',
    'landscape_successful_deleted' => 'Het landschap is successvol verwijderd',
    'landscape_unsuccessful_deleted' => 'Het landschap kon niet worden verwijderd',
    'delete_landscape_confirmation_message' => 'Weet je zeker dat je dit landschap wilt verwijderen?',
    'landscape_is_attached_to_contact' => 'Het landschap kan niet worden verwijderd omdat het gekoppeld is aan een contact persoon.',

    /**
     * Admin Contacts maintenance translations.
     */
    'admin_contact_maintenance_title' => 'Contactpersonen beheren',
    'admin_create_contact_title' => 'Contactpersoon aanmaken',
    'admin_edit_contact_title' => 'Contactpersoon bewerken',
    'no_contacts_were_found_message' => 'Er zijn geen contactpersonen gevonden.',
    'contact_successfully_created' => 'De contactpersoon is succesvol aangemaakt',
    'contact_unsuccessfully_created' => 'De contactpersoon kon niet worden aangemaakt',
    'contact_successfully_updated' => 'De contactpersoon is succesvol bijgewerkt',
    'contact_unsuccessfully_updated' => 'De contactpersoon kon niet worden bijgwerkt',
    'contact_successful_deleted' => 'De contactpersoon is successvol verwijderd',
    'contact_unsuccessful_deleted' => 'De contactpersoon kon niet worden verwijderd',
    'delete_contact_confirmation_message' => 'Weet je zeker dat je dit contactpersoon wilt verwijderen?',

    /**
     * Admin Contacts maintenance translations.
     */
    'admin_workspace_maintenance_title' => 'Ruimtes beheren',
    'admin_create_workspace_title' => 'Ruimte aanmaken',
    'admin_edit_workspace_title' => 'Ruimte bewerken',
    'no_workspaces_were_found_message' => 'Er zijn geen ruimtes gevonden.',
    'workspace_successfully_created' => 'De ruimte is succesvol aangemaakt',
    'workspace_unsuccessfully_created' => 'De ruimte kon niet worden aangemaakt',
    'workspace_successfully_updated' => 'De ruimte is succesvol bijgewerkt',
    'workspace_unsuccessfully_updated' => 'De ruimte kon niet worden bijgwerkt',
    'workspace_successful_deleted' => 'De ruimte is successvol verwijderd',
    'workspace_unsuccessful_deleted' => 'De ruimte kon niet worden verwijderd',
    'delete_workspace_confirmation_message' => 'Weet je zeker dat je deze ruimte wilt verwijderen?',

    /**
     * Reservation maintenance translations.
     */
    'admin_reservation_maintenance_title' => 'Reserveringen beheren',
    'admin_edit_reservation_title' => 'Reservering bewerken',
    'no_reservations_were_found_message' => 'Er zijn geen reserveringen gevonden.',
    'workspace_cannot_reserved_earlier_than_now' => 'Je kan werkplek niet eerder dan nu reserveren.',
    'reservation_successfully_created' => 'De reservering is succesvol aangemaakt',
    'reservation_unsuccessfully_created' => 'De reservering kon niet worden aangemaakt',
    'reservation_successfully_updated' => 'De reservering is succesvol bijgewerkt',
    'reservation_unsuccessfully_updated' => 'De reservering kon niet worden bijgwerkt',
    'reservation_successful_deleted' => 'De reservering is successvol verwijderd',
    'reservation_unsuccessful_deleted' => 'De reservering kon niet worden verwijderd',
    'delete_reservation_confirmation_message' => 'Weet je zeker dat je deze reservering wilt verwijderen?',
    'invalid_user_reservation' => 'Je kan alleen een werkplek reserveren als je een student bent',
    'workspace_already_reserved' => 'De gekozen werkplek is al gereserveerd.',
    'maintenance_page_title' => 'Aanmeldingen en reserveringen beheren',
    'cannot_reserve_workspace_in_weekend' => 'Werkplekken kunnen niet in het weekend worden gereserveerd.',
    'cannot_delete_workspace_if_there_are_reservations' => 'Deze werkplek kan niet worden verwijderd omdat er op dit moment een reservering is geplaatst op deze werkplek.',
    'cannot_reserve_before_opening_hour' => 'Je kan niet eerder dan %s uur reserveren',
    'cannot_reserve_after_closing_hour' => 'Je kan niet (tot) later dan %s uur reserveren',

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
    'admin_menu_projects' => 'Projecten',
    'admin_menu_branch' => 'Werkvelden',
    'admin_menu_events' => 'Meet the Experts',
    'admin_menu_landscape' => 'Landschappen',
    'admin_menu_contact' => 'Contactpersonen',
    'admin_menu_workspace' => 'Ruimtes',
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
    'form_student_email' => 'Student email domein',
    'form_teacher_email' => 'Docent email domein',
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
    'form_education' => 'Opleiding',
    'form_education_placeholder' => 'Typ je opleiding',
    'form_dayPart' => 'Dagdeel',
    'form_dayPart_morning' => 'Ochtend',
    'form_dayPart_afternoon' => 'Middag',
    'form_time' => 'Tijd',
    'form_start_time' => 'Begin tijd',
    'form_end_time' => 'Eind tijd',
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
    'form_rights_level_1' => 'Student',
    'form_rights_level_2' => 'Docent',
    'form_rights_level_3' => 'Beheerder',
    'form_rights_level_4' => 'Super beheerder',
    'form_rights_unknown' => 'Onbekende rol',
    'form_message_for_required_fields' => 'Velden met een * zijn verplicht',
    'form_empty_name_message' => 'Naam is verplicht om op te geven.',
    'form_invalid_name_message' => 'Ongeldige naam opgegeven.',
    'form_empty_email_message' => 'Email is verplicht om op te geven.',
    'form_invalid_email_message' => 'Ongeldige email opgegeven.',
    'form_invalid_url_message' => 'Ongeldige URL opgegeven.',
    'form_invalid_phone_number' => 'Ongeldige telefoonnummer opgegeven.',
    'invalid_student_email_message' => 'Het email adres van de student moet overeenkomen met het opgegeven email domein van een student in de instellingen.',
    'invalid_teacher_email_message' => 'Het email adres van de docent moet overeenkomen met het opgegeven email domein van een docent in de instellingen.',
    'form_delete_confirmation_message' => 'Weet je zeker dat je dit item wilt verwijderen?',
    'form_branch' => 'Werkveld',
    'form_landscape' => 'Landschap',
    'form_choose_landscape' => 'Kies het landschap',
    'form_workspace' => 'werkplek',
    'form_map' => 'Plattegrond',
    'form_meeting_room' => 'vergaderruimte',
    'form_work_area' => 'Werkveld',
    'form_choose_work_area' => 'Kies werkveld',
    'form_choose_branch' => 'Kies het werkveld',
    'form_title' => 'Titel',
    'form_title_placeholder' => 'Typ de titel',
    'form_page_slug' => 'Pagina URL',
    'form_page_slug_placeholder' => 'Typ de pagina URL',
    'form_picture' => 'Afbeelding',
    'form_thumbnail_picture' => 'Thumbnail',
    'form_recommended_thumbnail_picture_size' => 'Aanbevolen grootte: 350x300',
    'form_banner_picture' => 'Banner',
    'form_banner_normal_picture' => 'Banner foto',
    'form_recommended_banner_picture_size' => 'Aanbevolen grootte: 750x300',
    'form_header_picture' => 'Header',
    'form_recommended_header_picture_size' => 'Aanbevolen grootte: 1500x400',
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
    'add_workspace_button' => 'Werkplek toevoegen',
    'add_meetingRoom_button' => 'Vergaderruimte toevoegen',
    'save_button' => 'Opslaan',
    'create_button' => 'Aanmaken',
    'sign_up_button' => 'Aanmelden >',
    'signUp_button' => 'Aanmelden',
    'send_button' => 'Verzenden',
    'reset_button' => 'Reset',
    'edit_button' => 'Bewerken >',
    'upload_button' => 'Uploaden',
    'unblock_button' => 'Deblokkeren',
    'reservation_button' => 'Reserveren >',
    'accounts_maintenance_button' => 'Accounts beheren',
    'account_maintenance_button' => 'Account beheren',
    'add_account_button' => 'Account toevoegen',
    'information_button' => 'Informatie >',
    'make_appointment_button' => 'Afspraak maken >',
    'add_project_button' => 'Project aanmelden >',
    'view_project_button' => 'Bekijk project >',
    'view_button' => 'Bekijken >',
    'view_all_button' => 'Bekijk alles >',
    'view_contact_person_button' => 'Bekijk de contactpersonen >',
    'contact_the_contact_person_button' => 'Neem contact op >',
    'make_contact_button' => 'Contact opnemen >',
    'create_page_button' => 'Pagina toevoegen',
    'create_event_button' => 'Meet the Expert toevoegen',
    'create_project_button' => 'Project toevoegen',
    'create_contact_button' => 'Contactpersoon toevoegen',
    'history' => 'Historie',
    'export_members_list' => 'Deelnemerslijst exporteren',
    'days_button' => 'dagen',
    'event_button' => ' sessies',

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
