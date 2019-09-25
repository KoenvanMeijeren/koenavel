<?php
declare(strict_types=1);

use App\services\translation\Translation;

/**
 * Page translations.
 */
Translation::set('home_page_title', 'Home');
Translation::set('student_page_title', 'Student');
Translation::set('company_page_title', 'Bedrijf');
Translation::set('method_page_title', 'Werkwijze');
Translation::set('project_page_title', 'Projecten');
Translation::set('project_cannot_be_visited', 'Het project wat je wilde bekijken kan om onbekende redenen niet worden bekeken. Probeer het later opnieuw.');
Translation::set('event_cannot_be_visited', 'De meet the expert sessie die je wilde bekijken kan om onbekende redenen niet worden bekeken. Probeer het later opnieuw.');
Translation::set('meet_the_expert_page_title', 'Meet the expert');
Translation::set('reservation_page_title', 'Reserveren');
Translation::set('contact_page_title', 'Contact');
Translation::set('account_page_title', 'Account');
Translation::set('event_page_title', 'Aanmelden voor events');
Translation::set('reservations_maintenance_page_title', 'Reserveringen beheren');
Translation::set('sign_ups_maintenance_page_title', 'Aanmeldingen beheren');
Translation::set('page_not_found_title', 'Pagina niet gevonden');
Translation::set('page_not_found_title_fallback', 'Page not found');
Translation::set('page_not_found_description', 'Ga terug naar waar je vandaan kwam');
Translation::set('internal_server_error_title', ' - Interne server error');
Translation::set(
    'internal_server_error_description',
    'Deze website werkt niet meer, neem contact op met de website beheerder.'
);

/**
 * Mail page translations.
 */
Translation::set('mail_page_title', 'Mail');

/**
 * Admin login page translations.
 */
Translation::set('login_page_title', 'Inloggen');
Translation::set('register_page_title', 'Registreren');
Translation::set('login_successful_message', 'Succesvol ingelogd.');
Translation::set('login_failed_message', 'Gebruikersnaam en/of wachtwoord is onjuist.');
Translation::set('login_wrong_email_message', 'Ongeldige email opgegeven.');
Translation::set('login_wrong_password_message', 'Ongeldige wachtwoord opgegeven.');
Translation::set(
    'login_failed_blocked_account_message',
    'Dit account is geblokkeerd. Neem contact op met de beheerder van deze website.'
);

/**
 * Admin dashboard page translations.
 */
Translation::set('admin_dashboard_title', 'Dashboard');

/**
 * Admin pages maintenance translations.
 */
Translation::set('admin_pages_maintenance_title', 'Pagina\'s beheren');
Translation::set('no_pages_were_found_message', 'Er zijn geen pagina\'s gevonden.');
Translation::set('page_successfully_created', 'De pagina is succesvol aangemaakt');
Translation::set('page_unsuccessfully_created', 'De pagina kon niet worden aangemaakt');
Translation::set('page_successfully_updated', 'De pagina is succesvol bijgewerkt');
Translation::set('page_unsuccessfully_updated', 'De pagina kon niet worden bijgwerkt');
Translation::set('page_successfully_deleted', 'De pagina is successvol verwijderd');
Translation::set('page_unsuccessfully_deleted', 'De pagina kon niet worden verwijderd');
Translation::set('page_already_exists', 'De pagina die je probeerde aan te maken bestaat al. Kies een andere url en probeer het opnieuw.');
Translation::set('delete_page_confirmation_message', 'Weet je zeker dat je deze pagina wilt verwijderen?');
Translation::set('page_slug_cannot_be_edited', 'De pagina url van een statische pagina kan niet worden aangepast.');
Translation::set('page_in_menu_cannot_be_edited', 'De pagina in menu waarde van een statische pagina kan niet worden aangepast.');

/**
 * Admin Projects maintenance translations.
 */
