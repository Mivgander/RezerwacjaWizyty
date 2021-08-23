# Rezerwacja Wizyty

Projekt prostego API utworzonego w Laravel. Pozwala na rezerwację wizyty u lekarza oraz administrowanie nimi.

# O bazie danych

API dmyślnie będzie korzystało z bazy 'rezerwacjaWizyty'. Zaleca się używania tabel napisanych w plikach migracji. Dodatkowo można wykorzystać pliki seeders do dodania przykładowych danych do tabel.

# Wszystkie zapytania

## Uwaga!
W każdym zapytaniu, w którym pojawia się '{id}', trzeba wpisać id terminu

## Zapytania dla administratora:

### - `api/admin/terminy/wszystkie`

Metoda wysłania: GET <br />
Zwraca wszystkie terminy

### - `api/admin/terminy/zarezerwowane`

Metoda wysłania: GET <br />
Zwraca wszystkie zarezerwowane terminy

### - `api/admin/terminy/{id}`

Metoda wysłania: GET <br />
Zwraca termin o podanym id

### - `api/admin/terminy/`

Metoda wysłania: POST <br />
Dodanie nowego, wolnego terminu <br />

Argumeny:

- data: wymagana, podana w formacie rrrr-mm-dd
- godzina: wymagana, podana w formacie gg:mm
- id_lekarza, wymagane, id lekarza istniejącjego w bazie

Przykładowe zapytanie: `api/admin/terminy?data=2021-08-30&godzina=14:30&id_lekarza=2`

### - `api/admin/terminy/{id}`

Metoda wysłania: PUT <br />
Aktualizacja istniejącego terminu <br />

Argumenty:

- data: opcjonalna, podana w formacie rrrr-mm-dd
- godzina: opcjonalna: podana w formacie gg:mm
- id_lekarza, opcjonalne, id lekarza istniejącjego w bazie
- status, opcjonalne, dostepne statusy: 'wolny', 'zarezerwowany', 'ukończony'. Jeżeli zamienisz status na wolny a termin będzie zarezerwowany, rezerwacja zostanie usunięta

Przykładowe zapytanie z wykorzystaniem wszystkich opcji: `api/admin/terminy/2?data=2021-09-02&godzina=11:00&id_lekarza=1&status=wolny`

### - `api/admin/terminy/{id}`

Metoda wysłania: DELETE <br />
Usunięcie istniejącego terminu. Jeżeli termin był zarezerwowany, rezerwacja zostanie usunięta <br />

Przykładowe zapytanie: `api/admin/terminy/7`

## Zapytania dla użytkownika:

### - `api/terminy/wszystkie`

Metoda wysłania: GET <br />
Zwraca wszystkie dostępne terminy

### - `api/terminy/wolne`

Metoda wysłania: GET <br />
Zwraca wszystkie wolne terminy

### - `api/terminy/{id}`

Metoda wysłania: POST <br />
Rezerwacja niezarezerwowanego wcześniej terminu <br />

- email: wymagany, potrzebny do odróżnienia użytkowników
- powod_rezerwacji: wymagany, tekst o maksymalnej długości 255 znaków

Przykładowe zapytanie: `api/terminy/10?email=example@gmail.com&powod_rezerwacji=wizyta+kontrolna`

### - `api/terminy/{id}`

Metoda wysłania: DELETE <br />
Odwołuje rezerwację z podanego terminu <br />

Przykładowe zapytanie: `api/terminy/6`
