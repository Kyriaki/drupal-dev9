<?php

namespace Drupal\formation\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Créer le bloc de démo
 *
 * @Block(
 *   id = "demo_block",
 *   admin_label = @Translation("Demo Block"),
 * )
 */
class DemoBlock extends BlockBase
{
  // la méthode t() enregistre la chaîne de caractère avec des options de traduction
  public function build()
  {
    /*
    return array(
      '#markup' => $this->t('Bloc de démo')
    );
    */
    $build = [];

    $items = [];
    $items[] = Link::fromTextAndUrl('Route 1', Url::fromRoute('formation.route1'))->toString();
    $items[] = Link::fromTextAndUrl('Fruits', Url::fromRoute('formation.fruits'))->toString();
    $items[] = Link::fromTextAndUrl('Utilisateurs', Url::fromRoute('formation.utilisateurs'))->toString();
    $items[] = Link::fromTextAndUrl('Database exemples', Url::fromRoute('formation.database_exemples'))->toString();
    $items[] = Link::fromTextAndUrl('Formulaire de démo', Url::fromRoute('formation.form_demo'))->toString();

    $build[] =  [
      '#theme' => 'item_list',
      '#items' => $items,
      '#list_type' => 'ul',
    ];

    return $build;

  }
}
