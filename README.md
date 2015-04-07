# Müllkalender der Stadt Bonn
Die Müll-Abfuhr Termine von BonnOrange transparent machen und als .ics zur Verfügung stellen. Diese stehen unter [http://opendata.bonn.de/dataset/abfallplaner-m%C3%BCllabfuhrtermine](http://opendata.bonn.de/dataset/abfallplaner-m%C3%BCllabfuhrtermine) als CSV und XLS zur Verfügung.

## Erledigt
- CSV in MySQL-DB importiert
- Straßen per Auswahlliste selektierbar
- Darstellung der Ergebnisse in einer Tabelle


## Offen
- Umlaut-Problem bei Daten die aus der Datenbank kommen
- Auswahl der Straße per Typeahead
- ICS aus Ergebnis generieren und als Download anbieten ([Beispiel bei Stackoverflow](http://stackoverflow.com/questions/12739247/how-to-generate-ics-file-using-php-for-a-given-date-range-and-time).)
