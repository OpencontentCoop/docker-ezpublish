<?php /* #?ini charset="utf-8"?

[ImageMagick]
IsEnabled=true
ExecutablePath=/usr/bin
Executable=convert
Filters[]=strippaexif=-strip
Filters[]=customquality=-quality %1

Filters[]=thumb=-resize 'x%1' -resize '%1x<' -resize 50%
Filters[]=centerimg=-gravity center -crop %1x%2+0+0 +repage
Filters[]=strip=-strip
Filters[]=sharpen=-sharpen 0.5
Filters[]=geometry/scalemin=-geometry %1x%2^
Filters[]=forcecenter=-background %1 -gravity center -extent %2x%3

#centra l'immagine e la ritaglia
Filters[]=roundcenterimg=-gravity center -crop %1x%2+0+0 +repage
#applica la maschera
Filters[]=roundmask=extension/openpa_theme_2014/design/standard/images/round-mask.png -composite
#scontorna il bianco
Filters[]=roundtrans=-transparent White

[MIMETypeSettings]
# Set JPEG quality from 0 (worst quality, smallest file) to 100 (best quality, biggest file)
Quality[]=image/jpeg;70

[AliasSettings]
AliasList[]
AliasList[]=reference
AliasList[]=small
AliasList[]=medium
AliasList[]=listitem
AliasList[]=articleimage
AliasList[]=articlethumbnail
AliasList[]=galleryline
AliasList[]=large
AliasList[]=rss
AliasList[]=logo
AliasList[]=icon
AliasList[]=infoboximage
AliasList[]=billboard
AliasList[]=singolo
AliasList[]=singolo_interne
AliasList[]=singolo_banner
AliasList[]=lista_accordion
AliasList[]=lista_num
AliasList[]=lista_tab
AliasList[]=header_area_tematica
AliasList[]=mainstory1
AliasList[]=mainstory2
AliasList[]=mainstory3
AliasList[]=block2items1
AliasList[]=block2items2
AliasList[]=block3items3
AliasList[]=blockgallery1
AliasList[]=imagelarge
AliasList[]=imagelargeoverlay
AliasList[]=gallerythumbnail
AliasList[]=homecarousel
AliasList[]=bannerfolder_big
AliasList[]=bannerfolder_medium
AliasList[]=bannerfolder_small
AliasList[]=styleeditor
AliasList[]=ezflowmediafull
AliasList[]=ezflowmediablock
AliasList[]=newsletter_header
AliasList[]=newsletter_content
AliasList[]=header_banner
AliasList[]=header_logo
AliasList[]=header_only_logo
AliasList[]=marker

#openpa_theme_2014
AliasList[]=carousel
AliasList[]=squaremini
AliasList[]=squarethumb
AliasList[]=squaremedium
AliasList[]=extentsquaremedium
AliasList[]=imagefull
AliasList[]=imagefullwide
AliasList[]=imagefull_cutwide
AliasList[]=widethumb
AliasList[]=widemini
AliasList[]=widemedium
AliasList[]=round_thumb

#openpa_designitalia
AliasList[]=agid_carousel
AliasList[]=agid_panel
AliasList[]=agid_topbanner
AliasList[]=agid_wide_carousel
AliasList[]=agid_square

#altre estensioni
AliasList[]=opengraph

[opengraph]
Reference=reference
Filters[]
Filters[]=geometry/scale=400;400

[original]
Filters[]


[reference]
Filters[]
Filters[]=geometry/scaledownonly=1170;1170
Filters[]=strippaexif
Filters[]=customquality=75

[round_thumb]
#questo è importante serve a restituire una gif (trasparente) partendo da altri formati
MIMEType=image/gif
Reference=reference
Filters[]
Filters[]=geometry/scaleheight=300
Filters[]=roundcenterimg=300;300
Filters[]=roundmask=
Filters[]=roundtrans=

[header_banner]
Reference=reference
Filters[]=geometry/scalewidthdownonly=1000
Filters[]=centerimg=1000;200

[header_logo]
Reference=reference
Filters[]=geometry/scalewidthdownonly=1000

[header_only_logo]
Reference=reference
Filters[]=geometry/scale=260;60

[newsletter_header]
Reference=reference
Filters[]
Filters[]=geometry/scale=150;80

[newsletter_content]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=130;130

[ezflowmediafull]
Reference=reference
Filters[]
Filters[]=geometry/scaleheight=350

[ezflowmediablock]
Reference=reference
Filters[]
Filters[]=geometry/scaleheight=200

[small]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=100;160

[medium]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=200;290

[large]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=360;440

[rss]
Reference=reference
Filters[]
Filters[]=geometry/scale=88;31

[logo]
Reference=reference
Filters[]
Filters[]=geometry/scaleheight=36

[listitem]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=130;190

[articleimage]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=170;350

[articlethumbnail]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=70;150

[galleryline]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=70;150

#[imagelarge]
#Reference=reference
#Filters[]
#Filters[]=geometry/scaledownonly=550;730

[infoboximage]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=75

[billboard]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=764

[styleeditor]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=100;75

[homecarousel]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=210;60

[gallerythumbnail]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=230;180

[lista_tab]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=150;160

[header_area_tematica]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=1000;200
Filters[]=geometry/crop=1000;200;0;0

[singolo_banner]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=150;90
#Filters[]=geometry/scalewidth=150
#Filters[]=geometry/crop=150;60;0;0

[singolo]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=656;400

[singolo_interne]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=476
Filters[]=geometry/crop=476;230;0;0

[lista_accordion]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=100;100
#Filters[]=geometry/scaleheight=100
#Filters[]=geometry/scalewidth=120
#Filters[]=geometry/crop=110;100;0;0

[lista_num]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=150;150
#Filters[]=geometry/scaleheight=120
#Filters[]=geometry/scalewidth=150
#Filters[]=geometry/scalewidth=150
#Filters[]=geometry/crop=150;150;0;0


[mainstory1]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=468
Filters[]=geometry/crop=468;396;0;0

[mainstory2]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=439
Filters[]=geometry/crop=439;233;0;0

[mainstory3]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=201
Filters[]=geometry/crop=201;239;0;0

[block2items1]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=195
Filters[]=geometry/crop=195;98;0;0

[block2items2]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=195
Filters[]=geometry/crop=195;98;0;0

[block3items3]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=195
Filters[]=geometry/crop=195;98;0;0

[blockgallery1]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=126
Filters[]=geometry/crop=126;84;0;0

[imagelarge]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=448;622

[imagelargeoverlay]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=800;600

[bannerfolder_big]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=230;400

[bannerfolder_small]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=170;400

[bannerfolder_medium]
Reference=reference
Filters[]
Filters[]=geometry/scaledownonly=170;300

[carousel]
Reference=reference
Filters[]
Filters[]=geometry/scalewidth=1200
Filters[]=centerimg=1200;800

[squaremini]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=100
Filters[]=centerimg=50;50

[squarethumb]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=300
Filters[]=centerimg=150;150

[squaremedium]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=250
Filters[]=centerimg=250;250

[extentsquaremedium]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=200
Filters[]=forcecenter=white;250;250

[imagefull]
Reference=reference
Filters[]=geometry/scalewidthdownonly=850

[imagefullwide]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=1170

[imagefull_cutwide]
Reference=reference
Filters[]=geometry/scalewidthdownonly=850
Filters[]=centerimg=850;380

[widemini]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=150
Filters[]=centerimg=100;50

[widemedium]
Reference=reference
Filters[]
Filters[]=geometry/scaleheight=250
Filters[]=geometry/forcecenter=#ffffff;400;250

[widethumb]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=300
Filters[]=geometry/forcecenter=#ffffff;300;180

[agid_carousel]
Reference=reference
Filters[]
Filters[]=strip
Filters[]=geometry/scalewidth=600
Filters[]=forcecenter=#ffffff;600;400

[agid_wide_carousel]
Reference=reference
Filters[]
Filters[]=strip
Filters[]=geometry/scalewidth=1200
Filters[]=forcecenter=#ffffff;1200;500

[agid_panel]
Reference=reference
Filters[]
Filters[]=strip
Filters[]=geometry/scalewidth=600
Filters[]=centerimg=600;300

[agid_topbanner]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=768
Filters[]=centerimg=768;308

[agid_topbanner_sm]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=992
Filters[]=centerimg=992;398

[agid_topbanner_md]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=1440
Filters[]=centerimg=1440;576

[agid_topbanner_lg]
Reference=reference
Filters[]
Filters[]=geometry/scalewidthdownonly=1920
Filters[]=centerimg=1920;768

[agid_square]
Reference=reference
Filters[]
Filters[]=geometry/scaleheight=120
Filters[]=centerimg=120;120

[marker]
Reference=
Filters[]
Filters[]=geometry/scale=30;30
*/ ?>