Translation::set('admin_projects_maintenance_title', 'Projecten beheren');
Translation::set('admin_create_project_title', 'Project aanmaken');
Translation::set('admin_edit_project_title', 'Project bewerken');
Translation::set('no_projects_were_found_message', 'Er zijn geen projecten gevonden.');
Translation::set('project_successfully_created', 'Het project is succesvol aangemaakt');
Translation::set('project_unsuccessfully_created', 'Het project kon niet worden aangemaakt');
Translation::set('project_successfully_updated', 'Het project is succesvol bijgewerkt');
Translation::set('project_unsuccessfully_updated', 'Het project kon niet worden bijgwerkt');
Translation::set('project_successful_deleted', 'Het project is successvol verwijderd');
Translation::set('project_unsuccessful_deleted', 'Het project kon niet worden verwijderd');
Translation::set('delete_project_confirmation_message', 'Weet je zeker dat je dit project wilt verwijderen?');

/**
 * Admin Events maintenance translations.
 */
Translation::set('admin_events_maintenance_title', 'Meet the Expert sessies beheren');
Translation::set('admin_create_event_title', 'Meet the Expert sessie aanmaken');
Translation::set('admin_edit_event_title', 'Meet the Expert sessie bewerken');
Translation::set('no_events_were_found_message', 'Er zijn geen Meet the Expert sessies gevonden.');
Translation::set('event_successfully_created', 'De Meet the Expert sessie is succesvol aangemaakt');
Translation::set('event_unsuccessfully_created', 'De Meet the Expert sessie kon niet worden aangemaakt');
Translation::set('event_successfully_updated', 'De Meet the Expert sessie is succesvol bijgewerkt');
Translation::set('event_unsuccessfully_updated', 'De Meet the Expert sessie kon niet worden bijgwerkt');
Translation::set('event_successful_deleted', 'De Meet the Expert sessie is successvol verwijderd');
Translation::set('event_successful_archived', 'De Meet the Expert sessie is successvol gearchiveerd');
Translation::set('event_successful_recovered', 'De Meet the Expert sessie is successvol hersteld');
Translation::set('cannot_delete_event_if_there_are_sign_ups', 'De Meet the Expert sessie kan niet worden verwijderd omdat er aanmeldingen zijn voor deze sessie.');
Translation::set('cannot_change_event_date_if_there_are_signUps', 'De Meet the Expert sessie datum kan niet worden aangepast omdat er aanmeldingen zijn voor deze sessie.');
Translation::set('cannot_archive_event_if_it_has_not_been_held_yet', 'De Meet the Expert sessie kan niet worden gearchiveerd omdat de sessie nog niet is geweest.');
Translation::set('event_unsuccessful_deleted', 'De Meet the Expert sessie kon niet worden verwijderd');
Translation::set('event_unsuccessful_archived', 'De Meet the Expert sessie kon niet worden gearchiveerd');
Translation::set('archive_event_confirmation_message', 'Weet je zeker dat je deze Meet the Expert sessie wilt archiveren?');
Translation::set('recover_archive_event_confirmation_message', 'Weet je zeker dat je deze Meet the Expert sessie weer actief wilt maken?');
Translation::set('delete_event_confirmation_message', 'Weet je zeker dat je deze Meet the Expert sessie wilt verwijderen?');
Translation::set('date_cannot_be_earlier_than_today_or_be_the_same', 'De datum en tijdstip kan niet eerder zijn dan nu en kan niet hetzelfde zijn.');

/**
 * Sign ups maintenance translations.
 */
Translation::set('admin_sign_up_maintenance_title', 'Aanmeldingen beheren');
Translation::set('no_sign_ups_were_found_message', 'Er zijn geen aanmeldingen gevonden.');
Translation::set('sign_up_successfully_created', 'Aanmelding is succesvol gedaan');
Translation::set('sign_up_unsuccessfully_created', 'Aanmelden is mislukt');
Translation::set('invalid_user_sign_up', 'Je kan alleen aanmelden voor Meet the Expert als je een student bent');
Translation::set('event_is_full', 'Deze Meet the Expert is vol');
Translation::set('maximum_of_one_sign_up_per_user', 'Je kan je maar maximaal 1 keer per Meet the Expert aanmelden');
Translation::set('sign_up_successful_deleted', 'Aanmelding is successvol verwijderd');
Translation::set('cannot_sign_up_for_an_event_which_already_is_started',
    'Voor deze Meet the Expert kan niet meer worden aangemeld.');
