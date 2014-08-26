<?php

/**
 * @file
 * Contains \Drupal\workbench\Workbench
 */

namespace Drupal\workbench;

use Drupal\workbench\WorkbenchInterface;

class Workbench implements WorkbenchInterface {

  /**
   * An array of links to render as part of the Workbench.
   */
  public $links;

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Constructs a Workbench object.
   */
  public function __construct() {
    $this->moduleHandler = \Drupal::service('module_handler');
  }

  /**
   * @inheritdoc
   */
  public function getLinks() {
    if (!isset($this->links)) {
      $this->registerLinks();
    }
    return $this->links;
  }

  /**
   * @inheritdoc
   */
  public function setLinks(array $links) {
    $this->links = $links;
  }

  /**
   * @inheritdoc
   */
  public function registerLinks() {
    $links = array();

    // @TODO: Rewrite as a plugin?
    $links = $this->moduleHandler->invokeAll('workbench_links');

    $this->setLinks($links);
  }


}