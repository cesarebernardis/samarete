
Dropzone.autoDiscover = false;

function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Byte';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};

        
$.extend( true, $.fn.dataTable.defaults, {"lanugage": {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Italian.json"}});