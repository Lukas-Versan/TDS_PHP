<?php
    echo "<h3>FORMA NORMAL DO ARRAY</h3>";
    $frutas = array("maçã", "pera", "melancia");
    print_r($frutas);
    
    echo "<h3>FORMA AVREVIADA DO ARRAY</h3>";
    $carros = ["Opala", "Dodge", "Ferrari"];
    print_r($carros);
    
    echo "<h3>ARRAY ASSOCIATIVO</h3>";
    $pessoa = ["nome" => "Bela", "idade" => "30"];
    print_r($pessoa);
    
    echo "<h3>ACESSANDO ELEMENTOS DO ARRAY</h3>";
    echo $frutas[1]."<br/>";
    echo $carros[2]."<br/>";
    echo $pessoa["nome"]."<br/>";
    
    echo "<h3>MODIFICAR ELEMENTOS DO ARRAY</h3>";
    $carros[1] = "Camaro";
    print_r($carros);
    echo "<br/>";
    $pessoa["idade"] = "25";
    print_r($pessoa);
    echo "<br/>";
    
    echo "<h3>ADICIONAR ELEMENTO NO ARRAY</h3>";
    $carros[] = "Marajó";
    print_r($carros);
    echo "<br/>";
    $pessoa["profissão"] = "developer";
    print_r($pessoa);

    echo "<h3>REMOVER ELEMENTO DO ARRAY</h3>";
    unset($carros[0]);
    print_r($carros);
    echo "<br/>";
    unset($pessoa["idade"]);
    print_r($pessoa);

    echo "<h3>INTERAÇÃO DE UM ARRAY</h3>";
    echo "Usando o FOR<br/>";
    for ($i = 1;$i <= count($carros); $i++){
        echo "Carros na posição $i: ".$carros[$i]."<br/>";
    }
    echo "<br/>Usando o FOREACH</br>";
    foreach($pessoa as $chave=>$valor){
        echo "$chave: $valor<br/>";
    }
?>