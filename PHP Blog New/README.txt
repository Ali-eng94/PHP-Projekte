# PHP Blog System

## Projektübersicht

Dieses Projekt ist ein vollständiges Blog-System, das mit PHP, MySQL, PDO, HTML, CSS, Bootstrap und JavaScript entwickelt wurde.

Das Ziel des Projekts war es, ein eigenes Content-Management-System (CMS) zu erstellen, in dem Benutzer Beiträge veröffentlichen und verwalten können.

## Bereits implementierte Funktionen

### Benutzerverwaltung

* Benutzerregistrierung (`signup.php`)
* Benutzeranmeldung (`login.php`)
* Benutzerabmeldung (`logout.php`)
* Sitzungsverwaltung mit PHP Sessions
* Zugriffsschutz für geschützte Bereiche

### Profilverwaltung

* Profilinformationen bearbeiten
* Profilbild hochladen und ändern
* Passwort ändern
* Benutzerprofil aktualisieren

### Blog-Beiträge

* Neue Beiträge erstellen
* Vorhandene Beiträge bearbeiten
* Beiträge löschen
* Einzelne Beiträge anzeigen
* Beiträge auf der Startseite auflisten

### Datenbank

* Verbindung mit MySQL über PDO
* Speicherung von Benutzerdaten
* Speicherung von Blog-Beiträgen
* Datenbankabfragen mit vorbereiteten Statements

### Benutzeroberfläche

* Responsive Design mit Bootstrap
* Navigationsleiste
* Wiederverwendbare Komponenten (Navbar und Footer)
* Eigene CSS-Dateien für das Layout

### Projektstruktur

#### Hauptseiten

* `index.php` – Startseite
* `about.php` – Über-Seite
* `post.php` – Einzelner Blogbeitrag
* `author.php` – Autorenansicht

#### Benutzerfunktionen

* `signup.php` – Registrierung
* `login.php` – Anmeldung
* `logout.php` – Abmeldung
* `change_profile.php` – Profil bearbeiten
* `change_password.php` – Passwort ändern
* `change_info.php` – Benutzerinformationen ändern

#### Beitragsverwaltung

* `newpost.php` – Neuen Beitrag erstellen
* `edit_post.php` – Beitrag bearbeiten

#### Backend-Aktionen

Im Ordner `actions/` wurden folgende Funktionen implementiert:

* Benutzerregistrierung
* Benutzeranmeldung
* Profiländerungen
* Passwortänderungen
* Beitragserstellung
* Beitragsbearbeitung
* Beitragslöschung

#### Wiederverwendbare Komponenten

Im Ordner `components/`:

* Navbar
* Footer
* Login-Prüfung
* Zugriffskontrolle

## Verwendete Technologien

* PHP
* MySQL
* PDO
* HTML5
* CSS3
* Bootstrap
* JavaScript
* jQuery

## Lernziele des Projekts

Während der Entwicklung wurden folgende Themen umgesetzt:

* Objektorientierte Datenbankanbindung mit PDO
* Benutzer-Authentifizierung
* Session-Management
* CRUD-Operationen (Create, Read, Update, Delete)
* Formularverarbeitung
* Dateiuploads
* Responsive Webdesign

## Autor

Ali Haji
