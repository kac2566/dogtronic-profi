# Dogtronic Profi

> Lokalny WordPress z Dockerem – gotowe środowisko deweloperskie z bazą danych

---

## 📋 Spis treści

- [Opis projektu](#-opis-projektu)
- [Demo online](#-demo-online)
- [Wymagania](#-wymagania)
- [Szybki start](#-szybki-start)
- [Konfiguracja](#-konfiguracja)
- [Dostęp do usług](#-dostęp-do-usług)
- [Instalacja bez Dockera](#-instalacja-bez-dockera)

---

## 🎯 Opis projektu

**Dogtronic Profi** to w pełni skonfigurowane środowisko deweloperskie WordPress oparte na Dockerze. Projekt zawiera:

✅ WordPress z gotową bazą danych  
✅ MySQL z predefiniowanymi danymi  
✅ phpMyAdmin do zarządzania bazą  
✅ Vite dla szybkiego developmentu  
✅ Automatyczna konfiguracja portów  

---

## 🌐 Demo online

Nie chcesz instalować lokalnie? Sprawdź działającą wersję:

🔗 **[srv100394.seohost.com.pl](https://srv100394.seohost.com.pl/)**

### Panel administratora WordPress

- URL: [srv100394.seohost.com.pl/wp-admin](https://srv100394.seohost.com.pl/wp-admin)
- Login: `testowy`
- Hasło: `testowy`

> ⚠️ **Uwaga:** Dane dostępowe są publiczne i przeznaczone wyłącznie do testów.

---

## 🔧 Wymagania

Przed rozpoczęciem upewnij się, że masz zainstalowane:

| Narzędzie | Wersja | Link |
|-----------|--------|------|
| Docker | 20.10+ | [Pobierz](https://www.docker.com/get-started) |
| Docker Compose | 2.0+ | [Pobierz](https://docs.docker.com/compose/install/) |
| Git | Dowolna | [Pobierz](https://git-scm.com/) |

### Sprawdzenie wersji

```bash
docker --version
docker-compose --version
git --version
```

---

## 🚀 Szybki start

### 1. Klonowanie repozytorium

```bash
git clone https://github.com/kac2566/dogtronic-profi.git
cd dogtronic-profi
```

Lub pobierz jako ZIP: **Code → Download ZIP**

### 2. Uruchomienie kontenerów

```bash
docker-compose up -d
```

> 💡 Flaga `-d` uruchamia kontenery w tle

### 3. Weryfikacja statusu

```bash
docker-compose ps
```

Powinny być widoczne trzy kontenery w statusie `Up`:

```
NAME              STATUS
dogtronic_db      Up
dogtronic_wp      Up  
dogtronic_pma     Up
```

### 4. Gotowe! 🎉

Twój WordPress jest dostępny pod adresem: **[localhost:8174](http://localhost:8174)**

---

## ⚙️ Konfiguracja

Wszystkie ustawienia znajdują się w pliku `.env`:

```env
# Nazwa projektu
PROJECT_NAME=dogtronic

# Konfiguracja bazy danych
DB_NAME=wp_dogtronic
DB_USER=wp
DB_PASSWORD=wp
DB_ROOT_PASSWORD=root

# Porty
WP_PORT=8174          # WordPress
PMA_PORT=8924         # phpMyAdmin
VITE_PORT=5050        # Vite dev server

# WordPress Debug
WP_DEBUG=true
WP_DEBUG_LOG=true
WP_DEBUG_DISPLAY=true
SCRIPT_DEBUG=true
```

### Zmiana portów

Jeśli porty są zajęte, możesz je zmienić w pliku `.env`:

```env
WP_PORT=8080
PMA_PORT=8081
```

Następnie przeładuj kontenery:

```bash
docker-compose down
docker-compose up -d
```

---

## 🔗 Dostęp do usług

| Usługa | URL | Opis |
|--------|-----|------|
| **WordPress** | [localhost:8174](http://localhost:8174) | Strona główna |
| **Panel WP** | [localhost:8174/wp-admin](http://localhost:8174/wp-admin) | Panel administratora |
| **phpMyAdmin** | [localhost:8924](http://localhost:8924) | Zarządzanie bazą danych |

### Dane logowania do phpMyAdmin

```
Server: db
Username: root
Password: root
```

---

## 💻 Instalacja bez Dockera

Jeśli preferujesz XAMPP, WAMP lub MAMP:

### 1. Przygotowanie środowiska

Upewnij się, że masz uruchomione:
- Apache
- MySQL/MariaDB
- PHP 7.4+

### 2. Skopiuj pliki

Pobierz WordPressa z wordpress.org/download
Skopiuj zawartość repozytorium do folderu z wordpressem np.:
- **XAMPP:** `C:\xampp\htdocs\dogtronic-profi`
- **WAMP:** `C:\wamp64\www\dogtronic-profi`
- **MAMP:** `/Applications/MAMP/htdocs/dogtronic-profi`

Zastąp folder wp-content w instalacji WordPressa folderem wp-content z repozytorium
To nadpisze domyślne motywy i wtyczki zawartością projektu

### 3. Import bazy danych

1. Otwórz [localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Utwórz nową bazę: `wp_dogtronic`
3. Kliknij **Import**
4. Wybierz plik: `./db/wp_dogtronic.sql`
5. Kliknij **Wykonaj**

### 4. Konfiguracja WordPress

Edytuj `wp-config.php`:

```php
define('DB_NAME', 'wp_dogtronic');
define('DB_USER', 'root');           // lub twój użytkownik MySQL
define('DB_PASSWORD', '');           // lub twoje hasło MySQL
define('DB_HOST', 'localhost');
```

### 5. Uruchom stronę

Otwórz w przeglądarce:
- **Strona:** [localhost/dogtronic-profi](http://localhost/dogtronic-profi)
- **Panel:** [localhost/dogtronic-profi/wp-admin](http://localhost/dogtronic-profi/wp-admin)


---

## 📁 Struktura projektu

```
dogtronic-profi/
│
├── db/
│   └── wp_dogtronic/        # Katalog z danymi MySQL
│       └── *.frm, *.ibd     # Pliki bazy danych
├── wp-content/
│      ├── themes/         # Motywy
│      ├── plugins/        # Wtyczki
│      └── uploads/        # Media
│   
│
├── docker-compose.yml      # Konfiguracja Docker Compose
├── .env                    # Zmienne środowiskowe
├── .gitignore             # Ignorowane pliki
└── README.md              # Dokumentacja
```

