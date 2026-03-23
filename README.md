Opis aplikacije
Veb aplikacija za poručivanje hrane je moderna Full-Stack aplikacija koja omogućava pregled restorana na interaktivnoj mapi uz podršku za geocoding putem OpenStreetMap Nominatim servisa.Omogućava kreiranje i upravljanje porudžbinama, kao i prikaz optimalne rute dostave sa procenjenim vremenom i kilometražom putem Leaflet Routing Machine biblioteke i OSRM API-ja. Korisnici mogu da pregledaju menije restorana, dodaju jela u korpu i ostavljaju recenzije i ocene. Sistem sadrži kompletnu autentifikaciju i autorizaciju putem Laravel Sanctum tokena za različite tipove korisnika (kupac, dostavljač, administrator).

Tehnologije
Frontend React (SPA), React Router, Axios, Leaflet, Leaflet Routing Machine
Backend Laravel (PHP), Laravel Sanctum
Baza podataka MySQL
Eksterni API-ji: OpenStreetMap Nominatim (geocoding), OSRM (rutiranje)

Funkcionalnosti
Registracija, prijava i odjava korisnika
Pregled restorana u listi i na interaktivnoj mapi
Pregled menija i dodavanje jela u korpu
Kreiranje porudžbine sa adresom isporuke i načinom plaćanja
Prikaz rute dostave sa procenjenim vremenom i kilometražom
Ostavljanje recenzija i ocena restorana
Admin panel za upravljanje zahtevima dostavljača
Stranica za dostavljače sa pregledom i ažuriranjem statusa porudžbina

Lokalno pokretanje (bez Docker-a)
Backend (Laravel)
cd projekatapi
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

Frontend (React)
cd projekatfront
npm install
npm start

Frontend se pokreće na http://localhost:3000, a backend na http://localhost:8000.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ime_baze
DB_USERNAME=korisnicko_ime
DB_PASSWORD=lozinka
