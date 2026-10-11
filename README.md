# MusicList

Marek Beňo

5ZYI34

## Stručný opis projektu
MusicList je webová aplikácia pre hudobníkov, ktorí chcú prehľadne spravovať svoje notové zápisy a zoznamy piesní a zároveň objavovať noty, ktoré zdieľajú iní používatelia. Aplikácia rieši bežný problém pri hraní v kapele: rýchlo vybrať pieseň určitého typu (napr. valčík), ktorá sa ešte nehrala. Používateľ si piesne eviduje s tóninou a žánrom, priraďuje k nim notové zápisy vo forme obrázkov a zoraďuje ich do vlastných zoznamov.

Súčasťou aplikácie je aj komunitná časť. Používatelia môžu svoje piesne a zoznamy zverejniť, ostatní si ich môžu prezerať, sťahovať noty a komentovať ich. Aplikácia je určená hudobníkom, kapelám a hudobným skupinám.

## Role v projekte
Návštevník - môže prezerať verejné piesne a verejné zoznamy, filtrovať a vyhľadávať v nich a sťahovať verejne dostupné noty. Nemôže vytvárať obsah ani komentovať. Môže sa zaregistrovať alebo prihlásiť.

Registrovaný používateľ - má všetky oprávnenia návštevníka. Navyše môže pridávať, upravovať a mazať vlastné piesne a zoznamy, nahrávať k nim noty, nastavovať ich viditeľnosť (verejné/súkromné) a komentovať verejné piesne. Upravovať a mazať môže len vlastný obsah a vlastné komentáre.

Admin - má prístup ku všetkým funkciám používateľa. Navyše spravuje používateľské účty a môže odstraňovať nevhodný obsah (piesne, komentáre, súbory) ľubovoľného používateľa.

## Prípady použitia podľa rolí
Návštevník:
zobrazí zoznam verejných piesní
vyhľadá pieseň podľa názvu a vyfiltruje piesne podľa tóniny a žánru
otvorí detail piesne
stiahne verejne dostupné noty
zaregistruje sa a prihlási

Registrovaný používateľ:
vytvorí novú pieseň (názov, tónina, žáner, viditeľnosť) a nahrá k nej noty
upraví alebo vymaže vlastnú pieseň a spravuje jej súbory s notami
vytvorí, upraví a vymaže zoznam piesní a nastaví ho ako verejný alebo súkromný
pridá pieseň do svojho zoznamu a odoberie ju z neho
pridá komentár k verejnej piesni a vymaže svoj komentár
zobrazí si zoznam svojich piesní a zoznamov

Administrátor:
zobrazí zoznam používateľov
odstráni nevhodnú pieseň, súbor alebo komentár
pridáva, upravuje a maže žánre
blokovanie a odstraňovanie používateľov

## Plánované entity

Pouzivatel - registrovaný používateľ systému. Atribúty: id_pouzivatela, meno, email, heslo, rola, zablokovany, datum_registracie.
Zaner - slúži na kategorizáciu a filtrovanie hodnôt v tabuľke piesní. Atribúty: id_zanru, nazov.
Piesen - jednotlivá pieseň. Atribúty: id_piesne, nazov, tonina, verejna, vyradena, datum_vytvorenia, id_zanru (FK), id_pouzivatela (FK).
Zoznam - zoznam piesní používateľa. Atribúty: id_zoznamu, nazov, verejny, id_pouzivatela (FK).
Zoznam_piesen - asociačná tabuľka, rozklad vzťahu M:N medzi zoznamami a piesňami. Atribúty: id_zoznamu (FK), id_piesne (FK), datum_pridania.
Komentar - komentár používateľa. Atribúty: id_komentara, text, datum_vytvorenia, id_pouzivatela (FK), id_piesne (FK).
Subor - nahrané noty k piesni. Atribúty: id_suboru, typ, nazov, id_piesne (FK).

## Vzťahy medzi entitami
Pouzivatel - Piesen: 1:N - používateľ môže pridať viac piesní, každá pieseň má jedného autora.
Pouzivatel - Zoznam: 1:N - používateľ môže vytvoriť viac zoznamov, každý zoznam patrí jednému používateľovi.
Pouzivatel - Komentar: 1:N - používateľ môže napísať viac komentárov, každý komentár má jedného autora.
Zaner - Piesen: 1:N - jeden žáner môže mať viac piesní, pieseň má práve jeden žáner.
Piesen - Komentar: 1:N - pieseň môže mať viac komentárov, každý komentár patrí jednej piesni.
Piesen - Subor: 1:N - pieseň môže mať viac pripojených notových súborov.
Piesen - Zoznam: M:N - pieseň môže byť vo viacerých zoznamoch a zoznam môže obsahovať viac piesní. Vzťah je realizovaný asociačnou tabuľkou Zoznam_piesen.


## Hlavné stránky aplikácie
Domovská stránka - popis aplikácie, vyhľadávanie, filtre, karty piesní.
Detail piesne - zobrazenie nôt, údaje o piesni (autor, tónina, žáner), tlačidlá na stiahnutie nôt a pridanie do zoznamu, komentáre.
Formulár piesne (pridať/upraviť) – formulár s validáciou na klientovi aj serveri a nahrávaním/správou súborov s notami.
Moje piesne a zoznamy - prehľad vlastných piesní a zoznamov s možnosťou úpravy a mazania, náhodného výberu piesne zo zoznamu.
Detail zoznamu piesní - piesne v zozname, odoberanie piesní, nastavenie verejný/súkromný.
Prihlásenie a registrácia - formuláre pre autentifikáciu a vytvorenie účtu.
Admin panel - správa používateľov (blokovanie, odstránenie), moderovanie obsahu (prístupné len pre admina).

## Rozdelenie funkcionality
Základné funkcie:

registrácia, prihlásenie a odhlásenie. heslá ukladané ako hash
tri role (návštevník, používateľ, admin) a autorizácia prístupu k stránkam a akciám
CRUD nad piesňami a zoznamami piesní
nahrávanie notových súborov (PNG/JPG) s kontrolou typu a veľkosti, ich zobrazenie, sťahovanie a mazanie
zoznamy piesní s nastavením verejný/súkromný a pridávaním/odoberaním piesní (vzťah M:N)
komentovanie verejných piesní (pridanie, mazanie vlastných komentárov) cez AJAX
vyhľadávanie a filtrovanie piesní podľa názvu, tóniny a žánru cez AJAX
admin: blokovanie/odstraňovanie používateľov a odstraňovanie nevhodného obsahu
validácia všetkých vstupov (typ aj platná hodnota) na strane klienta aj servera
ochrana proti SQL injection, ochrana prístupu k súborom a chránených akcií
responzívny dizajn (mobil aj desktop)
spustenie v prostredí Docker s automatickým importom ukážkových dát
náhodný výber piesne podľa zvolených kritérií (žáner, tónina) a jej dočasné vyradenie zo zoznamu

Rozširujúce funkcie:

hodnotenie piesní hviezdičkami (nová entita Hodnotenie) s priemerným hodnotením
obľúbené piesne (označenie na karte piesne)
zdieľanie piesne alebo zoznamu odkazom
zobrazenie nôt v prekrývacom okne priamo z domovskej stránky
podpora PDF súborov s notami
zmena poradia piesní v zozname
profil používateľa so zmenou hesla, obnova zabudnutého hesla
export zoznamu piesní do PDF alebo CSV
tmavý režim
