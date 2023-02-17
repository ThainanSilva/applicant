<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/db.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/isLogged.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/companycheck.php';
 
function translate_content($content, $language) {
    // Define a lista de palavras em diferentes idiomas
    $words = [
      'en' => [
        'hello' => 'Hello',
        'world' => 'World',
      ],      
      'pt-br' => [
        'hello' => 'Hello',
        'world' => 'World',
      ],
      'pt' => [
        'hello' => 'Olá',
        'world' => 'Mundo',
      ],
    ];
  
    // Procura as palavras dentro das chaves duplas e as substitui
    $pattern = '/{{\s*(.*?)\s*}}/';
    return preg_replace_callback($pattern, function ($matches) use ($words, $language) {
      // Verifica se a palavra existe na lista para o idioma selecionado
      if (isset($words[$language][$matches[1]])) {
        return $words[$language][$matches[1]];
      }
  
      // Se não existir, retorna a palavra original
      return $matches[1];
    }, $content);
  }
  
  function render($html, $language) {
  
    // Traduz o conteúdo para o idioma desejado
    $translated_content = translate_content($html, 'pt-br');
  
    // Exibe o conteúdo traduzido
    echo $translated_content;
    echo $html;
  }
 

?>