Translation::set('sign_up_unsuccessful_deleted', 'De aanmelding kon niet worden verwijderd');
Translation::set('delete_sign_up_confirmation_message', 'Weet je zeker dat je deze aanmelding wilt verwijderen?');

/**
 * Admin Branches maintenance translations.
 */
Translation::set('admin_branch_maintenance_title', 'Werkvelden beheren');
Translation::set('admin_create_branch_title', 'Werkveld aanmaken');
Translation::set('admin_edit_branch_title', 'Werkveld bewerken');
Translation::set('no_branches_were_found_message', 'Er zijn geen werkvelden gevonden.');
Translation::set('branch_successfully_created', 'Het werkveld is succesvol aangemaakt');
Translation::set('branch_unsuccessfully_created', 'Het werkveld kon niet worden aangemaakt');
Translation::set('branch_successfully_updated', 'Het werkveld is succesvol bijgewerkt');
Translation::set('branch_unsuccessfully_updated', 'Het werkveld kon niet worden bijgwerkt');
Translation::set('branch_successful_deleted', 'Het werkveld is successvol verwijderd');
Translation::set('branch_unsuccessful_deleted', 'Het werkveld kon niet worden verwijderd');
Translation::set('delete_branch_confirmation_message', 'Weet je zeker dat je dit werkveld wilt verwijderen?');
Translation::set('branch_is_attached_to_contact', 'Het werkveld kan niet worden verwijderd omdat het gekoppeld is aan een contact persoon.');

/**
 * Admin Landscapes maintenance translations.
 */
Translation::set('admin_landscape_maintenance_title', 'Landschappen beheren');
Translation::set('admin_create_landscape_title', 'Landschap aanmaken');
Translation::set('admin_edit_landscape_title', 'Landschap bewerken');
Translation::set('no_landscapes_were_found_message', 'Er zijn geen landschappen gevonden.');
Translation::set('landscape_successfully_created', 'Het landschap is succesvol aangemaakt');
Translation::set('landscape_unsuccessfully_created', 'Het landschap kon niet worden aangemaakt');
Translation::set('landscape_successfully_updated', 'Het landschap is succesvol bijgewerkt');
Translation::set('landscape_unsuccessfully_updated', 'Het landschap kon niet worden bijgwerkt');
Translation::set('landscape_successful_deleted', 'Het landschap is successvol verwijderd');
Translation::set('landscape_unsuccessful_deleted', 'Het landschap kon niet worden verwijderd');
Translation::set('delete_landscape_confirmation_message', 'Weet je zeker dat je dit landschap wilt verwijderen?');
Translation::set('landscape_is_attached_to_contact', 'Het landschap kan niet worden verwijderd omdat het gekoppeld is aan een contact persoon.');

/**
 * Admin Contacts maintenance translations.
 */
Translation::set('admin_contact_maintenance_title', 'Contactpersonen beheren');
Translation::set('admin_create_contact_title', 'Contactpersoon aanmaken');
Translation::set('admin_edit_contact_title', 'Contactpersoon bewerken');
Translation::set('no_contacts_were_found_message', 'Er zijn geen contactpersonen gevonden.');
Translation::set('contact_successfully_created', 'De contactpersoon is succesvol aangemaakt');
Translation::set('contact_unsuccessfully_created', 'De contactpersoon kon niet worden aangemaakt');
Translation::set('contact_successfully_updated', 'De contactpersoon is succesvol bijgewerkt');
Translation::set('contact_unsuccessfully_updated', 'De contactpersoon kon niet worden bijgwerkt');
Translation::set('contact_successful_deleted', 'De contactpersoon is successvol verwijderd');
Translation::set('contact_unsuccessful_deleted', 'De contactpersoon kon niet worden verwijderd');
Translation::set('delete_contact_confirmation_message', 'Weet je zeker dat je dit contactpersoon wilt verwijderen?');

/**
 * Admin Contacts maintenance translations.
 */
