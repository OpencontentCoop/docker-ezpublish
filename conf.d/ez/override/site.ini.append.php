<?php /* #?ini charset="utf-8"?

[VarnishSettings]
VarnishHostName=varnish
VarnishPort=8080

[HTTPHeaderSettings]
CustomHeader=enabled

[ExpiryHandler]
ExpiryFilePerSiteAccess=enabled

[SearchSettings]
LogSearchStats=disabled

[DatabaseSettings]
DatabaseImplementation=ezpostgresql
Server=localhost
User=postgres
Password=verygoodpassword
Database=ezpublish
Charset=utf-8
Socket=disabled
SQLOutput=disabled



[RoleSettings]
PolicyOmitList[]=user/login
PolicyOmitList[]=user/logout
PolicyOmitList[]=user/do_logout
PolicyOmitList[]=user/register
PolicyOmitList[]=user/activate
PolicyOmitList[]=user/success
PolicyOmitList[]=user/forgotpassword
PolicyOmitList[]=layout
PolicyOmitList[]=paypal/notify_url
PolicyOmitList[]=switchlanguage
PolicyOmitList[]=oauth/authorize
PolicyOmitList[]=odf/upload_import
PolicyOmitList[]=odf/authenticate
PolicyOmitList[]=odf/upload_export
PolicyOmitList[]=odf/ezodf_oo_client
PolicyOmitList[]=ezjscore/hello
PolicyOmitList[]=ezjscore/call
PolicyOmitList[]=openpa/classdefinition
PolicyOmitList[]=openpa/calendar
PolicyOmitList[]=openpa/object
PolicyOmitList[]=openpa/data
PolicyOmitList[]=robots.txt
PolicyOmitList[]=survey_user/verify
PolicyOmitList[]=comuneintasca/data
PolicyOmitList[]=openpa/signup
PolicyOmitList[]=openpa/cookie
PolicyOmitList[]=openpa/activate
PolicyOmitList[]=robots.txt
PolicyOmitList[]=survey_user/verify
PolicyOmitList[]=comuneintasca/data
PolicyOmitList[]=feed/rss
PolicyOmitList[]=feed/list
PolicyOmitList[]=exportas/csv
PolicyOmitList[]=exportas/xml
PolicyOmitList[]=exportas/custom
PolicyOmitList[]=sensor/alert
PolicyOmitList[]=ezinfo/is_alive
PolicyOmitList[]=flip/get
PolicyOmitList[]=nxc_captcha/get
PolicyOmitList[]=newsletter/configure
PolicyOmitList[]=newsletter/archive
PolicyOmitList[]=userpaex/password
PolicyOmitList[]=userpaex/forgotpassword
PolicyOmitList[]=opendata/api

[Session]
SessionNameHandler=custom
#Set to true if https
CookieSecure=false
CookieHttponly=true
Handler=ezpSessionHandlerPHP
ForceStart=disabled

[SiteSettings]
GlobalSiteURL=ezpublish.localtest.me
GlobalSiteName=EzPublish
GlobalSiteRootNodeID=2

#SiteList


[UserSettings]
LogoutRedirect=/?logout

[SiteAccessSettings]
ForceVirtualHost=true
DebugAccess=enabled
DebugExtraAccess=enabled
CheckValidity=false
MatchOrder=host_uri
#AvailableSiteAccessList

#HostUriMatchMapItems

#TempHostUriMatchMapItems


[MailSettings]
AdminEmail=no-reply@opencontent.it
EmailSender=no-reply@opencontent.it
TransportAlias[smtp]=OpenPASMTPTransport
Transport=smtp
TransportConnectionType=
TransportPort=1025
#Vedi anche override/cjw_newsletter.ini.append.php
TransportServer=mailhog
TransportUser=
TransportPassword=

BlackListEmailDomains[]
BlackListEmailDomainSuffixes[]
BlackListEmailDomainSuffixes[]=ru

[EmbedViewModeSettings]
AvailableViewModes[]=embed
AvailableViewModes[]=embed-inline
InlineViewModes[]=embed-inline

[TimeZoneSettings]
TimeZone=Europe/Rome

[RegionalSettings]
Locale=ita-IT
TextTranslation=enabled
TranslationExtensions[]=cjw_newsletter

[ContentSettings]
ContentObjectNameLimit=203
TranslationList=

[DebugSettings]
DebugToolbar=disabled

[UserFormToken]
CookieHttponly=true
#Set to 1 if https
CookieSecure=1

###########################
######### DEBUG ###########
###########################
#
# [ContentSettings]
# ViewCaching=disabled
# 
# [DebugSettings]
# DebugOutput=enabled
# DebugRedirection=enabled
# AlwaysLog[]=warning
# AlwaysLog[]=debug
# AlwaysLog[]=notice
# AlwaysLog[]=strict
# 
# [TemplateSettings]
# DevelopmentMode=enabled
# Debug=disabled
# ShowXHTMLCode=enabled
# TemplateCache=disabled
# TemplateCompile=disabled
# ShowUsedTemplates=enabled
# 
# [OverrideSettings]
# Cache=disabled
# 
# [DesignSettings]
# DesignLocationCache=disabled
#
###########################
###########################
###########################


*/ ?>
