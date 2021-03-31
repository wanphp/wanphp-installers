<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2021/3/30
 * Time: 16:48
 */

namespace Wanphp\ComposerInstallersExtender;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
  private $installer;
  public function activate(Composer $composer, IOInterface $io)
  {
    $this->installer = new Installer($io, $composer);
    $composer->getInstallationManager()->addInstaller($this->installer);
  }

  public function deactivate(Composer $composer, IOInterface $io)
  {
    $composer->getInstallationManager()->removeInstaller($this->installer);
  }

  public function uninstall(Composer $composer, IOInterface $io)
  {
  }
}