Translation::set('admin_workspace_maintenance_title', 'Ruimtes beheren');
Translation::set('admin_create_workspace_title', 'Ruimte aanmaken');
Translation::set('admin_edit_workspace_title', 'Ruimte bewerken');
Translation::set('no_workspaces_were_found_message', 'Er zijn geen ruimtes gevonden.');
Translation::set('workspace_successfully_created', 'De ruimte is succesvol aangemaakt');
Translation::set('workspace_unsuccessfully_created', 'De ruimte kon niet worden aangemaakt');
Translation::set('workspace_successfully_updated', 'De ruimte is succesvol bijgewerkt');
Translation::set('workspace_unsuccessfully_updated', 'De ruimte kon niet worden bijgwerkt');
Translation::set('workspace_successful_deleted', 'De ruimte is successvol verwijderd');
Translation::set('workspace_unsuccessful_deleted', 'De ruimte kon niet worden verwijderd');
Translation::set('delete_workspace_confirmation_message', 'Weet je zeker dat je deze ruimte wilt verwijderen?');

/**
 * Reservation maintenance translations.
 */
Translation::set('admin_reservation_maintenance_title', 'Reserveringen beheren');
Translation::set('admin_edit_reservation_title', 'Reservering bewerken');
Translation::set('no_reservations_were_found_message', 'Er zijn geen reserveringen gevonden.');
Translation::set('workspace_cannot_reserved_earlier_than_now', 'Je kan werkplek niet eerder dan nu reserveren.');
Translation::set('reservation_successfully_created', 'De reservering is succesvol aangemaakt');
Translation::set('reservation_unsuccessfully_created', 'De reservering kon niet worden aangemaakt');
Translation::set('reservation_successfully_updated', 'De reservering is succesvol bijgewerkt');
Translation::set('reservation_unsuccessfully_updated', 'De reservering kon niet worden bijgwerkt');
Translation::set('reservation_successful_deleted', 'De reservering is successvol verwijderd');
Translation::set('reservation_unsuccessful_deleted', 'De reservering kon niet worden verwijderd');
Translation::set('delete_reservation_confirmation_message', 'Weet je zeker dat je deze reservering wilt verwijderen?');
Translation::set('invalid_user_reservation', 'Je kan alleen een werkplek reserveren als je een student bent');
Translation::set('workspace_already_reserved', 'De gekozen werkplek is al gereserveerd.');
Translation::set('maintenance_page_title', 'Aanmeldingen en reserveringen beheren');
Translation::set('cannot_reserve_workspace_in_weekend', 'Werkplekken kunnen niet in het weekend worden gereserveerd.');
Translation::set('cannot_delete_workspace_if_there_are_reservations', 'Deze werkplek kan niet worden verwijderd omdat er op dit moment een reservering is geplaatst op deze werkplek.');
Translation::set('cannot_reserve_before_opening_hour', 'Je kan niet eerder dan %s uur reserveren');
Translation::set('cannot_reserve_after_closing_hour', 'Je kan niet (tot) later dan %s uur reserveren');

/**
 * Admin settings page translations.
 */
Translation::set('admin_settings_title', 'Instellingen');
Translation::set('admin_updated_settings_successful_message', 'Instellingen zijn succesvol opgeslagen.');
Translation::set('admin_updated_settings_failed_message', 'Instellingen opslaan is mislukt.');
Translation::set('admin_company_settings_title', 'Bedrijf');
Translation::set('admin_social_settings_title', 'Sociale media');
Translation::set('admin_email_settings_title', 'Student en docent email domein');
Translation::set('admin_regular_settings_title', 'Algemeen');

/**
 * Admin translation page translations.
 */
Translation::set('admin_translations_title', 'Teksten');
Translation::set('admin_updated_translations_successful_message', 'Teksten zijn succesvol opgeslagen.');
Translation::set('admin_updated_translations_failed_message', 'Teksten opslaan is mislukt.');
Translation::set('translation_already_exists', 'De tekst die je probeerde aan te maken bestaat al.');
Translation::set('no_translations_were_found_message', 'Er zijn geen teksten gevonden.');

/**
 * Admin account(s) maintenance page translations.
 */
