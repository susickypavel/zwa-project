# ZWA Semestrální práce
Vypracoval Pavel Sušický.

## 1. Tech stack
- PHP 7
- Symfony 5
- PostgreSQL 13

## 2. Lokální instalace

### 2.1 Předpoklady

- Composer (php package manager)
- Yarn (node package manager)
- PHP 7+
- Node.js
- Symfony development kit

### 2.1 Instalace

- Nainstalování PHP dependecies pomocí composeru
- Nainstalování Node dependencies pomocí yarnu
- Nastavení environment variables (.env) pro PostgreSQL/MySQL dabázi

## 3. Diagramy

![](./docs/database.svg)
![](./docs/architektura.svg)

## 4. Popis Zabezpečení

- Uživatelská hesla jsou zahashovaná a osolená
- Všechny formuláře používají unikátní tokeny, pro zamezení CSRF útoku.
- Všechny uživatelské vstupy zobrazeny na výstupu jsou převedeny do HTML entities (řešeno automaticky ze strany Twig šablon) zabraňující XSS útokům.

## 5. Zpracování uploadování

- Pro parsování XML souborů hry používám DomCrawler knihovnu z composeru
- K DomCrawleru ještě používám knihovnu css-selector pro použití css-like selektorů místo XPath

## 6. Popis použití Symfony frameworku
- Projekt je založen na kostře typické Symfony aplikace používající MVC architekturu.

viz diagram architektury v **4. Diagramy**
