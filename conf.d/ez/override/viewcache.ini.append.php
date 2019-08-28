<?php /* #?ini charset="utf-8"?

[ViewCacheSettings]
ClearRelationTypes[]
ClearRelationTypes[]=common
ClearRelationTypes[]=reverse_common
ClearRelationTypes[]=reverse_embedded
SmartCacheClear=enabled

[forum_reply]
DependentClassIdentifier[]=forum_topic
DependentClassIdentifier[]=forum
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating
ClearCacheMethod[]=siblings

[forum_topic]
DependentClassIdentifier[]=forum
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating
ClearCacheMethod[]=siblings

[folder]
DependentClassIdentifier[]=folder
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[gallery]
DependentClassIdentifier[]=folder
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating
ClearCacheMethod[]=children

[image]
DependentClassIdentifier[]=gallery
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating
ClearCacheMethod[]=siblings

[event]
DependentClassIdentifier[]
DependentClassIdentifier[]=event_calendar
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=homepage
DependentClassIdentifier[]=folder
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[article]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[article_mainpage]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[article_subpage]
DependentClassIdentifier[]=article_mainpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating
ClearCacheMethod[]=siblings

[blog_post]
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=blog
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[product]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[infobox]
DependentClassIdentifier[]=folder
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[documentation_page]
DependentClassIdentifier[]=documentation_page
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[banner]
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[geo_article]
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[avviso]
DependentClassIdentifier[]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=homepage
DependentClassIdentifier[]=area_tematica
ClearCacheMethod[]=object
ClearCacheMethod[]=parent
ClearCacheMethod[]=relating

[comunicato_stampa]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=homepage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[comunicato]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=homepage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[deliberazione]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[determinazione]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[statuto]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[albo_elenco]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[bando]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=homepage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[seduta_consiglio]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[ordinanza]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[decreto_sindacale]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[concorso]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=homepage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[concessioni]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

[news]
DependentClassIdentifier[]
DependentClassIdentifier[]=folder
DependentClassIdentifier[]=frontpage
DependentClassIdentifier[]=area_tematica
ClearCacheMethod[]=object
ClearCacheMethod[]=parent

*/ ?>