Translation::set('admin_account_maintenance_title', 'Account beheer');
Translation::set('admin_accounts_maintenance_title', 'Accounts beheren');
Translation::set('admin_create_account_title', 'Account aanmaken');
Translation::set('admin_create_account_successful_message', 'Account is succesvol aangemaakt.');
Translation::set(
    'admin_create_account_failed_message',
    'Er is iets fout gegaan met het aanmaken van een nieuw account.'
);
Translation::set('admin_edit_account_title', 'Account aanpassen');
Translation::set(
    'admin_edit_account_wrong_current_password_message',
    'Onjuist huidig wachtwoord gegeven. Wachtwoord is niet bijgewerkt.'
);
Translation::set('admin_edited_account_successful_message', 'Account is succesvol bijgewerkt.');
Translation::set('admin_edited_account_failed_message', 'Er is iets fout gegaan met het bijwerken van dit account.');
Translation::set('admin_account_cannot_be_visited', 'Account kan om onbekende redenen niet worden bekeken.');
Translation::set(
    'admin_accounts_maintenance_cannot_be_visited',
    'Account kan om onbekende redenen niet worden bekeken.'
);
Translation::set('admin_edited_other_account_successful_message', 'Account is succesvol bijgewerkt.');
Translation::set('admin_edited_other_account_failed_message', 'Account kon niet worden bijgwerkt.');
Translation::set('no_accounts_were_found_message', 'Er zijn geen accounts gevonden');
Translation::set('delete_account_confirmation_message', 'Weet je zeker dat je dit account wilt verwijderen?');
Translation::set('cannot_delete_own_account_message', 'Je kan niet je eigen account verwijderen.');
Translation::set('cannot_edit_own_account_message', 'Je kan je eigen account niet in beheerders modus bewerken.');
Translation::set('admin_deleted_account_successful_message', 'Account verwijderen is gelukt.');
Translation::set('admin_deleted_account_failed_message', 'Account verwijderen is gelukt.');
Translation::set('admin_account_successful_unblocked_message', 'Account is succesvol gedeblokkeerd.');
Translation::set('admin_account_failed_unblocked_message', 'Account kon niet worden gegedeblokkeerd.');
Translation::set('admin_logout_message', 'Succesvol uitgelogd.');
Translation::set('admin_email_already_exists_message', 'Het account met email %s bestaat al.');
Translation::set('admin_invalid_passwords_message', 'Ongeldige wachtwoorden opgegeven.');
Translation::set('admin_passwords_are_not_the_same_message', 'De wachtwoorden zijn niet hetzelfde.');
Translation::set('admin_invalid_rights_message', 'Ongeldige rechten opgegeven.');
Translation::set('unknown_account_visited', 'Je probeerde een onbekend account te bezoeken.');
Translation::set('student_email_already_exists', 'Je kan alleen een account aanmaken op je eigen email van landstede.');
Translation::set('create_student_account_successful_message', 'Je account is succesvol aangemaakt maar moet nog worden geactiveerd. Je hebt een mail ontvangen om je account te activeren.');
Translation::set('account_successful_activated', 'Je account is succesvol geactiveerd en kan nu in gebruik worden genomen.');
Translation::set('account_unsuccessful_activated', 'Je account kon niet worden geactiveerd, probeer het opnieuw of neem contact op met de website beheerder.');
Translation::set('user_cannot_delete_his_own_account', 'Je kan niet je eigen account verwijderen.');

/**
 * Admin menu translations.
 */
Translation::set('admin_menu_dashboard', 'Dashboard');
Translation::set('admin_menu_pages', 'Pagina\'s');
Translation::set('admin_menu_projects', 'Projecten');
Translation::set('admin_menu_branch', 'Werkvelden');
Translation::set('admin_menu_events', 'Meet the Experts');
Translation::set('admin_menu_landscape', 'Landschappen');
Translation::set('admin_menu_contact', 'Contactpersonen');
Translation::set('admin_menu_workspace', 'Ruimtes');
Translation::set('admin_menu_settings', 'Instellingen');
Translation::set('admin_menu_translations', 'Teksten');
Translation::set('admin_menu_account', 'Account');
Translation::set('admin_menu_account_maintenance', 'Account beheer');
Translation::set('admin_menu_logout', 'Uitloggen');

