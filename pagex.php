<?php

include "config.php";


    if(isset($_POST['submitUser']))
    {
            $name=$_POST['fname'];
            $typecm=$_POST['comptype'];
            $solde=$_POST['solde'];
         
  if ($name!="" and $typecm!="" and $solde!="" ){
        if ( is_numeric($solde)){
            $sql1 = "INSERT INTO compte VALUES (NULL,'$name','$typecm','$solde')";
            $result=$connection->query($sql1);
            echo "<script> alert('L\'enregistrement a été bien ajouté');</script>";
            
        } else echo "<script> alert('Veuillez fournir un solde valide');</script>";
        
    
  }else 
  echo "<script> alert('Veuillez remplir les champs');</script>";
             
   
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1 style="text-align:center;">Gestion des comptes</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <fieldset style="background-color:#ff780017;">
   <h1>Ajouter un compte</h1>
        <input type="text" name="fname" placeholder="propriétaire"><br><br>
        <label>Type de compte: </label><br>

        <input type="radio" name="comptype" id="c1" value="Compte courant" checked>
        <label for="c1">Compte courant</label>

        <input type="radio" name="comptype"  id="c2" value="compte épargnet">
        <label for="c2">compte épargne</label>

        <input type="radio" name="comptype" id="c3"  value="compte à terme">
        <label for="c3">compte à terme</label><br><br>

        <input type="text" name="solde" placeholder="solde"><br><br>
        <input type="submit" value="Ajouter compte" name="submitUser"><br>
    </fieldset>
    <br>

    <fieldset style="background-color:#ff780017;">
    <h1>liste des comptes</h1>
        <?php  
                $sql2 = "SELECT * FROM compte";
                $result=$connection->query($sql2);
                if($result->num_rows>0){
                    echo '<table border="1" width ="100%">';
            
                    while($ligne = $result->fetch_assoc()){
                        echo "<tr> <td>";
                       echo $ligne['idcompte']."</td><td>". $ligne['proprietaire'] ."</td><td>". $ligne['type'] ."</td><td>". $ligne['solde'] ." DH </td>";                 
                       echo "</tr>";
                    }
                    echo "</table>";
                }else
                {
        
                    echo "Pas de données à afficher";
                }
        ?>
    </fieldset>
    <br>
    <fieldset style="background-color:#ff780017;">
    <h1>Opérations</h1>

        
         <label for="html">ID:</label>
            <select id="id" name="id">
            
            <?php
                        $sql3 = "SELECT idcompte FROM compte";
                        $result=$connection->query($sql3);
                        if($result->num_rows>0){ 
                                while($ligne = $result->fetch_assoc()){
                                print_r($ligne);
                              echo '<option value='. $ligne['idcompte'].'>'.$ligne['idcompte'].'</option>';
                                 }
                        }
                        

                        ?>
            </select><br><br>
        
           
            <label>Type d'opération: </label><br>     
        <input type="radio"  name="opr" id="op1" value="Verser" checked>
        <label for="op1">Verser</label>
        <input type="radio" name="opr" id="op2"  value="Retirer" >
        <label for="op2">Retirer</label><br><br>
        <input type="text" name="montant" placeholder="Montant"><br><br>
    <input type="submit" value="Ajouter opération" name="submitOpr"><br>
    <?php
    if(isset($_POST['submitOpr']))
       {
            $num=$_POST['id'];
            $optype=$_POST['opr'];
            $mt=$_POST['montant'];

            $sql4 = "SELECT solde FROM compte WHERE idcompte=$num";
            $result=$connection->query($sql4);
                if($result->num_rows>0){ 
                    while($ligne = $result->fetch_assoc()){
                        if ($optype=="Verser"){
                            $ligne['solde']=$ligne['solde']+$mt;
                        }else if($optype=="Retirer")
                                $ligne['solde']=$ligne['solde']-$mt;
                                $new= $ligne['solde'];
                        
             
                    }
            $sql5 = "UPDATE compte SET solde=$new WHERE idcompte=$num";
             $result=$connection->query($sql5);
             echo "<script> alert('Compte mis à jour');</script>";
                }

                                       

       }
                        ?>
    <p style="text-align:right; color:red;text-decoration:underline">Groupe A: Prénom Nom </p>
    </fieldset>
    </form>
</body>
</html>

