<form action="" method="post">

age : 
<select name = 'age'>
    <option value="Select">Select</option>
    <option value="10-19">10-19</option>
    <option value="20-29">20-29</option>
    <option value="30-39">30-39</option>
    <option value="40-49">40-49</option>
    <option value="50-59">50-59</option>
    <option value="60-69">60-69</option>
    <option value="70-79">70-79</option>
    <option value="80-89">80-89</option>
    <option value="90-99">90-99</option>
</select><br><br>

menopause : 
<select name = 'menopause'>
    <option value="Select">Select</option>
    <option value="lt40">lt40</option>
    <option value="ge40">ge40</option>
    <option value="premeno">premeno</option>
</select><br><br>

tumor-size : 
<select name = 'tumor_size'>
    <option value="Select">Select</option>
    <option value="0-4">0-4</option>
    <option value="5-9">5-9</option>
    <option value="10-14">10-14</option>
    <option value="15-19">15-19</option>
    <option value="20-24">20-24</option>
    <option value="25-29">25-29</option>
    <option value="30-34">30-34</option>
    <option value="35-39">35-39</option>
    <option value="40-44">40-44</option>
    <option value="45-49">45-49</option>
    <option value="50-54">50-54</option>
    <option value="55-59">55-59</option>
</select><br><br>
inv-nodes : 
<select name = 'inv_nodes'>
    <option value="Select">Select</option>
    <option value="0-2">0-2</option>
    <option value="3-5">3-5</option>
    <option value="6-8">6-8</option>
    <option value="9-11">9-11</option>
    <option value="12-14">12-14</option>
    <option value="15-17">15-17</option>
    <option value="18-20">18-20</option>
    <option value="21-23">21-23</option>
    <option value="24-26">24-26</option>
    <option value="27-29">27-29</option>
    <option value="30-32">30-32</option>
    <option value="33-35">33-35</option>
    <option value="36-39">36-39</option>
</select><br><br>

node-caps :
<select name = 'node_caps'>
    <option value="Select">Select</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select><br><br>

deg-malig : 
<select name = 'deg_malig'>
    <option value="Select">Select</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select><br><br>

breast : 
<select name = 'breast'>
    <option value="Select">Select</option>
    <option value="left">left</option>
    <option value="right">right</option>
</select><br><br>

breast-quad : 
<select name = 'breast_quad'>
    <option value="Select">Select</option>
    <option value="left_up">left_up</option>
    <option value="left_low">left_low</option>
    <option value="right_up">right_up</option>
    <option value="right_low">right_low</option>
    <option value="central">central</option>
</select><br><br>

irradiat : 
<select name = 'irradiat'>
    <option value="Select">Select</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select><br><br>

  <input type="submit" name="submit"/>

</form>    

<?php

if(isset($_POST['submit'])){
    $age = $_POST['age'];
    $menopause = $_POST['menopause'];
    $tumor_size = $_POST['tumor_size'];
    $inv_nodes = $_POST['inv_nodes'];
    $node_caps = $_POST['node_caps'];
    $deg_malig = $_POST['deg_malig'];
    $breast = $_POST['breast'];
    $breast_quad = $_POST['breast_quad'];
    $irradiat = $_POST['irradiat'];

    echo 'ข้อมูลที่คุณป้อนของคุณคือ :'.$age.' '.$menopause.' '.$tumor_size.' '.$inv_nodes.' '.$node_caps.' '.$deg_malig.' '.$breast.' '.$breast_quad.' '.$irradiat.'<br><br>';

    $data = array ('age,menopause,tumor-size,inv-nodes,node-caps,deg-malig,breast,breast-quad,irradiat,Class',
                    '40-49,premeno,15-19,0-2,yes,3,right,left_up,no,recurrence-events',
                    '50-59,ge40,15-19,0-2,no,1,right,central,no,no-recurrence-events',
                    '40-49,premeno,25-29,0-2,no,2,left,left_up,yes,no-recurrence-events',
                    '40-49,premeno,35-39,0-2,no,2,right,right_up,no,no-recurrence-events',
                    '50-59,premeno,30-34,3-5,yes,2,left,left_low,yes,no-recurrence-events',
                    '40-49,premeno,20-24,0-2,no,2,right,right_up,no,no-recurrence-events',
                    '60-69,ge40,15-19,0-2,no,3,right,left_up,yes,no-recurrence-events',
                    '50-59,ge40,30-34,6-8,yes,2,left,left_low,no,no-recurrence-events',
                    '50-59,premeno,25-29,3-5,yes,2,left,left_low,yes,no-recurrence-events',
                    '30-39,premeno,30-34,6-8,yes,2,right,right_up,no,no-recurrence-events',
                    '50-59,premeno,15-19,0-2,no,2,right,left_low,no,no-recurrence-events',
                    '50-59,ge40,40-44,0-2,no,3,left,right_up,no,no-recurrence-events',
                    '50-59,ge40,20-24,3-5,yes,2,right,left_up,no,no-recurrence-events',
                    '50-59,ge40,10-14,0-2,no,2,right,left_low,no,no-recurrence-events',
                    '40-49,premeno,10-14,0-2,no,1,right,left_up,no,no-recurrence-events',
                    '60-69,ge40,30-34,3-5,yes,3,left,left_low,no,no-recurrence-events',
                    '40-49,premeno,15-19,15-17,yes,3,left,left_low,no,recurrence-events',
                    '60-69,ge40,30-34,0-2,no,3,right,central,no,recurrence-events',
                    '50-59,ge40,25-29,0-2,no,3,left,right_up,no,no-recurrence-events',
                    '50-59,ge40,20-24,0-2,no,3,right,left_up,no,no-recurrence-events',
                    '40-49,premeno,30-34,0-2,no,1,left,left_low,yes-recurrence-events',
                    '30-39,premeno,15-19,6-8,yes,3,left,left_low,yes-recurrence-events',

                            $age.','.$menopause.','.$tumor_size.','.$inv_nodes.','.$node_caps.','.$deg_malig.','.$breast.','.$breast_quad.','.$irradiat.',?');
    $fp = fopen('cencer_csv.csv', 'w');
    foreach($data as $line){
        $val = explode(",",$line);
        fputcsv($fp, $val);
    }
    fclose($fp);

    $cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader cencer_csv.csv > cencer_unseen_test.arff ';
    exec($cmd,$output);

    //$cmd1 = 'java -classpath "weka.jar" weka.classifiers.lazy.IBk -T "cencer_unseen_test.arff" -l "breast-cancer.model" -p 10'; // show output prediction
    $cmd1 = 'java -classpath "weka.jar" weka.classifiers.lazy.IBk -t "cencer_unseen_test.arff" -x 20 -d "breast-cancer.model" -p 10';
    exec($cmd1,$output1);

    
    $show=$output1[sizeof($output1)-2];
    $sub = substr($show,-7);
    
    if($show[30] == 1){
        $test = "no-recurrence-events";
    }
    else $test = "recurrence-events";
    echo '<br>ผลลัพธ์ได้จากการทำนายคือ : '.$test.'   ที่ความน่าจะเป็นเท่ากับ   '.$sub;
}
?>