/**
 * Regular table texts translations.
 */
Translation::set('table_row_identifier', 'Nr');
Translation::set('table_row_workspace_identifier', 'Categorie');
Translation::set('table_row_branch', 'Werkveld');
Translation::set('table_row_landscape', 'Landschap');
Translation::set('table_row_name', 'Naam');
Translation::set('table_row_title', 'Titel');
Translation::set('table_row_location', 'Locatie');
Translation::set('table_row_datetime', 'Datum en tijdstip');
Translation::set('table_row_banner', 'Banner');
Translation::set('table_row_thumbnail', 'Thumbnail');
Translation::set('table_row_email', 'Email');
Translation::set('table_row_rights', 'Rol');
Translation::set('table_row_maximum_persons', 'Aantal plekken');
Translation::set('table_row_sign_ups', 'Aanmeldingen');
Translation::set('table_row_block', 'Blokkeren');
Translation::set('table_row_archive', 'Archiveren');
Translation::set('table_row_edit', 'Bewerken');

/**
 * Regular Form texts translations.
 */
Translation::set('form_register_title', 'Account registreren');
Translation::set('form_login_title', 'Inloggen');
Translation::set('form_file_upload', 'Bestand uploaden');
Translation::set('form_choose_file', 'Bestand kiezen');
Translation::set('form_no_file__is_chosen', 'Geen bestand gekozen');
Translation::set('form_name', 'Naam');
Translation::set('form_name_placeholder', 'Typ naam');
Translation::set('form_email', 'Email');
Translation::set('form_student_email', 'Student email domein');
Translation::set('form_teacher_email', 'Docent email domein');
Translation::set('form_email_placeholder', 'Typ email');
Translation::set('form_your_email_placeholder', 'Typ je email');
Translation::set('form_phone', 'Telefoonnummer');
Translation::set('form_phone_placeholder', 'Typ telefoonnummer');
Translation::set('form_address', 'Adres');
Translation::set('form_address_placeholder', 'Typ adres');
Translation::set('form_postal', 'Postcode');
Translation::set('form_postal_placeholder', 'Typ postcode');
Translation::set('form_subject', 'Onderwerp');
Translation::set('form_subject_placeholder', 'Typ onderwerp');
Translation::set('form_message', 'Bericht');
Translation::set('form_message_placeholder', 'Typ bericht');
Translation::set('form_city', 'Plaats');
Translation::set('form_city_placeholder', 'Typ plaats');
Translation::set('form_location', 'Locatie');
Translation::set('form_location_placeholder', 'Typ locatie');
Translation::set('form_maximum_persons', 'Aantal plekken');
Translation::set('form_maximum_persons_placeholder', 'Typ aantal plekken');
Translation::set('form_duration', 'Duur');
Translation::set('form_date', 'Datum');
Translation::set('form_education', 'Opleiding');
Translation::set('form_education_placeholder', 'Typ je opleiding');
Translation::set('form_dayPart', 'Dagdeel');
Translation::set('form_dayPart_morning', 'Ochtend');
Translation::set('form_dayPart_afternoon', 'Middag');
Translation::set('form_time', 'Tijd');
Translation::set('form_start_time', 'Begin tijd');
Translation::set('form_end_time', 'Eind tijd');
Translation::set('form_social_facebook', 'Facebook account');
Translation::set('form_social_instagram', 'Instagram account');
Translation::set('form_social_linkedIn', 'LinkedIn account');
Translation::set('form_social_youtube', 'Youtube account');
Translation::set('form_social_twitter', 'Twitter account');
Translation::set('form_password', 'Wachtwoord');
Translation::set('form_password_placeholder', 'Typ wachtwoord');
Translation::set('form_current_password', 'Huidig wachtwoord');
Translation::set('form_new_password', 'Nieuw wachtwoord');
Translation::set('form_confirm_password', 'Bevestig wachtwoord');
Translation::set('form_confirm_password_placeholder', 'Bevestig wachtwoord');
Translation::set('form_rights', 'Rollen');
Translation::set('form_rights_placeholder', 'Kies de rol');
Translation::set('form_rights_level_1', 'Student');
Translation::set('form_rights_level_2', 'Docent');
Translation::set('form_rights_level_3', 'Beheerder');
Translation::set('form_rights_level_4', 'Super beheerder');
Translation::set('form_rights_unknown', 'Onbekende rol');
Translation::set('form_message_for_required_fields', 'Velden met een * zijn verplicht');
Translation::set('form_empty_name_message', 'Naam is verplicht om op te geven.');
Translation::set('form_invalid_name_message', 'Ongeldige naam opgegeven.');
Translation::set('form_empty_email_message', 'Email is verplicht om op te geven.');
Translation::set('form_invalid_email_message', 'Ongeldige email opgegeven.');
Translation::set('form_invalid_url_message', 'Ongeldige URL opgegeven.');
Translation::set('form_invalid_phone_number', 'Ongeldige telefoonnummer opgegeven.');
Translation::set('invalid_student_email_message', 'Het email adres van de student moet overeenkomen met het opgegeven email domein van een student in de instellingen.');
Translation::set('invalid_teacher_email_message', 'Het email adres van de docent moet overeenkomen met het opgegeven email domein van een docent in de instellingen.');
Translation::set('form_delete_confirmation_message', 'Weet je zeker dat je dit item wilt verwijderen?');
Translation::set('form_branch', 'Werkveld');
Translation::set('form_landscape', 'Landschap');
Translation::set('form_choose_landscape', 'Kies het landschap');
Translation::set('form_workspace', 'werkplek');
Translation::set('form_map', 'Plattegrond');
Translation::set('form_meeting_room', 'vergaderruimte');
Translation::set('form_work_area', 'Werkveld');
Translation::set('form_choose_work_area', 'Kies werkveld');
Translation::set('form_choose_branch', 'Kies het werkveld');
Translation::set('form_title', 'Titel');
Translation::set('form_title_placeholder', 'Typ de titel');
Translation::set('form_page_slug', 'Pagina URL');
Translation::set('form_page_slug_placeholder', 'Typ de pagina URL');
Translation::set('form_picture', 'Afbeelding');
Translation::set('form_thumbnail_picture', 'Thumbnail');
Translation::set('form_recommended_thumbnail_picture_size', 'Aanbevolen grootte: 350x300');
Translation::set('form_banner_picture', 'Banner');
Translation::set('form_banner_normal_picture', 'Banner foto');
Translation::set('form_recommended_banner_picture_size', 'Aanbevolen grootte: 750x300');
Translation::set('form_header_picture', 'Header');
Translation::set('form_recommended_header_picture_size', 'Aanbevolen grootte: 1500x400');
Translation::set('form_page_content', 'De content van de pagina');
Translation::set('form_project_content', 'De content van het project');
Translation::set('form_show_page_in_menu', 'Pagina in menu');
Translation::set('form_yes', 'Ja');
Translation::set('form_yes_public', 'Ja, openbaar');
Translation::set('form_yes_loggedIn', 'Ja, ingelogd');
Translation::set('form_yes_in_footer', 'Ja, in de footer');
Translation::set('form_yes_and_in_footer', 'Ja, in menu én in footer');
Translation::set('form_no', 'Nee');
Translation::set('form_static', 'Statisch');
Translation::set('form_unknown', 'Onbekend');
Translation::set('filter_records', 'Toon');
Translation::set('form_opening_hour', 'Openingstijd');
Translation::set('form_closing_hour', 'Sluitingstijd');
Translation::set('form_invalid_date', 'Ongeldige waardes opgegeven.');
Translation::set('form_invalid_data', 'Ongeldige waardes opgegeven.');
Translation::set('form_invalid_email_domain', 'Ongeldige email domein opgegeven.');
Translation::set('form_name_already_exists', 'De gekozen naam bestaat al, kies een andere naam en probeer het opnieuw.');
Translation::set('form_email_already_exists', 'De gekozen email bestaat al, kies een andere email en probeer het opnieuw.');
Translation::set('form_choose_workspace_or_meeting_room', 'Wat wil je reserveren?');
Translation::set('form_translation_name', 'De tekst sleutel');
Translation::set('form_translation_value', 'De sleutel waarde');
Translation::set('form_invalid_string_length', '%s moet minimaal %u en maximaal %u tekens bevatten.');
Translation::set('form_min_invalid_string_length', '%s moet minimaal %u tekens bevatten.');
Translation::set('form_max_invalid_string_length', '%s mag maximaal %u tekens bevatten.');

