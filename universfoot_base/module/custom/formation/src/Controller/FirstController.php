<?php
namespace Drupal\formation\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase
{
  public $texte;

  public function __construct() {
    $this->texte = "Joli texte";
  }

  public function test()
  {
    return array(
      '#type' => 'markup',
      '#markup' => $this->texte,
      '#prefix' => '<strong><em>',
      '#suffix' => '</em></strong>'
    );
  }

  public function fruits()
  {
    $fruits = ['Kiwi', 'Cerise', 'Mangue'];

    $content[] = [
      '#theme' => 'item_list',
      '#items' => $fruits,
      '#title' => 'Fruits de saison',
      '#list_type' => 'ol'
    ];

    $content[] = [
      '#markup' => '<p><strong>Manger au moins '. sizeof($fruits) .' fruits par jour</strong></p>',
    ];

    return $content;
  }

  public function utilisateurs()
  {
    /*
    $node = \Drupal\node\Entity\Node::load(1);
    $node->set('title', 'nyctalope');
    $node->save();
    */

    /* obtenir la valeur d'un champ du node chargé */
    // Méthode 1
    //$title = $node->getTitle();

    // Méthode 2
    //$titleData = $node->get('title')->getValue();
    //$title = $titleData[0]['value'];

    // charge tous les utilisateurs de type article via entityQuery();
    $query = \Drupal::entityQuery('user')->condition('status', 1);
    $result = $query->execute();
    $users = \Drupal\user\Entity\User::loadMultiple(array_keys($result));

    $items = [];
    foreach($users as $user) {
      //$nameData = $user->get('name')->getValue();
      //$name = $nameData[0]['value'];
      $name = $user->getUserName();
      $items[] = $name;
    }

    $content[] = [
      '#theme' => 'item_list',
      '#items' => $items,
      '#title' => t('')
    ];

    return $content;
  }

  public function database_exemples()
  {
    /*
    $query = \Drupal::database()->select('node_field_data', 'nfd');
    $query->addField('nfd', 'nid');
    $query->condition('nfd.title', 'Bonucci');
    $query->range(0, 1);
    $nid = $query->execute()->fetchField();
    */

    /*
    $query = \Drupal::database()->select('node_field_data', 'nfd');
    $query->fields('nfd', ['nid', 'title']);
    $query->condition('nfd.type', 'article');
    $query->condition('nfd.title', $query->escapeLike('Art') . '%', 'LIKE');
    $results = $query->execute()->fetchAllKeyed();

    var_dump($results);
    */


    $query = \Drupal::database()
      ->query("SELECT * FROM {node_field_data} WHERE type = :type",
        array(':type' => 'article'));

    foreach($query as $row) var_dump($row->title);

    return array('#markup' => 'ok');
  }

}
