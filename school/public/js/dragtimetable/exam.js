/*jslint white: true, browser: true, undef: true, nomen: true, eqeqeq: true, plusplus: false, bitwise: true, regexp: true, strict: true, newcap: true, immed: true, maxerr: 14 */
/*global window: false, REDIPS: true */

/* enable strict mode */
"use strict";


// create redips container
var redips = {};


// redips initialization
redips.init = function () {
    // reference to the REDIPS.drag object
    var rd = REDIPS.drag;
    // REDIPS.drag initialization
    rd.init();
    rd.dropMode = 'single';			// dragged elements can be placed to the empty cells only
    rd.hover.colorTd = '#9BB3DA';	// set hover color
    // save - after element is dropped
    rd.event.dropped = function () {
        // get element position (method returns array with current and source positions - tableIndex, rowIndex and cellIndex)
        var pos = rd.getPosition();
        var data = $('#timetablesubmit').serialize();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        var term = $('#term').val();
        var year = $('#year').val();
        var classno = $('#classno').val();
        var pso = rd.obj.id + '_' + pos.join('_');
        // save DIV element (AJAX handler is not needed)
//		rd.ajaxCall('TimetableRegister?p=' + rd.obj.id + '_' + pos.join('_')+'&=term' + term +'&year=' + year + '&gradenumber=' + gradenumber + '&gradesection=' + gradesection);

        $.ajax({
            url: 'ExamTimetableRegister',
            method: 'POST',
            data: {p: pso, term: term, year: year, classno: classno, toDate: toDate, fromDate: fromDate},
            success: function (jsonData)
            {
                alert(jsonData);
                return true;
            }
        });
    };
    // delete - after element is deleted
    rd.event.deleted = function () {
        // get element position
        var pos = rd.getPosition(),
                row = pos[4],
                col = pos[5];
        // delete element (AJAX handler is not needed) rd.ajaxCall('ajax/db_delete.php?p=' + rd.obj.id + '_' + row + '_' + col);
        var delid = rd.obj.id + '_' + row + '_' + col;
        $.ajax({
            url: 'deleteDragExamSubjects',
            method: 'POST',
            data: {p: delid},
            success: function ()
            {
                return true;
            }
        });
    };
    // set error handler for AJAX call
    rd.error.ajax = function (xhr) {
        // display error message
        document.getElementById('message').innerHTML = 'Error: [' + xhr.status + '] ' + xhr.statusText;
    };
    // print message to the message line
    redips.printMessage('AJAX version');
};


// print message
redips.printMessage = function (message) {
    document.getElementById('message').innerHTML = message;
};


// add onload event listener
if (window.addEventListener) {
    window.addEventListener('load', redips.init, false);
}
else if (window.attachEvent) {
    window.attachEvent('onload', redips.init);
}