/**
 * Button translations.
 */
Translation::set('archive', 'Archiveren');
Translation::set('recover', 'Herstellen');
Translation::set('edit', 'Bewerken');
Translation::set('delete', 'Verwijderen');
Translation::set('login_button', 'Inloggen');
Translation::set('register_button', 'Registreren');
Translation::set('mail_button', 'Verzend mail');
Translation::set('back_button', 'Terug');
Translation::set('previous_button', 'Vorige');
Translation::set('next_button', 'Volgende');
Translation::set('add_button', 'Toevoegen');
Translation::set('add_workspace_button', 'Werkplek toevoegen');
Translation::set('add_meetingRoom_button', 'Vergaderruimte toevoegen');
Translation::set('save_button', 'Opslaan');
Translation::set('create_button', 'Aanmaken');
Translation::set('sign_up_button', 'Aanmelden >');
Translation::set('signUp_button', 'Aanmelden');
Translation::set('send_button', 'Verzenden');
Translation::set('reset_button', 'Reset');
Translation::set('edit_button', 'Bewerken >');
Translation::set('upload_button', 'Uploaden');
Translation::set('unblock_button', 'Deblokkeren');
Translation::set('reservation_button', 'Reserveren >');
Translation::set('accounts_maintenance_button', 'Accounts beheren');
Translation::set('account_maintenance_button', 'Account beheren');
Translation::set('add_account_button', 'Account toevoegen');
Translation::set('information_button', 'Informatie >');
Translation::set('make_appointment_button', 'Afspraak maken >');
Translation::set('add_project_button', 'Project aanmelden >');
Translation::set('view_project_button', 'Bekijk project >');
Translation::set('view_button', 'Bekijken >');
Translation::set('view_all_button', 'Bekijk alles >');
Translation::set('view_contact_person_button', 'Bekijk de contactpersonen >');
Translation::set('contact_the_contact_person_button', 'Neem contact op >');
Translation::set('make_contact_button', 'Contact opnemen >');
Translation::set('create_page_button', 'Pagina toevoegen');
Translation::set('create_event_button', 'Meet the Expert toevoegen');
Translation::set('create_project_button', 'Project toevoegen');
Translation::set('create_contact_button', 'Contactpersoon toevoegen');
Translation::set('history', 'Historie');
Translation::set('export_members_list', 'Deelnemerslijst exporteren');
Translation::set('days_button', 'dagen');
Translation::set('event_button', ' sessies');

/**
 * Language translations.
 */
Translation::set('choose_language_title', 'Taal');
Translation::set('dutch_language', 'Nederlands');
Translation::set('dutch_language_flag_alt', 'Nederlandse vlag');
Translation::set('english_language', 'Engels');
Translation::set('english_language_flag_alt', 'Engelse vlag');

/**
 * Mail translations.
 */
Translation::set('email_is_not_valid_mail_error', 'Ongeldige email opgegeven.');

/**
 * Upload translations.
 */
Translation::set(
    'not_allowed_file_upload',
    'Je probeerde een niet toegestaan bestand te uploaden. Alleen bestanden met .svg, .jpg, .jpeg en .png zijn toegestaan.'
);
Translation::set('error_while_uploading_file', 'Het bestand kon niet worden geüpload.');

/**
 * CSRF translations.
 */
Translation::set('failed_csrf_check_message', 'De sessie is verlopen.');

/**
 * Recaptcha translations.
 */
Translation::set('failed_recaptcha_check_message', 'Er is iets fout gegaan. Probeer het opnieuw.');
Translation::set('something_went_wrong', 'Er is iets fout gegaan. Probeer het later opnieuw.');
