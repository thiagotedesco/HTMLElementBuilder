<?php

require '../vendor/autoload.php';

use app\classes\HtmlElementBuilder;

$html = new HtmlElementBuilder('html');
$head = new HtmlElementBuilder('head');
$head->addChild(
    (new HtmlElementBuilder('meta'))
    ->setAttribute('charset', 'UTF-8')
);
$head->addChild(
    (new HtmlElementBuilder('title'))
        ->setContent('HtmlElementBuilder')
);

$body = new HtmlElementBuilder('body');
$div = new HtmlElementBuilder('div');
$h5 = new HtmlElementBuilder('h5');
$h5->setContent('A simple class to write html element');
$span = new HtmlElementBuilder('span');
$span->setRawContent('<b>Hello World</b>');
$div->addChild($h5);
$div->addChild($span);
$body->addChild($div);


$html->addChild($head);
$html->addChild($body);
echo $html->render();
