<?php

    require __DIR__ . '/tools.php';

    $errors = [];
    
        if (empty($_FILES['image'])) {
            $errors['image'][] = 'Veuillez télécharger une image';
        }
        
        if(empty($errors['image']) && $_FILES['image']['error'] !== 0) {
            $errors['image'][] = 'Une erreur s\'est produite lors de l\'envoi de l\'image';
        }
        
        if (empty($_POST['title'])) {
            $errors['title'][] = 'Veuillez indiquer un titre';
        }
    
        if (empty($errors['title']) && mb_strlen($_POST['title']) > 50) {
            $errors['title'][] = 'Votre titre est trop long, 50 caractères maximum';
        }
    
        if (mb_strlen($_POST['description']) > 500) {
            $errors['description'][] = 'Votre description est trop longue, 500 caractères maximum';
        }
        
        //Gestion des erreurs séparement avec des if/else
        if ($_FILES['image']['size'] <= 1000000)
        {
            $fileInfo = pathinfo($_FILES['image']['name']); //on stocke les infos du fichier dans fileInfo
            $extension = $fileInfo['extension']; //extension étant une info du fichier, saved dans $extension
            $allowedExtensions = ['jpg', 'JPG', 'JPEG', 'jpeg', 'PNG', 'png', 'GIF', 'gif']; //liste des extensions autorisées
            if (in_array($extension, $allowedExtensions)) {
                move_uploaded_file($_FILES['image']['tmp_name'], 'upload/' . basename($_FILES['image']['name']));
            } else {
                $errors['image'][] = "veuillez envoyer une image de format jpg, png ou gif";
            }
        } else {
            $errors['image'][] = "La taille de votre image est trop grande";
        }
    
        if (!empty($errors)) { //Si le tableau d'erreurs n'est pas vide, alors
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = [ //On récupère les données précédemment stockées
                'image' => $_FILES['image'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
            ];
            redirectTo('post-and-comment.php');// redirigés sur register.php  
        }
    

    
    $imageUploadQuery = 'INSERT INTO images(img, title, description) VALUES (:img, :title, :description)';
    
    $imageUpload = $db->prepare($imageUploadQuery);
    $imageUpload->execute([
            'img' => $_FILES['image']['name'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
        ]);
    
    
    //ajouter un die?
    redirectTo('main.php');

    
    