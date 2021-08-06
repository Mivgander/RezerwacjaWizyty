# Rezerwacja Wizyty

Projekt prostego API utworzonego w Laravel. Pozwala na rezerwację wizyty u lekarza oraz administrowanie nimi.
Całość jest podzielona na wersję surową oraz graficzną. Wersja surowa zwraca tylko wyniki w json, natomiast wersja graficzna pobiera wszystkie wyniki i wyświetla je na stronie internetowej.

W poniższych przykładach będą pokazywane zapytania z użyciem wersji surowej. Jeśli chcesz korzystać z wersji graficznej, wystarczy że z linku usuniesz '/raw'.

# O bazie danych

API dmyślnie będzie korzystało z bazy 'rezerwacjaWizyty'. Zaleca się używania tabel napisanych w plikach migracji. Dodatkowo można wykorzystać pliki seeders do dodania przykładowych danych do tabel.

# Wszystkie zapytania

## Zapytania dla administratora:

### - `api/raw/admin/terminy`
Zwraca wszystkie terminy

### - `api/raw/admin/terminy/zarezerwowane`
Zwraca wszystkie zarezerwowane terminy

### - `api/raw/admin/terminy/{id}`
Zwraca termin o podanym id

### - `raw/admin/terminy/dodaj`

Metoda wysłania: POST <br />
Argumeny:

- data: wymagana, podana w formacie rrrr-mm-dd
- godzina: wymagana, podana w formacie gg:mm
- id_lekarza, wymagane, id lekarza istniejącjego w bazie

Przykładowe zapytanie: `api/raw/admin/terminy/dodaj?data=2021-08-20&godzina=14:30&id_lekarza=2`

#### Odpowiedź
Jeżeli zapytanie zakończy się pomyślnie zostanie wysłana zmienna 'wiadomosc' z potwierdzeniem <br />
Jeżeli walidacja zmiennych zakończy się błędem, zostanie wysłana zmienna 'error' z opisem błędu

### - `api/raw/admin/terminy/aktualizuj`

Metoda wysłania: PATCH <br />
Argumenty:

- id_terminu: wymagane, id istniejącego terminu
- data: opcjonalna, podana w formacie rrrr-mm-dd
- godzina: opcjonalna: podana w formacie gg:mm
- id_lekarza, opcjonalne, id lekarza istniejącjego w bazie
- status, opcjonalne, dostepne statusy: 'wolny', 'zarezerwowany', 'ukończony'. Jeżeli zamienisz status na wolny a termin będzie zarezerwowany, usuniesz rezerwacje

Przykładowe zapytanie z wykorzystaniem wszystkich opcji: `api/raw/admin/terminy/aktualizuj?id_terminu=7&data=2021-08-11&godzina=11:00&id_lekarza=1&status=wolny`

#### Odpowiedź
Jeżeli zapytanie zakończy się pomyślnie zostanie wysłana zmienna 'wiadomosc' z potwierdzeniem <br />
Jeżeli walidacja zmiennych zakończy się błędem, zostanie wysłana zmienna 'error' z opisem błędu

### - `api/raw/admin/terminy/dodaj`

Metoda wysłania: DELETE <br />
Argumenty:

- id_terminu: wymagane, id istniejącego terminu. Jeżeli termin jest zarezerwowany, rezerwacja również zostanie usunięta


Przykładowe zapytanie: `api/raw/admin/terminy/usun?id_terminu=11`

#### Odpowiedź
Jeżeli zapytanie zakończy się pomyślnie zostanie wysłana zmienna 'wiadomosc' z potwierdzeniem <br />
Jeżeli walidacja zmiennych zakończy się błędem, zostanie wysłana zmienna 'error' z opisem błędu

## Zapytania dla użytkownika:

### - `api/raw/terminy`
Zwraca wszystkie dostępne terminy. W wersji surowej robi to samo co `api/raw/admin/terminy`. Zostało to rozdzielone ze względu na wersję graficzną, gdzie są różnice między nimi.

### - `api/raw/terminy/wolne`
Zwraca wszystkie wolne terminy

### - `api/raw/terminy/rezerwuj`

Metoda wysłania: POST <br />
Argumenty:

- id_terminu: wymagane, id istniejącego, niezarezerwowanego terminu
- email: wymagany, potrzebny do odróżnienia użytkowników
- powod_rezerwacji: wymagany, tekst o maksymalnej długości 255 znaków

Przykładowe zapytanie: `api/raw/terminy/rezerwuj?id_terminu=9&email=example@gmail.com&powod_rezerwacji=wizyta+kontrolna`

#### Odpowiedź
Jeżeli zapytanie zakończy się pomyślnie zostanie wysłana zmienna 'wiadomosc' z potwierdzeniem <br />
Jeżeli walidacja zmiennych zakończy się błędem, zostanie wysłana zmienna 'error' z opisem błędu

### - `api/raw/terminy/odwolaj-rezerwacje`

Metoda wysłania: DELETE <br />
Argumenty:

- id_terminu: wymagane, id istniejącego, zarezerwowanego terminu
- email: wymagany, musi to być ten sam na który została złożona rezerwacja

Przykładowe zapytanie: `api/raw/terminy/odwolaj-rezerwacje?id_terminu=9&email=example@gmail.com`

#### Odpowiedź
Jeżeli zapytanie zakończy się pomyślnie zostanie wysłana zmienna 'wiadomosc' z potwierdzeniem <br />
Jeżeli walidacja zmiennych zakończy się błędem, zostanie wysłana zmienna 'error' z opisem błędu
