"use strict";

$(function()
{
    dataTable.init();
});

var dataTable = (function ($) {
    // private functions
    /*$(function () {
        console.log('load module');
        initialize();
    });*/

   function initialize()
   {
       $('#example').dataTable();
       $('#example')
           .removeClass( 'display' )
           .addClass('table table-striped table-bordered');
   }

    // public functions
    return {
        "init": function() {
            initialize();
        }
    };
})(jQuery);
