<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2021/3/31
 * Time: 10:08
 */

namespace Wanphp\ComposerInstallersExtender;


use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
  private $locations = array(
    'libray' => 'wanphp/libray/',
    'plugin' => 'wanphp/plugins/',
    'extend' => 'wanphp/extend/',
    'component' => 'wanphp/components/'
  );

  /**
   * {@inheritDoc}
   */
  public function getPackageBasePath(PackageInterface $package)
  {
    $prefix = substr($package->getPrettyName(), 0, 16);
    if ('wanphp/composer-' === $prefix) {
      $key = substr($package->getType(), 7);
      if (isset($this->locations[$key])) return $this->locations[$key] . substr($package->getPrettyName(), 16);
      else return 'wanphp/extend/' . substr($package->getPrettyName(), 16);
    }
    return parent::getInstallPath($package);
  }

  public function getInstallPath(PackageInterface $package): string
  {
    $prefix = substr($package->getPrettyName(), 0, 16);
    if ('wanphp/composer-' === $prefix) {
      $key = substr($package->getType(), 7);
      if (isset($this->locations[$key])) return $this->locations[$key] . substr($package->getPrettyName(), 16);
      else return 'wanphp/extend/' . substr($package->getPrettyName(), 16);
    }
    return parent::getInstallPath($package);
  }

  /**
   * {@inheritDoc}
   */
  public function supports($packageType)
  {
    $key = substr($packageType, 7);
    return isset($this->locations[$key]);
  }
}
