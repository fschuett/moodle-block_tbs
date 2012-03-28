<?php // $Id: block_mrbs.php,v 1.11 2009/11/07 14:50:34 arborrow Exp $
// Bearbeitung 20081008 Hilgenstock/Misch
// Bearbeitung 20081202 Ralf Krause
// Bearbeitung 20091107 Jens-Peter Misch
// Bearbeitung 20120325 Ralf Krause
$string['about_mrbs'] = 'Über MRBS';
$string['accessdenied'] = 'Zugang verweigert';
$string['accessmrbs'] = 'Ressourcen verwalten';
$string['addarea'] = 'Bereich hinzufügen';
$string['addentry'] = 'Eintrag hinzufügen';
$string['addroom'] = 'Ressource hinzufügen';
$string['adminview'] = 'Über welche URL wird das Buchungssystem MRBS aufgerufen?';
$string['advanced_search'] = 'Erweiterte Suche';
$string['all_day'] = 'Ganztägig';
$string['area_admin_email'] = 'E-Mail Bereichsadmin';
$string['area'] = 'Bereich';
$string['areas'] = 'Bereiche';
$string['backadmin'] = 'Zurück zu Admin';
$string['bgcolor'] = 'Färbung';
$string['blockname'] = 'Buchungssystem';
$string['booking_users'] = 'Nutzer für Buchung';
$string['booking_users_help'] = 'Tragen Sie hier eine kommagetrennte Liste von E-Mail-Adressen der Nutzer/innen ein, die diesen Raum oder dieses Gerät buchen dürfen. Wenn Sie das Feld leer lassen, dürfen alle Nutzer/innen buchen.';
$string['bookingmoved'] = 'Eine Ihrer Buchungen wurde geändert';
$string['bookingmovedmessage'] = 'Ihre Buchung {$a->name} wurde von \'{$a->oldroom}\' nach \'{$a->newroom}\' im Bereich \'{$a->area}\' geändert, u.z. für die Zeit {$a->date} - {$a->starttime}. Der Raum bzw. das Gerät wird benötigt von {$a->newbookingname}. ACHTUNG: Diese Umbuchung wurde automatisch durchgeführt! Kontrollieren Sie unbedingt, ob dieser Ersatz für Sie brauchbar ist!';
$string['bookingmovedshort'] = '{$a->name} umgelegt auf {$a->newroom}';
$string['bookingmoveerror'] = 'FEHLER BEI DER UMBUCHUNG';
$string['bookingmoveerrormessage'] = 'Bei der Umbuchung von {$a->name} (id: {$a->id}) ist ein Fehler aufgetreten.';
$string['bookingmoveerrorshort'] = 'Bei der Umbuchung von {$a->name} ist ein Fehler aufgetreten. Der Administrator wurde informiert.';
$string['bookingsfor'] = 'Einträge für';
$string['bookingsforpost'] = '';
$string['both'] = 'Beides';
$string['brief_description'] = 'Beschreibung:';
$string['browserlang'] = 'Die Spracheinstellung im Browsers lautet';
$string['capacity'] = 'Kapazität';
$string['charset'] = 'UTF-8';
$string['clash'] = 'Konflikt: {$a->oldbooking} {$a->newbooking} {$a->time} mit Ressource: {$a->room}';
$string['clashemailbody'] = 'Während des aktuellen Imports gab es einen Konflikt bei der Buchuung der Resource: Um {$a->time} benutzen {$a->oldbooking} und {$a->newbooking} beide gleichzeitig die Ressource {$a->room}. Korrigieren Sie das Problem, um unnötige Störungen zu vermeiden. DIES IST DIE EINZIGE WARNUNG DIESES KONFLIKTS. WENN SIE DIESE E-MAIL IGNORIEREN KANN ES ZU PROBLEMEN KOMMEN. Die Mail wurde automatisch vom Buchungssystem versendet. Wenn Sie denken, dass  hier ein Fehler vorliegt, kontaktieren Sie den Administrator {$a->admin}';
$string['clashemailnotsent'] = 'Kann die E-Mail nicht versenden an ';
$string['clashemailsent'] = 'E-Mail versendet an:';
$string['clashemailsub'] = 'Hinweis zu Buchungskonflikt';
$string['class'] = 'Klasse';
$string['click_to_reserve'] = 'Um eine Reservierung vorzunehmen, klicken Sie in ein Tabellenfeld.';
$string['computerroom'] = 'Nur Computerräume';
$string['computerrooms'] = 'Computerräume';
$string['config_admin_email'] = 'E-Mail MRBS Admin';
$string['config_admin_email2'] = 'E-Mail-Adresse des MRBS-Administrators';
$string['config_admin'] = 'MRBS Admin';
$string['config_admin2'] = 'Name des MRBS-Administrators';
$string['config_area_list_format'] = 'Anzeige der Bereiche';
$string['config_area_list_format2'] = 'Sollen Bereiche als Liste (Auflisten) oder Auswahlbox (Auswählen) angezeigt werden?';
$string['config_cookie_path_override'] = 'Cookie Pfad überschreiben';
$string['config_cookie_path_override2'] = 'Wenn diese Opition aktiviert ist, wird der Pfad benutzt von der \'php\' session Schema zum überschreiben des standardmäßigen Verhalten der automatischen Entscheidung welche Cookiepfad genommen wird.';
$string['config_date_ddmmyy'] = '10 Juli';
$string['config_date_mmddyy'] = 'Juli 10';
$string['config_dateformat'] = 'Datumsformat';
$string['config_dateformat2'] = 'Angezeigtes Datumsformat';
$string['config_default_report_days'] = 'Berichtszeitraum (Tage)';
$string['config_default_report_days2'] = 'Standardmäßig ist dieser Berichtszeitraum (in Tagen) voreingestellt.';
$string['config_default_room'] = 'Standard Ressource';
$string['config_default_room2'] = 'Standardmäßig wird diese Ressource beim Aufruf des Buchungssystems gezeigt. Die Raum- bzw. Gerätennummer lässt sich über den Link auf die Ressource herausfinden.';
$string['config_default_view'] = 'Standard Anzeige';
$string['config_default_view2'] = 'Standardmäßig wird diese Anzeige (Monat, Woche oder Tag) beim Aufruf des Buchungssystems gezeigt.';
$string['config_enable_periods'] = 'Eigene Zeittafel';
$string['config_enable_periods2'] = 'Die Option \'Eigene Zeittafel\' ermöglicht die Angabe von eigenen Zeitblöcken für die Buchung. Wenn \'Nein\' gewählt ist, wird ein gleichmäßiges Zeitraster über den Tag erzeugt.';
$string['config_entry_type'] = 'Kategorie {$a}';
$string['config_entry_type2'] = 'Die Kategorie bezieht sich auf den Dialog \'Eintrag hinzufügen\'. Jede Kategorie wird unterschiedlich eingefärbt.';
$string['config_eveningends_min'] = 'Ende Minute';
$string['config_eveningends_min2']  = 'Endzeit (Minute) für gleichmäßiges Zeitraster. Die Option \'Eigene Zeittafel\' ist deaktiviert.';
$string['config_eveningends'] = 'Ende Stunde';
$string['config_eveningends2']  = 'Endzeit (Stunde) für gleichmäßiges Zeitraster. Die Option \'Eigene Zeittafel\' ist deaktiviert.';
$string['config_highlight_method'] = 'Hervorhebung';
$string['config_highlight_method2'] = 'Wählen Sie eine Möglichkeit zur Hervorhebung aus:  Färbung, Klasse oder Hybrid.';
$string['config_javascript_cursor'] = 'JavaScript Cursor';
$string['config_javascript_cursor2'] = 'Wählen Sie \'Nein\', wenn für das Buchungssystems noch alte Browser benutzt werden, die inkompatibel zu JavaScript sind.';
$string['config_mail_admin_on_bookings'] = 'E-Mail an Admin';
$string['config_mail_admin_on_bookings2'] = 'Der Admin wird per E-Mail über neue Buchungen informiert.';
$string['config_mail_area_admin_on_bookings'] = 'E-Mail an Bereichsadmin';
$string['config_mail_area_admin_on_bookings2'] = 'Der Bereichsadmin wird per E-Mail über neue Buchungen in seinem Bereich informiert.';
$string['config_mail_cc'] = 'E-Mail-Kopie';
$string['config_mail_cc2'] = 'Weitere E-Mail-Empfänger können im Feld cc eintragen werden. Standardmäßig ist dieses Feld leer. Es können mehrere Empfänger eingetragen werden. Jeder Empfänger muss ein Moodlekonto haben.' ;
$string['config_mail_from'] = 'E-Mail-Absender';
$string['config_mail_from2'] = 'Diese Absenderadresse wird in ausgehende E-Mails eingetragen. Standardmäßig ist es die E-Mail-Adresse des MRBS-Admins. Der Absender muss ein Moodlekonto haben.';
$string['config_mail_recipients'] = 'E-Mail-Empfänger';
$string['config_mail_recipients2'] = 'Geben Sie die E-Mail der Empfänger ein.  Es können mehrere Empfänger als kommagetrennte Liste eingetragen werden, z.B.  \'john@doe.com,scott@tiger.com\'. Jeder Empfänger muss ein Moodlekonto haben.';
$string['config_mail_room_admin_on_bookings'] = 'E-Mail an Ressourceadmin';
$string['config_mail_room_admin_on_bookings2'] = 'Der Ressourceadmin wird per E-Mail über neue Buchungen seiner Ressource informiert.';
$string['config_mail_admin_on_delete'] = 'E-Mail an Admin (Löschen)';
$string['config_mail_admin_on_delete2'] = 'Der Admin wird per E-Mail über das Löschen einer Buchung informiert.';
$string['config_mail_admin_all'] = 'E-Mail an Admin (Ändern)';
$string['config_mail_admin_all2'] = 'Der Admin wird per E-Mail über das Ändern einer Buchung informiert.';
$string['config_mail_details'] = 'E-Mail-Details';
$string['config_mail_details2'] = 'E-Mail-Details';
$string['config_mail_booker'] = 'E-Mail zur Info';
$string['config_mail_booker2'] = 'Nutzer/innen werden per E-Mail über ihre eigene neue Buchung informiert.';
$string['config_max_advance_days'] = 'Max. Tage im voraus';
$string['config_max_advance_days2'] = 'Anzahl der Tage, die maximal im voraus gebucht werden dürfen (-1 = deaktiviert)';
$string['config_max_rep_entrys'] = 'Max. Wiederholungen';
$string['config_max_rep_entrys2'] = 'Maximale Anzahl von Terminwiederholungen';
$string['config_monthly_view_entries_details'] = 'Details in Monatsansicht';
$string['config_monthly_view_entries_details2'] = 'In der Monatsansicht können Anfangs-/Endzeitpunkt (Zeitraum), die Beschreibung oder beides angezeigt werden. Pro Tag werden standardmäßig max. 6 Einträge dargestellt (max. 12 sind einstellbar).';
$string['config_morningstarts_min'] = 'Start Minute';
$string['config_morningstarts_min2']  = 'Startzeit (Minute) für gleichmäßiges Zeitraster. Die Option \'Eigene Zeittafel\' ist deaktiviert.';
$string['config_morningstarts'] = 'Start Stunde';
$string['config_morningstarts2']  = 'Startzeit (Stunde) für gleichmäßiges Zeitraster. Die Option \'Eigene Zeittafel\' ist deaktiviert.';
$string['config_new_window'] = 'Fenster';
$string['config_new_window2'] = 'Wenn \'Neues Fenster\' ausgewählt ist, dann wird das MRBS in einem neuem Fenster geöffnet. Wenn \'Gleiches Fenster\' gewählt ist, dann wird das MRBS im gleichen Fenster geöffnet - innerhalb von Moodle mit Navigationsleiste!';
$string['config_periods'] = 'Einträge für Zeittafel';
$string['config_periods2']  = 'Das Buchungssystem ist flexibel an jedes Stunden- und Pausenraster anpassbar. Verwenden Sie im Textbereich für jeden Zeitblock eine neue Zeile. Es sind beliebige Texteinträge erlaubt, z.B. \'1.Std\' oder \'07.30-09.00\'. Um Zeilenumbrüche in den Einträgen zu verhindern, können Sie Leerzeichen als \'&amp;nbsp;\' kodieren.';
$string['config_refresh_rate'] = 'Seitenaktualisierung';
$string['config_refresh_rate2'] = 'Seitenaktualisierung (Angabe in Sekunden). Zum Deaktivieren setzen Sie die Einstellung auf 0.';
$string['config_resolution'] = 'Zeitraster';
$string['config_resolution2']  = 'MRBS erzeugt ein gleichmäßiges Zeitraster. Die Option \'Eigene Zeittafel\' ist deaktiviert.';
$string['config_search_count'] = 'Suchergebnisse pro Seite';
$string['config_search_count2'] = 'Suchergebnisse pro Seite';
$string['config_show_plus_link'] = 'Symbol (+) anzeigen';
$string['config_show_plus_link2'] = 'Diese Option legt fest, ob das Symbol (+) in freien Feldern angezeigt wird.';
$string['config_timeformat'] = 'Zeitformat';
$string['config_timeformat2']  = 'Angezeigtes Zeitformat';
$string['config_times_right_side'] = 'Zeitangabe rechts';
$string['config_times_right_side2'] = 'Um die Zeitangaben auch auf der rechten Seite anzuzeigen, muss hier \'Ja\' ausgewählt werden.';
$string['config_view_week_number'] = 'Wochennummer';
$string['config_view_week_number2'] = 'Die Wochennummer wird an Stelle des Datums für den ersten Wochentag (z.B. 13 Okt) angezeigt.';
$string['config_weeklength'] = 'Wochentage';
$string['config_weeklength2'] = 'Wie viele Tage pro Woche sollen angezeigt werden?';
$string['config_weekstarts'] = 'Wochenanfang';
$string['config_weekstarts2'] = 'Wählen Sie hier den ersten Tag der Woche aus.';
$string['confirmdel'] = 'Möchten Sie diesen Eintrag löschen?';
$string['conflict'] = 'Der neue Eintrag hat einen Konflikt mit folgenden Einträgen:';
$string['createdby'] = 'Erstellt von:';
$string['cronfile'] = 'Datei für Sessionimport';
$string['cronfiledesc'] = 'Um den automatischen Sessionimport zu nutzen, müssen Sie hier den Speicherort einer entsprechenden Importdatei angeben. Die Datei muss mit den Rechten des Webservers geändert werden können. Der Sessionimport erzeugt spezielle Einträge für eine \'Importierte Buchung\'.';
$string['ctrl_click_type'] = 'Mehrfachauswahl möglich';
$string['ctrl_click'] = 'Mehrfachauswahl möglich';
$string['database'] = 'Datenbank: ';
$string['dayafter'] = 'nächster Tag ';
$string['daybefore'] = ' vorheriger Tag';
$string['days'] = 'Tage';
$string['delarea'] = 'Sie müssen alle Ressourcen im Bereich löschen, bevor Sie den Bereich löschen können<p>';
$string['delete_user'] = 'Benutzer löschen';
$string['deleteentry'] = 'Eintrag löschen';
$string['deletefollowing'] = 'Dadurch werden die folgenden Einträge gelöscht';
$string['deleteseries'] = 'Alle Einträge löschen';
$string['dontshowoccupied'] = 'Belegte Resourcen nicht anzeigen ';
$string['doublebookebody'] = 'The user {$a->user} has double booked your room, {$a->room}, at {$a->time} on {$a->date}. This clashes with your booking for {$a->oldbooking}. The user has booked the room for {$a->newbooking}. If this is not a problem, no action is required. However, if you weren\'t expecting this, please contact the user to resolve the conflict. This message has been sent automatically by the online room booking system, if you think you have recieved this in error please contact {$a->admin}';
$string['doublebookesubject'] = 'Mitteilung zur Doppelbuchung';
$string['doublebookefailsubject'] = 'Fehler bei Mitteilung zur Doppelbuchung';
$string['doublebookefailbody'] = 'Die folgende Nachricht konnte nicht an {$a} versendet werden:';
$string['duration'] = 'Dauer:';
$string['edit_user'] = 'Nutzer bearbeiten';
$string['editarea'] = 'Bereich bearbeiten';
$string['editentry'] = 'Eintrag ändern';
$string['editroom'] = 'Ressource bearbeiten';
$string['editroomarea'] = 'Ressource- oder Bereichsbeschreibung bearbeiten';
$string['editseries'] = 'Alle Einträge ändern';
$string['editingserieswarning'] = 'Sie bearbeiten gerade einen einzelnen Eintrag in einer Serie. Klicken Sie hier, um stattdessen die ganze Serie zu bearbeiten: ';
$string['email_failed'] = 'Email send failed';
$string['end_date'] = 'Enddatum:';
$string['entries_found'] = 'Einträge gefunden';
$string['entry_found'] = 'Eintrag gefunden';
$string['entry'] = 'Eintrag';
$string['entryid'] = 'Eintrags-ID ';
$string['error_area'] = 'Fehler: Bereich ';
$string['error_room'] = 'Fehler: Ressource ';
$string['error_send_email'] = 'Fehler beim Versenden der E-Mail an: {$a}';
$string['external'] = 'Extern';
$string['failed_connect_db'] = 'Schwerer Fehler: Kann nicht an Datenbank anbinden';
$string['failed_to_acquire'] = 'Konnte nicht exclusiv auf die Datenbank zugreifen';
$string['finishedimport']  = 'Prozess wurde nach {$a} Sekunden abgeschlossen';
$string['for_any_questions'] = 'für Fragen, die hier nicht beantwortet sind.';
$string['fulldescription'] = 'Beschreibung:';
$string['goroom'] = 'Go';
$string['goto'] = 'Start';
$string['gotoroom'] = 'Go to';
$string['gotothismonth'] = 'aktueller Monat';
$string['gotothisweek'] = 'aktuelle Woche';
$string['gototoday'] = 'heute';
$string['help_wildcard'] = 'Hinweis: Benutzen Sie das Symbol % als Wildcard den Suchfeldern.';
$string['highlight_line'] = 'Markieren Sie diese Zeile';
$string['hours'] = 'Stunden';
$string['hybrid'] = 'Hybrid';
$string['idontcare'] = 'Doppelte Buchung ist OK';
$string['importedbooking'] = 'Importierte Buchung';
$string['importedbookingmoved'] = 'Importierte Buchung (Editiert)';
$string['importlog'] = 'MRBS Import log';
$string['in'] = 'in';
$string['include'] = 'Einbeziehen';
$string['internal'] = 'Intern';
$string['invalid_booking']    = 'Ungültige Buchung';
$string['invalid_entry_id'] = 'Fehlerhafter Eintrag id.';
$string['invalid_search'] = 'Leerer oder ungültiger Suchbegriff.';
$string['invalid_series_id'] = 'Falsche Serien-ID';
$string['mail_body_changed_entry'] = 'Geänderter Eintrag';
$string['mail_body_del_entry'] = 'Gelöschter Eintrag';
$string['mail_body_new_entry'] = 'Neuer Eintrag';
$string['mail_changed_entry'] = 'Ein Eintrag wurde geändert';
$string['mail_deleted_entry'] = 'Ein Eintrag wurde gelöscht';
$string['mail_new_entry'] = 'Ein neuer Eintrag wurde angelegt';
$string['mail_subject'] = 'Betreff';
$string['mail_subject_entry'] = 'Eintrag hinzugefügt/geändert: {$a->date} (by {$a->user})';
$string['mail_subject_delete'] = 'Eintrag gelöscht: {$a->date} (gebucht von {$a->user}) ';
$string['match_area'] = 'Suche Bereich:';
$string['match_descr'] = 'Suche Beschreibung:';
$string['match_entry'] = 'Suche Reservierung:';
$string['match_room'] = 'Suche Ressource:';
$string['match_type'] = 'Nach Art:';
$string['mincapacity'] = 'Minimale Kapazität';
$string['minutes'] = 'Minuten';
$string['month'] = 'Monat';
$string['monthafter'] = 'nächster Monat ';
$string['monthbefore'] = ' vorheriger Monat';
$string['movedto'] = ' verlegt nach';
$string['mrbs:administermrbs'] = 'Zugriff MRBS (lesen / schreiben / admin)';
$string['mrbs:editmrbs'] = 'Zugriff MRBS (lesen / schreiben)';
$string['mrbs:doublebook'] = 'Doppelbuchungen vornehmen';
$string['mrbs:editmrbsunconfirmed'] = 'Only create \'unconfirmed\' bookings (overriden by \'editmrbs\')';
$string['mrbs:forcebook'] = 'Buchungen überschreiben (vorherige Buchungen automatisch verschieben)';
$string['mrbs:viewalltt'] = 'Alle Buchungen sehen';
$string['mrbs:viewmrbs'] = 'Zugriff MRBS (nur lesen)';
$string['mrbs'] = 'Buchungssystem';
$string['mrbsadmin'] = 'MRBS Administrator';
$string['mrbsadmin_desc'] = 'Nutzer/innen mit dieser globalen Rolle können das Buchungssystem MRBS verwalten, Bereiche und Ressourcen anlegen, Buchungen aller Personen ändern, Buchungen erzwingen und Doppelbuchungen vornehmen.';
$string['mrbseditor'] = 'MRBS Editor';
$string['mrbseditor_desc'] = 'Nutzer/innen mit dieser globalen Rolle können das Buchungssystem MRBS benutzen, eigene Buchungen vornehmen, ändern und löschen, außerdem alle Buchungen sehen.';
$string['mrbsviewer'] = 'MRBS Viewer';
$string['mrbsviewer_desc'] = 'Nutzer/innen mit dieser globalen Rolle können das Buchungssystem MRBS nur sehen, aber keine Änderungen vornehmen.';
$string['mustlogin'] = 'Sie müssen sich anmelden, um den Kalender zu sehen.';
$string['must_set_description'] = 'Sie müssen eine Beschreibung eintragen.';
$string['must_set_name'] = 'Sie müssen Ihren Namen eintragen.';
$string['namebooker'] = 'Reservierung:';
$string['newwindow'] = 'Neues Fenster';
$string['no_rooms_for_area'] = 'Der Bereich enthält keine Ressource';
$string['no_user_with_email'] = 'Zur E-Mail-Adresse {$a} wurde kein Nutzerkonto gefunden. Alle im Buchungssystem verwendeten E-Mail-Adressen müssen zu einem Nutzerkonto passen.';
$string['no_users_create_first_admin'] = 'Erstellen Sie einen Nutzer als Administrator. Nach dem Login kann dieser weitere Nutzer anlegen.';
$string['no_users_initial'] = 'In der Datenbank sind keine Nutzer vorhanden. Legen Sie den ersten Nutzer an.';
$string['noarea'] = 'Kein Bereich ausgewählt';
$string['noareas'] = 'Keine Bereiche';
$string['norights'] = 'Sie dürfen diesen Eintrag nicht ändern!';
$string['norooms'] = 'Keine Ressource vorhanden';
$string['noroomsfound']= 'Keine Ressource gefunden';
$string['not_found'] = ' nicht gefunden';
$string['not_php3'] = '<H1>WARNUNG: Funktioniert wahrscheinlich nicht mit PHP3</H1>';
$string['notallcreated'] = 'Einige Buchungen liegen zu weit im voraus. Es wurden {$a->created} von {$a->requested} Buchungen eingetragen.';
$string['notallowedbook'] = 'Sie stehen nicht in der Liste der Personen, die diese Ressource buchen dürfen.';
$string['of'] = ' von ';
$string['pagewindow'] = 'Gleiches Fenster';
$string['password_twice'] = 'Falls Sie Ihr Passwort ändern möchten, geben Sie das neue Passwort zweimal ein.';
$string['period'] = 'Block';
$string['periods'] = 'Blöcke';
$string['please_contact'] = 'Nehmen Sie bitte Kontakt auf mit ';
$string['pluginname'] = 'MRBS';
$string['postbrowserlang'] = '.';
$string['ppreview'] = 'Druckansicht';
$string['records'] = 'Ergebnisse ';
$string['rep_dsp_dur'] = 'Dauer';
$string['rep_dsp_end'] = 'Endzeit';
$string['rep_dsp'] = 'Zeige im Report:';
$string['rep_end_date'] = 'Wiederholung bis:';
$string['rep_for_nweekly'] = '(jede n-te Woche)';
$string['rep_for_weekly'] = '(wöchentlich)';
$string['rep_freq'] = 'Häufigkeit:';
$string['rep_num_weeks'] = 'Abstand:';
$string['rep_rep_day'] = 'Wiederholung am:';
$string['rep_type_0'] = 'Keine';
$string['rep_type_1'] = 'täglich';
$string['rep_type_2'] = 'wöchentlich';
$string['rep_type_3'] = 'monatlich';
$string['rep_type_4'] = 'jährlich';
$string['rep_type_5'] = 'monatlich an diesem Tag';
$string['rep_type_6'] = 'jede n-te Woche';
$string['rep_type'] = 'Wiederholung?';
$string['repeat_id'] = 'Wiederholungs ID ';
$string['report_and_summary'] = 'Bericht und Zusammenfassung';
$string['report_end'] = 'Bericht Ende:';
$string['report_on'] = 'Bericht über Termine:';
$string['report_only'] = 'nur Bericht';
$string['report_start'] = 'Bericht Beginn:';
$string['requestvacate']      = 'Anfrage ob diese Resource umgebucht werden kann';
$string['requestvacatemessage']= '{$a->user} requests that you move {$a->description} from room {$a->room}, {$a->datetime}. Please contact them to discuss this.[Give a reason]';
$string['requestvacatemessage_html']= '{$a->user} requests that you move <a href="{$a->href}">{$a->description}</a> from room {$a->room}, {$a->datetime}. Please contact them to discuss this.<br /><br />[Give a reason]';
$string['resolution_units'] = ' Minuten';
$string['returncal'] = 'Zurück zur Kalenderansicht';
$string['returnprev'] = 'Zurück zur vorherigen Seite';
$string['rights'] = 'Rechte';
$string['room_admin_email'] = 'E-Mail Ressourceadmin';
$string['room'] = 'Ressource';
$string['roomchange'] = 'Als Änderung markieren';
$string['rooms'] = 'Ressourcen';
$string['roomsearch'] = 'Ressource';
$string['roomsfree'] = 'Ressource frei...';
$string['sched_conflict'] = 'Konflikt in der Planung';
$string['search_for'] = 'Suche nach';
$string['search_results'] = 'Suchergebnis für:';
$string['seconds'] = 'Sekunden';
$string['serverpath'] = 'MRBS URL';
$string['show_my_entries'] = 'Meine anstehenden Einträge anzeigen';
$string['slot'] = 'Zeitraum';
$string['sort_rep_time'] = 'Startzeit/Datum ';
$string['sort_rep'] = 'Sortiere Report nach:';
$string['specialroom'] = 'Spezielle Ressourcen ausklammern';
$string['start_date'] = 'Anfangsdatum:';
$string['startedimport'] = 'Datei gefunden, beginne mit Import-Prozess...';
$string['submitquery'] = 'Bericht erstellen';
$string['sum_by_creator'] = 'Erstellt von';
$string['sum_by_descrip'] = 'Reservierung';
$string['summarize_by'] = 'Zusammenfassung nach:';
$string['summary_header_per'] = 'Ergebnis des (eingetragenen) Zeitraums';
$string['summary_header'] = 'Stundenzusammenfassung der Einträge';
$string['summary_only'] = 'nur Zusammenfassung';
$string['sure'] = 'Sind Sie sicher?';
$string['system'] = 'System: ';
$string['teachingroom'] = 'Nur Unterrichtsressourcen';
$string['through'] = ' bis ';
$string['too_may_entrys'] = 'Die gewählten Optionen würden zu viele Einträge erzeugen.<br />Ändern Sie bitte Ihre Einstellungen!';
$string['toofaradvance'] = 'Sie können Ressoucen nicht mehr als {$a} Tage im voraus buchen.';
$string['ttfor'] = 'Plan für: ';
$string['type'] = 'Art:';
$string['typea'] = '';
$string['unconfirmedbooking'] = 'Unbestätigt';
$string['unknown'] = 'Unbekannt';
$string['update_area_failed'] = 'Bereichsänderung fehlgeschlagen: ';
$string['update_room_failed'] = 'Ressourceänderung fehlgeschlagen: ';
$string['useful_n-weekly_value'] = 'useful n-weekly value';
$string['valid_room'] = 'Ressource.';
$string['valid_time_of_day'] = 'Gültige Uhrzeit';
$string['viewday'] = 'Zeige Tag';
$string['viewmonth'] = 'Zeige Monat';
$string['viewweek'] = 'Zeige Woche';
$string['weekafter'] = 'nächste Woche ';
$string['weekbefore'] = ' vorherige Woche';
$string['weeks'] = 'Wochen';
$string['you_are'] = 'Sie sind';
$string['you_have_not_entered'] = 'Sie haben folgendes Feld nicht ausgefüllt :';
$string['you_have_not_selected'] = 'Sie haben keine Ressource ';

