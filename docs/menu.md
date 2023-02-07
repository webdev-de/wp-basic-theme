# MWD Menu Klasse
Dies ist eine Beispielklasse für ein Wordpress-Menü. Mit dieser Klasse kann ein Menü innerhalb von Wordpress erstellt werden.

## Funktionen

### __construct
Der Konstruktor der Klasse nimmt drei Argumente entgegen:

- ```$menu_name```: Der Name des zu verwendenden Menüs
- ```$start_at_id```: Die ID des Elements, bei dem das Menü starten soll (standardmäßig 0) 
- ```$depth```: Die Tiefe des Menüs (standardmäßig 0)

### getItems 
Diese Methode liest das Wordpress-Menü aus und speichert die Menü-Items in einem Array. Außerdem werden Informationen wie die aktuelle Seite und die ID des aktuellen Menü-Elements gespeichert.

### render
Diese Methode nimmt ein Array von Menü-Items entgegen und generiert daraus eine HTML-Ausgabe des Menüs. Die HTML-Ausgabe besteht aus einer ungeordneten Liste (ul) mit Listenpunkten (li) für jedes Menü-Item. Jeder Listenpunkt enthält einen Link (a) zur Zielseite des Menü-Elements.

## Verwendung
1. Kopieren Sie die Klasse in Ihr Wordpress-Projekt
2. Instanziieren Sie eine neue Menu-Klasse und übergeben Sie den Namen des zu verwendenden Menüs.
3. Rufen Sie die Methode getItems auf, um die Menü-Items auszulesen.
4. Rufen Sie die Methode render auf und übergeben Sie das Array von Menü-Items, um die HTML-Ausgabe zu erhalten.
5. Fügen Sie die HTML-Ausgabe in Ihr Wordpress-Template ein.


