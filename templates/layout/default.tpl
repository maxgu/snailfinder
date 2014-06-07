<?=$this->doctype(); ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <?=$this->headTitle('Snailfinder - php-fpm slow log analyst'); ?>
        <!-- Le styles -->
        <?=$this->headLink(array('rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => 'favico.png'))?>
        <style type="text/css">
            body { background-color: #FFFFFF; }
            * { font-family: Verdana, Arial, Helvetica; }
            div, p, th, td { font-size:12px; }
            a {color:rgb(180, 80, 80);text-decoration:underline}
            a:hover {color:rgb(180, 80, 80);text-decoration:none}
            h1 { font-size:16px; color:#FFFFFF; font-weight:normal; padding:6px; background-color:#3EA5CE; margin-bottom:0px; }
            h2 { margin-top:15px; margin-bottom:10px; font-weight:normal; font-size:14px; padding:2px 10px 2px 0px; border-bottom:1px solid #7B8CBE; color:#7B8CBE; }
            h2 a, h2 a:hover { color:black; text-decoration:none; }
            pre { font-family: monospace; }
            h3 { color:#FFB462; border-bottom:1px solid #FFB462; font-weight:bold; font-size:12px; margin-bottom:10px; padding-bottom:2px; }
            .generateButton{margin-top:5px;background-color: #FFFFFF;border: 1px solid #000000;font-size: 11px;padding: 1px;}
            form { border:1px solid #CBD0D3; -moz-border-radius:6px;	padding:10px; margin-top:5px; background-color:#DCF1F4; }
            .error { color:red; }
            .tip { background-color:#EBF0FC; -moz-border-radius:10px; padding:6px; margin:5px; }
            ul { padding-left: 14px; padding-top: 0px; padding-bottom: 0px; margin-bottom: 0px; margin-top: 0px; }
            ul li { list-style-type: square; }
            div.reports { padding:4px; }
            table.reports td, table.reports th { padding: 2px; }
            table.reports th { background-color: #DDDDDD; border:1px solid #CCCCCC; }
            table.reports th.left { text-align:left !important; }
            table.reports tr.row0 td { background-color: #FFFFFF; border: 1px solid #EEEEEE; }
            table.reports tr.row1 td { background-color: #EEEEEE; border: 1px solid #EEEEEE; }
            table.reports td.top { vertical-align:top; }
            table.reports td.right { text-align:right; }
            table.reports td.center { text-align:center; }
            table.reports td.relevantInformation { font-weight:bold; }
            table.reports div.examples { background-color:#EBF0FC; border:1px solid #FFFFFF; -moz-border-radius:10px; padding:6px; margin:5px; }
            table.reports div.examples div.example0 { padding:2px; }
            table.reports div.examples div.example1 { background-color:#FFFFFF; padding:2px; border:1px solid #EBF0FC; -moz-border-radius:5px; }
            .normal { color: green; font-weight:bold; }
            .warning { color: orange; font-weight:bold; }
            .fatal { color: red; font-weight:bold; font-style:italic; }
            
        </style>
    </head>
    <body>
        <div>
            <h1 id="top">
                Snailfinder: php-fpm slow log analyst
            </h1>
            
            <?=$this->content?>
            
        </div>
    </body>
</html>
