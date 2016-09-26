SOLR Konfiguration
==================

Solr wird über die solrconfig.xml konfiguriert. In mksearch sind Beispiel Konfiguationen für die Versionen [3.x, 4.x](solr) und [6.x](Configuration/Solr) enthalten.

luceneMatchVersion
------------------

In der solrconfig.xml sollte unbedingt die verwendete Lucene Version der Solr Version eingetragen werden. Nur auf diese Weise lässt sich sicher stellen, dass alle Features der aktuellen Version verwendet werden. Der Parameter lautet luceneMatchVersion. Für die Solr Version 4.6 z.B.LUCENE\_46. Oder man verwendet LUCENE\_CURRENT. Allerdings besteht dann die Gefahr dass bei einem Update ungewollte Seiteneffekte auftreten.
