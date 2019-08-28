<?php /*

[CreateSettings]
MimeClassMap[video/x-flv]=flash_player
MimeClassMap[application/pdf]=file_pdf
MimeClassMap[application/x-pdf]=file_pdf

#azzerato per evitare i problemi di upload di file doc o simili di ezodf
MimeUploadHandlerMap[]
MimeUploadHandlerMap[application/zip]=ezzipuploadhandler

[file_pdf_ClassSettings]
FileAttribute=file
NameAttribute=name
NamePattern=<original_filename_base>

[flash_player_ClassSettings]
FileAttribute=file
NameAttribute=name
NamePattern=<original_filename_base>


*/ ?>
