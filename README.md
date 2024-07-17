Aplikace zpracovává oskary podle přiložených souborů.


# Instalace
Aplikace běží v dockeru a spuštění je jednoduché.
1. Naklonujeme si projekt
2. `cd OscarsList`
3. `make init`
4. `docker exec -it oscars-app composer install`
5. Přejdeme na adresu http://localhost:8888/
