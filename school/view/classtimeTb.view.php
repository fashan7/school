<?php
if(empty($_POST['gradesection']))
{
    echo "<center><b>Select the Section</br></center>";
    exit;
}
$det = new detailsController;
?>
<style>
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}
table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}
table tr {
  background: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}
table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
@media screen and (max-width: 600px) {
  table {
    border: 0;
  }
  table caption {
    font-size: 1.3em;
  }
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  table td:before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  table td:last-child {
    border-bottom: 0;
  }
}
</style>
<link rel="stylesheet" href="/../public/css/dragtimetable/style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="/../public/js/dragtimetable/redips-drag-min.js"></script>
<script type="text/javascript" src="/../public/js/dragtimetable/script.js"></script>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Drag &amp; Drop The Subjects</h3>
    </div>
    <div class="box-body">
      <div class="row">
          <div class="col-lg-12">
              <div id="main_container">
                  <div id="redips-drag">
                      <div class="col-lg-3">
                          <table id="table1" class="table order-list">
                            <tbody>
                                <?php 
                                $det->subjects();
                                ?>
                                <tr><td class="redips-trash" title="Trash" data-labe="Trash">Trash</td></tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="col-lg-8">
                          <table id="table2" class="table order-list">
                            <tbody>
                                <tr>
                                    <!-- if checkbox is checked, clone school subjects to the whole table row  -->
                                    <td class="redips-mark blank">
                                        <input id="week" type="checkbox" title="Apply school subjects to the week" checked/>
                                        <input id="report" type="checkbox" title="Show subject report"/>
                                    </td>
                                    <td class="redips-mark dark">Monday</td>
                                    <td class="redips-mark dark">Tuesday</td>
                                    <td class="redips-mark dark">Wednesday</td>
                                    <td class="redips-mark dark">Thursday</td>
                                    <td class="redips-mark dark">Friday</td>
                                    <td class="redips-mark dark">Saturday</td>
                                </tr>
                                <?php $det->timetable('08:00', 1); ?>
                                <?php $det->timetable('09:00', 2); ?>
                                <?php $det->timetable('10:00', 3); ?>
                                <?php $det->timetable('11:00', 4); ?>
                                <?php $det->timetable('12:00', 5); ?>
                                <tr>
                                    <td class="redips-mark dark">13:00</td>
                                    <td class="redips-mark lunch" colspan="6">Lunch</td>
                                </tr>
                                <?php $det->timetable('14:00', 7); ?>
                                <?php $det->timetable('15:00', 8); ?>
                                <?php $det->timetable('16:00', 9); ?>
                            </tbody>
                        </table>
                      </div>                      
                  </div>
              </div>
<!--              <div id="message">Drag school subjects to the timetable (clone subjects with SHIFT key)</div>-->
			<div class="button_container">
				<input type="button" value="Save" class="button" onclick="redips.save()" title="Save timetable"/>
			</div>
          </div>            
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Subject</h3>
                    </div>
                    <div class="box-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                            <ul class="fc-color-picker" id="color-chooser">
                                <li><a class="text-aqua" href="#"><i class="fa fa-square" ></i></a></li>
                                <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                            </ul>
                        </div>
                        <!-- /btn-group -->
                        <div class="input-group">
                            <input id="newSubject" name="newSubjectsubjectRegister" type="text" class="form-control" placeholder="Subject">


                            <div class="input-group-btn">
                                <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                            </div>
                        <!-- /btn-group -->
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    var loading = false;     
    if(loading){
        return;
    }
    loading = true;
    var currColor = '#3c8dbc' //Red by default
    
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
//      var val = $('#new-event').val()
//      if (val.length == 0) {
//        return
//      }
        var newSubject = $('#newSubject').val();

        $.ajax({
          url: "subjectRegister",
          method: "POST",
          data:{newSubject: newSubject, currColor: currColor },
          success: function(jsonData)
          {
              loading = false;
          }
          
      }); 

      //Remove event from text input
      $('#newSubject').val('');
    });
});
</script>