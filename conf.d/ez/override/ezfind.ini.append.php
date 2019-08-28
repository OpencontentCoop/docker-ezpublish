<?php /* #?ini charset="utf-8"?

[IndexOptions]
OptimizeOnCommit=disabled

[SolrFieldMapSettings]
CustomMap[ezobjectrelation]=ocSolrDocumentFieldObjectRelation
CustomMap[ezobjectrelationlist]=ocSolrDocumentFieldObjectRelation
CustomMap[ezdate]=ocSolrDocumentFieldDate
CustomMap[ezdatetime]=ocSolrDocumentFieldDate
CustomMap[ezinteger]=ocSolrDocumentFieldInteger

DatatypeMap[ezobjectrelationlist]=string
DatatypeMap[ezinteger]=sint

DatatypeMapSort[ezstring]=string
DatatypeMapSort[ezinteger]=sint

DatatypeMapFilter[ezstring]=string
DatatypeMapFilter[ezinteger]=sint

DatatypeMapFacet[ezinteger]=sint


[IndexBoost]
Class[organo_politico]=3.0
Class[servizio]=2.6
Class[ufficio]=2.6
Class[user]=2.5
Class[politico]=2.5
Class[scheda_informativa]=2.4
Class[circolare]=2.4
Class[modulo]=1.7
Class[avviso]=1.6
Class[iniziativa]=1.6
Class[bando]=1.5
Class[concorso]=1.5
Class[decreto_sindacale]=1.5
Class[determinazione]=1.3
Class[deliberazione]=1.2
Class[ordinanza]=0.8
Class[mozione]=0.5
Class[interrogazione]=0.3
Class[interpellanza]=0.2
Class[associazione]=0.2
Class[ristorante]=0.1
Class[file_pdf]=0.1
Class[articolo]=0.2
Class[telefono]=0.1
Class[tipo_risposta]=0.01
Class[tipo_ristorante]=0.01
Class[tipo_servizio_ristoranti]=0.01
Class[tipo_servizio_sul_territorio]=0.01
Class[legislatura]=0.01

Attribute[title]=2.0
Attribute[titolo]=2.0
Attribute[abstract]=1.5
Attribute[oggetto]=1.5
Attribute[cognome]=1.5
Attribute[descrizione]=0.1

[IndexExclude]
ClassIdentifierList[]=file
ClassIdentifierList[]=file_pdf
ClassIdentifierList[]=global_layout
ClassIdentifierList[]=gallery
ClassIdentifierList[]=maggioranza_minoranza
ClassIdentifierList[]=testata

[HighLighting]
Enabled=false

*/ ?>
