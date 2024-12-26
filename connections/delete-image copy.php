
<?php

if (isset($_GET["anonce_id"]) && !empty($_GET["anonce_id"]) && isset($_GET["img_id"]) && !empty($_GET["img_id"])) {
    $annonce_id = intval($_GET["anonce_id"]);
    $img_id = intval($_GET["img_id"]);

    // Fetch all images for the given annonce_id
    $query = "SELECT img_id, image_url FROM annonces_images WHERE annonce_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $annonce_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $image_count = mysqli_num_rows($result);

    if ($image_count <= 1) {
        // Prevent deletion if only one image remains
        echo 'Message: Vous ne pouvez pas supprimer cette image, il doit rester au moins une image.';
    } else {
        // Loop through to find the image to delete
        $image_to_delete = null;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['img_id'] == $img_id) {
                $image_to_delete = $row;
                break;
            }
        }

        if ($image_to_delete) {
            $file_path = "../img/" . $image_to_delete['image_url'];

            // Delete the image file from the folder
            if (!empty($image_to_delete['image_url']) && file_exists($file_path)) {
                if (unlink($file_path)) {
                    // Delete the database record for the specific image
                    $delete_query = "DELETE FROM annonces_images WHERE img_id = ?";
                    $delete_stmt = mysqli_prepare($conn, $delete_query);
                    mysqli_stmt_bind_param($delete_stmt, 'i', $img_id);

                    if (mysqli_stmt_execute($delete_stmt)) {
                        echo "Image supprimée avec succès.";
                    } else {
                        echo "Erreur lors de la suppression de l'enregistrement de l'image dans la base de données.";
                    }
                } else {
                    echo "Erreur lors de la suppression de l'image du dossier.";
                }
            } else {
                echo "Le fichier d'image n'existe pas ou est introuvable.";
            }
        } else {
            echo "Image introuvable pour l'ID spécifié.";
        }
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Requête invalide. Paramètres manquants.";
}
