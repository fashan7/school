<?php
$seminar_id = $_GET['seminarid'];
$participant_id = $_GET['participantid'];

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .formdiv
        {
            margin-left: 25%;
            width: 50%;
            background: lightgrey;
            border-radius: 10px;
            padding: 10px;
            text-align: justify;
        }
        /* Style inputs with type="text", select elements and textareas */
        input[type=text], select, textarea {
            width: 100%; /* Full width */
            padding: 12px; /* Some padding */  
            border: 1px solid #ccc; /* Gray border */
            border-radius: 4px; /* Rounded borders */
            box-sizing: border-box; /* Make sure that padding and width stays in place */
            margin-top: 6px; /* Add a top margin */
            margin-bottom: 16px; /* Bottom margin */
            resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
        }

        /* Style the submit button with a specific background color etc */
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* When moving the mouse over the submit button, add a darker green color */
        input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Add a background color and some padding around the form */
        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="formdiv">
        <h2>Feedback</h2>
        <label>Participant Mail ID : <strong><?php echo $participant_id; ?></strong></label>
        <br>
        <label>Seminar ID : <strong><?php echo $seminar_id; ?></strong></label>
        <br>
        <p><strong>Participants</strong> - Your opinion matters to us. Using the survey instrument below, please feel free to write on the back of this form. Thanks for attending today – remember to visit our hot-talk calendar at <a href="http://hot-talk.idmedu.lk/#section-intro-text">http://hot-talk.idmedu.lk/</a> for more upcoming training and professional development opportunities. </p>

        <div class="container" >
          <form action="localhost:8001/feedbackSave.php" enctype="multipart/form-data">
            <input type="hidden" name="partid">
            <input type="hidden" name="semid">

            <h4>Write your thoughts about our talk</h4>
            <textarea id="subject" name="subject" style="height:200px"></textarea>
            <h3>OR</h3>
            <h4>Record your thoughts about our talk</h4>
            <input type="file" accept="audio/*" id="audiofb" name="audiofb">
            <input type="submit" value="Submit" style="float:right">

          </form>
        </div>
</div>
</body>
</html>