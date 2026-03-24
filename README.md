## Opis aplikacije
 
Veb aplikacija za poručivanje hrane je moderna Full-Stack aplikacija koja omogućava pregled restorana na interaktivnoj mapi uz podršku za geocoding putem **OpenStreetMap Nominatim** servisa. Aplikacija omogućava kreiranje i upravljanje porudžbinama, kao i prikaz optimalne rute dostave sa procenjenim vremenom i kilometražom putem **Leaflet Routing Machine** biblioteke i **OSRM API**-ja. Korisnici mogu da pregledaju menije restorana, dodaju jela u korpu i ostavljaju recenzije i ocene. Sistem sadrži kompletnu autentifikaciju i autorizaciju putem **Laravel Sanctum** tokena za različite tipove korisnika (kupac, dostavljač, administrator).
 
---
 
## Tehnologije
 
| Kategorija | Tehnologije |
|---|---|
| Backend | PHP 8.2, Laravel |
| Frontend | React 18, React Router, Axios |
| Baza podataka | MySQL 8.0 |
| Mape i rutiranje | Leaflet, Leaflet Routing Machine |
| Infrastruktura | Docker, Docker Compose |
| Eksterni API-ji | OpenStreetMap Nominatim (geocoding), OSRM (rutiranje) |
 
---
 
## Funkcionalnosti
 
- Registracija, prijava i odjava korisnika
- Pregled restorana u listi i na interaktivnoj mapi
- Pregled menija i dodavanje jela u korpu
- Kreiranje porudžbine sa adresom isporuke i načinom plaćanja
- Prikaz rute dostave sa procenjenim vremenom i kilometražom
- Ostavljanje recenzija i ocena restorana
- Admin panel za upravljanje zahtevima dostavljača
- Stranica za dostavljače sa pregledom i ažuriranjem statusa porudžbina
 
---
 
## Struktura grana (Git Flow)
 
| Grana | Opis |
|---|---|
| `main` | Stabilna produkciona verzija projekta. |
| `develop` | Glavna integraciona grana. Ovde se spajaju sve nove funkcionalnosti pre prebacivanja u produkciju. |
| `feature/docker` | Kontejnerizacija aplikacije; postavljanje Dockerfile-a i docker-compose konfiguracije. |
| `feature/ci-cd` | Implementacija CI/CD pipeline-a pomoću GitHub Actions. |
 
---
 
## API Dokumentacija
 
API dokumentacija je generisana pomoću **dedoc/scramble** paketa i dostupna je na sledećoj adresi nakon pokretanja aplikacije:
 
```
http://localhost:8000/docs/api
```
 
---
 
## Lokalno pokretanje (bez Docker-a)
 
### 1. Kloniranje repozitorijuma
 
```bash
git clone <URL_REPOZITORIJUMA>
cd projekatapi
```
 
### 2. Backend (Laravel)
 
```bash
cd projekatapi
composer install
cp .env.example .env
php artisan key:generate
```
 
> U `.env` fajlu podesite podatke za lokalnu MySQL bazu: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `DB_HOST=127.0.0.1`
 
```bash
php artisan migrate
php artisan serve
```
 
### 3. Frontend (React)
 
```bash
cd projekatfront
npm install
npm run dev
```
 
| Servis | URL |
|---|---|
| Backend | http://localhost:8000 |
| Frontend | http://localhost:3000 |
 
---
 
## Pokretanje pomoću Docker-a
 
### 1. Priprema `.env` fajla
 
```bash
cp projekatapi/.env.example projekatapi/.env
```
 
> U `.env` fajlu postavite `DB_HOST=db` (naziv Docker servisa baze podataka).
 
### 2. Pokretanje kontejnera
 
```bash
docker compose up -d --build
```
 
### 3. Instalacija paketa i migracija
 
```bash
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```
 
### 4. Pristup aplikaciji
 
| Servis | URL |
|---|---|
| Frontend | http://localhost:3000 |
| Backend / API | http://localhost:8000 |
| API Dokumentacija | http://localhost:8000/docs/api |
 
### Gašenje okruženja
 
```bash
docker compose down
```
 
---
 
## Bezbednost
 
Aplikacija je zaštićena od sledećih napada:
- **IDOR** — Policy-based autorizacija za pristup resursima
- **CORS** — Konfigurisana CORS politika za dozvoljene domene
- **SQL Injection** — Eloquent ORM sa parametrizovanim upitima