<?php 
//$cvxml = simplexml_load_file('cv.xml'); 
$xml = file_get_contents('cv.xml');
$xml = str_replace("     ","", $xml);
$xml = str_replace("\t","", $xml);
$xml = str_replace("\r","\n", $xml);
$xml = str_replace("\n\n","\n", $xml);
$xml = str_replace("\n","&#10;", $xml);
$xml = str_replace(">&#10;<",">\n<", $xml);
$cvxml = new SimpleXmlElement($xml);
require_once("i18n-it_IT.php");
require_once("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $cvxml->identification->firstname.PHP_EOL,  $cvxml->identification->lastname; ?> - Curriculum Vitae</title>

<meta name="viewport" content="width=device-width"/>
<meta name="description" content="Europass Curriculum Vitae."/>
<meta charset="UTF-8"> 

<link type="text/css" rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="cv" class="instaFade">
    <div class="mainDetails">
        <div id="headshot" class="quickFade">
            <img src="me.jpg" alt="<?php echo $cvxml->identification->firstname.PHP_EOL,  $cvxml->identification->lastname?>" />
        </div>
        
        <div id="name">
            <h1 class="quickFade "><?php echo $cvxml->identification->firstname.PHP_EOL,  $cvxml->identification->lastname?></h1>
            <h2 class="quickFade "><?php echo $cvxml->application->label; ?></h2>
        </div>
        
        <div id="contactDetails" class="quickFade delayTwo">
            <ul>
                <li><?php echo $i18n['location']; ?>: <?php echo  $cvxml->identification->contactinfo->address->municipality, ', ', $cvxml->identification->contactinfo->address->country->label ; ?></li>
                <li><?php echo $i18n['email']; ?>: <a href="mailto:<?php echo $cvxml->identification->contactinfo->email; ?>" target="_blank"><?php echo $cvxml->identification->contactinfo->email; ?></a></li>

                <li><?php echo $i18n['mobile']; ?>: <?php echo $cvxml->identification->contactinfo->mobile; ?></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <div id="mainArea" class="animation bouncing delayThree">

<!-- ### Work Experience ### -->
<?php if(!empty($cvxml->workexperiencelist->workexperience->position->label)): ?>
        <section>
            <div class="sectionTitle">
                <h1><?php echo $i18n['work'] ?></h1>
            </div>
            
            <div class="sectionContent">
<?php
$workexperiencelist = $cvxml->xpath('workexperiencelist/workexperience');

foreach ($workexperiencelist as $wlist) {
echo <<<EOF
                <article>
                    <h2>{$wlist->position->label} {$i18n['at']} {$wlist->employer->name}</h2>
                    <p class="subDetails">{$months($wlist->period->from->month)} {$wlist->period->from->year} &#8594; {$months($wlist->period->to->month)} {$isfull($wlist->period->to->year)} </p>
                    <p>{$empty2nl($wlist->activities)}</p>
                </article>

EOF;
}
?>

            </div>
            <div class="clear"></div>
        </section>
<?php endif; ?>


<!-- ### Education ### -->
<?php if(!empty($cvxml->educationlist->education->title)): ?>
       <section>
            <div class="sectionTitle">
                <h1><?php echo $i18n['education'] ?></h1>
            </div>
            
            <div class="sectionContent">
<?php
$educationlist = $cvxml->xpath('educationlist/education');

foreach ($educationlist as $elist) {
echo <<<EOF
                <article>
                    <h2>{$elist->title} {$i18n['at']} {$elist->organisation->name}</h2>
                    <p class="subDetails">{$months($elist->period->from->month)} {$elist->period->from->year} &#8594; {$months($elist->period->to->month)} {$isfull($elist->period->to->year)} </p>
                    <p>{$empty2nl($elist->skills)}</p>
                </article>

EOF;
}
?>

            </div>
            <div class="clear"></div>
        </section>
<?php endif; ?>  



<!-- ### Languages ### -->
<?php if(!empty($cvxml->languagelist->language->label)): ?>
       <section>
            <div class="sectionTitle">
                <h1><?php echo $i18n['languages'] ?></h1>
            </div>
            
            <div class="sectionContent">
                <ul class="lang">
<?php    $languagelist = $cvxml->xpath('languagelist/language');

    foreach ($languagelist as $lg) {
        echo '<li>',$lg->label, '</li>';
    }
?>
                </ul>
           </div>
            <div class="clear"></div>
        </section>
<?php endif; ?> 




<!-- ### Skills ### -->
<?php if(!empty($cvxml->skilllist->skill)): ?>
       <section>
            <div class="sectionTitle">
                <h1><?php echo $i18n['skills'] ?></h1>
            </div>
            
            <div class="sectionContent">
<?php
$skilllist = $cvxml->xpath('skilllist/skill');

foreach ($skilllist as $slist) {
echo <<<EOF
                <article>
                    <h2>{$whatskill($slist["type"])} </h2>
                    <p>{$empty2nl($slist)}</p>
                </article>

EOF;
}
?>

            </div>
            <div class="clear"></div>
        </section>
<?php endif; ?> 

<!-- ### More ### -->
<?php if(!empty($cvxml->misclist->misc)): ?>
       <section>
            <div class="sectionTitle">
                <h1><?php echo $i18n['more'] ?></h1>
            </div>
            
            <div class="sectionContent">
            <article>
            <p><?php echo empty2nl($cvxml->misclist->misc[0]); ?></p>
            </article>

            </div>
            <div class="clear"></div>
        </section>

<?php endif; ?>



</div>

</div>
</body>
</html>