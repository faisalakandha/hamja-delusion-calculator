<?php


function TestForm()
{


    ob_start(); ?>

<form action="/test-form-data/" method="POST">
    Name: <input type="text" name="nameI"><br>
    E-mail: <input type="text" name="emailI"><br>
    <input type="submit">
</form>

<form action="/test-form-data/" method="post">
        <label>Calendar</label>
        <input type="text" name="calendar"/>
    <input type="submit" value="Submit" name="qwe" value="submit" />
</form>


<?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode("TestForm_shortcode", "TestForm");